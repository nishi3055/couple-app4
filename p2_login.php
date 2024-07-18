<html lang="ja">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" href="css/login.css">
    <title>loginページ</title>
</head>
<body>
<div class="wrapper">
    <div class="text"><p>Welcome！</p></div>
        <form action="p2_login.act.php" method="POST">
            <div class ="inner1">
            <div><input type="text" id="name" name="name" placeholder="username" required></div>
            <div><input type="text" id="pass" name="pass" placeholder="password" required></div>
            <button type="submit" name="login">ログイン</button>
            </div>
            <div class="inner2">
                <div class="reset"><a href="p1_resignp.php">パスワードを忘れた方はこちら</a></div>
                <div class="regist"><a href="p1_signp.php">新しいアカウント作成</a></div>
            </div>
        </form>
    
</div>
    <footer>
        <a target="blank" href="http://google.co.jp/">11huhu22</a>
    </footer>
</body>
</html>