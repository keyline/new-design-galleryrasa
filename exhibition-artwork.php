<?php

$getid= $_REQUEST['id'];
require_once("require.php");
require_once(INCLUDED_FILES . "config.inc.php");
require_once(INCLUDED_FILES . "dbConn.php");
require_once(INCLUDED_FILES . "functionsInc.php");

$conn = dbconnect();
unset($_SESSION['fParam']);
unset($_SESSION['append']);

include(INC_FOLDER . "headerInc.php");
// dynamic start
$conn = dbconnect();
//$sql2 = "SELECT exhibition_paintings.name,exhibition_paintings.year, exhibition_artists.*, exhibition_paintings.description,exhibition_paintings.image FROM `exhibition_paintings` INNER JOIN exhibition_artists ON exhibition_artists.id = exhibition_paintings.artist_id WHERE exhibition_paintings.id = $getid";
$stmt= $conn->prepare(
    "SELECT 
    `exhibition_paintings`.*,
    `exhibition_artists`.* 
    FROM `exhibition_paintings` INNER JOIN `exhibition_artists`
     ON `exhibition_artists`.`id` = `exhibition_paintings`.`artist_id` 
     WHERE `exhibition_paintings`.`id` = :requestIdVar"
);
//$q2 = $conn->query($sql2);
$stmt->bindParam(':requestIdVar', $getid, PDO::PARAM_INT);
$stmt->execute();
$stmt->setFetchMode(PDO::FETCH_ASSOC);
if (! $stmt->rowCount()) {
    die("No artwork found");
}

$artwork = $stmt->fetch();

$stmt->closeCursor();

//Get exhibition mapping from artwork details
$stmt= $conn->prepare(
    "SELECT 
    `exhibition_paintings`.`id`,
    `exhibition_paintings`.`name`,
    `exhibition_paintings`.`image`,
    `exhibition_paintings`.`dimension`,
    `exhibition_paintings`.`year`,
    `exhibition_paintings`.`medium`,
    `exhibition_artists`.`artist_name` FROM 
    `exhibition_paintings` LEFT JOIN `exhibition_artists` 
        ON `exhibition_paintings`.`artist_id` = `exhibition_artists`.`id` 
        WHERE `exhibition_paintings`.`exhibition_id`=:exhibitionIdVar"
);

$stmt->bindParam(':exhibitionIdVar', $artwork['exhibition_id'], PDO::PARAM_INT);

$stmt->execute();

if (! $stmt->rowCount()) {
    die("No exhibition found!");
}

$artworkList= $stmt->fetchAll(PDO::FETCH_ASSOC);
// print_r ($exrow); exit();

// $sql1 = "SELECT * FROM `exhibition_paintings` WHERE exhibition_paintings.id = $getid";

// $q1 = $conn->query($sql1);

// $q1->execute();
// $q1->setFetchMode(PDO::FETCH_ASSOC);
// $exartwork = $q1->fetchAll();

// print_r ($exartwork); exit();

//Printing Carousel
//carouselParent = [carouselImageItems + carouselImgStickySectionTpl + carouselRightSection]

$carouselParentTpl='<div class="swiper-slide"><div class="row">%s%s%s</div></div>';

//carouselImageItems= ['main_image_url', 'thub_image_url', ]

$carouselImageTpl= '<div class="item">
                                                <div class="details-info">
                                                    <div class="left-details">
                                                        <div class="details-img box target">
                                                            <img class="img-fluid" src="%s">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>';

//$carouselImageItems= [carouselImage]
$carouselImageItemsTpl='<div class="col-lg-5">
                        <div class="bengali-film-archives-inner">
                                        <div class="exhibition-carousel owl-carousel owl-theme owl-loaded owl-drag">   
                                            %s
                                        </div>

                                    </div>';
$carouselImgStickySectionTpl= '<div class="sticky-sec">
                                        <div class="book">
                            <a href="#" class="book-btn btn zoom">
                                <span class="material-icons">zoom_in</span>
                            </a>
                            <div class="tooltip-in">
                                <p>zoom in</p>
                            </div>
                        </div>
                                        <div class="book">
                            <a href="#" class="book-btn btn zoom-out">
                                <span class="material-icons">zoom_out</span>
                            </a>
                            <div class="tooltip-out">
                                <p>zoom out</p>
                            </div>
                        </div>
                                        <div class="book">
                            <a href="#" class="book-btn btn zoom-init">
                                <span class="material-icons">undo</span>
                            </a>
                            <div class="tooltip-reset">
                                <p>reset</p>
                            </div>
                        </div>
                                        <div class="book">
                            <a href="#" class="book-btn arrow">
                               <span class="material-icons">arrow_downward</span>
                            </a>
                            <div class="tooltip-download">
                                <p>download</p>
                            </div>
                        </div>
                                        <div class="book">
                            <a href="#" class="book-btn btn-enlarge" data-toggle="modal" data-target="#enlargeModal" data-serial="%s" data-paintingid="%s">
                                <span class="material-icons">zoom_out_map</span>
                            </a>
                            <div class="tooltip-enlarge">
                                <p>enlarge</p>
                            </div>
                        </div>
                                </div>
                                </div>'; //wraping div


