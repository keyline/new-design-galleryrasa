<?php
error_reporting(E_ALL);
require_once("../require.php");
require_once("../" . INCLUDED_FILES . "config.inc.php");
require_once("../" . INCLUDED_FILES . "dbConn.php");
require_once("../" . INCLUDED_FILES . "functionsInc.php");
require_once("../" . INCLUDED_FILES . "pdo-debug.php");

check_auth_admin();
$conn = dbconnect();

if (is_ajax()) {
    if (isset($_POST["action"]) && !empty($_POST["action"]) || !empty($_REQUEST['action'])) { //Checks if action value exists
        if (!isset($_POST['action'])) {
            $action = $_REQUEST['action'];
        } else {
            $action = $_POST["action"];
        }

        switch ($action) { //Switch case for value of action
            case "test": test_function();
                break;
            case "attribute_list": create_attribute_list($conn);
                break;
            case "container2" : category_specific_attributes($conn);
                break;
            case "container1" : category_specific_attributes($conn);
                break;

            case "add-new-product" : create_new_product($conn);
                break;
            case "collapsibleList": collapsible_list($conn);
                break;
            case "selectData": getDataSelect();
                break;
            case "showImage": sendJSONdata();
                break;
            case "featuredImage": updateFeatured();
                break;
            case "additionalDetails-modal": sendDataToModal();
                break;
            case "additionalartDetails-modal": sendArtDataToModal();
                break;
            case "SETImageDetails": setImageDetails();
                break;
            case "SETArtworkDetails": setArtworkDetails();
                break;
            case "Delete-image": DeleteImage();
                break;
            case "Delete-artwork": DeleteArtwork();
                break;
            case "Unused": DeleteUnused();
                break;
            case "showImage_artwork": sendJSONdataart();
                break;
            case "carousel-statusChange": carousel_status();
                break;
            case "getModalExhibition": getExhibition();
                break;
            case "saveModalExhibition": setExhibition();
                break;
            case "delete_unused_attr": delete_attributes();
				break;
            
        }
    }
}

//Function to check if the request is an AJAX request
function is_ajax() {
    return isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest';
}

function test_function() {
    $return = $_POST;

    //Do what you need to do with the info. The following are some examples.
    //if ($return["favorite_beverage"] == ""){
    //  $return["favorite_beverage"] = "Coke";
    //}
    //$return["favorite_restaurant"] = "McDonald's";

    $return["json"] = json_encode($return);
    echo json_encode($return);
}

/*
 * Get full length of attributes from system
 */

function create_attribute_list() {
    $category = explode("-", $_POST['value']);
    $selected = atrributeListBycategory($category[1]);


    try {
        $conn = dbconnect();
        $qry = "SELECT * FROM " . ATTR_FLDS_TBL . " order by id ASC";

        $q = $conn->prepare($qry);
        $q->execute();
        $q->setFetchMode(PDO::FETCH_ASSOC);


        $container1 = '<div class="col-xs-3">
                    <div class="panel panel-default">
                    <div class="panel-heading">
                    <h1 class="panel-title">Assigned</h1>
            </div><div id="container1" class="panel-body box-container">';
        $container2 = '<div class="col-xs-3">
                    <div class="panel panel-default">
                    <div class="panel-heading">
                    <h1 class="panel-title">Unassigned Attributes</h1>
                    </div><div id="container2" class="panel-body box-container">';

        while ($row = $q->fetch()) {
            if (isset($selected[$row['id']])) {
                $container1 .= '<div itemid="itm-' . $row['id'] . '" class="btn btn-default box-item">' . $row['attribute_name'] . '</div>';
            } else {
                $container2 .= '<div itemid="itm-' . $row['id'] . '" class="btn btn-default box-item">' . $row['attribute_name'] . '</div>';
            }
        }
        $container1 .= '</div>';
        $container2 .= '</div>';
        $list = array(
            'c1' => $container1,
            'c2' => $container2
        );
        echo json_encode($list);
    } catch (PDOException $pe) {
        echo db_error($pe->getMessage());
    }
}

