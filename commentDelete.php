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

// 삭제할 댓글 번호 변수에 저장
$reply_id = $_POST['delete_reply_id'];
$board_id = $_POST['delete_board_id'];

// mysqli_query 파라미터가 두개이어야 하고 첫번째 파라미터는 연동된 db 두번째 파라미터는 sql 명령문이다
$sql = mysqli_query($db, "DELETE FROM bct_board_comment WHERE comment_num=$reply_id");

$sql = "UPDATE bct_board SET comment_total = comment_total - 1 WHERE id = $board_id";

// 데이터베이스에 sql 명령어 보내서 나온 결과값 result 변수에 저장
$result = $db->query($sql);
if($result == false){
// 데이터베이스에 날린 query가 동작하지 않는다면 보여주는 출력
echo mysqli_error($db);
}


// ajax 성공했을 때 보여줄 출력문
echo "comment delete success";

?>
