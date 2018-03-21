var server = require('http').Server();

var io = require('socket.io')(server);

var Redis = require('ioredis');
var redis = new Redis();

redis.subscribe('tester', function (err, count) {
  console.log('done');
});

server.listen(3000);
