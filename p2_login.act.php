<?php
// データ受け取り
//var_dump($_POST);
//exit();
session_start();
include('functions.php');

$name = $_POST['name'];
$pass = $_POST['pass'];

$pdo = connect_to_db();
$sql = 'SELECT * FROM register_list WHERE name=:name AND pass=:pass AND deleted_at IS NULL';

$stmt = $pdo->prepare($sql);
$stmt->bindValue(':name', $name, PDO::PARAM_STR);
$stmt->bindValue(':pass', $pass, PDO::PARAM_STR);

try {
  $status = $stmt->execute();
} catch (PDOException $e) {
  echo json_encode(["sql error" => "{$e->getMessage()}"]);
  exit();
}


// ユーザ有無で条件分岐
$user = $stmt->fetch(PDO::FETCH_ASSOC);
if (!$user) {
  echo "<p>ログイン情報に誤りがあります</p>";
  echo "<a href=p2_login.php>ログイン</a>";
  exit();
} else {
  $_SESSION = array();
  $_SESSION['user_id'] = $user['id'];
  $_SESSION['session_id'] = session_id();
  $_SESSION['is_admin'] = $user['is_admin'];
  $_SESSION['name'] = $user['name'];
  header("Location:p7_main.php");
  exit();
}