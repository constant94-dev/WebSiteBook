  <!DOCTYPE html>
  <html>
  <head>
  <title>로그인 페이지</title>

  <!-- 반응형 웹을 선언하는 명령어 -->
  <meta name = "viewport" content = "width=device-width, initial-scale=1" />
  <!-- 부트스트랩 4.3.1 버전 css 파일 -->
  <link rel = "stylesheet" href = "css/bootstrap.min.css" />
  <style>
  
  body {
        background: #f8f8f8;
        padding: 60px 0;
        text-align: center;
    }
    
    #login-form > div {
        margin: 15px 0;
        
    }
    #login-div{
        width:500px;
        margin: 0 auto;
    }
    
  </style>
  </head>

  <body>

  <div>

  <img src = "image/login.png" />

  <div class="container">
    <div id="login-div">
        <div class="panel panel-success">
            <div class="panel-heading">
                <div class="panel-title">환영합니다!</div>
            </div>
            <div class="panel-body">
                <form id="login-form" action="index.html" method="post">
                    <div>
                        <input type="text" class="form-control" name="username" placeholder="Username" autofocus>
                    </div>
                    <div>
                        <input type="password" class="form-control" name="password" placeholder="Password">
                    </div>
                    <div>
                        <button type="submit" class="form-control btn btn-primary">로그인</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

  </div>





    <!-- 부트스트랩 4 버전 부터는 jQuery, popper 파일을 함께 적용시켜야 한다 -->
    <!-- 제이쿼리 3.4.1 버전 js 파일 -->
    <script src = "js/jquery-3.4.1.min.js"></script>
    <!-- popper 1.15.0 버전 js 파일 -->
    <script src = "js/popper.min.js"></script>
    <!-- 부트스트랩 4.3.1 버전 js 파일 -->
    <script src = "js/bootstrap.min.js"></script>
  </body>
  </html>
