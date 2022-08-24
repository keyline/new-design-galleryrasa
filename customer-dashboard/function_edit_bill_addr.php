<?php
require_once("../require.php");
require_once("../" . INCLUDED_FILES . "config.inc.php");
require_once("../" . INCLUDED_FILES . "dbConn.php");
require_once("../" . INCLUDED_FILES . "functionsInc.php");
//check_auth_user();
$conn = dbconnect();
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    //$data=$_POST['demodata'];
    $apiStatus = FALSE;
    $apiMessage = '';
    $apiResponse = [];
    $postData = $_POST;
    //echo '<pre>';print_r($postData);die;

    if($postData['name'] == ''){
        //$_SESSION['name_error'] = "<p>Please Enter Name</p>";
        $apiStatus = FALSE;
        $apiMessage = 'Please Enter Name';
        $apiResponse = ['inputId' => 'name'];
        //exit;
    }
    elseif($postData['phone'] == ''){
        //$_SESSION['name_error'] = "<p>Please Enter Name</p>";
        $apiStatus = FALSE;
        $apiMessage = 'Please Enter phone Number';
        $apiResponse = ['inputId' => 'phone'];
        //exit;
    }
    elseif($postData['city'] == ''){
        //$_SESSION['name_error'] = "<p>Please Enter Name</p>";
        $apiStatus = FALSE;
        $apiMessage = 'Please Enter City';
        $apiResponse = ['inputId' => 'city'];
        //exit;
    }
    elseif($postData['street_address'] == ''){
        //$_SESSION['name_error'] = "<p>Please Enter Name</p>";
        $apiStatus = FALSE;
        $apiMessage = 'Please Enter Address';
        $apiResponse = ['inputId' => 'address'];
        //exit;
    }
    elseif($postData['state'] == ''){
        //$_SESSION['name_error'] = "<p>Please Enter Name</p>";
        $apiStatus = FALSE;
        $apiMessage = 'Please Enter state';
        $apiResponse = ['inputId' => 'state'];
        //exit;
    }
    elseif($postData['country'] == ''){
        //$_SESSION['name_error'] = "<p>Please Enter Name</p>";
        $apiStatus = FALSE;
        $apiMessage = 'Please Enter country';
        $apiResponse = ['inputId' => 'country'];
        //exit;
    }
    elseif($postData['zip'] == ''){
        //$_SESSION['name_error'] = "<p>Please Enter Name</p>";
        $apiStatus = FALSE;
        $apiMessage = 'Please Enter zip';
        $apiResponse = ['inputId' => 'zip'];
        //exit;
    }
    elseif($postData['landmark'] == ''){
        //$_SESSION['name_error'] = "<p>Please Enter Name</p>";
        $apiStatus = FALSE;
        $apiMessage = 'Please Enter landmark';
        $apiResponse = ['inputId' => 'landmark'];
        //exit;
    }
    elseif($postData['shipping_name'] == ''){
        //$_SESSION['name_error'] = "<p>Please Enter Name</p>";
        $apiStatus = FALSE;
        $apiMessage = 'Please Enter Shipping Name';
        $apiResponse = ['inputId' => 'shipping_name'];
        //exit;
    }
    elseif($postData['shipping_phone'] == ''){
        //$_SESSION['name_error'] = "<p>Please Enter Name</p>";
        $apiStatus = FALSE;
        $apiMessage = 'Please Enter Shipping phone Number';
        $apiResponse = ['inputId' => 'shipping_phone'];
        //exit;
    }
    elseif($postData['shipping_city'] == ''){
        //$_SESSION['name_error'] = "<p>Please Enter Name</p>";
        $apiStatus = FALSE;
        $apiMessage = 'Please Enter shipping City';
        $apiResponse = ['inputId' => 'shipping_city'];
        //exit;
    }
    elseif($postData['shipping_address'] == ''){
        //$_SESSION['name_error'] = "<p>Please Enter Name</p>";
        $apiStatus = FALSE;
        $apiMessage = 'Please Enter Shipping Address';
        $apiResponse = ['inputId' => 'shipping_address'];
        //exit;
    }
    elseif($postData['shipping_state'] == ''){
        //$_SESSION['name_error'] = "<p>Please Enter Name</p>";
        $apiStatus = FALSE;
        $apiMessage = 'Please Enter state';
        $apiResponse = ['inputId' => 'shipping_state'];
        //exit;
    }
    elseif($postData['shipping_country'] == ''){
        //$_SESSION['name_error'] = "<p>Please Enter Name</p>";
        $apiStatus = FALSE;
        $apiMessage = 'Please Enter Shipping country';
        $apiResponse = ['inputId' => 'shipping_country'];
        //exit;
    }
    elseif($postData['shipping_zip'] == ''){
        //$_SESSION['name_error'] = "<p>Please Enter Name</p>";
        $apiStatus = FALSE;
        $apiMessage = 'Please Enter shipping zip';
        $apiResponse = ['inputId' => 'shipping_zip'];
        //exit;
    }
    elseif($postData['shipping_landmark'] == ''){
        //$_SESSION['name_error'] = "<p>Please Enter Name</p>";
        $apiStatus = FALSE;
        $apiMessage = 'Please Enter shipping landmark';
        $apiResponse = ['inputId' => 'shipping_landmark'];
        //exit;
    }
    elseif(!preg_match("/^[a-zA-Z ]*$/",$postData["name"])){
        // $_SESSION['name_error'] = "<p>only Letters and whitespace allowed</p>";
        $apiStatus = FALSE;
        $apiMessage = 'only Letters and whitespace allowed';
        $apiResponse = ['inputId' => 'special_name'];
    }
    elseif(!preg_match("/^[a-zA-Z ]*$/",$postData["shipping_name"])){
        // $_SESSION['name_error'] = "<p>only Letters and whitespace allowed</p>";
        $apiStatus = FALSE;
        $apiMessage = 'only Letters and whitespace allowed';
        $apiResponse = ['inputId' => 'shipping_name'];
    }
    // elseif(empty($_POST["street_address"])){
    //     $_SESSION['addr_error'] = "<p>Please Enter address</p>";
    // }
    // elseif(!preg_match("/^[a-zA-Z ]*$/",$_POST["street_address"])){
    //     $_SESSION['addr_error'] = "<p>only Letters and whitespace allowed</p>";
    //     // echo "Test";
    //     // die;
    // }
    // elseif(empty($_POST["zip"])){
    //     $_SESSION['zip_error'] = "<p>Please Enter Zip code</p>";
    // }
    // elseif(is_numeric(trim($_POST["zip"])) == false){
    //     $_SESSION['zip_error'] = "<p>Enter a valid zip code</p>";
    // }
    // elseif(empty($_POST["city"])){
    //     $_SESSION['city_error'] = "<p>Please Enter city</p>";
    // }
    // elseif(!preg_match("/^[a-zA-Z ]*$/",$_POST["city"])){
    //     $_SESSION['state_error'] = "<p>only Letters and whitespace allowed</p>";
    //     // echo "Test";
    //     // die;
    // }
    // elseif(empty($_POST["state"])){
    //     $_SESSION['state_error'] = "<p>Please Enter state</p>";
    // }
    // elseif(!preg_match("/^[a-zA-Z ]*$/",$_POST["state"])){
    //     $_SESSION['state_error'] = "<p>only Letters and whitespace allowed</p>";
    //     // echo "Test";
    //     // die;
    // }
    // elseif(empty($_POST["country"])){
    //     $_SESSION['country_error'] = "<p>Please Enter country</p>";
    // }
    // elseif(!preg_match("/^[a-zA-Z ]*$/",$_POST["country"])){
    //     $_SESSION['country_error'] = "<p>only Letters and whitespace allowed</p>";
    //     // echo "Test";
    //     // die;
    // }
    // elseif(empty($_POST["landmark"])){
    //     $_SESSION['landmark_error'] = "<p>Please Enter Landmark</p>";
    // }
    // elseif(!preg_match("/^[a-zA-Z ]*$/",$_POST["landmark"])){
    //     $_SESSION['state_error'] = "<p>only Letters and whitespace allowed</p>";
    //     // echo "Test";
    //     // die;
    // }
    // elseif(empty($_POST["shipping_name"])){
    //     $_SESSION['shipping_name_error'] = "<p>Please Enter Name</p>";
    // }
    // elseif(!preg_match("/^[a-zA-Z ]*$/",$_POST["shipping_name"])){
    //     $_SESSION['shipping_name_error'] = "<p>only Letters and whitespace allowed</p>";
    // }
    // elseif(empty($_POST["shipping_phone"])){
    //     $_SESSION['shipping_phone_error'] = "<p>Please Enter phone number</p>";
    // }
    // elseif(strlen($_POST["shipping_phone"])<10){
    //     $_SESSION['shipping_phone_error'] =  "error : Number should be ten digits.";
    // }
    // elseif(is_numeric(trim($_POST["shipping_phone"])) == false){
    //     $_SESSION['shipping_phone_error'] = "<p>Enter a valid phone number</p>";
    // }
    // elseif(empty($_POST["shipping_address"])){
    //     $_SESSION['shipping_address_error'] = "<p>Please Enter address</p>";
    // }
    // // elseif(!preg_match("/^[a-zA-Z ]*$/",$_POST["shipping_address"])){
    // //     $_SESSION['shipping_address_error'] = "<p>only Letters and whitespace allowed</p>";
    // //     // echo "Test";
    // //     // die;
    // // }
    // elseif(empty($_POST["shipping_zip"])){
    //     $_SESSION['shipping_zip_error'] = "<p>Please Enter Zip code</p>";
    //     // echo "Test";
    //     // die;
    // }
    // elseif(is_numeric(trim($_POST["shipping_zip"])) == false){
    //     $_SESSION['shipping_zip_error'] = "<p>Enter a valid zip code</p>";
    //     // echo "Test";
    //     // die;
    // }
    // elseif(empty($_POST["shipping_city"])){
    //     $_SESSION['shipping_city_error'] = "<p>Please Enter city</p>";
    //     // echo "Test";
    //     // die;
    // }
    // // elseif(!preg_match("/^[a-zA-Z ]*$/",$_POST["shipping_city"])){
    // //     $_SESSION['shipping_city_error'] = "<p>only Letters and whitespace allowed</p>";
    // //     // echo "Test";
    // //     // die;
    // // }
    // elseif(empty($_POST["shipping_state"])){
    //     $_SESSION['shipping_state_error'] = "<p>Please Enter state</p>";
    // }
    // // elseif(!preg_match("/^[a-zA-Z ]*$/",$_POST["shipping_state"])){
    // //     $_SESSION['shipping_state_error'] = "<p>only Letters and whitespace allowed</p>";
    // //     // echo "Test";
    // //     // die;
    // // }
    // elseif(empty($_POST["shipping_country"])){
    //     $_SESSION['shipping_country_error'] = "<p>Please Enter country</p>";
    //     // echo "Test";
    //     // die;
    // }
    // // elseif(!preg_match("/^[a-zA-Z ]*$/",$_POST["country"])){
    // //     $_SESSION['shipping_country_error'] = "<p>only Letters and whitespace allowed</p>";
    // //     // echo "Test";
    // //     // die;
    // // }
    // elseif(empty($_POST["shipping_landmark"])){
    //     $_SESSION['shipping_landmark_error'] = "<p>Please Enter Landmark</p>";
    // }
    // // elseif(!preg_match("/^[a-zA-Z ]*$/",$_POST["shipping_landmark"])){
    // //     $_SESSION['shipping_landmark_error'] = "<p>only Letters and whitespace allowed</p>";
    // //     // echo "Test";
    // //     // die;
    // // }
    else{
    $addr_id = $_POST['addr_id'];
    $name = $_POST['name'];
    $shipping_name = $_POST['shipping_name'];
    $shipping_phone = $_POST['shipping_phone'];
    $shipping_address = $_POST['shipping_address'];
    $shipping_city = $_POST['shipping_city'];
    $shipping_state = $_POST['shipping_state'];
    $shipping_country = $_POST['shipping_country'];
    $shipping_zip = $_POST['shipping_zip'];
    $shipping_landmark = $_POST['shipping_landmark'];
    // echo $shipping_name;die();
    $phone = $_POST['phone'];
    $street_address = $_POST['street_address'];
    $city = $_POST['city'];
    $state = $_POST['state'];
    $country = $_POST['country'];
    $zip = $_POST['zip'];
    $landmark = $_POST['landmark'];
    //  echo $landmark;die();
       
    $qry1 = "update customer_address set name = '$name', shipping_name = '$shipping_name',shipping_phone = '$shipping_phone',shipping_address = '$shipping_address',shipping_city = '$shipping_city', shipping_state = '$shipping_state', shipping_country = '$shipping_country',  shipping_zip = '$shipping_zip',shipping_landmark = '$shipping_landmark', phone = '$phone', street_address = '$street_address',city = '$city',state = '$state',country = '$country',zip = '$zip',landmark = '$landmark' "
                . "where id = '$addr_id'";
                // echo $qry1;
                // exit;
        $q1 = $conn->prepare($qry1);
        $q1->execute();
        // $_SESSION['succ-addr'] = 'Your Address is Updated.';
        //goto_location('customer-dashboard);
    }
    //goto_location('customer-dashboard);
    $data = ['status' => $apiStatus, 'message' => $apiMessage, 'response' => $apiResponse];
    header('Content-Type: application/json; charset=utf-8');
    echo json_encode($data);
}
?>

