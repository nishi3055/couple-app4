<?php
    session_start();
    include('functions.php');
    check_session_id();
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
            <form action="p7_main.create.php" method="POST">
                <fieldset>
                <legend>記録</legend>
                <a href="p7_main.read.php">一覧画面</a>
                <div>
                イベント: <input type="text" name="event">
                </div>
                <div>
                日にち: <input type="date" name="date">
                </div>
                <div>
                コメント: <input type="text" name="comment">
                </div>
                <div>
                <button>保存</button>
                </div>
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