//$carouselRightSection= ['artistnamewithdeath/artistnamewithbrith', 'artistname'
//     , 'description'];
$carouselRightSectionDetailsTpl= '<div class="col-lg-7">
                                    <div class="right-details">
                                    <div class="exhibition-search-title">
                                            %s 
                                            <span class="exhibition-span-title">
                                                %s
                                            </span>
                                        </div>
                                        <div class="artist-name">
                                            %s
                                        </div>
                                        <div class="exhibition-search-content">
                                            %s
                                        </div>
                                        <div class="artwork-details">
                                            %s
                                        </div>
                                    </div>
                                    </div>';
//$artWorkDetailsContent=['<span>{Value}</span>',......]
$artWorkDetailsContentTpl='<div class="details-content">
                                                %s
                                            </div>';
//Initialize for template substitution

$buildCarouselHtml="";

$carouselParent="";



$carouselImgStickySection="";



$artWorkDetailsContent="";


$paintingIds= array_column($artworkList, 'id');

if (!empty($paintingIds)) {
    /* Create a string for the parameter placeholders filled to the number of params */
    $place_holders = implode(',', array_fill(0, count($paintingIds), '?'));

    $stmt= $conn->prepare(
        "SELECT 
    `exhibition_paintings`.`id` AS `paintingid`,
    `exhibition_paintings`.*,
    `exhibition_artists`.* 
    FROM `exhibition_paintings` INNER JOIN `exhibition_artists`
     ON `exhibition_artists`.`id` = `exhibition_paintings`.`artist_id` 
     WHERE `exhibition_paintings`.`id` IN ({$place_holders})"
    );

    $stmt->execute($paintingIds);

    if (! $stmt->rowCount()) {
        die("No paintings found");
    }

    $paintingList= $stmt->fetchAll(PDO::FETCH_ASSOC);

    $stmt->closeCursor();
    $index=0;
    foreach ($paintingList as $painting) {
        # code...

        $carouselImage="";
        $carouselImageItems="";
        $carouselRightSectionDetails="";
        $artWorkDetailsContent="";
        $carouselRightSectionDetails="";
        $carouselStickyHtml="";


        $temp= explode('.', $painting['image']);
        $extension = end($temp);

        $mainImgUrl= SITE_URL . 'exhibition/' . base64_encode($temp[0]) .  '.' .$extension;
        $thumbImgUrl= SITE_URL . EXHIBITION_THUMB_IMGS . $painting['image'];

        $carouselImage= vsprintf($carouselImageTpl, [$mainImgUrl]);

        $carouselImageItems= vsprintf($carouselImageItemsTpl, [$carouselImage]);

        //Right section data attributes
        if (!empty($painting['artist_death'])) {
            $artistName= $painting['artist_name'];
            $extendedName= '('. $painting['artist_birth'] .'-'. $painting['artist_death'] .')';
        } else {
            $artistName= $painting['artist_name'];

            $extendedName= 'b.'. $painting['artist_birth'];
        }

        $artistTitle=  $painting['name'] .', '. $painting['year'];

        $artistDesc= $painting['description'];

        if (isset($painting['medium']) && $painting['medium'] !== '') {
            $spanTxt="<span>{$painting['medium']}</span>";

            $artWorkDetailsContent .= vsprintf($artWorkDetailsContentTpl, [$spanTxt]);
        }


        if (isset($painting['dimension']) && $painting['dimension'] !== '') {
            $spanTxt= "<span>{$painting['dimension']}</span>";
            $artWorkDetailsContent .= vsprintf($artWorkDetailsContentTpl, [$spanTxt]);
        }


        if (isset($painting['reference_no']) && $painting['reference_no'] !== '') {
            $spanTxt= "<span>{$painting['reference_no']}</span>";
            $artWorkDetailsContent .= vsprintf($artWorkDetailsContentTpl, [$spanTxt]);
        }


        if (isset($painting['price']) && $painting['price'] !== '') {
            $spanTxt= "<span>{$painting['price']}</span>";

            $artWorkDetailsContent .= vsprintf($artWorkDetailsContentTpl, [$spanTxt]);
        }




        $carouselRightSectionDetails .=vsprintf($carouselRightSectionDetailsTpl, [$artistName, $extendedName, $artistTitle, $artistDesc, $artWorkDetailsContent]);

        $carouselStickyHtml .= vsprintf($carouselImgStickySectionTpl, [$index, $painting['paintingid']]);

        $buildCarouselHtml .= vsprintf($carouselParentTpl, [$carouselImageItems, $carouselStickyHtml, $carouselRightSectionDetails]);

        $index++;
    }
}
include(VIEWS_FOLDER . "home-exhibition-artwork.php");
include(INC_FOLDER . "footerInc.php");
