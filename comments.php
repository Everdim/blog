<?php
echo '<h2>Комментарии</h2>';
$result = $news->getNewsComments($id);
if (count($result)) {
    echo '<ul>';
    foreach ($result as $comment) {
        echo '<li><b>' . $comment['author'] . '</b>: ' . $comment['text'] . '</li>';
    }
    echo '</ul>';
} else {
    echo 'Комментариев нет';
}
include 'comment.php';
?>