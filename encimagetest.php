<?php

//$orgname = 'sarika,-adj.p.40-3513727569.jpg';

$orgname = "bull-&-the-farmer's-family,-pl-4722304330.jpg";
//echo '<br>';

                $imgarr = explode(".", $orgname);

                $ImageExt1 = end($imgarr);
                //print_r($imgarr);

                $imgarrcnt = count($imgarr);

                $orgnameexcptextnd = '';
                $imgorgcnt = $imgarrcnt - 1;
                for ($l = 0; $l < $imgorgcnt; $l++) {
//                    echo $l;
//                    echo '<br>';
//                    echo $imgorgcnt;
//                    echo '<br>';
                    
                    if($l == ($imgorgcnt-1)){
                        
                      echo $orgnameexcptextnd .= $imgarr[$l];  
                    }
                    else{
                        echo $orgnameexcptextnd .= $imgarr[$l].'.';
                    }
                    
//                    echo $orgnameexcptextnd .= $imgarr[$l];
                    echo '<br>';
                }

                echo $newImageNameFile = base64_encode($orgnameexcptextnd).'.'.$ImageExt1;
                echo '<br>';
                echo $decoded_str = base64_decode(base64_encode($orgnameexcptextnd)).'.'.$ImageExt1;


//    $image_path = realpath(__DIR__ ."/../Art Work/falling-figure,-p.38-1457264809.jpg");
//    $img_binary = fread(fopen($image_path, "r"), filesize($image_path));
//     
//    echo $img_str = base64_encode("falling-figure,-p.38-1457264809.jpg"); // will produce the encoded string
//     echo '<br>';
//    echo $decoded_str = base64_decode($img_str);
//   //echo '<img src="data:image/gif;base64,'.$img_str.'" />'; //you can display the image on browser screen using image tag, if jpeg or jpg image than use 'image/jpg'
//    
    
    ?> 