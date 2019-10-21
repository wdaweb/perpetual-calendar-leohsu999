<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <meta http-equiv="X-UA-Compatible" content="ie=edge">
   <title>綜合練習-萬年曆製作</title>
   <link rel="stylesheet" href="animate.css">
   <style>
   * {
      list-style-type: none;
      text-align: center;
      transition: 0.5s all;
   }

   .bg {
      background: #EB8258;
      color: #F6F740;
   }

   table {
      border-collapse: separate;
      border-spacing: 0;
      border: none;
      margin: auto;
      font-size: 1.5rem;
      border-radius: 10px;
      margin-top: 1rem;
   }

   table td {
      border: none;
      padding: 10px;
      width: 30px;
      height: 30px;
      border-radius: 50%;
   }

   tr:first-child {
      color: #4834d4;
   }

   body {
      font-family: "微軟正黑體";
      background: #7fdcbf;
      background: url('bg.jpg') no-repeat center center/cover;
      display: flex;
      justify-content: center;
      align-items: center;
      width: 100vw;
      height: 100vh;
      overflow: hidden;
   }

   a {
      text-decoration: none;
      font-size: 1.5rem;
   }

   .wrapper {
      display: inline-block;
      box-shadow: 0 0 15px rgba(0, 0, 0, 0.5);
      background: white;
      border-radius: 1rem;
      padding: 1rem;
   }

   .d-flex {
      width: 93%;
      margin: auto;
      display: flex;
      justify-content: space-between;
      background-color: #000;
      border-radius: 2rem;
      padding: 0.5rem;
      position: relative;
   }

   /* 左箭頭 */
   .prev {
      transform: rotate(90deg);
      filter: invert(100%);
      width: 20px;
      margin-left: 0.3rem;
   }

   .prev-word {
      display: inline-block;
      height: 30px;
      line-height: 30px;
      border-radius: 0.5rem;
      padding: 0 0.5rem;
      background: #FFF;
      pointer-events: none;
      position: absolute;
      top: 10px;
      left: -50px;
      transform: scale(1);
      transform-origin: right top;
      opacity: 0;
   }

   .show:hover+.prev-word {
      /* position: relative; */
      top: -10px;
      left: -78px;
      display: block;
      opacity: 1;
      transform: scale(1.5);
   }

   .prev-word::after {
      content: '';
      position: absolute;
      right: -10px;
      top: 50%;
      width: 0;
      height: 0;
      border-style: solid;
      border-width: 5px 0 5px 10px;
      border-color: transparent transparent transparent #FFF;
      transform: translateY(-50%);
   }

   /* 右箭頭 */
   .next {
      transform: rotate(-90deg);
      filter: invert(100%);
      width: 20px;
      margin-right: 0.3rem;
   }

   .next-word {
      display: inline-block;
      height: 30px;
      line-height: 30px;
      border-radius: 0.5rem;
      padding: 0 0.5rem;
      background: #FFF;
      pointer-events: none;
      position: absolute;
      top: 10px;
      right: -50px;
      transform: scale(1);
      transform-origin: right top;
      opacity: 0;
   }

   .show:hover+.next-word {
      /* position: relative; */
      top: -10px;
      right: -110px;
      display: block;
      opacity: 1;
      transform: scale(1.5);
   }

   .next-word::after {
      content: '';
      position: absolute;
      left: -9px;
      top: 50%;
      width: 0;
      height: 0;
      border-style: solid;
      border-width: 5px 10px 5px 0;
      border-color: transparent #FFF transparent transparent;
      transform: translateY(-50%);
   }

   .center-word {
      color: white;
      font-size: 1.5rem;
   }

   /* 表格圓角 */
   /*第一欄第一列：左上*/
   /* tr:first-child td:first-child {
      border-top-left-radius: 10px;
   } */

   /*第一欄最後列：左下*/
   /* tr:last-child td:first-child {
      border-bottom-left-radius: 10px;
   } */

   /*最後欄第一列：右上*/
   /* tr:first-child td:last-child {
      border-top-right-radius: 10px;
   } */

   /*最後欄第一列：右下*/
   /* tr:last-child td:last-child {
      border-bottom-right-radius: 10px;
   } */
   </style>
