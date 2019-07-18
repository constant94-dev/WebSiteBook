<?php
// 데이터베이스 연결 설정하는 파일
include 'dbconfig/config.php';

// 사용자가 입력한 이름
$membername = $_POST['membername'];
// 사용자가 입력한 이메일
$memberemail = $_POST['memberemail'];
// 사용자가 입력한 비밀번호
$memberpassword = $_POST['memberpassword'];
// 사용자가 입력한 전화번호
$memberphone = $_POST['memberphone'];
// 사용자가 입력한 성별
$membergender = $_POST['membergender'];

// echo "이름",$membername;
// echo "이메일",$memberemail;
// echo "비밀번호",$memberpassword;
// echo "휴대폰번호",$memberphone;
// echo "성별",$membergender;

// 데이터베이스 bct_join 테이블에 있는 이메일과 입력한 이메일이 있는지 체크하는 query
$check = "SELECT * FROM bct_join WHERE memberemail='$memberemail'";
// query 결과 값 result 변수에 저장
$result = $db->query($check);

// 결과의 행수가 1이라면 즉, 이메일이 존재한다면 실행되는 조건
if($result->num_rows==1){
    echo "<script>
    alert('중복된 이메일 입니다');
    location.href='join.html';
    </script>";

}
// 이메일이 존재하지 않는다면 실행되는 조건
else{
    $join = mysqli_query($db,"INSERT INTO bct_join (membername,memberemail,memberpassword,memberphone,membergender) VALUES ('$membername','$memberemail','$memberpassword','$memberphone','$membergender')");
    if($join){
    echo "<script>
    alert('회원가입에 성공하였습니다');
    location.href='index.html';
    </script>";
    }
}



?>