<?php
include 'dbconfig/config.php';
$sql = mysqli_query($db, "SELECT * FROM bct_foreign_crawl");
?>
<!DOCTYPE html>
<html>

<head>
    <title>BCT 외국도서 페이지</title>
    <!-- 반응형 웹을 선언하는 명령어 -->
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <!-- 부트스트랩 4.3.1 버전 css 파일 -->
    <link rel="stylesheet" href="css/bootstrap.min.css" />
    <style type="text/css">
        .book_image {
            width: 200px;
            height: 200px;
        }

        li {
            height: 217px;
            border-bottom: 1px solid #d1d1d1;
        }

        ul {
            list-style: none;
        }
        .container {
            margin-top:100px;
            margin-bottom: 100px;
        }
        .domestic-category {
            margin-top: 100px;
            margin-bottom: 100px;
        }
       

    </style>
</head>

<body>
    <!-- 상단에 고정된 헤더 파일 include -->
    <div id="headers"></div>

    <!-- 국내도서 전체 틀 시작 -->
    <div class="container">

        <div class="domestic-category">
            <h2>외국도서 경제/경영</h2>
        </div>

        <?php
			while($row = $sql->fetch_assoc()){

		?>
        <!-- best-list 시작 -->
        <div class="best-list">
            <ul>
                <li>
                    <div>
                        <!-- 리스트 아이템 한줄 시작 -->
                        <div class="info_area">
                            <!-- 책 이미지 틀 시작 -->
                            <div class="cover_wrap" style="float:left;">
                                <div class="cover">
                                    <img src="<?php echo $row['image'] ?>" class="book_image">
                                </div>
                            <!-- 책 이미지 틀 끝 -->
                            </div>
                            <!-- 책 상세 정보 시작 -->
                            <div class="detail" style="margin-left: 220px; margin-top: 10px;">
                                <div class="book_title">
                                    <a href="#">
                                        <strong><?php echo $row['title'] ?></strong>
                                    </a>
                                </div>
                                <div class="book_info">
                                    <span class="author"><?php echo $row['author'] ?></span>
                                </div>
                                <div class="summary_info">
                                    <span><?php echo $row['info'] ?></span>
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
        <?php
			}
		?>
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

        // html 구조 다 불러오고 실행하는 함수
        $(document).ready(function () {

            $("#headers").load("header.php");  // 원하는 파일 경로를 삽입하면 된다
            $("#footers").load("footer.php");  // 추가 인클루드를 원할 경우 이런식으로 추가하면 된다

        });
    </script>
</body>

</html>