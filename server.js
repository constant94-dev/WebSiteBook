// var, let 는 변수를 선언하는 키워드
// const 는 상수를 선언하는 키워드
// var, let 는 값 재할당이 가능하다
// const 는 값 재할당이 불가능하다, 선언과 동시에 값을 할당해야 한다
// const 키워드를 사용하여 식별자를 선언하고, 값이 변하는 식발자일 경우 let 키워드
// 식별자(identifier) -> 변수의 이름, 상수의 이름, 함수의 이름 등 '이름'을 일반화 해서 지칭하는 용어
// 리터럴(liternal) -> '값' 그 자체, 고정된 값을 의미
// 'a = 7' -> a는 식별자 7은 리터럴
const express = require('express');
const app = require('express')();
//var fs = require('fs');
const http = require('http').Server(app);
const io = require('socket.io')(http);

// 템플릿을 렌더링하려면 설정이 필요하다
// 사용할 템플릿 엔진 로드
app.set('view engine', 'ejs');
// views 템플릿이 있는 디렉토리
app.set('views', './views');


let room = ['국내도서', '외국도서', '웹툰'];
let a = 0;



// view 파일의 확장자가 지정이 되어있다면 확장자를 생략할 수 있다
// 홈 페이지에 대한 요청을 실행할 때, chat.ejs 파일은 HTML 형식으로 렌더링 된다
app.get('/', function (req, res) {   
    // fs.readFile('index.html',function(error, data){
    //     res.writeHead(200,{'Content-Type':'text/html'});
    //     res.end(data);
    // });
    res.render('chat');
    
  
});

// on()은 소켓에서 해당 이벤트를 받으면 콜백함수가 실행된다
// on은 수신, emit은 전송이라고 생각하면 된다
io.on('connection', (socket) => {
    console.log('유저 접속 됨');
  socket.on('disconnect', () => {
    console.log('유저 접속 종료');
  });


  socket.on('leaveRoom', (num, name) => {
      // 채팅방에서 나가는 기능
    socket.leave(room[num], () => {
      console.log(name + ' leave a ' + room[num]);
      io.to(room[num]).emit('leaveRoom', num, name);
    });
  });


  socket.on('joinRoom', (num, name) => {
      // 채팅방에 들어가는 기능
    socket.join(room[num], () => {
      console.log(name + ' join a ' + room[num]);
      io.to(room[num]).emit('joinRoom', num, name);
    });
  });


  socket.on('chat message', (num, name, msg) => {
    a = num;
    io.to(room[a]).emit('chat message', name, msg);
  });
});


http.listen(8888, () => {
  console.log('서버 실행 중..');
});
