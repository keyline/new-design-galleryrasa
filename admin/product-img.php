<?php
    require_once("../require.php");
    require_once("../" . INCLUDED_FILES . "config.inc.php");
   $img = '../' . THUMB_IMGS . $_GET['img'];
   
  if (isset($_GET['t']) && $_GET['t'] == 2) {
        $img= '../' . IMAGES_FOLDER . $_GET['img'];
        $max_width = 150;
        $max_height = 200;
    }
    if(isset($_GET['t']) && $_GET['t'] == 3) {
        $img= '../' . BLOG_IMGS_THUMBS . $_GET['img'];
        }
        
    if (!isset($max_width)) {
        $max_width = 80;
    }
    if (!isset($max_height)) {
        $max_height = 120;
    }

  list($ow, $oh, $img_type) = getimagesize($img); 
    $width = $ow;
    $height = $oh;

    $x_ratio = $max_width / $width;
    $y_ratio = $max_height / $height;

    if (($width <= $max_width) && ($height <= $max_height)) {
        $t_width = $width;
        $t_height = $height;
    } else {
        if (($x_ratio * $height) < $max_height) {
            $t_height = ceil($x_ratio * $height);
            $t_width = $max_width;
        } else {
            $t_width = ceil($y_ratio * $width);
            $t_height = $max_height;
        }
    }
 
           switch($img_type)
           {
               case 1: // GIF 
		
                   $image = imagecreatefromgif($img);
                   $tmp = imageCreateTrueColor($t_width, $t_height);
                    $transparent = imagecolorallocatealpha($tmp, 0, 0, 0, 127);
                    imagefill($tmp, 0, 0, $transparent);
                    imagealphablending($tmp, true); 
                    imagecopyresampled($tmp, $image,0,0,0,0,$t_width, $t_height, $width, $height);
		      header('Content-Type: image/gif');
                    imagegif($tmp);
		      ImageDestroy($tmp);
                   break;
              
	    case 2: // JPG

                	$tmp = imageCreateTrueColor($t_width, $t_height);
			$image = imagecreatefromjpeg($img);
			imagecopyresampled($tmp, $image, 0, 0, 0, 0, $t_width, $t_height, $width, $height);
     		       header('Content-type: image/jpeg');
                      imagejpeg($tmp, null, 100);
		        ImageDestroy($tmp);
                   break;
               
		case 3: // PNG
                    
                    $tmp = imagecreatetruecolor($t_width,$t_height);
		      $image = imagecreatefrompng($img);
                    imagealphablending($tmp, false);
                    imagesavealpha($tmp, true);
                    imagecopyresampled($tmp, $image,0,0,0,0,$t_width, $t_height, $width, $height);
		      header('Content-Type: image/png');
                    imagepng($tmp);
		      ImageDestroy($tmp);
                   break;
           }
   
?>