<?php

// データ受け取り
//var_dump($_GET);
//exit();

session_start();
include('functions.php');
$pdo = connect_to_db();

if (
  !isset($_POST['event']) || $_POST['event'] === '' ||
  !isset($_POST['date']) || $_POST['date'] === '' ||
  !isset($_POST['comment']) || $_POST['comment'] === ''
) {
  exit('paramError');
}

$event = $_POST['event'];
$date = $_POST['date'];
$comment = $_POST['comment'];


$sql = 'INSERT INTO diary_text(id, event, date, comment, created_at, updated_at, deleted_at) VALUES(NULL, :event, :date, :comment, now(), now(), NULL)';

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

header("Location:p7_main.php");
exit();
