<?php
/**
 * Add comment file
 *
 * @version 1.0
 * @author  Dmitry Balandin <dmitry.balandin.1990@gmail.com>
 */
if (!isset($_POST['news_id'], $_POST['author'], $_POST['text'])) {
    exit();
}

require 'NewsDB.class.php';

$news = new NewsDB;

$news_id = (int)$_POST['news_id'];
$author  = $news->clearStr($_POST['author']);
$text    = $news->clearStr($_POST['text']);

$news->addNewsComment($news_id, $author, $text);
header('Location: index.php');