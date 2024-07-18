<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="css/style.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ログイン</title>
</head>
<body>
    <div class="wrapper">
        <h1>パスワードの再発行</h1>
        <div class=img><img class="logo" src="img/tourokubotan_doubutu_hituzi.png"></div>

        <form action="" method="POST">
            <fieldset>
                <legend>パスワードの再発行</legend>
                <a href="p3_read.php">一覧画面</a>
                <div>
                    ユーザー名: <input type="text" name="name">
                </div>
                <div>
                    email: <input type="text" name="email">
                </div>
                <div>
                    パスワード: <input type="text" name="pass">
                </div>
                <div>
                    <button>新規登録</button>
                </div>
            </fieldset>
        </form>    
        <p>すでに登録済みの方は<a href="p2_login.php">こちら</a></p>
    </div>
</body>
</html>