/*
 * Insert or Delete Attributes based on Category viz. Bibliography etc.
 */

function category_specific_attributes($conn) {

    $category = stripslashes($_POST['category']);
    $attr = stripslashes($_POST['attr_id']);
    $action = $_POST['action'];

    $attr_id = explode("-", $attr);
    $i = 1;
    switch ($action) {
        case "container2":
            $action = "INSERT INTO";
            break;
        case "container1":
            $action = "DELETE FROM";
            break;
        default :
    }

    $columns = array(
        'product_type_attr_key' => 'null',
        'p_type_id' => ':type_id',
        'attribute_id' => ':attr_id',
        'sequence' => ':seq'
    );

    $bind = array(
        ':type_id' => $category,
        ':attr_id' => $attr_id[1],
        ':seq' => $i
    );

    try {

        $err = FALSE;

        if ($action == "INSERT INTO") {
            $qry = insert(PROD_TYPE_ATTR, $columns);


            $q = $conn->prepare($qry);
            $q->execute($bind);
            //echo PdoDebugger::show($qry, $bind);

            $id = $conn->lastInsertId();
        } else {
            //get the row for deleting
            $qry = "SELECT * FROM `product_type_attribute_key` WHERE `p_type_id` = :p_type_id AND `attribute_id`= :attr_id";
            $params = array(
                ':p_type_id' => $category,
                ':attr_id' => $attr_id[1]
            );
            //echo PdoDebugger::show($qry, $params);

            try {
                $conn = dbconnect();
                $stmt = $conn->prepare($qry);
                $stmt->execute($params);
                $stmt->setFetchMode(PDO::FETCH_ASSOC);

                $result = $stmt->rowCount() == 0 ? false : true;

                if ($result) {
                    while ($row = $stmt->fetch()) {
                        $id = $row['product_type_attr_key'];
                    }

                    //Run delete query
                    $qry = "DELETE FROM `product_type_attribute_key` WHERE `product_type_attr_key` = :key";
                    $q = $conn->prepare($qry);
                    //$q->bindParam(');
                    $q->execute(array(':key' => $id));
                    if ($q->rowCount() > 0) {
                        return true;
                    }
                    return false;
                }
            } catch (PDOException $pe) {
                echo db_error($pe->getMessage());
            }
        }
    } catch (PDOException $pe) {

        $err = true;
        $er = db_error($pe->getMessage()) . '. Check that relevant fields like Info tab are completed';
    }
}

function create_new_product($conn, $hc = array()) {
    $key = stripslashes($_POST['setting']);


    $qry = "SELECT product_type_name, product_type_id FROM " . PROD_CATEGORY . " WHERE parent IS NULL";


    $q = $conn->prepare($qry);
    $q->execute();
    $q->setFetchMode(PDO::FETCH_ASSOC);
    while ($row = $q->fetch()) {
        $hc[] = $row['product_type_name'];
    }
    //Keeping Session values

    $message = in_array($key, $hc);
    if ($message) {
        $_SESSION['attribute'] = $key;
    }
    $result = array(
        'flag' => $message,
        'redirectURL' => str_replace("add-new-product", "add-new", $_SERVER['HTTP_REFERER'])
    );

    echo json_encode($result);
}

