<main>
	<section class="visual-search-details-page exhibition-details-page exhibition-artwork-page">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="visual-inner">
                        <div class="back-action">
<!--                             $go_back = htmlspecialchars($_SERVER['HTTP_REFERER']);
echo "<a href='$go_back'>Go Back</a>"; -->
                            <a href="#"  class="back-btn" onclick="history.go(-1)" ><span class="material-icons">arrow_back</span>back</a>
                        </div>
                    </div>
        <div class="press-modal">
        <div class="press-inner">
            <div class="swiper mySwiper">
                <div class="swiper-wrapper">
                    <div class="swiper-slide">
                                      <div class="row">

                                <div class="col-lg-5">

                                    <div class="bengali-film-archives-inner">
                                        <div id=exhibition-artwork class="owl-carousel owl-theme owl-loaded owl-drag">
                                            <?php foreach($exrow as $key) {?>
                                            <div class="item">
                                                <div class="details-info">
                                                    <div class="left-details">
                                                        <div class="details-img box target">
                                                         <?php   if($key['image'] != '')
                                                            { ?>
                                                            <img class="img-fluid" src="<?php echo SITE_URL . '/' . EXHIBITION_THUMB_IMGS . $key['image']; ?>">
                                                                <?php }else{ ?>
                                                                <img class="img-fluid" src="product_images/exhibition_thumbs/placeholder.jpg">
                                                                <?php } ?>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="artwork-bottom-img">
                                                    <img class="img-fluid" src="<?php echo SITE_URL . '/' . EXHIBITION_THUMB_IMGS . $key['image']; ?>">
                                                </div>
                                            </div>
                                        <?php } ?>
                                            <!-- <div class="item">

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
                                            </div> -->
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

                                </div>
                                <div class="col-lg-7">
                                    

                                    <div class="right-details">
                                        <?php foreach($exrow as $k){?>
                                        <div class="exhibition-search-title">
                                            <?php 
                                            if (!empty($k['artist_death'])) {

                                                echo $k['artist_name'] ;?>
                                                <span class="exhibition-span-title">
                                                    <?php
                                            echo '('. $k['artist_birth'] .'-'. $k['artist_death'] .')';?>
                                                </span>
                                            <?php }
                                            
                                            else{
                                            echo $k['artist_name'] ;?>
                                            <span class="exhibition-span-title">
                                            <?php 
                                            echo 'b.'. $k['artist_birth'] ;?>
                                            </span>
                                            <?php }
                                            ?>
                                        </div>
                                        <div class="artist-name">
                                            <?php echo $k['name'] .', '. $k['year']; ?>
                                        </div>
                                        <div class="exhibition-search-content">
                                            <?php echo $k['description']; ?>
                                        </div>   
                                    <?php } ?>
                                        <div class="artwork-details">
                                            <!-- <div class="details-box">
                                                <div class="details-img">
                                                    <span class="material-icons">info</span>


                                                </div>
                                                <div class="details-title">
                                                    Details
                                                </div>
                                            </div> -->
                                            <?php 
                                                foreach($exartwork as $v) {?>
                                            <div class="details-content">
                                                <!-- Base: --> <span><?php echo $v['medium']; ?></span>
                                            </div>
                                            <div class="details-content">
                                                <!-- Dimensions: --> <span><?php echo $v['dimension']; ?></span>
                                            </div>
                                            <!-- <div class="details-content">
                                                 Year:  <span>?php echo $v['year']; ?></span>
                                            </div> -->
                                            <div class="details-content">
                                                <!-- Info: --> <span><?php echo $v['reference_no']; ?></span>
                                            </div>
                                            <div class="details-content">
                                                <!-- Info 2: --> <span><?php echo $v['price']; ?></span>
                                            </div>
                                        <?php } ?>

                                        </div>
                                    </div>
                                </div>
                            </div>
                    </div>
                           <!-- <div class="swiper-slide">
                                      <div class="row">

                                 <div class="col-lg-5">

                                    <div class="bengali-film-archives-inner">
                                        <div id=exhibition-artwork-2 class="owl-carousel owl-theme owl-loaded owl-drag">

                                            <div class="item">
                                                <div class="details-info">
                                                    <div class="left-details">
                                                        <div class="details-img box target">
                                                            <img class="img-fluid" src="assets/img/exhibition-1.jpg">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="artwork-bottom-img">
                                                    <img class="img-fluid" src="assets/img/Bibliography-5.jpg">
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

                                </div>
                                <div class="col-lg-7">
                                    <div class="right-details">
                                        <div class="exhibition-search-title">
                                            Untitled Artwork 2
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
                                </div>
                            </div>
                    </div> -->
                </div>
                <div class="next-btn">
                     <div class="swiper-button-prev"><span class="material-icons">arrow_back</span> <p>prev</p></div>
                    <div class="swiper-button-next"><p>next</p><span class="material-icons">arrow_forward</span></div>
<!--                    <div class="swiper-pagination"></div>-->
                   
                </div>
            </div>
        </div>
    </div>
                </div>
            </div>
        </div>



    </section>



            <div class="press-modal">
                            <div class="modal fade" id="enlargeModal" tabindex="-1" aria-labelledby="enlargeModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                         <div class="modal-header">
<!--                    <h5 class="modal-title" id="pressModalLabel">Modal title</h5>-->
                    <a href="#" class="downlode"><span class="material-icons">crop_free</span></a>
                    <a href="#" class="downlode"><span class="material-icons">save_alt</span></a>
                     

                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                                        <div class="modal-body">
                                           <div class="light-part">
                                    <img class="img-fluid" src="<?php echo SITE_URL . '/' . EXHIBITION_THUMB_IMGS . $key['image']; ?>">
                                </div>
                                        </div>
                                        
                                    </div>
                                </div>
                            </div>
</div>
</main>