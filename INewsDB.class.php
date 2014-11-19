<?php

/**интерфейс с основными методами **/
interface INewsDB
{
    /**
     *    Добавление новой записи в новостную ленту
     *
     * @param string $title - заголовок новости
     * @param string $description - текст новости
     *
     * @return boolean - результат успех/ошибка
     */
    function saveNews($title, $description);

    /**
     *    Выборка всех записей из новостной ленты
     *
     * @return array - результат выборки приходит в виде массива
     */
    function getNews();

    /**
     *    Добавление комментария к новостной ленте
     *
     * @param string $author - имя автора
     *
     * @param string $comment - текст комментария
     */
    function addNewsComment($news_id, $author, $text);
}

?>