<?php
require_once("require.php");
require_once(INCLUDED_FILES . "config.inc.php");
require_once(INCLUDED_FILES . "dbConn.php");
//include("includes/headerInc.php");
?>
<link rel="stylesheet" href="<?php echo SITE_URL . CSS_FOLDER ?>bootstrap.min.css">

<!--  Font-awesome CSS  -->
<link rel="stylesheet" href="<?php echo SITE_URL . CSS_FOLDER ?>font-awesome.min.css">

<!--  Custom CSS  -->
<link rel="stylesheet" href="<?php echo SITE_URL . CSS_FOLDER ?>custom.css">
<link rel="stylesheet" href="<?php echo SITE_URL . CSS_FOLDER ?>style.css">
<!--  Responsive CSS  -->
<link rel="stylesheet" href="<?php echo SITE_URL . CSS_FOLDER ?>responsive.css">


<link href="<?php echo SITE_URL . CSS_FOLDER ?>select2.css" rel="stylesheet">


<link href="<?php echo SITE_URL . CSS_FOLDER ?>owl.theme.default.min.css" rel="stylesheet">
<link href="<?php echo SITE_URL . CSS_FOLDER ?>owl.carousel.min.css" rel="stylesheet">


<!--Visual Archive Page Image Zoom Plugin-->
<link rel="stylesheet" href="<?php echo SITE_URL . CSS_FOLDER ?>/visualarchive-details/lightgallery.css">
<link rel="stylesheet" href="<?php echo SITE_URL . CSS_FOLDER ?>/visualarchive-details/visualarchive-lighbox.css">

<link rel="stylesheet" href="<?php echo SITE_URL . CSS_FOLDER ?>/multiple-select.css">
<link rel="stylesheet" href="<?php echo SITE_URL . CSS_FOLDER ?>/jquery-ui.css">
<link rel="stylesheet" href="<?php echo SITE_URL . CSS_FOLDER ?>/magnific-popup.css">
<select id="publicationyear" name="publicationyear[]" multiple="multiple">
    <option value="ABC">ABC</option>
    <option value="DEF">DEF</option>
</select>
<?php
//include("includes/footerInc.php");
?>

<script src="https://code.jquery.com/jquery-3.5.1.js" integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc=" crossorigin="anonymous"></script>

<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>


<script src="<?php echo SITE_URL . JS_FOLDER ?>bootstrap.min.js"></script>






<!--<script src="<?php echo SITE_URL . JS_FOLDER ?>jquery.swipebox.js">
</script>-->

<script src="<?php echo SITE_URL . JS_FOLDER ?>cart.js">
</script>
<script src="<?php echo SITE_URL . JS_FOLDER ?>jquery.swipebox.js">
</script>
<script src="<?php echo SITE_URL . JS_FOLDER ?>jquery.validate.js">
</script>
<script src="<?php echo SITE_URL . JS_FOLDER ?>holder.js">
</script>
<script src="<?php echo SITE_URL . JS_FOLDER ?>jquery.jscroll.js">
</script>
<script src="<?php echo SITE_URL . JS_FOLDER ?>forms.js">
</script>
<script src="<?php echo SITE_URL . JS_FOLDER ?>jquery.plugin.min.js">
</script>
<script src="<?php echo SITE_URL . JS_FOLDER ?>jquery.countdown.min.js">
</script>






<script type="text/javascript" src="<?php echo SITE_URL ?>/mainjs/lib/owl.carousel.min.js"></script>
<script type="text/javascript" src="<?php echo SITE_URL ?>/mainjs/lib/slideout-min.js"></script>
<script type="text/javascript" src="<?php echo SITE_URL ?>/mainjs/lib/greensock.js"></script>
<script type="text/javascript" src="<?php echo SITE_URL ?>/mainjs/lib/layerslider.transitions.js"></script>
<script type="text/javascript" src="<?php echo SITE_URL ?>/mainjs/lib/layerslider.kreaturamedia.jquery.js"></script>

<script type="text/javascript" src="<?php echo SITE_URL ?>/mainjs/lib/jquery.infinitescroll.min.js"></script>
<script type="text/javascript" src="<?php echo SITE_URL ?>/mainjs/lib/jquery.filterizr-min.js"></script>
<script type="text/javascript" src="<?php echo SITE_URL ?>/mainjs/lib/swiper.min.js"></script>
<script type="text/javascript" src="<?php echo SITE_URL ?>/mainjs/lib/TimeCircles-min.js"></script>






<script type="text/javascript" src="<?php echo SITE_URL ?>/mainjs/lib/jquery-ui-min.js"></script>





<?php
$uri = $_SERVER['REQUEST_URI'];
//echo $uri; // Outputs: URI
if (strpos($uri, 'visualarchive-details/') == false) {
    ?>
    <script type="text/javascript" src="<?php echo SITE_URL ?>/mainjs/main.js"></script>
    <?php
}
?>
<script type="text/javascript" src="<?php echo SITE_URL ?>/mainjs/lib/select2.js"></script>
<script type="text/javascript" src="<?php echo SITE_URL ?>/mainjs/lib/multiple-select.js"></script>
<script type="text/javascript" src="<?php echo SITE_URL ?>/mainjs/magnific-popup/jquery.magnific-popup.min.js"></script>


<script>
    $(document).ready(function () {
        
        
        $('#publicationyear').multipleSelect({
            width: '100%',
            selectAllText: 'All',
            allSelected: "Publicationyear - All",
            onUncheckAll: function () {
                $('span.placeholder').html('publicationyear');
            },
        });
        
      
    });
</script>


