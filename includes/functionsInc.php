<?php

/* Project Name: Rasa
 * Author: Keyline
 * Author URI: http://www.keylines.net
 * Author e-mail: info@keylines.net
 * Version: 1.0
 * Created: July 2017
 * License: http://keylines.net/
 */

//require_once(INCLUDED_FILES . "pdo-debug.php");
//function __autoload($classname) {
//    $filename = "../Class/PayUMoney/". $classname .".php";
//    include_once($filename);
//}

function product_discount($price, $discount, $f = false)
{
    if ($f) {
        return $price * ($discount / 100);
    } else {
        return $price - ($price * $discount / 100);
    }
}

function no_admin_exist()
{
    try {
        $conn = dbconnect();
        $q = $conn->query("SELECT * FROM " . ADMIN_TBL);
        $q->execute();
        $q->setFetchMode(PDO::FETCH_ASSOC);

        return $q->rowCount() == 0 ? false : true;
    } catch (PDOException $pe) {
        echo db_error($pe->getMessage());
    }
}

function clean_link($str)
{
    $clean = preg_replace("/[^a-zA-Z0-9\/_|+ -]/", '', $str);
    $clean = strtolower(trim($clean, '-'));
    $clean = preg_replace("/[\/_|+ -]+/", '-', $clean);
    return $clean;
}

//function send_mail($to, $subject, $msg, $type, $emailfrom, $name = null) {
function send_mail($to, $subject, $msg, $emailfrom, $namefrm, $type = "html")
{
    // $namefrm = ($name == null) ? ($emailfrom) : ($name);
//    if ($type == 1) {
//        $type = "html";
//    } else {
//        $type = "plain";
//    }

    $headers = '';
    $headers .= 'From: ' . $namefrm . ' <' . $emailfrom . '>' . "\r\n";
    $headers .= "Reply-To: " . $emailfrom . "\r\n";
    $headers .= "MIME-Version: 1.0\r\n";
    $headers .= "Content-Type: text/$type; charset=UTF-8\r\n";

    if (mail($to, $subject, $msg, $headers)) {
        return true;
    } else {
        return false;
    }
}

function update_views($conn, $col = 'views', $tbl = PRODUCTS_TBL, $id = 'prodid')
{
    try {
        $qry = "UPDATE " . $tbl . "
	        SET " . $col . "=" . $col . "+1
	        WHERE $id=:id";
        $q = $conn->prepare($qry);
        $q->bindParam(':id', $_GET['p']);
        $q->execute();
    } catch (PDOException $pe) {
        echo db_error($pe->getMessage());
        exit;
    }
}

function check_auth_admin()
{
    if (!isset($_SESSION['valid_admin'])) {
        goto_location('login');
        exit;
    }
}

function clean($string)
{
    $string = str_replace(' ', '-', $string); // Replaces all spaces with hyphens.
    $string2 = preg_replace('/[^A-Za-z0-9\-]/', '', $string); // Removes special chars.
    $string3 = preg_replace('/-+/', '-', $string2);
    return $string3;
}

function create_folder($folder = null)
{
    if (!is_null($folder)) {
        if (!is_dir($folder)) {
            $old_musk = umask(0);
            mkdir($folder, 0755);
            umask($old_musk);
        }
    }
}

function upload_name($imgFile)
{
    $RandomNum = rand(0, 9999999999);
    $ImageName = str_replace(' ', '-', strtolower($imgFile["name"]));
    $exp = explode('.', $imgFile["name"]);
    $ImageExt = array_pop($exp);
    $ImageName = preg_replace("/\.[^.\s]{3,4}$/", "", $ImageName);
    return substr($ImageName, 0, 30) . '-' . $RandomNum . '.' . $ImageExt;
}

function update($table, $fields, $criteria, $pdo = false)
{
    foreach ($fields as $k => $value) {
        if ($value == 'now()' || $pdo) {
            $updates[] = "{$k}={$value}";
        } else {
            $updates[] = "{$k}='{$value}'";
        }
    }
    $update = join(", ", $updates);

    foreach ($criteria as $col => $value) {
        $wheres[] = "{$col}='{$value}'";
    }
    $where = join(" AND ", $wheres);

    $string = "UPDATE {$table} SET {$update} WHERE {$where}";
    return $string;
}

