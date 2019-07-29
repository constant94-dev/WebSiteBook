// iconv-lite 를 이용하여 한글이 깨져서 출력될때 수정하는 방법 
var request = require("request");
var cheerio = require('cheerio');
var iconv = require('iconv-lite');
var requestOptions = {
    method: "GET", 
    uri: "http://news.naver.com/main/list.nhn?mode=LS2D&mid=shm&sid1=105&sid2=731", 
    headers: { "User-Agent": "Mozilla/5.0" }, 
    encoding: null
};

// request 모듈을 이용하여 html 요청 
request(requestOptions, function (error, response, body) {
    // 전달받은 결과를 EUC-KR로 디코딩하여 출력한다. 
    var strContents = new Buffer(body); 
    console.log(iconv.decode(strContents, 'EUC-KR').toString());
});

