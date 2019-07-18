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
            margin-bottom:100px;
        }

        </style>
    </head>

    
    <body>
        <!-- 상단에 고정된 헤더 파일 include -->
        <div id="headers"></div>
        <!-- 전체 틀 시작 -->
        <div class="container">
            <h2 id="faqwrite-title">글쓰기</h2>
            <form action="faqInsert.php" method="post">
            <div class="mb-3">
                <label for="title">제목</label>
                <input class="form-control" id="title" name="title" placeholder="제목을 입력해 주세요" type="text">
            </div>
            <div class="mb-3">
                <label for="title">내용</label>
                <textarea class="form-control" id="content" name="content" placeholder="내용을 입력해 주세요" rows="5"></textarea>
            </div>
            <div class="mb-3">
                <label for="content">작성자</label>
                <input class="form-control" id="user_id" name="user_id" placeholder="작성자를 입력해 주세요" type="text">
            </div>
            <div id="faqwrite-list">
                <input type="submit" value="저장" class="btn btn-sm btn-primary"/>
                <button class="btn btn-sm btn-primary" onclick="btnList()" type="button">목록</button>
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
        function btnList(){
            location.href="faq.php";
        }
       
        // html 구조 다 불러오고 실행하는 함수
        $(document).ready(function () {

            $("#headers").load("header.html");  // 원하는 파일 경로를 삽입하면 된다
            $("#footers").load("footer.html");  // 추가 인클루드를 원할 경우 이런식으로 추가하면 된다

        });
    </script>
    </body>
</html>