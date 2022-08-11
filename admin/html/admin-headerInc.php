<!DOCTYPE html>
<html lang="en">
    <head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title><?php echo!isset($title) ? ('Administration') : ($title) ?></title>

        <link href="<?php echo SITE_URL  ?>/admincss/bootstrap.css" rel="stylesheet">
        <link href="<?php echo SITE_URL  ?>/admincss/jquery-ui.css" rel="stylesheet">
        <link href="<?php echo SITE_URL ?>/admincss/select2.css" rel="stylesheet">
        <link href="<?php echo SITE_URL  ?>/admincss/multiple-select.css" rel="stylesheet">
        <link href="<?php echo SITE_URL  ?>/admincss/swipebox.css" rel="stylesheet">
        <link href="<?php echo SITE_URL  ?>/admincss/style.css" rel="stylesheet">
        <link href="<?php echo SITE_URL ?>/admincss/bootstrap-switch.css" rel="stylesheet">
        <link href="<?php echo SITE_URL  ?>/admincss/datetimepicker.css" rel="stylesheet">
        <link href="<?php echo SITE_URL ?>/adminjs/treejs/treejs.css" rel="stylesheet">
        <link href="<?php echo SITE_URL ?>/adminjs/treejs/doc_style.css" rel="stylesheet">
        <link href="<?php echo SITE_URL  ?>/admincss/jquery.dataTables.min.css" rel="stylesheet">
        <link href="<?php echo SITE_URL ?>/adminjs/plupload-master/jquery.ui.plupload/css/jquery.ui.plupload.css" rel="stylesheet">
        <link href="<?php echo SITE_URL ?>/adminjs/plupload-master/css/jquery.plupload.queue.css" rel="stylesheet">
        <link href="<?php echo ADMIN_URL ?>/css/custom.css" rel="stylesheet">

        

        <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
        <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
          <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->

        <link href="<?php echo SITE_URL . JS_FOLDER ?>/adminjs/summernotes/summernote.css" rel="stylesheet">

    </head>

    <body>

        <div class="front-container" style="margin: 20px 0px;" >
            <div class="header clearfix">
                <nav>
                    <h3>Gallery Rasa Administration</h3>
                    <ul class="nav nav-pills pull-right">
                        <li role="presentation" class="active"><a href="dashboard.php">Dashboard</a></li>
                        <li role="presentation" class="active"><a href="logout.php">Logout</a></li>
                        <!--<li role="presentation" class="active"><a href="logout">Logout</a></li>-->
                    </ul>
                </nav>

            </div>
        </div>

        <div class="front-container">
            <div class="row">
                <div class="col-sm-3 col-md-3">
                    <div id="accordion">
                        <div class="panel-group" role="tablist" style="margin-bottom:0.5em; ">
                            <div class="panel panel-default">
                                <div class="panel-heading" role="tab" id="collapseListGroupHeading2">
                                    <h4 class="panel-title">
                                        <a class="" role="button" data-toggle="collapse" href="#collapseListGroup3" aria-expanded="true" aria-controls="collapseListGroup3">
                                            Bibliograply
                                        </a>
                                    </h4>
                                </div>

                                <div id="collapseListGroup3"  class="panel-collapse collapse" role="tabpane2" aria-labelledby="collapseListGroupHeading3" aria-expanded="true">
                                    <div class="list-group" >
                                        <a href="manage-bibliography" class="list-group-item">
                                            Manage Bibliograply 
                                        </a>
                                    </div>
                                    <div class="list-group" >
                                        <a href="bib-attribute-list" class="list-group-item">
                                            Edit Bibliograply Attributes
                                        </a>
                                    </div>
