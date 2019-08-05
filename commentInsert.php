<?php
// 외부에 존재하는 데이터베이스 연동 파일 include
include 'dbconfig/config.php';
session_start();



    // 댓글이 작성될 게시판 고유 번호
    $board_num = $_POST['board_num'];
    // 댓글 내용	
    $comment_content = $_POST['comment_content'];
    // 댓글 작성한 사용자 이름
	$comment_name = $_SESSION['user_name'];	

 
    $sql = "INSERT INTO bct_board_comment(board_num, comment_name, comment_content, comment_date) VALUES('$board_num','$comment_name','$comment_content',now())";    
    
    // 데이터베이스에 sql 명령어 보내서 나온 결과값 result 변수에 저장
    $result = $db->query($sql);
    if($result == false){
    // 데이터베이스에 날린 query가 동작하지 않는다면 보여주는 출력
    echo mysqli_error($db);
    }

    $sql = "UPDATE bct_board SET comment_total = comment_total + 1 WHERE id = $board_num";

// 데이터베이스에 sql 명령어 보내서 나온 결과값 result 변수에 저장
$result = $db->query($sql);
if($result == false){
// 데이터베이스에 날린 query가 동작하지 않는다면 보여주는 출력
echo mysqli_error($db);
}

    // 댓글이 작성되었을 때 알림
    if($result) {
?>
    <script>

		alert('댓글이 정상적으로 작성되었습니다.');

		location.replace("./faqboard.php?board_num=<?php echo $board_num?>");

	</script>
<?php } ?>