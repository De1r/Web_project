<?php
include_once 'db.php';

class goods extends db
{

    public $pagination;


    function save($item)
    {
        var_dump("save");
        $good = json_decode($item)->title;
        $price = json_decode($item)->price;
        $img = json_decode($item)->img;
        $discription = json_decode($item)->discription;
        $artikul = json_decode($item)->artikul;
        $id = uniqid();
        $type = json_decode($item)->type;
        $connect =  parent::extendConnect('localhost');

        $sql = "INSERT INTO `goods`(
                                 `id` , `title`,   `price`,     `img`  , `discr` , `article` , `category`
                            ) VALUES (  
                                '$id' , '$good',  '$price' ,  '$img' , '$discription' , '$artikul' , '$type'
                            )";

        $result = mysqli_query($connect, $sql);
        if ($result) {
            echo 'Запрос успешно сработал';
        } else echo $sql . 'ERRROR';
    }

    function getItem($id)
    {
        $linkFromParent = parent::extendConnect('localhost');
        $query = "select * from goods where id='" . $id . "'";
        $result = $linkFromParent->query($query);

        return $result;
    }

    function getList()
    {
        $link = parent::extendConnect('localhost');
        $num = 4;
        $page = $_GET['page'];
        $result = mysqli_query($link, "SELECT COUNT(*) FROM goods");
        $posts = mysqli_fetch_row($result)[0];
        $total = intval(($posts - 1) / $num) + 1;
        $page = intval($page);
        if (empty($page) or $page < 0) $page = 1;
        if ($page > $total) $page = $total;
        $start = $page * $num - $num;
        $result = mysqli_query($link, "SELECT * FROM goods LIMIT $start, $num");
        if ($page != 1) $pervpage = '<a href= ./?page=1><<</a>
                                    <a href= ./?page=' . ($page - 1) . '><</a> ';
        if ($page != $total) $nextpage = ' <a href= ./?page=' . ($page + 1) . '>></a>
                                        <a href= ./?page=' . $total . '>>></a>';
        if ($page - 2 > 0) $page2left = ' <a href= ./?page=' . ($page - 2) . '>' . ($page - 2) . '</a> | ';
        if ($page - 1 > 0) $page1left = '<a href= ./?page=' . ($page - 1) . '>' . ($page - 1) . '</a> | ';
        if ($page + 2 <= $total) $page2right = ' | <a href= ./?page=' . ($page + 2) . '>' . ($page + 2) . '</a>';
        if ($page + 1 <= $total) $page1right = ' | <a href= ./?page=' . ($page + 1) . '>' . ($page + 1) . '</a>';
        $this->setPagination($pervpage, $page2left, $page1left, $page, $page1right, $page2right, $nextpage);
        return $result;
    }


    function setPagination($pervpage, $page2left, $page1left, $page, $page1right, $page2right, $nextpage)
    {
        $this->pagination = $pervpage . $page2left . $page1left . '<b>' . $page . '</b>' . $page1right . $page2right . $nextpage;
    }

    function getPagination()
    {
        return $this->pagination;
    }

    function getCategory($type)
    {
        $linkFromParent = parent::extendConnect('localhost');
        $num = 4;
        $page = $_GET['page'];
        $result = mysqli_query($linkFromParent, "SELECT COUNT(*) FROM goods WHERE category='$type'");
        $posts = mysqli_fetch_row($result)[0];
        $total = intval(($posts - 1) / $num) + 1;
        $page = intval($page);
        if (empty($page) or $page < 0) $page = 1;
        if ($page > $total) $page = $total;
        $start = $page * $num - $num;
        $query = "select * from goods WHERE category='$type' LIMIT $start, $num";
        $result = $linkFromParent->query($query);
        if ($page != 1) $pervpage = '<a href= ./?type=' . $type . '&page=1><<</a>
                                    <a href= ./?type=' . $type . '&page=' . ($page - 1) . '><</a> ';
        if ($page != $total) $nextpage = ' <a href= ./?type=' . $type . '&page=' . ($page + 1) . '>></a>
                                        <a href= ./?type=' . $type . '&page=' . $total . '>>></a>';
        if ($page - 2 > 0) $page2left = ' <a href= ./?type=' . $type . '&page=' . ($page - 2) . '>' . ($page - 2) . '</a> | ';
        if ($page - 1 > 0) $page1left = '<a href= ./?type=' . $type . '&page=' . ($page - 1) . '>' . ($page - 1) . '</a> | ';
        if ($page + 2 <= $total) $page2right = ' | <a href= ./?type=' . $type . '&page=' . ($page + 2) . '>' . ($page + 2) . '</a>';
        if ($page + 1 <= $total) $page1right = ' | <a href= ./?type=' . $type . '&page=' . ($page + 1) . '>' . ($page + 1) . '</a>';
        $this->setPagination($pervpage, $page2left, $page1left, $page, $page1right, $page2right, $nextpage);
        return $result;
    }
    function getCountCategory($type)
    {
        $linkFromParent = parent::extendConnect('localhost');
        $sql = 'SELECT COUNT(*) FROM goods WHERE category="' . $type . '"';
        $result = mysqli_query($linkFromParent, $sql);
        if ($result) {
            $s = $result->fetch_assoc();
            return $s["COUNT(*)"];
        } else echo $sql;
    }
}
