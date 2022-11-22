<<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <script src="https://ajax.aspnetcdn.com/ajax/jQuery/jquery-3.3.1.min.js"></script>
    <link rel="stylesheet" href="./jsSocial/jssocials.css">
    <link rel="stylesheet" href="./jssocials/jssocials-theme-classic.css">
</head>
<body>


<main>
	<section class="visual-search-details-page exhibition-details-page exhibition-details-new">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="visual-inner">
                        <div class="back-action">
                            <a href="./exhibition-search.php" class="back-btn"><span class="material-icons">arrow_back</span>back</a>
                        </div>
                    </div>
                </div>
            </div>
            <?php
            foreach ($exrow as $k) { ?>
            <div class="row">
                <div class="col-lg-6">
                    <div class="details-info">
                        <div class="left-details">
                            <div class="details-img box target">
                            <?php
                                if ($k['photo'] != '') { ?>
                                    <img class="img-fluid" src="<?php echo SITE_URL . '/' . EXHIBITION_THUMB_IMGS . $k['photo']; ?>">
                                <?php } else { ?>
                                <img class="img-fluid" src="product_images/exhibition_thumbs/placeholder.jpg">
                                <?php } ?>
                            </div>
                            <section class="sticky-sec">
                                <div class="book">
                                    <a href="#" class="book-btn" data-toggle="modal" data-target="#enlargeModal">
                                       <span class="material-icons">zoom_out_map</span>
                                    </a>
                                    <div class="tooltip-enlarge">
                                        <p>enlarge</p>
                                    </div>
                                </div>
                            </section>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="right-details">
                     <div class="exhibition-search-title">
                         <?php echo $k['exhibition_name']; ?>
                        </div>
                        <div class="exhibition-search-info">
                            <ul>
                                <li><span class="material-icons">calendar_month</span>
                                    <?php
                                    $date_time = $k['from_exhibition_date'];
                $dt = $k['end_exhibition_date'];
                $date_time = strtotime(str_replace(',', '', $date_time));
                $date = date('jS M, Y', $date_time);
                $time = date('h:i A', $date_time);
                $dt = strtotime(str_replace(',', '', $dt));
                $d = date('jS M, Y', $dt);
                $t = date('h:i A', $dt);

                echo $date .' to '. $d;?>
                                </li>
                                <!-- <li><span class="material-icons">watch_later</span>
                                ?php echo $time .' to '. $t; ?>
                                 11:00 HRS - 18:00 HRS IST
                                </li> -->
                                <li><span class="material-icons">festival</span>
                                    <?php
                if ($k['full_address']) {
                    echo $k['city'] .',&nbsp;'. $k['full_address'];
                } else {
                    echo $k['city'];
                }
                ?></li>


                            </ul>
                        </div>
                        <div class="exhibition-search-content">
                            <?php if (substr($k['description'], 251)) { ?>
                            <div id="primary-text3"><?php echo substr($k['description'], 0, 250);?> ...</div>
                            <div id="more3" style="display:none;">
                                <p><?php echo $k['description']; ?></p>
                            </div>                        
                            <a href="javascript:showMore(3)" class="show-more-new" id="readMore3">Read More</a>
                            <a href="javascript:showLess(3)" class="show-more-new" id="readLess3" style="display:none;">Read Less</a>
                            <?php } else {
                                echo $k['description'];
                            } ?>
                        </div>              
                        <div class="exhibition-search-content">
                            <?php if (substr($k['essay_2'], 251)) { ?>                               
                            <div id="primary-text1"><?php echo substr($k['essay_2'], 0, 250);?> ...</div>
                            <div id="more1" style="display:none;">
                                <p><?php echo $k['essay_2']; ?></p>
                            </div>                        
                            <a href="javascript:showMore(1)" class="show-more-new" id="readMore1">Read More</a>
                            <a href="javascript:showLess(1)" class="show-more-new" id="readLess1" style="display:none;">Read Less</a>
                        <?php } else {
                            echo $k['essay_2'];
                        } ?>
                        </div>
                        <div class="exhibition-search-content">
                            <?php if (substr($k['essay_3'], 251)) { ?>
                            <div id="primary-text2"><?php echo substr($k['essay_3'], 0, 250);?> ...</div>
                            <div id="more2" style="display:none;">
                                <p><?php echo $k['essay_3']; ?></p>
                            </div>                        
                            <a href="javascript:showMore(2)" class="show-more-new" id="readMore2">Read More</a>
                            <a href="javascript:showLess(2)" class="show-more-new" id="readLess2" style="display:none;">Read Less</a>
                            <?php } else {
                                echo $k['essay_3'];
                            } ?>
                        </div>
                        <div class="wrap-enquiry-socialbtns">
                        <div class="enquiry-btn">ENQUIRE<span class="material-icons arrow">arrow_forward</span></div>

                        <div id="shareRoundIcons"></div>


                        <div class="dropdown">
                          <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Share 
                          </button>
                          <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                            <a class="dropdown-item" href="https://www.facebook.com/sharer.php?u=<?php echo SITE_URL?>exhibition-details.php?id=<?php echo $k['id']; ?>" target="_blank"> <img class="img-fluid" src="<?php echo SITE_URL . SITE_IMGS ;?>facebook.png">&nbsp;Facebook</a>
                            <a class="dropdown-item" href="https://www.instagram.com/?u=<?php echo SITE_URL?>exhibition-details.php?id=<?php echo $k['id']; ?>" target="_blank"><img class="img-fluid" src="<?php echo SITE_URL . SITE_IMGS ;?>insta.png">&nbsp;Instagram</a>
                            <a class="dropdown-item" href="https://twitter.com/share?u=<?php echo SITE_URL?>exhibition-details.php?id=<?php echo $k['id']; ?>" target="_blank"><img class="img-fluid" src="<?php echo SITE_URL . SITE_IMGS ;?>twe.png">&nbsp;Twitter</a>
                            <a class="dropdown-item" href="http://www.linkedin.com/shareArticle?mini=true&amp;u=<?php echo SITE_URL?>exhibition-details.php?id=<?php echo $k['id']; ?>" target="_blank"><img class="img-fluid" src="<?php echo SITE_URL . SITE_IMGS ;?>in.png">&nbsp;LinkedIn</a>
                          </div>
                        </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php } ?>
        </div>
    </section>
    <section class="exhibition-tab artist-search exhibition-details-tab">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 pr-0 pl-0">
                    <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <a class="nav-link active" id="pills-home-tab" data-toggle="pill" href="#pills-home" role="tab" aria-controls="pills-home" aria-selected="true">ARTWORKS</a>
                        </li>
                        <li class="nav-item" role="presentation">
                            <a class="nav-link" id="pills-profile-tab" data-toggle="pill" href="#pills-profile" role="tab" aria-controls="pills-profile" aria-selected="false">ARTISTS</a>
                        </li>
