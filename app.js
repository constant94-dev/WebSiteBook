// express 모듈을 로드한다
const app = require('express')();
// http 모듈을 로드한다
// createServer() 컴퓨터에 서버를 만든다
// createServer() 인자값은 서버 요청이 있을 때마다 실행할 기능
const http = require('http').createServer(app);
// socket.io 모듈을 로드한다
// 소켓 서버를 기존의 http 서버에 연결하고 있습니다
const io = require('socket.io')(http);
// express 객체를 담고있는 app 변수는 http 메소드를 가지고 있다
// req -> 요청 객체 res -> 응답 객체
// 접속시 클라이언트 앱을 뿌려주기 위한, 기본 라우팅을 생성한다
// 다음의 라우트 경로는 요청을 루트 라우트 '/' 에 일치시킵니다.
// 라우트 경로는, 요청 메소드와의 조합을 통해, 
// 요청이 이루어질 수 있는 엔드포인트를 정의합니다. 
// 라우트 경로는 문자열, 문자열 패턴 또는 정규식일 수 있습니다.
app.get('/', (req, res) => {
    // 파일 다운로드로 응답
    res.sendFile(__dirname + '/socket.html');
    // res.send() -> 문자열로 응답
    // res.json() -> 제이슨 객체로 응답
    // res.render() -> 제이드 템플릿을 랜더링
});
// io는 socket.io 패키지를 import한 변수
// 이미 예약된 이벤트가 존재한다 -> disconnect, connection
// emit() -> 이벤트 전달 기능
// on() -> 이벤트 받는 기능
io.on('connection', (socket) => {
    
  console.log('a user connected');
  // socket은 연결이 성공했을 때 연결에 대한 정보를 담고 있는 변수
  // 서버에서 받을 이벤트 명, 데이터
  socket.on('chat message', (msg) => {
      // 서버로 보낼 이벤트 명, 데이터
    io.emit('chat message', msg);
  });
  
  socket.on('disconnect', () => {
      
  console.log('user disconnected');
  });
});
http.listen(8888, () => {
    // 리눅스 터미널 창에 출력
  console.log('Connected at 8888');
});