function collapsible_list($conn) {
    $sourceType = stripslashes($_REQUEST['sourceType']);
    $parent = stripcslashes($_SESSION['attribute']);
    switch (true) {
        case ($parent == 'Bibliography'):
            $parent = 1;
            break;
        case ($parent == 'Memorabilia'):
            $parent = 2;
            break;
        case ($parent == 'Paint Gallery'):
            $parent = 15;
            break;
        default :
            $parent = 4;
    }
    if ($sourceType == 'html') {
        $getParentNodes = "select product_type_id, product_type_name from " . PROD_CATEGORY . " where parent IS NULL AND product_type_id=:type_id";

        $q = $conn->prepare($getParentNodes);
        $q->bindValue(':type_id', intval($parent), PDO::PARAM_INT);
        $q->execute();
        $q->setFetchMode(PDO::FETCH_ASSOC);
        $row_cnt = $q->rowCount();
        //$resParentNodes = mysqli_query($conn, $getParentNodes);
        $response = '';
        if ($row_cnt > 0) {
            while ($parentNode = $q->fetch()) {
                $response .= '<ul  class="jtree_parent_node">
                <li>
                    <span class="jtree_expand jtree_node_open"> </span>
                    <label><input type="checkbox" name="category" parent-id="' . $parentNode['product_type_id'] . '" class="jtree_parent_checkbox" value="'.$parentNode['product_type_id']. '"> ' . $parentNode['product_type_name'] . '</label>';

                $getChildNodes = "select product_type_id, product_type_name from product_type_ecomc where parent = '" . $parentNode['product_type_id'] . "'";
                $p = $conn->prepare($getChildNodes);
                $p->execute();
                $p->setFetchMode(PDO::FETCH_ASSOC);
                $row_cnt_c = $p->rowCount();
                //$resChildNodes = mysqli_query($conn, $getChildNodes);
                if ($row_cnt_c > 0) {
                    $response .= '<ul class="jtree_child_node">';
                    while ($childNode = $p->fetch()) {
                        $response .= '
                                <li><label><input type="checkbox" id="' . $childNode['product_type_id'] . '" parent-id="' . $parentNode['product_type_id'] . '" name="sub-category" class="jtree_child_checkbox" value="' . $childNode['product_type_id'] . '"> ' . $childNode['product_type_name'] . '</label></li>
                            ';
                    }
                    $response .= '</ul>';
                }

                $response .= '</li>
            </ul>';
            }
        }

        echo $response;
    } else {
        $response = array();
        $childNodes = array();

        $getParentNodes = "select product_type_id, product_type_name from permissions where parent IS NULL";
        $q = $conn->prepare($getParentNodes);
        $q->execute();
        $q->setFetchMode(PDO::FETCH_ASSOC);
        $row_cnt = $q->rowCount();
        //$resParentNodes = mysqli_query($conn, $getParentNodes);
        $response = '';
        if ($row_cnt > 0) {
            while ($parentNode = $q->fetch()) {
                $getChildNodes = "select product_type_id, product_type_name from permissions where inherit_product_type_id = '" . $parentNode['product_type_id'] . "'";
                $p = $conn->prepare($getParentNodes);
                $p->execute();
                $p->setFetchMode(PDO::FETCH_ASSOC);
                $row_cnt_c = $p->rowCount();
                //$resChildNodes = mysqli_query($conn, $getChildNodes);
                if ($row_cnt_c > 0) {
                    while ($childNode = $p->fetch()) {
                        $childNodes[] = $childNode;
                    }

                    $response[$parentNode['product_type_id']] = array(
                        'parentNodeid' => $parentNode['product_type_id'],
                        'parentNodeTxt' => $parentNode['product_type_name'],
                        'childNodes' => $childNodes
                    );
                }
            }
        }

        echo json_encode($response);
    }
}

function getDataSelect() {
    $term = stripslashes($_POST['term']);
    $id = stripslashes($_POST['id']);
    $json = array();
    $qry = "SELECT * FROM " . ATTR_VAL . " WHERE value LIKE '%" . $term . "%' AND attr_id = :attributeID order by attr_value_id ASC";
    $conn = dbconnect();
    $q = $conn->prepare($qry);

    $q->bindParam(':attributeID', $id);
    $q->execute();
    $q->setFetchMode(PDO::FETCH_ASSOC);
    if ($q->rowCount() > 0) {

        while ($row = $q->fetch()) {
            $json[] = array(
                'id' => $row['attr_value_id'],
                'text' => $row['value']
            );
        }
    } else {
        $json = array('id' => '-1', 'text' => 'No result Found');
    }

    header('Content-type: application/json');
    echo json_encode($json);
}

