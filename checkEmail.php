<?php
include 'dbconfig/config.php';

$emailCheck = $_POST['emailCheck'];

$sql = mysqli_query($db, "SELECT * FROM bct_join WHERE user_email = '$emailCheck'");

if(mysqli_num_rows($sql)==1){
    echo 0;
}
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
