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
  
// get posted data
$data = json_decode(file_get_contents("php://input"));
  
$validation = validate_data($data); //validate data coming from the POST


if($validation["validation_status"]) {
    // set book properties
    $book->ISBN           = $data->ISBN;
    $book->title          = $data->title;
    $book->image          = $data->image;
    $book->author_name    = $data->author_name;
    $book->author_surname = $data->author_surname;
    
    $result = $book->update(); //update book


    if($result["status"]) {
  
        http_response_code(200); //set response code
  
        echo json_encode(
                array(
                    "error_code" => "0000",
                    "error_message" => $result["error_message"]
                )
            );
    }
    else {
        http_response_code(406); //set response code not acceptable
  
        echo json_encode(
                array(
                    "error_code" => "0003",
                    "error_message" => $result["error_message"]
                )
            );
    }
}
else {
    http_response_code(406); //set response code not acceptable
  
    echo json_encode(
            array(
                    "error_code"    => "0002",
                    "error_message" => "Validation error has occured!",
                    "validation_errors" => $validation["validation_errors"]
                )
        );
}

/**
 * @author Oğuzhan Cerit
 * 
 * This function validates to data. If there is
 * an error any of them $validation['validation_status']
 * will be FALSE and all error messages will be in the
 * $validation['validation_errors']
 *
 * @param $data array
 * 
 * @return $validation array
 *
 * @since 0.0.1
 *
 */
function validate_data($data){

    $validation = array(
                        "validation_status" => TRUE,
                        "validation_errors" => array()
                    );

    if(isset($data->title)){
        if(mb_strlen($data->title) < 1) {
            $validation["validation_status"] = FALSE;
            $validation["validation_errors"]["title"] = "'title' cannot be lesser than 1 character.";    
        }
        elseif(mb_strlen($data->title) > 550) {
            $validation["validation_status"] = FALSE;
            $validation["validation_errors"]["title"] = "'title' cannot exceed 550 characters.";
        }
    }
    else{
        $validation["validation_status"] = FALSE;
        $validation["validation_errors"]["title"] = "'title' couldn't be found!";
    }

    if(isset($data->ISBN)){
        if(mb_strlen($data->ISBN) < 10) {
            $validation["validation_status"] = FALSE;
            $validation["validation_errors"]["ISBN"] = "'ISBN' cannot be lesser than 10 characters.";
        }
        elseif(mb_strlen($data->ISBN) > 17) {
            $validation["validation_status"] = FALSE;
            $validation["validation_errors"]["ISBN"] = "'ISBN' cannot exceed 17 characters.";
        }
    }
    else{
        $validation["validation_status"] = FALSE;
        $validation["validation_errors"]["ISBN"] = "'ISBN' couldn't be found!";
    }

    if(isset($data->image)){
        if(mb_strlen($data->image) < 1) {
            $validation["validation_status"] = FALSE;
            $validation["validation_errors"]["image"] = "'image' cannot be lesser than 1 character.";
        }
        elseif(mb_strlen($data->image) > 17) {
            $validation["validation_status"] = FALSE;
            $validation["validation_errors"]["image"] = "'image' cannot exceed 110 characters.";
        }
    }
    else{
        $validation["validation_status"] = FALSE;
        $validation["validation_errors"]["image"] = "'image' couldn't be found!";
    }

    if(isset($data->author_name)){
        if(mb_strlen($data->author_name) < 1) {
            $validation["validation_status"] = FALSE;
            $validation["validation_errors"]["author_name"] = "'author_name' cannot be lesser than 1 character.";
        }
        elseif(mb_strlen($data->author_name) > 220) {
            $validation["validation_status"] = FALSE;
            $validation["validation_errors"]["author_name"] = "'author_name' cannot exceed 220 characters.";
        }
    }
    else{
        $validation["validation_status"] = FALSE;
        $validation["validation_errors"]["author_name"]  = "'author_name' couldn't be found!";
    }

    if(isset($data->author_surname)){
        if(mb_strlen($data->author_surname) < 1) {
            $validation["validation_status"] = FALSE;
            $validation["validation_errors"]["author_surname"] = "'author_surname' cannot be lesser than 1 character.";
        }
        elseif(mb_strlen($data->author_surname) > 220) {
            $validation["validation_status"] = FALSE;
            $validation["validation_errors"]["author_surname"] = "'author_surname' cannot exceed 220 characters.";
        }
    }
    else{
        $validation["validation_status"] = FALSE;
        $validation["validation_errors"]["author_surname"]  = "'author_surname' couldn't be found!";
    }

    return $validation;
}

?>