function sendJSONdata() {
    //print_r($_POST);
    $result = array();
    try {
        $conn = dbconnect();
        $qry = "SELECT `m_image_id`, `m_image_name`, `m_image_category_text`, `is_featured` FROM " . MEMORIBILA_IMAGES_TBL . " WHERE product_id=:productID AND m_image_category_text=:category ORDER by date_created";
        $q = $conn->prepare($qry);
        $bind = array(':productID' => stripcslashes($_POST['product']), ':category' => stripcslashes($_POST['image_type']));
        //echo PdoDebugger::show($qry, $bind);

        $q->execute($bind);
        $q->setFetchMode(PDO::FETCH_ASSOC);
        while ($row = $q->fetch()) {
            $result[] = $row;
        }
        $data['items'] = $result;
        echo json_encode($data);
    } catch (PDOException $pe) {
        echo db_error($pe->getMessage());
    }
}

function updateFeatured() {
    $val = (stripcslashes($_POST['cmd']) == 'remove') ? 0 : 1;

    try {
        $conn = dbconnect();
        $param = stripcslashes($_POST['image_nm']);
        $qry = "UPDATE `memorabilia_images` SET `is_featured`= :flag WHERE `m_image_id`= :image";
        $q = $conn->prepare($qry);
        $bind = array(':flag' => $val, ':image' => $param);
        $q->execute($bind);
        if ($q->rowCount() > 0) {
            $result = array(
                'status' => "Updation successfull",
                'err' => false
            );
            echo json_encode($result);
            exit;
        }
        $result = array(
            'status' => "Invalid Request",
            'err' => true
        );
        echo json_encode($result);
    } catch (PDOException $pe) {
        echo db_error($pe->getMessage());
    }
}

function sendDataToModal() {
    $qry_arr = filter_var_array($_POST, FILTER_SANITIZE_STRING);
    $id_expolde = explode("|", $qry_arr['image']);
    $id = $id_expolde[1];
    try {
        $conn = dbconnect();
        $qry = "SELECT `m_image_id`, `m_image_name`, `product_id`, `m_image_details` FROM " . MEMORIBILA_IMAGES_TBL . " WHERE `m_image_id`=:imageID LIMIT 1";
        $q = $conn->prepare($qry);
        $q->bindValue(':imageID', intval($id), PDO::PARAM_INT);
        $q->execute();
        $q->setFetchMode(PDO::FETCH_ASSOC);
        while ($row = $q->fetch()) {
            $result[] = array(
                'id' => $row['m_image_id'],
                'imageName' => $row['m_image_name'],
                'pID' => $row['product_id'],
                'imageDetails' => json_decode($row['m_image_details'], true)
                
            );
        }
        $data['items'] = !empty($result) ? $result : false;

        header('Content-type: application/json');
        echo json_encode($data);
    } catch (PDOException $pe) {
        echo db_error($pe->getMessage());
    }
}

function sendArtDataToModal() {
    $qry_arr = filter_var_array($_POST, FILTER_SANITIZE_STRING);
    $id_expolde = explode("|", $qry_arr['image']);
    $id = $id_expolde[1];
    try {
        $conn = dbconnect();
        $qry = "SELECT * FROM artworks WHERE `id`=:imageID LIMIT 1";
        $q = $conn->prepare($qry);
        $q->bindValue(':imageID', intval($id), PDO::PARAM_INT);
        $q->execute();
        $q->setFetchMode(PDO::FETCH_ASSOC);
        while ($row = $q->fetch()) {
            $result[] = array(
                'id' => $row['id'],
                'image' => $row['image'],
                'artist_id' => $row['artist_id'],
                'title' => $row['title'],
                'medium' => $row['medium'],
                'surface' => $row['surface'],
                'painting_year' => $row['painting_year'],
                'size_width' => $row['size_width'],
                'size_height' => $row['size_height'],
                'comment' => $row['comment']
                    //'imageDetails' => json_decode($row['m_image_details'], true)
            );
        }
        $data['items'] = !empty($result) ? $result : false;

        header('Content-type: application/json');
        echo json_encode($data);
    } catch (PDOException $pe) {
        echo db_error($pe->getMessage());
    }
}

