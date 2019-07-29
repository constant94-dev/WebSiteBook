// 가져온 HTML문서 중 필요로 하는 정보를 추출하는 역할을 하며, jQuery방식의 셀렉터를 사용합니다.
let cheerio = require('cheerio');
// URL에 해당하는 HTML 문서를 통째로 가져오는 역할
let request = require('request');
// 인코딩 문제 해결
const iconv = require('iconv-lite');
const mysql = require("mysql");
let requestOptions = {
    method: "GET",
    uri: "http://www.kyobobook.co.kr/categoryRenewal/categoryMain.laf?perPage=20&mallGb=KOR&linkClass=33&menuCode=002",
    headers: { "User-Agent": "Mozilla/5.0" },
    encoding: null
};



// 선언한 url 로 접근하여 html 문서를 가져오는 기능
request(requestOptions, function (error, response, body) {
    // 문서를 가져오는데 성공했다면 실행하는 조건
    if (!error) {
        // 전달받은 결과를 EUC-KR로 디코딩하여 출력한다. 
        let strContents = new Buffer.from(body);
        const htmlDoc = iconv.decode(strContents, 'EUC-KR').toString();

        // html 문서 로드
        let $ = cheerio.load(htmlDoc);
        // html 태그 값 저장할 변수
        let bookList = [];

        // div.prd_list_area ul.prd_list_type1를 찾고 그 children 노드를 bodyList에 저장
        const bodyList = $("div.prd_list_area ul.prd_list_type1").children("li.id_detailli");

        // bodyList 에 선언한 태그로 접근하여 필요한 데이터 반복하여 가져오기
        bodyList.each(function (i) {
            bookList[i] = {
                // 책 이미지
                image: $(this).find("div.cover_wrap span img").attr('src'),
                // 책 제목
                title: $(this).find("div.detail div.title a strong").text().trim(),
                // 책 글쓴이
                author: $(this).find("div.detail div.pub_info span.author").text(),
                // 책 요약정보
                info: $(this).find("div.detail div.info span").text().trim()
            };
            // 책 이미지 경로
            cr_image = $(this).find("div.cover_wrap span img").attr('src');
            // 책 제목 텍스트
            cr_title = $(this).find("div.detail div.title strong").text();
            // 책 글쓴이 텍스트
            cr_author = $(this).find("div.detail div.pub_info span.author").text();
            // 책 요약 정보 텍스트
            cr_info = $(this).find("div.detail div.info span").text();

            // 비밀번호는 별도의 파일로 분리해서 버전관리에 포함시키지 않아야 합니다. 
            var connection = mysql.createConnection({
                host: 'localhost',
                port: '3306',
                user: 'psj', // DB 계정
                password: 'permissionchmodchown', // DB 계정 비밀번호
                database: 'bct' // 접속할 DB
            });
            // mysql 접속
            connection.connect();
            // SQL문 실행
            connection.query("INSERT INTO bct_bestseller_crawl(image, title, author, info) VALUES('" + cr_image + "','" + cr_title + "','" + cr_author + "','" + cr_info + "')", function (error, results, fields) {
                // 에러 발생시
                if (error) {
                    console.log(error);
                }
                // 실행 성공
                console.log(results);
            });
            // mysql 종료
            connection.end();
        });

        // bodyList 에 저장된 데이터 콘솔에 출력하는 반복문
        for (let i = 0; i < bookList.length; i++) {

            console.log(bookList[i]);

        }


    }

});



