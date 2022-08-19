    <!-- <main class="pb-0">
    <div class="container">
        <div class="row justify-content-center text-center">
            <div class="col-lg-6">
                <form method="post" name="search_form" id="search_form_all" role="form" class="bibliography-search-form">
                    <div class="row justify-content-center flex-nowrap">
                        <div class="col-12">
                            <select class="program-name2 form-control" id="select-all-attr" name="searchall[]"  data-placeholder="Type for Complete Search"></select> -->
                            <!-- <button type="submit" class="btn btn-primary form-control" value="all-entry-point" name="all-search-entry">GO <i class="fa fa-search" aria-hidden="true"></i></button> -->
                        <!-- </div>
                        <input type="hidden" name="catg" value="all">
                        <input type="hidden" name="att[0]" value="author">
                        <input type="hidden" name="att[1]" value="artist">
                        <input type="hidden" name="att[2]" value="editor">
                        <input type="hidden" name="att[3]" value="film">
                        <input type="hidden" name="att[4]" value="cast">
                        <input type="hidden" name="att[5]" value="director">
                        <input type="hidden" name="att[6]" value="va_artist">
                    </div>
                </form>
            </div>
        </div>
    </div>
</main> -->

<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <?php // include 'assets/inc/header.php';?>
    <section class="start-body start-body-desktop">
        <div class="container">
            <div class="row">
                <div class="col-lg-7">
                    <div class="left-body">
                        
                        <div class="left-title">
                            It all starts here!
                        </div>
                        <div class="left-content">
                            Type something to begin search. For eg: Satyajit Ray
                        </div>
                        <div class="hearder-options">
                            <div class="user-options">
                               
                                <div class="search-wrap">
                                    <div class="search">
                                        <div class="top-search">
                                                 <div class="search-barOption">
                                            <!-- <form action="product_search.php" class="search-input" method="post">
                                                <input class="form-control" type="search" placeholder="Search" name="keyword" value="" id="mySearch" required>
                                                <button class="btn-search" type="submit"><span class="material-icons">search</span></button>
                                            </form> -->
                                            <form method="post" name="search_form" id="search_form_all" role="form" class="search-input">
                                                <!-- <div class="row justify-content-center flex-nowrap"> -->
                                                    <!-- <div class="col-12"> -->
                                                        <select class="program-name2 form-control" id="select-all-attr" name="searchall[]"  data-placeholder="Search"></select>
                                                        <button class="btn-search" type="submit"><span class="material-icons">search</span></button>

                                                        <!-- <input class="form-control" type="search" placeholder="Search" name="searchall[]" value="" id="select-all-attr" required> -->
                                                        <!-- <button class="btn-search" type="submit"><span class="material-icons">search</span></button> -->
                                                        
                                                        <!-- <button type="submit" class="btn btn-primary form-control" value="all-entry-point" name="all-search-entry">GO <i class="fa fa-search" aria-hidden="true"></i></button> -->
                                                    <!-- </div> -->
                                                    <input type="hidden" name="catg" value="all">
                                                    <input type="hidden" name="att[0]" value="author">
                                                    <input type="hidden" name="att[1]" value="artist">
                                                    <input type="hidden" name="att[2]" value="editor">
                                                    <input type="hidden" name="att[3]" value="film">
                                                    <input type="hidden" name="att[4]" value="cast">
                                                    <input type="hidden" name="att[5]" value="director">
                                                    <input type="hidden" name="att[6]" value="va_artist">
                                                <!-- </div> -->
                                            </form>
                                        </div>

                                        <div class="drop-form">
                                                                   <div class="dropdown">
                                                    <button type="button" class="btn btn-light dropdown-toggle" data-toggle="dropdown">
                                                        <p>VISUAL ARCHIVES<span class="material-icons">keyboard_arrow_down</span></p>


                                                    </button>
                                                    <div class="dropdown-menu radio">

                                                        <label class="dropdown-item">
                                                            <input class="jRadioDropdown" type="radio" value="001" name="alphabet">
                                                            <i>VISUAL ARCHIVES</i>
                                                        </label>

                                                        <label class="dropdown-item">
                                                            <input class="jRadioDropdown" type="radio" value="002" name="alphabet">
                                                            <i>BIBLIOGRAPHY</i>
                                                        </label>

                                                        <label class="dropdown-item">
                                                            <input class="jRadioDropdown" type="radio" value="003" name="alphabet">
                                                            <i>MEMORABILIA</i>
                                                        </label>



                                                    </div>
                                                </div>
         
                                        </div>
                                        </div>
                                        
                                   
                                        <div id="search_display">
                                            <div class="search_ajaxdetails">
                                                <div class="is-ajax-search-posts">

                                                    <div class="is-items-search-post is-product">
                                                        <div class="is-search-sections">

                                                            <div class="right-section">
                                                                <div class="meta">
                                                                    <div class="search_price">
                                                                        Satyajit Bose (CAST)
                                                                    </div>
                                                                    <div class="is-title">
                                                                        <a href="#/">Memorabilia</a>
                                                                    </div>
                                                                </div>

                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="is-items-search-post is-product">
                                                        <div class="is-search-sections">

                                                            <div class="right-section">
                                                                <div class="meta">
                                                                    <div class="search_price">
                                                                        Satyajit Mukhopadhyay (AUTHOR)
                                                                    </div>
                                                                    <div class="is-title">
                                                                        <a href="#/">bibliography</a>
                                                                    </div>
                                                                </div>

                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="is-items-search-post is-product">
                                                        <div class="is-search-sections">

                                                            <div class="right-section">
                                                                <div class="meta">
                                                                    <div class="search_price">
                                                                        Satyajit Mukhopadhyay (ARTIST)
                                                                    </div>
                                                                    <div class="is-title">
                                                                        <a href="#/">bibliography</a>
                                                                    </div>
                                                                </div>

                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="is-items-search-post is-product">
                                                        <div class="is-search-sections">

                                                            <div class="right-section">
                                                                <div class="meta">
                                                                    <div class="search_price">
                                                                        Satyajit Ray (EDITOR)
                                                                    </div>
                                                                    <div class="is-title">
                                                                        <a href="#/">bibliography</a>
                                                                    </div>
                                                                </div>

                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="is-items-search-post is-product">
                                                        <div class="is-search-sections">

                                                            <div class="right-section">
                                                                <div class="meta">
                                                                    <div class="search_price">
                                                                        Satyajit Chaudhury (AUTHOR)
                                                                    </div>
                                                                    <div class="is-title">
                                                                        <a href="#/">bibliography</a>
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
                        </div>
                        <div class="header-middle-title">
                            <a href="#" class="middle-sec">Gallery Rasa</a> rests on the confluence of knowledge and commerce, striving to promote a better understanding of <a href="#" class="middle-sec">Indian art, crafts, film and culture</a> through its archival presence, collaborating to mount meaningful exhibitions and foster a dialogue of ideas to complement our vision.
                        </div>
                        <div class="header-middle-content or-3">
                                Indian art has long since lost its sheltered selective audience and is making inroads worldwide. Its growing relevance has pushed the bounds of its study and collection. However, comprehensive and qualitative research remains scattered and has not kept pace with its inexorable growth. Thus, we aim to build a broader understanding and ownership of art in our nation.
                        </div>
                    </div>
                </div>
                
                <div class="col-lg-5">
                    <div class="right-part">
                             <div id="my-about" class="owl-carousel owl-theme owl-loaded owl-drag">
						     <div class="item">
                                 <div class="img-box">
                                     <img class="img-fluid" src="images/image4.jpg">
                                 </div>
                             </div>
                             <div class="item">
                                 <div class="img-box">
                                     <img class="img-fluid" src="images/image5.jpg">
                                 </div>
                             </div>
                             <div class="item">
                                 <div class="img-box">
                                     <img class="img-fluid" src="images/image6.jpg">
                                 </div>
                             </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>    
        <section class="start-body start-body-mobile">
        <div class="container">
            <div class="row">
                <div class="col-lg-7">
                    <div class="left-body">
                        
                        <div class="left-title">
                            It all starts here!
                        </div>
                        <div class="left-content">
                            Type something to begin search. For eg: Satyajit Ray
                        </div>
                        <div class="hearder-options">
                            <div class="user-options">
                               
                                <div class="search-wrap">
                                    <div class="search">
                                        <div class="top-search">
                                                 <div class="search-barOption">
                                            <form action="product_search.php" class="search-input" method="post">
                                                <input class="form-control" type="search" placeholder="Search" name="keyword" value="" id="mySearch" required>
                                                <button class="btn-search" type="submit"><i class="zmdi zmdi-search"></i></button>
                                            </form>
                                        </div>

                                            <div class="drop-form">
                                                                <div class="dropdown">
                                                    <button type="button" class="btn btn-light dropdown-toggle" data-toggle="dropdown">
                                                        <p>VISUAL ARCHIVES<span class="material-icons">keyboard_arrow_down</span></p>
                                                    </button>
                                                    <div class="dropdown-menu radio">

                                                        <label class="dropdown-item">
                                                            <input class="jRadioDropdown" type="radio" value="001" name="alphabet">
                                                            <i>VISUAL ARCHIVES</i>
                                                        </label>

                                                        <label class="dropdown-item">
                                                            <input class="jRadioDropdown" type="radio" value="002" name="alphabet">
                                                            <i>BIBLIOGRAPHY</i>
                                                        </label>

                                                        <label class="dropdown-item">
                                                            <input class="jRadioDropdown" type="radio" value="003" name="alphabet">
                                                            <i>MEMORABILIA</i>
                                                        </label>



                                                    </div>
                                                </div>
         
                                        </div>
                                            
                                        </div>
                                   
                                        <div id="search_display">
                                            <div class="search_ajaxdetails">
                                                <div class="is-ajax-search-posts">

                                                    <div class="is-items-search-post is-product">
                                                        <div class="is-search-sections">

                                                            <div class="right-section">
                                                                <div class="meta">
                                                                    <div class="search_price">
                                                                        Satyajit Bose (CAST)
                                                                    </div>
                                                                    <div class="is-title">
                                                                        <a href="#/">Memorabilia</a>
                                                                    </div>
                                                                </div>

                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="is-items-search-post is-product">
                                                        <div class="is-search-sections">

                                                            <div class="right-section">
                                                                <div class="meta">
                                                                    <div class="search_price">
                                                                        Satyajit Mukhopadhyay (AUTHOR)
                                                                    </div>
                                                                    <div class="is-title">
                                                                        <a href="#/">bibliography</a>
                                                                    </div>
                                                                </div>

                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="is-items-search-post is-product">
                                                        <div class="is-search-sections">

                                                            <div class="right-section">
                                                                <div class="meta">
                                                                    <div class="search_price">
                                                                        Satyajit Mukhopadhyay (ARTIST)
                                                                    </div>
                                                                    <div class="is-title">
                                                                        <a href="#/">bibliography</a>
                                                                    </div>
                                                                </div>

                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="is-items-search-post is-product">
                                                        <div class="is-search-sections">

                                                            <div class="right-section">
                                                                <div class="meta">
                                                                    <div class="search_price">
                                                                        Satyajit Ray (EDITOR)
                                                                    </div>
                                                                    <div class="is-title">
                                                                        <a href="#/">bibliography</a>
                                                                    </div>
                                                                </div>

                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="is-items-search-post is-product">
                                                        <div class="is-search-sections">

                                                            <div class="right-section">
                                                                <div class="meta">
                                                                    <div class="search_price">
                                                                        Satyajit Chaudhury (AUTHOR)
                                                                    </div>
                                                                    <div class="is-title">
                                                                        <a href="#/">bibliography</a>
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
                        </div>
                        </div>
                </div>
                     <div class="col-lg-5">          
                    <div class="right-part">
                             <div id="my-about-mobile" class="owl-carousel owl-theme owl-loaded owl-drag">
						     <div class="item">
                                 <div class="img-box">
                                     <img class="img-fluid" src="images/image4.jpg">
                                 </div>
                             </div>
                             <div class="item">
                                 <div class="img-box">
                                     <img class="img-fluid" src="images/image5.jpg">
                                 </div>
                             </div>
                             <div class="item">
                                 <div class="img-box">
                                     <img class="img-fluid" src="images/image6.jpg">
                                 </div>
                             </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-7">
                    <div class="left-body">
                
                        <div class="header-middle-title">
                            <a href="#" class="middle-sec">Gallery Rasa</a> rests on the confluence of knowledge and commerce, striving to promote a better understanding of <a href="#" class="middle-sec">Indian art, crafts, film and culture</a> through its archival presence, collaborating to mount meaningful exhibitions and foster a dialogue of ideas to complement our vision.
                        </div>
                        <div class="header-middle-content or-3">
                            Indian art has long since lost its sheltered selective audience and is making inroads worldwide. Its growing relevance has pushed the bounds of its study and collection. However, comprehensive and qualitative research remains scattered and has not kept pace with its inexorable growth. Thus, we aim to build a broader understanding and ownership of art in our nation.
                        </div>
                    </div>
                
                </div>
            </div>
        </div>
    </section>


    <?php // include 'assets/inc/footer.php';?>

    </body>

</html>
