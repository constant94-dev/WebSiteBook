<!DOCTYPE html>
<html>
    <head>
        <title>FAQ 글 작성 페이지</title>
        <!-- 반응형 웹을 선언하는 명령어 -->
        <meta
        content="width=device-width, initial-scale=1" name="viewport"/>
        <!-- 부트스트랩 4.3.1 버전 css 파일 -->
        <link href="css/bootstrap.min.css" rel="stylesheet"/>
    </head>

    <script>
        function btnList(){
            location.href="faq2.php";
        }
    </script>
    <body>
        
        <div class="container">
            <h2>글쓰기</h2>
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
            <div>
                <input type="submit" value="저장" class="btn btn-sm btn-primary"/>
                <button class="btn btn-sm btn-primary" onclick="btnList()" type="button">목록</button>
            </div>
            </form>
        </div>
        <!-- 부트스트랩 4 버전 부터는 jQuery, popper 파일을 함께 적용시켜야 한다 -->
        <!-- 제이쿼리 3.4.1 버전 js 파일 -->
        <script src="js/jquery-3.4.1.min.js"></script>
        <!-- popper 1.15.0 버전 js 파일 -->
        <script src="js/popper.min.js"></script>
        <!-- 부트스트랩 4.3.1 버전 js 파일 -->
        <script src="js/bootstrap.min.js"></script>
    </body>
</html>