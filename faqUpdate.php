<?php
include 'dbconfig/config.php';

// 게시글 제목
$title = $_GET['title'];
// 게시글 정보 알아내기 위한 sql문
$sql = "SELECT * FROM bct_board WHERE title='$title'";
// 연동된 데이터베이스에 쿼리 보내기
$result = $db->query($sql);

// 쿼리 결과 값 저장할 변수
$row=mysqli_fetch_assoc($result);
// 게시글 번호
$id = $row['id'];
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
            <h2 id="faqwrite-title">수정할 글</h2>
            <hr/>
            <form action="faqUpdateSuccess.php?id=<?php echo $id;?>" method="post">
            <div class="mb-3">
                <label for="title">제목</label>
                <input class="form-control" id="title" name="title" placeholder="제목을 입력해 주세요" type="text" value="<?php echo $row['title'];?>"/>            
            </div>
            <hr/>
            <div class="mb-3">
                <label for="title">내용</label>
                <textarea class="form-control" id="content" name="content" placeholder="내용을 입력해 주세요" rows="5"><?php echo $row['content'];?></textarea>
            </div>            
            <div id="faqwrite-list">
                <input type="submit" value="수정완료" class="btn btn-sm btn-primary"/>
                <button class="btn btn-sm btn-primary" onclick="updateClose()" type="button">취소</button>
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
        function updateClose(){
            location.href="faq.php";
        }
       
        // html 구조 다 불러오고 실행하는 함수
        $(document).ready(function () {

            $("#headers").load("header.php");  // 원하는 파일 경로를 삽입하면 된다
            $("#footers").load("footer.html");  // 추가 인클루드를 원할 경우 이런식으로 추가하면 된다

        });
    </script>
    </body>
</html>