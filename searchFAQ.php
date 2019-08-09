<?php
// 데이터베이스 연결 설정하는 파일
include 'dbconfig/config.php';

// 검색어 변수 값 확인
if(isset($_GET['search'])){
    $search = $_GET['search'];
} else {
    $search = "";
}

//echo $search;

    /* 페이징 시작 */

	//페이지 get 변수가 있다면 받아오고, 없다면 1페이지를 보여준다.
	if(isset($_GET['page'])) {

		$page = $_GET['page'];

	} else {

		$page = 1;

	}

    // php 에러 발생시 출력해주는 코드
	error_reporting(E_ALL);

    ini_set("display_errors", 1);
    
    //$string = "Hello World ! <br/>";
    //echo $string;

    // bct_board 테이블에 검색어 관련된 전체 행 수
    $searchSQL = "SELECT count(*) AS cnt_search FROM bct_board WHERE title LIKE '%$search%' AND content LIKE '%$search%'";
    
    // 연결된 데이터베이스에 query를 보내는 명령어
	$result = $db->query($searchSQL);
    // 객체 지향 스타일 결과 집합에서 가져온 행을 나타내는 문자열의 연관 배열을 반환합니다   
    $row = $result->fetch_assoc();
    // FAQ 검색된 수
    $allFAQ = $row['cnt_search'];     

	$onePage = 5; // 한 페이지에 보여줄 게시글의 수.

	$allPage = ceil($allFAQ / $onePage); //전체 페이지의 수

	
    // 페이지 수가 1보다 작거나 or 전체 페이지 수보다 현재 페이지 수가 크다면 실행하는 조건
	if($page < 1 || ($allPage && $page > $allPage)) {

?>

		<script>

			alert("존재하지 않는 페이지입니다.");

			history.back();
			

		</script>

<?php

		exit;

	}

	

	$oneSection = 10; //한번에 보여줄 총 페이지 개수(1 ~ 10, 11 ~ 20 ...)

	$currentSection = ceil($page / $oneSection); //현재 섹션

	$allSection = ceil($allPage / $oneSection); //전체 섹션의 수

	

	$firstPage = ($currentSection * $oneSection) - ($oneSection - 1); //현재 섹션의 처음 페이지

	

	if($currentSection == $allSection) {

		$lastPage = $allPage; //현재 섹션이 마지막 섹션이라면 $allPage가 마지막 페이지가 된다.

	} else {

		$lastPage = $currentSection * $oneSection; //현재 섹션의 마지막 페이지

	}

	

	$prevPage = (($currentSection - 1) * $oneSection); //이전 페이지, 11~20일 때 이전을 누르면 10 페이지로 이동.

	$nextPage = (($currentSection + 1) * $oneSection) - ($oneSection - 1); //다음 페이지, 11~20일 때 다음을 누르면 21 페이지로 이동.

	

	$paging = '<ul class="pagination">'; // 페이징을 저장할 변수	

	//첫 페이지가 아니라면 처음 버튼을 생성

	if($page != 1) { 

		$paging .= '<li class="page-item"><a class="page-link" href="./searchResult.php?page=1">처음</a></li>';

	}

	//첫 섹션이 아니라면 이전 버튼을 생성

	if($currentSection != 1) { 

		$paging .= '<li class="page-item"><a class="page-link" href="./searchResult.php?page=' . $prevPage . '">이전</a></li>';

	}

	

	for($i = $firstPage; $i <= $lastPage; $i++) {

		if($i == $page) {

			$paging .= '<li class="page-item"><a class="page-link" href="./searchResult.php?page=' . $i . '&search='. $search . '">' . $i . '</a></li>';

		} else {

			$paging .= '<li class="page-item"><a class="page-link" href="./searchResult.php?page=' . $i . '&search='. $search . '">' . $i . '</a></li>';

		}

	}

	

	//마지막 섹션이 아니라면 다음 버튼을 생성

	if($currentSection != $allSection) { 

		$paging .= '<li class="page-item"><a class="page-link" href="./searchResult.php?page=' . $nextPage . '">다음</a></li>';

	}

	

	//마지막 페이지가 아니라면 끝 버튼을 생성

	if($page != $allPage) { 

		$paging .= '<li class="page-item"><a class="page-link" href="./searchResult.php?page=' . $allPage . '">끝</a></li>';

	}

	$paging .= '</ul>';

	

	/* 페이징 끝 */

	$currentLimit = ($onePage * $page) - $onePage; //몇 번째의 글부터 가져오는지

	$sqlLimit = ' limit ' . $currentLimit . ', ' . $onePage; //limit sql 구문

	$searchSQL = "SELECT * FROM bct_board WHERE title LIKE '%$search%' AND content LIKE '%$search%' ORDER BY id DESC" . $sqlLimit; //원하는 개수만큼 가져온다. (0번째부터 5번째까지)

    $searchResult = $db->query($searchSQL);

    $total_rows = mysqli_num_rows($searchResult);
   
    ?>
    <!DOCTYPE html>

