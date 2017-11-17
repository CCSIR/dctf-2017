## Are you (a)mazing?

### Description
One of my friends created a new game and he thinks it is impossible to win. Can you help me prove him wrong? This is the source of the game. 
Target: 45.76.95.55:8031 

Update: We've changed "a bit" the source code so you don't get stuck too often. The changes do not impact the winning strategy. Good luck! Update 11:00 EEST You can "jump" over the wall. 

### Author: 
Andrei

### Stats: 
378 points / 6 solvers

### Solution

The challenge is a standard maze challenge but with 5 levels. You can get from level 1 to 5 by finding elevators. But there are some challenges:

- when you reach on an elevator you will automatically go on the next level and you will get a random position around that x, y position
- if you go back on the elevator position you will go down on the previous level
- after you create a solver the players will notice there is no elevator to get over level 3


In order to get over level 3 you need to exploit a Race Condition attack. This vulnerability happens because of the folowing:

```
function do_action(player, data) {
	if(data.type == 'move' && data.direction) {

		player_can(player, data.direction).then(function(status) {
			return get_player_new_pos(player, data.direction);
		}).then(function(status) {
			//updates the level, this can trigger a race condition
			players[player.id].status.level += players[player.id].levels[status.level][status.pos.y][status.pos.x].stairs; 
			players[player.id].status.pos.x = status.pos.x;
			players[player.id].status.pos.y = status.pos.y;
			/* return a promise that checks if level changed, if so 
			then the player is moved on one of the available random positions around the elevator */
			return find_a_good_spot(player, status);
		}).then(function(status) {
			/* 
			here it forgots to update the level because of the false assumption that you don't need
			to do this because of the initial check from the find_a_good_spot
			*/
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
```

The pseudo-solution would look as follows:

- Map the level 1 until you find an elevator.
- Go up once and depending on the random position go back on the elevator by sending the opposite requests twice to get over the wall.

```
TOADD solver
```