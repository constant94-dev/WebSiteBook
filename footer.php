<?php
session_start();
?>
<!DOCTYPE html>
<html>

<head>
    <title>BCT 홈페이지 하단 파일</title>

    <!-- 부트스트랩 4.3.1 버전 css 파일 -->
    <link rel="stylesheet" href="css/bootstrap.min.css" />
    
    <style type="text/css">
        /* 전체 a 태그 css */
        .footer-link {
            text-decoration: none;
            color: #ffffff;
        }
        .footer-link:hover {
            text-decoration: none;
        }
        /* li 태크 css */
        .footer-item {
            list-style-type: none;
            float: left;
            margin-left: 14px;
        }
        /* footer 전체 틀 css */
        .footer {
            padding: 30px;
            height: 240px;
            margin: 0 auto;
            background-color: #343a40;
        }

       

        
    </style>

</head>

<body>
<?php
        if(!isset($_SESSION['user_email']) || !isset($_SESSION['user_name'])){        
        ?>
    <div class="footer">
        <ul>
            <li class="footer-item">
                <a href="#" class="footer-link" onclick="company()">회사소개</a>
            </li>            
            <li class="footer-item">
                <a href="#" class="footer-link" onclick="chatting()">고객 채팅방</a>
            </li>
        </ul>
    </div>
        <?php }
         else {           
            ?>
        <div class="footer">
            <ul>
                <li class="footer-item">
                    <a href="#" class="footer-link">회사소개</a>
                </li>            
                <li class="footer-item">
                    <a href="http://localhost:8888" class="footer-link">고객 채팅방</a>
                </li>
            </ul>
        </div>
        <?php }?>

    <!-- 부트스트랩 4 버전 부터는 jQuery, popper 파일을 함께 적용시켜야 한다 -->
    <!-- 제이쿼리 3.4.1 버전 js 파일 -->
    <script src="js/jquery-3.4.1.min.js"></script>
    <!-- popper 1.15.0 버전 js 파일 -->
    <script src="js/popper.min.js"></script>
    <!-- 부트스트랩 4.3.1 버전 js 파일 -->
    <script src="js/bootstrap.min.js"></script>
    <script type="text/javascript">
         // 회사소개 텍스트 클릭 함수
         function company() {
            alert("로그인 후 이용해주세요.");
        }
        // 고객 채팅방 텍스트 클릭 함수
        function chatting() {
            alert("로그인 후 이용해주세요.");
        }        
    </script>
</body>
</html>
