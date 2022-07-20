<?php
require_once("require.php");
require_once(INCLUDED_FILES . "config.inc.php");
require_once(INCLUDED_FILES . "dbConn.php");
require_once(INCLUDED_FILES . "functionsInc.php");

$conn = dbconnect();
        unset($_SESSION['fParam']);
        unset($_SESSION['append']);

	include(INC_FOLDER . "headerInc.php");
        
	//$options = get_subCategory_options($conn);
        //$select_sub = $options['s'];
        //Get dynamic content for Memorabilia
        try{
            $conn = dbconnect();
            $qry = "SELECT `detail` FROM ". CMS_TBL . " WHERE `title`='Memorabilia'";
            $q= $conn->query($qry);
            $q->execute();
            $q->setFetchMode(PDO::FETCH_ASSOC);
            while($row = $q->fetch()){
                $data = $row['detail'];
            }
            
            //Get Carousel for Memorabilia images
            $sql = "SELECT * FROM " . CAROUSEL_TBL . " WHERE category= 'M' AND status=1 and image_nm!='' ";
            $q = $conn->query($sql);
            $q->setFetchMode(PDO::FETCH_ASSOC);
            $carouselHTML = '';
            $total = $q->rowCount();
            if($total > 0){
                while($carousel = $q->fetch()){
                    $carousel['image_nm'];
                    $imageSRC = IMGSRC  . "carousel/" .$carousel['image_nm'];
                    $carouselHTML .= '<div class="item"><img src="' . $imageSRC .'" alt="' . $carousel['image_nm'] . '"></div>';
                }
            }
            if(!empty($data) && !empty($carouselHTML)){
                $home = file_get_contents(VIEWS_FOLDER . 'home-memorabilia.Inc.php');
                //$finalContent = $home.$data;
                echo str_replace('{carousel_items}', $carouselHTML, $home);
            }else{
               echo $home = file_get_contents(VIEWS_FOLDER . 'home-memorabilia.Inc.php');
            }
            
        }catch(PDOException $pe){
            echo db_error($pe->getMessage());
        }
	$count = 1;
        
        

	
	include(INC_FOLDER . "footerInc.php");