<?php

?>

<!DOCTYPE html>
<html>

<head>
    <title>BCT 게시글 페이지</title>
    <!-- 반응형 웹을 선언하는 명령어 -->
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <!-- 부트스트랩 4.3.1 버전 css 파일 -->
    <link rel="stylesheet" href="css/bootstrap.min.css" />
    <style type="text/css">
    hr {
        float: left;
        width: 800px;
    }
    .book-info {
        width: 100%;
        margin-top: 100px;
        margin-bottom: 100px;
    }
    .book-info-image{
        width: 150px;
        height: 220px;
        float: left;
        margin-right: 100px;
        
    }
    .book-info-detail{
        margin-top: 10px;
        
    }
    .book-info-title {
        font-size: 24px;
        line-height: 27px;
        color: #3a60df;
    }
    .book-info-intro {
        margin-top: 40px;
    }
   
    </style>
</head>

<body>
    <!-- 상단에 고정된 헤더 파일 include -->
    <div id="headers"></div>

    <div class="container-fluid" style="height: 1000px;">
        
        <div class="book-info">
            
            <div class="book-info-image">
                <img src="image/diary.png"/>
            </div>
                <div>
                    <div class="book-info-title">
                        <strong>남아 있는 날들의 일기</strong>
                    </div>
                    <div class="book-info-detail">
                        <span>다나베 세이코 지음</span>
                        <span>|</span>
                        <span>조찬희 옮김</span>
                    </div>
                    <hr>
                    <div class="book-info-intro">
                        <p>책소개</p>
                        이 책이 속한 분야 시/에세이 > 나라별 에세이 > 일본에세이 <br>
                        시/에세이 > 인물/자전적에세이 > 자전적에세이                       
                    </div>
                </div>
                    
        </div>

        <div class="comments">
            <h2>댓글</h2>
            <form action="comment.php" method="get">
                <textarea class="form-control" overflow="visible"></textarea>
                <button type="button" class="btn btn-danger">취소</button>
                <button type="submit" class="btn btn-primary">댓글</button>
            </form>
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