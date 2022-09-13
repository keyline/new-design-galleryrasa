<?php
require_once("require.php");
require_once(INCLUDED_FILES . "config.inc.php");
require_once(INCLUDED_FILES . "dbConn.php");
require_once(INCLUDED_FILES . "functionsInc.php");
$conn = dbconnect();
$title = "In the press";
include_once('includes/homeheaderInc.php');
?>
<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <section class="testimonials press">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="testimonials-inner">
                        <div class="cart-top">
                            <div class="cart-img">
                                <span class="material-icons">newspaper</span>
                            </div>
                            <div class="exhibition-search-title">
                                In the Press
                            </div>
                        </div>
                        <div class="visual-content">
                            Lorem ipsum dolor sit amet, consectetur adipiscing elit.
                        </div>
                    </div>
                </div>
            </div>
            <?php 
                $sql2 = "SELECT * FROM `in_the_press`";
                $q2 = $conn->query($sql2);
                $q2->execute();
                $q2->setFetchMode(PDO::FETCH_ASSOC);
                $press = $q2->fetchAll();
                // print_r ($press);
                // exit();
            ?>
            <div class="row">
                <div class="col-lg-12 p-1">
                    <div class="press-box">
                    <?php if($press){ foreach ($press as $key) { ?> 
                        <div class="press-inner">
                            <a href="#" data-toggle="modal" data-target="#pressModal<?php echo $key['press_id']; ?>">
                                <div class="press-body">
                                    <div class="press-content">
                                        <?php echo $key['press_name'] ?>
                                    </div>
                                    <div class="press-info">
                                        <div class="press-left"><?php
                                        $time=strtotime($key['press_date']);
                                        echo $month=date("F",$time) ." ";   echo $year=date("Y",$time); ?></div>
                                        <div class="press-right"><span class="material-icons">arrow_forward_ios</span></div>
                                    </div>
                                </div>
                            </a>
                        </div>
                    <?php } } ?>    
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Modal -->
    <?php if($press){ foreach ($press as $pair) { ?> 
        <div class="press-modal">
            <div class="modal fade" id="pressModal<?php echo $pair['press_id']; ?>" tabindex="-1" aria-labelledby="pressModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <a href="#" class="downlode"><span class="material-icons">crop_free</span></a>
                            <a href="#" class="downlode"><span class="material-icons">save_alt</span></a>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="press-inner">
                            <?php 
                                $sql2 = 'SELECT * FROM `press_img` where press_id= '. $pair['press_id'] .' ';
                                $q2 = $conn->query($sql2);
                                $q2->execute();
                                $q2->setFetchMode(PDO::FETCH_ASSOC);
                                $pressData = $q2->fetchAll();
                                // print_r ($pressData);
                            ?>
                                <div class="swiper mySwiper">
                                    <div class="swiper-wrapper">
                                    <?php if($pressData){ foreach ($pressData as $k) { ?> 
                                        <div class="swiper-slide">
                                            <img class="img-fluid" src="<?php echo SITE_URL . '/' . PRESS_THUMB_IMGS . $k['title_img']; ?>">
                                            <div class="press-box">
                                                <h5><?php echo $k['title']; ?></h5>
                                                <p><?php $date = $k['create_at'];
                                                echo date('F d, Y', strtotime($date)); ?></p>
                                            </div>
                                        </div>
                                    <?php } } ?> 
                                    </div>
                                    <div class="next-btn">
                                        <div class="swiper-button-next"><i class="zmdi zmdi-arrow-right"></i></div>
                                        <div class="swiper-pagination"></div>
                                        <div class="swiper-button-prev"><i class="zmdi zmdi-arrow-left"></i></div>
                                    </div>                        
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?php } } ?>  
</body>    
</html>    
<?php include_once("includes/footerInc.php"); ?>