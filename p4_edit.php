<?php

// id受け取り
  //var_dump($_GET);
  //exit();

  session_start();
  include('functions.php');
  check_session_id();
  
  $id=$_GET['id'];
  $pdo = connect_to_db();
  $sql = 'SELECT * FROM register_list WHERE id=:id';
  $stmt = $pdo->prepare($sql);
  $stmt->bindValue(':id', $id, PDO::PARAM_INT);
  try {
    $status = $stmt->execute();
  } catch (PDOException $e) {
    echo json_encode(["sql error" => "{$e->getMessage()}"]);
    exit();
  }

$record = $stmt->fetch(PDO::FETCH_ASSOC);

?>

<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>userlist（編集画面）</title>
</head>

<body>
  <form action="p6_update.php" method="POST">
    <fieldset>
      <legend>userlist（編集画面）</legend>
      <a href="p3_read.php">一覧画面</a>
      <div>
        ユーザー名: <input type="text" name="name" value="<?= $record['name'] ?>">
      </div>
      <div>
        email: <input type="text" name="email" value="<?= $record['email'] ?>">
      </div>
      <div>
        パスワード: <input type="text" name="pass" value="<?= $record['pass'] ?>">
      </div>
      <div>
      <input type="hidden" name="id" value="<?= $record['id'] ?>">
      </div>
      <div>
        <button>submit</button>
      </div>
    </fieldset>
  </form>

</body>

</html>