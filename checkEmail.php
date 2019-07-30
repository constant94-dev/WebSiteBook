<?php
// 외부에 존재하는 데이터베이스 연동 파일 include
include 'dbconfig/config.php';

// 실시간으로 이메일 체크하기위해 받아온 이메일
$emailCheck = $_POST['emailCheck'];


$sql = mysqli_query($db, "SELECT * FROM bct_join WHERE user_email = '$emailCheck'");

// 이메일이 존재하면 0을 반환
if(mysqli_num_rows($sql)==1){
    echo 0;
}
// 이메일이 존재하지 않는다면 1읇 반환
else {
    echo 1;
}
// if(!$sql){
//     // 데이터베이스에 날린 query가 동작하지 않는다면 보여주는 출력
//     echo mysqli_error($db);
// }
// else {
//     echo 1;
// }

?>
