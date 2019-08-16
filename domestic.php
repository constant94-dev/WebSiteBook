<?php
session_start();
if(!isset($_SESSION['user_email']) || !isset($_SESSION['user_name'])){
    echo "<script>
    alert('잘못된 접근입니다');
    location.replace('index.html');
    </script>";
}

include 'dbconfig/config.php';
?>
<!DOCTYPE html>
<html>

<head>
    <title>BCT 국내도서 페이지</title>
    <!-- 반응형 웹을 선언하는 명령어 -->
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <!-- 부트스트랩 4.3.1 버전 css 파일 -->
    <link rel="stylesheet" href="css/bootstrap.min.css" />
    <style type="text/css">
        /* 책 이미지 css */
        .book_image {
            width: 200px;
            height: 200px;
        }
        /* 전체 li 태그 css */
        li {
            height: 217px;
            border-bottom: 1px solid #d1d1d1;
        }
        /* 전체 ul 태그 css */
        ul {
            list-style: none;
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
       

    </style>
</head>

<body>
    <!-- 상단에 고정된 헤더 파일 include -->
    <div id="headers"></div>

    <!-- 국내도서 전체 틀 시작 -->
    <div class="container">

        <div class="domestic-category">
            <h2>국내도서 컴퓨터/IT</h2>
        </div>
        
        <!-- row 시작 -->
        <div class="row">
        <!-- best-list 시작 -->
        <div class="best-list">
             
        <!-- best-list 끝 -->
        </div>
        <!-- row 끝 -->
        </div>
        
    <!-- 로딩 이미지 시작 -->
    <div class="show-more load-post" title="More posts">
        <img src="image/loading.gif">
    <!-- 로딩 이미지 끝 -->
    </div>
    <!-- 국내도서 전체 틀 끝 -->
    </div>
        
       


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
        var start = 0;
        var limit = 5;
        var reachedMax = false;

        $(window).scroll(function (){
            if($(window).scrollTop() == $(document).height() - $(window).height())
            getData();
        });
	        

        // html 구조 다 불러오고 실행하는 함수
        $(document).ready(function () {

            $("#headers").load("header.php");  // 원하는 파일 경로를 삽입하면 된다
            $("#footers").load("footer.php");  // 추가 인클루드를 원할 경우 이런식으로 추가하면 된다            
            
            getData();
        }); // document.ready 끝

        // 최하단 스크롤 데이터 가져오기
        function getData(){
            if(reachedMax)
                return;

            $.ajax({
                url: 'domestic_more.php',
                method: 'POST',
                dataType: 'text',
                data: {
                    getData: 1,
                    start: start,
                    limit: limit
                },
                success: function(response){                    
                    if(response == "reachedMax"){
                        reachedMax = true;
                        $('.show-more').hide();
                   }               
                        
                    else {
                        $('.show-more').show();
                        start += limit;
                        $(".best-list").append(response);
                    }
                }
            });
        } // getData() 끝



    </script>
</body>

</html>