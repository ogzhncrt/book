<?php
// related headers initialized
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Allow-Credentials: true");
header('Content-Type: application/json');
  
// required files included
include_once '../config/core.php';
include_once '../config/database.php';
include_once '../objects/book.php';
  
// database connection initialized
$database = new Database();
$db = $database->set_connection();
  
// Book object created
$book = new Book($db);
  
// set ISBN attr to read

if(isset($_GET['ISBN'])) {
	// Book object created
	$book = new Book($db);
	
	$book->ISBN = $_GET['ISBN'];

	$book->read(); // read details of book
  
	if($book->title != null){

	    $book_data = array(
			"ISBN"           => $book->ISBN,
			"title"          => $book->title,
			"image"          => $book->image,
			"author_name"    => $book->author_name,
			"author_surname" => $book->author_surname,
			"author_rating"  => $book->author_rating,
			"created"        => $book->created
	    );
	    
	    http_response_code(200); //set response code
	    
	    echo json_encode($book_data);
	}
	else {
		
	    http_response_code(200); //no content(201)
	    /* 
	    	Bug : when I set to 201 I can see anything as a result 
	    */
	    
	    echo json_encode(
	    		array(
						"error_code"    => "0001",
						"error_message" => "Book does not exist."
	    			)
	    	);
	}
}
else{
	http_response_code(406); //not acceptable(406)
    
    echo json_encode(
    		array(
					"error_code"    => "0001",
					"error_message" => "ISBN is not exist."
    			)
    	);
}

?>