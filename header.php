<?php
session_start();
?>
<!DOCTYPE html>
<html>

<head>
    <title>BCT 홈페이지 상단 파일</title>

    <!-- 부트스트랩 4.3.1 버전 css 파일 -->
    <link rel="stylesheet" href="css/bootstrap.min.css" />
    <link href="https://fonts.googleapis.com/css?family=Cute+Font|Jua|Sunflower:300,500,700&display=swap&subset=korean" rel="stylesheet">
    <!-- 
        구글 폰트 사용하고 싶으면 밑에 적어놓은 것과 같이 css에 선언해주어야 한다
        font-family: 'Jua', sans-serif;
        font-family: 'Sunflower', sans-serif;
        font-family: 'Cute Font', cursive; 
    -->
    <style type="text/css">
        /* 전체 이미지 태그 css */
        img {
            width: 150px;
            
        }
        /* 전체 a 태그 css */
        .nav-link {
            text-decoration: none;
            color: #ffffff;            
        }
        .user-name {
            color: #ffffff;
        }   
    </style>

</head>

<body>

    <!-- 상단 메뉴 전체 틀 시작 -->
    <nav class="navbar navbar-dark bg-dark">
        <!-- Navbar 내용 -->
        <a class="navbar-brand" href="index.html"><img src="image/ChangeBCTLogo.png" /></a>
        <a class="nav-link" href="index.html">Home</a>
        
        

        <?php
        if(!isset($_SESSION['user_email']) || !isset($_SESSION['user_name'])){        
        ?>
        <a class="nav-link" href="#" onclick="domestic()">국내도서</a>
        <a class="nav-link" href="#" onclick="foreign()">외국도서</a>
        <a class="nav-link" href="#" onclick="best()">웹툰</a>
        <a class="nav-link" href="#" onclick="faq()">FAQ</a>
        <input type="button" class="btn btn-light" id="loginBtn" onclick="login()" value="로그인" />
        <input type="button" class="btn btn-light" id="joinBtn" onclick="join()" value="회원가입" />
        <?php }
        else {
            $email = $_SESSION['user_email'];
            $name = $_SESSION['user_name'];
            ?>
            <a class="nav-link" href="domestic.php">국내도서</a>
            <a class="nav-link" href="foreign.php">외국도서</a>
            <a class="nav-link" href="webtoon.php">웹툰</a>
            <a class="nav-link" href="faq.php">FAQ</a>
            <b class="user-name"><?php echo "$name 님";?></b>
            <input type="button" class="btn btn-light" id="logoutBtn" onclick="logout()" value="로그아웃" />
            <?php } ?>
        
        <form class="form-inline my-2 my-lg-0">
            <input class="form-control mr-sm-2" type="search" placeholder="Search">
            <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
        </form>
    <!-- 상단 메뉴 전체 틀 끝 -->
    </nav>



    <!-- 부트스트랩 4 버전 부터는 jQuery, popper 파일을 함께 적용시켜야 한다 -->
    <!-- 제이쿼리 3.4.1 버전 js 파일 -->
    <script src="js/jquery-3.4.1.min.js"></script>
    <!-- popper 1.15.0 버전 js 파일 -->
    <script src="js/popper.min.js"></script>
    <!-- 부트스트랩 4.3.1 버전 js 파일 -->
    <script src="js/bootstrap.min.js"></script>
    <script type="text/javascript">
         // 로그인 버튼 클릭 함수
         function login() {
            location.href = "login.html"
        }
        // 회원가입 버튼 클릭 함수
        function join() {
            location.href = "join.html"
        }
        // 로그아웃 버튼 클릭 함수
        function logout() {
            location.href = "logout.php"
        }
        function domestic(){
            alert("로그인 후 이용해주세요.");
        }
        function foreign(){
            alert("로그인 후 이용해주세요.");
        }
        function best(){
            alert("로그인 후 이용해주세요.");
        }
        function faq(){
            alert("로그인 후 이용해주세요.");
        }
    </script>
</body>

</html>