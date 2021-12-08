<?php
// related headers initialized
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
  
// required files included
include_once '../config/core.php';
include_once '../config/database.php';
include_once '../objects/book.php';
  
// database connection initialized
$database = new Database();
$db = $database->set_connection();
  
// Book object created
$book = new Book($db);

$data = json_decode(file_get_contents("php://input"));

// set ISBN attr to read
$book->ISBN = $data->ISBN;


if($book->delete()){ // delete the book
    http_response_code(200); //set response code

    echo json_encode(
            array(
                "error_code"    => "0000",
                "error_message" => "Book was deleted."
            )
        );
}
else{
    http_response_code(200); //set response code

    echo json_encode(
            array(
                "error_code"    => "0001",
                "error_message" => "Unable to delete."
            )
        );
}
?>