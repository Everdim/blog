<?php
/**
 * NewsBD class
 *
 * @version 1.0
 * @author  Dmitry Balandin <dmitry.balandin.1990@gmail.com>
 */
require 'INewsDB.class.php';

/**
 * Interface with major methods
 *
 * @version 1.0
 * @author Dmitry Balandin <dmitry.balandin.1990@gmail.com>
 */
class NewsDB implements INewsDB
{
    protected $_db;
    private $_dbname;

    function __construct()
    {
        $this->_dbname = dirname(__FILE__) . '\blog.db';
        if (is_file($this->_dbname)) {
            $this->_db = new SQLite3($this->_dbname);
        } else {
            $this->_db = new SQLite3($this->_dbname);
            $sql = "CREATE TABLE msgs(
						    id INTEGER PRIMARY KEY AUTOINCREMENT,
						    title TEXT,
						    description TEXT)";
            $this->_db->exec($sql) or die($this->_db->lastErrorMsg());

            $this->createCommentsTable();
        }
    }

    function createCommentsTable()
    {
        $sql = "CREATE TABLE IF NOT EXISTS comments(
				id INTEGER,
				news_id INTEGER,
				author TEXT,
				text TEXT)";
        $this->_db->exec($sql) or die($this->_db->lastErrorMsg());
    }

    //проверка входных данных для save_news.php

    function __destruct()
    {
        unset($this->_db);
    }

    function clearStr($data)
    {
        $data = trim(strip_tags($data));
        return $this->_db->escapeString($data);
    }

    function clearInt($data)
    {
        return abs((int)$data);
    }

    //Результатом getNews должен быть возврат массива, поэтому создаем метод "перегоняющий ДБ в массив"

    function saveNews($title, $description)
    {
        $sql = "INSERT INTO msgs(
				title,
				description)
				VALUES('$title', '$description')";
        $this->_db->exec($sql) or die($this->_db->lastErrorMsg());

    }

    function getNews()
    {
        $sql = "SELECT
				id, title, description
				FROM msgs
				ORDER BY id DESC";
        $res = $this->_db->query($sql) or die($this->_db->lastErrorMsg());
        return $this->db2Arr($res);
    }

    protected function db2Arr($data)
    {
        //создаем промежуточный пустой массив, т.к. результатом может быть пустой массив
        $arr = array();
        //если не пустой:
        while ($row = $data->fetchArray(SQLITE3_ASSOC))
            $arr[] = $row;
        return $arr;
    }

    function addNewsComment($news_id, $author, $text)
    {
        $sql = "INSERT INTO comments 
                (news_id, author, text)
                VALUES($news_id, '$author', '$text')";
        $this->_db->exec($sql) or die($this->_db->lastErrorMsg());
    }

    function getNewsComment($news_id)
    {
        $sql = "SELECT
                id, author, text
                FROM comments
                WHERE news_id = " . $news_id . "
                ORDER BY id DESC";
        $res = $this->_db->query($sql) or die($this->_db->lastErrorMsg());
        return $this->db2Arr($res);
    }

}