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
    // console.log(name + " was disconnected");
    // socket.broadcast.emit("leave_chat", name);
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



//////////// 크롤링
const axios = require("axios");
const cheerio = require("cheerio");
const iconv = require("iconv-lite");
// const jsdom = require("jsdom");
// const { JSDOM } = jsdom;
const fs = require('fs');

// 여행/레저 관련 뉴스를 크롤링할 페이지 url
let url = "https://news.naver.com/main/list.nhn?mode=LS2D&mid=shm&sid1=103&sid2=237";

// axios 를 이용한 웹페이지 크롤링
const getHtml = async (url, callback) => {
    try {
        return await axios({
            url: url,
            method: "GET",
            responseType: "arraybuffer"
        })
    } catch (error) {
        console.log(error);
    }
};


setInterval(function() {

    getHtml(url)
    .then(html => {
        const $ = cheerio.load(html.data);
        const pageButtonList = $('div.paging').children();
        // 전체 페이지 수
        let totalPage = pageButtonList.length;
        return totalPage;
     })
    // 모든 페이지를 크롤링하여 뉴스 데이터를 리스트에 저장하기
    .then (totalPage => {
        // 크롤링한 뉴스 데이터를 담을 리스트
        let newsList = new Array();

            // url 에 들어갈 현재 날짜 구하기 (YYYYMMDD)
        let date = new Date(); 
        let year = date.getFullYear(); 
        let month = new String(date.getMonth()+1); 
        let day = new String(date.getDate()); 
            
        if(month.length == 1){ 
            month = "0" + month; 
        } 
        if(day.length == 1){ 
            day = "0" + day; 
        } 
        let todayDate = year + "" + month + "" + day;

        for (let i = 0; i < totalPage; i++) {
            // 1페이지부터 마지막페이지까지 크롤링
            let url = "https://news.naver.com/main/list.nhn?mode=LS2D&mid=shm&sid2=237&sid1=103&date="
            + todayDate + "&page=" 
            + (i + 1);

            getHtml(url)
            .then(html => {
                // 크롤링하는 사이트의 인코딩 방식(EUC-KR)으로 변환해준다
                // VScode에서 기본적으로 UTF-8 로 인코딩하기 때문에 한글이 깨지기 때문
                const decodedHtml = iconv.decode(html.data, 'EUC-KR');
                const $ = cheerio.load(decodedHtml);
                // console.log($.html()); //전체 html 확인

                // 기사에서 필요한 정보를 담는 객체를 만들어 newsList 에 저장한다
                const liList = $('ul.type06_headline').children('li');
                liList.each(function(j, element) {
                        
                    let newsCount = 10;
                    let index = (newsCount * i) + j;

                    newsList[index] = {
                        id: index + 1,
                        title: $(this).find('dl dt a').text(),
                        link: $(this).find('dl dt a').attr('href'),
                        content: $(this).find('dl dd span.lede').text()
                    }
                });
            })
        }
        // 파일을 저장하는데 1초간의 딜레이를 줌으로써 비동기방식으로 인한 문제를 해결하였으나, 임시방편임
        setTimeout(function() {
            const data = JSON.stringify(newsList);
            fs.writeFile('/var/www/web/tourlist.json', data, 'utf8', function(err) {
                // console.log(data);
            });
        }, 1000); 
    })    
}, 20000);


