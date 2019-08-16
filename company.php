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
    <title>BCT 회사소개 페이지</title>
    <!-- 반응형 웹을 선언하는 명령어 -->
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <!-- 부트스트랩 4.3.1 버전 css 파일 -->
    <link rel="stylesheet" href="css/bootstrap.min.css" />
    <link href="https://fonts.googleapis.com/css?family=Cute+Font|Jua|Sunflower:300,500,700&display=swap&subset=korean" rel="stylesheet">
    <style type="text/css">
        /* intro-box 전체 css */
        .intro-box {
            width: 100%;
            height: 500px;
            border: 1px solid #000000;
            margin-top: 100px;
            margin-bottom: 100px;            
        }
        /* intro-box 내부 div css */
        .intro-box-in {
            margin: 50px;
        }
        /* 전체 strong 태그 css */
        strong {
            font-family: 'sunflower', sans-serif;
        }

    </style>
</head>

<body>
    <!-- 상단에 고정된 헤더 파일 include -->
    <div id="headers"></div>

    <div class="container">
        <div class="row">
            <div class="intro-box">
                <div class="intro-box-in">
                <h1>BCT(Books Come True) 홈페이지</h1>
                <hr>
                <strong>홈페이지 목적</strong>
                <p><span>책을 좋아하는 사람들끼리 추천하고 싶은 책을 공유하는 공간</span></p>
                <hr>
                <strong>사용중인 서버</strong>
                <p><span>AWS 아시아 태평양 (서울)</span></p>
                <hr>
                <strong>사용중인 도메인</strong>
                <p><span>www.parkcoding.ga</span></p>
                <hr>
                <strong>HTTPS</strong>
                <p><span>적용</span></p>
                </div>
            </div>
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
            $("#footers").load("footer.php");  // 추가 인클루드를 원할 경우 이런식으로 추가하면 된다
        }); // document.ready 끝



    </script>
</body>

</html>