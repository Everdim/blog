<?php
/**
 * Interface INewsDB with main methods
 *
 * @version 1.0
 * @author Dmitry Balandin <dmitry.balandin.1990@gmail.com>
 */

/**
 * Interface INewsDB
 */
interface INewsDB
{
    /**
     * Add new post in news feed
     *
     * @param string $title - заголовок новости
     * @param string $description - текст новости
     *
     * @return boolean - результат успех/ошибка
     */
    function saveNews($title, $description);

    /**
     * Get posts from news feed
     *
     * @return array - результат выборки приходит в виде массива
     */
    function getNews();

    /**
     * Add comment to news feed
     *
     * @param $news_id - id новости
     * @param $author - имя автора комментария
     * @param $text - текст комментария
     *
     * @return mixed
     */
    function addNewsComment($news_id, $author, $text);

    /**
     * Get comment from news feed
     *
     * @param $news_id
     *
     * @return mixed
     */
    function getNewsComment($news_id);
}