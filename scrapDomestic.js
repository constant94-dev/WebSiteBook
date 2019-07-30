// 가져온 HTML문서 중 필요로 하는 정보를 추출하는 역할을 하며, jQuery방식의 셀렉터를 사용합니다.
let cheerio = require('cheerio');
// URL에 해당하는 HTML 문서를 통째로 가져오는 역할
let request = require('request');
// 인코딩 문제 해결
const iconv = require('iconv-lite');
// 데이터베이스 연결 모듈 불러오기
const connection = require('./config.js');

let requestOptions = {
    method: "GET",
    uri: "http://www.kyobobook.co.kr/categoryRenewal/categoryMain.laf?perPage=20&mallGb=KOR&linkClass=33&menuCode=002",
    headers: { "User-Agent": "Mozilla/5.0" },
    encoding: null
};

if(connection.db){
    console.log("데이터베이스 연결 성공!");
}



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
                title: $(this).find("div.detail div.title a strong").text(),
                // 책 글쓴이
                author: $(this).find("div.detail div.pub_info span.author").text(),
                // 책 요약정보
                info: $(this).find("div.detail div.info span").text(),
                // 책 링크 정보
                link: $(this).find(".cover_wrap .cover a").attr('href')
            };
            // 책 이미지 경로
            let cr_image = $(this).find("div.cover_wrap span img").attr('src');
            // 책 제목 텍스트
            let cr_title = $(this).find("div.detail div.title strong").text();
            // 책 글쓴이 텍스트
            let cr_author = $(this).find("div.detail div.pub_info span.author").text();
            // 책 요약 정보 텍스트
            let cr_info = $(this).find("div.detail div.info span").text();
            // 책 링크 정보
            let cr_link = $(this).find(".cover_wrap .cover a").attr('href');
                   
            
            var sql = 'INSERT INTO bct_domestic_crawl (image, title, author, info, link) VALUES(?,?,?,?,?)';
            var params = [cr_image, cr_title, cr_author, cr_info, cr_link];
            // SQL문 실행
            connection.db.query(sql, params, function (err, rows, fields) {
                if (err) {
                    console.log(err);
                } else {
                    console.log("SQL 실행 성공! ");
                }
            });
            
        });

        // bodyList 에 저장된 데이터 콘솔에 출력하는 반복문
        for (let i = 0; i < bookList.length; i++) {

            console.log(bookList[i]);

        }


    }
// mysql 종료
connection.db.end();
});



