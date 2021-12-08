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