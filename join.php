<?php
include 'config.php';

$membername = $_POST['membername'];
$memberemail = $_POST['memberemail'];
$memberpassword = $_POST['memberpassword'];
$memberphone = $_POST['memberphone'];
$membergender = $_POST['membergender'];

// echo "이름",$membername;
// echo "이메일",$memberemail;
// echo "비밀번호",$memberpassword;
// echo "휴대폰번호",$memberphone;
// echo "성별",$membergender;

$check = "SELECT * FROM bct_join WHERE memberemail='$memberemail'";
$result = $db->query($check);

if($result->num_rows==1){
    echo "<script>
    alert('중복된 이메일 입니다');
    location.href='join.html';
    </script>";

}else{
    $join = mysqli_query($db,"INSERT INTO bct_join (membername,memberemail,memberpassword,memberphone,membergender) VALUES ('$membername','$memberemail','$memberpassword','$memberphone','$membergender')");
    if($join){
    echo "<script>
    alert('회원가입에 성공하였습니다');
    location.href='index.html';
    </script>";
    }
}



?>