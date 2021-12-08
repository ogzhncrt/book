**Read**
----
  Use this method to fetch a book using ISBN

* **URL**

  book/read.php?ISBN={ISBN-NUMBER}

* **Method:**

  `GET`
  
*  **URL Params**

   **Required:**
 
   `ISBN=[string]`

   **Optional:**
 
   `no param`


* **Success Response:**

  * **Code:** 200 <br />
    **Content:** 
    ```json
      {
          "ISBN"           : "978-0-1976-6486-5",
          "title"          : "Shelf Life: Chronicles of a Cairo Bookseller",
          "image"          : "book4.jpg",
          "author_name"    : "Nadia",
          "author_surname" : "Wassef",
          "author_rating"  : "2.72",
          "created"        : "2021-12-08 15:54:05"
      }
    ```
 
* **Error Response:**

  * **Code:** 204 No Content <br />
    **Content:** 
    ```json
    {
    "error_code"    : "0001",
    "error_message" : "Book does not exist."
    }
    ```


* **Sample Call:**

  `GET book/read.php?ISBN=978-0-1976-6486-51`

**Delete**
----
  Use this method to delete a book using ISBN

* **URL**

  book/delete.php

* **Method:**

  `POST`
  
*  **URL Params**

   **Required:**
 
   `no param`

   **Optional:**
 
   `no param`

* **Data Params**

    ```json
      {
          "ISBN" : "978-0-1976-6486-5"
      }
    ```


* **Success Response:**

  * **Code:** 200 <br />
    **Content:** 
    ```json
      {
        "error_code"    : "0000",
        "error_message" : "Book was deleted."
      }
    ```
 
* **Error Response:**

  * **Code:** 204 No Content <br />
    **Content:** 
    ```json
    {
    "error_code"    : "0001",
    "error_message" : "Unable to delete."
    }
    ```


* **Sample Call:**

  `POST book/delete.php`
  ```json
      {
          "ISBN" : "978-0-1976-6486-5"
      }
    ```

**Create**
----
  Use this method to create a book,
  The function will add the author that you send if it is not in database,
  if the author is in the database, the function will use it's `author_id`.

* **URL**

  book/create.php

* **Method:**

  `POST`
  
*  **URL Params**

   **Required:**
 
   `no param`

   **Optional:**
 
   `no param`

* **Data Params**

    ```json
      {
        "title"          : "The Art of War",
        "ISBN"           : "712-78-3789-759",
        "image"          : "image5.jpg",
        "author_name"    : "Sun",
        "author_surname" : "Tzu"
      }
    ```


* **Success Response:**

  * **Code:** 201 <br />
    **Content:** 
    ```json
      {
          "error_code"    : "0000",
          "error_message" : "The book has been added (ISBN - 712-78-3789-759) with new author(Sun Tzu)."
      }
    ```
 
* **Error Response:**

  * **Code:** 406 Not Acceptable <br />
    **Content:** 
    ```json
      {
        "error_code"    : "0003",
        "error_message" : "There is a book with the same ISBN."
      }
    ```
    OR
    ```json
      {
        "error_code"       : "0002",
        "error_message"    : "Validation error has occured!",
        "validation_errors": {
            "ISBN"           : "'ISBN' cannot be lesser than 10 characters.",
            "author_surname" : "'author_surname' cannot be lesser than 1 character."
        }
      }
    ```

* **Sample Call:**

  `POST book/create.php`
  ```json
      {
        "title"          : "The Art of War",
        "ISBN"           : "712-78-3789-759",
        "image"          : "image5.jpg",
        "author_name"    : "Sun",
        "author_surname" : "Tzu"
      }
    ```


**Update**
----
  Use this method to update a book using it's ISBN,
  The function will add the author that you send if it is not in database,
  if the author is in the database, the function will use it's `author_id` to update the book.

* **URL**

  book/update.php

* **Method:**

  `POST`
  
*  **URL Params**

   **Required:**
 
   `no param`

   **Optional:**
 
   `no param`

* **Data Params**

    ```json
      {
        "title"          : "The Art of War 2",
        "ISBN"           : "712-78-3789-7591",
        "image"          : "image5.jpg",
        "author_name"    : "Sun",
        "author_surname" : "Tzu"
      }
    ```


* **Success Response:**

  * **Code:** 201 <br />
    **Content:** 
    ```json
      {
          "error_code"    : "0000",
          "error_message" : "The book has been updated (ISBN - 712-78-3789-759) with existing author(Sun Tzu)."
      }
    ```
 
* **Error Response:**

  * **Code:** 406 Not Acceptable <br />
    **Content:** 
    ```json
      {
        "error_code"    : "0003",
        "error_message" : "There is no book with this ISBN (712-78-3789-759)."
      }
    ```
    OR
    ```json
      {
        "error_code"       : "0002",
        "error_message"    : "Validation error has occured!",
        "validation_errors": {
            "ISBN"           : "'ISBN' cannot be lesser than 10 characters.",
            "author_surname" : "'author_surname' cannot be lesser than 1 character."
        }
      }
    ```

* **Sample Call:**

  `POST book/update.php`
  ```json
      {
        "title"          : "The Art of War 2",
        "ISBN"           : "712-78-3789-7591",
        "image"          : "image5.jpg",
        "author_name"    : "Sun",
        "author_surname" : "Tzu"
      }
    ```