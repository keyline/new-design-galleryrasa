<?php

    #Database details
     define('DB_USER', 'lobisdev_one');
    define('DB_PASS', 'NoJqpTxk');
    define('DB_HOST', 'lobisdev.one.mysql');
    define('DB_NAME', 'lobisdev_one');

    #define('DB_USER', 'root');
    #define('DB_PASS', 'ujunwa');
    #define('DB_HOST', 'localhost');
   # define('DB_NAME', 'lobisdev_one');

    define('SITE_URL', 'http://www.lobisdev.one/ecom-cart');

   # define('SITE_URL', 'http://localhost/mypages/eComCart1.0');
    define('CURRENCY_CODE', '$ ');  # US [ $ ], GB [ & pound; ] #Euro [ & euro ];

   
    #ReCaptcha
    # to use reCaptcha, get your keys from    https://www.google.com / recaptcha / admin
    define('RECAPTCHA_SITEKEY', ''); #6Ld4_hITAAAAAMFthnXjrp6vsdXJ_4k6naqH6fSn
    define('RECAPTCHA_SECRET', '6Ld4_hITAAAAALVPkarA_QRRqH8sjz6Kjg2wr1et'); #6Ld4_hITAAAAALVPkarA_QRRqH8sjz6Kjg2wr1et
    define('RECAPTCHA_LAN', 'en');

    #Paypal
    define('PAYPAL_EMAIL', 'paypal@myemail.com');
    define('SITE_EMAIL', 'lobbix@o2.co.uk'); //contact us page
    define('PAYPAL_CURRENCY', 'GBP'); //GBP, USD, EUR
    define('PAYPAL_RETURN_URL', 'http://localhost/mypages/SimpCart/index');

    define('SHOW_ERR', true); //show database error. Set to true only when debugging
    define('CREATE_ADMIN_ACCOUNT', true); // set to false once admin account created.
    
    define('SHOW_AVAILABLE_STOCK', true); #show all current available stock
    define('SHOW_AVAILABLE_STOCK_LABEL', 'Available: ');
    define('OUT_OF_STOCK', ' [out of stock]'); #out of stock text

    define('LOW_STOCK_ALERT', true); #enable email alert</low>
    define('LOW_STOCK_LEVEL',5); # send email alert if stock level is equal or less than this number
    
    date_default_timezone_set(@date_default_timezone_get());
    # date_default_timezone_set("Europe/London"); #set your default time zone.  http://php.net/manual/en/timezones.php
    /**
    * *No editing necessary beyond this point
    */

    define('PER_PAGE', 30); #pagination
    define('THUMB_WIDTH', 300); // in pixels 300
    define('THUMB_HEIGHT', 400); // in pixels 400
    define('NO_IMAGE', 'Image Not Available'); //default
    define('P_DESCRIPTION_ONE', 'Description'); //default
    define('P_DESCRIPTION_TWO', 'Features'); //default
    define('P_DESCRIPTION_THREE', 'Information'); //default
    define('ORDER_COMPLETION_MSG', 'Your order has completed successfully. <br />Thank you for shopping with us');
    define('PRODUCT_ADDED_MSG',
        '<h2>{MSG} successfully</h2>
        <a href="add-new" class="btn btn-info">Add {BTN}</a>
        <a href="{SHOP}" class="btn btn-info" target="_blank">View on shopfront</a>
        <a href="{EDIT}" class="btn btn-info">View on Edit page</a>
        <a href="index" class="btn btn-info">Go to Product List</a>');
    define('EMPTY_SHOPPING_CART', 'Your shopping basket is empty');
    define('NO_PRODUCT_FOUND_MSG', 'Not Found');
    define('ORDER_PENDING', 'Pending');
    define('ORDER_COMPLETED', 'Completed');
    define('ORDER_DESPATCHED', 'Despatched');
    define('ORDER_CANCELLED', 'Cancelled');

    define('PASSWRD_SALT', '85'); // change to any 2 alphum character

    // db
    define('ADMIN_TBL', '3admin_ecomc');
    define('DELIVERY_TBL', '3delivery_ecomc');
    define('ORDERS_TBL', '3orders_ecomc');
    define('PRODUCTS_TBL', '3products_ecomc');
    define('ATTRIBUTES_TBL', '3attributes_ecomc');
    define('ATTRIBUTE_VARS_TBL', '3attribute_vars_ecomc');
    define('SHOPPING_BASKET_TBL', '3basket_ecomc');
    define('CATEGORIES_TBL', '3categories_ecomc');
    define('IMAGES_TBL', '3product_images_ecomc');
    define('CAROUSEL_TBL', '3carousel_ecomc');
    define('PAGES_TBL', '3pages_ecomc');
    define('CMS_TBL', '3cms_ecomc');

    #folders
    define('CACHE_FILE', 'cache/');
    define('ADMIN_FOLDER', '/admin/');
    define('CSS_FOLDER', '/css/');
    define('JS_FOLDER', '/js/');
    define('IMGSRC', 'product_images/');
    define('SITE_IMGS', 'images/');
    define('BLOG_IMGS_THUMBS', SITE_IMGS.'thumbs/');
    define('EMAILS_TPL_FOLDER', 'mail_tpl/');
    define('INC_FOLDER', 'includes/');
    define('INC_LIB', INC_FOLDER.'lib/');
    define('VIEWS_FOLDER', 'views/');
    define('THUMB_IMGS', IMGSRC.'thumbs/');
    define('IMAGES_FOLDER', IMGSRC);
    define('ADMIN_HTML', 'html/');


    define('CAROUSEL_SIDE_PAGINATION',
        '<a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">
        <span class="glyphicon glyphicon-chevron-left"></span></a>
        <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next"><span class="glyphicon glyphicon-chevron-right"></span></a>');
    $allowedFiles = array(
        'image/pjpeg',
        'image/jpeg',
        'image/gif',
        'image/png'
    );


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
?>