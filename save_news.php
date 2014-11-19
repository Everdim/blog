<?php
/*Будем проверять входные данные. Для этого нам нужны методы, см. NewsDB.class.php*/
$title = $news->clearStr($_POST['title']);
$description = $news->clearStr($_POST['description']);
if (empty($title) or empty($description)) {
    $errMsg = 'Заполните обязательные поля!';
} else {
    $news->saveNews($title, $description);
    header('Location: index.php');
}
?>