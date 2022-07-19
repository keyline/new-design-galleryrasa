<?php
    require_once("../require.php");
    require_once("../" . INCLUDED_FILES . "config.inc.php");
    require_once("../" . INCLUDED_FILES . "dbConn.php");
    require_once("../" . INCLUDED_FILES . "functionsInc.php");
    check_auth_admin();
    $conn = dbconnect();
    
    if ($_SERVER['REQUEST_METHOD'] == "POST") {
        
       if(!empty($_POST['submit'])){
           $submitted_id = $_POST['submit'];
           $sub = explode("|", $submitted_id);
           $columns = array(
               'attr_value_id' =>  'null',
               'attr_id'    => ':attribute_id',
               'value'      => ':attribute_value'
           );
           foreach($_POST as $key => $value)
            {
                if(empty($value) || $key == 'submit')
                {
                    
                }
                else
                {
                    $empkey = $key;
                    
                }
            }
            
            $bind = array(
                ':attribute_id' => $sub[1],
                ':attribute_value'        => $_POST[$empkey]
            );
           
           try {
                $err = false;
                $qry = insert(ATTR_VAL, $columns);
                $q = $conn->prepare($qry);
                $q->execute($bind);
                $id = $conn->lastInsertId();
               
           } catch (Exception $pe) {
               
               $err = true;
                $er = db_error($pe->getMessage()) . '. Check that relevant fields like Info tab are completed';
           }
           
           $replace = array('{BTN}', '{MSG}');
           $items = array(
               'Another',
               'Attribute has been added'
           );
           include(ADMIN_HTML . "admin-headerInc.php");
           if ($err) {
            echo '<div class="alert alert-danger" role="alert"><h4>' . $er . '</h4></div>';
        }
        if (!$err) {
            echo str_replace($replace, $items, ATTRIBUTE_ADDED_MSG);
        };
        include(ADMIN_HTML . "admin-footerInc.php");
        exit;
       }
       
        
    }else{
        $s      = get_attribute_fields($conn);
        
        include(ADMIN_HTML . "admin-headerInc.php");
        include(ADMIN_HTML . "add-new-entry-tpl.php");
        include(ADMIN_HTML . "admin-footerInc.php");
    }
    