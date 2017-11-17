var http   = require('http');
var server = http.createServer();
var io     = require('socket.io').listen(server);
var mazer  = require('generate-maze');

var players      = {};
var maze_size    = 20;
var levels       = 5;
var wall_level   = 4;
var FLAG		 = "DCTF{e82cf27a0b90414a2df8ebc7f59ef233107b0885ae22f53deea782856ca07bf7}";

function random(start, stop) {
	return Math.floor((Math.random() * stop) + start);
}

function create_level(size, leveldown, wall_level, lastlevel) {
	var level = mazer(size);
	
	var flag_x = random(0, size);
	var flag_y = random(0, size);

	do {
		var stairs_x = random(0, size);
		var stairs_y = random(0, size);
	} while(leveldown && leveldown.x == stairs_x && leveldown.y == stairs_y);

	for(var i=0;i<size;i++) {
		for(var j=0;j<size;j++) {
			if(!level[j][i].stairs) {
				level[j][i].stairs = 0;
			}
			
			if(lastlevel && j==flag_y && i==flag_x) {
				level[j][i].flag = true; 
				continue;
			}

			if(wall_level) {
				continue;
			}

			if(j==stairs_y && i==stairs_x) {
				level[j][i].stairs = 1;
				level = clear_walls_around_stairs(_p(level),i,j);
			}
		}
	}

	if(leveldown) {
		level[leveldown.y][leveldown.x].stairs = -1;
		level = clear_walls_around_stairs(_p(level), leveldown.x, leveldown.y);
	}

	return [{x:stairs_x, y:stairs_y}, level];
}

function clear_walls_around_stairs(level, x, y) {	
	level[y][x].left = level[y][x].right = level[y][x].top = level[y][x].bottom = false;

	if(x-1  >= 0) 		level[y][x-1].right = false;
	if(x+1 < maze_size) level[y][x+1].left = false;
	if(y-1 >= 0) 		level[y-1][x].bottom = false;
	if(y+1 < maze_size) level[y+1][x].top  = false;
	return level;
}

function create_game(player) {
	return new Promise(function(resolve, reject) {
		players[player.id] = {
			'levels': [],
			'status': {
				'level':0,
				'pos': {'x':0,'y':0}
			}
		};

		var leveldown;
		for(var i=0;i<levels;i++) {
			var res                      = create_level(maze_size, leveldown, i==wall_level-1, i==levels-1);
			players[player.id].levels[i] = _p(res[1]);
			leveldown                    = _p(res[0]);
		}
		
		return resolve(players[player.id].status);
	});
}

function player_can(player, direction) {
	return new Promise(function(resolve, reject) {
		var p = players[player.id];
		var x = p.status.pos.x;
		var y = p.status.pos.y;
		var l = p.status.level;

		var moving = false;
		switch(direction) {
			case 1: moving = !p.levels[l][y][x].left; break;
			case 2: moving = !p.levels[l][y][x].top; break;
			case 3: moving = !p.levels[l][y][x].right; break;
			case 4: moving = !p.levels[l][y][x].bottom; break;
			default:
				return reject('invalid direction');

		}
		
		if(moving) {
			return resolve(moving);
		} else {
			return reject('invalid move');
		}
	});
}

function get_player_new_pos(player, direction) {
	return new Promise(function(resolve, reject) {
		return get_player_pos(player).then(function(status) {
			switch(direction) {
				case 1: status.pos.x--; break;
				case 2: status.pos.y--; break;
				case 3: status.pos.x++; break;
				case 4: status.pos.y++; break;
				default:
					return reject('invalid direction');
			}
			return resolve(status);
		});
	});
}

function get_player_pos(player) {
	return new Promise(function(resolve, reject) { resolve(_p(players[player.id].status))});
}

function find_a_good_spot(player, status) {
	return new Promise(function(resolve, reject) {
		if(status.level == players[player.id].status.level) {
			return resolve(status);
		}
		
		var x = [1,2,3,4];
		shuffle(x);
		
		for(var d=0;d<4;d++) {
			var cb = function(plm) {		
				return get_player_new_pos(player, this.d);
			};
			player_can(player,d).then(cb.bind({d:x[d]}))
				.then(resolve).catch(function(e){});
		}
	});	
}

function _p(obj) {
	return JSON.parse(JSON.stringify(obj));
}

function shuffle(a) {
    var j, x, i;
    for (i = a.length; i; i--) {
        j = Math.floor(Math.random() * i);
        x = a[i - 1];
        a[i - 1] = a[j];
        a[j] = x;
    }
}

function do_action(player, data) {
	if(data.type == 'move' && data.direction) {

		player_can(player, data.direction).then(function(status) {
			return get_player_new_pos(player, data.direction);
		}).then(function(status) {
			players[player.id].status.level += players[player.id].levels[status.level][status.pos.y][status.pos.x].stairs;
			players[player.id].status.pos.x = status.pos.x;
			players[player.id].status.pos.y = status.pos.y;
			return find_a_good_spot(player, status);
		}).then(function(status) {
			players[player.id].status.pos.x = status.pos.x;
			players[player.id].status.pos.y = status.pos.y;
			if(players[player.id].levels[status.level][status.pos.y][status.pos.x].flag) {
				player.emit('message', FLAG);	
			}

			player.emit('status', JSON.stringify({pos: players[player.id].levels[status.level][status.pos.y][status.pos.x], level:status.level}));
		}).catch(function(e) {
			return player.emit('error_message', e);
		});
	}
}


io.sockets.on('connection', function (player) {
	console.log(player.id, 'connected');
	
	create_game(player).then(function(status) {
		player.emit('status', status);

		player.on('action', function(data) {
			do_action(player, data);
		});
	});

	player.on('disconnect', function() {
		players[player.id] = null;
		console.log(player.id, 'disconnected');
	});
});

console.log('Listening..')
server.listen(8080);