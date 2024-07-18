<?php
    //var_dump($_POST);
    //exit();
  session_start();
  include('functions.php');
  check_session_id();

// 入力項目のチェック
if (
  !isset($_POST['event']) || $_POST['event'] === '' ||
  !isset($_POST['date']) || $_POST['date'] === '' ||
  !isset($_POST['comment']) || $_POST['comment'] === '' ||
  !isset($_POST['id']) || $_POST['id'] === ''
) {
  exit('paramError');
}
    $event = $_POST["event"];
    $date = $_POST["date"];
    $comment = $_POST["comment"];
    $id = $_POST["id"];

    // DB接続
    $pdo = connect_to_db();
    $sql = "UPDATE diary_text SET event=:event, date=:date, comment=:comment, updated_at=now() WHERE id=:id";

$stmt = $pdo->prepare($sql);
$stmt->bindValue(':event', $event, PDO::PARAM_STR);
$stmt->bindValue(':date', $date, PDO::PARAM_STR);
$stmt->bindValue(':comment', $comment, PDO::PARAM_STR);
$stmt->bindValue(':id', $id, PDO::PARAM_STR);

try {
  $status = $stmt->execute();
} catch (PDOException $e) {
  echo json_encode(["sql error" => "{$e->getMessage()}"]);
  exit();
}

header('Location:p7_main.read.php');
exit();


// SQL実行

