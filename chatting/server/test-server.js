// const fs = require('fs');
// const https = require('https');
// const options = {
//   key: fs.readFileSync('/etc/letsencrypt/live/ego-lego.site/privkey.pem'),
//   cert: fs.readFileSync('/etc/letsencrypt/live/ego-lego.site/cert.pem'),
//   ca: fs.readFileSync('/etc/letsencrypt/live/ego-lego.site/fullchain.pem')
// };

const path = require('path');
const http = require('http');
const express = require('express');
const socketIO = require('socket.io');

// 
// const publicPath = path.join(__dirname, '/../../');
const publicPath = path.join(__dirname, '/../public/');
const port = process.env.PORT || 3000
let app = express();
let server = http.createServer(app);
// let server = https.createServer(app, options);
let io = socketIO(server);

app.use(express.static(publicPath));

// 소켓 연결 이벤트 발생
io.on('connection', (socket) => {
  console.log("A new user just connected");

  // 클라이언트가 접속을 끊었을때 이벤트
  socket.on('disconnect', () => {
    console.log("User was disconnected");
  });

  /*
   * 룸
   */
  //  socket.on('leaveRoom', (num, name) => {
  //    console.log(name + ' leave a ' + room[num]);
  //    io.to(room[num]).emit('leaveRoom', num, name);
  //  });

   socket.on('joinRoom', (num, name) => {
     console.log(name + 'join a ' + room[num]);
     io.to(room[num]).emit('joinRoom', num, name);
   });



});

/*
 * 네임스페이스
 */
const nameSpace1 = io.of('/nameSpace1');
// 연결했을때, news 라는 이벤트에 hello 객체를 담아 보낸다
nameSpace1.on('connection', (socket) => {
  nameSpace1.emit('news', {hello: "Someone connected at 1"});
});

const nameSpace2 = io.of('/nameSpace2');
nameSpace2.on('connection', (socket) => {
  nameSpace2.emit('news', {hello: "Someone connected at 2"});
});




server.listen(port, () => {
  console.log('server is up on port');
});


