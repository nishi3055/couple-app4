<?php

//var_dump($_GET);
//exit();

session_start();
include('functions.php');
check_session_id();

$pdo = connect_to_db();

$sql = 'SELECT * FROM register_list ORDER BY id ASC';

$stmt = $pdo->prepare($sql);
try {
  $status = $stmt->execute();
} catch (PDOException $e) {
  echo json_encode(["sql error" => "{$e->getMessage()}"]);
  exit();
}

$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
$output = "";
foreach ($result as $record) {
  $output .= "
    <tr>
      <td>{$record["name"]}</td>
      <td>{$record["email"]}</td>
      <td>{$record["pass"]}</td>
      <td>
        <a href='p4_edit.php?id={$record["id"]}'>edit</a>
      </td>
      <td>
        <a href='p5_delete.php?id={$record["id"]}'>delete</a>
      </td>
    </tr>
  ";
}

?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ユーザー登録一覧（編集）</title>
</head>
<body>
  <fieldset>
    <legend>ユーザー登録一覧（編集）</legend>
    <a href="p1_signp.php">入力画面</a>
    <table>
      <thead>
        <tr>
          <th>ユーザー名</th>
          <th>email</th>
          <th>pass</th>
          <th></th>
          <th></th>
        </tr>
      </thead>
      <tbody>
        <?= $output ?>
      </tbody>
    </table>
  </fieldset>
</body>

</html>
