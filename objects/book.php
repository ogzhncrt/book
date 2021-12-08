<?php

class Book {
  
    public $ISBN;
    public $title;
    public $image;
    public $author_name;
    public $author_surname;
    public $author_rating;
    public $created;
  
    public function __construct($db) {
        $this->conn = $db;
    }

    /**
     * @author Oğuzhan Cerit
     * 
     * This function provides to read 
     * a book from database by using current
     * $ISBN.
     *
     * @param no-param
     *
     * @since 0.0.1
     *
     */
    public function read() {
        $safe_ISBN = $this->safety_pipeline($this->ISBN);

        $query = "SELECT
                        book_title,
                        book_ISBN,
                        book_image,
                        book_created,
                        author_name,
                        author_surname,
                        author_rating
                    FROM ".$this->books_table."
                        LEFT JOIN ".$this->authors_table." 
                            ON book_author_id = author_id
                    WHERE 
                        book_ISBN          = ".$safe_ISBN." AND
                        book_remove_status = '".$GLOBALS["REMOVE_STATUS_FALSE"]."'
                    LIMIT 1";

        $statement = $this->conn->prepare($query);
        $statement->execute();

        $book = $statement->fetch(PDO::FETCH_ASSOC);

        if($book) {
            $this->ISBN           = $book["book_ISBN"];
            $this->title          = $book["book_title"];
            $this->image          = $book["book_image"];
            $this->author_name    = $book["author_name"];
            $this->author_surname = $book["author_surname"];
            $this->author_rating  = $book["author_rating"];
            $this->created        = $book["book_created"];
        }
    }

    /**
     * @author Oğuzhan Cerit
     * 
     * This function provides to delete 
     * a book from database by using current
     * $ISBN.
     *
     * @param no-param
     *
     * @since 0.0.1
     *
     */
    public function delete() {
        $safe_ISBN = $this->safety_pipeline($this->ISBN);

        $query = "UPDATE ".$this->books_table."
                    SET book_remove_status = '".$GLOBALS["REMOVE_STATUS_TRUE"]."'
                    WHERE 
                        book_ISBN = ".$safe_ISBN."
                    LIMIT 1";

        $statement = $this->conn->prepare($query);
        
        if($statement->execute()){
            /*  
                Bug : It can be checked whether a book has 
                actually been deleted or not. There may 
                not be a book with the sended ISBN.
            */
            return TRUE;
        }

        return FALSE;
    }

    /**
     * @author Oğuzhan Cerit
     * 
     * This function provides to create 
     * a book from database by using current
     * object.
     *
     * @param no-param
     *
     * @since 0.0.1
     *
     */
    public function create() {

    }

    /**
     * @author Oğuzhan Cerit
     * 
     * This function provides to delete 
     * a book from database by using current
     * object and ISBN.
     *
     * @param no-param
     *
     * @since 0.0.1
     *
     */
    public function update() {
    }

    /**
     * @author Oğuzhan Cerit
     * 
     * To prevent XSS attack and SQL Injection.
     *
     * @param data String or Array
     *
     * @since 0.0.1
     *
     */
    private function safety_pipeline($data) {
        if (!$data) {
            return null;
        }

        if (is_string($data)) {
            return $this->make_safe($data);
        }

        foreach ($data as $key => $value) {
            $data[$key] = $this->make_safe($value);
        }

        return $data;
    }

    private function make_safe($data_string) {
        if ($data_string == "0") {
            return $data_string;
        }

        if (!$data_string) {
            return null;
        }

        if (!is_string($data_string)) {
            return null;
        }

        $result = null;

        $result = $this->escape_SQL_injection($data_string);
        $result = $this->escape_XSS_injection($result);

        return $result;
    }

    private function escape_SQL_injection($data_string) {
        if (!$data_string || !is_string($data_string)){
            return null;
        }
        else {
            return $this->escape($data_string);
        }
    }

    private function escape_XSS_injection($data_string) {
        if (!$data_string || !is_string($data_string)){
            return null;
        }

        $data_string = htmlspecialchars($data_string);
        $data_string = $this->xss_clean($data_string);
        return $data_string;
    }

    private function escape($data_string) {
        if (is_array($data_string)) {
            $data_string = array_map(array(&$this, 'escape'), $data_string);
            return $data_string;
        }
        elseif (is_string($data_string) OR (is_object($data_string) && method_exists($data_string, '__toString'))) {
            /* 
                Bug: Needs to develop for %(like) comparison 
            */
            return "'".$data_string."'";
        }
        elseif (is_bool($data_string)) {
            return ($data_string === FALSE) ? 0 : 1;
        }
        elseif ($data_string === NULL) {
            return 'NULL';
        }

        return $data_string;
    }

    private function xss_clean($data_string) {
        /*
            Bug : Develop to prevent XSS atack.
        */
        return $data_string;
    }

    private $conn;
    private $books_table   = "books";
    private $authors_table = "authors";