<!--                                    <div class="list-group" >
                                        <a href="bib-product-list" class="list-group-item">
                                            Edit Bibliograply Name
                                        </a>
                                    </div>-->
                                    <div class="list-group" >
                                        <a href="excel-import.php?import=bibliography" class="list-group-item">
                                            Excel Import
                                        </a>
                                    </div>
                                    <div class="list-group" >
                                        <a href="carousel.php?catg=bibliography" class="list-group-item">
                                            Add Carousel Item
                                        </a>
                                    </div>
                                    <div class="list-group" >
                                        <a href="delete-unused-attributes?type=biblio" class="list-group-item">
                                            Unused attribute(Values)
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
        
<!------------- Code for Visual Archive ---------------------------------->

                        <div class="panel-group" role="tablist" style="margin-bottom:0.5em; ">
                            <div class="panel panel-default">
                                <div class="panel-heading" role="tab" id="collapseListVisualArchive2">
                                    <h4 class="panel-title">
                                        <a class="" role="button" data-toggle="collapse" href="#collapseVisualArchive2" aria-expanded="true" aria-controls="collapseVisualArchive2">
                                            Visual Archive
                                        </a>
                                    </h4>
                                </div>

                                <div id="collapseVisualArchive2"  class="panel-collapse collapse" role="tabpane2" aria-labelledby="collapseListVisualArchive2" aria-expanded="true">
                                    <div class="list-group" >
                                        <a href="visual-archive" class="list-group-item">
                                            Manage Visual Archive Images
                                        </a>
                                    </div>
                                    <div class="list-group" >
                                        <a href="visual-attribute-list" class="list-group-item">
                                            Edit Visual Archive Attributes
                                        </a>

                                    </div>
                                    <div class="list-group" >
                                        <a href="archivist-remarks" class="list-group-item">
                                           Manage Archivist Remarks
                                        </a>

                                    </div>
                                    
                                    <div class="list-group" >
                                        <a href="excel-import.php?import=visualarchive" class="list-group-item">
                                            Excel Import
                                        </a>
                                    </div>
                                    <div class="list-group" >
                                        <a href="carousel.php" class="list-group-item">
                                            Add Carousel Item
                                        </a>
                                    </div>
                                    <div class="list-group" >
                                        <a href="delete-unused-attributes?type=visualarchive" class="list-group-item">
                                            Delete Unused Attributes
                                        </a>
                                    </div>
                                    
                                </div>
                            </div>
                        </div>
                        
