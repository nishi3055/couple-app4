<?php
    //var_dump($_POST);
    //exit();
  session_start();
  include('functions.php');
  check_session_id();

// 入力項目のチェック
if (
  !isset($_POST['name']) || $_POST['name'] === '' ||
  !isset($_POST['email']) || $_POST['email'] === '' ||
  !isset($_POST['pass']) || $_POST['pass'] === '' ||
  !isset($_POST['id']) || $_POST['id'] === ''
) {
  exit('paramError');
}
    $event = $_POST['name'];
    $email = $_POST['email'];
    $pass = $_POST['pass'];
    $id = $_POST['id'];

    // DB接続
    $pdo = connect_to_db();
    $sql = 'UPDATE register_list SET name=:name, email=:email, pass=:pass, updated_at=now() WHERE id=:id';

$stmt = $pdo->prepare($sql);
$stmt->bindValue(':name', $todo, PDO::PARAM_STR);
$stmt->bindValue(':email', $deadline, PDO::PARAM_STR);
$stmt->bindValue(':pass', $deadline, PDO::PARAM_STR);
$stmt->bindValue(':id', $id, PDO::PARAM_STR);

try {
  $status = $stmt->execute();
} catch (PDOException $e) {
  echo json_encode(["sql error" => "{$e->getMessage()}"]);
  exit();
}

header('Location:p3_read.php');
exit();


// SQL実行