function setImageDetails() {
    
    $json = array();
    $qry_arr = filter_var_array($_POST, FILTER_SANITIZE_STRING);
    $allowed = array('image_id', 'image_name', 'product', 'sellOriginal', 'sellPrint');
    $myArray = array_intersect_key($qry_arr, array_flip($allowed));

    $jsonC = json_encode($myArray);
    $columns = array(
        'm_image_details' => "'" . $jsonC . "'",
//                'm_quantity'=> $_POST['quantity'],
//                'm_price'   => $_POST['price'],
//                'm_is_print'=> $_POST['is_print'],
    );

    $crt = array('m_image_id' => $qry_arr['image_id']);
    $tbl = "memorabilia_images";
    $qry = update($tbl, $columns, $crt, true);

    try {
        $err = false;
        $conn = dbconnect();
        $q = $conn->prepare($qry);
        $q->execute();
    } catch (PDOException $pe) {
        $err = true;
        $msg = db_error($pe->getMessage());
    }

    if (!$err) {
        $json = array(
            'result' => true,
            'msg' => "Image Details Updated Successfully"
        );
        echo json_encode($json);
        exit;
    }
    $json = array(
        'result' => false,
        'msg' => $msg
    );
    echo json_encode($json);
}

function setArtworkDetails() {

    $json = array();
    $qry_arr = filter_var_array($_POST, FILTER_SANITIZE_STRING);
    $allowed = array('image_id', 'image_name', 'artwork');
    $myArray = array_intersect_key($qry_arr, array_flip($allowed));


    $title = $_POST['title'];
    $medium = $_POST['medium'];
    $surface = $_POST['surface'];
    $year_painting = $_POST['year_painting'];
    $size_width = $_POST['size_width'];
    $size_height = $_POST['size_height'];
    $comment = $_POST['comment'];

//        $crt = array('id' => $qry_arr['image_id']);
//        $tbl = "artworks";
//        $qry = update($tbl, $columns, $crt, true);
    $img_id = $qry_arr['image_id'];
    $date_for_img = date("Y-m-d H:i:s");
    $qry = "UPDATE artworks SET "
            . "title='$title', medium='$medium', surface='$surface', painting_year='$year_painting', "
            . "size_width='$size_width', size_height='$size_height', comment='$comment', last_update='$date_for_img' "
            . "WHERE id='$img_id'";

    try {
        $err = false;
        $conn = dbconnect();
        $q = $conn->prepare($qry);
        $q->execute();
    } catch (PDOException $pe) {
        $err = true;
        $msg = db_error($pe->getMessage());
    }

    if (!$err) {
        $json = array(
            'result' => true,
            'msg' => "Image Details Updated Successfully"
        );
        echo json_encode($json);
        exit;
    }
    $json = array(
        'result' => false,
        'msg' => $msg
    );
    // echo $qry;
    echo json_encode($json);
}

function DeleteImage() {
    $deleteId = explode("|", $_POST['image']);
    try {
        $err = false;
        $conn = dbconnect();
        $sql = "DELETE FROM `memorabilia_images` WHERE `m_image_id`=:imageID";
        $q = $conn->prepare($sql);
        $q->bindValue(':imageID', intval($deleteId[1]), PDO::PARAM_INT);
        $q->execute();
        $q->setFetchMode(PDO::FETCH_ASSOC);
        if ($q->rowCount()) {
            $result = array(
                'status' => "Image Deleted successfully",
                'err' => false
            );
            echo json_encode($result);
            exit;
        }
        $result = array(
            'status' => "Invalid Request",
            'err' => true
        );
        echo json_encode($result);
    } catch (PDOException $pe) {
        echo db_error($pe->getMessage());
    }
}

