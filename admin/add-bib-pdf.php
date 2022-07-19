<?php
require_once("../require.php");
require_once("../" . INCLUDED_FILES . "config.inc.php");
require_once("../" . INCLUDED_FILES . "dbConn.php");
require_once("../" . INCLUDED_FILES . "functionsInc.php");
check_auth_admin();
$conn = dbconnect();
$prodid = $_GET['id'];




include(ADMIN_HTML . "admin-headerInc.php");
?>
<?php
$qry1 = "SELECT * from products_ecomc where prodid ='$prodid'";
$q1 = $conn->prepare($qry1);
$q1->execute();
$q1->setFetchMode(PDO::FETCH_ASSOC);
$row1 = $q1->fetch();
$product_name = $row1['prodname'];


$qry2 = "SELECT * from bibliography_pdf where prodid ='$prodid'";
$q2 = $conn->prepare($qry2);
$q2->execute();
$q2->setFetchMode(PDO::FETCH_ASSOC);
$row2 = $q2->fetchAll();
?>
<div class="col-sm-9 col-md-9">
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title"></h3>

            <?php
            if (isset($_SESSION['succes-add'])) {
                ?>
                <span class="success"><?php echo $_SESSION['succes-add']; ?></span>
                <?php
                unset($_SESSION['succes-add']);
            }if (isset($_SESSION['error-add'])) {
                ?>
                <span class="fail"><?php echo $_SESSION['error-add']; ?></span>
                <?php
                unset($_SESSION['error-add']);
            }
            ?>



            <?php
            if (isset($_SESSION['succ-pass'])) {
                ?>
                <span class="success"><?php echo $_SESSION['succ-pass']; ?></span>
                <?php
                unset($_SESSION['succ-pass']);
            }
            ?>
        </div>

        <h2 class="sub-header"><?php echo $product_name; ?></h2>

        <?php
//        $sql_attr = "select * from attribute_value_ecomc where attr_id = '$attribute_id' order by value";
//        $q_attr = $conn->prepare($sql_attr);
//        $q_attr->execute();
//        $q_attr->setFetchMode(PDO::FETCH_ASSOC);
//        $count_attr = $q_attr->rowCount();
//        while ($row_attr = $q_attr->fetch()) {
//            $attribute_value_list[] = array(
//                'value_id' => $row_attr['attr_value_id'],
//                'value' => $row_attr['value']
//            );
//        }
        ?>

        <div class="panel-body">
            <div role="tabpanel">
                <form method="post" action="db-add-bib-pdf.php" enctype="multipart/form-data">
                    <input type="hidden" name="product" value="<?php echo $prodid; ?>">
                    <input type="file" name="pdffile">
                    <br>
                    <input type="submit" class="btn btn-info" value="Add New Pdf">
                </form>


                <?php
                if (!empty($row2)) {
                    ?>

                    <table class="table table-striped" id="example">
                        <thead>
                            <tr>
                                <th>Sl No</th>
                                <th>PDF File</th>  
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $i = 1;
                            foreach ($row2 as $k1 => $v1) {

                                $pdfname = $v1['bib_pdf'];

                                $imgarr = explode(".", $pdfname);

                                $ext = end($imgarr);
                                $imgarrcnt = count($imgarr);

                                $orgnameexcptextnd = '';
                                $imgorgcnt = $imgarrcnt - 1;
                                for ($l = 0; $l < $imgorgcnt; $l++) {

                                    if ($l == ($imgorgcnt - 1)) {

                                        $orgnameexcptextnd .= $imgarr[$l];
                                    } else {
                                        $orgnameexcptextnd .= $imgarr[$l] . '.';
                                    }
                                }
                                ?>
                                <tr>
                                    <td><?php echo $i; ?></td>
                                    <td><a href="../bibpdf?pdf=<?php echo urlencode($orgnameexcptextnd) ?>&ext=<?php echo $ext ?>"><?php echo $v1['bib_pdf']; ?></a></td>
                                    <td><a href="del-bib-pdf.php?pdfid=<?php echo $v1['id'] ?>&prodid=<?php echo $prodid ?>" class="btn btn-sm btn-danger">Delete</a></td>
                                </tr>
                                <?php
                                $i++;
                            }
                            ?>
                        </tbody>

                    </table>

                    <?php
                }
                ?>


            </div>

        </div>
    </div>
</div>
<?php
include(ADMIN_HTML . "admin-footerInc.php");
//}