<?php
/**
 * Add news file
 *
 * @version 1.0
 * @author  Dmitry Balandin <dmitry.balandin.1990@gmail.com>
 */
header('Content-Type: text/html; charset=utf-8');
require 'NewsDB.class.php';
$news   = new NewsDB;
$errMsg = ' ';
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    include 'save_news.php';
}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="ru" lang="ru">
<head>
    <title>Блог</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
</head>
<body>

<h1>Новости</h1>
<?php
if ($errMsg) {
    echo "<h3>$errMsg<h3/>";
}
?>
<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
    Заголовок новости:<br/>
    <input type="text" name="title"/><br/>
    <br/>
    Текст новости:<br/>
    <textarea name="description" cols="50" rows="5" placeholder="Введите текст новости..."></textarea><br/>
    <br/>
    <input type="submit" value="Добавить!"/>
</form>
</body>
</html>