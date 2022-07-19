<?php

require_once("../require.php");
require_once("../" . INCLUDED_FILES . "config.inc.php");
require_once("../" . INCLUDED_FILES . "dbConn.php");
require_once("../" . INCLUDED_FILES . "functionsInc.php");
check_auth_admin();
$conn = dbconnect();


$prod_id = $_GET['prod_id'];
try {
    $sql = "SELECT 
tbl2.id productId, 
tbl2.n product, 
tbl2.pc category, 
tbl2.fid attribute_id, 
tbl2.an attribute_name, 
tbl2.an_alias alias, 
group_concat(tbl2.v SEPARATOR ',') AS value,
group_concat(tbl2.vid SEPARATOR ',') AS value_id 
FROM 
( SELECT 
p.prodid AS id, 
p.prodname AS n, 
pt.product_type_name AS pc, 
f.id AS fid,
f.attribute_name AS an, 
f.name_alias AS an_alias, 
f.position AS pos, 
v.`value` AS v,
v.`attr_value_id` AS vid
FROM 
products_ecomc AS p 
LEFT JOIN 
product_attribute_value AS t 
ON 
p.prodid = t.product_id 
LEFT JOIN 
attribute_value_ecomc AS v 
ON 
t.attribute_value_id = v.attr_value_id 
LEFT JOIN 
attr_common_flds_ecomc AS f 
ON 
v.attr_id = f.id 
LEFT JOIN 
product_type_ecomc AS pt 
ON 
p.subcatid = pt.product_type_id 
WHERE 
t.product_id IN 
( SELECT 
t.product_id 
FROM 
products_ecomc p 
LEFT JOIN 
product_attribute_value t 
ON 
p.prodid = t.product_id 
LEFT JOIN 
attribute_value_ecomc v 
ON 
t.attribute_value_id = v.attr_value_id 
LEFT JOIN 
attr_common_flds_ecomc f 
ON 
v.attr_id = f.id 
WHERE 
t.product_id ='$prod_id'
)
) as tbl2 
GROUP BY 
tbl2.n, tbl2.an 
ORDER BY tbl2.pos";
    $q = $conn->prepare($sql);
    $category_id = 2;

    $q->execute();
    $q->setFetchMode(PDO::FETCH_ASSOC);
    $count = $q->rowCount();
    while ($row = $q->fetch()) {
        $product_value_list[] = array(
            'prod_id' => $row['productId'],
            'product' => $row['product'],
            'category' => $row['category'],
            'attribute_name' => $row['attribute_name'],
            'alias' => $row['alias'],
            'value' => $row['value'],
            'value_id' => $row['value_id'],
            'attribute_id' => $row['attribute_id']
        );
    }
} catch (PDOException $pe) {
    echo db_error($pe->getMessage());
}



