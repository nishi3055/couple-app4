<?php
  session_start();
  include('functions.php');
  check_session_id();

$pdo = connect_to_db();
$sql = 'SELECT * FROM diary_text WHERE event=:event AND date=:date AND comment=:comment  IS NULL';

$stmt = $pdo->prepare($sql);
$stmt->bindValue(':event', $event, PDO::PARAM_STR);
$stmt->bindValue(':date', $date, PDO::PARAM_STR);
$stmt->bindValue(':comment', $comment, PDO::PARAM_STR);

try {
  $status = $stmt->execute();
} catch (PDOException $e) {
  echo json_encode(["sql error" => "{$e->getMessage()}"]);
  exit();
}

$user = $stmt->fetch(PDO::FETCH_ASSOC);

  $_SESSION = array();
  $_SESSION['user_id'] = $user['id'];
  $_SESSION['session_id'] = session_id();
  $_SESSION['is_admin'] = $user['is_admin'];
  $_SESSION['name'] = $user['name'];
  header("Location:p7_main.php");
  exit();
