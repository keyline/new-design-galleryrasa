<?php
require_once("require.php");
require_once(INCLUDED_FILES . "config.inc.php");
require_once(INCLUDED_FILES . "dbConn.php");
require_once(INCLUDED_FILES . "functionsInc.php");
$conn = dbconnect();
include(INC_FOLDER . "headerInc.php");
$image_id = $_GET['image_id'];
$image_type = $_GET['image_type'];

count_click('memoribilia_image', $image_id);

$qry_sel = "SELECT * from memorabilia_images where m_image_id = '$image_id'";

$q_sel = $conn->prepare($qry_sel);
$q_sel->execute();
$q_sel->setFetchMode(PDO::FETCH_ASSOC);
$row_sel = $q_sel->fetch();
// print_r($row_sel);
$prod_id = $row_sel['product_id'];
$image_name = $row_sel['m_image_name'];
$image_details = $row_sel['m_image_details'];
//$taxable = $row_sel['is_taxable'];
$image_folder = strtolower($image_type);
?>
<main>
<section class="visual-search-details-page exhibition-details-page bengali-film-archives-search-details memorabilia-details">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="visual-inner">
                        <div class="back-action">
                            <a href="#" class="back-btn" onclick="history.go(-1)"><span class="material-icons">arrow_back</span>back</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-6">
                    <div class="bengali-film-archives-inner">
                        <div id=bengali-film-box-2 class="owl-carousel owl-theme owl-loaded owl-drag">
                            <div class="item">
                                <div class="details-owl">
                                    <div class="details-info">
                                        <div class="left-details">
                                            <div class="details-img box target">
                                                <img class="img-fluid" src="<?php echo SITE_URL.'/product_images/'.$image_folder.'/'.$image_name; ?>">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>            
                    </div>
                        <div class="sticky-sec">
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
                                <a href='downloadMemoribiliaImg.php?file="<?php echo $image_name; ?>"' class="book-btn arrow">
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
                </div>
            <div class="col-lg-6 flex-v-cen">
                <?php
                $imageDetails = '';
$imageDetails .= get_html_from_JSON($image_details, $image_type, $prod_id);
//$imageDetails .= get_add_to_cart_button($image_details, $image_type);
echo $imageDetails;
?>
            </div>
        </div>
    </div>
</section>
<!-- <section class="artist-search memorabilia-search">
    <div class="container">
        <div class="row">
            
            <div class="col-lg-12">
                <div class="artist-inner">
                    <div class="artist-top">
                        <p>Related Items</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-12 p-0">
                <div class="artist-inner memorabilia-info">
                    <div class="artist-info">
                        <div class="artist-box-doc">
                            <div class="artist-box">
                                <div class="artist-box-info">
                                    <div class="artist-box-body">
                                    <div class="artist-img">
                                        <img class="img-fluid" src="images/film-search-details.jpg">
                                    </div>
                                    <div class="print-inner">
                                        <div class="print-title">
                                            PRINT
                                        </div>
                                        <div class="print-content">
                                            PDF of Song Synopsis Book, 6 Pages + Covers
                                        </div>
                                        <div class="print-cost">
                                            ₹ 100 / $ 1.33
                                        </div>
                                    </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="artist-box-doc">
                            <div class="artist-box">
                                <div class="artist-box-info">
                                    <div class="artist-box-body">
                                        <div class="artist-img">
                                            <img class="img-fluid" src="images/film-search-details.jpg">
                                        </div>
                                        <div class="print-inner">
                                            <div class="print-title">
                                                PRINT
                                            </div>
                                            <div class="print-content">
                                                PDF of Song Synopsis Book, 6 Pages + Covers
                                            </div>
                                            <div class="print-cost">
                                                ₹ 100 / $ 1.33
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>                                   
                    </div>
                </div>
            </div>
        </div>
    </div>
</section> -->
<div class="press-modal">
    <div class="modal fade" id="enlargeModal" tabindex="-1" aria-labelledby="enlargeModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                            <a href="#" class="downlode"><span class="material-icons">crop_free</span></a>
                            <!-- <a href="#" class="downlode"><span class="material-icons">save_alt</span></a> -->
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="light-part">
                        <img class="img-fluid" src="<?php echo SITE_URL.'/product_images/'.$image_folder.'/'.$image_name; ?>">
                    </div>
                </div>              
            </div>
        </div>
    </div>
</div>
</main>
</body>
</html>
<?php
include(INC_FOLDER . "footerInc.php");
