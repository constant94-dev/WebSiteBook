

// 브라우저와 Node 환경에서 사용하는 Promise 기반의 HTTP Client로 
// 사이트의 HTML을 가져올 때 사용할 라이브러리 입니다.
const axios = require("axios");
// Node.js 환경에서 JQuery 처럼 DOM Selector 기능들을 제공합니다
// Axios의 결과로 받은 데이터에서 필요한 데이터를 추출하는데 사용하는 라이브러리 입니다
const cheerio = require("cheerio");
const mysql = require("mysql");

let cr_html = "";
let cr_image = "";
let cr_title = "";
let cr_author = "";
let cr_info = "";

// axios를 활용해 AJAX로 HTML 문서를 가져오는 함수 구현
async function getHTML() {
    try {
        return await axios.get("http://www.kyobobook.co.kr/categoryRenewal/categoryMain.laf?perPage=20&mallGb=KOR&linkClass=19&menuCode=002");

    } catch (error) {
        console.error(error);
    }
}

// getHTML 함수 실행 후 데이터에서
// div > ul > li > div > span > img
// 에 속하는 제목을 titleList에 저장
getHTML()
    .then(html => {
        let bookList = [];
        html.data.decode('utf-8');
        const $ = cheerio.load(html.data);

        // ul.list--posts를 찾고 그 children 노드를 bodyList에 저장
        const bodyList = $("div.prd_list_area ul.prd_list_type1").children("li.id_detailli");

        // bodyList를 순회하며 titleList에 div > span > img 의 내용을 저장
        bodyList.each(function (i, elem) {
            bookList[i] = {
                image: $(this).find("div.cover_wrap span img").attr('src'),
                title: $(this).find("div.detail div.title strong").text(),
                author: $(this).find("div.detail div.pub_info span.author").text(),
                info: $(this).find("div.detail div.info span").text()
            };
            cr_image = $(this).find("div.cover_wrap span img").attr('src');
            cr_title = $(this).find("div.detail div.title strong").text();
            cr_author = $(this).find("div.detail div.pub_info span.author").text();
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
        return bookList;
    })
    .then(res => console.log(res)); // 저장된 결과를 출력