<!--------------------- Code end for visual archive --------------------------->


        <!--Custom code for data entry-->
                        <div class="panel-group" role="tablist" style="margin-bottom:0.5em; ">
                            <div class="panel panel-default">
                                <div class="panel-heading" role="tab" id="collapseListGroupHeading2">
                                    <h4 class="panel-title">
                                        <a class="" role="button" data-toggle="collapse" href="#collapseListGroup2" aria-expanded="true" aria-controls="collapseListGroup2">
                                            Memoribilia
                                        </a>
                                    </h4>
                                </div>

                                <div id="collapseListGroup2"  class="panel-collapse collapse" role="tabpane2" aria-labelledby="collapseListGroupHeading2" aria-expanded="true">
                                    <div class="list-group" >
                                        <a href="memorabilia-images" class="list-group-item">
                                            Manage Memorabilia Images
                                        </a>
                                    </div>
                                    <div class="list-group" >
                                        <a href="attribute-list" class="list-group-item">
                                            Edit Memorabilia Attributes
                                        </a>

                                    </div>
                                    
                                    <div class="list-group" >
                                        <a href="excel-import.php?import=memorabilia" class="list-group-item">
                                            Excel Import
                                        </a>
                                    </div>
                                    <div class="list-group" >
                                        <a href="carousel.php" class="list-group-item">
                                            Add Carousel Item
                                        </a>
                                    </div>
                                    <div class="list-group" >
                                        <a href="delete-unused-attributes?type=memorabilia" class="list-group-item">
                                            Delete Unused Attributes
                                        </a>
                                    </div>
                                    
                                </div>
                            </div>
                        </div>

                        <div class="panel-group" role="tablist" style="margin-bottom:0.5em; ">
                            <div class="panel panel-default">
                                <div class="panel-heading" role="tab" id="collapseListGroupHeading2">
                                    <h4 class="panel-title">
                                        <a class="" role="button" data-toggle="collapse" href="#collapseListGroup4" aria-expanded="true" aria-controls="collapseListGroup4">
                                            Setting
                                        </a>
                                    </h4>
                                </div>

                                <div id="collapseListGroup4"  class="panel-collapse collapse" role="tabpane2" aria-labelledby="collapseListGroupHeading4" aria-expanded="true">
                                    <div class="list-group" >
                                        <a href="edit-Setting" class="list-group-item">
                                            Website Setting
                                        </a>
                                    </div>
                                    <div class="list-group" >
                                        <a href="add-attributes" class="list-group-item">
                                            Add New Attribute
                                        </a>
                                    </div>
                                    <div class="list-group" >
                                        <a href="manage-attributes" class="list-group-item">
                                            Manage Attribute Sets
                                        </a>

                                    </div>
                                    <div class="list-group" >
                                        <a href="email-template.php" class="list-group-item">
                                            Email Templates
                                        </a>
                                    </div>
                                    <div class="list-group" >
                                        <a href="email-log.php" class="list-group-item">
                                            Email Log
                                        </a>
                                    </div>
                                    <div class="list-group" >
                                        <a href="access-log.php" class="list-group-item">
                                            Access Log
                                        </a>
                                    </div>
                                    <div class="list-group" >
                                        <a href="list-cms.php" class="list-group-item">
                                            Add/Edit CMS
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="panel-group" role="tablist" style="margin-bottom:0.5em; ">
                            <div class="panel panel-default">
                                <div class="panel-heading" role="tab" id="collapseListGroupHeading2">
                                    <h4 class="panel-title">
                                        <a class="" role="button" data-toggle="collapse" href="#collapseListGroup5" aria-expanded="true" aria-controls="collapseListGroup5">
                                            Ecommerce/Credit Hstory
                                        </a>
                                    </h4>
                                </div>

                                <div id="collapseListGroup5"  class="panel-collapse collapse" role="tabpane2" aria-labelledby="collapseListGroupHeading5" aria-expanded="true">

                                    <div class="list-group" >
                                        <a href="all-customer.php" class="list-group-item">
                                            Customer
                                        </a>
                                    </div>
                                    <div class="list-group" >
                                        <a href="all-orders.php" class="list-group-item">
                                            Order
                                        </a>
                                    </div>
                                    <div class="list-group" >
                                        <a href="credit-buy.php" class="list-group-item">
                                            Credit Buy
                                        </a>
                                    </div>
                                    <div class="list-group" >
                                        <a href="product-credit-spent.php" class="list-group-item">
                                            Product Credit Spend
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        
                        <div class="panel-group" role="tablist" style="margin-bottom:0.5em; ">
                            <div class="panel panel-default">
                                <div class="panel-heading" role="tab" id="collapseListGroupHeading2">
                                    <h4 class="panel-title">
                                        <a class="" role="button" data-toggle="collapse" href="#collapseListGroup6" aria-expanded="true" aria-controls="collapseListGroup6">
                                            People Profile
                                        </a>
                                    </h4>
                                </div>
                                <div id="collapseListGroup6"  class="panel-collapse collapse" role="tabpane2" aria-labelledby="collapseListGroupHeading6" aria-expanded="true">

                                    <div class="list-group" >
                                        <a href="all-profile.php" class="list-group-item">
                                            List of Artists
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
        
        
        
                        <div class="panel-group" role="tablist" style="margin-bottom:0.5em; ">
                            <div class="panel panel-default">
                                <div class="panel-heading" role="tab" id="collapseListGroupHeading2">
                                    <h4 class="panel-title">
                                        <a class="" role="button" data-toggle="collapse" href="#collapseListGroup7" aria-expanded="true" aria-controls="collapseListGroup6">
                                            Exhibition
                                        </a>
                                    </h4>
                                </div>
                                <div id="collapseListGroup7"  class="panel-collapse collapse" role="tabpane2" aria-labelledby="collapseListGroupHeading6" aria-expanded="true">

                                    <div class="list-group" >
                                        <a href="exhibition-list.php" class="list-group-item">
                                            List of Exhibitions
                                        </a>
                                    </div>
                                    <div class="list-group" >
                                        <a href="exhibition-artists.php" class="list-group-item">
                                            Exhibition Artists
                                        </a>
                                    </div>
                                </div>
                                
                            </div>
                        </div>


                        <div class="panel-group" role="tablist" style="margin-bottom:0.5em; ">
                            <div class="panel panel-default">
                                <div class="panel-heading" role="tab" id="collapseListGroupHeading2">
                                    <h4 class="panel-title">
                                        <a class="" role="button" data-toggle="collapse" href="#collapseListGroup8" aria-expanded="true" aria-controls="collapseListGroup6">
                                            Podcast
                                        </a>
                                    </h4>
                                </div>
                                <div id="collapseListGroup8"  class="panel-collapse collapse" role="tabpane2" aria-labelledby="collapseListGroupHeading6" aria-expanded="true">

                                    <div class="list-group" >
                                        <a href="podcast-list.php" class="list-group-item">
                                            List of Podcast
                                        </a>
                                    </div>                                    
                                </div>
                                
                            </div>
                        </div>
        
        
                        
                        <!--<div class="panel-group" role="tablist" style="margin-bottom:0.5em;">
                           <div class="panel panel-default">
                             <div class="panel-heading" role="tab" id="collapseListGroupHeading2">
                               <h4 class="panel-title">
                                 <a class="" role="button" data-toggle="collapse" href="#collapseListGroup2" aria-expanded="true" aria-controls="collapseListGroup2">
                                   Update Account
                                 </a>
                               </h4>
                             </div>
                             
                          <div id="collapseListGroup2" class="panel-collapse collapse" role="tabpanel" aria-labelledby="collapseListGroupHeading2" aria-expanded="true">
                              <div class="list-group">
                                         <a href="update-account" class="list-group-item">Change Password</a>
                                         <a href="update-email" class="list-group-item">Change Email</a>
                                        
                                       </div>
                             </div>
                           </div>
                         </div>
                        
                       <div class="panel-group" role="tablist" style="margin-bottom:0.5em; ">
                           <div class="panel panel-default">
                             <div class="panel-heading" role="tab" id="collapseListGroupHeading7">
                               <h4 class="panel-title">
                                 <a class="" role="button"  href="pages" aria-expanded="false" aria-controls="collapseListGroup7">
                                  Page Builder
                                 </a>
                                     </h4>
                             </div>
                             
                          
                             </div>
                            </div>
                            
                            <div class="panel-group" role="tablist" style="margin-bottom:0.5em; ">
                             <div class="panel panel-default">
                              <div class="panel-heading" role="tab" id="collapseListGroupHeading8">
                               <h4 class="panel-title">
                                 <a class="" role="button" data-toggle="collapse" href="#collapseListGroup8" aria-expanded="true" aria-controls="collapseListGroup">
                                   Blog
                                 </a>
                               </h4>
                             </div>
                             
                             <div id="collapseListGroup8"  class="panel-collapse collapse" role="tabpanel" aria-labelledby="collapseListGroupHeading" aria-expanded="true">
                              <div class="list-group" >
                                        
                                         <a href="cms" class="list-group-item">Add New</a>
                                         <a href="cms-view-all" class="list-group-item">View All</a>
                                      
                              </div>
                              
                             </div>
                           </div>
                         </div>
                        -->
                    </div>

                </div>

