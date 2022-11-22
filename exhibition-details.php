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

$conn = dbconnect();
$sql2 = "SELECT * FROM exhibition WHERE id=$getid ";
// echo $sql2;exit();
$q2 = $conn->query($sql2);

$q2->execute();
$q2->setFetchMode(PDO::FETCH_ASSOC);
$exrow = $q2->fetchAll();
// print_r($exrow);exit();

$sql = "SELECT exhibition_paintings.id,exhibition_paintings.name,exhibition_paintings.image, exhibition_paintings.dimension, exhibition_paintings.year, exhibition_paintings.medium, exhibition_artists.artist_name FROM exhibition_paintings LEFT JOIN exhibition_artists ON exhibition_paintings.artist_id = exhibition_artists.id WHERE exhibition_paintings.exhibition_id=$getid";
$q = $conn->query($sql);

$q->execute();
$q->setFetchMode(PDO::FETCH_ASSOC);
$exartwork = $q->fetchAll();
// print_r ($exartwork); exit();


$sql1 = "SELECT DISTINCT exhibition_artists.artist_name, exhibition_paintings.exhibition_id FROM `exhibition_artists` LEFT JOIN exhibition_paintings on exhibition_paintings.artist_id = exhibition_artists.id WHERE exhibition_paintings.exhibition_id = $getid";
$q1 = $conn->query($sql1);

$q1->execute();
$q1->setFetchMode(PDO::FETCH_ASSOC);
$exartist = $q1->fetchAll();
// print_r ($exartist); exit();
//Printing Carousel
//carouselParent = [carouselImageItems + caroselImgStickySection + carouselRightSection]
$carouselParent='<div class="swiper-slide"><div class="row">%s%s%s</div></div>';

//carouselImageItems= ['main_image_url', 'related_image_url', ]
$carouselImageItems='<div class="col-lg-5">
                        <div class="bengali-film-archives-inner">
                                        <div id=exhibition-artwork class="owl-carousel owl-theme owl-loaded owl-drag">

                                            <div class="item">
                                                <div class="details-info">
                                                    <div class="left-details">
                                                        <div class="details-img box target">
                                                            <img class="img-fluid" src="%s">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="artwork-bottom-img">
                                                    <img class="img-fluid" src="%s">
                                                </div>
                                            </div>
                                            <div class="item">
                                                <div class="details-info">
                                                    <div class="left-details">
                                                        <div class="details-img box target">
                                                            <img class="img-fluid" src="assets/img/Bibliography-5.jpg">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="artwork-bottom-img">
                                                    <img class="img-fluid" src="assets/img/exhibition-1.jpg">
                                                </div>
                                            </div>
                                        </div>

                                    </div>';
$caroselImgStickySection= '<div class="sticky-sec">
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
                            <a href="#" class="book-btn" data-toggle="modal" data-target="#enlargeModal">
                                <span class="material-icons">zoom_out_map</span>
                            </a>
                            <div class="tooltip-enlarge">
                                <p>enlarge</p>
                            </div>
                        </div>
                                </div>
                                </div>'; //wraping div
$carouselRightSection= '<div class="col-lg-7">
                                    <div class="right-details">
                                        <div class="exhibition-search-title">
                                            Untitled Artwork
                                        </div>
                                        <div class="artist-name">
                                            Artist Name
                                        </div>
                                        <div class="exhibition-search-content">
                                            Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla in magna ultrices, tincidunt dolor sit amet, placerat lorem. Cras lorem sem, pulvinar eget nunc vel, posuere consequat nibh. Quisque vel ex elementum ligula accumsan gravida. Curabitur et enim tempor, vehicula ante in, elementum nunc. Ut aliquet porta erat, et pretium turpis elementum vel. Nulla sed augue id ante porta porttitor sed et ante. Proin pellentesque efficitur massa. Fusce rhoncus, tortor sit amet mollis molestie, nibh justo pharetra nibh, a tempor felis nisl at metus. Maecenas in quam sapien.
                                        </div>
                                        <div class="exhibition-search-content">
                                            Nullam ac metus hendrerit, convallis mi nec, viverra turpis. In non scelerisque metus, bibendum volutpat mauris. Integer commodo finibus vulputate. Fusce eu viverra est. Donec suscipit, nisl et consequat fermentum, tortor est imperdiet dui, in dictum lorem erat quis sem. Interdum et malesuada fames ac ante ipsum primis in faucibus. Cras sit amet congue nisl. Sed dignissim, nisl nec semper tempus, turpis magna iaculis ligula, nec tincidunt ligula nisl id turpis. Nulla bibendum mi in quam dignissim, vitae maximus lorem dapibus.
                                        </div>

                                        <div class="artwork-details">
                                            <div class="details-box">
                                                <div class="details-img">
                                                    <span class="material-icons">info</span>


                                                </div>
                                                <div class="details-title">
                                                    Details
                                                </div>
                                            </div>
                                            <div class="details-content">
                                                Base: <span>Oil on Plywood</span>
                                            </div>
                                            <div class="details-content">
                                                Dimensions: <span>28.7 x 39.0 in / 72.9 x 99.1 cm</span>
                                            </div>
                                            <div class="details-content">
                                                Year: <span>1965</span>
                                            </div>
                                            <div class="details-content">
                                                Info: <span>Detail here</span>
                                            </div>
                                            <div class="details-content">
                                                Info 2: <span>Detail here</span>
                                            </div>

                                        </div>
                                    </div>
                                </div>';



include(VIEWS_FOLDER . "home-exhibition-details.php");
include(INC_FOLDER . "footerInc.php");
