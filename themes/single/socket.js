var app = require('express')();
var server = require('http').Server(app);
var io = require('socket.io')(server);
var redis = require('redis');

server.listen(3000);

io.on('connection', function (socket) {
  console.log("New client connected");
  var redisClient = redis.createClient();

  redisClient.subscribe('message');
  redisClient.on("message", function(channel, data) {
    let message = data
    console.log("New message added in queue in "+ channel + " channel", message);
    socket.emit(channel, data);
  });

  redisClient.subscribe('presence-message');
  redisClient.on("presence-message", function(channel, data) {
    console.log("Channel `presence-message` has new message in queue in: "+ channel + " channel", data.message);
    socket.emit(channel, data);
  });

  socket.on('disconnect', function() {
    redisClient.quit();
  });
});