function DeleteArtwork() {
    $deleteId = explode("|", $_POST['image']);
    try {
        $err = false;
        $conn = dbconnect();

//        $qry_imgart = "SELECT * from artworks where id = '" . $deleteId[1] . "'";
//        $q_imgart = $conn->prepare($qry_imgart);
//        $q_imgart->execute();
//        $q_imgart->setFetchMode(PDO::FETCH_ASSOC);
//        $row_imgart = $q_imgart->fetch();
//        $imgname = $row_imgart['image'];

        $sql = "DELETE FROM `artworks` WHERE `id`=:imageID";
        $q = $conn->prepare($sql);
        $q->bindValue(':imageID', intval($deleteId[1]), PDO::PARAM_INT);
        $q->execute();
        $q->setFetchMode(PDO::FETCH_ASSOC);
        if ($q->rowCount()) {
//            $document_path = realpath(__DIR__ . '/..') . 'product_images/artwork/';
//            unlink($document_path . $imgname);
            $result = array(
                'status' => "Image Deleted successfully",
                'err' => false
            );
            echo json_encode($result);
            exit;
        }
        $result = array(
            'status' => "Invalid Request",
            'err' => true
        );
        echo json_encode($result);
    } catch (PDOException $pe) {
        echo db_error($pe->getMessage());
    }
}

function DeleteUnused(){
    
    
    
    try{
        $err = false;
        $conn = dbconnect();
        if(isset($_POST['id'])){
            foreach ($_POST['id'] as $id){
                $sql = "DELETE FROM `attribute_value_ecomc` WHERE `attr_value_id`=:imageID";
                $q = $conn->prepare($sql);
                $q->bindValue(':imageID', intval($id), PDO::PARAM_INT);
                $q->execute();
                $q->setFetchMode(PDO::FETCH_ASSOC);
            }
        }
        
        if($q->rowCount()){
            $result = array(
                'status' => "Attribute Deleted successfully",
                'err'   => false
            );
            echo json_encode($result);
            exit;
         }
         $result = array(
            'status'   => "Invalid Request/Already Removed",
            'err'       => true
        );
        echo json_encode($result);
    }catch(PDOException $pe){
        echo db_error($pe->getMessage()); 
        
        
    }
    
}

function sendJSONdataart() {
    //print_r($_POST);
    $result = array();
    try {
        $conn = dbconnect();
        $qry = "SELECT * FROM artworks WHERE artist_id=:peopleID ORDER by last_update";
        $q = $conn->prepare($qry);
        $bind = array(':peopleID' => stripcslashes($_POST['artwork']));
        //echo PdoDebugger::show($qry, $bind);

        $q->execute($bind);
        $q->setFetchMode(PDO::FETCH_ASSOC);
        while ($row = $q->fetch()) {
            $result[] = $row;
        }
        $data['items'] = $result;
        echo json_encode($data);
    } catch (PDOException $pe) {
        echo db_error($pe->getMessage());
    }
}

function carousel_status(){
    $status = stripslashes($_POST['status']);
    $id = stripcslashes($_POST['image']);
    $flag = (!empty($status) && $status == 'true') ? 1 : 0;
    try{
        $conn = dbconnect();
        $qry = "UPDATE " . CAROUSEL_TBL . " SET status =:stat WHERE id= :cimageID";
        $q = $conn->prepare($qry);
        $bind = array(':stat' => $flag, ':cimageID' => $id);
        $q->execute($bind);
        if ($q->rowCount() > 0) {
            $result = array(
                'status' => "Updation successfull",
                'err' => false
            );
            echo json_encode($result);
            exit;
        }
        $result = array(
            'status' => "Invalid Request",
            'err' => true
        );
        echo json_encode($result);
        
    }catch(PDOException $pe){
        echo db_error($pe->getMessage());
    }
    
}
/**
 * This function will return a modal template to select which exhibition you want to add
 */