<!--
                        <li class="nav-item" role="presentation">
                            <a class="nav-link" id="pills-contact-tab" data-toggle="pill" href="#pills-contact" role="tab" aria-controls="pills-contact" aria-selected="false">PAST EXHIBITIONS</a>
                        </li>
-->
                    </ul>
                    <div class="tab-content" id="pills-tabContent">
                        <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
                            <div class="artist-inner">
                                <div class="artist-info">
                                    
                                    <?php
                                    foreach ($exartwork as $v) { ?>
                                    <div class="artist-box-doc">
                                        <a href="<?php SITE_URL ?>./exhibition-artwork.php?id=<?php echo $v['id']; ?>">
                                            <div class="artist-box">
                                        <div class="artist-box-info">
                                            <div class="artist-img">
                                                <!-- <img class="img-fluid" src="assets/img/exhibition-1.jpg"> -->
                                                <?php
                                                    if ($v['image'] != '') { ?>
                                                        <img class="img-fluid" src="<?php echo SITE_URL . '/' . EXHIBITION_THUMB_IMGS . $v['image']; ?>">
                                                    <?php } else { ?>
                                                    <img class="img-fluid" src="product_images/exhibition_thumbs/placeholder.jpg">
                                                    <?php } ?>
                                            </div>
                                            <div class="exhibition-info">
                                                <div class="exhibition-content">
                                                    <?php echo $v['artist_name']; ?>
                                                </div>
                                                <div class="exhibition-content">
                                                    <?php echo $v['name']; ?>,<?php echo $v['year']; ?>
                                                </div>
                                                <div class="artist-year">
                                                    <?php echo($v['medium']); ?>
                                                </div>
                                                <div class="artist-year">
                                                    <?php echo($v['dimension']); ?>
                                                </div>
                                                <!-- <div class="artist-year">
                                                    ?php echo $v['year']; ?>
                                                </div> -->
                                            </div>
                                        </div>
                                    </div>
                                        </a>
                                    </div>
                                <?php } ?>                                    
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
                            <div class="artist-inner">
                                <div class="artist-info">
                                    <?php
                                    foreach ($exartist as $key) { ?>
                                   <div class="exhibition-box">
                                       <div class="exhibition-artist">
                                           <?php echo $key['artist_name']; ?>
                                       </div>
                                    </div> 
                                <?php } ?>                                    
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Modal -->

                <div class="press-modal">
                            <div class="modal fade" id="enlargeModal" tabindex="-1" aria-labelledby="enlargeModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                         <div class="modal-header">
<!--                    <h5 class="modal-title" id="pressModalLabel">Modal title</h5>-->
                    <a href="#" class="downlode"><span class="material-icons">crop_free</span></a>
                    <a href="<?php echo SITE_URL . 'download/exhibition/'. $k['id'];?>" class="downlode" target="_blank"><span class="material-icons">save_alt</span></a>
                     

                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                                        <div class="modal-body">
                                           <div class="light-part">
                                    <!-- <img class="img-fluid" src="<?php //echo SITE_URL . '/' . 'exhibition/' . base64_encode($k['photo']);?>"> -->
                                    <?php

                                $temp= explode('.', $k['photo']);
            $extension = end($temp);


            echo '<img class="img-fluid" src="'. SITE_URL . '/' . 'exhibition/'. base64_encode($temp[0]) . '.' . $extension. '" />'; ?>
                                </div>
                                        </div>
                                        
                                    </div>
                                </div>
                            </div>
</div>
</main>

</body>
</html>
<script src="./jssocials/jssocials.js" ></script>
<script>
   $("#shareRoundIcons").jsSocials({
    showLabel: false,
    showCount: false,
    shares: ["email", "twitter", "facebook", "pinterest", "whatsapp"]
});
</script>