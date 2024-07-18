<?php
$today = filter_input(INPUT_POST, 'today');
$monthNext = filter_input(INPUT_POST, 'monthNext');
$yearNext = filter_input(INPUT_POST, 'yearNext');
$monthPrev = filter_input(INPUT_POST, 'monthPrev');
$yearPrev = filter_input(INPUT_POST, 'yearPrev');


if($today==1){
    $month = date('n');
    $year = date('Y');
}
if($monthNext > 12){
    $monthNext = 1;
    $yearNext++;
}
if($monthPrev === "0"){
    $monthPrev = 12;
    $yearPrev--;
}
$month = $monthNext??$monthPrev??date('n');
$year =$yearNext??$yearPrev??date('Y');

$last_day = date('j', mktime(0, 0, 0, $month + 1, 0, $year));
$calendar = array();
$j = 0;



for ($i = 1; $i < $last_day + 1; $i++) {
    $week = date('w', mktime(0, 0, 0, $month, $i, $year));
    if ($i == 1) {
        for ($s = 1; $s <= $week; $s++) {
            $calendar[$j]['day'] = '';
            $j++;
        }
    }
    $calendar[$j]['day'] = $i;
    $j++;
    if ($i == $last_day) {
        for ($e = 1; $e <= 6 - $week; $e++) {
            $calendar[$j]['day'] = '';
            $j++;
        }
    }
}

?>

<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="utf-8">
  <title>カレンダー</title>
  <link rel="stylesheet" href="css/calender.css">
</head>

<body>
  <table>
    <thead>
      <tr>
        <form action="" method="post">
          <th><button type="submit" id="prev">
              &laquo;
              <input type="hidden" name="monthPrev" value="<?php echo $month-1;?>">
              <input type="hidden" name="yearPrev" value="<?php echo $year;?>">
            </button></th>
        </form>
        <th id="title" colspan="5"><?php echo $year; ?>年<?php echo $month; ?>月
        </th>
        <form action="" method="post">
          <th><button type="submit" id="next">
              &raquo;
              <input type="hidden" name="monthNext" value="<?php echo $month+1;?>">
              <input type="hidden" name="yearNext" value="<?php echo $year;?>">
            </button></th>
        </form>
      </tr>
      <tr>
        <th class="red">日</th>
        <th>月</th>
        <th>火</th>
        <th>水</th>
        <th>木</th>
        <th>金</th>
        <th class="blue">土</th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <?php $cnt = 0; ?>
        <?php foreach ($calendar as $key => $value): ?>
        <td>
          <p>
            <?php $cnt++; ?>
            <?php echo $value['day']; ?>
          </p>
        </td>
        <?php if ($cnt == 7): ?>
      </tr>
      <tr>
        <?php $cnt = 0; ?>
        <?php endif; ?>
        <?php endforeach; ?>
      </tr>
    </tbody>
    <tfoot>
      <tr>
        <form action="" method="post">
          <td colspan="7">
            <button type="submit" id="today"> 現在に戻る
              <input type="hidden" name="today" value="1">
            </button>
          </td>
        </form>
      </tr>
    </tfoot>
  </table>
</body>
</html>