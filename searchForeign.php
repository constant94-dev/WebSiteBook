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

// bct_foreign_crawl 테이블에 검색어 관련된 전체 행
$sql = $db->query("SELECT * FROM bct_foreign_crawl WHERE title LIKE '%$search%' OR author LIKE '%$search%'"); ?> 
<!DOCTYPE html>
<html>
<head>
<title>BCT 외국도서 페이지</title>
<!-- 반응형 웹을 선언하는 명령어 -->
<meta name="viewport" content="width=device-width, initial-scale=1"/>
<!-- 부트스트랩 4.3.1 버전 css 파일 -->
<link rel="stylesheet" href="css/bootstrap.min.css"/>
<style type="text/css">
        /* 책 이미지 css */
        .book_image {
            width: 200px;
            height: 200px;
        }
        /* 전체 틀 css */
        .container {
            margin-top:100px;
            margin-bottom: 100px;
        }
        /* 본문 상단 제목 css */
        .domestic-category {
            margin-top: 100px;
            margin-bottom: 100px;
        }
        /* 인피니티 스크롤 로딩 이미지 css */
        .load-post {
            text-align: center;
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
<!-- 국내도서 전체 틀 시작 -->
<div class="container">
	<?php
// foreign 검색 결과 없을 때
if ($sql->num_rows == 0) { ?> 
	<!-- 상세 검색 틀 시작 -->
	<div class="btn-box">
		<div class="btn-group">
			<!-- 상세 검색 드랍다운 버튼 시작 -->
			<button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-expanded="false" id="search-status">외국도서</button>
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
	<?php
}
// foreign 검색 결과 있을 때
else { ?>
	<!-- 상세 검색 틀 시작 -->
	<div class="btn-box">
		<div class="btn-group">
			<!-- 상세 검색 드랍다운 버튼 시작 -->
			<button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-expanded="false" id="search-status">외국도서</button>
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
	<div class="domestic-category">
		<h2>외국도서 경제/경영</h2>
	</div>
    <?php
    // 데이터베이스에서 가져온 웹툰 정보를 출력하기 위한 반복문
    while ($data = $sql->fetch_assoc()) { 
        // 크롤링한 데이터 링크걸기 위한 변수
        $link = $data['link'];
        // 문자열 값 ',' 기준으로 나눈다
        $pattern = "',";
        // 내가 정한 기준으로 나눈 문자열 값
        $jbexplode = explode($pattern,$link);
        // 문자열 값 ' 기준으로 나눈다
        $pattern2 = "'";
        // 내가 정한 기준으로 나눈 문자열 값
        $linkClass = explode($pattern2,$jbexplode[1]);
        $barcode = explode($pattern2,$jbexplode[2]);
        ?> 
	<!-- row 시작 -->
	<div class="row">
		<!-- best-list 시작 -->
		<div class="best-list">
			<ul class="list-group">
				<li>
				<div>
					<!-- 리스트 아이템 한줄 시작 -->
					<div class="info_area">
						<!-- 책 이미지 틀 시작 -->
						<div class="cover_wrap" style="float:left;">
							<div class="cover">
								<img src="<?php echo $data['image'] ?>" class="book_image">
							</div>
							<!-- 책 이미지 틀 끝 -->
						</div>
						<!-- 책 상세 정보 시작 -->
						<div class="detail" style="margin-left: 220px; margin-top: 10px;">
							<div class="book_title">
                                <a href="<?php echo 'http://www.kyobobook.co.kr/product/detailViewEng.laf?mallGb=ENG&ejkGb=ENG&linkClass=' . $linkClass[1] . '&barcode=' . $barcode[1] ?>">                                
								<strong><?php echo $data['title'] ?></strong>
								</a>
							</div>
							<div class="book_info">
								<span class="author"><?php echo $data['author'] ?>
								</span>
							</div>
							<div class="summary_info">
								<span><?php echo $data['info'] ?>
								</span>
							</div>
							<!-- 책 상세 정보 끝 -->
						</div>
						<!-- 리스트 아이템 한줄 끝 -->
					</div>
				</div>
				</li>
			</ul>
			<!-- best-list 끝 -->
		</div>
		<!-- row 끝 -->
	</div>
	<?php
    } // 반복문 끝
} // foreign 검색 결과 있을 때 조건 끝 ?>

<!-- 국내도서 전체 틀 끝 -->
</div>

<!-- 상단에 고정된 푸터 파일 include -->
<div id="footers"></div>

<!-- 부트스트랩 4 버전 부터는 jQuery, popper 파일을 함께 적용시켜야 한다 -->
<!-- 제이쿼리 3.4.1 버전 js 파일 -->
<script src="js/jquery-3.4.1.min.js"></script>
<!-- popper 1.15.0 버전 js 파일 -->
<script src="js/popper.min.js"></script>
<!-- 부트스트랩 4.3.1 버전 js 파일 -->
<script src="js/bootstrap.min.js"></script>
<script type="text/javascript">
        // html 구조 다 불러오고 실행하는 함수
        $(document).ready(function () {
            $("#headers").load("header.php");  // 원하는 파일 경로를 삽입하면 된다
            $("#footers").load("footer.php");  // 추가 인클루드를 원할 경우 이런식으로 추가하면 된다            
        }); // document.ready 끝
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