<?php
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
   .today-list {
        border: 1px solid #000000;
        width: 750px;
        height: 500px;
        margin-bottom: 50px;
   }
   .summary {
        width: 150px;
   }
   .comments {
        width: 1200px;
        margin-bottom: 50px;
   }

    </style>
</head>

<body>
    <!-- 상단에 고정된 헤더 파일 include -->
    <div id="headers"></div>

    <div class="container-fluid">
    
        <div>
            <h2>오늘의 책</h2>
        </div>

        <div class="today-list">                 
           
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

        // html 구조 다 불러오고 실행하는 함수
        $(document).ready(function () {

            $("#headers").load("header.php");  // 원하는 파일 경로를 삽입하면 된다
            $("#footers").load("footer.html");  // 추가 인클루드를 원할 경우 이런식으로 추가하면 된다

        });
    </script>
</body>

</html>