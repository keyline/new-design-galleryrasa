<?php
require_once("require.php");
require_once(INCLUDED_FILES . "config.inc.php");
require_once(INCLUDED_FILES . "dbConn.php");
require_once(INCLUDED_FILES . "functionsInc.php");
?>
<link rel="stylesheet" href="<?php echo SITE_URL . CSS_FOLDER ?>bootstrap.min.css">

<link rel="stylesheet" href="<?php echo SITE_URL . CSS_FOLDER ?>font-awesome.min.css">


<link rel="stylesheet" href="<?php echo SITE_URL . CSS_FOLDER ?>custom.css">
<link rel="stylesheet" href="<?php echo SITE_URL . CSS_FOLDER ?>style.css">

<link rel="stylesheet" href="<?php echo SITE_URL . CSS_FOLDER ?>responsive.css">


<link href="<?php echo SITE_URL . CSS_FOLDER ?>select2.css" rel="stylesheet">


<link href="<?php echo SITE_URL . CSS_FOLDER ?>owl.theme.default.min.css" rel="stylesheet">
<link href="<?php echo SITE_URL . CSS_FOLDER ?>owl.carousel.min.css" rel="stylesheet">

<link rel="stylesheet" href="<?php echo SITE_URL . CSS_FOLDER ?>/visualarchive-details/visualarchive-lighbox.css">

<link rel="stylesheet" href="<?php echo SITE_URL . CSS_FOLDER ?>/multiple-select.css">
<link rel="stylesheet" href="<?php echo SITE_URL . CSS_FOLDER ?>/jquery-ui.css">

<?php
$conn = dbconnect();

$artistvalue = $_POST['artistvalue'];

$artistvaluearr = (explode(",", $artistvalue));



$cntartistvalue = count($artistvaluearr);

$i = 0;
$artistarr = [];
$i2 = 1;
$artiststr = "";

if (!isset($artistvalue) || $artistvalue == '') {
    $artiststr .= "";
} else {

    foreach ($artistvaluearr as $k => $v) {

        $artistvalue2arr = (explode(":", $v));



        $artistarr[$i] = $artistvalue2arr[1];


        if ($cntartistvalue == $i2) {
            $artiststr .= "'" . $artistarr[$i] . "'";
        } else {
            $artiststr .= "'" . $artistarr[$i] . "',";
        }

        $i2++;
        $i++;
    }
}


$classificationval = $_POST['classificationval'];

$classificationvalarr = (explode(",", $classificationval));

$cntclassificationval = count($classificationvalarr);
$j = 1;
$classificationstr = "";

if (!isset($classificationval) || $classificationval == '') {

    $classificationstr .= "";
} else {

    foreach ($classificationvalarr as $k2 => $v2) {
        if ($cntclassificationval == $j) {
            $classificationstr .= "'" . $v2 . "'";
        } else {
            $classificationstr .= "'" . $v2 . "',";
        }
        $j++;
    }
}

$artworkoptions = get_va_artworkyear_optionsall($conn, $artiststr, $classificationstr);

//echo $select_py = $publicationoptions['s'];
//echo $artworkoptions;
?>
<label>Year of Artwork</label>
<select id="artworkyear" name="artworkyear[]" multiple="multiple">
    <?php
    echo $artworkoptions;
    ?>
</select>

<script src="https://code.jquery.com/jquery-3.5.1.js" integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc=" crossorigin="anonymous"></script>

<script type="text/javascript" src="<?php echo SITE_URL ?>/mainjs/lib/jquery.infinitescroll.min.js"></script>
<script type="text/javascript" src="<?php echo SITE_URL ?>/mainjs/lib/jquery.filterizr-min.js"></script>

<script type="text/javascript" src="<?php echo SITE_URL ?>/mainjs/lib/TimeCircles-min.js"></script>

<script type="text/javascript" src="<?php echo SITE_URL ?>/mainjs/lib/jquery-ui-min.js"></script>


<script type="text/javascript" src="<?php echo SITE_URL ?>/mainjs/lib/select2.js"></script>
<script type="text/javascript" src="<?php echo SITE_URL ?>/mainjs/lib/multiple-select.js"></script>
<script type="text/javascript" src="<?php echo SITE_URL ?>/mainjs/magnific-popup/jquery.magnific-popup.min.js"></script>

<script>
   // $(document).ready(function () {
        
        
        $('#artworkyear').multipleSelect({
            width: '100%',
            selectAllText: 'All',
            allSelected: "Artworkyear - All",
            onUncheckAll: function () {
                $('span.placeholder').html('artworkyear');
            },
        });
        
      
 //   });
</script>


