<?php
require_once("../require.php");
require_once("../" . INCLUDED_FILES . "config.inc.php");
require_once("../" . INCLUDED_FILES . "dbConn.php");
require_once("../" . INCLUDED_FILES . "functionsInc.php");
check_auth_admin();
$conn = dbconnect();


$prod_id = $_GET['prod_id'];
$alias = $_GET['alias'];
$attribute_id = $_GET['attribute_id'];
$type = $_GET['type'];


$sql3 = "SELECT pe.* FROM products_ecomc pe where pe.prodid = '$prod_id'";
$q3 = $conn->prepare($sql3);
$q3->execute();
$q3->setFetchMode(PDO::FETCH_ASSOC);
$productarr = $q3->fetch();

try {


    $sql1 = "SELECT acfe.* FROM attr_common_flds_ecomc acfe where acfe.id = '$attribute_id'";
    $q1 = $conn->prepare($sql1);
    $q1->execute();
    $q1->setFetchMode(PDO::FETCH_ASSOC);
    $attributetypearr = $q1->fetch();

    if ($attributetypearr['field_type'] == 'select-multiple') {

        $sql2 = "SELECT ave.* FROM attr_common_flds_ecomc acfe,attribute_value_ecomc ave 
where  
acfe.id = ave.attr_id and 
acfe.id = '$attribute_id' order by ave.value";
        $q2 = $conn->prepare($sql2);
        $q2->execute();
        $q2->setFetchMode(PDO::FETCH_ASSOC);

        while ($rowattrval = $q2->fetch()) {
            $attrvalue_list[] = array(
                'attr_value_id' => $rowattrval['attr_value_id'],
                'attr_id' => $rowattrval['attr_id'],
                'value' => $rowattrval['value']
            );
        }
    }
} catch (PDOException $pe) {
    echo db_error($pe->getMessage());
}



if (isset($_GET['type'])) {
    if ($_GET['type'] == 'va') {
        $producttype = "Visual Archive Products";
        $backurl = "visual-archive.php";
        $inputvalue = "va";
    } else if ($_GET['type'] == 'bib') {
        $producttype = "Bibliography Products";
        $backurl = "product-list.php";
        $inputvalue = "bib";
    } else {
        $producttype = "Memorabilia Products";
        $backurl = "product-list.php";
        $inputvalue = "mb";
    }
} else {
    $producttype = "Memorabilia Products";
    $backurl = "product-list.php";
    $inputvalue = "mb";
}

include(ADMIN_HTML . "admin-headerInc.php");
include(ADMIN_HTML . 'add-new-attribute-value-tpl.php');
include(ADMIN_HTML . "admin-footerInc.php");
?>

<script>
    $(document).ready(function () {
        
        


        //default_attrval_dropdown1();
        
        
        var attrval = $("#attrvalselectid option:selected").val();
        
        //alert(attrval);

        if (attrval == 'new_val') {
            $("#addval").show();
        } else {
            $("#addval").hide();
        }
        
        

        $("#attrvalselectid").change(function () {
            
           

            var attrval = $("#attrvalselectid").val();


            if (attrval == 'new_val') {
                $("#addval").show();
            } else {
                $("#addval").hide();
            }

        });
    });


    function ddefault_attrval_dropdown1() {
        var attrval = $("#attrvalselectid").val();
        
        alert('hi');

        if (attrval == 'new_val') {
            $("#addval").show();
        } else {
            $("#addval").hide();
        }

    }

</script>    