</head>

<body>

   <?php
   date_default_timezone_set("Asia/Taipei");

   if (!empty($_GET['month'])) {
      $month = $_GET['month'];
   } else {
      $month = date("m");
   }
   //$month = (!empty($_GET['month']))? $_GET['month'] : date("m");

   if (!empty($_GET['year'])) {
      $year = $_GET['year'];
   } else {
      $year = date("Y");
   }
   // 顯示 10月-2019年 
   // echo "<h2>" . $month . "月-" . $year . "年</h2>";
   $sd = [
      9 => "生日",
      10 => "國慶日",
      25 => "光復節",
   ];
   $today = date("Y-m-d");
   $todayDays = date("d");
   $start = "$year-$month-01";
   $startDay = date("w", strtotime($start));
   $days = date("t", strtotime($start));
   $endDay = date("w", strtotime("$year-$month-$days"));


   if (($month - 1) > 0) {
      $premonth = $month - 1;
      $preyear = $year;
   } else {
      $premonth = 12;
      $preyear = $year - 1;
   }

   if (($month + 1) <= 12) {
      $nextmonth = $month + 1;
      $nextyear = $year;
   } else {
      $nextmonth = 1;
      $nextyear = $year + 1;
   }
   ?>

   <div id="wrapper" class="wrapper">
      <!-- 上一月 下一月 -->
      <div class="d-flex">
         <a class="show" href="calendar.php?month=<?php echo $premonth ?>&year=<?php echo $preyear ?>">
            <img src="arrow.png" class="prev">
         </a>
         <span class="prev-word"><?= $month - 1 ?>月</span>
         <!--  顯示 10月-2019年  -->
         <?php echo "<span class='center-word'>" . $year . "-年" . $month . "月</span>"; ?>
         <a class="show" href="calendar.php?month=<?php echo $nextmonth ?>&year=<?php echo $nextyear ?>">
            <img src="arrow.png" class="next"></a>
         </a>
         <span class="next-word"><?= $month + 1 ?>月</span>
      </div>
      <table border="1">
         <tr>
            <td>日</td>
            <td>一</td>
            <td>二</td>
            <td>三</td>
            <td>四</td>
            <td>五</td>
            <td>六</td>
         </tr>
         <?php
            function HighlightToday($year, $month, $startDay,$today, $str, $i, $j)
   	  {
   		  $d = date("Y-m-d", mktime(0, 0, 0, $month, ($i * 7 + $j + 1 - $startDay), $year));
         	if ($d==$today) {
             	echo "	<td class='bg'>" . ($i * 7 + $j + 1 - $startDay).$str."</td>";
         	} else {
             	echo "<td>".($i * 7 + $j + 1 -$startDay) .$str."</td>";
         	}
   	  }
         for ($i = 0; $i < 6; $i++) {

            echo "<tr>";

            for ($j = 0; $j < 7; $j++) {
               if (!empty($sd[$i * 7 + $j + 1 - $startDay])) {
                  $str = "";
               } else {
                  $str = "";
               }
               if ($i == 0) {
                  if ($j < $startDay) {
                     echo "<td></td>";
                  } else {
               HighlightToday($year, $month, $startDay, $today, $str, $i, $j);
                  }
               } else {
                  if (($i * 7 + $j + 1 - $startDay) <= $days) {
               HighlightToday($year, $month, $startDay, $today, $str, $i, $j);
                  } else {
                     // echo "    <td></td>";
                  }
               }
            }
            echo "</tr>";
         }
         ?>

      </table>
   </div>
</body>

</html>