function product_attributes($conn, $id, $atid)
{
    try {
        $q = $conn->prepare("SELECT " . ATTRIBUTES_TBL . ".*, " . ATTRIBUTE_VARS_TBL . ".*
	            FROM " . ATTRIBUTES_TBL . "
	            LEFT JOIN
	            " . ATTRIBUTE_VARS_TBL . " ON " . ATTRIBUTES_TBL . ".id=" . ATTRIBUTE_VARS_TBL . ".id
	            WHERE " . ATTRIBUTES_TBL . ".id=:id");
        $q->bindParam(':id', $id, PDO::PARAM_INT);
        $q->execute();
        $q->setFetchMode(PDO::FETCH_ASSOC);
        $o = null;
        while ($row = $q->fetch()) {
            $name = stripslashes($row['name']);
            $val = $atid == 2 ? ($row['price']) : ('');
            $price = ($atid == 2) ? ('&nbsp;&nbsp;(' . $row['price'] . ')') : ('');
            $o .= '<option id="' . $row['uid'] . '" value="' . $val . '">' . stripslashes($row['var']) . $price . ' </option>';
        }
    } catch (PDOException $pe) {
        echo db_error($pe->getMessage());
        exit;
    }
    return '<div class="form-group">
	    <label><span id="lbl' . $atid . '">' . $name . ' [' . $id . '] &nbsp; &nbsp;</span><small>
	    <a href="#" data-toggle="modal" name="attrib-modal" id="' . $atid . '" data-target="#attrib">Edit</a>  &nbsp; &nbsp;
	    <span id="del_attrib" data-id="' . $atid . '"  data-attrib="attribute' . $atid . '" class="glyphicon glyphicon-remove text-danger" aria-hidden="true"></small></span>
	    </label><select  class="form-control" id="attribute' . $atid . '">' . $o . '
	    </select>
	    <input  id="atr' . $atid . '" name="atr' . $atid . '" type="hidden" value="' . $id . '">
	    </div>';
}

function db_error($err)
{
    if (SHOW_ERR) {
        return $err;
    } else {
        return 'Database error has occured. Please try again later';
    }
}

function gen_id($len)
{
    $id = md5(uniqid(microtime(), 1)) . getmypid();
    return $id = substr($id, 0, $len);
}

function get_email_address($conn)
{
    $q = $conn->prepare("SELECT email  FROM " . ADMIN_TBL . " where user='" . $_SESSION['valid_admin'] . "'");
    $q->execute();
    $q->setFetchMode(PDO::FETCH_ASSOC);
    $row = $q->fetch();
    return $row['email'];
}

function insert($table, $fields)
{
    foreach ($fields as $k => $v) {
        $key[] = "{$k}";
        $value[] = "{$v}";
    }
    $keys = join(", ", $key);
    $values = join(", ", $value);

    return "INSERT INTO {$table} ({$keys}) VALUES({$values})";
}

function insert_multi($table, $fields)
{
    foreach ($fields as $k => $value) {
        $key[] = array_keys($value);
        $value[] = array_values($value);
    }

    $sql = "INSERT INTO $table (" . implode(', ', $key) . ") "
            . "VALUES ('" . implode("', '", $val) . "')";
    $pp = array(
        'key' => $key,
        'val' => $value
    );
    //return "INSERT INTO {$table} ({$keys}) VALUES({$values})";
    return $sql;
}

function get_stock_status($stock)
{
    if ($stock > 0) {
        $qry = "SELECT * FROM " . CATEGORIES_TBL . " where id=:id";
        $q = $conn->prepare($qry);
        $q->execute();
        $q->setFetchMode(PDO::FETCH_ASSOC);
    }
}

function save_pages($conn)
{
    try {
        $sql = "SELECT * FROM " . PAGES_TBL . " WHERE page_status=1";
        $q = $conn->query($sql);
        $q->setFetchMode(PDO::FETCH_ASSOC);

        if ($q->rowCount() == 0 && file_exists('../' . INC_FOLDER . CACHE_FILE . 'pages_cache.txt')) {
            unlink('../' . INC_FOLDER . CACHE_FILE . 'pages_cache.txt');
        }
        $link = '';
        while ($rows = $q->fetch()) {
            $tpl = file_get_contents(ADMIN_HTML . 'pages.tpl');

            $find = array(
                '{TITLE}',
                '{MAIN_TITLE}',
                '{CONTENT}'
            );

            $replace = array(
                stripslashes($rows['page_name']),
                stripslashes($rows['main_title']),
                stripslashes($rows['page_content'])
            );

            $page = str_replace($find, $replace, $tpl);
            cachefile('../' . $rows['page_link'] . '.php', $page);
            $link .= '<li><a href="' . SITE_URL . '/' . $rows['page_link'] . '">' . stripslashes($rows['page_name']) . '</a></li>';
        }
    } catch (PDOException $pe) {
        echo db_error($pe->getMessage());
    }
    if (strlen($link) > 1) {
        cachefile('../' . INC_FOLDER . CACHE_FILE . 'pages_cache.txt', $link);
    }
}

function get_product_info($row)
{
    if (!is_null($row['attrib1']) || !is_null($row['attrib2'])) {
        $arr = array_merge((array) $row['attrib1'], (array) $row['attrib2']);
        $a = '<br />' . join("<br /> ", $arr);
    } else {
        $a = '';
    }
    return stripslashes($a);
}

function goto_location($link)
{
    return header("Location: $link");
}

function get_categories($conn, $json = false, $n = null, $c = null, $hc = array())
{
    //Where no subcategories
    $qry = "SELECT * FROM " . CATEGORIES_TBL . " WHERE parent IS NULL ORDER By product_type_id desc";
    $q = $conn->prepare($qry);
    $q->execute();
    $q->setFetchMode(PDO::FETCH_ASSOC);
    $sl = $li = '';

    while ($row = $q->fetch()) {
        $cat = (!is_null($c) && $c == $row['product_type_id']) ? (' selected') : ('');
        $sl .= '<option value="' . $row['product_type_id'] . '" ' . $cat . '>' . stripslashes($row['product_type_name']) . '</option>';
        $li .= '<li class="list-group-item" id="rw' . $row['product_type_id'] . '"><span id="spancatn' . $row['product_type_id'] . '">
	        <input type="text" id="catn' . $row['product_type_id'] . '"  style="width:70%; padding:3px;" name="catn' . $row['product_type_id'] . '" value="' . stripslashes($row['product_type_name']) . '">
	        <input type="submit" value="Save" onclick="save_cat(' . $row['product_type_id'] . ')" class="btn btn-info btn-sm"></span> &nbsp; &nbsp; <a href="#" onclick="cat_del(' . $row['product_type_id'] . ')"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></a></li>';
        $hc[] = array(
            'id' => $row['product_type_id'],
            'name' => $row['product_type_name'],
            'link' => clean_link($row['product_type_name']) . '/1'
        );
    }

    return
            array(
                'm' =>
                '<ul class="list-group">' . $li . '</ul>',
                's' => '<select class="form-control" id="category" name="category" title="Select category" required="" ><option value=""></option>' . $sl . '</select>',
                'o' => stripslashes($n),
                'h' => $hc,
    );
}

function get_attrib_names($conn)
{
    $q = $conn->query("SELECT * FROM " . ATTRIBUTES_TBL);
    $q->setFetchMode(PDO::FETCH_ASSOC);
    $li = '';
    while ($row = $q->fetch()) {
        $li .= '<li class="list-group-item" id="rw' . $row['id'] . '"><span id="spanattrn' . $row['id'] . '">
	        ' . $row['id'] . ' <input type="text" id="attrn' . $row['id'] . '"  style="width:35%; padding:3px;" name="attrn' . $row['id'] . '" value="' . stripslashes($row['name']) . '">
	        <input type="submit" value="Save" onclick="save_attrn(' . $row['id'] . ')" class="btn btn-default btn-sm"></span> &nbsp; &nbsp; <a href="#" onclick="options_list(' . $row['id'] . ')" class="btn btn-default btn-sm">List</a> &nbsp; &nbsp; <a href="#" onclick="select_attrib(' . $row['id'] . ')" class="btn btn-default btn-sm">Select</a> &nbsp; &nbsp; <a href="#" onclick="attrn_del(' . $row['id'] . ')"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></a></li>';
    }

    return '<ul class="list-group">' . $li . '</ul>';
}

function get_attrib_options_list($conn)
{
    $q = $conn->prepare("SELECT " . ATTRIBUTES_TBL . ".*, " . ATTRIBUTE_VARS_TBL . ".*
	        FROM " . ATTRIBUTES_TBL . "
	        LEFT JOIN
	        " . ATTRIBUTE_VARS_TBL . " ON " . ATTRIBUTES_TBL . ".id=" . ATTRIBUTE_VARS_TBL . ".id
	        WHERE " . ATTRIBUTES_TBL . ".id=:id");
    $q->bindParam(':id', $_POST['id'], PDO::PARAM_INT);
    $q->execute();
    $q->setFetchMode(PDO::FETCH_ASSOC);
    $li = $f = $i = $name = '';
    $f = ($_POST['fi'] == 2) ? (true) : (false);
    $fm = ($f) ? ('<input type="text" id="optn_price"  onkeydown="allow_digits()" style="width:25%; padding:3px;" name="optn_price" placeholder="price">') : ('');
    while ($row = $q->fetch()) {
        $name = $row['name'];
        if (isset($row['uid'])) {
            $li .= '<li class="list-group-item" id="rw' . $row['uid'] . '">
	            <span id="spanattr_n_o' . $row['uid'] . '">
	            <input type="text" id="o_attrn' . $row['uid'] . '"  style="width:20%; padding:3px;" name="o_attrn' . $row['uid'] . '" value="' . stripslashes($row['var']) . '" placeholder="name">
	            <input type="text" id="o_attrs' . $row['uid'] . '"  onkeydown="allow_digits(' . $row['uid'] . ')"  style="width:20%; padding:3px;" name="o_attrs' . $row['uid'] . '" value="' . $row['stock'] . '" placeholder="stock">
	            ';
            if ($f) {
                $li .= ' <input type="text" id="o_attrp' . $row['uid'] . '"  onkeydown="allow_digits(' . $row['uid'] . ')" style="width:25%; padding:3px;" name="o_attrp' . $row['uid'] . '" value="' . $row['price'] . '" placeholder="price"> ';
            }
            $li .= ' <input type="submit" value="Save" onclick="save_o_attrn_p(' . $row['uid'] . ')" class="btn btn-default btn-sm">  ';

            $li .= '</span> &nbsp; &nbsp;  <a href="#" onclick="attrib_o_n_del(' . $row['uid'] . ')"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></a></li>';
        }
    }
    $i .= '<div class="refresh">
	    <ul class="list-group">' . $li . '</ul></div>';
    $a = '<div class="refresh">
	    <div id="attr_frm_opts">
	    <ul class="list-group">
	    <li class="list-group-item" >
	    <input type="text"  style="width:25%; height:30px;" name="optn_name" id="optn_name" placeholder="label">
	    <input type="text"  style="width:25%; height:30px;" name="optn_stock" id="optn_stock" placeholder="stock">
	    ' . $fm . ' <button type="submit" class="btn btn-info btn-sm" onclick="add_attrib_options()"> Add New</button>
	    <input id="oid" name="oid" type="hidden" value="' . $_POST['id'] . '">
	    </li>

	    </ul></div></div>
	    ';
    $b = '<div class="refresh"><br /><div id="rlist"><strong>' . $name . ' [' . $_POST['id'] . ']</strong>' . $i . '</div></div>';
    return array('a' => $a, 'b' => $b);
}

function create_thumb($sourcefile, $destfile, $fw, $fh, $jpegquality = 97)
{
    list($width, $height, $from_type) = getimagesize($sourcefile);
    switch ($from_type) {
        case 1:
            $srcImage = imageCreateFromGif($sourcefile);
            break;
        case 2:

            $srcImage = imageCreateFromJpeg($sourcefile);
            break;
        case 3:
            $srcImage = imageCreateFromPng($sourcefile);
            break;
    }
    $x_ratio = $fw / $width;
    $y_ratio = $fh / $height;

    if (($width <= $fw) && ($height <= $fh)) {
        $tn_width = $width;
        $tn_height = $height;
    } else {
        if (($x_ratio * $height) < $fh) {
            $tn_height = ceil($x_ratio * $height);
            $tn_width = $fw;
        } else {
            $tn_width = ceil($y_ratio * $width);
            $tn_height = $fh;
        }
    }

    $tempImage = imagecreatetruecolor($tn_width, $tn_height);
    imagecopyresampled($tempImage, $srcImage, 0, 0, 0, 0, $tn_width, $tn_height, $width, $height);
    imageJpeg($tempImage, $destfile, $jpegquality);
}

function list_carousel($id, $stat, $img)
{
    $status = ($stat == 1) ? (' checked') : ('');
    $i = (!is_null($img)) ? ('<img src="product-img.php?img=' . $img . '&t=2" border="0">') : ('');
    return '
	    <div id="cdiv' . $id . '">
	    <div class="image-box"><image class="img-responsive" href="#" src="' . '../' . IMGSRC . 'carousel/' . $img . '" width="100" height="100"></div>' . '
	    
	    
	    
	    

	    <br />
	    
	    <a class="btn btn-warning delete-carousel" id="' . $id . '" href="#">Delete</a> &nbsp; &nbsp; <input class="carousel-memorabilia" id="' . $id . '" name="stat" type="checkbox" data-on-text="Live" data-off-color="warning" data-on-color="success" ' . $status . '>
	    </p>

	    </div>';
}

function prod_attib_frm($id)
{
    $p = $id == 2 ? ('with price option') : ('');
    return '<div class="form-group">
	    <label for="attributes' . $id . '">Attributes  <small>' . $p . '</small> &nbsp; &nbsp;<small><a href="#" data-toggle="modal" name="attrib-modal" id="' . $id . '" data-target="#attrib">Edit</a></small></label>
	    <select class="form-control" name="attribute' . $id . '"  id="attribute' . $id . '">
	    <option value=""></option>
	    </select>
	    </div>';
}

function cachefile($path, $filename)
{
    $fh = fopen($path, "w+");
    if (fwrite($fh, $filename) === false) {
        echo "Cannot write to file ($filename)";
        exit;
    }
    fclose($fh);
}

function get_product_images($conn, $id)
{
    $qry = "SELECT *  FROM " . IMAGES_TBL . "
	    WHERE prodid=:id";
    $q = $conn->prepare($qry);
    $q->bindParam(':id', $id);
    $q->execute();
    $img = '';
    while ($row = $q->fetch()) {
        $img .= '<div class="col-xs-6 col-md-3"><a rel="productsImages" href="' . SITE_URL . '/' . IMGSRC . $row['img_name'] . '" class="thumbnail swipebox">
	        <img src="../' . THUMB_IMGS . $row['img_name'] . '"></a>
	        <span id="del" data-id="' . $row['id'] . '" data-pid="' . $row['prodid'] . '" data-img_name="' . $row['img_name'] . '" class="glyphicon glyphicon-remove" aria-hidden="true"></span>
	        <a href="#" id="img_upd" data-id="' . $row['prodid'] . '" data-img="' . $row['img_name'] . '">set as main</a><br /></div>';
    }
    return '<div class="row">' . $img . '</div>';
}

function cache_carousel($conn)
{
    $search = array(
        '{ACTIVE}',
        '{PAGINATION_ID}',
        '{PAGINATION_BOTTOM}',
        '{IMAGE}',
        '{IMAGE_ALT}',
        '{HEADLINE_LINK}',
        '{HEADLINE}',
        '{BODY}'
    );

    $sql = "SELECT * FROM " . CAROUSEL_TBL . " WHERE stat=1 and p_img!='' ";
    $q = $conn->query($sql);
    $q->setFetchMode(PDO::FETCH_ASSOC);
    $p_bottom = $p_sides = $data = $body = '';
    $total = $q->rowCount();
    if ($total > 0) {
        for ($c = 0; $c < $total; $c++) {
            $a = ($c == 0) ? (' class="active"') : ('');
            $p_bottom .= '<li data-target="#myCarousel" data-slide-to="' . $c . '" ' . $a . '></li>';
            if ($c == 1) {
                $p_sides = CAROUSEL_SIDE_PAGINATION;
            }
        }
        $carousel = file_get_contents('../' . VIEWS_FOLDER . "carouselInc.php");
        $c = 1;
        while ($row = $q->fetch()) {
            $carousel1 = $carousel;
            $active = ($c == 1) ? (' active') : ('');
            if ($row['p_desc'] != '') {
                $body = '<p>' . $row['p_desc'] . '</p>';
            }
            if ($row['p_btn'] != '') {
                $body .= '<p><a class="btn btn-primary btn-lg" href="' . $row['p_link'] . '" role="button">' . $row['p_btn'] . '</a></p>';
            }

            $products = array(
                $active,
                $row['id'],
                $p_bottom,
                IMGSRC . '/' . $row['p_img'],
                $row['p_title'],
                $row['p_link'],
                $row['p_title'],
                $body
            );

            $data .= str_replace($search, $products, $carousel1);
            $c++;
        }

        $cache = '<div id="myCarousel" class="carousel slide" data-ride="carousel">
	        <ol class="carousel-indicators">' . $p_bottom . '</ol> <div class="carousel-inner">' . $data . $p_sides . '</div></div>';
        cachefile('../' . INC_FOLDER . CACHE_FILE . 'carousel.txt', $cache);
    }
    if ($total == 0) {
        if (file_exists('../' . INC_FOLDER . CACHE_FILE . 'carousel.txt')) {
            unlink('../' . INC_FOLDER . CACHE_FILE . 'carousel.txt');
        }
    }
}

function pagination($page, $count, $rpp, $qrylink, $showpages = false, $m_rw = false, $anchor = '')
{
    $nav = $pagelinks = "";
    if (is_numeric($page)) {
        $sqlstart = ($page - 1) * $rpp;
    } else {
        $sqlstart = 0;
        $page = 1;
    }

    if ($count >= $rpp && $count > 0) {
        $pages = $count / $rpp;
        $pages = ceil($pages);
        $tpages = $pages;
        if ($page == $pages) {
            $to = $pages;
        } elseif ($page == $pages - 1) {
            $to = $page + 1;
        } elseif ($page == $pages - 2) {
            $to = $page + 2;
        } elseif ($page == $pages - 3) {
            $to = $page + 3;
        } else {
            $to = $page + 4;
        }

        if ($page == 1 || $page == 2 || $page == 3 || $page == 4) {
            $from = 1;
        } else {
            $from = $page - 4;
        }
        if ($m_rw) {
            $link_typ = '';
        } else {
            $link_typ = 'page=';
        }
        if ($page != 1 && $page > 5) {
            $pagelinks .= '<li><a href="' . $qrylink . $link_typ . '1' . $anchor . '">1..</a></li>';
        }
        for ($i = $from; $i <= $to; $i++) {
            if ($i != $page) {
                $pagelinks .= '<li><a  href="' . $qrylink . $link_typ . $i . $anchor . '">' . $i . '</a></li>';
            } else {
                $pagelinks .= " <li class=\"active\"><a href=\"#\">$i <span class=\"sr-only\">(current)</span></a></li>";
                $page_pos = $i;
            }
        }
        if ($page != $tpages && $showpages) {
            $pagelinks .= '<li><a href="' . $qrylink . $link_typ . $pages . $anchor . '">..' . $tpages . '</a></li>';
        }
    }

    if ($count > 0) {
        if ($count > $rpp) {
            $nav = "<ul class=\"pagination\"> $pagelinks </ul>";
        }
    }

    return array('qstart' => $sqlstart, 'nav' => $nav); #
}

function get_attribute_fields($conn)
{
    $sql = "SELECT * FROM " . ATTR_FLDS_TBL . " order by id ASC";
    $q = $conn->prepare($sql);

    $q->execute();
    $q->setFetchMode(PDO::FETCH_ASSOC);

    while ($row = $q->fetch()) {
        $hc[] = array(
            'id' => $row['id'],
            'attribute_name' => $row['attribute_name'],
            'status' => $row['status'],
            'fields' => '<div class="form-group">
                        <label for="">' . $row['attribute_name'] . '</label>
                        <input type="text" class="form-control" id="' . $row['attribute_name'] . '" name="' . $row['attribute_name'] . '">
                     </div><input type="submit" value="Submit|' . $row['id'] . '" name="submit" class="btn btn-default">'
        );
    }

    return $hc;
}

function get_left_menu($conn, $param = array())
{
    $param = array(
        '2' => 'Artist',
        '24' => 'Source Language',
        '22' => 'Publisher',
        '9' => 'Editor',
        '18' => 'Place of Publication'
    );
    $uc = '<ul>';

    foreach ($param as $key => $value) {
        $uc .= "<h1>" . $value . "</h1></br>";
        $sql = "SELECT * FROM " . ATTR_VAL . " WHERE attr_id = " . $key;
        $q = $conn->prepare($sql);
        $q->execute();
        $q->setFetchMode(PDO::FETCH_ASSOC);
        while ($row = $q->fetch()) {
            $uc .= '<li><a href="#" class="item-' . $row['attr_value_id'] . '" data-filter="*">' . $row['value'] . '</a></li>';
        }
        $uc .= "</br>";
    }
    $uc .= "</ul>";

    return $uc;
}

function get_attribute_values($conn, $attr_id = int, $key = "", $type = null, $hc = array())
{
    $qry = "SELECT * FROM " . ATTR_VAL . " where attr_id=:attr_id ORDER By attr_value_id";
    $q = $conn->prepare($qry);
    $q->bindParam(':attr_id', $attr_id);
    $q->execute();
    $q->setFetchMode(PDO::FETCH_ASSOC);
    $msl = $txt = $sl = $tarea = '';
    $row_count = $q->rowCount();

    if ($row_count > 0) {
        while ($row = $q->fetch()) {
            switch ($type) {
                case "select-multiple":
                    $msl .= '<option value="' . $row['attr_value_id'] . '">' . stripslashes($row['value']) . '</option>';
                    break;
            }
        }
    }
    switch ($type) {
        case "text":
            $txt = '<label for="' . stripslashes($key) . '">' . stripslashes($key) . '</label><input type="text" class="form-control" id="' . stripslashes($key) . '" name="attributes[' . stripslashes($key) . ']"/>';
            break;
        case "textarea":
            $tarea = '<label for="' . stripslashes($key) . '">' . stripslashes($key) . '</label><textarea class="form-control" rows="2" name="attributes[' . stripslashes($key) . ']"></textarea>';
            break;
    }


    return array(
        's' => ($type == "select-multiple" || $type == "select") ? '<label for="' . $key . '">' . $key . '&nbsp; &nbsp;<small><a href="javascript:void(0);" data-toggle="modal" name="attrib-modal" data-attrname="' . $key . '"id="' . $attr_id . '" data-target="#myModal">Add</a></small></label><select class="select-to-select2" data-name="' . $key . '" id="' . $attr_id . '" name="attributes[' . $key . '][]" multiple="multiple" style="width:300px">' . $msl . '</select>' : '',
        't' => $txt,
        'ta' => $tarea,
    );
}

function get_select_fields($selectID, $key)
{
    $conn = dbconnect();
    $sl = $li = '';
    $qry = "SELECT * FROM " . ATTR_VAL . " where attr_id=:attr_id ORDER By attr_value_id";
    $q = $conn->prepare($qry);
    $q->bindParam(':attr_id', $selectID);
    $q->execute();
    $q->setFetchMode(PDO::FETCH_ASSOC);
    $rowCount = $q->rowCount();
    if ($rowCount > 0) {
        while ($row = $q->fetch()) {
            $sl .= '<option value="' . $row['attr_value_id'] . '">' . stripslashes($row['value']) . '</option>';
        }
    }
    return array(
        'm' => '<select class="select-to-select2" multiple="multiple" id="' . $key . '" name="attributes[' . $key . '][]" style="width:300px">' . $sl . '</select>'
    );
}

function get_select_fields_values($selectID = null)
{
    $qry = "SELECT * FROM " . ATTR_VAL . " where attr_id=:attr_id ORDER By attr_value_id";
    $q = $conn->prepare($qry);
    $q->bindParam(':attr_id', $attr_id);
    $q->execute();
    $q->setFetchMode(PDO::FETCH_ASSOC);
    $row_count = $q->rowCount();
    if ($row_count > 0) {
        while ($row = $q->fetch()) {
            $msl .= '<option value="' . $row['attr_value_id'] . '">' . stripslashes($row['value']) . '</option>';
        }
    }
}

function get_subCategory_options($conn = null, $hc = array())
{
    $conn = dbconnect();
    $qry = "SELECT product_type_name, product_type_id FROM " . PROD_CATEGORY . " WHERE parent=1 ORDER BY sort_order ASC";
    $q = $conn->prepare($qry);
    $q->execute();
    $q->setFetchMode(PDO::FETCH_ASSOC);
    $msl = '';
    while ($row = $q->fetch()) {
        $msl .= '<option value="' . $row['product_type_id'] . '">' . stripslashes($row['product_type_name']) . '</option>';
        $hc[] = array(
            'id' => $row['product_type_id'],
            'name' => $row['product_type_name']
        );
    }


    return array(
        's' => '<select id="subcatagory" name="sub-item[]" multiple="multiple">' . $msl . '</select>',
        'h' => $hc,
        'op' => $msl
    );
}

function get_subCategory_optionsBib($conn = null, $hc = array())
{
    $conn = dbconnect();
    $qry = "SELECT product_type_name, product_type_id FROM " . PROD_CATEGORY . " WHERE parent=1 ORDER BY sort_order ASC";
    // echo $qry;
    // exit();
    $q = $conn->prepare($qry);
    $q->execute();
    $q->setFetchMode(PDO::FETCH_ASSOC);
    $msl = '';
    while ($row = $q->fetch()) {
        $msl .= '<option value="' . stripslashes($row['product_type_name']) . '">' . stripslashes($row['product_type_name']) . '</option>';
        $hc[] = array(
            'id' => $row['product_type_id'],
            'name' => $row['product_type_name']
        );
    }


    return array(
        's' => '<select id="subcatagory" name="sub-item[]" multiple="multiple">' . $msl . '</select>',
        'h' => $hc,
        'op' => $msl
    );
}

function get_parent_category($conn)
{
    $qry = "SELECT product_type_name, product_type_id FROM " . PROD_CATEGORY . " WHERE parent IS NULL";


    $q = $conn->prepare($qry);
    $q->execute();
    $q->setFetchMode(PDO::FETCH_ASSOC);
    $msl = '';
    while ($row = $q->fetch()) {
        $msl .= '<option value="' . $row['product_type_name'] . '">' . stripslashes($row['product_type_name']) . '</option>';
        $hc[] = array(
            'id' => $row['product_type_id'],
            'name' => $row['product_type_name']
        );
    }


    return array(
        's' => '<select id="catagory" name="product-type" >' . $msl . '</select>',
        'h' => $hc
    );
}

function get_attributes_html($conn, $hc = array(), $type = '')
{
    $type = (!empty($_SESSION['attribute'])) ? $_SESSION['attribute'] : $type;
    $qry = "SELECT
                attr_common_flds_ecomc.attribute_name,
                attr_common_flds_ecomc.field_type,
                attr_common_flds_ecomc.id
                FROM
                attr_common_flds_ecomc
                INNER JOIN product_type_attribute_key ON product_type_attribute_key.attribute_id = attr_common_flds_ecomc.id
                INNER JOIN product_type_ecomc ON product_type_attribute_key.p_type_id = product_type_ecomc.product_type_id
                WHERE
                product_type_ecomc.product_type_name = '" . $type . "'";

    $q = $conn->prepare($qry);
    $q->execute();
    $q->setFetchMode(PDO::FETCH_ASSOC);
    $row_cnt = $q->rowCount();
    $outerHtml = '';
    $innerHtml = array();
    if ($row_cnt > 0) {
        while ($row = $q->fetch()) {
            $innerHtml[] = get_attribute_values($conn, $row['id'], $row['attribute_name'], $row['field_type']);
            //$innerHtml[] = $row['attribute_name'];
        }
    }

    return $innerHtml;
}

function get_Inputtype_text_fields()
{
    $result = array();
    try {
        $conn = dbconnect();
        $qry = "SELECT
attr_common_flds_ecomc.attribute_name,
attr_common_flds_ecomc.id                
FROM
product_type_attribute_key
INNER JOIN attr_common_flds_ecomc ON product_type_attribute_key.attribute_id = attr_common_flds_ecomc.id
where attr_common_flds_ecomc.field_type IN ('text', 'textarea', 'file', 'date') ORDER BY attr_common_flds_ecomc.id
";
        $q = $conn->query($qry);
        $q->execute();
        $q->setFetchMode(PDO::FETCH_ASSOC);
        $row = $q->fetchAll();
        foreach ($row as $k => $v) {
            $result[$v['attribute_name']] = $v['id'];
        }
        return $result;
    } catch (PDOException $pe) {
        echo db_error($pe->getMessage());
    }
}

function mainSearch_query($params = '', $subParams = '', $array = array(), $count = false)
{
    if (!empty($params)) {
        $params = "(" . $params . ") AND ";
    }

    $qry_outer = "  SELECT 
                    tbl2.id productId, 
                    tbl2.n product, 
                    tbl2.pc category, 
                    tbl2.an attribute_name, 
                    group_concat(tbl2.v SEPARATOR '$') AS value FROM 
                    ( 
                    SELECT p.prodid AS id, 
                    p.prodname AS n, 
                    pt.product_type_name AS pc, 
                    f.attribute_name AS an, 
                    v.`value` AS v
                    FROM products_ecomc AS p 
                    LEFT JOIN product_attribute_value AS t ON p.prodid = t.product_id 
                    LEFT JOIN attribute_value_ecomc AS v ON t.attribute_value_id = v.attr_value_id 
                    LEFT JOIN attr_common_flds_ecomc AS f ON v.attr_id = f.id 
                    LEFT JOIN product_type_ecomc AS pt ON p.subcatid = pt.product_type_id 
                    WHERE t.product_id IN (";
    $qry_inner = 'SELECT 
                    t.product_id
                    FROM
                    products_ecomc p
                    LEFT JOIN product_attribute_value t ON p.prodid = t.product_id
                    LEFT JOIN attribute_value_ecomc v ON t.attribute_value_id = v.attr_value_id
                    LEFT JOIN attr_common_flds_ecomc f ON v.attr_id = f.id
                    WHERE ' . $params . '
                                (p.subcatid IN (' . $subParams . '))
                        GROUP BY
                          t.product_id order by p.prodname ASC) GROUP BY t.product_attr_val_id) as tbl2 GROUP BY tbl2.id, tbl2.n, tbl2.an ORDER BY product';

    $count_query_outer = "SELECT
                            p.prodid AS id,            
                            p.prodname  AS n,
                            f.attribute_name AS an,
                            COUNT(v.`value`) as cn,
                            v.`value` AS v
                            FROM
                            products_ecomc AS p
                            LEFT JOIN product_attribute_value AS t 
                            ON p.prodid = t.product_id
                            LEFT JOIN attribute_value_ecomc AS v 
                            ON t.attribute_value_id = v.attr_value_id
                            LEFT JOIN attr_common_flds_ecomc AS f 
                            ON v.attr_id = f.id 
                            WHERE t.product_id IN ";
    $count_query_inner = "(
                                SELECT 
                                t.product_id 
                                FROM products_ecomc p 
                                LEFT JOIN product_attribute_value t ON p.prodid = t.product_id 
                                LEFT JOIN attribute_value_ecomc v ON t.attribute_value_id = v.attr_value_id 
                                LEFT JOIN attr_common_flds_ecomc f ON v.attr_id = f.id 
                                WHERE " . $params .
            "(p.subcatid IN (" . $subParams . ")) GROUP BY t.product_id order by p.prodname ASC) GROUP BY t.attribute_value_id";
    if (!$count) {
        $final_qry = $qry_outer . $qry_inner;
        $qry = vsprintf($final_qry, $array);
    } else {
        $final_qry = $count_query_outer . $count_query_inner;
        $qry = vsprintf($final_qry, $array);
    }


    return $qry;
}

function get_html($array, $keys = array(), $usersession, $html = '')
{
    $conn = dbconnect();
    $output = array();

    $referenceType_sorted = get_subCategory_options();
    $sortedReferenceType = [];
    array_walk($referenceType_sorted['h'], function ($v, $k) use (&$sortedReferenceType) {
        $sortedReferenceType[] = $v['name'];
    });
    //Sorting data with reference_type
    uksort($array, function ($a, $b) use ($sortedReferenceType) {
        $sortMe = array_flip($sortedReferenceType);
        if ($sortMe[$a] == $sortMe[$b]) {
            return 0;
        }
        return ($sortMe[$a] < $sortMe[$b]) ? -1 : 1;
    });
    //echo '<pre>';print_r($array);die;
    $iterator = new RecursiveIteratorIterator(new RecursiveArrayIterator($array), RecursiveIteratorIterator::SELF_FIRST);

    foreach ($iterator as $k => $v) {
        //$indent = str_repeat('&nbsp;', 10 * $iterator->getDepth());
        // Not at end: show key only

        if ($iterator->hasChildren()) {
            $j = $count = count($v);

            if ($iterator->getDepth() == 0) {
                $main_key = $k;
            }
            if ($iterator->getDepth() == 1) {
                $productID = $k;
            }
            if ($iterator->getDepth() == 2) {
                $html .= '<div class="line-content">
                            <div class="bibliography-search-inner">
                                <div class="bibliography-info">
                                    <div class="bibliography-content">
                                        <p class="bibliography-fix">' . $main_key . ' </p>
                                        <p>' . $k . '</p>
                                    </div>';
            }

        //echo "$level$indent$k" . ":-" . $iterator->getDepth(). " :<br>";
        // At end: show key, value and path
        } else {
            $j--;
            for ($p = array(), $i = 0, $z = $iterator->getDepth(); $i <= $z; $i++) {
                $p[] = $iterator->getSubIterator($i)->key();
            }

            //$path = implode(',', $p);
            //echo "$indent$k : $v <br>";
            if (array_key_exists($k, $keys)) {
                $html .= '<div class="bibliography-content">
                            <p class="bibliography-fix">' . replace_underscore_space($k, $main_key) . '</p>
                            <p>' . bibliography_replace_dollar($v) . '</p>
                        </div>';
            }


            if ($j == 0) {
                $html .=   '</div>
                            <div class="bibliography-action">
                                <div class="cite-action">
                                    <a href="javascript:void(0);" data-toggle="modal" data-target="#citethis" class="cite-btn"><i data-toggle="tooltip" title="" data-original-title="Cite this" data-placement="left" onclick="javascript:CiteThis(' . $productID . ');">Cite This</i></a></li>
                                </div>';
                if ($usersession==true) {
                    $html .='<div class="details-action">
                                   <a  href="' . SITE_URL . '/details/' . $productID . '" class="details-btn" target="_blank">details</a>
                                </div>';
                } else {
                    $html .='<div class="details-action">
                                    <a data-toggle="modal" data-target="#exampleModallogin" class="details-btn" target="_blank">details</a>
                                </div>';
                }
                $html .='</div>
                        </div>';

                $querypdf = "SELECT * FROM bibliography_pdf where prodid = %s";
                $sqlpdf = sprintf($querypdf, $productID);
                $qpdf = $conn->prepare($sqlpdf);
                $qpdf->execute();
                $qpdf->setFetchMode(PDO::FETCH_ASSOC);
                $pdfarr = $qpdf->fetchAll();


                foreach ($pdfarr as $kpdf => $vpdf) {
                    $pdfname = $vpdf['bib_pdf'];
                    $imgarr = explode(".", $pdfname);
                    $ext = end($imgarr);
                    $imgarrcnt = count($imgarr);
                    $orgnameexcptextnd = '';
                    $imgorgcnt = $imgarrcnt - 1;
                    for ($l = 0; $l < $imgorgcnt; $l++) {
                        if ($l == ($imgorgcnt - 1)) {
                            $orgnameexcptextnd .= $imgarr[$l];
                        } else {
                            $orgnameexcptextnd .= $imgarr[$l] . '.';
                        }
                    }


                    //$html .= '<a class="btn btn-primary" href="' . 'bibpdf?pdf=' . urlencode($orgnameexcptextnd) . '&ext=' . $ext . '">Download PDF</a><br><br>';
                }
                $html .= '</div>';
            }
        }
    }

    if (!$usersession==true) {
        // $html .= '<div class="modal fade vLogin rasa-new-modal" id="exampleModallogin" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        //             <div class="modal-dialog" role="document">
        //                 <div class="modal-content">
        //                     <div class="modal-header">
        //                         <h5 class="modal-title" id="exampleModalLabel">Login To View Details</h5>
        //                         <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        //                           <span aria-hidden="true">&times;</span>
        //                         </button>
        //                     </div>
        //                     <div class="modal-body">
        //                         <form method="POST" action="login.php">
        //                             <div class="row">
        //                                 <div class="col-md-3">
        //                                     <label>Email <strong>*</strong></label>
        //                                 </div>
        //                                 <div class="col-md-9">
        //                                     <input type="text" class="form-control" name="email" id="email" required>
        //                                 </div>
        //                                 <div class="clearfix"></div>
        //                                 <br>
        //                                 <div class="col-md-3">
        //                                     <label>Password <strong>*</strong></label>
        //                                 </div>
        //                                 <div class="col-md-9">
        //                                     <input type="password" class="form-control" name="pass" id="pass" required>
        //                                 </div>
        //                                 <div class="col-md-3"></div>
        //                                 <div class="col-md-9">
        //                                     <input type="submit" class="btn form-control" value="Login">
        //                                 </div>
        //                                 <div class="col-md-3"></div>
        //                                 <div class="col-md-5">
        //                                     <a href="forget-password.php" class="btn form-control border-0 text-left mt-1">Forgot Password</a>
        //                                 </div>
        //                                 <div class="col-md-4 d-flex align-items-center justify-content-start">
        //                                     <a href="login-register.php" >Register</a>
        //                                 </div>
        //                             </div>
        //                         </form>
        //                     </div>
        //                 </div>
        //             </div>
        //         <div>';
        $html .= '<div class="modal fade vLogin rasa-new-modal" id="exampleModallogin" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Login To View Details</h5>
                              
                            </div>
                            <div class="modal-body">
                                <form method="POST" action="login.php">
                                <div class="row">
                                <div class="col-md-3 flex-v-cen pb-4">
                                        <label>Email <strong>*</strong></label>
                                    </div>
                                    <div class="col-md-9 pb-4">
                                        <input type="text" class="form-control" name="email" id="email" required>
                                    </div>
                                    <div class="col-md-3 flex-v-cen pb-4">
                                        <label>Password <strong>*</strong></label>
                                    </div>
                                    <div class="col-md-9 pb-4">
                                        <input type="password" class="form-control" name="pass" id="pass" required>
                                    </div>
                                    <div class="col-md-3"></div>
                                    <div class="col-md-9">
                                        <input type="submit" class="btn form-control login-btn" value="Login">
                                    </div>
                                    <div class="col-md-3"></div>
            <div class="col-md-9">
            <div class="password-inner">
            <div class="password-box">
                <a href="forget-password.php" class="btn forget-btn form-control border-0 text-left mt-1">Forgot Password</a>
            </div>
            <div class="password-box">
            <a class="register-btn" href="login-register.php">Register</a>
            </div>
        </div> 
        </div>
                                </div>
                                </form>
                            </div>
                        </div>
                    </div>
                  </div>';
    }
    //echo $html;die;
    return $html;
}

function listArrayRecursive($someArray)
{
    $iterator = new RecursiveIteratorIterator(new RecursiveArrayIterator($someArray), RecursiveIteratorIterator::SELF_FIRST);
    foreach ($iterator as $k => $v) {
        $indent = str_repeat('&nbsp;', 10 * $iterator->getDepth());
        // Not at end: show key only
        $depth = $iterator->getDepth();
        if ($iterator->hasChildren()) {
            echo "depth: $depth - $indent$k :<br>";
        // At end: show key, value and path
        } else {
            for ($p = array(), $i = 0, $z = $iterator->getDepth(); $i <= $z; $i++) {
                $p[] = $iterator->getSubIterator($i)->key();
            }
            $path = implode(',', $p);
            echo "$indent$k : $v <br>";
        }
    }
}

function getAttributesByProductID($productID = '')
{
    $qry = 'SELECT tbl2.n product, tbl2.an attribute_name, group_concat(tbl2.v SEPARATOR ", ") AS value
                FROM
                (SELECT
                p.prodname AS n,
                f.attribute_name AS an,
                v.`value` AS v
                FROM
                products_ecomc AS p
                LEFT JOIN product_attribute_value AS t ON p.prodid = t.product_id
                LEFT JOIN attribute_value_ecomc AS v ON t.attribute_value_id = v.attr_value_id
                LEFT JOIN attr_common_flds_ecomc AS f ON v.attr_id = f.id
                WHERE p.prodid = :productID) AS tbl2
                GROUP BY tbl2.n, tbl2.an';
    try {
        $conn = dbconnect();
        $q = $conn->prepare($qry);
        $q->bindParam(':productID', $productID, PDO::PARAM_INT);
        $q->execute();
        $q->setFetchMode(PDO::FETCH_ASSOC);
        $result = $q->fetchAll();
        return $result;
    } catch (PDOException $pe) {
        echo db_error($pe->getMessage());
    }
}

function split_name($name)
{
    $parts = explode(' ', $name);
    return array(
        'fn' => array_shift($parts),
        'sn' => array_pop($parts),
        'mi' => join(' ', $parts)
    );
}

function getcategoryName($productID = '')
{
    $qry = 'SELECT
                p.prodid,
                p.prodname,
                t.product_type_name
                FROM
                products_ecomc p
                LEFT JOIN product_type_ecomc t ON  p.subcatid = t.product_type_id
                WHERE p.prodid = :productID';
    try {
        $conn = dbconnect();
        $q = $conn->prepare($qry);
        $q->bindParam(':productID', $productID, PDO::PARAM_INT);
        $q->execute();
        $q->setFetchMode(PDO::FETCH_ASSOC);
        while ($row = $q->fetch()) {
            $result = array(
                'type' => $row['product_type_name']
            );
        }
        return $result;
    } catch (PDOException $pe) {
        echo db_error($pe->getMessage());
    }
}

//Uppercase all words in string
function uppercasewords($string)
{
    $uppercasestring = ucwords($string);
    return $uppercasestring;
}

function cleanvars($variable)
{
    $cleanvariable = stripslashes($variable);
    $cleanvariable = trim($cleanvariable);
    return $cleanvariable;
}

//Uppercase first word in a string
function uppercasefirstword($string)
{
    $lowercasestring = strtolower($string);
    $uppercasestring = ucfirst($lowercasestring);
    return $uppercasestring;
}

function selectAllById($table, $where = array(), $values = array())
{
    $query = 'SELECT * FROM :table';
    $params = array('table' => $table);
    if (!is_null($id)) {
        $query .= ' WHERE id = :id';
        $params['id'] = $id;
    }
    $r = $this->conn->prepare($query)
            ->execute($params)
            ->fetchAll();
    //More stuff here to manipulate $r (results)
    return $r;
}

/*
 * Return Category Specific attribute list
 * Paramter Category_id
 */

function atrributeListBycategory($categoryID)
{
    $list = array();
    $qry = "SELECT `attribute_id` FROM `product_type_attribute_key` WHERE `p_type_id`= :typeID";
    try {
        $conn = dbconnect();
        $stmt = $conn->prepare($qry);
        $stmt->bindParam(':typeID', $categoryID);
        $stmt->execute();
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $result = $stmt->fetchAll();
        for ($i = 0; $i < count($result); $i++) {
            $list[$result[$i]['attribute_id']] = 1;
        }
        return !empty($list) ? $list : false;
    } catch (PDOException $pe) {
        $err = true;
        $er = db_error($pe->getMessage()) . '. Check that relevant fields like Info tab are completed';
    }
}

/**
 * left_filter_data returns data as Array
 *
 * return array of values with keys as attribute name
 * then we build HTML to show
 *
 * @param array
 */
function left_filter_data($someArray = array(), $keys = array(), $test = false)
{
    $referenceType_sorted = get_subCategory_options();
    $sortedReferenceType = [];
    array_walk($referenceType_sorted['h'], function ($v, $k) use (&$sortedReferenceType) {
        $sortedReferenceType[] = $v['name'];
    });
    //Sorting data with reference_type
    uksort($someArray, function ($a, $b) use ($sortedReferenceType) {
        $sortMe = array_flip($sortedReferenceType);
        if ($sortMe[$a] == $sortMe[$b]) {
            return 0;
        }
        return ($sortMe[$a] < $sortMe[$b]) ? -1 : 1;
    });
    $iterator = new RecursiveIteratorIterator(new RecursiveArrayIterator($someArray), RecursiveIteratorIterator::SELF_FIRST);
    //$keys = array('author' => 1, 'editor' => 1);
    $result = array();
    //For debugging purpose
    if ($test) {
        return $someArray;
    }
    //Now starts mining
    foreach ($iterator as $k => $v) {
        $indent = str_repeat('&nbsp;', 10 * $iterator->getDepth());
        // Not at end: show key only

        if ($iterator->hasChildren()) {
            if (!$iterator->getDepth()) {
                //echo "$indent$k :<br>";
                $key = $k;
            }

        // At end: show key, value and path
        } else {
            for ($p = array(), $i = 0, $z = $iterator->getDepth(); $i <= $z; $i++) {
                $p[] = $iterator->getSubIterator($i)->key();
            }
            $path = implode(',', $p);
            //echo "$indent$k : $v  | $productID<br>";
            if (array_key_exists($k, $keys)) {
                $parts = explode("$", $v);
                if (strpos($v, '$') !== false) {
                    for ($j = 0; $j < count($parts); $j++) {
                        $result[$key][$k][] = trim($parts[$j]);
                    }
                } else {
                    $result[$key][$k][] = trim($v);
                }
            }
        }
    }
    if (!empty($result)) {
        $filter = arrayUnique($result);
    }
    return $filter;
}

/**
 *
 */
function left_filter_html($someArray = array(), $keys = array(), $count = array())
{
    $options_from="";
    $options_to="";
    $someArray = array_map('array_filter', $someArray);
    $checked2 = '';
    uksort($someArray, function ($a, $b) use ($keys) {
        if ($keys[$a] > $keys[$b]) {
            return 1;
        } elseif ($keys[$a] < $keys[$b]) {
            return -1;
        } else {
            return 0;
        }
    });
    if (isset($_SESSION['bParam'])) {
        $sessData = $_SESSION['bParam'];
        $sessCount = count($sessData);
    }
    //return $someArray;
    //exit;
    $html = '<form action="search" class="filter-form" id="filter-form" method="post">                
                <div class="artist-inner">
                                <div class="artist-top artist-top-2">
                                    <p class="filters">FILTERS<span class="material-icons">filter_alt</span></p>
                                    <p class="reset"><button id="btnBack" type="submit" class="btn btn-red form-control" name="resetButton" value="Back">Reset</button></p>
                                </div>
                            </div>
                            <div class="menu">
                                <div class="menu-sec">
                                    <div class="accordion" id="accordionExample">';
    //now loop through each filter and value
    foreach ($someArray as $key => $value) {
        $checked = ($key == "reference_type" || $key == 'language') ? "checked" : null;



        if (array_key_exists($key, $keys) && !empty($value)) {
            $accordianHeaderKey= replace_underscore_space($key);
            $html .= "<div class=\"card\">
                                            <div class=\"card-header\" id=\"headingOne\">
                                                <h2 class=\"mb-0\">
                                                    <button class=\"btn btn-link btn-block text-left collapsed\" type=\"button\" data-toggle=\"collapse\" data-target=\"#collapse_{$accordianHeaderKey}\" aria-expanded=\"true\" aria-controls=\"collapse_{$accordianHeaderKey}\">
                                                        {$accordianHeaderKey}
                                                        <span class=\"material-icons\">keyboard_arrow_down</span>
                                                    </button>
                                                </h2>
                                            </div>

                                            <div id=\"collapse_{$accordianHeaderKey}\" class=\"collapse\" aria-labelledby=\"headingOne\" data-parent=\"#accordionExample\">
                                                <div class=\"card-body\">
                                                <div class=\"card-form\" id=\"{$key}-header\"></div>
                                                    <ul class=\"list-unstyled active collapse show\" id=\"{$key}\" style=\"\">";

            if (is_array($value)) {
                if ($value[0] == 'Select All') {
                    $kpos = '0';
                    $cnti = count($value);

                    // Move k-th element to end

                    $cntn = $cnti - 1;
                    if (isset($value[$cntn])) {
                        $tpos = $value[$kpos];
                        $value[$kpos] = $value[$cnti - 1];
                        $value[$cnti - 1] = $tpos;

                        // Sort all elements
                        // except last
                        $tpos = $value[count($value) - 1];
                        $value = array_slice($value, 0, -1);
                        sort($value);
                        array_push($value, $tpos);

                        // Store last element
                        // (originally k-th)
                        $lastpos = $value[$cnti - 1];

                        // Move all elements from
                        // k-th to one position ahead.
                        for ($ipos = $cnti - 1; $ipos > $kpos; $ipos--) {
                            $value[$ipos] = $value[$ipos - 1];
                        }

                        // Restore k-th element
                        $value[$kpos] = $lastpos;
                    } else {
                        $restvalarr = array_slice($value, 1);

                        sort($restvalarr);

                        $arr1 = array("Select All");

                        $value = array_merge($arr1, $restvalarr);
                    }
                } else {
                    sort($value);
                }
                for ($i = 0; $i < count($value); $i++) {
                    if (!empty($value[$i])) {
                        //Print count
                        if (array_key_exists($key, $count)) {
                            for ($j = 0; $j < count($count[$key]); $j++) {
                                if ($value[$i] == $count[$key][$j]['name']) {
                                    $c = $count[$key][$j]['count'];
                                }
                                //echo $count[$key][$val[$j]]['count'] . "<br>";
                            }
                        }



                        if (!empty($sessData)) {
                            $checked2 = (in_array($value[$i], array_column($sessData, $key))) ? 'checked' : '';
                        }
                        if ($value[$i] == 'Select All') {
                            $html .= "<li>
                                                            <div class=\"form-check form-check-inline \">
                                                                <input class=\"form-check-input greencheck {$key}-All\" type=\"checkbox\" id=\"inlineCheckbox2\" value=\"{$value[$i]}\" {$checked}>
                                                                <label class=\"form-check-label\" for=\"{$key}\">" . replace_underscore_space($value[$i]) . "</label></div></li>";
                        } elseif ($key == 'artist') {
                            $html .= "<li class=\"artist subList\">
                                                            <div class=\"form-check form-check-inline\">
                                                                <input class=\"form-check-input greencheck {$key}-All\" type=\"checkbox\" name=\"{$key}[]\" id=\"inlineCheckbox2\" value=\"{$value[$i]}\" {$checked2}>
                                                                <label class=\"form-check-label\" for=\"{$key}\">" . replace_underscore_space($value[$i]) . "</label>". "<span class=\"count\"> (" . $c . ")</span>". paint_artist_mapping($value[$i]). "</div></li>";
                        } else {
                            $html .= "<li class=\"subList\">
                                                            <div class=\"form-check form-check-inline \">
                                                                <input class=\"form-check-input greencheck {$key}\" type=\"checkbox\" name=\"{$key}[]\" id=\"inlineCheckbox2\" value=\"{$value[$i]}\" {$checked} {$checked2}>
                                                                <label class=\"form-check-label\" for=\"inlineCheckbox1\">" . replace_underscore_space($value[$i]) . "</label><span class=\"count\">({$c})</span></div></li>";
                        }
                    }
                }
            }
            $html .= "</ul></div></div></div>";
        }
    }
    //Wrapping menu section 1
    $html .= "</div></div>";


    if (array_key_exists('gregorian_year', $someArray)) {
        //Starting menu section 2
        $html .= "<div class=\"menu-sec menu-sec-2\">
                                    <div class=\"menu-title\">year range</div>
                                    <div class=\"accordion\" id=\"accordionExample\">";

        $match = '-';
        $options = '';

        foreach ($someArray['gregorian_year'] as $val) {
            $years [] = (strpos($val, $match) === false) ? $val : substr($val, 0, strpos($val, "-"));
        }

        asort($years);
        foreach ($years as $year) {
            //$options .= '<option value="' . $year . '">' . $year . '</option>';
            $options_from .= "<label class=\"dropdown-item\" tabindex=\"0\">
                                                            <input class=\"jRadioDropdown\" type=\"radio\" value=\"{$year}\" name=\"year_range[0]\" tabindex=\"-1\">
                                                            <i>{$year}</i>
                                                        </label>";
            $options_to .= "<label class=\"dropdown-item\" tabindex=\"0\">
                                                            <input class=\"jRadioDropdown\" type=\"radio\" value=\"{$year}\" name=\"year_range[1]\" tabindex=\"-1\">
                                                            <i>{$year}</i>
                                                        </label>";
        }

        //building from inputs
        $html .= "<div class=\"dropdown\">
                                                    <button type=\"button\" class=\"btn btn-light dropdown-toggle\" data-toggle=\"dropdown\">
                                                        <p>From<span class=\"material-icons\">keyboard_arrow_down</span></p>
                                                    </button>
                                                    <div class=\"dropdown-menu radio\">
                                                    {$options_from}
                                                    </div>
                                                </div>";

        //Building To inputs
        $html .= "<div class=\"dropdown\">
                                                    <button type=\"button\" class=\"btn btn-light dropdown-toggle\" data-toggle=\"dropdown\">
                                                        <p>To<span class=\"material-icons\">keyboard_arrow_down</span></p>
                                                    </button>
                                                    <div class=\"dropdown-menu radio\">
                                                    {$options_to}
                                                    </div>
                                                </div>";
    }
    //Closing accordian
    $html .= '</div>';
    // submit input
    $html .= '<div class="apply-action"><button id="btnSubmit" type="submit" class="apply-btn" name="submitButton" value="BiblioSearch">apply filters</button></div>
                <input id="objSearch" name="objSearch" type="hidden" value=""></form>';
    //Closing menu section 2, menu
    $html .= "</div></div>";

    return $html;
}


function left_filter_html_second($someArray = array(), $keys = array(), $count = array())
{
    $someArray = array_map('array_filter', $someArray);

    $reference_type = [];
    $artist = [];
    $author = [];
    $editor = [];
    $language = [];
    $place_of_publication = [];
    $publisher = [];
    $gregorian_year = [];

    /* classification */
    if (array_key_exists('reference_type', $someArray)) {
        $reference_type = $someArray['reference_type'];
    }
    //echo '<pre>';print_r($someArray);die;
    $reference_type_html = '';
    if (count($reference_type)>0) {
        foreach ($reference_type as $key=>$value) {
            $reference_type_html .= '<li>
                                            <div class="form-check form-check-inline ">
                                                <input class="form-check-input greencheck" type="checkbox" id="inlineCheckboxRT'.$key.'" value="'.$key.'">
                                                <label class="form-check-label" for="inlineCheckboxRT'.$key.'">'.$value.'</label>
                                            </div>
                                        </li>';
        }
    }
    /* classification */
    /* artist */
    if (array_key_exists('artist', $someArray)) {
        $artist = $someArray['artist'];
    }
    //echo '<pre>';print_r($someArray);die;
    $artist_html = '';
    if (count($artist)>0) {
        foreach ($artist as $key=>$value) {
            $artist_html .= '<li class="subList">
                                    <div class="form-check form-check-inline ">
                                        <input class="form-check-input greencheck" type="checkbox" id="inlineCheckboxART'.$key.'" value="'.$key.'">
                                        <label class="form-check-label" for="inlineCheckboxART'.$key.'">'.$value.'</label>
                                    </div>
                                </li>';
        }
    }
    /* artist */
    /* author */
    if (array_key_exists('author', $someArray)) {
        $author = $someArray['author'];
    }
    //echo '<pre>';print_r($someArray);die;
    $author_html = '';
    if (count($author)>0) {
        foreach ($author as $key=>$value) {
            $author_html .= '<li class="subList">
                                    <div class="form-check form-check-inline ">
                                        <input class="form-check-input greencheck" type="checkbox" id="inlineCheckboxAUTH'.$key.'" value="'.$key.'">
                                        <label class="form-check-label" for="inlineCheckboxAUTH'.$key.'">'.$value.'</label>
                                    </div>
                                </li>';
        }
    }
    /* author */
    /* editor */
    if (array_key_exists('editor', $someArray)) {
        $editor = $someArray['editor'];
    }
    //echo '<pre>';print_r($someArray);die;
    $editor_html = '';
    if (count($editor)>0) {
        foreach ($editor as $key=>$value) {
            $editor_html .= '<li class="subList">
                                    <div class="form-check form-check-inline ">
                                        <input class="form-check-input greencheck" type="checkbox" id="inlineCheckboxEDT'.$key.'" value="'.$key.'">
                                        <label class="form-check-label" for="inlineCheckboxEDT'.$key.'">'.$value.'</label>
                                    </div>
                                </li>';
        }
    }
    /* editor */
    /* language */
    if (array_key_exists('language', $someArray)) {
        $language = $someArray['language'];
    }
    //echo '<pre>';print_r($someArray);die;
    $language_html = '';
    if (count($language)>0) {
        foreach ($language as $key=>$value) {
            $language_html .= '<li class="subList">
                                    <div class="form-check form-check-inline ">
                                        <input class="form-check-input greencheck" type="checkbox" id="inlineCheckboxLANG'.$key.'" value="'.$key.'">
                                        <label class="form-check-label" for="inlineCheckboxLANG'.$key.'">'.$value.'</label>
                                    </div>
                                </li>';
        }
    }
    /* language */
    /* place_of_publication */
    if (array_key_exists('place_of_publication', $someArray)) {
        $place_of_publication = $someArray['place_of_publication'];
    }
    //echo '<pre>';print_r($someArray);die;
    $place_of_publication_html = '';
    if (count($place_of_publication)>0) {
        foreach ($place_of_publication as $key=>$value) {
            $place_of_publication_html .= '<li class="subList">
                                                    <div class="form-check form-check-inline ">
                                                        <input class="form-check-input greencheck" type="checkbox" id="inlineCheckboxPOP'.$key.'" value="'.$key.'">
                                                        <label class="form-check-label" for="inlineCheckboxPOP'.$key.'">'.$value.'</label>
                                                    </div>
                                                </li>';
        }
    }
    /* place_of_publication */
    /* publisher */
    if (array_key_exists('publisher', $someArray)) {
        $publisher = $someArray['publisher'];
    }
    //echo '<pre>';print_r($someArray);die;
    $publisher_html = '';
    if (count($publisher)>0) {
        foreach ($publisher as $key=>$value) {
            $publisher_html .= '<li class="subList">
                                        <div class="form-check form-check-inline ">
                                            <input class="form-check-input greencheck" type="checkbox" id="inlineCheckboxPUB'.$key.'" value="'.$key.'">
                                            <label class="form-check-label" for="inlineCheckboxPUB'.$key.'">'.$value.'</label>
                                        </div>
                                    </li>';
        }
    }
    /* publisher */
    /* gregorian_year */
    if (array_key_exists('gregorian_year', $someArray)) {
        $gregorian_year = $someArray['gregorian_year'];
    }
    //echo '<pre>';print_r($someArray);die;
    $gregorian_year_html    = '';
    $from_year_html         = '<option value="" selected>Select From Year</option>';
    $to_year_html           = '<option value="" selected>Select To Year</option>';
    if (count($gregorian_year)>0) {
        foreach ($gregorian_year as $key=>$value) {
            $gregorian_year_html .= '<li class="subList">
                                            <div class="form-check form-check-inline ">
                                                <input class="form-check-input greencheck" type="checkbox" id="inlineCheckboxGY'.$key.'" value="'.$key.'">
                                                <label class="form-check-label" for="inlineCheckboxGY'.$key.'">'.$value.'</label>
                                            </div>
                                        </li>';
            $from_year_html         .= '<option value="'.$value.'">'.$value.'</option>';
            $to_year_html         .= '<option value="'.$value.'">'.$value.'</option>';
        }
    }
    /* gregorian_year */
    $html = '<div class="menu">
        <div class="menu-sec">
            <div class="accordion" id="accordionExample">
                <div class="card">
                    <div class="card-header" id="headingOne">
                        <h2 class="mb-0">
                            <button class="btn btn-link btn-block text-left collapsed" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                CLASSIFICATION
                                <span class="material-icons">keyboard_arrow_down</span>
                            </button>
                        </h2>
                    </div>

                    <div id="collapseOne" class="collapse" aria-labelledby="headingOne" data-parent="#accordionExample">
                        <div class="card-body">
                            <ul class="list-unstyled active collapse show" style="height:200px; overflow-y:scroll;">'.$reference_type_html.'</ul>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header" id="headingTwo">
                        <h2 class="mb-0">
                            <button class="btn btn-link btn-block text-left collapsed" type="button" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                artist
                                <span class="material-icons">keyboard_arrow_down</span>
                            </button>
                        </h2>
                    </div>
                    <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionExample">
                        <div class="card-body">
                            <div class="card-form">
                                <form>
                                    <div class="form-group">
                                        <input type="email" class="form-control" placeholder="SEARCH IN ARTIST" id="artistSearch">
                                    </div>
                                </form>
                            </div>
                            <ul class="list-unstyled active collapse show" id="artistMainList" style="height:200px; overflow-y:scroll;">'.$artist_html.'</ul>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header" id="headingThree">
                        <h2 class="mb-0">
                            <button class="btn btn-link btn-block text-left collapsed" type="button" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                author
                                <span class="material-icons">keyboard_arrow_down</span>
                            </button>
                        </h2>
                    </div>

                    <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordionExample">
                        <div class="card-body">
                            <div class="card-form">
                                <form>
                                    <div class="form-group">
                                        <input type="email" class="form-control" placeholder="SEARCH IN AUTHOR" id="authorSearch">
                                    </div>
                                </form>
                            </div>
                            <ul class="list-unstyled active collapse show" id="authorMainList" style="height:200px; overflow-y:scroll;">'.$author_html.'</ul>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header" id="headingFour">
                        <h2 class="mb-0">
                            <button class="btn btn-link btn-block text-left collapsed" type="button" data-toggle="collapse" data-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
                                editor
                                <span class="material-icons">keyboard_arrow_down</span>
                            </button>
                        </h2>
                    </div>

                    <div id="collapseFour" class="collapse" aria-labelledby="headingFour" data-parent="#accordionExample">
                        <div class="card-body">
                            <div class="card-form">
                                <form>
                                    <div class="form-group">
                                        <input type="email" class="form-control" placeholder="SEARCH IN EDITOR" id="editorSearch">
                                    </div>
                                </form>
                            </div>
                            <ul class="list-unstyled active collapse show" id="editorMainList" style="height:200px; overflow-y:scroll;">'.$editor_html.'</ul>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header" id="headingFive">
                        <h2 class="mb-0">
                            <button class="btn btn-link btn-block text-left collapsed" type="button" data-toggle="collapse" data-target="#collapseFive" aria-expanded="false" aria-controls="collapseFive">
                                language
                                <span class="material-icons">keyboard_arrow_down</span>
                            </button>
                        </h2>
                    </div>

                    <div id="collapseFive" class="collapse" aria-labelledby="headingFive" data-parent="#accordionExample">
                        <div class="card-body">
                            <div class="card-form">
                                <form>
                                    <div class="form-group">
                                        <input type="email" class="form-control" placeholder="SEARCH IN LANGUAGE" id="languageSearch">
                                    </div>
                                </form>
                            </div>
                            <ul class="list-unstyled active collapse show" id="languageMainList" style="height:200px; overflow-y:scroll;">'.$language_html.'</ul>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header" id="headingSix">
                        <h2 class="mb-0">
                            <button class="btn btn-link btn-block text-left collapsed" type="button" data-toggle="collapse" data-target="#collapseSix" aria-expanded="false" aria-controls="collapseSix">
                                place of publication
                                <span class="material-icons">keyboard_arrow_down</span>
                            </button>
                        </h2>
                    </div>

                    <div id="collapseSix" class="collapse" aria-labelledby="headingSix" data-parent="#accordionExample">
                        <div class="card-body">
                            <div class="card-form">
                                <form>
                                    <div class="form-group">
                                        <input type="email" class="form-control" placeholder="SEARCH IN PLACE OF PUBLICATION" id="popSearch">
                                    </div>
                                </form>
                            </div>
                            <ul class="list-unstyled active collapse show" id="popMainList" style="height:200px; overflow-y:scroll;">'.$place_of_publication_html.'</ul>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header" id="headingSeven">
                        <h2 class="mb-0">
                            <button class="btn btn-link btn-block text-left collapsed" type="button" data-toggle="collapse" data-target="#collapseSeven" aria-expanded="false" aria-controls="collapseSeven">
                                publisher
                                <span class="material-icons">keyboard_arrow_down</span>
                            </button>
                        </h2>
                    </div>

                    <div id="collapseSeven" class="collapse" aria-labelledby="headingSeven" data-parent="#accordionExample">
                        <div class="card-body">
                            <div class="card-form">
                                <form>
                                    <div class="form-group">
                                        <input type="email" class="form-control" placeholder="SEARCH IN PUBLISHER" id="publisherSearch">
                                    </div>
                                </form>
                            </div>
                            <ul class="list-unstyled active collapse show" id="publisherMainList" style="height:200px; overflow-y:scroll;">'.$publisher_html.'</ul>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header" id="headingEight">
                        <h2 class="mb-0">
                            <button class="btn btn-link btn-block text-left collapsed" type="button" data-toggle="collapse" data-target="#collapseEight" aria-expanded="false" aria-controls="collapseEight">
                                year
                                <span class="material-icons">keyboard_arrow_down</span>
                            </button>
                        </h2>
                    </div>

                    <div id="collapseEight" class="collapse" aria-labelledby="headingEight" data-parent="#accordionExample">
                        <div class="card-body">
                            <div class="card-form">
                                <form>
                                    <div class="form-group">
                                        <input type="email" class="form-control" placeholder="SEARCH IN YEAR" id="yearSearch">
                                    </div>
                                </form>
                            </div>
                            <ul class="list-unstyled active collapse show" id="yearMainList" style="height:200px; overflow-y:scroll;">'.$gregorian_year_html.'</ul>
                        </div>
                    </div>
                </div>
            </div>

        </div>
        <div class="menu-sec menu-sec-2">
            <div class="menu-title">year range</div>
            <div class="accordion" id="accordionExample">
                <div class="card">
                    <div class="card-header" id="headingNine">
                        <h2 class="mb-0">
                            <button class="btn btn-link btn-block text-left collapsed" type="button" data-toggle="collapse" data-target="#collapseNine" aria-expanded="false" aria-controls="collapseNine">
                                from
                                <span class="material-icons">keyboard_arrow_down</span>
                            </button>
                        </h2>
                    </div>

                    <div id="collapseNine" class="collapse" aria-labelledby="headingNine" data-parent="#accordionExample">
                        <div class="card-body">
                            <select class="form-control" name="from_year" id="from_year">'.$from_year_html.'</select>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header" id="headingTen">
                        <h2 class="mb-0">
                            <button class="btn btn-link btn-block text-left collapsed" type="button" data-toggle="collapse" data-target="#collapseTen" aria-expanded="false" aria-controls="collapseTen">
                                to
                                <span class="material-icons">keyboard_arrow_down</span>
                            </button>
                        </h2>
                    </div>
                    <div id="collapseTen" class="collapse" aria-labelledby="headingTen" data-parent="#accordionExample">
                        <div class="card-body">
                            <select class="form-control" name="to_year" id="to_year">'.$to_year_html.'</select>
                        </div>
                    </div>
                </div>
            </div>
            <div class="apply-action">
                <button id="btnSubmit" type="submit" class="apply-btn" name="submitButton" value="BiblioSearch">apply filters</button>
            </div>
        </div>
    </div>';
    return $html;
}


function left_filter_html_only_adv($someArray = array(), $keys = array(), $count = array(), $productstr)
{
    $someArray = array_map('array_filter', $someArray);
    $checked2 = '';
    uksort($someArray, function ($a, $b) use ($keys) {
        if ($keys[$a] > $keys[$b]) {
            return 1;
        } elseif ($keys[$a] < $keys[$b]) {
            return -1;
        } else {
            return 0;
        }
    });
    if (isset($_SESSION['bParam'])) {
        $sessData = $_SESSION['bParam'];
        $sessCount = count($sessData);
    }

    $html = '<h4 class="search-filters-title" id="search-filters-title">Refine Search</h4>
<form action="adv-search" class="filter-form" id="filter-form" method="post">  
<input type="hidden" name="allproductsid" value="'.$productstr.'">
<div class="search-filters" style="margin-bottom:20px;">
                    <div class="filter-group">';
    //now loop through each filter and value
    foreach ($someArray as $key => $value) {
        $checked = ($key == "reference_type" || $key == 'language') ? "checked" : null;



        if (array_key_exists($key, $keys) && !empty($value)) {
            $html .= '<h4 class="accordion-header inactive-header">' . replace_underscore_space($key) . '</h4>
                        <section class="accordion-content">
                        <div id="' . $key . '-header"></div>
                            <ul class="list-unstyled" id="' . $key . '">';
            if (is_array($value)) {
                if ($value[0] == 'Select All') {
                    $kpos = '0';
                    $cnti = count($value);

                    // Move k-th element to end

                    $cntn = $cnti - 1;
                    if (isset($value[$cntn])) {
                        $tpos = $value[$kpos];
                        $value[$kpos] = $value[$cnti - 1];
                        $value[$cnti - 1] = $tpos;

                        // Sort all elements
                        // except last
                        $tpos = $value[count($value) - 1];
                        $value = array_slice($value, 0, -1);
                        sort($value);
                        array_push($value, $tpos);

                        // Store last element
                        // (originally k-th)
                        $lastpos = $value[$cnti - 1];

                        // Move all elements from
                        // k-th to one position ahead.
                        for ($ipos = $cnti - 1; $ipos > $kpos; $ipos--) {
                            $value[$ipos] = $value[$ipos - 1];
                        }

                        // Restore k-th element
                        $value[$kpos] = $lastpos;
                    } else {
                        $restvalarr = array_slice($value, 1);

                        sort($restvalarr);

                        $arr1 = array("Select All");

                        $value = array_merge($arr1, $restvalarr);
                    }
                } else {
                    sort($value);
                }
                for ($i = 0; $i < count($value); $i++) {
                    if (!empty($value[$i])) {
                        //Print count
                        if (array_key_exists($key, $count)) {
                            for ($j = 0; $j < count($count[$key]); $j++) {
                                if ($value[$i] == $count[$key][$j]['name']) {
                                    $c = $count[$key][$j]['count'];
                                }
                                //echo $count[$key][$val[$j]]['count'] . "<br>";
                            }
                        }



                        if (!empty($sessData)) {
                            $checked2 = (in_array($value[$i], array_column($sessData, $key))) ? 'checked' : '';
                        }
                        if ($value[$i] == 'Select All') {
                            $html .= '<li>
                                                <input type="checkbox" class="' . $key . '-All" value="' . $value[$i] . '" class="check"' . $checked . '>
                                                <label for="check_book">' . replace_underscore_space($value[$i]) . '</label>
                                                </li>';
                        } elseif ($key == 'artist') {
                            $html .= '<li class="artist">
                                                <input type="checkbox" name="' . $key . '[]" value="' . $value[$i] . '" id="check_book" class="' . $key . '"' . $checked . $checked2 . '>
                                                <label for="check_book">' . replace_underscore_space($value[$i]) . '</label><span class="count"> (' . $c . ')</span>' . paint_artist_mapping($value[$i]) . '</li>';
                        } else {
                            $html .= '<li>
                                                <input type="checkbox" name="' . $key . '[]" value="' . $value[$i] . '" id="check_book" class="' . $key . '"' . $checked . $checked2 . '>
                                                <label for="check_book">' . replace_underscore_space($value[$i]) . '</label><span class="count"> (' . $c . ')</span>
                                                </li>';
                        }
                    }
                }
            }
            $html .= '</ul></section>';
        }
    }



    if (array_key_exists('gregorian_year', $someArray)) {
        $match = '-';
        $options = '';
        $html .= '<h4 class="accordion-header inactive-header">Year Range</h4>
                        <section class="accordion-content">';
        foreach ($someArray['gregorian_year'] as $val) {
            $years [] = (strpos($val, $match) === false) ? $val : substr($val, 0, strpos($val, "-"));
        }

        asort($years);
        foreach ($years as $year) {
            $options .= '<option value="' . $year . '">' . $year . '</option>';
        }

        $html .= '<div class="form-group">
                                <div class="input-group">
                                    <div class="input-group-addon">From</div>
                                    <select class="form-control" id="FromYear" name="year_range[]"><option selected="selected" value="-1">Select year</option>' . $options . '</select>
                                </div>
                            </div>';
        $html .= '<div class="form-group">
                                <div class="input-group">
                                    <div class="input-group-addon">To</div>
                                    <select class="form-control" id="ToYear" name="year_range[]">
                                            <option selected="selected" value="-1">Select year</option>' . $options . '</select>
                                </div>
                            </div>
                        </section>';
    }
    $html .= '</div>
                </div>';
    $html .= '<button id="btnSubmit" type="submit" class="btn btn-red form-control" name="submitButton" value="BiblioSearch">Search</button>
                            <button id="btnBack" type="submit" class="btn btn-red form-control" name="resetButton" value="Back">Reset</button>
<input id="objSearch" name="objSearch" type="hidden" value=""></form>            
        ';

    return $html;
}



function left_filter_html_adv($someArray = array(), $keys = array(), $count = array())
{
    $someArray = array_map('array_filter', $someArray);
    $checked2 = '';
    $c = '0';
    uksort($someArray, function ($a, $b) use ($keys) {
        if ($keys[$a] > $keys[$b]) {
            return 1;
        } elseif ($keys[$a] < $keys[$b]) {
            return -1;
        } else {
            return 0;
        }
    });
    if (isset($_SESSION['bParam'])) {
        $sessData = $_SESSION['bParam'];
        $sessCount = count($sessData);
    }

    $html = '<h4 class="search-filters-title" id="search-filters-title">Refine Search</h4>
<form action="adv-search" class="filter-form" id="filter-form" method="post">                
<div class="search-filters" style="margin-bottom:20px;">
                    <div class="filter-group">';
    //now loop through each filter and value
    foreach ($someArray as $key => $value) {
        $checked = ($key == "reference_type" || $key == 'language') ? "checked" : null;



        if (array_key_exists($key, $keys) && !empty($value)) {
            $html .= '<h4 class="accordion-header inactive-header">' . replace_underscore_space($key) . '</h4>
                        <section class="accordion-content">
                        <div id="' . $key . '-header"></div>
                            <ul class="list-unstyled" id="' . $key . '">';
            if (is_array($value)) {
                if ($value[0] == 'Select All') {
                    $kpos = '0';
                    $cnti = count($value);

                    // Move k-th element to end

                    $cntn = $cnti - 1;
                    if (isset($value[$cntn])) {
                        $tpos = $value[$kpos];
                        $value[$kpos] = $value[$cnti - 1];
                        $value[$cnti - 1] = $tpos;

                        // Sort all elements
                        // except last
                        $tpos = $value[count($value) - 1];
                        $value = array_slice($value, 0, -1);
                        sort($value);
                        array_push($value, $tpos);

                        // Store last element
                        // (originally k-th)
                        $lastpos = $value[$cnti - 1];

                        // Move all elements from
                        // k-th to one position ahead.
                        for ($ipos = $cnti - 1; $ipos > $kpos; $ipos--) {
                            $value[$ipos] = $value[$ipos - 1];
                        }

                        // Restore k-th element
                        $value[$kpos] = $lastpos;
                    } else {
                        $restvalarr = array_slice($value, 1);

                        sort($restvalarr);

                        $arr1 = array("Select All");

                        $value = array_merge($arr1, $restvalarr);
                    }
                } else {
                    sort($value);
                }
                for ($i = 0; $i < count($value); $i++) {
                    if (!empty($value[$i])) {
                        //Print count
                        if (array_key_exists($key, $count)) {
                            for ($j = 0; $j < count($count[$key]); $j++) {
                                if ($value[$i] == $count[$key][$j]['name']) {
                                    $c = $count[$key][$j]['count'];
                                }
                                //echo $count[$key][$val[$j]]['count'] . "<br>";
                            }
                        }



                        if (!empty($sessData)) {
                            $checked2 = (in_array($value[$i], array_column($sessData, $key))) ? 'checked' : '';
                        }
                        if ($value[$i] == 'Select All') {
                            $html .= '<li>
                                                <input type="checkbox" class="' . $key . '-All" value="' . $value[$i] . '" class="check"' . $checked . '>
                                                <label for="check_book">' . replace_underscore_space($value[$i]) . '</label>
                                                </li>';
                        } elseif ($key == 'artist') {
                            $html .= '<li class="artist">
                                                <input type="checkbox" name="' . $key . '[]" value="' . $value[$i] . '" id="check_book" class="' . $key . '"' . $checked . $checked2 . '>
                                                <label for="check_book">' . replace_underscore_space($value[$i]) . '</label><span class="count"> (' . $c . ')</span>' . paint_artist_mapping($value[$i]) . '</li>';
                        } else {
                            $html .= '<li>
                                                <input type="checkbox" name="' . $key . '[]" value="' . $value[$i] . '" id="check_book" class="' . $key . '"' . $checked . $checked2 . '>
                                                <label for="check_book">' . replace_underscore_space($value[$i]) . '</label><span class="count"> (' . $c . ')</span>
                                                </li>';
                        }
                    }
                }
            }
            $html .= '</ul></section>';
        }
    }



    if (array_key_exists('gregorian_year', $someArray)) {
        $match = '-';
        $options = '';
        $html .= '<h4 class="accordion-header inactive-header">Year Range</h4>
                        <section class="accordion-content">';
        foreach ($someArray['gregorian_year'] as $val) {
            $years [] = (strpos($val, $match) === false) ? $val : substr($val, 0, strpos($val, "-"));
        }

        asort($years);
        foreach ($years as $year) {
            $options .= '<option value="' . $year . '">' . $year . '</option>';
        }

        $html .= '<div class="form-group">
                                <div class="input-group">
                                    <div class="input-group-addon">From</div>
                                    <select class="form-control" id="FromYear" name="year_range[]"><option selected="selected" value="-1">Select year</option>' . $options . '</select>
                                </div>
                            </div>';
        $html .= '<div class="form-group">
                                <div class="input-group">
                                    <div class="input-group-addon">To</div>
                                    <select class="form-control" id="ToYear" name="year_range[]">
                                            <option selected="selected" value="-1">Select year</option>' . $options . '</select>
                                </div>
                            </div>
                        </section>';
    }
    $html .= '</div>
                </div>';
    $html .= '<button id="btnSubmit" type="submit" class="btn btn-red form-control" name="submitButton" value="BiblioSearch">Search</button>
                            <button id="btnBack" type="submit" class="btn btn-red form-control" name="resetButton" value="Back">Reset</button>
<input id="objSearch" name="objSearch" type="hidden" value=""></form>            
        ';

    return $html;
}



//function left_filter_html_adv_filtered($someArray = array(), $keys = array(), $count = array(),$noofsearchedproducts) {
//    $someArray = array_map('array_filter', $someArray);
//    $checked2 = '';
//    uksort($someArray, function($a, $b) use ($keys) {
//        if ($keys[$a] > $keys[$b]) {
//            return 1;
//        } elseif ($keys[$a] < $keys[$b]) {
//            return -1;
//        } else {
//            return 0;
//        }
//    });
//    if (isset($_SESSION['bParam'])) {
//        $sessData = $_SESSION['bParam'];
//        $sessCount = count($sessData);
//    }
//
//    $html = '<h4 class="search-filters-title" id="search-filters-title">Refine Search</h4>
//<form action="adv-search" class="filter-form" id="filter-form" method="post">
//<div class="search-filters" style="margin-bottom:20px;">
//                    <div class="filter-group">';
////now loop through each filter and value
//    foreach ($someArray As $key => $value) {
//        $checked = ($key == "reference_type" || $key == 'language') ? "checked" : Null;
//
//
//
//        if (array_key_exists($key, $keys) && !empty($value)) {
//
//
//
//            $html .= '<h4 class="accordion-header inactive-header">' . replace_underscore_space($key) . '</h4>
//                        <section class="accordion-content">
//                        <div id="' . $key . '-header"></div>
//                            <ul class="list-unstyled" id="' . $key . '">';
//            if (is_array($value)) {
//
//
//
//                if ($value[0] == 'Select All') {
//
//                    $kpos = '0';
//                    $cnti = count($value);
//
//                    // Move k-th element to end
//
//                    $cntn = $cnti - 1;
//                    if (isset($value[$cntn])) {
//
//                        $tpos = $value[$kpos];
//                        $value[$kpos] = $value[$cnti - 1];
//                        $value[$cnti - 1] = $tpos;
//
//                        // Sort all elements
//                        // except last
//                        $tpos = $value[count($value) - 1];
//                        $value = array_slice($value, 0, -1);
//                        sort($value);
//                        array_push($value, $tpos);
//
//                        // Store last element
//                        // (originally k-th)
//                        $lastpos = $value[$cnti - 1];
//
//                        // Move all elements from
//                        // k-th to one position ahead.
//                        for ($ipos = $cnti - 1; $ipos > $kpos; $ipos--)
//                            $value[$ipos] = $value[$ipos - 1];
//
//                        // Restore k-th element
//                        $value[$kpos] = $lastpos;
//                    } else {
//
//
//                        $restvalarr = array_slice($value, 1);
//
//                        sort($restvalarr);
//
//                        $arr1 = array("Select All");
//
//                        $value = array_merge($arr1, $restvalarr);
//                    }
//                } else {
//
//                    sort($value);
//                }
//                for ($i = 0; $i < count($value); $i++) {
//
//
//                    if (!empty($value[$i])) {
//
//
//
//
////Print count
//                        if (array_key_exists($key, $count)) {
//                            for ($j = 0; $j < count($count[$key]); $j++) {
//
//                                if ($value[$i] == $count[$key][$j]['name']) {
//                                    $c = $count[$key][$j]['count'];
//                                }
////echo $count[$key][$val[$j]]['count'] . "<br>";
//                            }
//                        }
//
//
//
//                        if (!empty($sessData)) {
//                            $checked2 = (in_array($value[$i], array_column($sessData, $key))) ? 'checked' : '';
//                        }
//                        if ($value[$i] == 'Select All') {
//                            $html .= '<li>
//                                                <input type="checkbox" class="' . $key . '-All" value="' . $value[$i] . '" class="check"' . $checked . '>
//                                                <label for="check_book">' . replace_underscore_space($value[$i]) . '</label>
//                                                </li>';
//                        } elseif ($key == 'artist') {
//                            $html .= '<li class="artist">
//                                                <input type="checkbox" name="' . $key . '[]" value="' . $value[$i] . '" id="check_book" class="' . $key . '"' . $checked . $checked2 . '>
//                                                <label for="check_book">' . replace_underscore_space($value[$i]) . '</label><span class="count"> (' . $noofsearchedproducts . ')</span>' . paint_artist_mapping($value[$i]) . '</li>';
//                        } else {
//                            $html .= '<li>
//                                                <input type="checkbox" name="' . $key . '[]" value="' . $value[$i] . '" id="check_book" class="' . $key . '"' . $checked . $checked2 . '>
//                                                <label for="check_book">' . replace_underscore_space($value[$i]) . '</label><span class="count"> (' . $noofsearchedproducts . ')</span>
//                                                </li>';
//                        }
//                    }
//                }
//            }
//            $html .= '</ul></section>';
//        }
//    }
//
//
//
//    if (array_key_exists('gregorian_year', $someArray)) {
//        $match = '-';
//        $options = '';
//        $html .= '<h4 class="accordion-header inactive-header">Year Range</h4>
//                        <section class="accordion-content">';
//        foreach ($someArray['gregorian_year'] as $val) {
//
//            $years [] = (strpos($val, $match) === false) ? $val : substr($val, 0, strpos($val, "-"));
//        }
//
//        asort($years);
//        foreach ($years as $year) {
//
//            $options .= '<option value="' . $year . '">' . $year . '</option>';
//        }
//
//        $html .= '<div class="form-group">
//                                <div class="input-group">
//                                    <div class="input-group-addon">From</div>
//                                    <select class="form-control" id="FromYear" name="year_range[]"><option selected="selected" value="-1">Select year</option>' . $options . '</select>
//                                </div>
//                            </div>';
//        $html .= '<div class="form-group">
//                                <div class="input-group">
//                                    <div class="input-group-addon">To</div>
//                                    <select class="form-control" id="ToYear" name="year_range[]">
//                                            <option selected="selected" value="-1">Select year</option>' . $options . '</select>
//                                </div>
//                            </div>
//                        </section>';
//    }
//    $html .= '</div>
//                </div>';
//    $html .= '<button id="btnSubmit" type="submit" class="btn btn-red form-control" name="submitButton" value="BiblioSearch">Search</button>
//                            <button id="btnBack" type="submit" class="btn btn-red form-control" name="resetButton" value="Back">Reset</button>
//<input id="objSearch" name="objSearch" type="hidden" value=""></form>
//        ';
//
//    return $html;
//}

/**
 *
 * @param type $someArray as array
 * @param type $preserveKeys as boolean
 * @return type Array
 */
function arrayUnique($someArray = array(), $preserveKeys = false)
{
    $uniqueArray = array();
    $hashes = array();

    foreach ($someArray as $key => $value) {
        if (true === is_array($value)) {
            $uniqueArray[$key] = arrayUnique($value, $preserveKeys);
        } else {
            $hash = md5($value);

            if (false === isset($hashes[$hash])) {
                if ($preserveKeys) {
                    $uniqueArray[$key] = $value;
                } else {
                    $uniqueArray[] = $value;
                }

                $hashes[$hash] = $hash;
            }
        }
    }

    return $uniqueArray;
}

function list_products($row)
{
    $replace = array(
        '{ProdId}',
        '{ProductImg}',
        '{Url}',
        '{ProductName}',
        '{ProductDesc}',
        '{attributeList}'
    );

    $img = (!empty($row['img1'])) ? (SITE_URL . '/' . THUMB_IMGS . $row['img1']) : (SITE_URL . JS_FOLDER . 'holder.js/300x180/auto/text:' . NO_IMAGE);

    $products = array(
        '{ProdId}' => $row['prodid'],
        '{ProductImg}' => $img,
        '{Url}' => SITE_URL . '/pdetails/' . $row['prodid'] . '/' . clean_link($row['prodname']),
        '{ProductName}' => htmlspecialchars(substr($row['prodname'], 0, 100)),
        '{ProductDesc}' => !empty($row['prodesc']) ? htmlspecialchars($row['prodesc']) : '',
        '{attributeList}' => paint_gallery_details($row)
    );

    return array($replace, $products);
}

function paint_gallery_details($row)
{
    $html = '';

    $sql = "SELECT
                    products_ecomc.prodname,
                    product_attribute_value.attribute_value_id,
                    attr_common_flds_ecomc.attribute_name,
                    attribute_value_ecomc.`value`,
                    products_ecomc.prodid
                    FROM
                    products_ecomc
                    INNER JOIN product_attribute_value ON products_ecomc.prodid = product_attribute_value.product_id
                    INNER JOIN attribute_value_ecomc ON product_attribute_value.attribute_value_id = attribute_value_ecomc.attr_value_id
                    INNER JOIN attr_common_flds_ecomc ON attribute_value_ecomc.attr_id = attr_common_flds_ecomc.id
                    WHERE
                    products_ecomc.category_id = 15 AND products_ecomc.prodid = :productID";
    try {
        $conn = dbconnect();
        $q = $conn->prepare($sql);
        $q->bindParam(':productID', $row['prodid']);
        $q->execute();
        $q->setFetchMode(PDO::FETCH_ASSOC);
        while ($currentRow = $q->fetch()) {
            $pid = $currentRow['prodid'];
            if ($row['prodid'] == $pid) {
                $html .= '<li><span class="heading">' . uppercasefirstword(replace_underscore_space($currentRow['attribute_name'])) . '</span>&nbsp;&#8259;&nbsp;<span>' . $currentRow['value'] . '</span></li>';
            }
        }
        return $html;
    } catch (PDOException $pe) {
        echo db_error($pe->getMessage());
    }
}

function replace_underscore_space($str = '', $parent = null)
{
    if (!empty($str)) {
        if (preg_match("/_/", $str)) {
            if (preg_match('/\breference_type\b/', $str)) {
                $str = str_replace("reference_type", "Classification", $str);
            //$str = str_replace("reference_type", "reference_type", $str);
            } elseif (preg_match('/\bgregorian_month\b/', $str)) {
                $str = str_replace("gregorian_month", "Month", $str);
            } elseif (preg_match('/\bgregorian_year\b/', $str)) {
                $str = str_replace("gregorian_year", "Year", $str);
            } elseif (preg_match('/\bgallery_museum\b/', $str)) {
                $str = str_replace("gallery_museum", "Gallery/Museum", $str);
            } elseif (preg_match('/\btranslated1_title_of_parent\b/', $str)) {
                $str = str_replace("translated1_title_of_parent", "Translated Title Of $parent", $str);
            } else {
                $str = ucwords(str_replace("_", " ", $str));
            }
            return $str;
        } elseif (preg_match("/bed/", $str)) {
            $str = ucwords(str_replace("b", "", $str));
            return $str;
        } else {
            return ucwords($str);
        }
    }
}

function replace_space_underscore($str = '')
{
    if (!empty($str)) {
        if (strpos(" ", $str) === false) {
            $str = ucwords(str_replace(" ", "_", $str));
            return $str;
        }
        return $str;
    }
}

function getL2Keys($array)
{
    $result = array();
    foreach ($array as $sub) {
        $result = array_merge($result, $sub);
    }
    return array_keys($result);
}

/*
 * Memorabilia search left filter data
 */

function memorabilia_left_search($array = array(), $keys = array(), $count = array(), $html = '')
{
    $result = array();
    $checked = '';
    $someArray = array_map('array_filter', $array);
    $iterator = new RecursiveIteratorIterator(new RecursiveArrayIterator($someArray), RecursiveIteratorIterator::SELF_FIRST);

    foreach ($iterator as $k => $v) {
        if ($iterator->hasChildren()) {
            if ($iterator->getDepth()) {
                $level1 = $k;
            }
        } else {
            if (array_key_exists($level1, $keys)) {
                $result[$level1][] = $v;
            }
        }
    }
    $final = assoc_Array_unique($result);
    //Sorting Final Data
    $sortingKeys = array('year' => 1, 'film' => 1, 'cast' => 1, 'director' => 1, 'music' => 1, 'playback' => 1, 'producer' => 1, 'story' => 1, 'photography' => 1, 'art' => 1, 'editor' => 1, 'distributor' => 1, 'hall' => 1, 'script' => 1,);
    $iterator = new RecursiveIteratorIterator(new RecursiveArrayIterator($final), RecursiveIteratorIterator::SELF_FIRST);
    foreach ($iterator as $k => $v) {
        if ($iterator->hasChildren()) {
            if ($iterator->getDepth() == 0) {
                $attr = $k;
            }
        } else {
            if (array_key_exists($attr, $sortingKeys)) {
                sort($final[$attr]);
            }
        }
    }


    $html = '<form action="memorabilia" class="filter-form" id="filter-form" method="post">
                        <div class="artist-inner">
                                <div class="artist-top artist-top-2">
                                    <p class="filters">FILTERS<span class="material-icons">filter_alt</span></p>
                                    <p class="reset"><button id="btnBack" type="submit" class="btn btn-red form-control" name="resetButton" value="Back">Reset</button></p>
                                </div>
                            </div>
                            <div class="menu">
                                <div class="menu-sec">
                                    <div class="accordion" id="accordionExample">';
    //now loop through each filter and value
    /**
     * Creating left panel order
     */
    $properOrderedArray = array_replace(array_flip(array('year', 'film', 'cast', 'director', 'music', 'playback')), $final);

    if (isset($_SESSION['fParam']) && isset($_SESSION['append'])) {
        $sessData = array_merge($_SESSION['fParam'], $_SESSION['append']);
        $sessCount = count($sessData);
    } else {
        $sessData = $_SESSION['fParam'];
        $sessCount = count($sessData);
    }

        //    print "<pre>";
        //    print_r($properOrderedArray);
    //echo "<pre>";print_r($properOrderedArray);die;
    foreach ($properOrderedArray as $key => $value) {
        $accordianHeaderKey= uppercasefirstword($key);

        //new html
        $html .= "<div class=\"card\">
                                            <div class=\"card-header\" id=\"headingOne\">
                                                <h2 class=\"mb-0\">
                                                    <button class=\"btn btn-link btn-block text-left collapsed\" type=\"button\" data-toggle=\"collapse\" data-target=\"#collapse_{$accordianHeaderKey}\" aria-expanded=\"true\" aria-controls=\"collapse_{$accordianHeaderKey}\">
                                                        {$accordianHeaderKey}
                                                        <span class=\"material-icons\">keyboard_arrow_down</span>
                                                    </button>
                                                </h2>
                                            </div>

                                            <div id=\"collapse_{$accordianHeaderKey}\" class=\"collapse\" aria-labelledby=\"headingOne\" data-parent=\"#accordionExample\">
                                                <div class=\"card-body\">
                                                <div class=\"card-form\" id=\"{$key}-header\"></div>
                                                    <ul class=\"list-unstyled active collapse show\" id=\"{$key}\" style=\"\">";
        if (is_array($value)) {
            /**
             * Checked values which are already stored in Session
             */
            for ($i = 0; $i < count($value); $i++) {
                if (!empty($value[$i])) {
                    if (!empty($sessData)) {
                        $checked = (in_array($value[$i], array_column($sessData, $key))) ? 'checked' : '';
                    }

                    if (array_key_exists($key, $count)) {
                        for ($j = 0; $j < count($count[$key]); $j++) {
                            if ($value[$i] == $count[$key][$j]['name']) {
                                $c = $count[$key][$j]['count'];
                            }
                            //echo $count[$key][$val[$j]]['count'] . "<br>";
                        }
                    }

                    //New Li
                    $html .= "<li class=\"li_{$i} subList\">
                                                            <div class=\"form-check form-check-inline \">
                                                                <input class=\"form-check-input greencheck {$key}\" type=\"checkbox\" id=\"inlineCheckbox2\" name=\"{$key}[]\" value=\"{$value[$i]}\" {$checked}>
                                                                <label class=\"form-check-label\" for=\"inlineCheckbox1\">{$value[$i]}</label><span class=\"count\">({$c})</span>
                                                            </div>
                                                        </li>";
                }
            }   //Value for loop closed
        }
        $html .= "</ul></div></div></div>";
        //$html .= '</ul></section>';
        //        } No need of array key exists
    }


    //Wrapping menu section 1
    $html .= "</div></div>";


    //For Year Range select dropdown
    if (array_key_exists('year', $properOrderedArray)) {
        $match = '-';
        $options_from = '';
        $options_to= '';
        $html .= "<div class=\"menu-sec menu-sec-2\">
                                    <div class=\"menu-title\">Year Range</div>
                                    <div class=\"accordion\" id=\"accordionExample\">";

        if (!empty($properOrderedArray['year'])) {
            foreach ($properOrderedArray['year'] as $val) {
                $years [] = (strpos($val, $match) === false) ? $val : substr($val, 0, strpos($val, "-"));
            }

            asort($years);
            foreach ($years as $year) {
                //$options .= '<option value="' . $year . '">' . $year . '</option>';

                $options_from .= "<label class=\"dropdown-item\" tabindex=\"0\">
                                                            <input class=\"jRadioDropdown\" type=\"radio\" value=\"{$year}\" name=\"year_range[0]\" tabindex=\"-1\">
                                                            <i>{$year}</i>
                                                        </label>";
                $options_to .= "<label class=\"dropdown-item\" tabindex=\"0\">
                                                            <input class=\"jRadioDropdown\" type=\"radio\" value=\"{$year}\" name=\"year_range[1]\" tabindex=\"-1\">
                                                            <i>{$year}</i>
                                                        </label>";
            }

            //New Html

            //building from inputs
            $html .= "<div class=\"dropdown\">
                                                    <button type=\"button\" class=\"btn btn-light dropdown-toggle\" data-toggle=\"dropdown\">
                                                        <p>From<span class=\"material-icons\">keyboard_arrow_down</span></p>
                                                    </button>
                                                    <div class=\"dropdown-menu radio\">
                                                    {$options_from}
                                                    </div>
                                                </div>";

            //Building To inputs
            $html .= "<div class=\"dropdown\">
                                                    <button type=\"button\" class=\"btn btn-light dropdown-toggle\" data-toggle=\"dropdown\">
                                                        <p>To<span class=\"material-icons\">keyboard_arrow_down</span></p>
                                                    </button>
                                                    <div class=\"dropdown-menu radio\">
                                                    {$options_to}
                                                    </div>
                                                </div>";
        }
    }

    //Closing accordian
    $html .= '</div>';
    // submit input
    $html .= '<div class="apply-action"><button id="btnSubmit" type="submit" class="apply-btn" name="submitButton" value="BiblioSearch">apply filters</button></div>
                <input id="objSearch" name="objSearch" type="hidden" value=""></form>';
    //Closing menu section 2, menu
    $html .= "</div></div>";



    return $html;
}

/* Memorabilia search left filter data in new design */
function memorabilia_left_search_new_design($array = array(), $keys = array(), $count = array(), $html = '')
{
    $result = array();
    $checked = '';
    $someArray = array_map('array_filter', $array);
    $iterator = new RecursiveIteratorIterator(new RecursiveArrayIterator($someArray), RecursiveIteratorIterator::SELF_FIRST);
    foreach ($iterator as $k => $v) {
        if ($iterator->hasChildren()) {
            if ($iterator->getDepth()) {
                $level1 = $k;
            }
        } else {
            if (array_key_exists($level1, $keys)) {
                $result[$level1][] = $v;
            }
        }
    }
    $final = assoc_Array_unique($result);
    //Sorting Final Data
    $sortingKeys = array('year' => 1, 'film' => 1, 'cast' => 1, 'director' => 1, 'music' => 1, 'playback' => 1, 'producer' => 1, 'story' => 1, 'photography' => 1, 'art' => 1, 'editor' => 1, 'distributor' => 1, 'hall' => 1, 'script' => 1,);
    $iterator = new RecursiveIteratorIterator(new RecursiveArrayIterator($final), RecursiveIteratorIterator::SELF_FIRST);
    foreach ($iterator as $k => $v) {
        if ($iterator->hasChildren()) {
            if ($iterator->getDepth() == 0) {
                $attr = $k;
            }
        } else {
            if (array_key_exists($attr, $sortingKeys)) {
                sort($final[$attr]);
            }
        }
    }
    $properOrderedArray = array_replace(array_flip(array('year', 'film', 'cast', 'director', 'music', 'playback')), $final);
    //echo '<pre>';print_r($properOrderedArray);die;
    $someArray = $properOrderedArray;
    $year           = [];
    $film           = [];
    $cast           = [];
    $director       = [];
    $music          = [];
    $playback       = [];

    $year_html      = '';
    $film_html      = '';
    $cast_html      = '';
    $director_html  = '';
    $music_html     = '';
    $playback_html  = '';
    /* year */
    if (array_key_exists('year', $someArray)) {
        $year = $someArray['year'];
    }
    if (count($year)>0) {
        foreach ($year as $key=>$value) {
            $year_html .= '<li class="subList">
                                        <div class="form-check form-check-inline ">
                                            <input class="form-check-input greencheck" type="checkbox" id="inlineCheckboxYEAR'.$key.'" value="'.$key.'">
                                            <label class="form-check-label" for="inlineCheckboxYEAR'.$key.'">'.$value.'</label>
                                        </div>
                                    </li>';
        }
    }
    /* year */
    /* film */
    if (array_key_exists('film', $someArray)) {
        $film = $someArray['film'];
    }
    if (count($film)>0) {
        foreach ($film as $key=>$value) {
            $film_html .= '<li class="subList">
                                        <div class="form-check form-check-inline ">
                                            <input class="form-check-input greencheck" type="checkbox" id="inlineCheckboxFILM'.$key.'" value="'.$key.'">
                                            <label class="form-check-label" for="inlineCheckboxFILM'.$key.'">'.$value.'</label>
                                        </div>
                                    </li>';
        }
    }
    /* film */
    /* cast */
    if (array_key_exists('cast', $someArray)) {
        $cast = $someArray['cast'];
    }
    if (count($cast)>0) {
        foreach ($cast as $key=>$value) {
            $cast_html .= '<li class="subList">
                                        <div class="form-check form-check-inline ">
                                            <input class="form-check-input greencheck" type="checkbox" id="inlineCheckboxCAST'.$key.'" value="'.$key.'">
                                            <label class="form-check-label" for="inlineCheckboxCAST'.$key.'">'.$value.'</label>
                                        </div>
                                    </li>';
        }
    }
    /* cast */
    /* director */
    if (array_key_exists('director', $someArray)) {
        $director = $someArray['director'];
    }
    if (count($director)>0) {
        foreach ($director as $key=>$value) {
            $director_html .= '<li class="subList">
                                        <div class="form-check form-check-inline ">
                                            <input class="form-check-input greencheck" type="checkbox" id="inlineCheckboxDIRECTOR'.$key.'" value="'.$key.'">
                                            <label class="form-check-label" for="inlineCheckboxDIRECTOR'.$key.'">'.$value.'</label>
                                        </div>
                                    </li>';
        }
    }
    /* director */
    /* music */
    if (array_key_exists('music', $someArray)) {
        $music = $someArray['music'];
    }
    if (count($music)>0) {
        foreach ($music as $key=>$value) {
            $music_html .= '<li class="subList">
                                        <div class="form-check form-check-inline ">
                                            <input class="form-check-input greencheck" type="checkbox" id="inlineCheckboxMUSIC'.$key.'" value="'.$key.'">
                                            <label class="form-check-label" for="inlineCheckboxMUSIC'.$key.'">'.$value.'</label>
                                        </div>
                                    </li>';
        }
    }
    /* music */
    /* playback */
    if (array_key_exists('playback', $someArray)) {
        $playback = $someArray['playback'];
    }
    if (count($playback)>0) {
        foreach ($playback as $key=>$value) {
            $playback_html .= '<li class="subList">
                                        <div class="form-check form-check-inline ">
                                            <input class="form-check-input greencheck" type="checkbox" id="inlineCheckboxPLAYBACK'.$key.'" value="'.$key.'">
                                            <label class="form-check-label" for="inlineCheckboxPLAYBACK'.$key.'">'.$value.'</label>
                                        </div>
                                    </li>';
        }
    }
    /* playback */
    $html = '<div class="menu">
                    <div class="menu-sec">
                        <div class="accordion" id="accordionExample">
                            <div class="card">
                                <div class="card-header" id="headingOne">
                                    <h2 class="mb-0">
                                        <button class="btn btn-link btn-block text-left collapsed" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                            YEAR
                                            <span class="material-icons">keyboard_arrow_down</span>
                                        </button>
                                    </h2>
                                </div>

                                <div id="collapseOne" class="collapse" aria-labelledby="headingOne" data-parent="#accordionExample">
                                    <div class="card-body">
                                        <div class="card-form">
                                            <form>
                                                <div class="form-group">
                                                    <input type="email" class="form-control" placeholder="SEARCH IN YEAR" id="yearSearch">
                                                </div>
                                            </form>
                                        </div>
                                        <ul class="list-unstyled active collapse show" id="yearMainList" style="height:200px; overflow-y:scroll;">'.$year_html.'</ul>
                                    </div>
                                </div>
                            </div>
                            <div class="card">
                                <div class="card-header" id="headingTwo">
                                    <h2 class="mb-0">
                                        <button class="btn btn-link btn-block text-left collapsed" type="button" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                            FILM
                                            <span class="material-icons">keyboard_arrow_down</span>
                                        </button>
                                    </h2>
                                </div>
                                <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionExample">
                                    <div class="card-body">
                                        <div class="card-form">
                                            <form>
                                                <div class="form-group">
                                                    <input type="email" class="form-control" placeholder="SEARCH IN FILM" id="filmSearch">
                                                </div>
                                            </form>
                                        </div>
                                        <ul class="list-unstyled active collapse show" id="filmMainList" style="height:200px; overflow-y:scroll;">'.$film_html.'</ul>
                                    </div>
                                </div>
                            </div>
                            <div class="card">
                                <div class="card-header" id="headingThree">
                                    <h2 class="mb-0">
                                        <button class="btn btn-link btn-block text-left collapsed" type="button" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                            CAST
                                            <span class="material-icons">keyboard_arrow_down</span>
                                        </button>
                                    </h2>
                                </div>

                                <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordionExample">
                                    <div class="card-body">
                                        <div class="card-form">
                                            <form>
                                                <div class="form-group">
                                                    <input type="email" class="form-control" placeholder="SEARCH IN CAST" id="castSearch">
                                                </div>
                                            </form>
                                        </div>
                                        <ul class="list-unstyled active collapse show" id="castMainList" style="height:200px; overflow-y:scroll;">'.$cast_html.'</ul>
                                    </div>
                                </div>
                            </div>
                            <div class="card">
                                <div class="card-header" id="headingFour">
                                    <h2 class="mb-0">
                                        <button class="btn btn-link btn-block text-left collapsed" type="button" data-toggle="collapse" data-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
                                            DIRECTOR
                                            <span class="material-icons">keyboard_arrow_down</span>
                                        </button>
                                    </h2>
                                </div>

                                <div id="collapseFour" class="collapse" aria-labelledby="headingFour" data-parent="#accordionExample">
                                    <div class="card-body">
                                        <div class="card-form">
                                            <form>
                                                <div class="form-group">
                                                    <input type="email" class="form-control" placeholder="SEARCH IN DIRECTOR" id="directorSearch">
                                                </div>
                                            </form>
                                        </div>
                                        <ul class="list-unstyled active collapse show" id="directorMainList" style="height:200px; overflow-y:scroll;">'.$director_html.'</ul>
                                    </div>
                                </div>
                            </div>
                            <div class="card">
                                <div class="card-header" id="headingFive">
                                    <h2 class="mb-0">
                                        <button class="btn btn-link btn-block text-left collapsed" type="button" data-toggle="collapse" data-target="#collapseFive" aria-expanded="false" aria-controls="collapseFive">
                                            MUSIC
                                            <span class="material-icons">keyboard_arrow_down</span>
                                        </button>
                                    </h2>
                                </div>

                                <div id="collapseFive" class="collapse" aria-labelledby="headingFive" data-parent="#accordionExample">
                                    <div class="card-body">
                                        <div class="card-form">
                                            <form>
                                                <div class="form-group">
                                                    <input type="email" class="form-control" placeholder="SEARCH IN MUSIC" id="musicSearch">
                                                </div>
                                            </form>
                                        </div>
                                        <ul class="list-unstyled active collapse show" id="musicMainList" style="height:200px; overflow-y:scroll;">'.$music_html.'</ul>
                                    </div>
                                </div>
                            </div>
                            <div class="card">
                                <div class="card-header" id="headingSix">
                                    <h2 class="mb-0">
                                        <button class="btn btn-link btn-block text-left collapsed" type="button" data-toggle="collapse" data-target="#collapseSix" aria-expanded="false" aria-controls="collapseSix">
                                            PLAYBACK
                                            <span class="material-icons">keyboard_arrow_down</span>
                                        </button>
                                    </h2>
                                </div>

                                <div id="collapseSix" class="collapse" aria-labelledby="headingSix" data-parent="#accordionExample">
                                    <div class="card-body">
                                        <div class="card-form">
                                            <form>
                                                <div class="form-group">
                                                    <input type="email" class="form-control" placeholder="SEARCH IN PLAYBACK" id="playbackSearch">
                                                </div>
                                            </form>
                                        </div>
                                        <ul class="list-unstyled active collapse show" id="playbackMainList" style="height:200px; overflow-y:scroll;">'.$playback_html.'</ul>
                                    </div>
                                </div>
                            </div>
                            <div class="card">
                                <div class="card-header" id="headingSeven">
                                    <h2 class="mb-0">
                                        <button class="btn btn-link btn-block text-left collapsed" type="button" data-toggle="collapse" data-target="#collapseSeven" aria-expanded="false" aria-controls="collapseSeven">
                                            YEAR RANGE
                                            <span class="material-icons">keyboard_arrow_down</span>
                                        </button>
                                    </h2>
                                </div>

                                <div id="collapseSeven" class="collapse" aria-labelledby="headingSeven" data-parent="#accordionExample">
                                    <div class="card-body">
                                        <div class="card-form">
                                            <form>
                                                <div class="form-group">
                                                    <input type="email" class="form-control" placeholder="SEARCH IN YEAR RANGE" id="yearRangeSearch">
                                                </div>
                                            </form>
                                        </div>
                                        <ul class="list-unstyled active collapse show" id="yearRangeMainList" style="height:200px; overflow-y:scroll;">'.$year_html.'</ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="apply-action">
                            <a href="#" class="apply-btn">apply filters</a>
                        </div>
                    </div>
                </div>';
    return $html;
}
/* Memorabilia search left filter data in new design */

/**
 * Associative array Unique recursive
 * Return array
 */
function assoc_Array_unique($array)
{
//    $count = array_sum(array_map('count', $array));
//    if($count){
//        return $array;
//        exit;
//    }
    $result = array_map("unserialize", array_unique(array_map("serialize", $array)));

    foreach ($result as $key => $value) {
        if (is_array($value)) {
            $result[$key] = assoc_Array_unique($value);
        }
    }
    return $result;
}

function get_subcategoryList_by_name($categoryName = 'Book')
{
    try {
        $conn = dbconnect();
        $q = $conn->prepare("SELECT `product_type_name`, `product_type_id` FROM product_type_ecomc WHERE `parent` =(SELECT `parent` FROM `product_type_ecomc` WHERE `product_type_name`=:pname)");
        $q->bindParam(':pname', $categoryName);
        $q->execute();
        $q->setFetchMode(PDO::FETCH_ASSOC);
        while ($row = $q->fetch()) {
            $subcatList["$row[product_type_name]"] = $row['product_type_id'];
        }

        return $q->rowCount() == 0 ? null : $subcatList;
    } catch (PDOException $pe) {
        echo db_error($pe->getMessage());
    }
}

/**
 *
 * @param type string $category
 */
function get_attrKeys_by_category($category = 'Bibliography')
{
    $keyData = array();
    try {
        $conn = dbconnect();
        $qry = "SELECT
                attr_common_flds_ecomc.attribute_name,
                attr_common_flds_ecomc.field_type,
                attr_common_flds_ecomc.id
                FROM
                attr_common_flds_ecomc
                INNER JOIN product_type_attribute_key ON product_type_attribute_key.attribute_id = attr_common_flds_ecomc.id
                INNER JOIN product_type_ecomc ON product_type_attribute_key.p_type_id = product_type_ecomc.product_type_id
                WHERE
                product_type_ecomc.product_type_name =:category";
        $q = $conn->prepare($qry);
        $q->bindParam(':category', $category);
        $q->execute();
        $q->setFetchMode(PDO::FETCH_ASSOC);
        while ($row = $q->fetch()) {
            $keyData[] = strtolower(replace_underscore_space($row['attribute_name']));
        }
        return $q->rowCount() == 0 ? null : $keyData;
    } catch (PDOException $pe) {
        echo db_error($pe->getMessage());
    }
}

function getFullname($array = array())
{
    if (!empty($array)) {
        foreach ($array as $key => $val) {
            if ($key == 'name') {
                $fullName = $val . ' ';
            } elseif ($key == 'middle') {
                $fullName .= $val . ' ';
            } else {
                $fullName .= $val;
            }
        }
    }
    return $fullName;
}

function preg_array_key_exists($pattern, $array)
{
    // extract the keys.
    $keys = array_keys($array);

    // convert the preg_grep() returned array to int..and return.
    // the ret value of preg_grep() will be an array of values
    // that match the pattern.
    return (int) preg_grep($pattern, $keys);
}

function preg_custom($pattern, $str)
{
    if (preg_match($pattern, $str, $match)) {
        return true;
    }
    return false;
}

function fullName($someArray = array())
{
    $result = join(" ", array_reverse($someArray));
    return trim($result);
}

function r_implode($array, $delim = "$")
{
    $data = array();
    foreach ($array as $key => $val) {
        $dbK = strtolower(replace_space_underscore($key));
        if (is_array($val)) {
            if (count($val) > 1) {
                foreach ($val as $k => $v) {
                    $data[$dbK] = implode($delim, array_filter($val, 'rempty'));
                }
            } else {
                foreach ($val as $k => $v) {
                    $data[$dbK] = $v;
                }
            }
        }
    }

    return $data;
}

function rempty($var)
{
    return !($var == "" || $var == null || $var == " ");
}

function get_all_inputtype_fields()
{
    $result = array();
    try {
        $conn = dbconnect();
        $qry = "SELECT
attr_common_flds_ecomc.attribute_name,
attr_common_flds_ecomc.id                
FROM
product_type_attribute_key
INNER JOIN attr_common_flds_ecomc ON product_type_attribute_key.attribute_id = attr_common_flds_ecomc.id
where attr_common_flds_ecomc.field_type IN ('text', 'textarea', 'file', 'date', 'select-multiple') ORDER BY attr_common_flds_ecomc.id
";
        $q = $conn->query($qry);
        $q->execute();
        $q->setFetchMode(PDO::FETCH_ASSOC);
        $row = $q->fetchAll();
        foreach ($row as $k => $v) {
            $result[$v['attribute_name']] = $v['id'];
        }
        return $result;
    } catch (PDOException $pe) {
        echo db_error($pe->getMessage());
    }
}

function Excel_data_insert($Somearray = array(), $field_type)
{
    $productEntry = array();
    foreach ($Somearray as $k => $v) {
        if (!empty($v)) {
            if (strpos($v, "$") !== false) {
                $data = explode("$", $v);
                if (!empty($data)) {
                    for ($i = 0; $i < count($data); $i++) {
                        try {
                            $conn = dbconnect();
                            $qry = "INSERT INTO attribute_value_ecomc (`attr_id`, `value`)
                            SELECT * FROM (SELECT '" . $k . "','" . $data[$i] . "') AS tmp
                            WHERE NOT EXISTS (
                                SELECT `value` FROM `attribute_value_ecomc` WHERE value='" . $data[$i] . "' AND attr_id='" . $k . "')";

                            $q = $conn->query($qry);
                            $q->execute();
                            $last_id = $conn->lastInsertId();
                            if ($last_id) {
                                $productEntry[] = $last_id;
                            } else {
                                $qry = "SELECT `attr_value_id` FROM `attribute_value_ecomc` WHERE value='" . $data[$i] . "' AND attr_id='" . $k . "'";
                                $s = $conn->query($qry);
                                $s->execute();
                                $s->setFetchMode(PDO::FETCH_ASSOC);
                                while ($row = $s->fetch()) {
                                    $productEntry[] = $row['attr_value_id'];
                                }
                            }
                            //$pp[] = $qry;
                        } catch (Exception $pe) {
                            echo db_error($pe->getMessage());
                        }
                    }
                    //return $pp;
                    //return $productEntry;
                }
            } else {
                if ($field_type[$k] == 'select-multiple') {
                    try {
                        $conn = dbconnect();
                        $qry = "INSERT INTO attribute_value_ecomc (`attr_id`, `value`)
                                SELECT * FROM (SELECT '" . $k . "','" . $v . "') AS tmp
                                WHERE NOT EXISTS (
                                SELECT `value` FROM `attribute_value_ecomc` WHERE value='" . $v . "' AND attr_id='" . $k . "')";

                        $q = $conn->query($qry);
                        $q->execute();
                        $last_id = $conn->lastInsertId();
                        if ($last_id) {
                            $productEntry[] = $last_id;
                        } else {
                            $qry = "SELECT `attr_value_id` FROM `attribute_value_ecomc` WHERE value='" . $v . "' AND attr_id='" . $k . "'";
                            $s = $conn->query($qry);
                            $s->execute();
                            $s->setFetchMode(PDO::FETCH_ASSOC);
                            while ($row = $s->fetch()) {
                                $productEntry[] = $row['attr_value_id'];
                            }
                        }
                        //$pp[] = $qry;
                    } catch (Exception $pe) {
                        echo db_error($pe->getMessage());
                    }
                } // if block field type check
                else {
                    $conn = dbconnect();
                    try {
                        $qry_filter = "INSERT INTO attribute_value_ecomc (`attr_id`, `value`)
                                SELECT * FROM (SELECT '" . $k . "','" . $v . "') AS tmp
                                WHERE NOT EXISTS (
                                SELECT `value` FROM `attribute_value_ecomc` WHERE value='" . $v . "' AND attr_id='" . $k . "')";
                        $q = $conn->query($qry_filter);
                        $q->execute();
                        $last_id = $conn->lastInsertId();
                        if ($last_id) {
                            $productEntry[] = $last_id;
                        } else {
                            $qry = "SELECT `attr_value_id` FROM `attribute_value_ecomc` WHERE value='" . $v . "' AND attr_id='" . $k . "'";
                            $r = $conn->prepare($qry);
                            $r->execute();
                            $s->setFetchMode(PDO::FETCH_ASSOC);
                            while ($row = $s->fetch()) {
                                $productEntry[] = $row['attr_value_id'];
                            }
                        }
                        //$pp[] = $qry;
                    } catch (Exception $pe) {
                        echo db_error($pe->getMessage());
                    }
                }
            }
        } // Closing of value not empty check
    } //Closing of foreach

    return $productEntry;
    //return $pp;
}

function get_input_type_fields()
{
    $result = array();
    try {
        $conn = dbconnect();
        $qry = "SELECT
attr_common_flds_ecomc.field_type,
attr_common_flds_ecomc.id                
FROM
product_type_attribute_key
INNER JOIN attr_common_flds_ecomc ON product_type_attribute_key.attribute_id = attr_common_flds_ecomc.id
where attr_common_flds_ecomc.field_type IN ('text', 'textarea', 'file', 'date', 'select-multiple') ORDER BY attr_common_flds_ecomc.id
";
        $q = $conn->query($qry);
        $q->execute();
        $q->setFetchMode(PDO::FETCH_ASSOC);
        $row = $q->fetchAll();
        foreach ($row as $k => $v) {
            $result[$v['id']] = $v['field_type'];
        }
        return $result;
    } catch (PDOException $pe) {
        echo db_error($pe->getMessage());
    }
}

//function get_adv_search($param1, $param2) {
function get_adv_search($firstkey, $qry_inner, $count = false)
{
    $search_data = array();
    if (!$count) {
        //for Data
        $query_outer = "  SELECT 
                    tbl2.id productId, 
                    tbl2.n product, 
                    tbl2.pc category, 
                    tbl2.an attribute_name, 
                    group_concat(tbl2.v SEPARATOR '$') AS value FROM 
                    ( 
                    SELECT p.prodid AS id, 
                    p.prodname AS n, 
                    pt.product_type_name AS pc, 
                    f.attribute_name AS an, 
                    v.`value` AS v
                    FROM products_ecomc AS p 
                    LEFT JOIN product_attribute_value AS t ON p.prodid = t.product_id 
                    LEFT JOIN attribute_value_ecomc AS v ON t.attribute_value_id = v.attr_value_id 
                    LEFT JOIN attr_common_flds_ecomc AS f ON v.attr_id = f.id 
                    LEFT JOIN product_type_ecomc AS pt ON p.subcatid = pt.product_type_id 
                    WHERE t.product_id IN (";
        $query_inner = "SELECT 
                                    %s.product_id 
                                    FROM 
                                %s)
		GROUP BY t.product_attr_val_id) 
	as tbl2 
GROUP BY 
	tbl2.id, 
	tbl2.n, 
	tbl2.an order by tbl2.n";
        $query = $query_outer . $query_inner;
    } else {
        $count_query_outer = "SELECT
                            p.prodid AS productId,            
                            p.prodname  AS product,
                            f.attribute_name AS attribute_name,
                            COUNT(v.`value`) as relationcount,
                            v.`value` AS value
                            FROM
                            products_ecomc AS p
                            LEFT JOIN product_attribute_value AS t 
                            ON p.prodid = t.product_id
                            LEFT JOIN attribute_value_ecomc AS v 
                            ON t.attribute_value_id = v.attr_value_id
                            LEFT JOIN attr_common_flds_ecomc AS f 
                            ON v.attr_id = f.id 
                            WHERE t.product_id IN (";
        $count_query_inner = "SELECT 
                                    %s.product_id 
                                    FROM 
                                %s)
		GROUP BY t.attribute_value_id order by p.prodname";
        $query = $count_query_outer . $count_query_inner;
    }



    try {
        $conn = dbconnect();


        $sql = sprintf($query, $firstkey, $qry_inner);
        //return $sql;

        $q = $conn->prepare($sql);
        //$q->bindParam(':customarstatus',1,PDO::PARAM_INT);
        // $bind = array(':firstkey' => $firstkey, ':innerqry' => $qry_inner);
        //$bind = array(':person' => '%'.$param1.'%', ':attribute' => $param2);
        //exit;
        $q->execute();
        //return PdoDebugger::show($query, $bind);
        $q->setFetchMode(PDO::FETCH_ASSOC);
        while ($row = $q->fetch()) {
            if (!$count) {
                $search_data[] = array(
                    'productId' => $row['productId'],
                    'product' => $row['product'],
                    'category' => $row['category'],
                    'attribute_name' => $row['attribute_name'],
                    'value' => $row['value']
                );
            } else {
                $search_data[] = array(
                    'attribute_name' => $row['attribute_name'],
                    'relationcount' => $row['relationcount'],
                    'value' => $row['value']
                );
            }
        }
        return (!empty($search_data)) ? $search_data : false;
    } catch (PDOException $pe) {
        echo db_error($pe->getMessage());
    }
}

function extractKeyValuePairs($string = "", $delimiter = " ")
{
    $params = explode($delimiter, $string);

    $pairs = [];
    for ($i = 0; $i < count($params); $i++) {
        $pairs[$params[$i]] = $params[++$i];
    }

    return $pairs;
}

function get_html_from_JSON($json = null, $type = '')
{
    if (!ADDTOCART) {
        return false;
    }
    $conn = dbconnect();
    $qry_cnv = "SELECT conv_rate from admin_ecomc";
    $q_cnv = $conn->prepare($qry_cnv);
    $q_cnv->execute();
    $q_cnv->setFetchMode(PDO::FETCH_ASSOC);
    $row_cnv = $q_cnv->fetch();
    $conv_rate = trim($row_cnv['conv_rate']);

    $html = '';
    $decode = json_decode($json, true);
    //$html .= '<div class="select-image-cart"><select class="imgOptions" style="width: 100%;">';
    $html .= '<div class="right-details">';
//    print '<pre>';
//    print_r($decode);
    if (!empty($decode['sellOriginal'])) {
//        print '<pre>';
//        print_r($decode['sellOriginal']);
        $count_details = 0;
        for ($i = 0; $i < count($decode['sellOriginal']); $i++) {
            if ($decode['sellOriginal'][$i]['size'] != '') {
                $count_details = $count_details + 1;
            }
            if ($decode['sellOriginal'][$i]['price'] != '') {
                $count_details = $count_details + 1;
            }
        }

        if ($count_details != 0) {
            $html .='<div class="memorabilia-details-title">
                        Original
                    </div>';

            for ($i = 0; $i < count($decode['sellOriginal']); $i++) {
                if (strlen($decode['sellOriginal'][$i]['size']) > 0 || !($decode['sellOriginal'][$i]['size'] == '')) {
                    //$html .= '<option value="' . $decode['sellOriginal'][$i]['size'] . '$' . $decode['sellOriginal'][$i]['price'] .'">'. '&nbsp;'. $decode['sellOriginal'][$i]['size']. ''. $img_price. '</option>' ;

                    $html .= '<div class="exhibition-search-title">' . $decode['sellOriginal'][$i]['size'] . '</div>';
                    if ($conv_rate == '') {
                        $html .= '<div class="print-cost"> ₹' . $decode['sellOriginal'][$i]['price'] . '</div>';
                    } else {
                        $urd_val = $decode['sellOriginal'][$i]['price'] / $conv_rate;
                        $urd_val = round($urd_val, 2);
                        $html .= '<div class="print-cost"> ₹ ' . $decode['sellOriginal'][$i]['price'] . ' / $ ' . $urd_val . '</div>';
                    }

                    if (strlen($decode['sellOriginal'][$i]['price']) > 0 || !($decode['sellOriginal'][$i]['price'] == '')) {
                        if (empty($decode['sellOriginal'][$i]['taxable'])) {
                            $taxable = 0;
                        } else {
                            $taxable = 1;
                        }

                        // $html .= '<div class="exhibition-search-content"></div>';

                        $html .= '<form class="cart-add-form" method="POST" id="original" action="' . SITE_URL . '/cart-checkout/calculate-cart.php">';
                        $html .= '<input type="hidden" name="product_id" id="product_id" value="' . $decode['product'] . '">' .
                                '<input type="hidden" name="image_id" id="image_id" value="' . $decode['image_id'] . '">' .
                                '<input type="hidden" name="type" id="type" value="' . $decode['sellOriginal'][$i]['size'] . '">' .
                                '<input type="hidden" name="size" id="size" value="' . $decode['sellOriginal'][$i]['size'] . '">' .
                                '<input type="hidden" name="price" id="size" value="' . $decode['sellOriginal'][$i]['price'] . '">' .
                                '<input type="hidden" name="taxable" id="size" value="' . $taxable . '">' .
                                '<input type="hidden" name="imageType" id="imageType" value="' . $type . '">' .
                                '<button type="submit" name="original_submit" class="btn form-control">Add to Cart</button></form></div>';
                    } else {
                       //
                    }
                    $html .= '</tr>';
                }
            }
        }
    }

    if (!empty($decode['sellPrint'])) {
        $count_details_p = 0;
        for ($i = 0; $i < count($decode['sellPrint']); $i++) {
            if ($decode['sellPrint'][$i]['size'] != '') {
                $count_details_p = $count_details_p + 1;
            }
            if ($decode['sellPrint'][$i]['price'] != '') {
                $count_details_p = $count_details_p + 1;
            }
        }
        if ($count_details_p != 0) {
            $html .= '<div class="memorabilia-details-title">
                        PRINT
                    </div>';

            for ($i = 0; $i < count($decode['sellPrint']); $i++) {
                if (strlen($decode['sellPrint'][$i]['size']) > 0 || !($decode['sellPrint'][$i]['size'] == '')) {
                    //$html .= '<option value="' . $decode['sellPrint'][$i]['size'] . '$' . $decode['sellPrint'][$i]['price'] .'">'. '&nbsp;'. $decode['sellPrint'][$i]['size']. ''. $img_price2. '</option>' ;

                    $html .= '<div class="exhibition-search-title">' . $decode['sellPrint'][$i]['size'] . '</div>';
                    if ($conv_rate == '') {
                        $html .= '<div class="print-cost">' . $decode['sellPrint'][$i]['price'] . '</div>';
                    } else {
                        $urd_val = $decode['sellPrint'][$i]['price'] / $conv_rate;
                        $urd_val = round($urd_val, 2);
                        $html .= '<div class="print-cost"> ₹ ' . $decode['sellPrint'][$i]['price'] . ' / $ ' . $urd_val . '</div>';
                    }

                    if (strlen($decode['sellPrint'][$i]['price']) > 0 || !($decode['sellPrint'][$i]['price'] == '')) {
                        if (empty($decode['sellPrint'][$i]['taxable'])) {
                            $taxable = 0;
                        } else {
                            $taxable = 1;
                        }
                        // $html .= '<div class="exhibition-search-content"></div>';

                        $html .= '<form class="cart-add-form" method="POST" id="printed" action="' . SITE_URL . '/cart-checkout/calculate-cart.php">';
                        $html .= '<input type="hidden" name="product_id" id="product_id" value="' . $decode['product'] . '">' .
                                '<input type="hidden" name="image_id" id="image_id" value="' . $decode['image_id'] . '">' .
                                '<input type="hidden" name="type" id="type" value="' . $decode['sellPrint'][$i]['size'] . '">' .
                                '<input type="hidden" name="size" id="size" value="' . $decode['sellPrint'][$i]['size'] . '">' .
                                '<input type="hidden" name="price" id="size" value="' . $decode['sellPrint'][$i]['price'] . '">' .
                                '<input type="hidden" name="taxable" id="size" value="' . $taxable . '">' .
                                '<input type="hidden" name="imageType" id="imageType" value="' . $type . '">' .
                                '<button type="submit" name="original_submit" class="enquiry-btn">Add to Cart</button></form></div>';
                    } else {
                        //
                    }
                }
            }
        }
    }
    return $html;
}

function get_add_to_cart_button($json = null, $type = '', $bibliography = false)
{
    if (!ADDTOCART) {
        return false;
    }
    $conn = dbconnect();
    $qry_cnv = "SELECT conv_rate from admin_ecomc";
    $q_cnv = $conn->prepare($qry_cnv);
    $q_cnv->execute();
    $q_cnv->setFetchMode(PDO::FETCH_ASSOC);
    $row_cnv = $q_cnv->fetch();
    $conv_rate = trim($row_cnv['conv_rate']);

    if (!$bibliography) {
        $html = '';
        $jsonDecode = json_decode($json, true);

        if (!empty($jsonDecode)) {
            $html .= '<form class="cart-add-form" method="POST" id="original" action="' . SITE_URL . '/cart-checkout/calculate-cart.php">';

            $html .= '<input type="hidden" name="product_id" id="product_id" value="' . $jsonDecode['product'] . '">' .
                    '<input type="hidden" name="image_id" id="image_id" value="' . $jsonDecode['image_id'] . '">' .
                    '<input type="hidden" name="type" id="type" value="">' .
                    '<input type="hidden" name="size" id="size" value="">' .
                    '<input type="hidden" name="price" id="size" value="1">' .
                    '<input type="hidden" name="imageType" id="imageType" value="' . $type . '">' .
                    '<button type="submit" name="original_submit" class="btn form-control">Add to Cart</button><br><hr></form></div>';
        }

        return $html;
    }

    $html = '';
    $decode = json_decode($json, true);
    if (!empty($decode['sellPrint'])) {
        $count_details = 0;
        for ($i = 0; $i < count($decode['sellPrint']); $i++) {
            if ($decode['sellPrint'][$i]['price'] != '') {
                $count_details = $count_details + 1;
            }
        }
        if ($count_details == 1) {
            for ($i = 0; $i < count($decode['sellPrint']); $i++) {
                if (empty($decode['sellPrint'][$i]['taxable'])) {
                    $taxable = 0;
                } else {
                    $taxable = 1;
                }
                //Display HTML for Product Image
                //$html .= '<li><div class="image-particulars parent-container"><a class="thumbnail" href="'.SITE_URL. '/' .IMGSRC . 'bibliography/'. $decode['image_name'] .'"> <img class="img-responsive" src="'. SITE_URL . '/product_images/thumbs/' . $decode['image_name'] . '" alt="bibliography"></a></div></li><br>';
                $html .= '<li><div class="detials"><strong>Price: Rs.&nbsp;</strong><span>' . $decode['sellPrint'][$i]['price'] . '</span></li>';

                $html .= '<form class="cart-add-form" method="POST" id="original" action="' . SITE_URL . '/cart-checkout/calculate-cart.php">';

                $html .= '<input type="hidden" name="product_id" id="product_id" value="' . $decode['product'] . '">' .
                        '<input type="hidden" name="image_id" id="image_id" value="' . $decode['image_id'] . '">' .
                        '<input type="hidden" name="type" id="type" value="">' .
                        '<input type="hidden" name="size" id="size" value="">' .
                        '<input type="hidden" name="price" id="size" value="' . $decode['sellPrint'][$i]['price'] . '">' .
                        '<input type="hidden" name="taxable" id="size" value="' . $taxable . '">' .
                        '<input type="hidden" name="imageType" id="imageType" value="' . $type . '">' .
                        '<button type="submit" name="original_submit" class="btn form-control">Add to Cart</button><br><hr></form></div>';
            }
        }
    }


    return $html;
}

function GeraHash($qtd)
{
    //Under the string $Caracteres you write all the characters you want to be used to randomly generate the code.
    $Caracteres = 'ABCDEFGHIJKLMOPQRSTUVXWYZ0123456789';
    $QuantidadeCaracteres = strlen($Caracteres);
    $QuantidadeCaracteres--;

    $Hash = null;
    for ($x = 1; $x <= $qtd; $x++) {
        $Posicao = rand(0, $QuantidadeCaracteres);
        $Hash .= substr($Caracteres, $Posicao, 1);
    }

    return $Hash;
}

function check_valid_customer($email = '')
{
    try {
        $conn = dbconnect();
//        $q = $conn->prepare("SELECT name FROM " . CUSTOMAR_TBL . " WHERE `mobile`=:mobileno OR `alt_phone`=:altphnno");
        $q = $conn->prepare("SELECT * FROM customer_login WHERE `email`=:emailid");

        //$q->bindParam();
        //$bind = array(':mobileno' => $mobile, ':altphnno' => $mobile);
        $bind = array(':emailid' => $email);

        $q->execute($bind);
        $q->setFetchMode(PDO::FETCH_ASSOC);

        return $q->rowCount() > 0 ? true : false;
    } catch (PDOException $pe) {
        echo db_error($pe->getMessage());
    }
}

function check_valid_customerlogin($email, $password)
{
    try {
        $conn = dbconnect();

        //echo $password;
        // $q2 = $conn->prepare("SELECT * FROM customer_login WHERE `email`=':emailid' and `password`=':password' and status = '0'");

        $query = "SELECT * FROM customer_login WHERE `email`='%s' and `password`='%s' and status = '0'";
        $sql = sprintf($query, $email, $password);
        $q2 = $conn->prepare($sql);

        //$q->bindParam();
        //$bind2 = array(':emailid' => $email, ':password' => $password);

        $q2->execute();
        $q2->setFetchMode(PDO::FETCH_ASSOC);
        //return $sql;
        return $q2->rowCount() > 0 ? true : false;
    } catch (PDOException $pe) {
        echo db_error($pe->getMessage());
    }
}

function check_auth_user()
{
    if (!isset($_SESSION['user-email'])) {
        goto_location('login-register');
        exit;
    }
}

function get_user_data($param)
{
    try {
        $conn = dbconnect();
        $query = "SELECT * FROM customer_login WHERE `email`='%s'";
        $sql = sprintf($query, $param);
        $q = $conn->prepare($sql);

        $q->execute();
        $q->setFetchMode(PDO::FETCH_ASSOC);

        return $cust_data = $q->fetch();
    } catch (PDOException $pe) {
        echo db_error($pe->getMessage());
    }
}

function get_user_databyid($param)
{
    try {
        $conn = dbconnect();
        $query = "SELECT * FROM customer_login WHERE `id`='%s'";
        $sql = sprintf($query, $param);
        $q = $conn->prepare($sql);

        $q->execute();
        $q->setFetchMode(PDO::FETCH_ASSOC);

        return $cust_data = $q->fetch();
    } catch (PDOException $pe) {
        echo db_error($pe->getMessage());
    }
}

function check_cust_address_par($id)
{
    try {
        $conn = dbconnect();
//        $q = $conn->prepare("SELECT name FROM " . CUSTOMAR_TBL . " WHERE `mobile`=:mobileno OR `alt_phone`=:altphnno");
        //$q = $conn->prepare("SELECT * FROM customer_address WHERE `customer_id`=:userid and `parent_id` = '0'");

        $query = "SELECT * FROM customer_address WHERE `customer_id`='%s' and `parent_id` = '0'";

        $sql = sprintf($query, $id);
        $q = $conn->prepare($sql);
        //$bind = array(':userid' => $id);

        $q->execute();
        $q->setFetchMode(PDO::FETCH_ASSOC);

        return $q->rowCount() > 0 ? true : false;
    } catch (PDOException $pe) {
        echo db_error($pe->getMessage());
    }
}

function get_user_bill_addr($id)
{
    try {
        $conn = dbconnect();
        $query = "SELECT * FROM customer_address WHERE `customer_id`='%s' and `parent_id` = '0'";
        $sql = sprintf($query, $id);
        $q = $conn->prepare($sql);

        $q->execute();
        $q->setFetchMode(PDO::FETCH_ASSOC);

        return $cust_addr = $q->fetch();
    } catch (PDOException $pe) {
        echo db_error($pe->getMessage());
    }
}

function check_cust_addr_child($id)
{
    try {
        $conn = dbconnect();
//        $q = $conn->prepare("SELECT name FROM " . CUSTOMAR_TBL . " WHERE `mobile`=:mobileno OR `alt_phone`=:altphnno");
        //$q = $conn->prepare("SELECT * FROM customer_address WHERE `customer_id`=:userid and `parent_id` = '0'");

        $query = "SELECT * FROM customer_address WHERE `customer_id`='%s' and `parent_id` <> '0'";

        $sql = sprintf($query, $id);
        $q = $conn->prepare($sql);
        //$bind = array(':userid' => $id);

        $q->execute();
        $q->setFetchMode(PDO::FETCH_ASSOC);

        return $q->rowCount() > 0 ? true : false;
    } catch (PDOException $pe) {
        echo db_error($pe->getMessage());
    }
}

function get_user_addr_ship($id)
{
    try {
        $conn = dbconnect();
        $query = "SELECT * FROM customer_address WHERE `customer_id`='%s' and `parent_id` <> '0'";
        $sql = sprintf($query, $id);
        $q = $conn->prepare($sql);

        $q->execute();
        $q->setFetchMode(PDO::FETCH_ASSOC);

        return $cust_ship_addr = $q->fetchAll();
    } catch (PDOException $pe) {
        echo db_error($pe->getMessage());
    }
}

function get_user_addr($id)
{
    try {
        $conn = dbconnect();
        $query = "SELECT * FROM customer_address WHERE `id`='%s' and `parent_id` <> '0'";
        $sql = sprintf($query, $id);
        $q = $conn->prepare($sql);

        $q->execute();
        $q->setFetchMode(PDO::FETCH_ASSOC);

        return $cust_addr = $q->fetch();
    } catch (PDOException $pe) {
        echo db_error($pe->getMessage());
    }
}

function get_user_cart($id)
{
    try {
        $conn = dbconnect();
        $query = "SELECT * FROM cart WHERE `customer_id`='%s'";
        $sql = sprintf($query, $id);
        $q = $conn->prepare($sql);

        $q->execute();
        $q->setFetchMode(PDO::FETCH_ASSOC);

        return $cust_cart = $q->fetchAll();
    } catch (PDOException $pe) {
        echo db_error($pe->getMessage());
    }
}

function check_cart_exists($id)
{
    try {
        $conn = dbconnect();
        $query = "SELECT * FROM cart WHERE `customer_id`='%s'";

        $sql = sprintf($query, $id);
        $q = $conn->prepare($sql);

        $q->execute();
        $q->setFetchMode(PDO::FETCH_ASSOC);

        return $q->rowCount() > 0 ? true : false;
    } catch (PDOException $pe) {
        echo db_error($pe->getMessage());
    }
}

function get_prod_name($id)
{
    try {
        $conn = dbconnect();
        $query = "SELECT * FROM products_ecomc WHERE `prodid`='%s'";
        $sql = sprintf($query, $id);
        $q = $conn->prepare($sql);

        $q->execute();
        $q->setFetchMode(PDO::FETCH_ASSOC);

        return $cust_addr = $q->fetch();
    } catch (PDOException $pe) {
        echo db_error($pe->getMessage());
    }
}

function get_image_name($id)
{
    try {
        $conn = dbconnect();
        $query = "SELECT * FROM memorabilia_images WHERE `m_image_id`='%s'";
        $sql = sprintf($query, $id);
        $q = $conn->prepare($sql);

        $q->execute();
        $q->setFetchMode(PDO::FETCH_ASSOC);

        return $cust_addr = $q->fetch();
//        while ($row = $q->fetch()){
//            $data['product_details'] = array(
//                'image_id' => $row['m_image_id'],
//                'image_name'=> $row['m_image_name'],
//                'image_category'=> $row['m_image_category_text'],
//                'image_details' => json_decode($row['m_image_details'], true)
//
//            );
//        }
//    return $data;
    } catch (PDOException $pe) {
        echo db_error($pe->getMessage());
    }
}

function get_gateways()
{
    try {
        $conn = dbconnect();
        $query = "SELECT * FROM gateway WHERE `status`='0'";
        $sql = sprintf($query);
        $q = $conn->prepare($sql);

        $q->execute();
        $q->setFetchMode(PDO::FETCH_ASSOC);

        return $cust_cart = $q->fetchAll();
    } catch (PDOException $pe) {
        echo db_error($pe->getMessage());
    }
}

function get_last_user_addr($id)
{
    try {
        $conn = dbconnect();
        $query = "SELECT * from customer_address WHERE `customer_id`='%s' and parent_id = '0'";
        $sql = sprintf($query, $id);
        $q = $conn->prepare($sql);

        $q->execute();
        $q->setFetchMode(PDO::FETCH_ASSOC);

        return $cust_addr = $q->fetch();
    } catch (PDOException $pe) {
        echo db_error($pe->getMessage());
    }
}

function get_cur_ship_addr($id)
{
    try {
        $conn = dbconnect();
        $query = "SELECT max(id) max_id from customer_address WHERE `customer_id`='%s' and parent_id <> '0'";
        $sql = sprintf($query, $id);
        $q = $conn->prepare($sql);

        $q->execute();
        $q->setFetchMode(PDO::FETCH_ASSOC);

        return $cust_addr = $q->fetch();
    } catch (PDOException $pe) {
        echo db_error($pe->getMessage());
    }
}

function get_cart($id)
{
    try {
        $conn = dbconnect();
        $query = "SELECT * FROM cart WHERE `customer_id`='%s'";
        $sql = sprintf($query, $id);
        $q = $conn->prepare($sql);

        $q->execute();
        $q->setFetchMode(PDO::FETCH_ASSOC);

        return $cust_cart = $q->fetchAll();
    } catch (PDOException $pe) {
        echo db_error($pe->getMessage());
    }
}

function get_particular_gateway($id)
{
    try {
        $conn = dbconnect();
        $query = "select * from gateway where id ='%s'";
        $sql = sprintf($query, $id);
        $q = $conn->prepare($sql);

        $q->execute();
        $q->setFetchMode(PDO::FETCH_ASSOC);

        return $cust_addr = $q->fetch();
    } catch (PDOException $pe) {
        echo db_error($pe->getMessage());
    }
}

function ordered_item($id)
{
    try {
        $conn = dbconnect();
        $query = "SELECT * FROM order_products WHERE `order_id`='%s'";
        $sql = sprintf($query, $id);
        $q = $conn->prepare($sql);

        $q->execute();
        $q->setFetchMode(PDO::FETCH_ASSOC);

        return $cust_cart = $q->fetchAll();
    } catch (PDOException $pe) {
        echo db_error($pe->getMessage());
    }
}

function get_particular_email($ename)
{
    try {
        $conn = dbconnect();
        $query = "select * from email_template where 	email_name ='%s'";
        $sql = sprintf($query, $ename);
        $q = $conn->prepare($sql);

        $q->execute();
        $q->setFetchMode(PDO::FETCH_ASSOC);

        return $cust_email = $q->fetch();
    } catch (PDOException $pe) {
        echo db_error($pe->getMessage());
    }
}

function get_order_status_byID($order_id = '')
{
    try {
        $conn = dbconnect();
        $q = $conn->prepare("SELECT order_status.status, order_status.order_id FROM order_status where id = (select max(id) from order_status where order_id = :orderID)");
        $q->bindParam(':orderID', $order_id, PDO::PARAM_INT);
        $q->execute();
        $q->setFetchMode(PDO::FETCH_ASSOC);
        $row = $q->fetchAll();
        return $q->rowCount() == 0 ? '' : $row[0];
    } catch (PDOException $pe) {
        echo db_error($pe->getMessage());
    }
}

/**
 * default values when user not clicked select all
 */
function get_uniqueLanguages()
{
    try {
        $conn = dbconnect();
        $qry = "SELECT DISTINCT value FROM `attribute_value_ecomc` WHERE attr_id =15";
        $q = $conn->query($qry);
        $q->setFetchMode(PDO::FETCH_ASSOC);
        while ($rows = $q->fetch()) {
            $data[] = $rows['value'];
        }
        return $q->rowCount() > 0 ? $data : false;
    } catch (PDOException $pe) {
        echo db_error($pe->getMessage());
    }
}

function check_valid_customeremail($email)
{
    try {
        $conn = dbconnect();

        //echo $password;
        // $q2 = $conn->prepare("SELECT * FROM customer_login WHERE `email`=':emailid' and `password`=':password' and status = '0'");

        $query = "SELECT * FROM customer_login WHERE `email`='%s' and status = '0'";
        $sql = sprintf($query, $email);
        $q2 = $conn->prepare($sql);

        //$q->bindParam();
        //$bind2 = array(':emailid' => $email, ':password' => $password);

        $q2->execute();
        $q2->setFetchMode(PDO::FETCH_ASSOC);
        //return $sql;
        return $q2->rowCount() > 0 ? true : false;
    } catch (PDOException $pe) {
        echo db_error($pe->getMessage());
    }
}

function check_valid_customerhash($email, $hash)
{
    try {
        $conn = dbconnect();

        //echo $password;
        // $q2 = $conn->prepare("SELECT * FROM customer_login WHERE `email`=':emailid' and `password`=':password' and status = '0'");

        $query = "SELECT * FROM customer_login WHERE `email`='%s' and hash ='%s' and status = '0'";
        $sql = sprintf($query, $email, $hash);
        $q2 = $conn->prepare($sql);

        //$q->bindParam();
        //$bind2 = array(':emailid' => $email, ':password' => $password);

        $q2->execute();
        $q2->setFetchMode(PDO::FETCH_ASSOC);
        //return $sql;
        return $q2->rowCount() > 0 ? true : false;
    } catch (PDOException $pe) {
        echo db_error($pe->getMessage());
    }
}

/**
 * Specially for Bibliography Details Sorting keys to need
 *
 * @return an sorted array
 */
function bibliography_details_flatten_array(array $someArray)
{
    $singledm = array();
    $iterator = new RecursiveIteratorIterator(new RecursiveArrayIterator($someArray), RecursiveIteratorIterator::SELF_FIRST);
    foreach ($iterator as $k => $v) {
        $indent = str_repeat('&nbsp;', 10 * $iterator->getDepth());
        // Not at end: show key only
        $depth = $iterator->getDepth();
        if ($iterator->hasChildren()) {
            //echo "depth: $depth - $indent$k :<br>";
            // At end: show key, value and path
            if ($depth == 0) {
                $singledm['category'] = $k;
            }
            if ($depth == 1) {
                $singledm['pname'] = $k;
            }
            if ($depth == 2) {
                $singledm['pid'] = $k;
            }
        } else {
            $singledm[$k] = $v;
        }
    }
    return $singledm;
}

/**
 * Appending to a specific key Multidimensional array
 * @param array $array
 * @param type $key
 * @param array $new
 * @return type
 */
function array_insert_after(array $array, $key, array $new)
{
    $keys = array_keys($array);
    $index = array_search($key, $keys);
    $pos = false === $index ? count($array) : $index + 1;
    //return array_slice($array,0,$pos);


    return array_replace_recursive(array_slice($array, 0, $pos), $new, array_slice($array, $pos));
}

function array_insert_before(array $array, $key, array $new)
{
    $keys = array_keys($array);
    //return $new;
    $index = array_search($key, $keys);

    //$pos = false === $index ? count($array) : $index + 1;
    $pos = false === $index ? count($array) : $index + 1;


    //return array_slice($array, $pos);

    return array_replace_recursive($new, array_slice($array, 0, $pos), array_slice($array, $pos));
//    return array_replace(array_slice($array, 0, $pos), $new, array_slice($array, $pos));
}

function array_insert_before1($key, array &$array, $new_key, $new_value)
{
    if (array_key_exists($key, $array)) {
        $new = array();
        foreach ($array as $k => $value) {
            if ($k === $key) {
                $new[$new_key] = $new_value;
            }
            $new[$k] = $value;
        }
        return $new;
    }
    return false;
}

//define function name
function m_log($arMsg)
{
    //define empty string
    $stEntry = "";
    //get the event occur date time,when it will happened
    $arLogData['event_datetime'] = '[' . date('D Y-m-d h:i:s A') . '] [client ' . $_SERVER['REMOTE_ADDR'] . ']';
    //if message is array type
    if (is_array($arMsg)) {
        //concatenate msg with datetime
        foreach ($arMsg as $msg) {
            $stEntry .= $arLogData['event_datetime'] . " " . $msg . "rn";
        }
    } else {   //concatenate msg with datetime
        $stEntry .= $arLogData['event_datetime'] . " " . $arMsg . "\r\n";
    }
    //create file with current date name
    $stCurLogFileName = 'log_' . date('Ymd') . '.txt';
    //open the file append mode,dats the log file will create day wise
    $Path = $_SERVER['DOCUMENT_ROOT'] . "/" . LOG_PATH;
    $fHandler = fopen($Path . $stCurLogFileName, 'a');
    //write the info into the file
    fwrite($fHandler, $stEntry);
    //close handler
    fclose($fHandler);
}

function get_image_count_memoribilia($pid)
{
    try {
        $conn = dbconnect();
        $query = "SELECT count(m_image_id) count_fid FROM memorabilia_images WHERE `product_id`='%s'";
        $sql = sprintf($query, $pid);
        $q = $conn->prepare($sql);

        $q->execute();
        $q->setFetchMode(PDO::FETCH_ASSOC);

        return $cust_addr = $q->fetch();
    } catch (PDOException $pe) {
        echo db_error($pe->getMessage());
    }
}

function get_PDF_count_bibliography($pid, $choice = false)
{
    try {
        $conn = dbconnect();
        $query = "SELECT count(m_image_id) count_fid_p FROM memorabilia_images WHERE `product_id`='%s' and m_image_category= 'B'";
        $sql = sprintf($query, $pid);
        $q = $conn->prepare($sql);

        $q->execute();
        $q->setFetchMode(PDO::FETCH_ASSOC);
        if ($choice) {
            $row = $q->fetch();
            return !empty($row['count_fid_p']) ? $row['count_fid_p'] : 0;
        }
        return $cust_addr = $q->fetch();
    } catch (PDOException $pe) {
        echo db_error($pe->getMessage());
    }
}

function get_poster_count_memoribilia($pid, $choice = false)
{
    try {
        $conn = dbconnect();
        $query = "SELECT count(m_image_id) count_fid_p FROM memorabilia_images WHERE `product_id`='%s' and m_image_category= 'P'";
        $sql = sprintf($query, $pid);
        $q = $conn->prepare($sql);

        $q->execute();
        $q->setFetchMode(PDO::FETCH_ASSOC);
        if ($choice) {
            $row = $q->fetch();
            return !empty($row['count_fid_p']) ? $row['count_fid_p'] : 0;
        }
        return $cust_addr = $q->fetch();
    } catch (PDOException $pe) {
        echo db_error($pe->getMessage());
    }
}

function get_card_count_memoribilia($pid, $choice = false)
{
    try {
        $conn = dbconnect();
        $query = "SELECT count(m_image_id) count_fid_p FROM memorabilia_images WHERE `product_id`='%s' and m_image_category= 'C'";
        $sql = sprintf($query, $pid);
        $q = $conn->prepare($sql);

        $q->execute();
        $q->setFetchMode(PDO::FETCH_ASSOC);
        if ($choice) {
            $row = $q->fetch();
            return !empty($row['count_fid_p']) ? $row['count_fid_p'] : 0;
        }
        return $cust_addr = $q->fetch();
    } catch (PDOException $pe) {
        echo db_error($pe->getMessage());
    }
}

function get_synopsis_count_memoribilia($pid, $choice = false)
{
    try {
        $conn = dbconnect();
        $query = "SELECT count(m_image_id) count_fid_p FROM memorabilia_images WHERE `product_id`='%s' and m_image_category= 'S'";
        $sql = sprintf($query, $pid);
        $q = $conn->prepare($sql);

        $q->execute();
        $q->setFetchMode(PDO::FETCH_ASSOC);
        if ($choice) {
            $row = $q->fetch();
            return !empty($row['count_fid_p']) ? $row['count_fid_p'] : 0;
        }
        return $cust_addr = $q->fetch();
    } catch (PDOException $pe) {
        echo db_error($pe->getMessage());
    }
}

function count_click($type, $product)
{
    $conn = dbconnect();
    $date = date("Y-m-d H:i:s");
    $link = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
    $ip = $_SERVER['REMOTE_ADDR'];

    $qry1 = "insert into access_log(id,ip,link,type,prod_id,date) "
            . "values('','$ip','$link','$type','$product','$date')";
    $q1 = $conn->prepare($qry1);
    $q1->execute();
}

function get_video($pid)
{
    try {
        $conn = dbconnect();
        $query = "select * from video where `product_id` ='%s'";
        $sql = sprintf($query, $pid);
        $q = $conn->prepare($sql);

        $q->execute();
        $q->setFetchMode(PDO::FETCH_ASSOC);

        return $cust_addr = $q->fetch();
    } catch (PDOException $pe) {
        echo db_error($pe->getMessage());
    }
}

function paint_artist_mapping($artistName = '')
{
    //Replace Special symbols from artist name

    $s = preg_replace('~^[^a-zA-Z0-9]+|[^a-zA-Z0-9]+$~', '', $artistName);
    $urlName = preg_replace('~[^a-zA-Z0-9]+~', '-', $s);

    //Check attribute ID and Get artist value id from Table: [attr_common_flds_ecomc] [attribute_value_ecomc]
    $checkID = array('artist' => 133);
    $html = '';
    $rowCount_final = 0;

    try {
        $conn = dbconnect();

        $qry = "SELECT * FROM `" . ATTR_VAL . "` WHERE attr_id=:attrID AND value=:attrValue";
        $q = $conn->prepare($qry);
        $bind = array(':attrID' => $checkID['artist'], ':attrValue' => $artistName);
        $q->execute($bind);

        $rowCount = $q->rowCount();

        if ($rowCount > 0) {
            while ($row = $q->fetch(PDO::FETCH_ASSOC)) {
                $dataCheck[] = array(
                    'value_id' => $row['attr_value_id'],
                    'attr_id' => $row['attr_id'],
                    'value' => $row['value']
                );
            }
            $qry = "SELECT * FROM `artworks` WHERE `artist_id`=:artistID";
            $s = $conn->prepare($qry);
            $bind = array(':artistID' => $dataCheck[0]['value_id']);
            $s->execute($bind);
            $s->setFetchMode(PDO::FETCH_ASSOC);
            $rowCount_final = $s->rowCount();
            if ($rowCount_final > 0) {
                $html = '<span class="visual-archives"><a class="artist-artworks" href="artworks/' . $urlName . '/' . $dataCheck[0]['value_id'] . '" target="_blank"><i class="glyphicon glyphicon-link"></i>Visual Archives</a></span>';
            }
            return ($rowCount_final > 0) ? $html : false;
        }
        return $artistName;
        //return $data;
    } catch (PDOException $pe) {
        echo db_error($pe->getMessage());
    }
}

function get_conv_rate()
{
    try {
        $conn = dbconnect();
        $query = "SELECT conv_rate from admin_ecomc";
        $sql = sprintf($query);
        $q = $conn->prepare($sql);

        $q->execute();
        $q->setFetchMode(PDO::FETCH_ASSOC);

        return $cust_addr = $q->fetch();
    } catch (PDOException $pe) {
        echo db_error($pe->getMessage());
    }
}

/**
 * Bibliography multiple author or artist separated with $ due comma in the string
 */
function bibliography_replace_dollar($string = '')
{
    if (strpos($string, '$') !== false) {
        $str = str_replace("$", ", ", $string);
        return $str;
    }
    return $string;
}

function get_listExhibition()
{
    try {
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


        return array(
            's' => '<select id="exhibition" name="exhibition" >' . $msl . '</select>',
            'h' => $hc
        );
    } catch (PDOException $pe) {
        echo db_error($pe->getMessage());
    }
}

function array_value_recursive(array $referenceTypes, array $arr)
{
    $val = array(); //Output
    array_walk_recursive($arr, function ($v, $k) use ($referenceTypes, &$val) {
        //(in_array($k, $referenceTypes)) ? $val[$k] : $val[$k]=$v;
        echo $k . "<br>";
        var_dump(in_array($k, $referenceTypes));
    });
    return count($val) > 1 ? $val : array_pop($val);
}

function get_image_count_visualarchive($pid)
{
    try {
        $conn = dbconnect();
        $query = "SELECT count(va_image_id) count_fid FROM visual_archive_images WHERE `va_product_id`='%s'";
        $sql = sprintf($query, $pid);
        $q = $conn->prepare($sql);

        $q->execute();
        $q->setFetchMode(PDO::FETCH_ASSOC);

        return $cust_addr = $q->fetch();
    } catch (PDOException $pe) {
        echo db_error($pe->getMessage());
    }
}

function get_varchive_classification($conn = null)
{
    try {
        $conn = dbconnect();
        $query = "SELECT ave.* FROM attr_common_flds_ecomc acfe,attribute_value_ecomc ave "
                . "WHERE acfe.attribute_name='va_classification' and "
                . "acfe.id = ave.attr_id";
        $sql = sprintf($query);
        $q = $conn->prepare($sql);

        $q->execute();
        $q->setFetchMode(PDO::FETCH_ASSOC);

        return $cust_cart = $q->fetchAll();
    } catch (PDOException $pe) {
        echo db_error($pe->getMessage());
    }
}

//	{{{	get_pagination_value
/**
  Description: a special case where client need value of the Pagination attribute for Visual archives products
  @param Type:int $product_id
  @return Type:string value of the attribute in that product
 */
function get_pagination_value($product_id)
{
    $conn = dbconnect();
    $qry = "SELECT `av`.`value` FROM `products_ecomc` AS `p` LEFT JOIN `product_attribute_value` AS `pav` ON 			`p`.`prodid`=`pav`.`product_id`
                LEFT JOIN `attribute_value_ecomc` AS `av` ON `pav`.`attribute_value_id`=`av`.`attr_value_id` LEFT JOIN `attr_common_flds_ecomc` AS `af` ON `af`.`id`=`av`.`attr_id`
                WHERE
                `af`.`id`=197 AND `p`.`prodid`=:product_id";
    $stmt = $conn->prepare($qry);
    $stmt->bindParam(':product_id', $product_id, PDO::PARAM_INT);
    $stmt->execute();
    $paginationValue = $stmt->fetchColumn();
    $stmt = false;
    return (trim($paginationValue) !== '') ? $paginationValue : false;
}

// }}}
//	{{{ is_va_image_exists()
/**
  Description: is image already available on table
  @param Type:INT $imageID
 */
function is_va_image_exists($imageID)
{
    $conn = dbconnect();
    $qry = "SELECT * FROM `" . VISUALARCHIVE_IMAGES_TBL . "` WHERE `va_image_id`=:imageId";
    $stmt = $conn->prepare($qry);
    $stmt->bindParam(':imageId', $imageID, PDO::PARAM_INT);
    $stmt->execute();
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    $stmt = false;
    return (!empty($row)) ? $row : false;
}

//	}}}
//for va credit


function get_customer_credit($param)
{
    try {
        $conn = dbconnect();
        $query = "SELECT * FROM customer_credit WHERE `customer_id`='%s'";
        $sql = sprintf($query, $param);
        $q = $conn->prepare($sql);

        $q->execute();
        $q->setFetchMode(PDO::FETCH_ASSOC);

        return $cust_data = $q->fetch();
    } catch (PDOException $pe) {
        echo db_error($pe->getMessage());
    }
}

function get_product_credit($param)
{
    try {
        $conn = dbconnect();
        $query = "SELECT * FROM va_product_credit WHERE `prodid`='%s'";
        $sql = sprintf($query, $param);
        $q = $conn->prepare($sql);

        $q->execute();
        $q->setFetchMode(PDO::FETCH_ASSOC);

        return $cust_data = $q->fetch();
    } catch (PDOException $pe) {
        echo db_error($pe->getMessage());
    }
}

function get_va_singleimage($param)
{
    try {
        $conn = dbconnect();
        $query = "SELECT * FROM visual_archive_images WHERE `va_image_id`='%s'";
        $sql = sprintf($query, $param);
        $q = $conn->prepare($sql);

        $q->execute();
        $q->setFetchMode(PDO::FETCH_ASSOC);

        return $cust_data = $q->fetch();
    } catch (PDOException $pe) {
        echo db_error($pe->getMessage());
    }
}

function get_credit_timediff($param)
{
    try {
        $conn = dbconnect();
        $query = "select TIMESTAMPDIFF(second,a.credit_date,now()) timediff from 
(select * from customer_credit_history 
where 
prodid = '%s' 
order by credit_date desc limit 1)a";
        $sql = sprintf($query, $param);
        $q = $conn->prepare($sql);

        $q->execute();
        $q->setFetchMode(PDO::FETCH_ASSOC);

        return $cust_data = $q->fetch();
    } catch (PDOException $pe) {
        echo db_error($pe->getMessage());
    }
}

function secondsToTime($seconds)
{
    $dtF = new \DateTime('@0');
    $dtT = new \DateTime("@$seconds");

    //return $dtF->diff($dtT)->format('%a days, %h hours, %i minutes and %s seconds');
    return $dtF->diff($dtT)->format('%a days, %h hours');
}

function product_in_cust_credit($param1, $param2)
{
    try {
        $conn = dbconnect();


        $query = "SELECT * FROM customer_credit_history where customer_id='%s' and prodid = '%s' ";
        $sql = sprintf($query, $param1, $param2);
        $q2 = $conn->prepare($sql);

        $q2->execute();
        $q2->setFetchMode(PDO::FETCH_ASSOC);

        return $q2->rowCount() > 0 ? true : false;
    } catch (PDOException $pe) {
        echo db_error($pe->getMessage());
    }
}

function vaprodimages($prodid)
{
    try {
        $conn = dbconnect();
        $query = "SELECT * FROM visual_archive_images WHERE `va_product_id`='%s'";
        $sql = sprintf($query, $prodid);
        $q = $conn->prepare($sql);

        $q->execute();
        $q->setFetchMode(PDO::FETCH_ASSOC);

        return $prod = $q->fetchAll();
    } catch (PDOException $pe) {
        echo db_error($pe->getMessage());
    }
}

function get_admin_setting()
{
    try {
        $conn = dbconnect();
        $query = "SELECT * from admin_ecomc";
        $sql = sprintf($query);
        $q = $conn->prepare($sql);

        $q->execute();
        $q->setFetchMode(PDO::FETCH_ASSOC);

        return $cust_addr = $q->fetch();
    } catch (PDOException $pe) {
        echo db_error($pe->getMessage());
    }
}

function customer_in_credit($param1)
{
    try {
        $conn = dbconnect();


        $query = "SELECT * FROM customer_credit where customer_id='%s' ";
        $sql = sprintf($query, $param1);
        $q2 = $conn->prepare($sql);

        $q2->execute();
        $q2->setFetchMode(PDO::FETCH_ASSOC);

        return $q2->rowCount() > 0 ? true : false;
    } catch (PDOException $pe) {
        echo db_error($pe->getMessage());
    }
}

function customer_credit($param1)
{
    try {
        $conn = dbconnect();


        $query = "SELECT * FROM customer_credit where customer_id='%s' ";
        $sql = sprintf($query, $param1);
        $q2 = $conn->prepare($sql);

        $q2->execute();
        $q2->setFetchMode(PDO::FETCH_ASSOC);

        return $row = $q2->fetch();
    } catch (PDOException $pe) {
        echo db_error($pe->getMessage());
    }
}

function lastinsertid()
{
    try {
        $conn = dbconnect();
        $query = "SELECT LAST_INSERT_ID()";

        $stmt = $conn->prepare($query);
        $stmt->execute();
        return $rowLastinsertId = $stmt->fetch(PDO::FETCH_ASSOC);
    } catch (PDOException $pe) {
        echo db_error($pe->getMessage());
    }
}

function count_customer_credit_buy($param1)
{
    try {
        $conn = dbconnect();


        $query = "SELECT count(*) creditbuyno FROM customer_credit_history where customer_id='%s' and transaction_type = '0' ";
        $sql = sprintf($query, $param1);
        $q = $conn->prepare($sql);

        $q->execute();
        $q->setFetchMode(PDO::FETCH_ASSOC);

        return $cust_addr = $q->fetch();
    } catch (PDOException $pe) {
        echo db_error($pe->getMessage());
    }
}

function customer_details($param1)
{
    try {
        $conn = dbconnect();


        $query = "SELECT * FROM customer_login where id='%s' ";
        $sql = sprintf($query, $param1);
        $q = $conn->prepare($sql);

        $q->execute();
        $q->setFetchMode(PDO::FETCH_ASSOC);

        return $cust_addr = $q->fetch();
    } catch (PDOException $pe) {
        echo db_error($pe->getMessage());
    }
}

function get_credit_order_status_byID($order_id = '')
{
    try {
        $conn = dbconnect();
        $q = $conn->prepare("SELECT credit_order_status.status, credit_order_status.credit_id "
                . "FROM credit_order_status where id = (select max(id) from credit_order_status where credit_id = :orderID)");
        $q->bindParam(':orderID', $order_id, PDO::PARAM_INT);
        $q->execute();
        $q->setFetchMode(PDO::FETCH_ASSOC);
        $row = $q->fetchAll();
        return $q->rowCount() == 0 ? '' : $row[0];
    } catch (PDOException $pe) {
        echo db_error($pe->getMessage());
    }
}

//function allvaproducts() {
//
//    try {
//        $conn = dbconnect();
//        $query = "SELECT * FROM products_ecomc WHERE `category_id`='19' order by prodid";
//        //$sql = sprintf($query, $prodid);
//        $q = $conn->prepare($query);
//
//        $q->execute();
//        $q->setFetchMode(PDO::FETCH_ASSOC);
//
//        return $prod = $q->fetchAll();
//    } catch (PDOException $pe) {
//        echo db_error($pe->getMessage());
//    }
//}


function last_entered_credithistory($param1)
{
    try {
        $conn = dbconnect();


        $query = "select * from customer_credit_history where id="
                . "(SELECT max(id) FROM customer_credit_history where customer_id='%s' and transaction_type = '0') ";
        $sql = sprintf($query, $param1);
        $q = $conn->prepare($sql);

        $q->execute();
        $q->setFetchMode(PDO::FETCH_ASSOC);

        return $cust_addr = $q->fetch();
    } catch (PDOException $pe) {
        echo db_error($pe->getMessage());
    }
}

function last_payment_stat($param1)
{
    try {
        $conn = dbconnect();


        $query = "select * from tbl_credit_payment where id="
                . "(SELECT max(id) FROM tbl_credit_payment where customer_id='%s' and payment_status = 'initiated') ";
        $sql = sprintf($query, $param1);
        $q = $conn->prepare($sql);

        $q->execute();
        $q->setFetchMode(PDO::FETCH_ASSOC);

        return $cust_addr = $q->fetch();
    } catch (PDOException $pe) {
        echo db_error($pe->getMessage());
    }
}

function lastinsercredithistory($param1)
{
    try {
        $conn = dbconnect();


        $query = "SELECT max(id) lastid FROM customer_credit_history where customer_id='%s' and transaction_type = '0' ";
        $sql = sprintf($query, $param1);
        $q = $conn->prepare($sql);

        $q->execute();
        $q->setFetchMode(PDO::FETCH_ASSOC);

        return $cust_addr = $q->fetch();
    } catch (PDOException $pe) {
        echo db_error($pe->getMessage());
    }
}

function lastinsercredit($param1)
{
    try {
        $conn = dbconnect();


        $query = "SELECT max(id) lastcreditid FROM customer_credit where customer_id='%s' ";
        $sql = sprintf($query, $param1);
        $q = $conn->prepare($sql);

        $q->execute();
        $q->setFetchMode(PDO::FETCH_ASSOC);

        return $cust_addr = $q->fetch();
    } catch (PDOException $pe) {
        echo db_error($pe->getMessage());
    }
}

function va_archivistremarks($param1)
{
    try {
        $conn = dbconnect();


        $query = "select pav.*,ave.value from product_attribute_value pav,attribute_value_ecomc ave 
where 
pav.product_id = '%s' and 
pav.attribute_value_id = ave.attr_value_id and 
ave.attr_id = '205'";
        $sql = sprintf($query, $param1);
        $q = $conn->prepare($sql);

        $q->execute();
        $q->setFetchMode(PDO::FETCH_ASSOC);

        return $cust_addr = $q->fetch();
    } catch (PDOException $pe) {
        echo db_error($pe->getMessage());
    }
}

function va_noofpublications($param1)
{
    try {
        $conn = dbconnect();


        $query = "select pav.*,ave.value from product_attribute_value pav,attribute_value_ecomc ave 
where 
pav.product_id = '%s' and 
pav.attribute_value_id = ave.attr_value_id and 
ave.attr_id = '227'";
        $sql = sprintf($query, $param1);
        $q = $conn->prepare($sql);

        $q->execute();
        $q->setFetchMode(PDO::FETCH_ASSOC);

        return $cust_addr = $q->fetch();
    } catch (PDOException $pe) {
        echo db_error($pe->getMessage());
    }
}

function singleproducts($param1)
{
    try {
        $conn = dbconnect();


        $query = "select * from products_ecomc  
where 
prodid = '%s' ";
        $sql = sprintf($query, $param1);
        $q = $conn->prepare($sql);

        $q->execute();
        $q->setFetchMode(PDO::FETCH_ASSOC);

        return $cust_addr = $q->fetch();
    } catch (PDOException $pe) {
        echo db_error($pe->getMessage());
    }
}

function lastinsertattrval($param1)
{
    try {
        $conn = dbconnect();


        $query = "SELECT max(attr_value_id) lastattrval1 FROM attribute_value_ecomc where attr_id='%s' ";
        $sql = sprintf($query, $param1);
        $q = $conn->prepare($sql);

        $q->execute();
        $q->setFetchMode(PDO::FETCH_ASSOC);

        return $cust_addr = $q->fetch();
    } catch (PDOException $pe) {
        echo db_error($pe->getMessage());
    }
}

function getnoofpublications($param1)
{
    try {
        $conn = dbconnect();


        $query = "select ave.value from product_attribute_value pav,attribute_value_ecomc ave 
where 
pav.product_id = '%s' and 
pav.attribute_value_id = ave.attr_value_id and 
ave.attr_id = '227'";
        $sql = sprintf($query, $param1);
        $q = $conn->prepare($sql);

        $q->execute();
        $q->setFetchMode(PDO::FETCH_ASSOC);

        return $cust_addr = $q->fetch();
    } catch (PDOException $pe) {
        echo db_error($pe->getMessage());
    }
}

function singleexhibition($param1)
{
    try {
        $conn = dbconnect();


        $query = "select * from exhibition  
where 
id = '%s' ";
        $sql = sprintf($query, $param1);
        $q = $conn->prepare($sql);

        $q->execute();
        $q->setFetchMode(PDO::FETCH_ASSOC);

        return $cust_addr = $q->fetch();
    } catch (PDOException $pe) {
        echo db_error($pe->getMessage());
    }
}

function singlepodcast($param1)
{
    try {
        $conn = dbconnect();


        $query = "select * from podcast  
where 
episode_id = '%s' ";
        $sql = sprintf($query, $param1);
        $q = $conn->prepare($sql);

        $q->execute();
        $q->setFetchMode(PDO::FETCH_ASSOC);

        return $cust_addr = $q->fetch();
    } catch (PDOException $pe) {
        echo db_error($pe->getMessage());
    }
}

function singlePress($param1)
{
    try {
        $conn = dbconnect();


        $query = "select * from in_the_press where press_id = '%s' ";
        $sql = sprintf($query, $param1);
        $q = $conn->prepare($sql);

        $q->execute();
        $q->setFetchMode(PDO::FETCH_ASSOC);

        return $cust_addr = $q->fetch();
    } catch (PDOException $pe) {
        echo db_error($pe->getMessage());
    }
}

function singlePhoto($param1)
{
    try {
        $conn = dbconnect();


        $query = "select * from photobook_tbl where event_id = '%s' ";
        $sql = sprintf($query, $param1);
        $q = $conn->prepare($sql);

        $q->execute();
        $q->setFetchMode(PDO::FETCH_ASSOC);

        return $cust_addr = $q->fetch();
    } catch (PDOException $pe) {
        echo db_error($pe->getMessage());
    }
}

function singleexhibitionartist($param1)
{
    try {
        $conn = dbconnect();


        $query = "select * from exhibition_artists  
where 
id = '%s' ";
        $sql = sprintf($query, $param1);
        $q = $conn->prepare($sql);

        $q->execute();
        $q->setFetchMode(PDO::FETCH_ASSOC);

        return $cust_addr = $q->fetch();
    } catch (PDOException $pe) {
        echo db_error($pe->getMessage());
    }
}

function allexhibition()
{
    try {
        $conn = dbconnect();
        $query = "SELECT * FROM exhibition";
        $sql = sprintf($query);
        $q = $conn->prepare($sql);

        $q->execute();
        $q->setFetchMode(PDO::FETCH_ASSOC);

        return $prod = $q->fetchAll();
    } catch (PDOException $pe) {
        echo db_error($pe->getMessage());
    }
}

function allmedium()
{
    try {
        $conn = dbconnect();
        $query = "SELECT * FROM exhibition_medium where status = '1'";
        $sql = sprintf($query);
        $q = $conn->prepare($sql);

        $q->execute();
        $q->setFetchMode(PDO::FETCH_ASSOC);

        return $prod = $q->fetchAll();
    } catch (PDOException $pe) {
        echo db_error($pe->getMessage());
    }
}

function singlepainting($param1)
{
    try {
        $conn = dbconnect();


        $query = "select * from exhibition_paintings  
where 
id = '%s' ";
        $sql = sprintf($query, $param1);
        $q = $conn->prepare($sql);

        $q->execute();
        $q->setFetchMode(PDO::FETCH_ASSOC);

        return $cust_addr = $q->fetch();
    } catch (PDOException $pe) {
        echo db_error($pe->getMessage());
    }
}

function singlemedium($param1)
{
    try {
        $conn = dbconnect();


        $query = "select * from exhibition_medium  
where 
id = '%s' ";
        $sql = sprintf($query, $param1);
        $q = $conn->prepare($sql);

        $q->execute();
        $q->setFetchMode(PDO::FETCH_ASSOC);

        return $cust_addr = $q->fetch();
    } catch (PDOException $pe) {
        echo db_error($pe->getMessage());
    }
}

function last_entered_painting($param1)
{
    try {
        $conn = dbconnect();


        $query = "select * from exhibition_paintings where id="
                . "(SELECT max(id) FROM exhibition_paintings where artist_id='%s') ";
        $sql = sprintf($query, $param1);
        $q = $conn->prepare($sql);

        $q->execute();
        $q->setFetchMode(PDO::FETCH_ASSOC);

        return $cust_addr = $q->fetch();
    } catch (PDOException $pe) {
        echo db_error($pe->getMessage());
    }
}

function allexhibitionofpaintings($param1)
{
    try {
        $conn = dbconnect();
        $query = "SELECT exhibition_paintings_relation.*,exhibition.exhibition_name,exhibition.status ex_status "
                . "FROM exhibition_paintings_relation,exhibition "
                . "where exhibition_paintings_relation.exhibition_id = exhibition.id and "
                . "exhibition_paintings_relation.painting_id = '%s'";
        $sql = sprintf($query, $param1);
        $q = $conn->prepare($sql);

        $q->execute();
        $q->setFetchMode(PDO::FETCH_ASSOC);

        return $prod = $q->fetchAll();
    } catch (PDOException $pe) {
        echo db_error($pe->getMessage());
    }
}

function allexhibitionnotin($param1, $param2)
{
    try {
        $conn = dbconnect();



        if ($param2 != '') {
            $query = "SELECT * "
                    . "FROM exhibition "
                    . "where  "
                    . "exhibition.id not in (%s)";

            $sql = sprintf($query, $param1, $param2);
        } else {
            $query = "SELECT * "
                    . "FROM exhibition ";

            $sql = sprintf($query, $param1);
        }
        $q = $conn->prepare($sql);

        $q->execute();
        $q->setFetchMode(PDO::FETCH_ASSOC);

        return $prod = $q->fetchAll();
    } catch (PDOException $pe) {
        echo db_error($pe->getMessage());
    }
}

function count_downloaded_pdf($param1)
{
    try {
        $conn = dbconnect();


        $query = "select count(*) count_download from customer_va_download_history where customer_id='%s' ";
        $sql = sprintf($query, $param1);
        $q = $conn->prepare($sql);

        $q->execute();
        $q->setFetchMode(PDO::FETCH_ASSOC);

        return $cust_addr = $q->fetch();
    } catch (PDOException $pe) {
        echo db_error($pe->getMessage());
    }
}

function get_va_allclassification_options1($conn = null, $hc = array())
{
    $conn = dbconnect();
    $qry = "select ave.* from attribute_value_ecomc ave where ave.attr_id = '221' order by ave.value";
    $q = $conn->prepare($qry);
    $q->execute();
    $q->setFetchMode(PDO::FETCH_ASSOC);
    $msl = '';
    while ($row = $q->fetch()) {
        $msl .= '<option value="' . $row['value'] . '">' . stripslashes($row['value']) . '</option>';
        $hc[] = array(
            'id' => $row['attr_value_id'],
            'name' => $row['value']
        );
    }


    return array(
        's' => '<select id="classification1" name="classification1[]" multiple="multiple">' . $msl . '</select>',
        'h' => $hc,
        'op' => $msl
    );
}

function get_va_allclassification_options2($conn = null, $hc = array())
{
    $conn = dbconnect();
    $qry = "select ave.* from attribute_value_ecomc ave where ave.attr_id = '221' order by ave.value";
    $q = $conn->prepare($qry);
    $q->execute();
    $q->setFetchMode(PDO::FETCH_ASSOC);
    $msl = '';
    while ($row = $q->fetch()) {
        $msl .= '<option value="' . $row['value'] . '">' . stripslashes($row['value']) . '</option>';
        $hc[] = array(
            'id' => $row['attr_value_id'],
            'name' => $row['value']
        );
    }


    return array(
        's' => '<select id="classification2" name="classification2[]" multiple="multiple">' . $msl . '</select>',
        'h' => $hc,
        'op' => $msl
    );
}

function get_va_allclassification_options3($conn = null, $hc = array())
{
    $conn = dbconnect();
    $qry = "select ave.* from attribute_value_ecomc ave where ave.attr_id = '221' order by ave.value";
    $q = $conn->prepare($qry);
    $q->execute();
    $q->setFetchMode(PDO::FETCH_ASSOC);
    $msl = '';
    while ($row = $q->fetch()) {
        $msl .= '<option value="' . $row['value'] . '">' . stripslashes($row['value']) . '</option>';
        $hc[] = array(
            'id' => $row['attr_value_id'],
            'name' => $row['value']
        );
    }


    return array(
        's' => '<select id="classification3" name="classification3[]" multiple="multiple">' . $msl . '</select>',
        'h' => $hc,
        'op' => $msl
    );
}

function get_va_allclassification_options4($conn = null, $hc = array())
{
    $conn = dbconnect();
    $qry = "select ave.* from attribute_value_ecomc ave where ave.attr_id = '221' order by ave.value";
    $q = $conn->prepare($qry);
    $q->execute();
    $q->setFetchMode(PDO::FETCH_ASSOC);
    $msl = '';
    while ($row = $q->fetch()) {
        $msl .= '<option value="' . $row['value'] . '">' . stripslashes($row['value']) . '</option>';
        $hc[] = array(
            'id' => $row['attr_value_id'],
            'name' => $row['value']
        );
    }


    return array(
        's' => '<select id="classification4" name="classification4[]" multiple="multiple">' . $msl . '</select>',
        'h' => $hc,
        'op' => $msl
    );
}

function get_va_artworkyear_options($conn = null, $hc = array())
{
    $conn = dbconnect();

    $qry = "select distinct ave.attr_id,ave.value 
from product_type_attribute_key ptak,
attr_common_flds_ecomc acfe, attribute_value_ecomc ave 
where 
ptak.attribute_id = acfe.id 
and acfe.id = '210' 
and ptak.p_type_id = '19' 
and ave.attr_id = acfe.id 
and ave.value <> '' 
order by ave.value";

    $q = $conn->prepare($qry);
    $q->execute();
    $q->setFetchMode(PDO::FETCH_ASSOC);
    $msl = '';



    while ($row = $q->fetch()) {
        $msl .= '<option value="' . $row['value'] . '">' . stripslashes($row['value']) . '</option>';
        $hc[] = array(
            //'id' => $row['attr_value_id'],
            'name' => $row['value']
        );
    }


    return array(
        's' => '<select id="artworkyear" name="artworkyear[]" multiple="multiple">' . $msl . '</select>',
        'h' => $hc,
        'op' => $msl
    );
}

function get_va_medium_options($conn = null, $hc = array())
{
    $conn = dbconnect();

    $qry = "select distinct ave.attr_id,ave.value 
from product_type_attribute_key ptak,
attr_common_flds_ecomc acfe, attribute_value_ecomc ave 
where 
ptak.attribute_id = acfe.id 
and acfe.id = '189' 
and ptak.p_type_id = '19' 
and ave.attr_id = acfe.id 
and ave.value <> '' 
order by ave.value";

    $q = $conn->prepare($qry);
    $q->execute();
    $q->setFetchMode(PDO::FETCH_ASSOC);
    $msl = '';



    while ($row = $q->fetch()) {
        $msl .= '<option value="' . $row['value'] . '">' . stripslashes($row['value']) . '</option>';
        $hc[] = array(
            //'id' => $row['attr_value_id'],
            'name' => $row['value']
        );
    }


    return array(
        's' => '<select id="medium" name="medium[]" multiple="multiple">' . $msl . '</select>',
        'h' => $hc,
        'op' => $msl
    );
}

function get_va_publicationyear_options($conn = null, $hc = array())
{
    $conn = dbconnect();

    $qry = "select distinct ave.attr_id,ave.value 
from product_type_attribute_key ptak,
attr_common_flds_ecomc acfe, attribute_value_ecomc ave 
where 
ptak.attribute_id = acfe.id 
and acfe.id = '213' 
and ptak.p_type_id = '19' 
and ave.attr_id = acfe.id 
and ave.value <> '' 
order by ave.value";

    $q = $conn->prepare($qry);
    $q->execute();
    $q->setFetchMode(PDO::FETCH_ASSOC);
    $msl = '';

//    $pubarr = $q->fetchAll();
//
//        $html = '';
//
//        foreach ($pubarr as $key1 => $val1) {
//            $html .= '<option value="' . $val1['value'] . '">' . $val1['value'] . '</option>';
//        }
//
//        return $html;


    while ($row = $q->fetch()) {
        $msl .= '<option value="' . $row['value'] . '">' . stripslashes($row['value']) . '</option>';
        $hc[] = array(
            //'id' => $row['attr_value_id'],
            'name' => $row['value']
        );
    }


    return array(
        's' => '<select id="publicationyear" name="publicationyear[]" multiple="multiple">' . $msl . '</select>',
        'h' => $hc,
        'op' => $msl
    );
}

function get_va_publicationyear_optionsall($conn = null, $artiststr, $classificationstr)
{
    $conn = dbconnect();

    if ($artiststr != "" && $classificationstr != "") {
        $qry = "select distinct inn.v AS value from
(SELECT p.prodid AS id, p.prodname AS n, f.attribute_name AS an, COUNT(v.value) as cn, v.`value` AS v 
FROM 
products_ecomc AS p 
JOIN product_attribute_value AS t ON p.prodid = t.product_id 
JOIN attribute_value_ecomc AS v ON t.attribute_value_id = v.attr_value_id 
JOIN attr_common_flds_ecomc AS f ON v.attr_id = f.id 
WHERE 
t.product_id IN 
( select a.product_id 
 from 
 (SELECT t.product_id 
  FROM products_ecomc p 
  LEFT JOIN product_attribute_value t ON p.prodid = t.product_id 
  LEFT JOIN attribute_value_ecomc v ON t.attribute_value_id = v.attr_value_id 
  LEFT JOIN attr_common_flds_ecomc f ON v.attr_id = f.id 
  where 
  p.category_id = 19 
  
and f.id = '187' 
and v.value IN (" . $artiststr . ") 

  GROUP BY t.product_id
 )a , 
(SELECT t.product_id 
 FROM 
 products_ecomc p 
 JOIN product_attribute_value t ON p.prodid = t.product_id 
 JOIN attribute_value_ecomc v ON t.attribute_value_id = v.attr_value_id 
 JOIN attr_common_flds_ecomc f ON v.attr_id = f.id 
 where 
 p.category_id = 19 
 
and f.id = '221' 
and v.value IN (" . $classificationstr . ") 
 

 GROUP BY t.product_id
)b 
where 
a.product_id = b.product_id 
 
) 

GROUP BY t.attribute_value_id 
 )inn 

where an = 'va_year_publication' 
order by inn.v";
    } elseif ($artiststr == "" && $classificationstr != "") {
        $qry = "select distinct inn.v AS value from
(SELECT p.prodid AS id, p.prodname AS n, f.attribute_name AS an, COUNT(v.value) as cn, v.`value` AS v 
FROM 
products_ecomc AS p 
JOIN product_attribute_value AS t ON p.prodid = t.product_id 
JOIN attribute_value_ecomc AS v ON t.attribute_value_id = v.attr_value_id 
JOIN attr_common_flds_ecomc AS f ON v.attr_id = f.id 
WHERE 
t.product_id IN 
( select a.product_id 
 from 
  
(SELECT t.product_id 
 FROM 
 products_ecomc p 
 JOIN product_attribute_value t ON p.prodid = t.product_id 
 JOIN attribute_value_ecomc v ON t.attribute_value_id = v.attr_value_id 
 JOIN attr_common_flds_ecomc f ON v.attr_id = f.id 
 where 
 p.category_id = 19 
 
and f.id = '221' 
and v.value IN (" . $classificationstr . ") 
 

 GROUP BY t.product_id
)b 
) 
GROUP BY t.attribute_value_id 
 )inn 

where an = 'va_year_publication' 
order by inn.v";
    } elseif ($artiststr != "" && $classificationstr == "") {
        $qry = "select distinct inn.v AS value from
(SELECT p.prodid AS id, p.prodname AS n, f.attribute_name AS an, COUNT(v.value) as cn, v.`value` AS v 
FROM 
products_ecomc AS p 
JOIN product_attribute_value AS t ON p.prodid = t.product_id 
JOIN attribute_value_ecomc AS v ON t.attribute_value_id = v.attr_value_id 
JOIN attr_common_flds_ecomc AS f ON v.attr_id = f.id 
WHERE 
t.product_id IN 
( select a.product_id 
 from 
 (SELECT t.product_id 
  FROM products_ecomc p 
  LEFT JOIN product_attribute_value t ON p.prodid = t.product_id 
  LEFT JOIN attribute_value_ecomc v ON t.attribute_value_id = v.attr_value_id 
  LEFT JOIN attr_common_flds_ecomc f ON v.attr_id = f.id 
  where 
  p.category_id = 19 
  
and f.id = '187' 
and v.value IN (" . $artiststr . ") 

  GROUP BY t.product_id
 )a 
 
) 

GROUP BY t.attribute_value_id 
 )inn 

where an = 'va_year_publication' 
order by inn.v";
    }




    //return $qry;

    $q = $conn->prepare($qry);
    $q->execute();
    $q->setFetchMode(PDO::FETCH_ASSOC);
    $msl = '';


    $pubarr = $q->fetchAll();

    $html = '';

    foreach ($pubarr as $key1 => $val1) {
        $html .= '<option value="' . $val1['value'] . '">' . $val1['value'] . '</option>';
    }

    return $html;


//    while ($row = $q->fetch()) {
//
//        $msl .= '<option value="' . $row['value'] . '">' . stripslashes($row['value']) . '</option>';
//        $hc[] = array(
//            //'id' => $row['attr_value_id'],
//            'name' => $row['value']
//        );
//    }
//
//
//    return array(
//        's' => '<select id="publicationyear" name="publicationyear[]" multiple="multiple">' . $msl . '</select>',
//        'h' => $hc,
//        'op' => $msl
//    );
}

function get_va_artworkyear_optionsall($conn = null, $artiststr, $classificationstr)
{
    $conn = dbconnect();

    if ($artiststr != "" && $classificationstr != "") {
        $qry = "select distinct inn.v AS value from
(SELECT p.prodid AS id, p.prodname AS n, f.attribute_name AS an, COUNT(v.value) as cn, v.`value` AS v 
FROM 
products_ecomc AS p 
JOIN product_attribute_value AS t ON p.prodid = t.product_id 
JOIN attribute_value_ecomc AS v ON t.attribute_value_id = v.attr_value_id 
JOIN attr_common_flds_ecomc AS f ON v.attr_id = f.id 
WHERE 
t.product_id IN 
( select a.product_id 
 from 
 (SELECT t.product_id 
  FROM products_ecomc p 
  LEFT JOIN product_attribute_value t ON p.prodid = t.product_id 
  LEFT JOIN attribute_value_ecomc v ON t.attribute_value_id = v.attr_value_id 
  LEFT JOIN attr_common_flds_ecomc f ON v.attr_id = f.id 
  where 
  p.category_id = 19 
  
and f.id = '187' 
and v.value IN (" . $artiststr . ") 

  GROUP BY t.product_id
 )a , 
(SELECT t.product_id 
 FROM 
 products_ecomc p 
 JOIN product_attribute_value t ON p.prodid = t.product_id 
 JOIN attribute_value_ecomc v ON t.attribute_value_id = v.attr_value_id 
 JOIN attr_common_flds_ecomc f ON v.attr_id = f.id 
 where 
 p.category_id = 19 
 
and f.id = '221' 
and v.value IN (" . $classificationstr . ") 
 

 GROUP BY t.product_id
)b 
where 
a.product_id = b.product_id 
 
) 

GROUP BY t.attribute_value_id 
 )inn 

where an = 'va_year_artwork' order by inn.v";
    } elseif ($artiststr == "" && $classificationstr != "") {
        $qry = "select distinct inn.v AS value from
(SELECT p.prodid AS id, p.prodname AS n, f.attribute_name AS an, COUNT(v.value) as cn, v.`value` AS v 
FROM 
products_ecomc AS p 
JOIN product_attribute_value AS t ON p.prodid = t.product_id 
JOIN attribute_value_ecomc AS v ON t.attribute_value_id = v.attr_value_id 
JOIN attr_common_flds_ecomc AS f ON v.attr_id = f.id 
WHERE 
t.product_id IN 
( select a.product_id 
 from 
 
(SELECT t.product_id 
 FROM 
 products_ecomc p 
 JOIN product_attribute_value t ON p.prodid = t.product_id 
 JOIN attribute_value_ecomc v ON t.attribute_value_id = v.attr_value_id 
 JOIN attr_common_flds_ecomc f ON v.attr_id = f.id 
 where 
 p.category_id = 19 
 
and f.id = '221' 
and v.value IN (" . $classificationstr . ") 
 

 GROUP BY t.product_id
)b 

 
) 

GROUP BY t.attribute_value_id 
 )inn 

where an = 'va_year_artwork' order by inn.v";
    } elseif ($artiststr != "" && $classificationstr == "") {
        $qry = "select distinct inn.v AS value from
(SELECT p.prodid AS id, p.prodname AS n, f.attribute_name AS an, COUNT(v.value) as cn, v.`value` AS v 
FROM 
products_ecomc AS p 
JOIN product_attribute_value AS t ON p.prodid = t.product_id 
JOIN attribute_value_ecomc AS v ON t.attribute_value_id = v.attr_value_id 
JOIN attr_common_flds_ecomc AS f ON v.attr_id = f.id 
WHERE 
t.product_id IN 
( select a.product_id 
 from 
 (SELECT t.product_id 
  FROM products_ecomc p 
  LEFT JOIN product_attribute_value t ON p.prodid = t.product_id 
  LEFT JOIN attribute_value_ecomc v ON t.attribute_value_id = v.attr_value_id 
  LEFT JOIN attr_common_flds_ecomc f ON v.attr_id = f.id 
  where 
  p.category_id = 19 
  
and f.id = '187' 
and v.value IN (" . $artiststr . ") 

  GROUP BY t.product_id
 )a 
 
) 

GROUP BY t.attribute_value_id 
 )inn 

where an = 'va_year_artwork' order by inn.v";
    }




    //return $qry;

    $q = $conn->prepare($qry);
    $q->execute();
    $q->setFetchMode(PDO::FETCH_ASSOC);
    $msl = '';


    $pubarr = $q->fetchAll();

    $html = '';

    foreach ($pubarr as $key1 => $val1) {
        $html .= '<option value="' . $val1['value'] . '">' . $val1['value'] . '</option>';
    }

    return $html;
}










function get_va_medium_optionsall($conn = null, $artiststr, $classificationstr)
{
    $conn = dbconnect();

    if ($artiststr != "" && $classificationstr != "") {
        $qry = "select distinct inn.v AS value from
(SELECT p.prodid AS id, p.prodname AS n, f.attribute_name AS an, COUNT(v.value) as cn, v.`value` AS v 
FROM 
products_ecomc AS p 
JOIN product_attribute_value AS t ON p.prodid = t.product_id 
JOIN attribute_value_ecomc AS v ON t.attribute_value_id = v.attr_value_id 
JOIN attr_common_flds_ecomc AS f ON v.attr_id = f.id 
WHERE 
t.product_id IN 
( select a.product_id 
 from 
 (SELECT t.product_id 
  FROM products_ecomc p 
  LEFT JOIN product_attribute_value t ON p.prodid = t.product_id 
  LEFT JOIN attribute_value_ecomc v ON t.attribute_value_id = v.attr_value_id 
  LEFT JOIN attr_common_flds_ecomc f ON v.attr_id = f.id 
  where 
  p.category_id = 19 
  
and f.id = '187' 
and v.value IN (" . $artiststr . ") 

  GROUP BY t.product_id
 )a , 
(SELECT t.product_id 
 FROM 
 products_ecomc p 
 JOIN product_attribute_value t ON p.prodid = t.product_id 
 JOIN attribute_value_ecomc v ON t.attribute_value_id = v.attr_value_id 
 JOIN attr_common_flds_ecomc f ON v.attr_id = f.id 
 where 
 p.category_id = 19 
 
and f.id = '221' 
and v.value IN (" . $classificationstr . ") 
 

 GROUP BY t.product_id
)b 
where 
a.product_id = b.product_id 
 
) 

GROUP BY t.attribute_value_id 
 )inn 

where an = 'va_medium' order by inn.v";
    } elseif ($artiststr == "" && $classificationstr != "") {
        $qry = "select distinct inn.v AS value from
(SELECT p.prodid AS id, p.prodname AS n, f.attribute_name AS an, COUNT(v.value) as cn, v.`value` AS v 
FROM 
products_ecomc AS p 
JOIN product_attribute_value AS t ON p.prodid = t.product_id 
JOIN attribute_value_ecomc AS v ON t.attribute_value_id = v.attr_value_id 
JOIN attr_common_flds_ecomc AS f ON v.attr_id = f.id 
WHERE 
t.product_id IN 
( select a.product_id 
 from 
 
(SELECT t.product_id 
 FROM 
 products_ecomc p 
 JOIN product_attribute_value t ON p.prodid = t.product_id 
 JOIN attribute_value_ecomc v ON t.attribute_value_id = v.attr_value_id 
 JOIN attr_common_flds_ecomc f ON v.attr_id = f.id 
 where 
 p.category_id = 19 
 
and f.id = '221' 
and v.value IN (" . $classificationstr . ") 
 

 GROUP BY t.product_id
)b 

 
) 

GROUP BY t.attribute_value_id 
 )inn 

where an = 'va_medium' order by inn.v";
    } elseif ($artiststr != "" && $classificationstr == "") {
        $qry = "select distinct inn.v AS value from
(SELECT p.prodid AS id, p.prodname AS n, f.attribute_name AS an, COUNT(v.value) as cn, v.`value` AS v 
FROM 
products_ecomc AS p 
JOIN product_attribute_value AS t ON p.prodid = t.product_id 
JOIN attribute_value_ecomc AS v ON t.attribute_value_id = v.attr_value_id 
JOIN attr_common_flds_ecomc AS f ON v.attr_id = f.id 
WHERE 
t.product_id IN 
( select a.product_id 
 from 
 (SELECT t.product_id 
  FROM products_ecomc p 
  LEFT JOIN product_attribute_value t ON p.prodid = t.product_id 
  LEFT JOIN attribute_value_ecomc v ON t.attribute_value_id = v.attr_value_id 
  LEFT JOIN attr_common_flds_ecomc f ON v.attr_id = f.id 
  where 
  p.category_id = 19 
  
and f.id = '187' 
and v.value IN (" . $artiststr . ") 

  GROUP BY t.product_id
 )a 
 
) 

GROUP BY t.attribute_value_id 
 )inn 

where an = 'va_medium' order by inn.v";
    }




    //return $qry;

    $q = $conn->prepare($qry);
    $q->execute();
    $q->setFetchMode(PDO::FETCH_ASSOC);
    $msl = '';


    $pubarr = $q->fetchAll();

    $html = '';

    foreach ($pubarr as $key1 => $val1) {
        $html .= '<option value="' . $val1['value'] . '">' . $val1['value'] . '</option>';
    }

    return $html;
}







function allpublicationyearsnew_optionsall($conn = null, $artiststr, $classificationstr)
{
    try {
        $conn = dbconnect();
        if ($artiststr != "" && $classificationstr != "") {
            $qry = "select distinct inn.v AS value from
(SELECT p.prodid AS id, p.prodname AS n, f.attribute_name AS an, COUNT(v.value) as cn, v.`value` AS v 
FROM 
products_ecomc AS p 
JOIN product_attribute_value AS t ON p.prodid = t.product_id 
JOIN attribute_value_ecomc AS v ON t.attribute_value_id = v.attr_value_id 
JOIN attr_common_flds_ecomc AS f ON v.attr_id = f.id 
WHERE 
t.product_id IN 
( select a.product_id 
 from 
 (SELECT t.product_id 
  FROM products_ecomc p 
  LEFT JOIN product_attribute_value t ON p.prodid = t.product_id 
  LEFT JOIN attribute_value_ecomc v ON t.attribute_value_id = v.attr_value_id 
  LEFT JOIN attr_common_flds_ecomc f ON v.attr_id = f.id 
  where 
  p.category_id = 19 
  
and f.id = '187' 
and v.value IN (" . $artiststr . ") 

  GROUP BY t.product_id
 )a , 
(SELECT t.product_id 
 FROM 
 products_ecomc p 
 JOIN product_attribute_value t ON p.prodid = t.product_id 
 JOIN attribute_value_ecomc v ON t.attribute_value_id = v.attr_value_id 
 JOIN attr_common_flds_ecomc f ON v.attr_id = f.id 
 where 
 p.category_id = 19 
 
and f.id = '221' 
and v.value IN (" . $classificationstr . ") 
 

 GROUP BY t.product_id
)b 
where 
a.product_id = b.product_id 
 
) 

GROUP BY t.attribute_value_id 
 )inn 

where an = 'va_year_publication' 
order by inn.v";
        } elseif ($artiststr == "" && $classificationstr != "") {
            $qry = "select distinct inn.v AS value from
(SELECT p.prodid AS id, p.prodname AS n, f.attribute_name AS an, COUNT(v.value) as cn, v.`value` AS v 
FROM 
products_ecomc AS p 
JOIN product_attribute_value AS t ON p.prodid = t.product_id 
JOIN attribute_value_ecomc AS v ON t.attribute_value_id = v.attr_value_id 
JOIN attr_common_flds_ecomc AS f ON v.attr_id = f.id 
WHERE 
t.product_id IN 
( select a.product_id 
 from 
  
(SELECT t.product_id 
 FROM 
 products_ecomc p 
 JOIN product_attribute_value t ON p.prodid = t.product_id 
 JOIN attribute_value_ecomc v ON t.attribute_value_id = v.attr_value_id 
 JOIN attr_common_flds_ecomc f ON v.attr_id = f.id 
 where 
 p.category_id = 19 
 
and f.id = '221' 
and v.value IN (" . $classificationstr . ") 
 

 GROUP BY t.product_id
)b 
) 
GROUP BY t.attribute_value_id 
 )inn 

where an = 'va_year_publication' 
order by inn.v";
        } elseif ($artiststr != "" && $classificationstr == "") {
            $qry = "select distinct inn.v AS value from
(SELECT p.prodid AS id, p.prodname AS n, f.attribute_name AS an, COUNT(v.value) as cn, v.`value` AS v 
FROM 
products_ecomc AS p 
JOIN product_attribute_value AS t ON p.prodid = t.product_id 
JOIN attribute_value_ecomc AS v ON t.attribute_value_id = v.attr_value_id 
JOIN attr_common_flds_ecomc AS f ON v.attr_id = f.id 
WHERE 
t.product_id IN 
( select a.product_id 
 from 
 (SELECT t.product_id 
  FROM products_ecomc p 
  LEFT JOIN product_attribute_value t ON p.prodid = t.product_id 
  LEFT JOIN attribute_value_ecomc v ON t.attribute_value_id = v.attr_value_id 
  LEFT JOIN attr_common_flds_ecomc f ON v.attr_id = f.id 
  where 
  p.category_id = 19 
  
and f.id = '187' 
and v.value IN (" . $artiststr . ") 

  GROUP BY t.product_id
 )a 
 
) 

GROUP BY t.attribute_value_id 
 )inn 

where an = 'va_year_publication' 
order by inn.v";
        }

        $q = $conn->prepare($qry);
        $q->execute();
        $q->setFetchMode(PDO::FETCH_ASSOC);

        $pubarr = $q->fetchAll();

        $html = '';

        foreach ($pubarr as $key1 => $val1) {
            $html .= '<option value="' . $val1['value'] . '">' . $val1['value'] . '</option>';
        }

        return $html;
    } catch (PDOException $pe) {
        echo db_error($pe->getMessage());
    }
}

function allartworkyearsnew_optionsall($conn = null, $artiststr, $classificationstr)
{
    try {
        $conn = dbconnect();
        if ($artiststr != "" && $classificationstr != "") {
            $qry = "select distinct inn.v AS value from
(SELECT p.prodid AS id, p.prodname AS n, f.attribute_name AS an, COUNT(v.value) as cn, v.`value` AS v 
FROM 
products_ecomc AS p 
JOIN product_attribute_value AS t ON p.prodid = t.product_id 
JOIN attribute_value_ecomc AS v ON t.attribute_value_id = v.attr_value_id 
JOIN attr_common_flds_ecomc AS f ON v.attr_id = f.id 
WHERE 
t.product_id IN 
( select a.product_id 
 from 
 (SELECT t.product_id 
  FROM products_ecomc p 
  LEFT JOIN product_attribute_value t ON p.prodid = t.product_id 
  LEFT JOIN attribute_value_ecomc v ON t.attribute_value_id = v.attr_value_id 
  LEFT JOIN attr_common_flds_ecomc f ON v.attr_id = f.id 
  where 
  p.category_id = 19 
  
and f.id = '187' 
and v.value IN (" . $artiststr . ") 

  GROUP BY t.product_id
 )a , 
(SELECT t.product_id 
 FROM 
 products_ecomc p 
 JOIN product_attribute_value t ON p.prodid = t.product_id 
 JOIN attribute_value_ecomc v ON t.attribute_value_id = v.attr_value_id 
 JOIN attr_common_flds_ecomc f ON v.attr_id = f.id 
 where 
 p.category_id = 19 
 
and f.id = '221' 
and v.value IN (" . $classificationstr . ") 
 

 GROUP BY t.product_id
)b 
where 
a.product_id = b.product_id 
 
) 

GROUP BY t.attribute_value_id 
 )inn 

where an = 'va_year_artwork' order by inn.v";
        } elseif ($artiststr == "" && $classificationstr != "") {
            $qry = "select distinct inn.v AS value from
(SELECT p.prodid AS id, p.prodname AS n, f.attribute_name AS an, COUNT(v.value) as cn, v.`value` AS v 
FROM 
products_ecomc AS p 
JOIN product_attribute_value AS t ON p.prodid = t.product_id 
JOIN attribute_value_ecomc AS v ON t.attribute_value_id = v.attr_value_id 
JOIN attr_common_flds_ecomc AS f ON v.attr_id = f.id 
WHERE 
t.product_id IN 
( select a.product_id 
 from 
 
(SELECT t.product_id 
 FROM 
 products_ecomc p 
 JOIN product_attribute_value t ON p.prodid = t.product_id 
 JOIN attribute_value_ecomc v ON t.attribute_value_id = v.attr_value_id 
 JOIN attr_common_flds_ecomc f ON v.attr_id = f.id 
 where 
 p.category_id = 19 
 
and f.id = '221' 
and v.value IN (" . $classificationstr . ") 
 

 GROUP BY t.product_id
)b 

 
) 

GROUP BY t.attribute_value_id 
 )inn 

where an = 'va_year_artwork' order by inn.v";
        } elseif ($artiststr != "" && $classificationstr == "") {
            $qry = "select distinct inn.v AS value from
(SELECT p.prodid AS id, p.prodname AS n, f.attribute_name AS an, COUNT(v.value) as cn, v.`value` AS v 
FROM 
products_ecomc AS p 
JOIN product_attribute_value AS t ON p.prodid = t.product_id 
JOIN attribute_value_ecomc AS v ON t.attribute_value_id = v.attr_value_id 
JOIN attr_common_flds_ecomc AS f ON v.attr_id = f.id 
WHERE 
t.product_id IN 
( select a.product_id 
 from 
 (SELECT t.product_id 
  FROM products_ecomc p 
  LEFT JOIN product_attribute_value t ON p.prodid = t.product_id 
  LEFT JOIN attribute_value_ecomc v ON t.attribute_value_id = v.attr_value_id 
  LEFT JOIN attr_common_flds_ecomc f ON v.attr_id = f.id 
  where 
  p.category_id = 19 
  
and f.id = '187' 
and v.value IN (" . $artiststr . ") 

  GROUP BY t.product_id
 )a 
 
) 

GROUP BY t.attribute_value_id 
 )inn 

where an = 'va_year_artwork' order by inn.v";
        }


//        $qry = "select distinct ave.attr_id,ave.value
        //from product_type_attribute_key ptak,
        //attr_common_flds_ecomc acfe, attribute_value_ecomc ave
        //where
        //ptak.attribute_id = acfe.id
        //and acfe.id = '213'
        //and ptak.p_type_id = '19'
        //and ave.attr_id = acfe.id
        //and ave.value <> ''
        //order by ave.value";

        $q = $conn->prepare($qry);
        $q->execute();
        $q->setFetchMode(PDO::FETCH_ASSOC);

        $pubarr = $q->fetchAll();

        $html = '';

        foreach ($pubarr as $key1 => $val1) {
            $html .= '<option value="' . $val1['value'] . '">' . $val1['value'] . '</option>';
        }

        return $html;
    } catch (PDOException $pe) {
        echo db_error($pe->getMessage());
    }
}

function allpublicationyears()
{
    try {
        $conn = dbconnect();
        $query = "SELECT distinct value FROM `attribute_value_ecomc` WHERE `attr_id` = 213 order by value";
        $sql = sprintf($query);
        $q = $conn->prepare($sql);

        $q->execute();
        $q->setFetchMode(PDO::FETCH_ASSOC);

        $pubarr = $q->fetchAll();

        $html = '';

        foreach ($pubarr as $key1 => $val1) {
            $html .= '<option value="' . $val1['value'] . '">' . $val1['value'] . '</option>';
        }

        return $html;
    } catch (PDOException $pe) {
        echo db_error($pe->getMessage());
    }
}

function allartworkyears()
{
    try {
        $conn = dbconnect();
        $query = "SELECT distinct value FROM `attribute_value_ecomc` WHERE `attr_id` = 210 and value <> '' order by value";
        $sql = sprintf($query);
        $q = $conn->prepare($sql);

        $q->execute();
        $q->setFetchMode(PDO::FETCH_ASSOC);

        $artarr = $q->fetchAll();


        $html = '';

        foreach ($artarr as $key1 => $val1) {
            $html .= '<option value="' . $val1['value'] . '">' . $val1['value'] . '</option>';
        }

        return $html;
    } catch (PDOException $pe) {
        echo db_error($pe->getMessage());
    }
}

function alljournaldropdown($conn = null)
{
    try {
        $conn = dbconnect();
        $query = "select distinct ave.value  
from products_ecomc pe,product_attribute_value pav, attribute_value_ecomc ave, attr_common_flds_ecomc acfe  
where pe.prodid = pav.product_id 
and pe.prodid IN 
(

SELECT p.prodid FROM products_ecomc p 
JOIN product_attribute_value t ON p.prodid = t.product_id 
JOIN attribute_value_ecomc v ON t.attribute_value_id = v.attr_value_id 
JOIN attr_common_flds_ecomc f ON v.attr_id = f.id 
where 
p.category_id = 1 
and
(f.attribute_name='reference_type' AND v.value = 'Journal Article') GROUP BY t.product_id
    
) 

and acfe.id = '127' 
and ave.attr_value_id = pav.attribute_value_id 
and ave.attr_id = acfe.id
order by ave.value";
        $sql = sprintf($query);
        $q = $conn->prepare($sql);

        $q->execute();
        $q->setFetchMode(PDO::FETCH_ASSOC);

        $jrarr = $q->fetchAll();

        $html = '';

        foreach ($jrarr as $key1 => $val1) {
            $html .= '<option value="' . $val1['value'] . '">' . $val1['value'] . '</option>';
        }




        $query2 = "select distinct ave.value  
from products_ecomc pe,product_attribute_value pav, attribute_value_ecomc ave, attr_common_flds_ecomc acfe  
where pe.prodid = pav.product_id 
and pe.prodid IN 
(

SELECT p.prodid FROM products_ecomc p 
JOIN product_attribute_value t ON p.prodid = t.product_id 
JOIN attribute_value_ecomc v ON t.attribute_value_id = v.attr_value_id 
JOIN attr_common_flds_ecomc f ON v.attr_id = f.id 
where 
p.category_id = 1 
and
(f.attribute_name='reference_type' AND v.value = 'Journal') GROUP BY t.product_id
    
) 

and acfe.id = '127' 
and ave.attr_value_id = pav.attribute_value_id 
and ave.attr_id = acfe.id
order by acfe.position";


        $sql2 = sprintf($query2);
        $q2 = $conn->prepare($sql2);

        $q2->execute();
        $q2->setFetchMode(PDO::FETCH_ASSOC);

        $jrarr2 = $q2->fetchAll();


        foreach ($jrarr2 as $key2 => $val2) {
            $html .= '<option value="' . $val2['value'] . '">' . $val2['value'] . '</option>';
        }



        return $html;
    } catch (PDOException $pe) {
        echo db_error($pe->getMessage());
    }
}

function alllanguagedropdown()
{
    try {
        $conn = dbconnect();
        $query = "SELECT ave.value FROM  
 attribute_value_ecomc ave, attr_common_flds_ecomc acfe
where 
ave.attr_id = acfe.id 
and
acfe.id='15' 
order by ave.value";
        $sql = sprintf($query);
        $q = $conn->prepare($sql);

        $q->execute();
        $q->setFetchMode(PDO::FETCH_ASSOC);

        $artarr = $q->fetchAll();


        $html = '';

        foreach ($artarr as $key1 => $val1) {
            $html .= '<option value="' . $val1['value'] . '">' . $val1['value'] . '</option>';
        }

        return $html;
    } catch (PDOException $pe) {
        echo db_error($pe->getMessage());
    }
}
function get_allPDF_count_bibliography($pid, $choice = false)
{
    try {
        $conn = dbconnect();
        $query = "SELECT count(id) count_pdf FROM bibliography_pdf WHERE `prodid`='%s'";
        $sql = sprintf($query, $pid);
        $q = $conn->prepare($sql);

        $q->execute();
        $q->setFetchMode(PDO::FETCH_ASSOC);
        if ($choice) {
            $row = $q->fetch();
            return !empty($row['count_pdf']) ? $row['count_pdf'] : 0;
        }
        return $cust_addr = $q->fetch();
    } catch (PDOException $pe) {
        echo db_error($pe->getMessage());
    }
}
