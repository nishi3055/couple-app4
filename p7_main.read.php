<?php
session_start();
include("functions.php");
check_session_id();

$pdo = connect_to_db();

$sql = "SELECT * FROM diary_text ORDER BY event ASC";

$stmt = $pdo->prepare($sql);

$user_id= $_SESSION['user_id'];

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
      <td>{$record["event"]}</td>
      <td>{$record["date"]}</td>
      <td>{$record["comment"]}</td>
      <td><a href='p7_good_create.php?user_id={$user_id}&diary_id={$record["id"]}'>good</a></td>
      <td><a href='p7_main_edit.php?id={$record["id"]}'>edit</a></td>
      <td><a href='p5_delete.php?id={$record["id"]}'>delete</a></td>
    </tr>
  ";
}

?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.13/index.global.min.js'></script>
    <link rel ="stylesheet" href = "https://unpkg.com/ress/dist/ress.min.css">
    <link rel ="stylesheet" href="css/main.css">
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            var calendarEl = document.getElementById('calendar');
            var calendar = new FullCalendar.Calendar(calendarEl, {
                locale: 'ja',
                height: 'auto',
                firstDay: 1,
                headerToolbar: {
                left: "today prev,next",
                center: "title",
                right: "dayGridMonth,listMonth"
                },
                buttonText: {
                    dayGridMonth: '月',
                    listMonth: '今月のevent',
                    today: '今月',
                },
                // 日付をクリック、または範囲を選択したイベント
                selectable: true,
                select: function (info) {
                    //alert("selected " + info.startStr + " to " + info.endStr);

                    // 入力ダイアログ
                    const eventName = prompt("予定を入力してください");

                    if (eventName) {
                        // イベントの追加
                        calendar.addEvent({
                            title: eventName,
                            start: info.start,
                            end: info.end,
                            allDay: true,
                        });
                    }
                    
                },

            });
            
            calendar.render();
        });

    </script>
    <title>Document</title>
</head>
<body>
    <a href="p10_logout.php">logout</a>
    <div class = "wrapper">
        <article>
            <!-- Calendar -->
            <div id='calendar'></div>
        </article>
        <aside>
            <fieldset>
                <legend>記録（一覧画面）</legend>
                <a href="p7_main.php">入力画面</a>
                <table>
                    <thead>
                        <tr>
                            <th>event</th>
                            <th>date</th>
                            <th>comment</th>
                            <th></th>
                            <th></th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?= $output ?>
                    </tbody>
                </table>
                </fieldset>
            </form>
        </aside>
    </div>
    <div class='wrapper-grid'>
        <div class='item'>
            <div class = "post-info">
                <p class = "post-title">夫婦</p>
            </div>
        </div>
        <div class='item'>
            <img src="img/hand.png">
                <p>仲直り</p>
            </div>
        </div>
        <div class='item'>
            <img src="img/okay.png">
                <p>リフレッシュ</p>
            </div>
        </div>
    </div>

    
</body>
</html>
