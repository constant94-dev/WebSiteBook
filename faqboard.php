<?php
include 'dbconfig/config.php';
session_start();
$title = $_GET['title'];
$sql = "SELECT * FROM bct_board WHERE title='$title'";
$result = $db->query($sql);

$row=mysqli_fetch_assoc($result);
$id = $row['id'];
$hit = $row['hit'];
$user = $_SESSION['membername'];
if(!isset($_COOKIE[$user.$id])) { // 해당 쿠키가 존재하지 않을 때    
    setcookie($user.$id, 1);
    $updatehit = 1+$hit;
    $hitsql = mysqli_query($db,"UPDATE bct_board SET hit = $updatehit WHERE id = '$id'");
} else { // 해당 쿠키가 존재할 때    
    echo "쿠키가 이미 존재하니 조회수가 증가하지 않습니다";
    //setcookie($id, "", time() - 3600); //만료시간을 3600초 전으로 셋팅하여 확실히 제거
}

?>
<!DOCTYPE html>
<html>
    <head>
        <title>FAQ 글 작성 페이지</title>
        <!-- 반응형 웹을 선언하는 명령어 -->
        <meta content="width=device-width, initial-scale=1" name="viewport"/>
        <!-- 부트스트랩 4.3.1 버전 css 파일 -->
        <link href="css/bootstrap.min.css" rel="stylesheet"/>

        <style type="text/css">
        /* 글쓰기 텍스트 css */
        #faqwrite-title {
            margin-top:100px;
            margin-bottom:50px;
        }
        /* 목록 버튼 css */
        #faqwrite-list{
            margin-bottom:300px;
        }

        </style>
    </head>

    
    <body>
        <!-- 상단에 고정된 헤더 파일 include -->
        <div id="headers"></div>
        <!-- 전체 틀 시작 -->
        <div class="container">
            <h2 id="faqwrite-title">작성된 글</h2>
            <hr/>
            <form action="faqUpdate.php?title=<?php echo $row['title'];?>" method="post">
            <div class="mb-3">
                <label for="title">제목</label>
                <div><strong><?php echo $row['title'];?></strong></div>                
            </div>
            <hr/>
            <div class="mb-3">
                <label for="title">내용</label>
                <div><?php echo $row['content'];?></div>
            </div>            
            <div id="faqwrite-list">
                <input type="submit" value="수정" class="btn btn-sm btn-primary"/>
                <button class="btn btn-sm btn-primary" onclick="deleteBtn()" type="button">삭제</button>
            </div>
            </form>
        <!-- 전체 틀 끝 -->
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
        // 목록 버튼 클릭 함수
        function deleteBtn(){
            location.href="faqDelete.php?id=<?php echo $id;?>";
        }
       
        // html 구조 다 불러오고 실행하는 함수
        $(document).ready(function () {

            $("#headers").load("header.php");  // 원하는 파일 경로를 삽입하면 된다
            $("#footers").load("footer.html");  // 추가 인클루드를 원할 경우 이런식으로 추가하면 된다

        });
    </script>
    </body>
</html>