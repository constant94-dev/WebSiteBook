<?php
include 'dbconfig/config.php';
// isset () 함수는 변수가 설정되었는지 여부를 확인하는 데 사용됩니다. 
// 변수가 이미 unset () 함수로 설정 해제 된 경우 더 이상 설정되지 않습니다. 
// 테스트 변수가 NULL 값을 포함하면 isset () 함수는 false를 반환합니다

if(!isset($_POST['user_email']) || !isset($_POST['user_password'])) exit;
$user_email = $_POST['user_email'];
$user_password = $_POST['user_password'];

//아이디가 있는지 검사
$query = "SELECT * FROM bct_join WHERE user_email='$user_email'";
$result = $db->query($query);

        //아이디가 있다면 비밀번호 검사
        if(mysqli_num_rows($result)==1) {
 
            // mysqli_fetch_assoc 함수는 mysqli_query 를 통해 얻은 리절트 셋(result set)에서 레코드를 1개씩 리턴해주는 함수입니다.
            // 레코드를 1개씩 리턴해주는 것은 mysqli_fetch_row 와 동일하지만 mysqli_fetch_assoc 함수가 리턴하는 값은 연관배열이라는 점이 틀립니다.
            $row=mysqli_fetch_assoc($result);

            //비밀번호가 맞다면 세션 생성
            if($row['user_password']==$user_password){
                    session_start();
                    $_SESSION['user_email']=$user_email;
                    $_SESSION['user_name']=$row['user_name'];
                    if(isset($_SESSION['user_email'])){
                        echo("<script>
                        alert('로그인 되었습니다.');
                        location.replace('index.html');
                        </script>");
                    }
                    else{
                            echo "session fail";
                    }
            }
            // 비밀번호가 틀리면 보여주는 알림창
            else {
                    echo("<script>
                        alert('비밀번호가 잘못되었습니다');
                        location.replace('index.html');
                        </script>");
  
            }

    }
    // 아이디가 존재하지 않는다면 보여주는 알림창
    else{
            echo("<script>
            alert('아이디가 존재하지 않습니다');
            location.replace('index.html');
            </script>");
    }

?>