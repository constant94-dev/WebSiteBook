<?php
// 세션 시작
session_start();
// 세션 제거
session_destroy();
// 로그아웃 알림창 보여주고 페이지 이동
echo("<script>
    alert('로그아웃 되었습니다');
    location.replace('index.html');
    </script>");
?>