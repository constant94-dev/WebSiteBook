<?php
session_start();
if(!isset($_SESSION['user_email']) || !isset($_SESSION['user_name'])){
    echo "<script>
    alert('잘못된 접근입니다');
    location.replace('index.html');
    </script>";
}

include 'dbconfig/config.php';

// 검색어 변수 값 확인
if (isset($_GET['search'])) {
    $search = $_GET['search'];
} else {
    $search = "";
}
//echo $search;
// bct_webtoon_crawl 테이블에 검색어 관련된 전체 행
$sql = $db->query("SELECT * FROM bct_webtoon_crawl WHERE webtoonTitle LIKE '%$search%'"); ?> 
<!DOCTYPE html>
<html>
<head>
<title>BCT 웹툰 페이지</title>
<!-- 반응형 웹을 선언하는 명령어 -->
<meta name="viewport" content="width=device-width, initial-scale=1"/>
<!-- 부트스트랩 4.3.1 버전 css 파일 -->
<link rel="stylesheet" href="/css/bootstrap.min.css"/>
<style type="text/css">
        /* 웹툰 이미지 css */
        .webtoon-image {
            width: 150px;
            height: 200px;
            border-right: 1px dotted #000000;
            border-bottom: 1px dotted #000000;            
        }
        /* 웹툰 이미지, 제목 틀 css */
        .box {            
            text-align: center;
            margin-bottom: 100px;
            margin-right:30px;
        }
        /* 전체 틀 css */
        .container {
            height: 750px;
            margin-top:100px;
            margin-bottom: 100px;
        }
        /* h2 전체 태그 css */
        h2{
            font-family: 'Jua', sans-serif;
        }
        /* span 전체 태그 css */
        span {
            font-family: 'Jua', sans-serif;
        }
        /* 본문 상단 제목 css */
        .head-title {
            margin-top: 50px;
            margin-bottom: 50px;
        }
        /* 상세 검색 전체 틀 css */
        .btn-box {
                text-align:center;
                margin: 10px;
        }
        /* 상세 검색 버튼 틀 css */
		.btn-group {
                border: 1px solid #000000;
                padding: 10px;
                width: 800px;               
        }
        /* 검색 결과 없을 때 보여주는 div css */
        #searchNoBox {
                text-align: center;
        }
        /* 검색 결과 없을 때 보여주는 image css */
        #searchNoImage {
                width: 400px;
                height: 500px;
                margin-top: 100px;
                margin-bottom: 100px;
        }
        /* 검색 결과 없을 때 보여주는 text css */
        #searchNoText {
                font-family: cursive;
                margin-bottom: 100px;
        }
        /* 데이터베이스에서 가져온 결과 값 출력 하는 ul 틀 css */
        .list-group {
            list-style-type: none;
        }
</style>
</head>
<body>
<!-- 상단에 고정된 헤더 파일 include -->
<div id="headers">
</div>
<!-- 웹툰 전체 틀 시작 -->
<div class="container">
	<?php
