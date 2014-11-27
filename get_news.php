<?php
/**
 *
 */

$result = $news->getNews();
echo '<p>Всего последних новостей: ' . count($result);
foreach ($result as $item) {
    $id = $item['id'];
    $title = $item['title'];
    $desc = nl2br($item['description']);
    ?>
    <hr>
    <div>
        <h3><?php echo $title; ?></h3>

        <p><?php echo $desc; ?></p>
        <?php include "comments.php"; ?>
    </div>
<?php
}
