<?php
$serverproduct_type_name = "localhost";
$userproduct_type_name   = "rasaUser";
$password   = "india@123$$";
$dbproduct_type_name     = "rasa_db";
$conn = mysqli_connect($serverproduct_type_name, $userproduct_type_name, $password, $dbproduct_type_name) or die("Connection failed: " . mysqli_connect_error());
/* check connection */
if (mysqli_connect_errno()) {
    printf("Connect failed: %s\n", mysqli_connect_error());
    exit();
}

// Source type : json / html
$sourceType = $_REQUEST['sourceType'];

if( $sourceType == 'html' )
{
    $getParentNodes = "select product_type_id, product_type_name from product_type_ecomc where parent IS NULL";
    $resParentNodes = mysqli_query($conn, $getParentNodes);
    $response = '';
    if(mysqli_num_rows($resParentNodes) > 0)
    {
        while($parentNode = mysqli_fetch_assoc($resParentNodes))
        {
            $response .= '<ul  class="jtree_parent_node">
                <li>
                    <span class="jtree_expand jtree_node_open"> </span>
                    <label><input type="checkbox" product_type_id="'. $parentNode['product_type_id'] .'" parent-_id="" class="jtree_parent_checkbox"> '. $parentNode['product_type_name'] .'</label>';

                    $getChildNodes = "select product_type_id, product_type_name from product_type_ecomc where parent = '".$parentNode['product_type_id']."'";
                    $resChildNodes = mysqli_query($conn, $getChildNodes);
                    if(mysqli_num_rows($resChildNodes) > 0)
                    {
                        $response .= '<ul class="jtree_child_node">';
                        while($childNode = mysqli_fetch_assoc($resChildNodes))
                        {
                            $response .= '
                                <li><label><input type="checkbox" id="'. $childNode['product_type_id'] .'" parent-id="'. $parentNode['product_type_id'] .'" class="jtree_child_checkbox"> '. $childNode['product_type_name'] .'</label></li>
                            ';
                        }
                        $response .= '</ul>';
                    }
                    
            $response .= '</li>
            </ul>';     
        }
    }

    echo $response;
}
else
{
    $response   = array();
    $childNodes = array();

    $getParentNodes = "select product_type_id, product_type_name from permissions where parent IS NULL";
    $resParentNodes = mysqli_query($conn, $getParentNodes);
    $response = '';
    if(mysqli_num_rows($resParentNodes) > 0)
    {
        while($parentNode = mysqli_fetch_assoc($resParentNodes))
        {
            $getChildNodes = "select product_type_id, product_type_name from permissions where inherit_product_type_id = '".$parentNode['product_type_id']."'";
            $resChildNodes = mysqli_query($conn, $getChildNodes);
            if(mysqli_num_rows($resChildNodes) > 0)
            {
                while($childNode = mysqli_fetch_assoc($resChildNodes))
                {
                    $childNodes[] = $childNode;
                }

                $response[$parentNode['product_type_id']] = array(
                    'parentNodeid'  => $parentNode['product_type_id'],
                    'parentNodeTxt' => $parentNode['product_type_name'],
                    'childNodes'    => $childNodes
                );
            }
        }
    }

    echo json_encode( $response );
}


?>