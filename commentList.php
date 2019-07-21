<?php

$board_num = $_GET['board_num'];

	$sql = "SELECT * FROM bct_board_comment WHERE board_num = '$board_num' ORDER BY comment_date DESC";

	$result = mysql_query($sql) or die("Error :	" . mysql_error());

	$resultArray = array();

	while($row = mysql_fetch_array($result)){
	     array_push($resultArray,
		array('comment_name' => $row[2], 'comment_content' => $row[3]), 'comment_date' => $row[5]);
	}

	echo json_encode($resultArray);

?>