<section class="testimonials vision-statement visual-search-details-page exhibition-details-page exhibition-artist-details exhibition-details-moredetails">
        <div class="container">
            <div class="visual-inner">
                        <div class="back-action">
                            <a href="<?php echo SITE_URL?>exhibition-details.php?id=<?php echo $_REQUEST['exhibitionid']; ?>"  class="back-btn" onclick="history.go(-1)" ><span class="material-icons">arrow_back</span>back</a>
                        </div>
                    </div>
        <?php foreach($exrow as $key) { ?>
            <div class="row">                
                <div class="col-lg-12 desktop_order2">
                    <div class="testimonials-inner">
                        <div class="visual-title">
                            <?php echo $key['exhibition_name'] ?>
                        </div>
                        <div class="visual-content">
                           <?php 
                           if ($_REQUEST['essayno'] == '1') {
                               echo $key['description'];
                           }
                           elseif ($_REQUEST['essayno'] == '2') {
                               echo $key['essay_2'];
                           }
                           else{
                            echo $key['essay_3'];
                           }
                            ?>
                        </div>
                    </div>
                     </div>
                             
            </div>
        <?php } ?>


            <div class="wrap-enquiry-socialbtns">
                <div id="shareRoundIcons"></div>
                    <div class="dropdown">
                          <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Share 
                          </button>

                          <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                            <?php 
                           if ($_REQUEST['essayno'] == '1') {
                                $essayno = '1';
                           }
                           elseif ($_REQUEST['essayno'] == '2') {
                               $essayno = '2';
                           }
                           else{
                            $essayno = '3';
                           }
                            ?>
                            <a class="dropdown-item" href="https://www.facebook.com/sharer.php?u=<?php echo SITE_URL . 'article-details/'. $key['id'] . '/' . $essayno;?>" target="_blank"> <img class="img-fluid" src="<?php echo SITE_URL . SITE_IMGS ;?>facebook.png">&nbsp;Facebook</a>
                            <a class="dropdown-item" href="https://www.instagram.com/?u=<?php echo SITE_URL . 'article-details/'. $key['id'] . '/' . $essayno;?>" target="_blank"><img class="img-fluid" src="<?php echo SITE_URL . SITE_IMGS ;?>insta.png">&nbsp;Instagram</a>
                            <a class="dropdown-item" href="https://twitter.com/share?u=<?php echo SITE_URL . 'article-details/'. $key['id'] . '/' . $essayno;?>" target="_blank"><img class="img-fluid" src="<?php echo SITE_URL . SITE_IMGS ;?>twe.png">&nbsp;Twitter</a>
                            <a class="dropdown-item" href="http://www.linkedin.com/shareArticle?mini=true&amp;u=<?php echo SITE_URL . 'article-details/'. $key['id'] . '/' . $essayno;?>" target="_blank"><img class="img-fluid" src="<?php echo SITE_URL . SITE_IMGS ;?>in.png">&nbsp;LinkedIn</a>
                    </div>
                </div>
            </div>



        </div>
        
    </section>