// foreign 검색 결과 없을 때
if ($sql->num_rows == 0) { ?> 
	<!-- 상세 검색 틀 시작 -->
	<div class="btn-box">
		<div class="btn-group">
			<!-- 상세 검색 드랍다운 버튼 시작 -->
			<button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-expanded="false" id="search-status">웹툰</button>
			<ul class="dropdown-menu" role="menu" id="search-select">
				<li><a href="#">국내도서</a></li>
				<li><a href="#">외국도서</a></li>
				<li><a href="#">웹툰</a></li>
				<li><a href="#">FAQ</a></li>
				<!-- 상세 검색 드랍다운 버튼 끝 -->
			</ul>
			<input class="form-control mr-sm-2" type="search" placeholder="Search" name="search" id="reSearch">
			<button class="btn btn-outline-success my-2 my-sm-0" type="button" id="search-submit">Search</button>
		</div>
		<!-- 상세 검색 틀 끝 -->
	</div>
	<div id="searchNoBox">
		<img src="image/searchImage.png" id="searchNoImage">
		<h3 id="searchNoText">죄송합니다 요청하신 검색어는 존재하지 않습니다.</h3>
	</div>
    <?php } 
    // foreign 검색 결과 있을 때
    else {?>
	<!-- 상세 검색 틀 시작 -->
	<div class="btn-box">
		<div class="btn-group">
			<!-- 상세 검색 드랍다운 버튼 시작 -->
			<button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-expanded="false" id="search-status">웹툰</button>
			<ul class="dropdown-menu" role="menu" id="search-select">
				<li><a href="#">국내도서</a></li>
				<li><a href="#">외국도서</a></li>
				<li><a href="#">웹툰</a></li>
				<li><a href="#">FAQ</a></li>
				<!-- 상세 검색 드랍다운 버튼 끝 -->
			</ul>
			<input class="form-control mr-sm-2" type="search" placeholder="Search" name="search" id="reSearch">
			<button class="btn btn-outline-success my-2 my-sm-0" type="button" id="search-submit">Search</button>
		</div>
		<!-- 상세 검색 틀 끝 -->
	</div>
	<div class="head-title">
		<h2>오늘의 웹툰</h2>
	</div>
	<?php
            // 데이터베이스에서 가져온 웹툰 정보를 출력하기 위한 반복문
			while($row = $sql->fetch_assoc()){ ?> 
	<!-- 웹툰 이미지 틀 시작 -->
	<div>
		<div style="float: left;" class="box">
			<div>
				<a href="https://comic.naver.com/<?php echo $row['webtoonLink'] ?>"><img src="<?php echo $row['webtoonImage'] ?>" class="webtoon-image"></a>
			</div>
			<span><?php echo $row['webtoonTitle'] ?>
			</span>
		</div>
		<!-- 웹툰 이미지 틀 끝 -->
	</div>
	<?php
            } // 반복문 끝
			} // foreign 검색 결과 있을 때 조건 끝
        ?>
        
<!-- 웹툰 전체 틀 끝 -->
</div>

<!-- 상단에 고정된 푸터 파일 include -->
<div id="footers"></div>

<!-- 부트스트랩 4 버전 부터는 jQuery, popper 파일을 함께 적용시켜야 한다 -->
<!-- 제이쿼리 3.4.1 버전 js 파일 -->
<script src="/js/jquery-3.4.1.min.js"></script>
<!-- popper 1.15.0 버전 js 파일 -->
<script src="/js/popper.min.js"></script>
<!-- 부트스트랩 4.3.1 버전 js 파일 -->
<script src="/js/bootstrap.min.js"></script>
<script type="text/javascript">
        // html 구조 다 불러오고 실행하는 함수
        $(document).ready(function () {
            $("#headers").load("/header.php");  // 원하는 파일 경로를 삽입하면 된다
            $("#footers").load("/footer.php");  // 추가 인클루드를 원할 경우 이런식으로 추가하면 된다
        });
        // 검색할 카테고리 클릭 이벤트
        $('#search-select li > a').on('click', function() {
            // 버튼에 선택된 항목 텍스트 넣기 
            $('#search-status').text($(this).text());   
        });
        // 검색할 카테고리 값과 검색어 입력후 버튼 클릭 이벤트
        $('#search-submit').on('click', function() {
            let category = $('#search-status').text();
            //alert("선택한 카테고리 / "+category);
            if(category == '국내도서'){
                // 국내도서 페이지로 ~
                //alert("선택한 카테고리 / "+category);
                var domesticResearch = $('#reSearch').val();
                //alert("재입력한 검색어 / "+faqResearch);
                location.href="searchDomestic.php?search="+domesticResearch;
            } else if(category == '외국도서'){
                // 외국도서 페이지로 ~
                //alert("선택한 카테고리 / "+category);
                var foreignResearch = $('#reSearch').val();
                //alert("재입력한 검색어 / "+faqResearch);
                location.href="searchForeign.php?search="+foreignResearch;                
            } else if(category == '웹툰'){
                // 웹툰 페이지로 ~
                //alert("선택한 카테고리 / "+category);
                var webtoonResearch = $('#reSearch').val();
                //alert("재입력한 검색어 / "+faqResearch);
                location.href="searchWebtoon.php?search="+webtoonResearch;
            } else {
                // FAQ 페이지로 ~
                //alert("선택한 카테고리 / "+category);
                var faqResearch = $('#reSearch').val();
                //alert("재입력한 검색어 / "+faqResearch);
                location.href="searchFAQ.php?search="+faqResearch;
            }
        });
    </script>
</body>
</html>