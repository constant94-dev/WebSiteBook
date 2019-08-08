<?php 
include ('dbconfig/config.php');
 
$actionName = $_POST["action"];
if($actionName == "showPost"){
 
 
$showPostFrom = $_POST["showPostFrom"];
$showPostCount = $_POST["showPostCount"];
 
// 데이터베이스에서 가져올 행수 제한
$query = "SELECT * FROM bct_domestic_crawl LIMIT ".$showPostFrom.",".$showPostCount;
// 쿼리 실행
$result = mysqli_query($db, $query);
 
// 가져온 행 수
$rowCount = mysqli_num_rows($result);
 
// 가져온 행수가 0보다 크면 실행
if($rowCount > 0){
    $html = "";
    // 가져온 행수 만큼 반복한다
    while($row = mysqli_fetch_assoc($result)){
        $link = $row['link'];
        

        
        $html .= '<ul>';
        $html .= '<li>';
        $html .= '<div>';
        $html .= '<div class="info_area">'; // info_area 시작
        $html .= '<div class="cover_wrap" style="float:left;">'; // cover_wrap 시작
        $html .= '<div class="cover">'; // cover 시작
        $html .= ' <img src=' . $row['image'] . ' class="book_image">';
        $html .= '</div>'; // cover 끝
        $html .= '</div>'; // cover_wrap 끝
        $html .= '<div class="detail" style="margin-left: 220px; margin-top: 10px;">'; // detail 시작
        $html .= '<div class="book_title">'; // book_title 시작
        $html .= '<a href=http://www.kyobobook.co.kr/product/detailViewKor.laf?mallGb=KOR&ejkGb=KOR&linkClass=' . substr($link, 39, 2) . '&barcode=' . substr($link, 44, 13) .'>';
        $html .= '<strong>' . $row['title'] . '</strong>';
        $html .= '</a>';
        $html .= '</div>'; // book_title 끝
        $html .= '<div class="book_info">'; // book_info 시작
        $html .= '<span class="author">' . $row['author'] . '</span>';
        $html .= '</div>'; // book_info 끝
        $html .= '<div class="summary_info">'; // summary_info 시작
        $html .= '<span>' . $row['info'] . '</span>';
        $html .= '</div>'; // summary_info 끝
        $html .= '</div>'; // detail 끝
        $html .= '</div>'; // info_area 끝
        
        
 

        } // 반복문 끝
        echo $html;
    } // if($rowCount > 0) 끝
} // if($actionName == "showPost") 끝
?>
