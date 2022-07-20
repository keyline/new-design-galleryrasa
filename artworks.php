<?php
require_once("require.php");
require_once(INCLUDED_FILES . "config.inc.php");
require_once(INCLUDED_FILES . "dbConn.php");
require_once(INCLUDED_FILES . "functionsInc.php");

if (!isset($_GET['p']) || empty($_GET['st'])) {
        $pName = '';
    }
   $artistName = $_GET['p'];
   $htmlRight = '';
   $detailsHTMl = '';
   $dob = '';
   $dod = '';
    try{
        $conn = dbconnect();
        $qry = "SELECT * FROM `artworks` WHERE `artist_id`=:artistID";
        $q = $conn->prepare($qry);
        $bind = array(':artistID'=> $_GET['st']);
        $q->execute($bind);
        $i=0;
        while ($row = $q->fetch(PDO::FETCH_ASSOC)){
            $data['artworks'][$i] = $row;
            $i++;
        }
        
        //Getting Profile Details
        $qry_profile = "SELECT * FROM `profile` WHERE `person_id`=:personID";
        $pr = $conn->prepare($qry_profile);
        $bind = array(':personID'=> $_GET['st']);
        $pr->execute($bind);
        while($row = $pr->fetch(PDO::FETCH_ASSOC)){
            $data['artworkDetails'][] = $row;
        }
//        print "<pre>";
//        print_r($data);
        if(!empty($data)){
            $html =1;
            
            foreach ($data['artworks'] as $key => $val){
                
                
                    
                    
                        
                        
                        $baseHTML = '<div class="col-sm-6 col-md-4 artworks-outerBorder">
                       <div class="col-md-12 artworks-imageBox">
                       
                       
                       
<img class="img-responsive artwork-image" alt="%s" src="%s"/></div>
                      
    <div class="col-md-12 artworks-attributes">
                    <p class="img-attributes"><strong>Title:</strong> %s</p><br>
                    <p class="img-attributes"><strong>Medium:</strong> %s</p><br>
                    <p class="img-attributes"><strong>Surface:</strong> %s</p><br>
                    <p class="img-attributes"><strong>Painting_year:</strong> %s</p><br>
                    <p class="img-attributes"><strong>Size(width):</strong> %s</p><br>
                    <p class="img-attributes"><strong>Size(height):</strong> %s</p><br>
                    <p class="img-attributes"><strong>Comment:</strong> %s</p><br>
                       </div></div>';
                    //$url = SITE_URL . "/artworks-details/" . $val['id'];
                    $productName = $artistName;
                    $productImg = (!empty($val['image'])) ? (SITE_URL . '/' . ARTWORKS_IMGS . $val['image']) : (SITE_URL . JS_FOLDER . 'holder.js/300x180/auto/text:' . NO_IMAGE);
                    $title = (!empty($val['title'])) ? $val['title'] : 'NA';
                    $medium = (!empty($val['medium'])) ? $val['medium'] : 'NA';
                    $surface = !empty($val['surface']) ? $val['surface'] : 'NA';
                    $painting_year = !empty($val['painting_year']) ? $val['painting_year'] : 'NA';
                    $swidth = !empty($val['size_width']) ? $val['size_width'] : 'NA';
                    $sheight = !empty($val['size_height']) ? $val['size_height'] : 'NA';
                    $comment = !empty($val['comment']) ? $val['comment'] : 'NA';
                    
                    $htmlRight .= sprintf($baseHTML, $productName, $productImg,$title,$medium,$surface, $painting_year, $swidth, $sheight, $comment );
                    
                    
                    
                        
                    
                        
                    }
                    
                    
                    
                
                
            
            //HTML for details
                    if(!empty($data['artworkDetails'])){
            foreach ($data['artworkDetails'] AS $details){
                if(is_array($details)){
                    foreach ($details as $k => $val){
                        if($k == 'dob') $dob = (!empty($val)) ? $val : '';
                        if($k == 'dod') $dod = (!empty($val)) ? $val : '';
                    if($k == 'details')
                        $detailsHTMl .= '<p><strong>'. $k .':</strong></p><p>' . $val . '</p>';
                        
                        
                    }
                }
            }
            }
            
            //Creating string for Death Clock
            $strdeathClock = '';
            if(!empty($dob) || $dob != ''){
                $strdeathClock .= "(&nbsp;" . $dob;
                if(!empty($dod) || $dod != ''){
                    $strdeathClock .= "&nbsp;-&nbsp;" . $dod . '&nbsp;)';
                }else{
                    $strdeathClock .= '&nbsp;)';
                }
                
            }else{
                $strdeathClock = '';
            }
        }
       if($html){
           include(INC_FOLDER . "headerInc.php");
           
           $list = file_get_contents(VIEWS_FOLDER . 'show-artworks-Inc.php');
           $search = array('{artistName}','{deathClock}', '{artistProfile}', '{artworkImages}');
           $replace = array($artistName, $strdeathClock, $detailsHTMl, $htmlRight);
                echo $detailsView = str_replace($search, $replace, $list);
                include(INC_FOLDER . "footerInc.php");
       }else{
           include(INC_FOLDER . "headerInc.php");
           $items = NO_PRODUCT_FOUND_MSG;
            include(VIEWS_FOLDER . "no-results-index.php");
            include(INC_FOLDER . "footerInc.php");
       }
        
        
    }catch(PDOException $pe){
        echo $error = db_error($pe->getMessage());
    }