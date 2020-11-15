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


  // 특정 클라이언트로 부터 채팅에 참여할 이름을 전달받아
  // 전체 클라이언트에게 전달한다
  socket.on("join_chat", (name) => {
    console.log("join user is " + name);
    io.emit("join_chat", name);
  });

  // 특정 클라이언트로 부터 채팅 메세지를 전달받아
  // 해당 클라이언트를 제외한 나머지 클라언트 전체에 메세지를 전달한다
  // 메세지를 보낼때 클라이언트 자체적으로 메세지를 화면에 표시하기 때문에
  socket.on("send_message", (data) => {
    console.log("message : " + data.name + " : " + data.message);
    socket.broadcast.emit("send_message", data);
  });

});


server.listen(port, () => {
  console.log('server is up on port');
});


