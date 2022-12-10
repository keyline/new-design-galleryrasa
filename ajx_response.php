<?php

require_once("require.php");
require_once(INCLUDED_FILES . "config.inc.php");
require_once(INCLUDED_FILES . "dbConn.php");
require_once(INCLUDED_FILES . "functionsInc.php");
require_once(INCLUDED_FILES . "formats/Chicago_format.php");
$conn = dbconnect();

if (is_ajax()) {
    if (isset($_POST["action"]) && !empty($_POST["action"]) || !empty($_REQUEST['action'])) { //Checks if action value exists
        if (!isset($_POST['action'])) {
            $action = $_REQUEST['action'];
        } else {
            $action = $_POST["action"];
        }

        switch ($action) { //Switch case for value of action
            case "homeSearch": get_json_multiSelect($conn);
                break;
            case "allSearch": get_json_multiSelect_all($conn);
                break;
            case "allDescriptivetag": get_json_multiSelect_desctag($conn);
                break;
            case "CiteThis": CiteThis();
                break;
            case "PreviewPdf": Preview();
                break;
            case "send_msg_contact": ContactFormSubmit();
                break;
        }
    }
}

function is_ajax()
{
    return isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest';
}

function get_json_multiSelect($conn)
{
    //Initializing variables
    $paramCount = 0;
    $otherParamCount = 0;
    $qstr = array();
    $json = array();
    //Strting code
    //$qry_arr = filter_var_array($_POST, FILTER_SANITIZE_STRING);
    $qry_arr = $_POST;

    if (count($qry_arr) > 0) {
        foreach ($qry_arr as $k => $v) {
            if ($k == 'action') {
                continue;
            }
            if ($k == 'attributes') {
                for ($i = 0; $i < count($v); $i++) {
                    $qstr[] = $v[$i]['value'];
                }
                $paramCount = $i;
            } else {
                $qstr[] = $v;
                $otherParamCount ++;
            }
        }
    }
    if (!empty($paramCount)) {
        for ($p = 0; $p < $paramCount; $p++) {
            $content[] = "'%s'";
        }
        $params = implode(",", $content);
    }

    try {
        $conn = dbconnect();
        $str = array();
        $s = count($qstr);
        $a = array('with', 'less', 'and');    # ignore these search terms
        $count = 0;
        for ($i = 0; $i < $s; $i++) {
            (strlen($qstr[$i]) > 0 && !in_array(strtolower($qstr[$i]), $a)) ? (array_push($str, $qstr[$i])) : ('');
        }

        $mQuery = 'SELECT 
                            SUBSTR(value, 1, 1) AS alpha,
                            product_type_attribute_key.attribute_id,
                            attribute_value_ecomc.`value`,
                            attr_common_flds_ecomc.attribute_name,
                            product_type_ecomc.product_type_name
                            FROM
                            product_type_attribute_key
                            INNER JOIN attribute_value_ecomc ON product_type_attribute_key.attribute_id = attribute_value_ecomc.attr_id
                            INNER JOIN product_type_ecomc ON product_type_ecomc.product_type_id = product_type_attribute_key.p_type_id
                            INNER JOIN attr_common_flds_ecomc ON attribute_value_ecomc.attr_id = attr_common_flds_ecomc.id
                            WHERE product_type_name = "%s" and `value` LIKE "%%' . "%s" . '%%" and attribute_name IN (' . $params .
                ') ORDER BY alpha ASC';


        $sql = vsprintf($mQuery, $str);
        $q = $conn->prepare($sql);
        $q->execute();
        $q->setFetchMode(PDO::FETCH_ASSOC);
        if ($q->rowCount() > 0) {
            $rows = $q->fetchAll();

            function myComparison($a, $b)
            {
                return (($a['value']) > ($b['value'])) ? 1 : -1;
            }

            uasort($rows, 'myComparison');
            $finalResult = array_values($rows);
            $grp = '';
            $match = 0;
            for ($i = 0; $i < count($finalResult); $i++) {
//            $match = $i+1;
                if ($grp !== $finalResult[$i]['alpha']) {
                    $json[$i] = array(
                        'id' => $i,
                        'text' => $finalResult[$i]['alpha']
                    );
                }


                if ($finalResult[$i]['attribute_name'] == 'va_artist') {
                    //$attrname = '(Artist)';
                    $attrname = '';
                } else {
                    $attrname = '(' . $finalResult[$i]['attribute_name'] . ')';
                }


                $json[$i]['children'][] = array('id' => $finalResult[$i]['attribute_name'] . ":" . $finalResult[$i]['value'], 'text' => $finalResult[$i]['value'] . $attrname);


                $grp = $finalResult[$i]['alpha'];
            }
        } else {
            $json = array('id' => '0', 'text' => 'No Program Found');
        }
    } catch (PDOException $pe) {
        echo db_error($pe->getMessage());
    }

    //print_r($rows);
    //$term = stripslashes($_POST['term']);
    //$qry = "SELECT * FROM " . ATTR_VAL . " WHERE value LIKE '%" . stripslashes($term) . "%' AND (attr_id = 3 OR attr_id = 2) order by attr_value_id ASC";
    //$qry = "SELECT DISTINCT SUBSTR(value, 1, 1) AS alpha, value FROM " . ATTR_VAL . " WHERE value LIKE '%" . stripslashes($term) . "%' order by value ASC";



    header('Content-type: application/json');
    echo json_encode($json);
}

function get_json_multiSelect_all($conn)
{
    //Initializing variables
    $paramCount = 0;
    $otherParamCount = 0;
    $qstr = array();
    $json = array();
    //Strting code
    //$qry_arr = filter_var_array($_POST, FILTER_SANITIZE_STRING);
    $qry_arr = $_POST;

    if (count($qry_arr) > 0) {
        foreach ($qry_arr as $k => $v) {
            if ($k == 'action') {
                continue;
            }
            if ($k == 'term') {
                $qstr[] = $v;
                $otherParamCount ++;
            }
            if ($k == 'attributes') {
                if ($otherParamCount=='0') {
                    $startingpoint = $otherParamCount+1;
                } else {
                    $startingpoint = '0';
                }

                for ($i = $startingpoint; $i < count($v); $i++) {
                    $qstr[] = $v[$i]['value'];
                }
                $paramCount = $i;

//                for ($i = 0; $i < count($v); $i++) {
//                    $qstr[] = $v[$i]['value'];
//                }
//                $paramCount = $i;
            }
//            else {
//                $qstr[] = $v;
//                $otherParamCount ++;
//            }
        }
    }
    if (!empty($paramCount)) {
        for ($p = 0; $p < $paramCount; $p++) {
            $content[] = "'%s'";
        }
        $params = implode(",", $content);
    }

    try {
        $conn = dbconnect();
        $str = array();
        $s = count($qstr);
        $a = array('with', 'less', 'and');    # ignore these search terms
        $count = 0;
        for ($i = 0; $i < $s; $i++) {
            (strlen($qstr[$i]) > 0 && !in_array(strtolower($qstr[$i]), $a)) ? (array_push($str, $qstr[$i])) : ('');
        }

        /*
                $mQuery = 'SELECT
                                    SUBSTR(value, 1, 1) AS alpha,
                                    product_type_attribute_key.attribute_id,
                                    attribute_value_ecomc.`value`,
                                    attr_common_flds_ecomc.attribute_name,
                                    product_type_ecomc.product_type_name
                                    FROM
                                    product_type_attribute_key
                                    INNER JOIN attribute_value_ecomc ON product_type_attribute_key.attribute_id = attribute_value_ecomc.attr_id
                                    INNER JOIN product_type_ecomc ON product_type_ecomc.product_type_id = product_type_attribute_key.p_type_id
                                    INNER JOIN attr_common_flds_ecomc ON attribute_value_ecomc.attr_id = attr_common_flds_ecomc.id
                                    WHERE `value` LIKE "%%' . "%s" . '%%" and attribute_name IN (' . $params .
                        ') ORDER BY alpha ASC';
        */
        //dharmendrasinh code
        $mQuery = 'SELECT 
                            SUBSTR(value, 1, 1) AS alpha,
                            product_type_attribute_key.attribute_id,
                            attribute_value_ecomc.`value`,
                            attr_common_flds_ecomc.attribute_name,
                            product_type_ecomc.product_type_name
                            FROM
                            product_type_attribute_key
                            INNER JOIN attribute_value_ecomc ON product_type_attribute_key.attribute_id = attribute_value_ecomc.attr_id
                            INNER JOIN product_type_ecomc ON product_type_ecomc.product_type_id = product_type_attribute_key.p_type_id
                            INNER JOIN attr_common_flds_ecomc ON attribute_value_ecomc.attr_id = attr_common_flds_ecomc.id
                            WHERE `value` LIKE "%%' . "%s" . '%%" and attribute_name IN (' . $params .
                ') ORDER BY alpha ASC';


        $sql = vsprintf($mQuery, $str);
        $q = $conn->prepare($sql);
        $q->execute();
        $q->setFetchMode(PDO::FETCH_ASSOC);
        if ($q->rowCount() > 0) {
            $rows = $q->fetchAll();

            function myComparison($a, $b)
            {
                return (($a['value']) > ($b['value'])) ? 1 : -1;
            }

            uasort($rows, 'myComparison');
            $finalResult = array_values($rows);
            $grp = '';
            $i = 0;
            $customI = 0;
            for ($i = 0; $i < count($finalResult); $i++) {
//            $match = $i+1;
                if ($grp !== $finalResult[$i]['alpha']) {
                    //dharmendrasinh code comment
                    //$json[$i] = array(
                    //    'id' => $i,
                    //    'text' => $finalResult[$i]['alpha']
                    //);
                }

                $nameValueFlag = 'false';
                $getNameValueDatas = explode(' ', $finalResult[$i]['value']);

                $searchTermCount = strlen(trim($_POST['term']));
                foreach ($getNameValueDatas as $getNameValueData) {
                    $searchDBValue = trim(substr($getNameValueData, 0, $searchTermCount));
                    //echo quotemeta($searchDBValue);
                    $newSeachDBValue1 = str_replace('(', '', $searchDBValue);
                    $newSeachDBValue2 = str_replace("'", '', $newSeachDBValue1);
                    $newSeachDBValue3 = str_replace(".", '', $newSeachDBValue2);
                    $newSeachDBValue4 = str_replace('"', '', $newSeachDBValue3);
                    $newSeachDBValue5 = str_replace(')', '', $newSeachDBValue4);
                    $newSeachDBValue6 = str_replace('[', '', $newSeachDBValue5);
                    $newSeachDBValue7 = str_replace(']', '', $newSeachDBValue6);
                    $termFormValue = $_POST["term"];
                    //echo "'".$newSeachDBValue5. "'";
                    //echo strtolower($termFormValue). "'".strtolower($newSeachDBValue7). "'";
                    if (!preg_match('/[^A-Za-z0-9]/', $newSeachDBValue7)) {
                        if (strtolower(trim($termFormValue)) == strtolower(trim($newSeachDBValue7))) {
                            //echo 'fail';
                            $nameValueFlag = 'true';
                        } else {
                            //echo strtolower($termFormValue). "'".strtolower($newSeachDBValue7). "'";
                            $nameValueFlag = 'true';
                        }
                    }
                }

                /*
                foreach ($getNameValueDatas as $getNameValueData) {
                    $searchTermCount = strlen($_POST['term']);
                    $searchDBValue = substr($getNameValueData, 0, $searchTermCount);
                    if(strtolower($searchDBValue) == strtolower($_POST["term"])){
                        $nameValueFlag = 'true';
                    }
                }
                */

                if ($nameValueFlag == 'true') {
                    if ($finalResult[$i]['attribute_name'] == 'va_artist') {
                        //$attrname = '(Artist)';
                        $attrname = '';
                    } else {
                        $attrname = ' (' . $finalResult[$i]['attribute_name'] . ')';
                    }

                    $product_type_name = ' (' .$finalResult[$i]['product_type_name'] . ')';

                    $idattrname = $finalResult[$i]['product_type_name'];


                    $json[$customI]['children'][] = array('id' => $finalResult[$i]['attribute_name'] . ":" . $finalResult[$i]['value'].":".$idattrname, 'text' => $finalResult[$i]['value'] . $attrname.$product_type_name);

                    $grp = $finalResult[$i]['alpha'];

                    $customI++;
                }
            }

            if ($i == 0) {
                $json = array('id' => '0', 'text' => 'No Program Found');
            }
        } else {
            $json = array('id' => '0', 'text' => 'No Program Found');
        }
    } catch (PDOException $pe) {
        echo db_error($pe->getMessage());
    }

    //print_r($rows);
    //$term = stripslashes($_POST['term']);
    //$qry = "SELECT * FROM " . ATTR_VAL . " WHERE value LIKE '%" . stripslashes($term) . "%' AND (attr_id = 3 OR attr_id = 2) order by attr_value_id ASC";
    //$qry = "SELECT DISTINCT SUBSTR(value, 1, 1) AS alpha, value FROM " . ATTR_VAL . " WHERE value LIKE '%" . stripslashes($term) . "%' order by value ASC";

    header('Content-type: application/json');
    echo json_encode($json);
    //print_r($str);
    //echo $sql;
}



function get_json_multiSelect_desctag($conn)
{
    //Initializing variables
    $paramCount = 0;
    $otherParamCount = 0;
    $qstr = array();
    $json = array();
    //Strting code
    //$qry_arr = filter_var_array($_POST, FILTER_SANITIZE_STRING);
    $qry_arr = $_POST;

    if (count($qry_arr) > 0) {
        foreach ($qry_arr as $k => $v) {
            if ($k == 'action') {
                continue;
            }
            if ($k == 'attributes') {
                for ($i = 0; $i < count($v); $i++) {
                    $qstr[] = $v[$i]['value'];
                }
                $paramCount = $i;
            } else {
                $qstr[] = $v;
                $otherParamCount ++;
            }
        }
    }
    if (!empty($paramCount)) {
        for ($p = 0; $p < $paramCount; $p++) {
            $content[] = "'%s'";
        }
        $params = implode(",", $content);
    }

    try {
        $conn = dbconnect();
        $str = array();
        $s = count($qstr);
        $a = array('with', 'less', 'and');    # ignore these search terms
        $count = 0;
        for ($i = 0; $i < $s; $i++) {
            (strlen($qstr[$i]) > 0 && !in_array(strtolower($qstr[$i]), $a)) ? (array_push($str, $qstr[$i])) : ('');
        }

//        $mQuery = 'SELECT
//                            SUBSTR(value, 1, 1) AS alpha,
//                            product_type_attribute_key.attribute_id,
//                            attribute_value_ecomc.`value`,
//                            attr_common_flds_ecomc.attribute_name,
//                            product_type_ecomc.product_type_name
//                            FROM
//                            product_type_attribute_key
//                            INNER JOIN attribute_value_ecomc ON product_type_attribute_key.attribute_id = attribute_value_ecomc.attr_id
//                            INNER JOIN product_type_ecomc ON product_type_ecomc.product_type_id = product_type_attribute_key.p_type_id
//                            INNER JOIN attr_common_flds_ecomc ON attribute_value_ecomc.attr_id = attr_common_flds_ecomc.id
//                            WHERE product_type_name = "%s" and `value` LIKE "%%' . "%s" . '%%" and attribute_name IN (' . $params .
//                ') ORDER BY alpha ASC';


        $mQuery = "SELECT 
                            SUBSTR(value, 1, 1) AS alpha,
                            product_type_attribute_key.attribute_id,
                            attribute_value_ecomc.`value`,
                            attr_common_flds_ecomc.attribute_name,
                            product_type_ecomc.product_type_name
                            FROM
                             product_type_attribute_key
                            INNER JOIN attribute_value_ecomc ON product_type_attribute_key.attribute_id = attribute_value_ecomc.attr_id
                            INNER JOIN product_type_ecomc ON product_type_ecomc.product_type_id = product_type_attribute_key.p_type_id
                            INNER JOIN attr_common_flds_ecomc ON attribute_value_ecomc.attr_id = attr_common_flds_ecomc.id
                            WHERE product_type_name = '"."%s"."' and `value` LIKE '"."%%" . "%s" . "%%"."' and attribute_name IN ('va_descriptive_tags') ORDER BY alpha ASC";


        $sql = vsprintf($mQuery, $str);
        $q = $conn->prepare($sql);
        $q->execute();
        $q->setFetchMode(PDO::FETCH_ASSOC);
        if ($q->rowCount() > 0) {
            $rows = $q->fetchAll();

            function myComparison($a, $b)
            {
                return (($a['value']) > ($b['value'])) ? 1 : -1;
            }

            uasort($rows, 'myComparison');
            $finalResult = array_values($rows);
            $grp = '';
            $match = 0;
            for ($i = 0; $i < count($finalResult); $i++) {
//            $match = $i+1;
                if ($grp !== $finalResult[$i]['alpha']) {
                    $json[$i] = array(
                        'id' => $i,
                        'text' => $finalResult[$i]['alpha']
                    );
                }


                if ($finalResult[$i]['attribute_name'] == 'va_artist') {
                    //$attrname = '(Artist)';
                    $attrname = '';
                } else {
                    //$attrname = '(' . $finalResult[$i]['attribute_name'] . ')';
                    $attrname = '';
                }


                $json[$i]['children'][] = array('id' => $finalResult[$i]['attribute_name'] . ":" . $finalResult[$i]['value'], 'text' => $finalResult[$i]['value'] . $attrname);


                $grp = $finalResult[$i]['alpha'];
            }
        } else {
            $json = array('id' => '0', 'text' => 'No Program Found');
        }
    } catch (PDOException $pe) {
        echo db_error($pe->getMessage());
    }

    //print_r($rows);
    //$term = stripslashes($_POST['term']);
    //$qry = "SELECT * FROM " . ATTR_VAL . " WHERE value LIKE '%" . stripslashes($term) . "%' AND (attr_id = 3 OR attr_id = 2) order by attr_value_id ASC";
    //$qry = "SELECT DISTINCT SUBSTR(value, 1, 1) AS alpha, value FROM " . ATTR_VAL . " WHERE value LIKE '%" . stripslashes($term) . "%' order by value ASC";

//echo $sql;

    header('Content-type: application/json');
    echo json_encode($json);
}










function CiteThis()
{
    $key_order = array(
        'author' => 0,
        'title_of_article' => 1,
        'title1_of_parent' => 2,
        'editor' => 3,
        'volume' => 4,
        'issue' => 5,
        'gregorian_month' => 6,
        'date' => 7,
        'gregorian_year' => 8,
        'pagination' => 9,
        'artist' => 15,
        'country_of_publication' => 16,
        'place_of_publication' => 17,
        'publisher' => 18,
        'reference_type' => 19,
        'product' => 20,
        'translated_title' => 21,
        'language' => 22,
        'translated1_title_of_parent' => 23,
        'illustrated' => 24,
        'translated_byform' => 25,
        'doi_url' => 26,
        'other_person_mentioned' => 27,
        'archivist_remarks' => 28,
        'descriptive_tags' => 29,
        'location' => 30,
        'translator' => 31,
        'vernacular_year' => 32,
        'curator' => 33,
        'compiler' => 34,
        'gallery_musuem' => 35,
        'place_of_gallery' => 36,
        'edition' => 37,
        'foreword' => 38,
        'preface' => 39,
        'contributor' => 40,
        'type1_of_parent' => 60,
        'subject' => 61,
        'book_cover_designer' => 62
    );

    $prodID = cleanvars($_POST['headerId']);
    $rows = getAttributesByProductID($prodID);
    $data = array();
    foreach ($rows as $row) {
        $data[$row['product']][$row['attribute_name']] = $row['value'];
    }

    $finalData = array();
    foreach ($data as $key => $value) {
        $finalData['product'] = $key;
        if (is_array($value)) {
            foreach ($value as $k => $v) {
                $finalData[$k] = $v;
            }
        }
    }
//    print_r($finalData);
    uksort($finalData, function ($a, $b) use ($key_order) {
        if ($key_order[$a] > $key_order[$b]) {
            return 1;
        } elseif ($key_order[$a] < $key_order[$b]) {
            return -1;
        } else {
            return 0;
        }
    });
    //Get product type name
    //$result = getcategoryName($prodID);
    //Marge array to get total key : values of a product
    //$output = $result + $finalData;
//    print "<pre>";
//    print_r($finalData);
//    print "</pre>";
    //exit;
    //Send authors for formatting
    $cite = CSLbookcite($finalData);

    $json = array(
        'Status' => 'success',
        'Response' => $cite
    );

    echo json_encode($json);
}

function Preview()
{
    $bibliographyPath = "bibliography/";
    $siteurl = SITE_URL . "/" . IMGSRC . $bibliographyPath;
    $pid = $_POST['headerId'];
    try {
        $conn = dbconnect();
        $query = "SELECT m_image_name FROM memorabilia_images WHERE `product_id`='%s' and m_image_category= 'B'";
        $sql = sprintf($query, $pid);
        $q = $conn->prepare($sql);

        $q->execute();
        $q->setFetchMode(PDO::FETCH_ASSOC);

        if ($q->rowCount() > 0) {
            while ($rows = $q->fetch()) {
                $json = array(
                    'imageURL' => $q->rowCount() == 0 ? false : $siteurl . $rows['m_image_name']
                );
            }
        } else {
            $json = array(
                'errormsg' => '<h3>Attachment not available right now, Please try again later</h3>'
            );
        }


        echo json_encode($json);
    } catch (PDOException $pe) {
        echo db_error($pe->getMessage());
    }
}

function ContactFormSubmit()
{
    $baseURL = "https://www.google.com/recaptcha/api/siteverify?secret=6Ld6xT4UAAAAAF5lMRU144y9Yfz-N8cgBEvnbaVA&response=%s&remoteip=%s";
    $name = remove_headers($_POST['name']);
    $email = remove_headers($_POST['email']);
    $msg = remove_headers($_POST['message']);
    $remote_ip = getenv('REMOTE_ADDR');
    $captcha = $_POST['captcha'];
    $http_referrer = getenv("HTTP_REFERER");
    $status = true;

    if (!preg_match("/^[A-Z0-9._%-]+@[A-Z0-9.-]+\.[A-Z]{2,4}$/i", $email)) {
        $status = false;
        $json = array(
            'msg' => 'Incorrect email, Please enter a valid email',
            'staus' => $status,
            'class' => "alert alert-warning"
        );
    }
    if (empty($name) || empty($email) || empty($msg)) {
        $status = false;
        $json = array(
            'msg' => 'Invalid input, Please fill up the form correctly',
            'staus' => $status,
            'class' => "alert alert-warning"
        );
    }


    //check Google Captcha verification


    if (!empty($baseURL) && $status) {
        //Get admin email from db
        $conn = dbconnect();
        $qry_em = "SELECT admin_ecomc.email admin_email from admin_ecomc";
        $q_em = $conn->prepare($qry_em);
        $q_em->execute();
        $q_em->setFetchMode(PDO::FETCH_ASSOC);
        $row_em = $q_em->fetch();
        $admin_email = $row_em['admin_email'];
        $url = sprintf($baseURL, $captcha, $remote_ip);

        $response = CURLdataProcess($url);
        $obj = json_decode($response);

        if ($obj->success) {
            $emailfrom = "galleryrasa@gmail.com";
            $get_mail = get_particular_email('contact-form');
            $cf = html_entity_decode($get_mail['content']);
            $sub = $get_mail['subject'];
            $subject = str_replace(array('{person_enquire}'), array($name), $sub);
            $message = str_replace(array('{http_reffer}', '{name}', '{email}', '{msg}'), array($http_referrer, $name, $email, $msg), $cf);
            //$emailname = 'Gallery\sRasa';
            //$nameform = 'Gallery\sRasa';

            $emailname = 'Gallery Rasa <galleryrasa@gmail.com>';
            $nameform = '';

            $mail = send_mail($admin_email, $subject, $message, $emailname, $nameform);
            $qry_mail = "insert into email_log(id,email,email_name,subject,text,date) "
                    . "values('','$admin_email','Contact-form-enquiry','$subject','$message','date()')";
            $q_mail = $conn->prepare($qry_mail);
            $q_mail->execute();

            if ($mail) {
                $json = array(
                    'msg' => "Thank you! Your message was sent successfully.",
                    'status' => true,
                    'class' => "alert alert-success"
                );
            } else {
                $json = array(
                    'msg' => "Mail send failed, contact to admin",
                    'status' => false,
                    'class' => "alert alert-warning"
                );
            }
        } else {
            $json = array(
                'msg' => "Please Check the captcha check box",
                'status' => false,
                'class' => "alert alert-warning"
            );
        }
    }


    echo json_encode($json);
}

function remove_headers($string)
{
    $headers = array(
        "/to\:/i",
        "/from\:/i",
        "/bcc\:/i",
        "/cc\:/i",
        "/Content\-Transfer\-Encoding\:/i",
        "/Content\-Type\:/i",
        "/Mime\-Version\:/i"
    );
    if (preg_replace($headers, '', $string) == $string) {
        return $string;
    } else {
        die('You think Im spammy? Spammy how? Spammy like a clown, spammy?');
    }
}

function CURLdataProcess($url)
{
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_URL, $url);
    return $JSONresponse = (curl_errno($ch)) ? curl_error($ch) : curl_exec($ch);
}
