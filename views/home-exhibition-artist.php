
<section class="testimonials vision-statement visual-search-details-page exhibition-details-page exhibition-artwork-page">
        <div class="container">
            <div class="visual-inner">
                        <div class="back-action">
                            <a href="#"  class="back-btn" onclick="history.go(-1)" ><span class="material-icons">arrow_back</span>back</a>
                        </div>
                    </div>
        <?php foreach($exrow as $key) { ?>
            <div class="row">
                <div class="col-lg-6">
                    <div class="testimonials-inner">
                        <div class="visual-title">
                            <?php 
                                if (!empty($key['artist_death'])) {

                                    echo $key['artist_name'] ;?>
                                    <span class="exhibition-span-title">
                                        <?php
                                echo '('. $key['artist_birth'] .'-'. $key['artist_death'] .')';?>
                                    </span>
                                <?php }
                                
                                else{
                                echo $key['artist_name'] ;?>
                                <span class="exhibition-span-title">
                                <?php 
                                echo 'b.'. $key['artist_birth'] ;?>
                                </span>
                                <?php }
                                ?>
                        </div>
                        <div class="visual-content">
                           <?php echo $key['artist_description']; ?>
                        </div>
                        <div class="visual-content">
                            <?php echo $key['artist_description2']; ?>
                        </div>
                        <div class="visual-content">
                            <?php echo $key['artist_description3']; ?>
                        </div>
                        
                    </div>
                     </div>
                    <div class="col-lg-6">
                        <div class="vision-img">
                            <?php   if($key['photograph'] != '') { ?>
                            <img class="img-fluid" src="<?php echo SITE_URL . '/' . EXHIBITION_THUMB_IMGS . $key['photograph']; ?>">
                                <?php }else{ ?>
                                <img class="img-fluid" src="product_images/exhibition_thumbs/placeholder.jpg">
                                <?php } ?>
                        </div>
                    </div>           
            </div>
        <?php } ?>
        </div>
    </section>

