<?php
// 외부에 존재하는 데이터베이스 연동 파일 include
include 'dbconfig/config.php';
session_start();

// 로그인한 사용자 이름
$user = $_SESSION['user_name'];
// 게시글 번호
$board_num = $_POST['board_num'];

    // sql 명령어 저장할 변수
	$sql = "SELECT * FROM bct_board_comment WHERE board_num = $board_num ORDER BY comment_date ASC";

    // 데이터베이스에 쿼리 보내는 명령문
    $result = mysqli_query($db,$sql) or die("Error :	" . mysqli_error($db));
    
    $html = "";

    // 배열 생성
	//$resultArray = array();
    // 생성한 $resultArray 배열에 값 넣을 반복문
	while($row = mysqli_fetch_array($result)){
         //array_push($resultArray,array('comment_name' => $row[2], 'comment_content' => $row[3], 'comment_date' => $row[5], 'comment_num' => $row[0]));
        $html .= '<ul class=oneDepth' . $row[0] . '>';
        $html .= '<li>';
        $html .= '<div>';
        $html .= '<hr>';
        $html .= "<input type='hidden' id='delete_board_num' value='$board_num'>";                    
        $html .= '<strong id=name' . $row[0] . '>' . $row[0] . ' / ' . $row[2] . '</strong>';
        $html .= '&#9;&#9;<span id=date' . $row[0] . '>' . $row[5] . '</span>';
        if($user == $row[2]){
            $html .= '<a href="#" class="comment-delete" reply_id=' . $row[0] . ' onclick="button_event()">&nbsp;삭제&nbsp;</a>';
            $html .= '<a href="#" class="comment-update" reply_id=' . $row[0] . '>&nbsp;수정&nbsp;</a>';
            $html .= '<p id=content' . $row[0] . '>' . $row[3] . '</p>';
            $html .= '</div>';
            $html .= '</li>';
            $html .= '</ul>';
        } else {
            $html .= '<p id=content' . $row[0] . '>' . $row[3] . '</p>';
            $html .= '</div>';
            $html .= '</li>';
            $html .= '</ul>';
        }
        
	}
    // ajax 통신 받을 데이터타입이 json 이기 때문에 json 형태로 반환해주어야 한다
    //echo json_encode($resultArray);
    

    

    echo $html;

?>