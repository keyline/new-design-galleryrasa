<?php

    //define folder
    define('gR_Version', '1.3');
    define('DB_USER', 'root');
    define('DB_PASS', '');
    define('DB_HOST', 'localhost');
    define('DB_NAME', 'galleryr_blues');
    define('ORG_SITE_URL', 'https://localhost/galleryrasa/new-design-galleryrasa/');
    define('SITE_URL', 'https://localhost/galleryrasa/new-design-galleryrasa/');
    define('ADMIN_URL', 'https://localhost/galleryrasa/new-design-galleryrasa/admin');
    define('APPS_BASE_PATH', $_SERVER['DOCUMENT_ROOT'] . "/");



    define('CURRENCY_CODE', '$ ');  # US [ $ ], GB [ & pound; ] #Euro [ & euro ];

    #ReCaptcha
    # To use reCaptcha, get your keys from    https://www.google.com / recaptcha / admin
    define('RECAPTCHA_SITEKEY', '');
    define('RECAPTCHA_SECRET', '');
    define('RECAPTCHA_LAN', 'en');

    define("ADDTOCART", true);

    define("LOG_PATH", 'logs/');


    define('SHOW_ERR', true); //show database error. Set to true only when debugging
    define('CREATE_ADMIN_ACCOUNT', true); // set to false once admin account created.

    define('SHOW_AVAILABLE_STOCK', true); #show all current available stock
    define('SHOW_AVAILABLE_STOCK_LABEL', 'Available: ');
    define('OUT_OF_STOCK', ' [out of stock]'); #out of stock text


    define('LOW_STOCK_ALERT', true); #enable email alert</low>
    define('LOW_STOCK_LEVEL', 5); # send email alert if stock level is equal or less than this number

    @date_default_timezone_set("Asia/Kolkata");
    # date_default_timezone_set("Europe/London"); #set your default time zone.  http://php.net/manual/en/timezones.php
    /**
    * *No editing necessary beyond this point
    */

    define('PER_PAGE', 30); #pagination
    define('THUMB_WIDTH', 300); // in pixels 300
    define('THUMB_HEIGHT', 400); // in pixels 400

    define('VA_THUMB_WIDTH', 250); // in pixels 250
    define('VA_THUMB_HEIGHT', 150); // in pixels 150

    define('VA_MEDIUM_WIDTH', 500); // in pixels 500
    define('VA_MEDIUM_HEIGHT', 300); // in pixels 300

    // define('VA_MEDIUM_URL', 'va-medium');

    define('TOP_DEALS_TILE', '<h3 class="text-warning" style="margin-top:0"> Top Deals</h3>');

    define('NO_IMAGE', 'Image Not Available'); //default
    define('P_DESCRIPTION_ONE', 'Description'); //default
    define('P_DESCRIPTION_TWO', 'Features'); //default
    define('P_DESCRIPTION_THREE', 'Information'); //default
    define('ORDER_COMPLETION_MSG', 'Your order has completed successfully. <br />Thank you for shopping with us');
    define(
        'PRODUCT_ADDED_MSG',
        '<h2>{MSG} successfully</h2>
        <a href="add-new" class="btn btn-info">Add {BTN}</a>
        <a href="{SHOP}" class="btn btn-info" target="_blank">View on shopfront</a>
        <a href="{EDIT}" class="btn btn-info">View on Edit page</a>
        <a href="index" class="btn btn-info">Go to Product List</a>'
    );
    define(
        'ATTRIBUTE_ADDED_MSG',
        '<h2>{MSG} successfully</h2>
            <a href="add-attributes" class="btn-btn-info">Add {BTN}</a>'
    );
    define('EMPTY_SHOPPING_CART', 'Your shopping basket is empty');
    define('NO_PRODUCT_FOUND_MSG', 'Not Found');
    define('ORDER_PENDING', 'Pending');
    define('ORDER_COMPLETED', 'Completed');
    define('ORDER_DESPATCHED', 'Despatched');
    define('ORDER_CANCELLED', 'Cancelled');

    define('PASSWRD_SALT', '85'); // change to any 2 alphum character

    // db
    define('ADMIN_TBL', 'admin_ecomc');
    define('DELIVERY_TBL', 'delivery_ecomc');
    define('ORDERS_TBL', 'orders_ecomc');
    define('PRODUCTS_TBL', 'products_ecomc');
    define('MEMORIBILA_IMAGES_TBL', 'memorabilia_images');
    define('ATTRIBUTES_TBL', 'attributes_ecomc');
    define('ATTRIBUTE_VARS_TBL', 'attribute_vars_ecomc');
    define('SHOPPING_BASKET_TBL', 'basket_ecomc');
    define('CATEGORIES_TBL', 'product_type_ecomc');
    define('IMAGES_TBL', 'product_images_ecomc');
    define('CAROUSEL_TBL', 'carousel_item');
    define('PAGES_TBL', 'pages_ecomc');
    define('CMS_TBL', 'cms_ecomc');
    define('ATTR_FLDS_TBL', 'attr_common_flds_ecomc');
    define('ATTR_VAL', 'attribute_value_ecomc');
    define("PROD_TYPE_ATTR", 'product_type_attribute_key');
    define("PROD_ATTR_VALUE", 'product_attribute_value');
    define("PROD_CATEGORY", 'product_type_ecomc');
    define("PROD_CART", 'cart');
    define("CUST_LOGIN", 'customer_login');
    define("PAYMENT", 'tbl_payment');
    define("PAYMENTMETA", 'tbl_payment_meta');

    //visual archive
    define('VISUAL_PRODUCTS_TBL', 'visual_products_ecomc');
    define('VISUALARCHIVE_IMAGES_TBL', 'visual_archive_images');


    #folders
    define('CACHE_FILE', 'cache/');
    define('ADMIN_FOLDER', '/admin/');
    define('CSS_FOLDER', 'css/');
    define('JS_FOLDER', 'js/');
    define('OLD_CSS_FOLDER', '/admincss/');
    define('OLD_JS_FOLDER', '/adminjs/');
    define('IMGSRC', 'product_images/');
    define('SITE_IMGS', 'images/');
    define('BLOG_IMGS_THUMBS', SITE_IMGS.'thumbs/');
    define('EMAILS_TPL_FOLDER', 'mail_tpl/');
    define('INC_FOLDER', 'includes/');
    define('INC_LIB', INC_FOLDER.'lib/');
    define('VIEWS_FOLDER', 'views/');
    define('OWL_FOLDER', '/owl/');
    define('THUMB_IMGS', IMGSRC.'thumbs/');
    define('VA_THUMB_IMGS', IMGSRC.'artwork_thumbs/');
    define('VA_MEDIUM_URL', IMGSRC.'va-medium/');
    define('EXHIBITION_THUMB_IMGS', IMGSRC.'exhibition_thumbs/');
    define('PODCAST_THUMB_IMGS', IMGSRC.'podcast_thumbs/');
    define('PRESS_THUMB_IMGS', IMGSRC.'press_thumbs/');
    define('PHOTOBOOK_THUMB_IMGS', IMGSRC.'photobook_thumbs/');
    define('PHOTOBOOK_IMGS', IMGSRC.'photobook/');
    define('ARTWORKS_IMGS', IMGSRC.'artwork/');
    define('ARTWORKS_ORG_IMGS', IMGSRC.'Art Work/');
    define('ARTWORKS_FOLDER', 'Art Work/');
    define('VARCHIVE', IMGSRC.'va-images/');
    define('IMAGES_FOLDER', IMGSRC);
    define('FEATURED_ITEMS', IMGSRC.'featured');
    define('ADMIN_HTML', 'html/');
    define('PRESS_IMGS', IMGSRC . 'press/');
    //define('APPS_BASE_PATH', $_SERVER['DOCUMENT_ROOT'] . "/beta/");


    define(
        'CAROUSEL_SIDE_PAGINATION',
        '<a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">
        <span class="glyphicon glyphicon-chevron-left"></span></a>
        <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next"><span class="glyphicon glyphicon-chevron-right"></span></a>'
    );
    $allowedFiles = array(
        'image/pjpeg',
        'image/jpeg',
        'image/gif',
        'image/png'
    );

    $allowedFiles_artwork=array(
        'pjpeg',
        'jpeg',
        'gif',
        'png',
        'jpg'
    );

    $myArray=array(
        'Catalogue[Solo]' => ['gallery_museum', 'curator', 'gregorian_year'],
        'Catalogue[Annual]'=> [ 'gallery_museum', 'curator', 'gregorian_year'],
        'Catalogue[Group]'=> [ 'gallery_museum', 'curator', 'gregorian_year'],
        'Catalogue Essay'=> [ 'title1_of_parent', 'translated_title', 'author', 'gallery_museum', 'curator', 'gregorian_year'],
        'Book'=> ['author', 'beditor', 'editor','gregorian_year', 'translated1_title_of_parent', 'translated_title'],
        'Journal Article'=> ['title1_of_parent', 'translated_title','author', 'gregorian_month', 'gregorian_year', 'translated1_title_of_parent'],
        'Book Section'=> ['title1_of_parent', 'author', 'beditor','editor','translated_title', 'gregorian_year', 'translated1_title_of_parent']
    );

    define('RIGHTKEYS', serialize($myArray));


    session_start();

    function my_error_handler($e_number, $e_message, $e_file, $e_line, $e_vars)
    {
        echo $message = "An error occurred in script '$e_file' on line $e_line: $e_message";
        /*
        if(SHOW_ERR) {
        echo $message;
        }
        else {
        echo '<strong>A system error has occurred. We apologize for the inconvenience.</strong>';
        }

        #debug_print_backtrace();
        */
    }

    set_error_handler('my_error_handler');
