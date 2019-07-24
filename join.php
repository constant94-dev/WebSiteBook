<?php
// 데이터베이스 연결 설정하는 파일
include 'dbconfig/config.php';

//사용자가 입력한 이름
$username = $_POST['username'];
//사용자가 입력한 이메일
$useremail = $_POST['useremail'];
//사용자가 입력한 비밀번호
$userpassword = $_POST['userpassword'];
//사용자가 입력한 전화번호
$userphone = $_POST['userphone'];
//사용자가 입력한 성별
$usergender = $_POST['usergender'];

// PASSWORD_DEFAUTL
// bcrypt 알고리즘을 사용하십시오. 
// 이 상수는 새롭고 강력한 알고리즘이 PHP에 추가되면서 시간이 지남에 따라 변경되도록 설계되었습니다. 
// 따라서 이 식별자를 사용하여 얻은 결과의 길이는 시간이 지남에 따라 변경 될 수 있습니다. 
// 따라서 60자를 초과 할 수있는 데이터베이스 열에 결과를 저장하는 것이 좋습니다 (255자를 선택하는 것이 좋음).

// PASSWORD_BCRYPT
// CRYPT_BLOWFISH 알고리즘을 사용하여 해시를 만듭니다. 
// 이렇게하면 "$ 2y $"식별자를 사용하여 표준 crypt () 호환 해시가 생성됩니다. 
// 결과는 항상 60 자 문자열이되며, 실패시 거짓이 반환됩니다.

$hash = password_hash($userpassword, PASSWORD_DEFAULT);

//데이터베이스 bct_join 테이블에 있는 이메일과 입력한 이메일이 있는지 체크하는 query
$check = "SELECT * FROM bct_join WHERE user_email='$useremail'";

// 이메일이 존재하지 않는다면 실행되는 조건

$join = mysqli_query($db, "INSERT INTO bct_join(user_name, user_email, user_password, user_phone, user_gender) VALUES('$username','$useremail','$hash','$userphone','$usergender')");
    
    // display_startup_errors 는 php 시작시 오류가 나면 표시하라는 뜻입니다.
    ini_set('display_startup_errors', true);  
    // display_errors 는 php를 실행하다가 오류가 나면 표시하라는 뜻입니다.
    ini_set('display_errors', true);
    // E_ALL 은 모든 오류를 표시하라는 뜻입니다. 숫자 32767 입니다.
    //숫자를 표기해 둔 이유는 error_reporting 함수는 비트 마스크 연산을 하기 때문입니다.
    //즉 동시에 여러 경고를 쓸 수 있다는 뜻  
    error_reporting(E_ALL);  

if($join){
    echo "<script>
    alert('회원가입에 성공하였습니다');
    location.href='index.html';
    </script>";
}




?>