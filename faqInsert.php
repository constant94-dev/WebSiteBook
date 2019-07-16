<?php

$conn = mysqli_connect("localhost","psj","permissionchmodchown","bct");




$title = $_POST['title']; 
$content = $_POST['content']; 
$user = $_POST['user_id'];




$sql = mysqli_query($conn, "INSERT INTO bct_board(title, content, user, created) VALUES('$title','$content','$user',now())");

echo ("<script>location.href='faq2.php'</script>");

error_reporting(E_ALL);

ini_set("display_errors", 1);

$string = "Hello World ! <br/>";

echo $string;


$result = mysqli_query($conn, $sql);
if($result === false){
    echo mysqli_error($conn);
}

mysqli_close($conn);



?>