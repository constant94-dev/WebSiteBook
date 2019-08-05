<?php
include 'dbconfig/config.php';
session_start();

    // 로그인한 사용자 이름
    $user = $_SESSION['user_name'];
    echo "<script>console.log('세션에 저장된 이름 / $user ')</script>";
    // 사용자가 클릭한 게시글 번호
    $faqid = $_GET['board_num'];
    // 사용자가 클릭한 게시글에 조회수, 게시글 번호 알아내기 위한 sql문
    $boardSQL = "SELECT * FROM bct_board WHERE id='$faqid'";
    // 연동된 데이터베이스에 쿼리 보내기
    $boardResult = $db->query($boardSQL);
    // 쿼리 결과 값을 저장할 변수
    $boardRow=mysqli_fetch_assoc($boardResult);
    // 게시글 번호
    $id = $boardRow['id'];
    // 게시글 조회수
    $hit = $boardRow['hit'];
    // 게시글 작성자
    $board_name = $boardRow['user'];   



if(!isset($_COOKIE[$user.$id])) { // 해당 쿠키가 존재하지 않을 때    
    setcookie($user.$id, 1);
    $updatehit = 1+$hit;
    $hitsql = mysqli_query($db,"UPDATE bct_board SET hit = $updatehit WHERE id = '$id'");
} else { // 해당 쿠키가 존재할 때    
    //echo "쿠키가 이미 존재하니 조회수가 증가하지 않습니다";
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
        <link href="https://fonts.googleapis.com/css?family=Cute+Font|Jua|Sunflower:300,500,700&display=swap&subset=korean" rel="stylesheet">
        <style type="text/css">
        /* 전체 ul li 태그 css */
        ul li {
            list-style-type: none;
        }
        /* 댓글 ui 전체 틀 css */
        .comment-box {
            background-color: #f9f9f9;
            margin-bottom: 100px;
            margin-top:100px;
        }
        /* 부트스트랩이 적용된 textarea css */
        .active-amber-textarea.md-form label.active {
            color: #ffa000;
        }
        /* 부트스트랩이 적용된 textarea css */
        .amber-textarea textarea.md-textarea:focus:not([readonly]) {
            border-bottom: 1px solid #ffa000;
            box-shadow: 0 1px 0 0 #ffa000;
        }
        /* 부트스트랩이 적용된 textarea css */
        .amber-textarea.md-form .prefix.active {
            color: #ffa000;
        }
        /* 부트스트랩이 적용된 textarea css */
        .active-amber-textarea.md-form textarea.md-textarea:focus:not([readonly])+label {
            color: #ffa000;
        }

        /* 글쓰기 텍스트 css */
        #faqwrite-title {
            margin-top:100px;
            margin-bottom:50px;
            font-family: 'Sunflower', sans-serif;
        }
        /* 목록 버튼 css */
        #faqwrite-list{
            margin-bottom:100px;
        }
        
        .input-group {
            margin-bottom:100px;
        }
        /* 댓글 입력 칸 css */
        .comment-input {
            margin-top: 10px;
            margin-bottom:100px;
            width: 100%;
        }
        /* 댓글 등록 버튼 전체 틀 css */
        .comment-btn {
            position: relative;
            width: 90px;
            text-align: right;
            vertical-align: bottom;
        }
        /* 댓글 등록 버튼 전체 틀 자식 css */
        .comment-submit {
            width: 85px;
            height: 135px;
            border: 1px solid #ccc;
            background: #fff !important;            
            text-align: center;
        }
        /* 댓글 등록 버튼 css */
        #comment-regist {
            height: 134px;
            width: 80px;
        }
        /* 댓글 리스트 목록 ul css */
        .oneDepth {
            list-style:none;
            padding-left:0px;
        }
        /* 댓글 title css */
        .comment-title{
            font-family: 'Jua', sans-serif;
            font-size: 25px;
        }
        /* 댓글 수정, 댓글 삭제 버튼 css */
        .comment-update, .comment-delete {
            float:right;
            color: #000000;
            font-family: 'Sunflower', sans-serif;
        }
        /* 댓글 수정, 댓글 삭제 버튼 마우스 올렸을 때 css */
        .comment-update:hover, .comment-delete:hover {
            text-decoration: none;
        }
        /* 댓글 수정 버튼 클릭시 나오는 댓글 수정 전체 틀 css */
        #comment-update {
            height: 85px;
            width: 80px;
        }
        /* 댓글 수정 버튼 클릭시 나오는 댓글 수정 버튼 css */
        .comment-update-submit {
            height: 85px;
            border: 1px solid #ccc;
            background: #fff !important;            
            text-align: center;
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
            <form action="faqUpdate.php?title=<?php echo $boardRow['title'];?>" method="post">
            <div class="mb-3">
                <h3 class="comment-title"><label for="title">제목</label></h3>
                <div><strong><?php echo $boardRow['title'];?></strong></div>                
            </div>
            <hr/>
            <div class="mb-3">
                <h3 class="comment-title"><label for="title">내용</label></h3>
                <div><?php echo $boardRow['content'];?></div>
            </div>
            <?php
            if($user == $board_name){
            ?>
            <button type="submit" class="btn btn-warning" onclick="updateBtn()">수정</button>
            <button type="button" class="btn btn-danger" onclick="deleteBtn()">삭제</button>
            <?php } ?>
            </form>
        
        
        <!-- 댓글 기능 전체 틀 시작 -->
        <div class="comment-box">            
            <p class="comment-title">댓글</p>            
            <!-- 댓글 리스트 시작 -->
            <div id="commentView">

            <!-- 댓글 리스트 끝 -->
            </div>
            
            
            <!--Textarea 폼 시작-->
            <div class="md-form amber-textarea active-amber-textarea">
            <form id="comment-form" action="commentInsert.php" method="post">
            <!-- talbe 전체 틀 시작  -->
            <input type="hidden" name="board_num" id="board_num" value="<?php echo $id?>">
            <table>
                    <tr>
                        <td class="comment-input">
                            <textarea id="form22" class="md-textarea form-control" rows="5" name="comment_content"></textarea>
                        </td>
                        <td class="comment-btn">
                            <div class="comment-submit">
                                <button type="submit" class="btn btn-default" id="comment-regist">등록</button>
                            </div>
                        </td>
                    </tr>
            <!-- talbe 전체 틀 끝  -->
            </table>
            </form>
            <!--Textarea 폼 끝 -->
            </div>
            
        <!-- 댓글 기능 전체 틀 끝 -->
        </div>


        
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
        
// html 구조 다 불러오고 실행하는 함수
$(document).ready(function () {

$("#headers").load("header.php");  // 원하는 파일 경로를 삽입하면 된다
$("#footers").load("footer.php");  // 추가 인클루드를 원할 경우 이런식으로 추가하면 된다
// 데이터베이스에 저장된 댓글 전부 불러오기
getAllList();
});

    // 데이터베이스에 저장된 댓글 전부 불러오는 기능
	function getAllList(){
		// id 가 board_num을 찾아 value 값을 변수에 저장한다
        var board_num = $("#board_num").val();

        // 브라우저 개발자 도구 콘솔에 출력할 내용
		console.log("getAllList() 실행중이야...");        
		console.log("board_num : " + board_num);

            // 데이터베이스 댓글 불러오기 ajax 시작
		    $.ajax({
			    type : 'POST',
			    url : 'commentList.php',
			    data : {board_num: board_num},
                dataType: 'html'
            }) // 데이터베이스 댓글 불러오기 ajax 끝
            .done(function(data) {
                
                console.log(data);
                
                $("#commentView").html(data);
            })
            .fail(function(request,status,error) {
                alert("code = "+ request.status + " message = " + request.responseText + " error = " + error); // 실패 시 처리
            })
            .always(function() {
                //alert( "complete" );
            });
	} // getAllList() 끝

        // ajax 사용하여 댓글 수정하기 기능 시작
        $(document).on("click", ".comment-update", function() {
            console.log('댓글 수정 클릭 했어!');
            // 수정할 댓글 번호
            var update_reply_id = $(this).attr('reply_id');
            console.log(update_reply_id);
            // 수정할 댓글 번호를 사용하여 댓글 내용 가져오기
            var content = document.getElementById('content'+update_reply_id).innerHTML; 
            //console.log(content);
            var name = document.getElementById('name'+update_reply_id).innerHTML; 
            //console.log(name);
            var date = document.getElementById('date'+update_reply_id).innerHTML; 
            //console.log(date);
            // 댓글 수정 폼 만들기 위한 변수
            var html = "";
            
            html += '<div class="md-form amber-textarea active-amber-textarea">';            
            html += '<input type="hidden" name="board_num" id="board_num" value="<?php echo $id?>">';
            html += '<hr>';
            html += '<table>';
            html += '<tr>';
            html += '<td>';
            html += '<strong>' + name + '</strong>';
            html += '&#9;&#9;<span>' + date + '</span>';
            html += '</td>';
            html += '</tr>';
            html += '<tr>';
            html += '<td class="comment-input">';
            html += '<textarea id="comment-update-content" class="md-textarea form-control" rows="3">' + content + '</textarea>';
            html += '</td>';
            html += '<td>';
            html += '<div class="comment-submit" style="width:80px; height:85px;">';
            html += '<button type="button" class="btn btn-default" style="height:85px;" id="comment-update-button">' + '수정' + '</button>';
            html += '</div>';
            html += '</td>';
            html += '</tr>';
            html += '</table>';
            html += '<hr>';            
            html += '</div>';            

            $('.oneDepth'+update_reply_id).html(html);

            // 댓글 수정한 값 체크 기능 시작
            $('#comment-update-content').change(function(){
                var update_content = $("#comment-update-content").val();
                
                //console.log(input);
                // 수정 버튼 클릭 이벤트 시작
                $(document).on("click", "#comment-update-button", function() {
                    console.log(update_reply_id);
                    console.log(update_content);
                    // 데이터베이스 댓글 수정 기능 ajax x1시작
                    $.ajax({
			            type : 'POST',
			            url : 'commentUpdate.php',
			            data : {
                            update_reply_id: update_reply_id,
                            update_content: update_content
                        }                
                    }) // 데이터베이스 댓글 수정 기능 ajax 끝
                        // ajax 통신 성공했을 때
                            .done(function (data) {
                            console.log(data);
                            getAllList();
                        })
                        // ajax 통신 실패했을 때
                        .fail(function (request, status, error) {
                            alert("code = " + request.status + " message = " + request.responseText + " error = " + error); // 실패 시 처리
                        });
                }); // 수정 버튼 클릭 이벤트 끝
            }); // 댓글 수정한 값 체크 기능 끝
            
        }); // ajax 사용하여 댓글 수정하기 기능 끝

        // ajax 사용하여 댓글 삭제하기 기능 시작
      function commentDelete(){
            console.log('댓글 삭제 클릭 했어!');
            // 삭제할 댓글 번호
            var delete_reply_id = $('.comment-delete').attr('reply_id');
            var delete_board_id = $('#delete_board_num').val();
            console.log("삭제 댓글 번호 / "+delete_reply_id);
            console.log("삭제 게시글 번호 / "+delete_board_id);
            
            // 데이터베이스 댓글 수정 기능 ajax 시작
            $.ajax({
			            type : 'POST',
			            url : 'commentDelete.php',
			            data : {
                            delete_reply_id: delete_reply_id,
                            delete_board_id: delete_board_id                            
                        }                
                    }) // 데이터베이스 댓글 수정 기능 ajax 끝
                        // ajax 통신 성공했을 때
                        .done(function (data) {
                            console.log(data);
                            getAllList();
                        })
                        // ajax 통신 실패했을 때
                        .fail(function (request, status, error) {
                            alert("code = " + request.status + " message = " + request.responseText + " error = " + error); // 실패 시 처리
                        });
            
        }; // ajax 사용하여 댓글 삭제하기 기능 끝
        
        //
        function button_event(){

            if (confirm("정말 삭제하시겠습니까??") == true){    //확인

                commentDelete();

            } else {   //취소
                return;
            }
        }

        // 게시글 삭제 버튼 클릭 함수
        function deleteBtn(){
            if (confirm("정말 삭제하시겠습니까??") == true){    //확인

                location.href="faqDelete.php?id=<?php echo $id;?>";

            } else {   //취소
                return;
            }
            
        }
       
        
    </script>
    </body>
</html>