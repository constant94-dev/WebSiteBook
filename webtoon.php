<?php
include 'dbconfig/config.php';
// 네이버 웹툰 크롤링한 정보 가져오는 sql문
$sql = mysqli_query($db, "SELECT * FROM bct_webtoon_crawl");
?>
<!DOCTYPE html>
<html>

<head>
    <title>BCT 메인 페이지</title>
    <!-- 반응형 웹을 선언하는 명령어 -->
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <!-- 부트스트랩 4.3.1 버전 css 파일 -->
    <link rel="stylesheet" href="/css/bootstrap.min.css" />
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
            height:2500px;
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
    </style>
</head>

<body>

    <!-- 상단에 고정된 헤더 파일 include -->
    <div id="headers"></div>

    <!-- 웹툰 전체 틀 시작 -->
    <div class="container">

        <div class="head-title">
            <h2>오늘의 웹툰</h2>
        </div>

        <?php
            // 데이터베이스에서 가져온 웹툰 정보를 출력하기 위한 반복문
			while($row = $sql->fetch_assoc()){
                
        ?>        
        
        <!-- 웹툰 이미지 틀 시작 -->
        <div>
            <div style="float: left;" class="box">
                <div><a href="https://comic.naver.com/<?php echo $row['webtoonLink'] ?>"><img src="<?php echo $row['webtoonImage'] ?>" class="webtoon-image"></a></div>
                <span><?php echo $row['webtoonTitle'] ?></span>
            </div>            
            <!-- 웹툰 이미지 틀 끝 -->
        </div>
             
        <?php
        
			}
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
    </script>
</body>

</html>