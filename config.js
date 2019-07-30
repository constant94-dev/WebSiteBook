var mysql = require('mysql');

var db = mysql.createConnection({
    host: 'localhost',
    port: '3306',
    user: 'psj', // DB 계정
    password: 'permissionchmodchown', // DB 계정 비밀번호
    database: 'bct' // 접속할 DB
});

//db.connect();
module.exports.db = db;