<?php
include 'dbconfig/config.php';
session_start();


    $faqid = $_GET['board_num'];
    $sql = "SELECT * FROM bct_board WHERE id='$faqid'";
    $result = $db->query($sql);
    
    $row=mysqli_fetch_assoc($result);
    $id = $row['id'];
    $hit = $row['hit'];
    $name =$row['user'];
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
        <link href="https://fonts.googleapis.com/css?family=Cute+Font|Jua|Sunflower:300,500,700&display=swap&subset=korean" rel="stylesheet">
        <style type="text/css">
        .comment-box {
            background-color: #f9f9f9;
            margin-bottom: 100px;
            margin-top:100px;
        }
        .active-amber-textarea.md-form label.active {
            color: #ffa000;
        }
        .amber-textarea textarea.md-textarea:focus:not([readonly]) {
            border-bottom: 1px solid #ffa000;
            box-shadow: 0 1px 0 0 #ffa000;
        }
        .amber-textarea.md-form .prefix.active {
            color: #ffa000;
        }
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
        .comment-input {
            margin-top: 10px;
            margin-bottom:100px;
            width: 100%;
        }
        .comment-btn {
            position: relative;
            width: 90px;
            text-align: right;
            vertical-align: bottom;
        }
        .comment-submit {
            width: 85px;
            height: 135px;
            border: 1px solid #ccc;
            background: #fff !important;            
            text-align: center;
        }
        #comment-regist {
            height: 134px;
            width: 80px;
        }
        .oneDepth, .twoDepth {
            list-style:none;
            padding-left:0px;
        }
        .comment-title{
            font-family: 'Jua', sans-serif;
            font-size: 25px;
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
            <?php
            if($user == $name){
            ?>
                <div id="faqwrite-list">                
                    <input type="submit" value="수정" class="btn btn-sm btn-primary"/>
                    <button class="btn btn-sm btn-primary" onclick="deleteBtn()" type="button">삭제</button>
                </div>
            <?php } ?>            
            </form>
        
        
        <!-- 댓글 기능 전체 틀 시작 -->
        <div class="comment-box">     

            <!--Textarea 폼 시작-->
            <div class="md-form amber-textarea active-amber-textarea">
                <p class="comment-title">댓글</p>  
            
            <!-- 댓글 리스트 시작 -->
            <div id="commentView">



            <!-- 댓글 리스트 끝 -->
            </div>

            
            <form id="comment-form">
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

$(document).ready(function(){
		getAllList();
	});

	var str = "";

	function getAllList(){
		var board_num = $("#board_num").val();

		console.log("getAllList()");
		console.log("board_num" + board_num);

		$.getJSON("commentList.php?board_num="+board_num, function(data){
			console.log(data);

			$(data).each(function(){
				console.log(data);

				str += "<ul class='oneDepth'><li><div><strong>작성자 : "+this.comment_name+"</strong><strong>작성날짜 : " + 
					this.comment_date + "</strong><p>" + 
					this.comment_content + "</p></div></li></ul>";
			});

			$("#commentView").html(str);
		});
	}

        // ajax 사용하여 댓글 작성하기
        $(document).on("click", "#comment-regist", function() {
		

		var formData = $("#comment-form").serialize();

		$.ajax({
			type : 'POST',
			url : 'commentInsert.php',
			data : formData,
			success : function(response){
				if(response == 'success'){
					alert("success");
					getAllList();
					
				}
			}
		});
    });


        // 삭제 버튼 클릭 함수
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