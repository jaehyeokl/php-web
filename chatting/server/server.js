// 서버 실행
const path = require('path');
const http = require('http');
const express = require('express');
const socketIO = require('socket.io');

const publicPath = path.join(__dirname, '/../public/');
const port = process.env.PORT || 3000
let app = express();
let server = http.createServer(app);
let io = socketIO(server);

// 서버의 루트경로를 세팅한다
app.use(express.static(publicPath));

// 클라이언트 소켓 연결
io.on('connection', (socket) => {
  console.log("A new user just connected");

  // 클라이언트가 접속을 끊었을때 이벤트
  socket.on('disconnect', () => {
    console.log("User was disconnected");
  });

});


server.listen(port, () => {
  console.log('server is up on port');
});