if (isset($_GET['type'])) {
    if ($_GET['type'] == 'va') {
        $producttype = "Visual Archive Products";
        $backurl = "visual-archive.php";
        $inputvalue = "va";
        
        
        $sql2 = "select f.id attrid,f.name_alias,f.attribute_name,a.value from 

(
select acfe.* from product_type_attribute_key ptak, attr_common_flds_ecomc acfe 
where ptak.attribute_id = acfe.id and 
ptak.p_type_id = '19' 
order by acfe.position    
) f   

left join 

(
select ave.*,pe.* 
from products_ecomc pe, product_attribute_value pav, attribute_value_ecomc ave 
where pe.prodid = pav.product_id and 
pav.attribute_value_id = ave.attr_value_id and 
pe.prodid = '$prod_id'
    )a 
    
on f.id = a.attr_id 
where 

a.value IS NULL 
order by f.position";
        
       $q2 = $conn->prepare($sql2);

    $q2->execute();
    $q2->setFetchMode(PDO::FETCH_ASSOC);
    $count2 = $q2->rowCount();
    while ($row2 = $q2->fetch()) {
        $attr_list[] = array(
            'attrid' => $row2['attrid'],
            'name_alias' => $row2['name_alias'],
            'attribute_name' => $row2['attribute_name'],
            'value' => $row2['value']
        );
    } 
        
        
        
        
        
        
        
    } else if ($_GET['type'] == 'bib') {
        $producttype = "Bibliography Products";
        $backurl = "product-list.php";
        $inputvalue = "bib";
        
        
        
        
        $sql2 = "select f.id attrid,f.name_alias,f.attribute_name,a.value from 

(
select acfe.* from product_type_attribute_key ptak, attr_common_flds_ecomc acfe 
where ptak.attribute_id = acfe.id and 
ptak.p_type_id = '1' 
order by acfe.position    
) f   

left join 

(
select ave.*,pe.* 
from products_ecomc pe, product_attribute_value pav, attribute_value_ecomc ave 
where pe.prodid = pav.product_id and 
pav.attribute_value_id = ave.attr_value_id and 
pe.prodid = '$prod_id'
    )a 
    
on f.id = a.attr_id 
where 

a.value IS NULL 
order by f.position";
        
       $q2 = $conn->prepare($sql2);

    $q2->execute();
    $q2->setFetchMode(PDO::FETCH_ASSOC);
    $count2 = $q2->rowCount();
    while ($row2 = $q2->fetch()) {
        $attr_list[] = array(
            'attrid' => $row2['attrid'],
            'name_alias' => $row2['name_alias'],
            'attribute_name' => $row2['attribute_name'],
            'value' => $row2['value']
        );
    } 
        
   
        
        
    } else {
        $producttype = "Memorabilia Products";
        $backurl = "product-list.php";
        $inputvalue = "mb";
        
        
            
        
         $sql2 = "select f.id attrid,f.name_alias,f.attribute_name,a.value from 

(
select acfe.* from product_type_attribute_key ptak, attr_common_flds_ecomc acfe 
where ptak.attribute_id = acfe.id and 
ptak.p_type_id = '2' 
order by acfe.position    
) f   

left join 

(
select ave.*,pe.* 
from products_ecomc pe, product_attribute_value pav, attribute_value_ecomc ave 
where pe.prodid = pav.product_id and 
pav.attribute_value_id = ave.attr_value_id and 
pe.prodid = '$prod_id'
    )a 
    
on f.id = a.attr_id 
where 

a.value IS NULL 
order by f.position";
        
       $q2 = $conn->prepare($sql2);

    $q2->execute();
    $q2->setFetchMode(PDO::FETCH_ASSOC);
    $count2 = $q2->rowCount();
    while ($row2 = $q2->fetch()) {
        $attr_list[] = array(
            'attrid' => $row2['attrid'],
            'name_alias' => $row2['name_alias'],
            'attribute_name' => $row2['attribute_name'],
            'value' => $row2['value']
        );
    } 
        
        
       
        
    }
} else {
    $producttype = "Memorabilia Products";
    $backurl = "product-list.php";
    $inputvalue = "mb";
    
   
    
         $sql2 = "select f.id attrid,f.name_alias,f.attribute_name,a.value from 

(
select acfe.* from product_type_attribute_key ptak, attr_common_flds_ecomc acfe 
where ptak.attribute_id = acfe.id and 
ptak.p_type_id = '2' 
order by acfe.position    
) f   

left join 

(
select ave.*,pe.* 
from products_ecomc pe, product_attribute_value pav, attribute_value_ecomc ave 
where pe.prodid = pav.product_id and 
pav.attribute_value_id = ave.attr_value_id and 
pe.prodid = '$prod_id'
    )a 
    
on f.id = a.attr_id 
where 

a.value IS NULL 
order by f.position";
        
       $q2 = $conn->prepare($sql2);

    $q2->execute();
    $q2->setFetchMode(PDO::FETCH_ASSOC);
    $count2 = $q2->rowCount();
    while ($row2 = $q2->fetch()) {
        $attr_list[] = array(
            'attrid' => $row2['attrid'],
            'name_alias' => $row2['name_alias'],
            'attribute_name' => $row2['attribute_name'],
            'value' => $row2['value']
        );
    } 
    
    
}

include(ADMIN_HTML . "admin-headerInc.php");
include(ADMIN_HTML . 'add-delete-attribute-tpl.php');
include(ADMIN_HTML . "admin-footerInc.php");
//}