<?php
// 데이터베이스 연결 설정하는 파일
include 'dbconfig/config.php';
// 사용자가 입력한 제목
$title = $_POST['title'];
// 사용자가 입력한 내용
$content = $_POST['content'];
// 사용자가 입력한 작성자
$user = $_POST['user_id'];

// 사용자가 작성한 게시글 데이터베이스에 삽입 명령어
$sql = mysqli_query($db, "INSERT INTO bct_board(title, content, user, created) VALUES('$title','$content','$user',now())");

// 데이터베이스 저장 후 에 faq.php 페이지 이동
echo ("<script>location.href='faq.php'</script>");
// php 에러 메세지 출력
error_reporting(E_ALL);

ini_set("display_errors", 1);

// 에러 메세지 출력 안될 때 임의적으로 입력하는 출력문
$string = "Hello World ! <br/>";

echo $string;

// 데이터베이스에 sql 명령어 보내서 나온 결과값 result 변수에 저장
$result = mysqli_query($db, $sql);
if($result === false){
    // 데이터베이스에 날린 query가 동작하지 않는다면 보여주는 출력
    echo mysqli_error($db);
}
// 데이터베이스 연결 종료
mysqli_close($db);



?>