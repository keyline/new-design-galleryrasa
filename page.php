<?php
require_once("require.php");
require_once(INCLUDED_FILES . "config.inc.php");
require_once(INCLUDED_FILES . "dbConn.php");
require_once(INCLUDED_FILES . "functionsInc.php");

if (!isset($_GET['pagename']) || empty($_GET['pagename'])) {
        $pName = '';
    }
    $pName = $_GET['pagename'];
    try{
        $conn = dbconnect();
        $html='';
        
        $query = "SELECT `detail` FROM ". CMS_TBL . " WHERE `title`=:pageTitle AND status <> 0";
        $q= $conn->prepare($query);
        $q->bindParam(':pageTitle', $pName);
        $q->execute();
        $q->setFetchMode(PDO::FETCH_ASSOC);
        while ($row = $q->fetch()){
            
            $html= $row['detail'];
            // echo $html;
            // die;
        }
        if($pName == 'contact-us'){
            $formHtml = '<div class="col-md-6 contact">
			<form id="contact-form" class="contact-form" method="POST" action="">
                        
				<div class="col-md-4">
					
						<label>Your Name (required)</label>
                                 </div>
                                <div class="col-md-8">                
						<input type="text" name="your-name" class="form-control" id="contactName">
					
					
				</div>
                                <div class="clearfix"></div>
                                <br>
				<div class="col-md-4">
					
						<label>Your Email (required)</label>
                                                </div>
                                <div class="col-md-8"> 
						<input type="email" name="your-email" class="form-control" id="contactEmail">
					
				</div>
                                <div class="clearfix"></div>
                                <br>
                                <div class="col-md-4">
				<label>Your Message</label>
                                </div>
                                <div class="col-md-8"> 
				<textarea name="your-message" id="contactMessage" cols="40" rows="2" class="form-control"></textarea>
                                </div>
                                <div class="clearfix"></div>
                                <br>
                                <div class="col-md-4">
                                </div>
                                <div class="col-md-8">
                                <div class="g-recaptcha" data-sitekey="6Ld6xT4UAAAAALy5r03iI2mfNTPGPwXdqEJWoE52"></div>
                                </div>
                                <div class="clearfix"></div>
                                <br>
                                <div class="col-md-4">
                                </div>
                                <div class="col-md-8">
				<input type="submit" value="Send message" class="submit btn btn-info"><span class="ajax-loader"></span>
                                </div>
                                <div class="clearfix"></div>
                                <br>
                                <div class="col-md-4">
                                <div id="contact_form_results"></div>
                                </div>
			</form>
		</div></div>';
        }
        include(INC_FOLDER . "headerInc.php");
        if(!empty($html)){
            $contentHtml = file_get_contents(VIEWS_FOLDER . 'show-content-tpl.php');
            $contactForm = (!empty($formHtml)) ? $formHtml : '';
            $search = array('{content}', '{Contactform}');
            $replace = array($html, $contactForm);
            echo $contentView = str_replace($search, $replace, $contentHtml);
            
        }else{
            $items = NO_PRODUCT_FOUND_MSG;
            include(VIEWS_FOLDER . "no-results-index.php");
        }
        include(INC_FOLDER . "footerInc.php");
    
    }catch(PDOException $pe){
        echo $error = db_error($pe->getMessage());
    }