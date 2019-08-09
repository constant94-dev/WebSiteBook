<?php 
include ('dbconfig/config.php');

if(isset($_POST['getData'])){
    $start = $db->real_escape_string($_POST['start']);
    $limit = $db->real_escape_string($_POST['limit']);

    $sql = $db->query("SELECT * FROM bct_domestic_crawl LIMIT $start, $limit");


    if($sql->num_rows >0){
        $response = "";
        while($data = $sql->fetch_array()){
            
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
            $response .= '<a href=http://www.kyobobook.co.kr/product/detailViewKor.laf?mallGb=KOR&ejkGb=KOR&linkClass='. substr($data['link'], 39, 2) . '&barcode='. substr($data['link'], 44, 13).'>';
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