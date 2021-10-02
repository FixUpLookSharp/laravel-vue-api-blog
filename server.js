var http = require('http').Server();
const io = require('socket.io')(http, {
    cors: {
        origin: '*',
    }
});
var Redis = require('ioredis');

var redis = new Redis();
redis.psubscribe('news-action.*');
redis.on('pmessage', function (pattern, channel, message) {
    console.log('Message recieved: ' + message);
    console.log('Channel: ' + channel);
    message = JSON.parse(message);
    console.log(message);

    io.emit(channel + ':' + message.event, message.data);
});


http.listen(3000, '192.168.10.10', function () {
    console.log('Listening on Port: 3000');
});
