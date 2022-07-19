<?php
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);
require_once("../require.php");
require_once("../" . INCLUDED_FILES . "config.inc.php");
require_once("../" . INCLUDED_FILES . "dbConn.php");
require_once("../" . INCLUDED_FILES . "functionsInc.php");
check_auth_admin();
$conn = dbconnect();
if (is_ajax()) {
	$requestData = json_decode(file_get_contents('php://input'));
    if (isset($requestData->action) && !empty($requestData->action)) { //Checks if action value exists
        $action = $requestData->action;
        switch ($action) { //Switch case for value of action
            case "test":
                test_function();
                break;
            case "getAvailableImages":
                get_available_images($conn, $requestData->prodid);
                break;
			case "mapImage"	:
				map_visual_images($conn, $requestData->id, $requestData->prodid);
				break;
            default :
                exit(0);
        }
    }
}

//Function to check if the request is an AJAX request
function is_ajax()
{
    return isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest';
}

function test_function()
{
    $return = $_POST;

    //Do what you need to do with the info. The following are some examples.
    //if ($return["favorite_beverage"] == ""){
    //  $return["favorite_beverage"] = "Coke";
    //}
    //$return["favorite_restaurant"] = "McDonald's";

    $return["json"] = json_encode($return);
    // https://stackoverflow.com/questions/4064444/returning-json-from-a-php-script/4064468#4064468
    header('Content-type:application/json;charset=utf-8');
    echo json_encode($return);
    // exit();
}

function get_available_images($dbInst=NULL, $prodid=0)
{
    $imageList = array();
    $rowCount = 1;
    if(is_null($dbInst))
    {
        exit("Db connection failed");
    }
    $qry="SELECT * FROM `" . VISUALARCHIVE_IMAGES_TBL ."` WHERE `va_status`=1 AND `va_product_id` < 11966  ORDER BY `va_product_id` ASC";
    $stmt = $dbInst->query($qry);
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC))
    {
        $imageList['images']["image{$rowCount}"] = array(
            'image_id'      => $row['va_image_id'],
            'image_name'    => $row['va_image_name'],
            'image_path'    => "<img src=\"". SITE_URL . '/product_images/thumbs/' . $row['va_image_name'] . "\" alt=\"". pathinfo($row['va_image_name'], PATHINFO_FILENAME) . "\" width=\"100\">",
            'action'        => "<input type=\"button\" id=\"update_record\" class=\"btn btn-warning\" value=\"Map Image\" data-prodid=\"" . $prodid . "\">"
        );
      ++ $rowCount;  
    }
    
    header('Content-type:application/json;charset=utf-8');
    echo json_encode($imageList);
}

function map_visual_images($dbInst=null, $imageID=0, $prodID=0)
{
	if(is_null($dbInst))
    {
        exit("Db connection failed");
    }elseif(! $imageRow=is_va_image_exists($imageID))
	{
		return false;
	}elseif( $prodID !== (int)$imageRow['va_product_id'] )
	{
		//Do the actual mapping here
		$qry = "UPDATE `" . VISUALARCHIVE_IMAGES_TBL . "` SET `va_product_id`=:prodid AND `va_status`=2 WHERE `va_image_id`=:imgid";
		$stmt = $dbInst->prepare($qry);
		$stmt->bindParam(':prodid', $prodID, PDO::PARAM_INT);
		$stmt->bindParam(':imgid', $imageID, PDO::PARAM_INT);
		$stmt->execute();
		if(!$stmt->rowCount())
		{
			exit("Update not possible at this time, pls try again later!");
		}
		header('Content-type:application/json;charset=utf-8');
		echo json_encode(array("msg"=> "Mapping successful! pls proceed"));
		
	}else
	{
		exit("Mapping not possible for same data");
	}
}