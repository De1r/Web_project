<?php

$login = 'alexweber';
$pass = 'NordicItSchool';

$login = 'root';
$pass = '';
$name_base = 'magazine_lession';
$host = 'localhost';
$link = new mysqli($host, $login, $pass, $name_base);
$num = 3;
$page = $_GET['page'];
$result = mysqli_query($link, "SELECT COUNT(*) FROM goods");
$posts = mysqli_fetch_row($result)[0];
$total = intval(($posts - 1) / $num) + 1;
$page = intval($page);
if (empty($page) or $page < 0) $page = 1;
if ($page > $total) $page = $total;
$start = $page * $num - $num;
$result = mysqli_query($link, "SELECT * FROM goods LIMIT $start, $num");
while ($postrow[] = mysqli_fetch_array($result)) ?>

<?php
echo "<section>";
for ($i = 0; $i < $num; $i++) {
    echo "<pre>
         <p><img src='http://{$_SERVER["SERVER_NAME"]}:{$_SERVER['SERVER_PORT']}/img/catalog/{$postrow[$i]['img']}'</p>
         <p>" . $postrow[$i]['title'] . "</p>
         <p>" . $postrow[$i]['price'] . "</p>
      </pre>
      <p>" . $postrow[$i]['id'] . "</p>";
}
echo "</section>";
?>
<?php
if ($page != 1) $pervpage = '<a href= ./test.php?page=1><<</a>
                               <a href= ./test.php?page=' . ($page - 1) . '><</a> ';
if ($page != $total) $nextpage = ' <a href= ./test.php?page=' . ($page + 1) . '>></a>
                                   <a href= ./test.php?page=' . $total . '>>></a>';
if ($page - 2 > 0) $page2left = ' <a href= ./test.php?page=' . ($page - 2) . '>' . ($page - 2) . '</a> | ';
if ($page - 1 > 0) $page1left = '<a href= ./test.php?page=' . ($page - 1) . '>' . ($page - 1) . '</a> | ';
if ($page + 2 <= $total) $page2right = ' | <a href= ./test.php?page=' . ($page + 2) . '>' . ($page + 2) . '</a>';
if ($page + 1 <= $total) $page1right = ' | <a href= ./test.php?page=' . ($page + 1) . '>' . ($page + 1) . '</a>';
echo $pervpage . $page2left . $page1left . '<b>' . $page . '</b>' . $page1right . $page2right . $nextpage;
?>