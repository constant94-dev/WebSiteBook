<?php 
include ('dbconfig/config.php');

if(isset($_POST['getData'])){
    $start = $db->real_escape_string($_POST['start']);
    $limit = $db->real_escape_string($_POST['limit']);

    $sql = $db->query("SELECT * FROM bct_foreign_crawl LIMIT $start, $limit");


    if($sql->num_rows >0){
        $response = "";
        while($data = $sql->fetch_array()){
            
            // 크롤링한 데이터 링크걸기 위한 변수
            $link = $data['link'];
            // 문자열 값 ',' 기준으로 나눈다
            $pattern = "',";
            // 내가 정한 기준으로 나눈 문자열 값
            $jbexplode = explode($pattern,$link);
            // 문자열 값 ' 기준으로 나눈다
            $pattern2 = "'";
            // 내가 정한 기준으로 나눈 문자열 값
            $linkClass = explode($pattern2,$jbexplode[1]);
            $barcode = explode($pattern2,$jbexplode[2]);

            $response .= '<ul>';
            $response .= '<li>';
            $response .= '<div>';
            $response .= '<div class="info_area">';
            $response .= '<div class="cover_wrap" style="float:left;">';
            $response .= '<div class="cover">';
            $response .= '<img src='.$data['image'].' class="book_image">';                                        
            $response .= '</div>';
            $response .= '</div>';
            $response .= '<div class="detail" style="margin-left: 220px; margin-top: 10px;">';
            $response .= '<div class="book_title">';
            $response .= '<a href=http://www.kyobobook.co.kr/product/detailViewEng.laf?mallGb=ENG&ejkGb=ENG&linkClass=' . $linkClass[1] . '&barcode=' . $barcode[1] .'>';
            $response .= '<strong>'.$data['title'].'</strong>';
            $response .= '</a>';
            $response .= '</div>';
            $response .= '<div class="book_info">';
            $response .= '<span class="author">'.$data['author'].'</span>';
            $response .= '</div>';
            $response .= '<div class="summary_info">';
            $response .= '<span>'.$data['info'].'</span>';
            $response .= '</div>';
            $response .= '</div>';
            $response .= '</div>';
            $response .= '</div>';
            $response .= '</li>';
            $response .= '</ul>';
                       
        }

        exit($response);
    } else 
        exit('reachedMax');
    
}

?>
