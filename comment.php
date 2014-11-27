<div class="post_comment" style="cursor: pointer; color: blue;">Добавить комментарий:</div>
<div class="add_commentsform" id="comments_addform" style="display: none;">
    <form action="add_comment.php" method="post">
        <input name="news_id" type="hidden" value="<?php echo $id; ?>">

        <p><label>Ваше имя: </label><input name="author" type="text" size="40" maxlength="30" placeholder="Введите имя">
        </p>

        <p><label>Текст комментария: <br/><textarea name="text" cols="62" rows="6"
                                                    placeholder="Текст комментария..."></textarea></label></p>

        <p>

        <p><input type="submit" value="Комментировать"/></p>
    </form>
</div>