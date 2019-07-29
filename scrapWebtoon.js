
// 가져온 HTML문서 중 필요로 하는 정보를 추출하는 역할을 하며, jQuery방식의 셀렉터를 사용합니다.
let cheerio = require('cheerio');
// URL에 해당하는 HTML 문서를 통째로 가져오는 역할
let request = require('request');
// 인코딩 문제 해결
const iconv = require('iconv-lite');
var connection = require('./config.js');
const mysql = require('mysql');
let requestOptions = {
    method: "GET",
    uri: "https://comic.naver.com/webtoon/weekday.nhn",
    headers: { "User-Agent": "Mozilla/5.0" },
    encoding: null
};

if(connection.db){
    console.log("데이터베이스 연결 성공!");
}

let url = "https://comic.naver.com/webtoon/weekday.nhn";

// 선언한 url 로 접근하여 html 문서를 가져오는 기능
request(url, function (error, response, body) {
    // 문서를 가져오는데 성공했다면 실행하는 조건
    if (!error) {
        console.log("request 성공!");
        // 전달받은 결과를 EUC-KR로 디코딩하여 출력한다. 
        //let strContents = new Buffer.from(body);
        //const htmlDoc = iconv.decode(strContents, 'UTF-8').toString();

        // html 문서 로드
        let $ = cheerio.load(body);
        // html 태그 값 저장할 변수
        let bookList = [];

        // .list_area .col_selected li 를 찾고 그 children 노드를 bodyList에 저장
        const bodyList = $(".list_area .col_selected li");

        // bodyList 에 선언한 태그로 접근하여 필요한 데이터 반복하여 가져오기
        bodyList.each(function (i) {
            bookList[i] = {
                // 웹툰 링크 주소
                webtoonLink: $(this).find(".thumb a").attr('href'),
                // 웹툰 이미지
                webtoonImage: $(this).find(".thumb a img").attr('src'),
                // 웹툰 제목
                webtoonTitle: $(this).find("li .title").attr('title')
            };
            // 웹툰 링크 주소
            let webtoonLink = $(this).find(".thumb a").attr('href');
            // 웹툰 이미지
            let webtoonImage = $(this).find(".thumb a img").attr('src');
            // 웹툰 제목
            let webtoonTitle = $(this).find("li .title").attr('title');           

            var sql = 'INSERT INTO bct_webtoon_crawl (webtoonLink, webtoonImage, webtoonTitle) VALUES(?,?,?)';
            var params = [webtoonLink, webtoonImage, webtoonTitle];
            // SQL문 실행
            connection.db.query(sql, params, function (err, rows, fields) {
                if (err) {
                    console.log(err);
                } else {
                    console.log("SQL 실행 성공! ");
                }
            });
            
        });

        //bodyList 에 저장된 데이터 콘솔에 출력하는 반복문
        for (let i = 0; i < bookList.length; i++) {

            console.log(bookList[i]);

        }


    }
    if(error) {
        console.log("error");
    }
    // mysql 종료
    connection.db.end();

});