function getExhibition(){
    
    $art_id = $_POST['image_id'];
    $artist_id = $_POST['artwork'];
    $html = '';
    try{
        
        $conn = dbconnect();
            
        $qry = "SELECT `exhibition_id`,`ex_name` FROM " . EXHIBITION . " ORDER BY date_added";


        $q = $conn->prepare($qry);
        $q->execute();
        $q->setFetchMode(PDO::FETCH_ASSOC);
        $msl = '';
        while ($row = $q->fetch()) {

            $msl .= '<option value="' . $row['exhibition_id'] . '">' . stripslashes($row['ex_name']) . '</option>';
            $hc[] = array(
                'id' => $row['exhibition_id'],
                'name' => $row['ex_name']
            );
        }


        $selectData = array(
            's' => '<select id="exhibition" name="exhibition" >' . $msl . '</select>',
            'h' => $hc
        );
        
        $html = '<div class="modal fade" id="squarespaceModal" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
  <div class="modal-dialog">
	<div class="modal-content">
        <form id="add-exhibition">
		<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
			<h3 class="modal-title" id="lineModalLabel">Select Exhibition</h3>
		</div>
		<div class="modal-body">
			
            <!-- content goes here -->
		
                    <input type="hidden" name="image" value="' . $art_id . '">
                    <input type="hidden" name="artist" value="' . $artist_id .'">
              
              
              <div class="checkbox">
                <label>List of Exhibitions</label>'. $selectData['s'] .
              '</div>
               
		</div>
		<div class="modal-footer">
			<div class="btn-group btn-group-justified" role="group" aria-label="group button">
				<div class="btn-group" role="group">
					<button type="button" class="btn btn-default" data-dismiss="modal"  role="button">Close</button>
				</div>
				<div class="btn-group btn-delete hidden" role="group">
					<button type="button" id="delImage" class="btn btn-default btn-hover-red" data-dismiss="modal"  role="button">Delete</button>
				</div>
				<div class="btn-group" role="group">
					<input type="button" class="btn btn-default saveExhibition" value="Save" >
				</div>
                                </div>
		</div>
                </form>
	</div>
  </div>
</div>';
       echo json_encode($html);
    }catch(PDOException $pe){
        echo db_error($pe->getMessage());
    }
}

function setExhibition(){
        try{
            $conn = dbconnect();
            $columns = array(
                'exh_art_id'    => 'null',
                'exh_id'        => ':exhibition',
                'artwork_id'    => ':artwork',
                'artist_id'     => ':artist',
                'status'        => ':status',
                'date_added'    => 'now()'
            );
            $bind = array(
                ':exhibition'   => $_POST['exhibition'],
                ':artwork'      => $_POST['image'],
                ':artist'       => $_POST['artist'],
                ':status'       => 'Y'
                
                
            );
            
            $err = false;
            $qry = insert(EXHIBITION_ARTWORK, $columns);
            $q   = $conn->prepare($qry);
            $q->execute($bind);
            $id  = $conn->lastInsertId();
            
        }catch(PDOException $pe){
            $err = true;
             $er =  db_error($pe->getMessage());
    }
    
    if(!$err){
        $json = array(
            'msg' => "Exhibition Added Successfully",
            
        );
        echo json_encode($json);
        exit();
    }
    $json = array(
        'msg' => $er
    );
    echo json_encode($json);
    
}

function delete_attributes(){
	try{
		$conn = dbconnect();
		$deleted=0;
		if(isset($_POST["id"])){
		
		foreach($_POST['id'] AS $delIds){
			$qry = "DELETE FROM `attribute_value_ecomc` WHERE `attr_value_id`=:id";
			$stmt = $conn->prepare($qry);
			$stmt->execute(array(':id' => $delIds));
			if($stmt->rowCount() > 0) $deleted++;
			}
		}
		
	}catch(PDOException $pe){
		echo db_error($pe->getMessage());
		
	}
	
}