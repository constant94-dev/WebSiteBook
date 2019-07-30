// node.js 에 존재하는 mysql 모듈 불러오기
const mysql = require('mysql');

// 데이터베이스 연동하는 명령어
let db = mysql.createConnection({
    host: 'localhost',
    port: '3306',
    user: 'psj', // DB 계정
    password: 'permissionchmodchown', // DB 계정 비밀번호
    database: 'bct' // 접속할 DB
});

//db.connect();
// 자바스크립트에 선언된 변수를 전역에서 사용하기 위해서는 module.exports 를 선언해야한다
module.exports.db = db;