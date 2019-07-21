<?php
include 'dbconfig/config.php';
session_start();

    // 댓글이 작성될 게시판 고유 번호
    $board_num = $_POST['board_num'];
    // 댓글 내용	
    $comment_content = $_POST['comment_content'];
    // 댓글 작성한 사용자 이름
	$comment_name = $_SESSION['membername'];	

	$sql = "INSERT INTO bct_board_comment(board_num, comment_name, comment_content, comment_date) VALUES('$board_num','$comment_name','$comment_content','now()')";
    
	$result = $db->query($sql);

    // INSERT 명령으로 입력된 바로 그값의 PK(Primary Key)를 가져오는 명령을 수행합니다.
	$comment_num = $db->insert_id;

	$sql = 'UPDATE bct_board_comment SET comment_depth = comment_num WHERE comment_num = ' . $comment_num;

	$result = $db->query($sql);

	if($result){
		echo "success";
	}

?>