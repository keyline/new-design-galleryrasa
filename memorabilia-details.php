<?php
require_once("require.php");
require_once(INCLUDED_FILES . "config.inc.php");
require_once(INCLUDED_FILES . "dbConn.php");
require_once(INCLUDED_FILES . "functionsInc.php");

if (!isset($_GET['pid']) || empty($_GET['pid'])) {
        $pid = 0;
    }
    
    $pid = $_GET['pid'];
    count_click('memoribilia',$pid);
    try{
        $conn = dbconnect();
        $qry = "SELECT tbl2.id productId, tbl2.n product, tbl2.pc category, tbl2.an attribute_name, tbl2.an_alias alias, group_concat(tbl2.v SEPARATOR ', ') AS value FROM 
            ( SELECT p.prodid AS id, p.prodname AS n, pt.product_type_name AS pc, f.attribute_name AS an, f.name_alias AS an_alias, f.position AS pos, v.`value` AS v FROM products_ecomc AS p LEFT JOIN product_attribute_value AS t ON p.prodid = t.product_id LEFT JOIN attribute_value_ecomc AS v ON t.attribute_value_id = v.attr_value_id LEFT JOIN attr_common_flds_ecomc AS f ON v.attr_id = f.id LEFT JOIN product_type_ecomc AS pt ON p.subcatid = pt.product_type_id WHERE t.product_id IN (
SELECT t.product_id FROM products_ecomc p LEFT JOIN product_attribute_value t ON p.prodid = t.product_id 
LEFT JOIN attribute_value_ecomc v ON t.attribute_value_id = v.attr_value_id 
LEFT JOIN attr_common_flds_ecomc f ON v.attr_id = f.id 
WHERE t.product_id =" . $pid . ")) as tbl2 GROUP BY tbl2.n, tbl2.an ORDER BY tbl2.pos";
        
        $q = $conn->query($qry);
        $q->setFetchMode(PDO::FETCH_ASSOC);
        $count = $q->rowCount();
        if($count){
            $rows = $q->fetchAll();
        }
        if(!empty($rows)){
            $data = array();
            foreach ($rows as $row){
            $data[$row['product']][$row['alias']] = $row['value'];
            }
        }
        
        
        //Getting Image details
        $qry = "SELECT
                        p.prodname,
                        m.m_image_name,
                        m.m_image_category_text,
                        m.status,
                        m.m_image_details,
                        m.is_featured,
                        m.m_image_id,
                        p.prodid
                        FROM
                        products_ecomc p
                        INNER JOIN memorabilia_images m ON m.product_id = p.prodid
                        WHERE m.product_id =" . $pid;
        $q = $conn->prepare($qry);
        $q->execute();
        $q->setFetchMode(PDO::FETCH_ASSOC);
        $count= 0;
        $count = $q->rowCount();
        $dataImage = array();
        if ($count) {
            $dataImage = array();
            while ($row = $q->fetch()) {
                $dataImage[$row['prodname']][$row['m_image_category_text']][] = array('id' => $row['m_image_id'],'name' => $row['m_image_name'], 'featured' => $row['is_featured'], 'product_id'=> $row['prodid'],
                    'imageDetails' => $row['m_image_details']
                        );
            }
        }
        //$finalData = array_merge_recursive($data, $dataImage);
        //Prepare html list for attributes
        $dbKeys = get_attrKeys_by_category('Memorabilia');
       $ommitKey = array('Name of Film' => 1, 'Year'=>1, 'Language'=>1,'Colour/B&W'=>1);
       
        $contentHtml = '';
        
        foreach ($data as $attr => $value){
            $productName = $attr;
            if(is_array($value)){
                
                foreach ($value as $k => $v){
                    if($k == 'Year') $year = $v;
                    if($k == 'Language') $language = $v;
                    if($k == 'Colour/B&W') $color = $v;
                    if(array_key_exists($k, $ommitKey)) continue;
                       
                                // $contentHtml .= "<li><strong>".$k. "</strong> : " . $v ."</li><hr>";
                                $contentHtml .= '<tr>
                                        <td class="table-border-2">'.$k .'</td>
                                        <td class="table-border">'.$v .'</td>
                                    </tr>';
                    
                }
            }
        }
       
        
        $imageDetails = '';
        
        foreach ($dataImage as $key => $film){
            foreach ($film as $k => $v){
            //    print '<pre>';
            //    print_r($film);
                
            $imageDetails .= '<h2 class="w-100 mb-4">' . str_replace("Card", "Lobby Card",$k) . '</h2><div class="parent-container ' .$k .'"><div class="row">';
            if(is_array($v)){
                for($i=0; $i<count($v); $i++){
                    
                    $imageDetails .= '<div class="col-md-3 image2Cart image-box-outercol-md-3 image2Cart image-box-outer wow  fadeInDown" data-wow-duration="1s" data-wow-delay="0.5s">'
                            . '<div class="'.$k . "_" .$i. ' image-box-inner"><a class="thumbnail" href="'.SITE_URL . '/' . IMGSRC . strtolower($k) . '/' . $v[$i]['name'].'"><img class="img-responsive image-mem" src="'. SITE_URL . '/' . IMGSRC . 'thumbs/' . $v[$i]['name'] . '"></a>'
                            . '</div>';


//                    getting Add To Cart button


                    if(!empty($v[$i]['imageDetails'])){
                        //echo $v[$i]['id'];
                        //echo $k;
                        $imageDetails .= '<a class="btn add-to-cart-btn form-control" href="../product-details.php?image_id='.$v[$i]['id'].'&image_type='.$k.'">View Details</a>';
                       // $imageDetails .= get_html_from_JSON($v[$i]['imageDetails']);
                       // $imageDetails .= get_add_to_cart_button($v[$i]['imageDetails'], $k);
                        
                    }
                    
                    
                    
                    
                    $imageDetails .= '</div>';
                }
            }
            $imageDetails .= '</div></div>';
            }
        }
    } catch (PDOException $pe){
        echo $error = db_error($pe->getMessage());
    }
    include(INC_FOLDER . "headerInc.php");
    $list = file_get_contents(VIEWS_FOLDER . 'memorabilia-details.Inc.php');
    $search = array('{imageDetails}', '{productName}', '{year}','{language}','{colour}', '{attributeList}');
    $replace = array($imageDetails, $productName, $year, $language, $color,$contentHtml);
    echo $detailsView = str_replace($search, $replace, $list);
    include(INC_FOLDER . "footerInc.php");