<?php

include 'config.php';

/* 페이징 시작 */

	//페이지 get 변수가 있다면 받아오고, 없다면 1페이지를 보여준다.

	if(isset($_GET['page'])) {

		$page = $_GET['page'];

	} else {

		$page = 1;

	}

	error_reporting(E_ALL);

ini_set("display_errors", 1);



$string = "Hello World ! <br/>";

//echo $string;





	$sql = 'select count(*) as cnt from bct_board';

	$result = $db->query($sql);

	$row = $result->fetch_assoc();

	

	$allPost = $row['cnt']; //전체 게시글의 수

	

	$onePage = 5; // 한 페이지에 보여줄 게시글의 수.

	$allPage = ceil($allPost / $onePage); //전체 페이지의 수

	

	if($page < 1 || ($allPage && $page > $allPage)) {

?>

		<script>

			alert("존재하지 않는 페이지입니다.");

			history.back();

		</script>

<?php

		exit;

	}

	

	$oneSection = 10; //한번에 보여줄 총 페이지 개수(1 ~ 10, 11 ~ 20 ...)

	$currentSection = ceil($page / $oneSection); //현재 섹션

	$allSection = ceil($allPage / $oneSection); //전체 섹션의 수

	

	$firstPage = ($currentSection * $oneSection) - ($oneSection - 1); //현재 섹션의 처음 페이지

	

	if($currentSection == $allSection) {

		$lastPage = $allPage; //현재 섹션이 마지막 섹션이라면 $allPage가 마지막 페이지가 된다.

	} else {

		$lastPage = $currentSection * $oneSection; //현재 섹션의 마지막 페이지

	}

	

	$prevPage = (($currentSection - 1) * $oneSection); //이전 페이지, 11~20일 때 이전을 누르면 10 페이지로 이동.

	$nextPage = (($currentSection + 1) * $oneSection) - ($oneSection - 1); //다음 페이지, 11~20일 때 다음을 누르면 21 페이지로 이동.

	

	$paging = '<ul class="pagination">'; // 페이징을 저장할 변수	

	//첫 페이지가 아니라면 처음 버튼을 생성

	if($page != 1) { 

		$paging .= '<li class="page-item"><a class="page-link" href="./faq2.php?page=1">처음</a></li>';

	}

	//첫 섹션이 아니라면 이전 버튼을 생성

	if($currentSection != 1) { 

		$paging .= '<li class="page-item"><a class="page-link" href="./faq2.php?page=' . $prevPage . '">이전</a></li>';

	}

	

	for($i = $firstPage; $i <= $lastPage; $i++) {

		if($i == $page) {

			$paging .= '<li class="page-item"><a class="page-link" href="./faq2.php?page=' . $i . '">' . $i . '</a></li>';

		} else {

			$paging .= '<li class="page-item"><a class="page-link" href="./faq2.php?page=' . $i . '">' . $i . '</a></li>';

		}

	}

	

	//마지막 섹션이 아니라면 다음 버튼을 생성

	if($currentSection != $allSection) { 

		$paging .= '<li class="page-item"><a class="page-link" href="./faq2.php?page=' . $nextPage . '">다음</a></li>';

	}

	

	//마지막 페이지가 아니라면 끝 버튼을 생성

	if($page != $allPage) { 

		$paging .= '<li class="page-item"><a class="page-link" href="./faq2.php?page=' . $allPage . '">끝</a></li>';

	}

	$paging .= '</ul>';

	

	/* 페이징 끝 */

	$currentLimit = ($onePage * $page) - $onePage; //몇 번째의 글부터 가져오는지

	$sqlLimit = ' limit ' . $currentLimit . ', ' . $onePage; //limit sql 구문

	$sql = 'select * from bct_board order by id desc' . $sqlLimit; //원하는 개수만큼 가져온다. (0번째부터 20번째까지

    $result = $db->query($sql);
    ?>
    <!DOCTYPE html>

<html>

<head>

	<meta charset="utf-8" />

	<title>자유게시판 | BCT Library</title>

	<!-- 반응형 웹을 선언하는 명령어 -->
    <meta
        content="width=device-width, initial-scale=1" name="viewport"/>
        <!-- 부트스트랩 4.3.1 버전 css 파일 -->
        <link href="css/bootstrap.min.css" rel="stylesheet"/>

        <style type="text/css">
            h3 {
                color: black;
                text-align: center;
                margin: 100px;
                font-family: cursive;
            }
            th,
            td {
                text-align: center;
            }
            a {
                text-decoration: none;
                color: #333;
            }
            a:hover {
                text-decoration: none;
            }
        </style>
</head>

<body>

	

		<h3>자유게시판</h3>

		<div class="container-fluid">

        <div class="pull-right">

                <a href="faqwrite.php" class="btn btn-primary">글쓰기</a>
                <a href="index.html" class="btn btn-primary">Home</a>

			</div>
			<table class="table table-hover">

    

				<thead>

					<tr>

						<th scope="col" class="no">번호</th>

						<th scope="col" class="title">제목</th>

						<th scope="col" class="author">작성자</th>

						<th scope="col" class="date">작성일</th>

						<th scope="col" class="hit">조회</th>

					</tr>

				</thead>

				<tbody>

						<?php

							while($row = $result->fetch_assoc())

							{

						?>

					<tr>

						<td class="id"><?php echo $row['id']?></td>

						<td class="title">

							<a href="./view.php?bno=<?php echo $row['title']?>"><?php echo $row['title']?></a>

						</td>

						<td class="user"><?php echo $row['user']?></td>

						<td class="created"><?php echo $row['created']?></td>

						<td class="hit"><?php echo $row['hit']?></td>

					</tr>

						<?php

							}

						?>

				</tbody>

			</table>

			<div class="paging">

				<?php echo $paging ?>

			</div>

		</div>

    
    
        <!-- 부트스트랩 4 버전 부터는 jQuery, popper 파일을 함께 적용시켜야 한다 -->
        <!-- 제이쿼리 3.4.1 버전 js 파일 -->
        <script src="js/jquery-3.4.1.min.js"></script>
        <!-- popper 1.15.0 버전 js 파일 -->
        <script src="js/popper.min.js"></script>
        <!-- 부트스트랩 4.3.1 버전 js 파일 -->
        <script src="js/bootstrap.min.js"></script>
</body>

</html>