<html>

<head>

	<meta charset="utf-8" />

	<title>자유게시판 | BCT Library</title>

	<!-- 반응형 웹을 선언하는 명령어 -->
    <meta content="width=device-width, initial-scale=1" name="viewport"/>
        <!-- 부트스트랩 4.3.1 버전 css 파일 -->
        <link href="css/bootstrap.min.css" rel="stylesheet"/>

        <style type="text/css">
            /* FAQ 텍스트 css */
            #faq-head {
				margin-top:100px;
				margin-bottom: 100px;
                color: black;
                text-align: center;
                margin: 100px;
                font-family: cursive;
			}
            /* 글쓰기 버튼 css */
			#faq-write{
				margin: 10px;
				float:right;
               
			}
            /* 테이블 헤드 및 내용 css */            
            th,
            td {
                text-align: center !important;
            }
            /* 페이징 번호 css */
			.paging {
				margin-bottom: 200px;
			}
             /* 게시글 제목 css */
			#faq-title {
				text-decoration: none;
                color: #333;
			}
            /* 게시글 제목에 마우스 올렸을 때 css */
            #faq-title:hover {
                text-decoration: underline;				
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
            /* 상세 검색 전체 틀 css */
            .btn-box {
                text-align:center;                
                margin: 10px;
            }
            /* 상세검색 버튼 틀 css */
			.btn-group {
                border: 1px solid #000000;
                padding: 10px;
                width: 800px;
                
            }
        </style>
</head>

<body>
<!-- 상단에 고정된 헤더 파일 include -->
<div id="headers"></div>

		<!-- FAQ 전체 틀 시작 -->
		<div class="container-fluid">

            <?php 
            // FAQ 검색 결과 없을 때
            if($allFAQ == 0){
                
            
            ?>

        <!-- 상세 검색 틀 시작 -->
        <div class="btn-box">

        <div class="btn-group">

        <!-- 상세 검색 드랍다운 버튼 시작 -->
        <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-expanded="false" id="search-status">FAQ</button>  
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
            // FAQ 검색 결과 있을 때
            else if($allFAQ != 0){?>

        <!-- 상세 검색 틀 시작 -->
        <div class="btn-box">
        <div class="btn-group">

        <!-- 상세 검색 드랍다운 버튼 시작 -->
        <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-expanded="false" id="search-status">FAQ</button>  
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

            
            <h3 id="faq-head">FAQ</h3>
            <!-- 글 쓰기 버튼 시작 -->
            <div id="faq-write">
                <a href="faqInsert.php" class="btn btn-primary">글쓰기</a>                
            <!-- 글 쓰기 버튼 끝 -->
            </div>
            
            <!-- 게시글 출력 테이블 시작 -->
			<table class="table table-hover">    

				<thead>

					<tr>

						<th scope="col" class="no">번호</th>

						<th scope="col" class="title">제목</th>

						<th scope="col" class="author">작성자</th>

						<th scope="col" class="date">작성일</th>

						<th scope="col" class="hit">조회</th>

					</tr>

				</thead>

				<tbody>

						<?php
                            // 데이터베이스에서 가져온 결과 출력하는 반복문
							while($row = $searchResult->fetch_assoc())

							{
                                
						?>

					<tr>

						<td class="id"><?php echo $row['id']?></td>

						<td class="title">

							<a id="faq-title" href="faqboard.php?board_num=<?php echo $row['id']?>"><?php echo $row['title']?></a>
                            <a id="faq-title" href="faqboard.php?board_num=<?php echo $row['id']?>"><?php echo "[" . $row['comment_total'] . "]"?></a>

						</td>

						<td class="user"><?php echo $row['user']?></td>

						<td class="created"><?php echo $row['created']?></td>

						<td class="hit"><?php echo $row['hit']?></td>

					</tr>

						<?php

							}

						?>

				</tbody>

            <!-- 게시글 출력 테이블 끝 -->
			</table>

            <!-- 페이징 번호 보여주는 div 시작 -->
			<div class="paging">

                <?php echo $paging?>
                
			<!-- 페이징 번호 보여주는 div 끝 -->
			</div>            
                        <?php } // FAQ 검색 결과 있을 때 조건 끝?>
                        
        <!-- FAQ 전체 틀 끝 -->
        </div>
        
        <!-- 하단에 고정된 푸터 파일 include -->
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