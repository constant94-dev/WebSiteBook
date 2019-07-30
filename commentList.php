<?php
// 외부에 존재하는 데이터베이스 연동 파일 include
include 'dbconfig/config.php';

$board_num = $_POST['board_num'];

    // sql 명령어 저장할 변수
	$sql = "SELECT * FROM bct_board_comment WHERE board_num = $board_num ORDER BY comment_date ASC";

    // 데이터베이스에 쿼리 보내는 명령문
	$result = mysqli_query($db,$sql) or die("Error :	" . mysqli_error($db));
    // 배열 생성
	$resultArray = array();
    // 생성한 $resultArray 배열에 값 넣을 반복문
	while($row = mysqli_fetch_array($result)){
	     array_push($resultArray,array('comment_name' => $row[2], 'comment_content' => $row[3], 'comment_date' => $row[5], 'comment_num' => $row[0]));
	}
    // ajax 통신 받을 데이터타입이 json 이기 때문에 json 형태로 반환해주어야 한다
	echo json_encode($resultArray);

?>