<?php
/**
 * Save news file
 *
 * @version 1.0
 * @author  Dmitry Balandin <dmitry.balandin.1990@gmail.com>
 */
$title       = $news->clearStr($_POST['title']);
$description = $news->clearStr($_POST['description']);
if (empty($title) or empty($description)) {
    $errMsg = 'Заполните обязательные поля!';
} else {
    $news->saveNews($title, $description);
    header('Location: index.php');
}