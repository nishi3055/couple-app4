<?php
session_start();
include('functions.php');

$user_id = $_GET['user_id'];
$diary_id = $_GET['diary_id'];

$pdo = connect_to_db();

$sql = 'SELECT COUNT(*) FROM good_table WHERE user_id=:user_id AND diary_id=:diary_id';
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':user_id', $user_id, PDO::PARAM_STR);
$stmt->bindValue(':diary_id', $diary_id, PDO::PARAM_STR);

try {
  $status = $stmt->execute();
} catch (PDOException $e) {
  echo json_encode(["sql error" => "{$e->getMessage()}"]);
  exit();
}

$like_count = $stmt->fetchColumn();
// まずはデータ確認

//var_dump($good_count);
//exit();

if ($good_count !== 0) {
  // いいねされている状態
  $sql = 'DELETE FROM good_table WHERE user_id=:user_id AND diary_id=:diary_id';
} else {
  // いいねされていない状態
  $sql = 'INSERT INTO good_table (id, user_id, diary_id, created_at) VALUES (NULL, :user_id, :good_id, now())';
}

// 以下は前項と変更なし
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':user_id', $user_id, PDO::PARAM_STR);
$stmt->bindValue(':diary_id', $todo_id, PDO::PARAM_STR);

try {
  $status = $stmt->execute();
} catch (PDOException $e) {
  echo json_encode(["sql error" => "{$e->getMessage()}"]);
  exit();
}

header("Location:p7_main.read.php");
exit();

