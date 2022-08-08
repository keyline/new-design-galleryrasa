<main>
    <section class="start-body visual-page rasa-inner exhibition-page">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="visual-inner">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="exhibition-top-box">
                                    <div class="exhibition-top">
                                        <div class="exhibition-img">
                                            <img class="img-fluid" src="assets/img/podcast-img-1.jpg" alt="">
                                        </div>
                                        <div class="visual-info">
                                            <div class="event">FEATURED EVENT</div>
                                            <div class="visual-title">
                                                The Satyajit Ray Centenary Show - Volume 1
                                            </div>
                                            <div class="visual-content">
                                                Lorem ipsum dolor sit amet, consectetur adipiscing elit. In sed orci eget nulla ultrices accumsan. Integer rhoncus metus sit amet lacinia posuere.
                                            </div>
                                        </div>
                                    </div>
                                    <div class="detailes-action">
                                        <a href="#" class="detailes-btn">
                                            view details<span class="material-icons arrow">arrow_forward</span>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="exhibition-tab artist-search">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 pr-0 pl-1">
                    <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <a class="nav-link active" id="pills-home-tab" data-toggle="pill" href="#pills-home" role="tab" aria-controls="pills-home" aria-selected="true">CURRENT EXHIBITIONS</a>
                        </li>
                        <li class="nav-item" role="presentation">
                            <a class="nav-link" id="pills-profile-tab" data-toggle="pill" href="#pills-profile" role="tab" aria-controls="pills-profile" aria-selected="false">UPCOMING EXHIBITIONS</a>
                        </li>
                        <li class="nav-item" role="presentation">
                            <a class="nav-link" id="pills-contact-tab" data-toggle="pill" href="#pills-contact" role="tab" aria-controls="pills-contact" aria-selected="false">PAST EXHIBITIONS</a>
                        </li>
                    </ul>
                    <div class="tab-content" id="pills-tabContent">                        
                        <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
                            <div class="artist-inner">
                                <div class="artist-info">
                                    <?php
                                    date_default_timezone_set('Asia/Kolkata');
                                    $curDateTime = date("Y-m-d");
                                    echo $curDateTime;
                                    echo "<br>";                                     
                                        foreach($exrow as $k => $v) {
                                            
                                        if ($v['from_exhibition_date'] > $curDateTime) {
                                             echo $v['from_exhibition_date']; exit();
                                         } ?>
                                    <div class="artist-box-doc">
                                        <a href="<?php SITE_URL ?>./exhibition-details.php?id=<?php echo $v['id']; ?>">
                                            <div class="artist-box">
                                                <div class="artist-box-info">
                                                    <div class="artist-img">
                                                        <img class="img-fluid" src="<?php echo SITE_URL . '/' . EXHIBITION_THUMB_IMGS . $v['photo']; ?>">
                                                    </div>
                                                    <div class="exhibition-info">
                                                        <div class="exhibition-content">
                                                            <?php echo $v['exhibition_name']; ?>
                                                        </div>
                                                        <div class="artist-year">
                                                            <?php echo $v['from_exhibition_date'] .'-'. $v['end_exhibition_date'];?>
                                                        </div>
                                                        <div class="artist-place">
                                                            <?php echo $v['city']; ?>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                <?php } ?>
                                    
                                    </div>
                            </div>
                        </div>
                        <!-- <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
                            <div class="artist-inner">
                                <div class="artist-info">
                                    <div class="artist-box-doc">
                                        <a href="./exhibition-details.php">
                                            <div class="artist-box">
                                        <div class="artist-box-info">
                                            <div class="artist-img">
                                                <img class="img-fluid" src="assets/img/exhibition-1.jpg">
                                            </div>
                                            <div class="exhibition-info">
                                                <div class="exhibition-content">
                                                    Lorem ipsum dolor sit amet, consectetur adipiscing elit.
                                                </div>
                                                <div class="artist-year">
                                                    27 nov 2021 - 21 APR 2022
                                                </div>
                                                <div class="artist-place">
                                                    kolkata
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                        </a>
                                    </div>
                                    <div class="artist-box-doc">
                                        <a href="./exhibition-details.php">
                                            <div class="artist-box">
                                        <div class="artist-box-info">
                                            <div class="artist-img">
                                                <img class="img-fluid" src="assets/img/exhibition-1.jpg">
                                            </div>
                                            <div class="exhibition-info">
                                                <div class="exhibition-content">
                                                    Lorem ipsum dolor sit amet, consectetur adipiscing elit.
                                                </div>
                                                <div class="artist-year">
                                                    27 nov 2021 - 21 APR 2022
                                                </div>
                                                <div class="artist-place">
                                                    kolkata
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                        </a>
                                    </div>
                                    <div class="artist-box-doc">
                                        <a href="./exhibition-details.php">
                                            <div class="artist-box">
                                        <div class="artist-box-info">
                                            <div class="artist-img">
                                                <img class="img-fluid" src="assets/img/exhibition-1.jpg">
                                            </div>
                                            <div class="exhibition-info">
                                                <div class="exhibition-content">
                                                    Lorem ipsum dolor sit amet, consectetur adipiscing elit.
                                                </div>
                                                <div class="artist-year">
                                                    27 nov 2021 - 21 APR 2022
                                                </div>
                                                <div class="artist-place">
                                                    kolkata
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                        </a>
                                    </div>
                                    
                                    
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="pills-contact" role="tabpanel" aria-labelledby="pills-contact-tab">
                            <div class="artist-inner">
                                <div class="artist-info">
                                    <div class="artist-box-doc">
                                        <a href="./exhibition-details.php">
                                            <div class="artist-box">
                                        <div class="artist-box-info">
                                            <div class="artist-img">
                                                <img class="img-fluid" src="assets/img/exhibition-1.jpg">
                                            </div>
                                            <div class="exhibition-info">
                                                <div class="exhibition-content">
                                                    Lorem ipsum dolor sit amet, consectetur adipiscing elit.
                                                </div>
                                                <div class="artist-year">
                                                    27 nov 2021 - 21 APR 2022
                                                </div>
                                                <div class="artist-place">
                                                    kolkata
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                        </a>
                                    </div>
                                    <div class="artist-box-doc">
                                        <a href="./exhibition-details.php">
                                            <div class="artist-box">
                                        <div class="artist-box-info">
                                            <div class="artist-img">
                                                <img class="img-fluid" src="assets/img/exhibition-1.jpg">
                                            </div>
                                            <div class="exhibition-info">
                                                <div class="exhibition-content">
                                                    Lorem ipsum dolor sit amet, consectetur adipiscing elit.
                                                </div>
                                                <div class="artist-year">
                                                    27 nov 2021 - 21 APR 2022
                                                </div>
                                                <div class="artist-place">
                                                    kolkata
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                        </a>
                                    </div>
                                    <div class="artist-box-doc">
                                        <a href="./exhibition-details.php">
                                            <div class="artist-box">
                                        <div class="artist-box-info">
                                            <div class="artist-img">
                                                <img class="img-fluid" src="assets/img/exhibition-1.jpg">
                                            </div>
                                            <div class="exhibition-info">
                                                <div class="exhibition-content">
                                                    Lorem ipsum dolor sit amet, consectetur adipiscing elit.
                                                </div>
                                                <div class="artist-year">
                                                    27 nov 2021 - 21 APR 2022
                                                </div>
                                                <div class="artist-place">
                                                    kolkata
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                        </a>
                                    </div>
                                  
                                    <div class="artist-box-doc">
                                        <a href="./exhibition-details.php">
                                            <div class="artist-box">
                                        <div class="artist-box-info">
                                            <div class="artist-img">
                                                <img class="img-fluid" src="assets/img/exhibition-1.jpg">
                                            </div>
                                            <div class="exhibition-info">
                                                <div class="exhibition-content">
                                                    Lorem ipsum dolor sit amet, consectetur adipiscing elit.
                                                </div>
                                                <div class="artist-year">
                                                    27 nov 2021 - 21 APR 2022
                                                </div>
                                                <div class="artist-place">
                                                    kolkata
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                        </a>
                                    </div>
                                    <div class="artist-box-doc">
                                        <a href="./exhibition-details.php">
                                            <div class="artist-box">
                                        <div class="artist-box-info">
                                            <div class="artist-img">
                                                <img class="img-fluid" src="assets/img/exhibition-1.jpg">
                                            </div>
                                            <div class="exhibition-info">
                                                <div class="exhibition-content">
                                                    Lorem ipsum dolor sit amet, consectetur adipiscing elit.
                                                </div>
                                                <div class="artist-year">
                                                    27 nov 2021 - 21 APR 2022
                                                </div>
                                                <div class="artist-place">
                                                    kolkata
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                        </a>
                                    </div>
                              
                                    <div class="artist-box-doc">
                                        <a href="./exhibition-details.php">
                                            <div class="artist-box">
                                        <div class="artist-box-info">
                                            <div class="artist-img">
                                                <img class="img-fluid" src="assets/img/exhibition-1.jpg">
                                            </div>
                                            <div class="exhibition-info">
                                                <div class="exhibition-content">
                                                    Lorem ipsum dolor sit amet, consectetur adipiscing elit.
                                                </div>
                                                <div class="artist-year">
                                                    27 nov 2021 - 21 APR 2022
                                                </div>
                                                <div class="artist-place">
                                                    kolkata
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                        </a>
                                    </div>
                                    <div class="artist-box-doc">
                                        <a href="./exhibition-details.php">
                                            <div class="artist-box">
                                        <div class="artist-box-info">
                                            <div class="artist-img">
                                                <img class="img-fluid" src="assets/img/exhibition-1.jpg">
                                            </div>
                                            <div class="exhibition-info">
                                                <div class="exhibition-content">
                                                    Lorem ipsum dolor sit amet, consectetur adipiscing elit.
                                                </div>
                                                <div class="artist-year">
                                                    27 nov 2021 - 21 APR 2022
                                                </div>
                                                <div class="artist-place">
                                                    kolkata
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div> -->
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Modal -->
    <div class="advance-modal">
        <div class="modal fade" id="advancedModal" tabindex="-1" aria-labelledby="advancedModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <!--
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
-->
                    <div class="modal-body">
                        <div class="advanced-search">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="search-title">
                                        Advanced Search
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="right-part">
                                        <form>
                                            <div class="form-group">
                                                <input type="email" class="form-control" placeholder="NAME">
                                            </div>

                                            <div class="form-group">
                                                <div class='select'>
                                                    <p class='input'>year of publication</p>
                                                    <input type='hidden' name='some_name_to_form' />
                                                    <div class='hidden'>
                                                        <p style="cursor:default" value='id_1'>year of publication</p>
                                                        <p style="cursor:default" value='id_2'>year of publication2</p>
                                                        <p style="cursor:default" value='id_3'>year of publication3</p>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class='select'>
                                                    <p class='input'>from year</p>
                                                    <input type='hidden' name='some_name_to_form' />
                                                    <div class='hidden'>
                                                        <p style="cursor:default" value='id_1'>from year</p>
                                                        <p style="cursor:default" value='id_2'>from year2</p>
                                                        <p style="cursor:default" value='id_3'>from year3</p>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class='select'>
                                                    <p class='input'>medium</p>
                                                    <input type='hidden' name='some_name_to_form' />
                                                    <div class='hidden'>
                                                        <p style="cursor:default" value='id_1'>medium</p>
                                                        <p style="cursor:default" value='id_2'>medium2</p>
                                                        <p style="cursor:default" value='id_3'>medium3</p>
                                                    </div>
                                                </div>
                                            </div>

                                            <button type="button" class="search-box">Search</button>
                                        </form>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="right-part">
                                        <form>


                                            <div class="form-group">
                                                <div class='select'>
                                                    <p class='input'>CLASSIFICATION</p>
                                                    <input type='hidden' name='some_name_to_form' />
                                                    <div class='hidden'>
                                                        <p style="cursor:default" value='id_1'>CLASSIFICATION</p>
                                                        <p style="cursor:default" value='id_2'>CLASSIFICATION2</p>
                                                        <p style="cursor:default" value='id_3'>CLASSIFICATION3</p>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class='select'>
                                                    <p class='input'>year of artwork</p>
                                                    <input type='hidden' name='some_name_to_form' />
                                                    <div class='hidden'>
                                                        <p style="cursor:default" value='id_1'>year of artwork</p>
                                                        <p style="cursor:default" value='id_2'>year of artwork2</p>
                                                        <p style="cursor:default" value='id_3'>year of artwork3</p>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class='select'>
                                                    <p class='input'>to year</p>
                                                    <input type='hidden' name='some_name_to_form' />
                                                    <div class='hidden'>
                                                        <p style="cursor:default" value='id_1'>to year</p>
                                                        <p style="cursor:default" value='id_2'>to year2</p>
                                                        <p style="cursor:default" value='id_3'>to year3</p>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <input type="email" class="form-control" placeholder="descriptive tags">
                                            </div>

                                            <button type="button" class="cancel-btn" data-dismiss="modal">CANCEL</button>
                                        </form>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                    <!--
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        
      </div>
-->
                </div>
            </div>
        </div>
    </div>
</main>

$upcoming .='<div class=\"tab-pane fade show active\" id=\"pills-profile\" role=\"tabpanel\" aria-labelledby=\"pills-home-tab\">
                            <div class=\"artist-inner\">
                                <div class=\"artist-info\">                                
                                         <div class="artist-box-doc">
                                        <a href=" SITE_URL ./exhibition-details.php?id= $v['id']; ?>">
                                            <div class="artist-box">
                                                <div class="artist-box-info">
                                                    <div class="artist-img">
                                                        <img class="img-fluid" src="<?php echo SITE_URL . '/' . EXHIBITION_THUMB_IMGS . $v['photo']; ?>">
                                                    </div>
                                                    <div class="exhibition-info">
                                                        <div class="exhibition-content">
                                                            <?php echo $v['exhibition_name']; ?>
                                                        </div>
                                                        <div class="artist-year">
                                                            <?php echo $v['from_exhibition_date'] .'-'. $v['end_exhibition_date'];?>
                                                        </div>
                                                        <div class="artist-place">
                                                            <?php echo $v['city']; ?>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                <?php } ?>
                                    
                                    </div>
                            </div>';

exit();