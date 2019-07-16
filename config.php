<?php

$mysql_hostname = "localhost";

$mysql_user = "psj";

$mysql_password = "permissionchmodchown";

$mysql_database = "mysql";

 
// 'DB 호스트 주소', 'DB 아이디', 'DB 암호', 'DB 이름'
$db = mysqli_connect ($mysql_hostname, $mysql_user, $mysql_password) or die('Not connected : Ah sh*t ' . mysqli_connect_error());

// mysqli_select_db 함수는 mysqli_connect 를 통해 연결된 객체가 선택하고 있는 DB를 다른 DB로 바꾸기 위해 사용되어집니다.​
// mysqli_select_db([연결 객체], [DB명]);
mysqli_select_db($db, "bct") or die("cannot select DB");

// function msql($sql)
// 	{
// 		global $db;
// 		return $db->query($sql);
// 	}

?>
