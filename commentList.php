<?php
include 'dbconfig/config.php';

$board_num = $_POST['board_num'];

	$sql = "SELECT * FROM bct_board_comment WHERE board_num = $board_num ORDER BY comment_date DESC";

	$result = mysqli_query($db,$sql) or die("Error :	" . mysqli_error($db));

	$resultArray = array();

	while($row = mysqli_fetch_array($result)){
	     array_push($resultArray,array('comment_name' => $row[2], 'comment_content' => $row[3], 'comment_date' => $row[5], 'comment_num' => $row[0]));
	}

	echo json_encode($resultArray);

?>