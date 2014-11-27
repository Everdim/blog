<?php
/**
 * NewsDB class
 *
 * @version 1.0
 * @author  Dmitry Balandin <dmitry.balandin.1990@gmail.com>
 */
require 'INewsDB.class.php';

/**
 * Class NewsDB
 */
class NewsDB implements INewsDB
{
    /**
     * @var SQLite3 - DB object
     */
    protected $_db;
    /**
     * @var string - DB name and location
     */
    private $_dbname;

    /**
     * Constructor
     * Create table msgs in DB
     */
    function __construct()
    {
        $this->_dbname = dirname(__FILE__).'\blog.db';
        if (is_file($this->_dbname)) {
            $this->_db = new SQLite3($this->_dbname);
        } else {
            $this->_db = new SQLite3($this->_dbname);
            $sql       = "CREATE TABLE msgs(
						  id INTEGER PRIMARY KEY AUTOINCREMENT,
						  title TEXT,
						  description TEXT)";
            $this->_db->exec($sql) or die($this->_db->lastErrorMsg());

            $this->createCommentsTable();
        }
    }

    /**
     * Create table comments in DB
     */
    function createCommentsTable()
    {
        $sql = "CREATE TABLE IF NOT EXISTS comments(
				id INTEGER,
				news_id INTEGER,
				author TEXT,
				text TEXT)";
        $this->_db->exec($sql) or die($this->_db->lastErrorMsg());
    }

    /**
     * Destructor
     */
    function __destruct()
    {
        unset($this->_db);
    }

    /**
     * Check input data for save_news.php
     *
     * @param string $data
     *
     * @return string
     */
    function clearStr($data)
    {
        $data = trim(strip_tags($data));

        return $this->_db->escapeString($data);
    }

    /**
     * Check input data for save_news.php
     *
     * @param int $data
     *
     * @return number
     */
    function clearInt($data)
    {
        return abs((int)$data);
    }

    /**
     * Add news in DB
     *
     * @param string $title
     * @param string $description
     *
     * @return bool|void
     */
    function saveNews($title, $description)
    {
        $sql = "INSERT INTO msgs(
                title,
                description)
                VALUES('$title', '$description')";
        $this->_db->exec($sql) or die($this->_db->lastErrorMsg());
    }

    /**
     * Get news from DB
     *
     * @return array
     */
    function getNews()
    {
        $sql = "SELECT
				id, title, description
				FROM msgs
				ORDER BY id DESC";
        $res = $this->_db->query($sql) or die($this->_db->lastErrorMsg());

        return $this->db2Arr($res);
    }

    /**
     * The result of getNews, must be array, create method that convert DB to Array
     *
     * @param $data
     *
     * @return array
     */
    protected function db2Arr($data)
    {
        //create intermediate empty array, cause result can be empty array
        $arr = array();
        //if array isn't empty:
        while ($row = $data->fetchArray(SQLITE3_ASSOC)) {
            $arr[] = $row;
        }

        return $arr;
    }

    /**
     * Add comment in DB
     *
     * @param $news_id - news id
     * @param $author  - comment author name
     * @param $text    - comment text
     *
     * @return mixed|void
     */
    function addNewsComment($news_id, $author, $text)
    {
        $sql = "INSERT INTO comments 
                (news_id, author, text)
                VALUES($news_id, '$author', '$text')";
        $this->_db->exec($sql) or die($this->_db->lastErrorMsg());
    }

    /**
     * Get comment from DB
     *
     * @param $news_id - news id
     *
     * @return array|mixed
     */
    function getNewsComment($news_id)
    {
        $sql = "SELECT
                id, author, text
                FROM comments
                WHERE news_id = ".$news_id."
                ORDER BY id DESC";
        $res = $this->_db->query($sql) or die($this->_db->lastErrorMsg());

        return $this->db2Arr($res);
    }
}