<?php
header('Content-Type: text/html; charset=utf-8');
require 'NewsDB.class.php';
$news = new NewsDB;
$errMsg = ' ';
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="ru" lang="ru">
<head>
    <title>Блог</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <script type="text/javascript" src="http://code.jquery.com/jquery-1.11.1.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function ($) {
            $('.post_comment').click(function () {
                $(this).next().toggle();
            });
        });
    </script>
</head>
<body>

<h1>Новости</h1>
<?php
include 'get_news.php';
?>
<br/><br/>
<a href="add.php">Добавить новость</a>

</body>
</html>