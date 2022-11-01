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
            foreach($exrow as $k) { ?>
            <div class="row">
                <div class="col-lg-6">
                    <div class="details-info">
                        <div class="left-details">
                            <div class="details-img box target">
                            <?php  
                                if($k['photo'] != '')
                                { ?>
                                    <img class="img-fluid" src="<?php echo SITE_URL . '/' . EXHIBITION_THUMB_IMGS . $k['photo']; ?>">
                                <?php }else{ ?>
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
                                    $date = date('jS M, Y',$date_time);
                                    $time = date('h:i A',$date_time);
                                    $dt = strtotime(str_replace(',', '', $dt));
                                    $d = date('jS M, Y',$dt);
                                    $t = date('h:i A',$dt);

                                    echo $date .' to '. $d;?>
                                </li>
                                <!-- <li><span class="material-icons">watch_later</span>
                                ?php echo $time .' to '. $t; ?>
                                 11:00 HRS - 18:00 HRS IST
                                </li> -->
                                <li><span class="material-icons">festival</span>
                                    <?php 
                                    if ($k['full_address']) {
                                        echo $k['city'] .','. $k['full_address'];    
                                    }
                                    else{
                                        echo $k['city'];    
                                    }
                                     ?></li>


                            </ul>
                        </div>
                        <div class="exhibition-search-content">
                            
                            <div class="content hideContent">
                            <?php echo $k['description'];?>
                            
                            </div>  
                            <?php if(substr($k['description'],241,2000)){ ?>
                              
                            <div class="read-action exbition_readmore">
                                <button class="show-more">Read more</button>
                            </div>                          
                            
                             
                            <?php } ?>                        
                            <!-- <button onclick="myFunction()" id="myBtn">Read more</button> -->

                        </div>
                        <?php if ($k['essay_2']) { ?>
                            
                        <div class="exhibition-search-content">
                            
                            <div class="content hideContent">
                            <?php echo $k['essay_2'];?>
                            
                            </div>  
                            <?php if(substr($k['essay_2'],241,2000)){ ?>
                            <div class="read-action exbition_readmore">                           
                            <button class="show-more">Read more</button>
                            </div>  
                            <?php } ?>                        
                            <!-- <button onclick="myFunction()" id="myBtn">Read more</button> -->

                        </div>
                    <?php } ?>
                    <?php if ($k['essay_3']) { ?>
                            
                        <div class="exhibition-search-content">
                            
                            <div class="content hideContent">
                            <?php echo $k['essay_3'];?>
                            
                            </div>  
                            <?php if(substr($k['essay_3'],241,2000)){ ?>
                            <div class="read-action exbition_readmore">
                            <button class="show-more">Read more</button>
                            </div>  
                            <?php } ?>                        
                            <!-- <button onclick="myFunction()" id="myBtn">Read more</button> -->

                        </div>
                    <?php } ?>
                        <!-- <div class="exhibition-search-content">
                            ?php echo substr($k['essay_2'],0,240);if($k['essay_2']){  ?>                        
                            <span id="dots1">...</span>
                            <span id="more1">?php echo substr($k['essay_2'],241,2000); ?></span>
                            <button onclick="myFunction1()" id="myBtn1">Read more</button>
                            ?php } ?>
                        </div> -->
                        <!-- <div class="exhibition-search-content">
                            ?php echo substr($k['essay_3'],0,240);if($k['essay_3']){ ?>

                            <span id="dots2">...</span>
                            <span id="more2">?php echo substr($k['essay_3'],241,2000); ?></span>
                            <button onclick="myFunction2()" id="myBtn2">Read more</button>
                        ?php } ?>
                        </div> -->
                        <!-- <div class="exhibition-search-content">
                            Lorem ipsum dolor sit amet, consectetur adipiscing elit. In sed orci eget nulla ultrices accumsan. Integer rhoncus metus sit amet lacinia posuere.
                        </div> -->
                        <div class="enquiry-btn">ENQUIRE<span class="material-icons arrow">arrow_forward</span></div>
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
                                    foreach($exartwork as $v) { ?>
                                    <div class="artist-box-doc">
                                        <a href="<?php SITE_URL ?>./exhibition-artwork.php?id=<?php echo $v['id']; ?>">
                                            <div class="artist-box">
                                        <div class="artist-box-info">
                                            <div class="artist-img">
                                                <!-- <img class="img-fluid" src="assets/img/exhibition-1.jpg"> -->
                                                <?php  
                                                    if($v['image'] != '')
                                                    { ?>
                                                        <img class="img-fluid" src="<?php echo SITE_URL . '/' . EXHIBITION_THUMB_IMGS . $v['image']; ?>">
                                                    <?php }else{ ?>
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
                                                    <?php echo ($v['medium']); ?>
                                                </div>
                                                <div class="artist-year">
                                                    <?php echo ($v['dimension']); ?>
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
                                    foreach($exartist as $key) { ?>
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
                    <a href="#" class="downlode"><span class="material-icons">save_alt</span></a>
                     

                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                                        <div class="modal-body">
                                           <div class="light-part">
                                    <img class="img-fluid" src="<?php echo SITE_URL . '/' . EXHIBITION_THUMB_IMGS . $k['photo']; ?>">
                                </div>
                                        </div>
                                        
                                    </div>
                                </div>
                            </div>
</div>
</main>


