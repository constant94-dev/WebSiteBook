<?php
// 외부에 존재하는 데이터베이스 연동 파일 include
include 'dbconfig/config.php';

// PHP 구문 분석기 오류는 익숙해 져 있습니다. 
// X 선에서 예상치 못한 '무언가'에 대해 불평하면 먼저 X-1 선을 살펴보십시오. 
// 이 경우 이전 행의 마지막에 세미콜론을 잊어 버렸다고 말하는 대신 if다음에 오는 것에 대해 불평 할 것 입니다.
// 당신은 그것에 익숙해 질거다.
// if(!isset($_POST['reply_id'])){
//     echo 'sibal';
// }

// 수정할 댓글 번호 변수에 저장
$reply_id = $_POST['update_reply_id'];
// 수정할 댓글 내용 변수에 저장
$update_content = $_POST['update_content'];
// 데이터베이스에 쿼리 보내는 명령문
$sql = mysqli_query($db, "UPDATE bct_board_comment SET comment_content='$update_content' WHERE comment_num=$reply_id");

// ajax 성공했을 때 보여줄 출력문
echo "comment update success";

?>
