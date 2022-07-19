<?php
/* Project Name: Rasa Gallery
 * Author: Keyline
 * Author URI: http://www.keylines.net/
 * Author e-mail: info@keylines.net
 * Created: OCT 2017
 * License: http://keylines.net/
 */


require_once("../require.php");
require_once("../" . INCLUDED_FILES . "config.inc.php");
require_once("../" . INCLUDED_FILES . "dbConn.php");
require_once("../" . INCLUDED_FILES . "functionsInc.php");
check_auth_admin();
$conn = dbconnect();

$qry_memcnt = "SELECT count(prodid) count_mem from products_ecomc where category_id = '2'";
$q_memcnt = $conn->prepare($qry_memcnt);
$q_memcnt->execute();
$q_memcnt->setFetchMode(PDO::FETCH_ASSOC);
$row_memcnt = $q_memcnt->fetch();
$mem_cnt = $row_memcnt['count_mem'];

$qry_bibcnt = "SELECT count(prodid) count_bib from products_ecomc where category_id IN ('1','5','6','7','8','9','10')";
$q_bibcnt = $conn->prepare($qry_bibcnt);
$q_bibcnt->execute();
$q_bibcnt->setFetchMode(PDO::FETCH_ASSOC);
$row_bibcnt = $q_bibcnt->fetch();
$bib_cnt = $row_bibcnt['count_bib'];


$qry_va = "SELECT count(prodid) count_va from products_ecomc where category_id = '19'";
$q_va = $conn->prepare($qry_va);
$q_va->execute();
$q_va->setFetchMode(PDO::FETCH_ASSOC);
$row_va = $q_va->fetch();
$va_cnt = $row_va['count_va'];


$qry_imgcnt = "SELECT count(m_image_id) count_img from memorabilia_images";
$q_imgcnt = $conn->prepare($qry_imgcnt);
$q_imgcnt->execute();
$q_imgcnt->setFetchMode(PDO::FETCH_ASSOC);
$row_imgcnt = $q_imgcnt->fetch();
$img_cnt = $row_imgcnt['count_img'];




$qry_vaimgcnt = "SELECT count(va_image_id) count_vaimg from visual_archive_images";
$q_vaimgcnt = $conn->prepare($qry_vaimgcnt);
$q_vaimgcnt->execute();
$q_vaimgcnt->setFetchMode(PDO::FETCH_ASSOC);
$row_vaimgcnt = $q_vaimgcnt->fetch();
$vaimg_cnt = $row_vaimgcnt['count_vaimg'];



$qry_custcnt = "SELECT count(id) count_cust from customer_login";
$q_custcnt = $conn->prepare($qry_custcnt);
$q_custcnt->execute();
$q_custcnt->setFetchMode(PDO::FETCH_ASSOC);
$row_custcnt = $q_custcnt->fetch();
$cust_cnt = $row_custcnt['count_cust'];

$qry_ordcnt = "SELECT count(order_id) count_ord from tbl_order";
$q_ordcnt = $conn->prepare($qry_ordcnt);
$q_ordcnt->execute();
$q_ordcnt->setFetchMode(PDO::FETCH_ASSOC);
$row_ordcnt = $q_ordcnt->fetch();
$ord_cnt = $row_ordcnt['count_ord'];


$sql = "select * from "
        . "memorabilia_images order by date_created desc limit 12";
$q = $conn->prepare($sql);
$q->execute();
$q->setFetchMode(PDO::FETCH_ASSOC);
$count = $q->rowCount();
while ($row = $q->fetch()) {
    $image_list[] = array(
        'm_image_id' => $row['m_image_id'],
        'm_image_name' => $row['m_image_name'],
        'date_created' => $row['date_created']
    );
}

$qry_attrcnt = "SELECT count(attr_value_id) count_attr from attribute_value_ecomc where attr_id = '65'";
$q_attrcnt = $conn->prepare($qry_attrcnt);
$q_attrcnt->execute();
$q_attrcnt->setFetchMode(PDO::FETCH_ASSOC);
$row_attrcnt = $q_attrcnt->fetch();
$attr_cnt = $row_attrcnt['count_attr'];

$qry_noimgcnt = "SELECT count(prodid) count_noimg from products_ecomc where
 products_ecomc.category_id = '2' and prodid NOT IN(
SELECT products_ecomc.prodid from products_ecomc,memorabilia_images where products_ecomc.prodid = memorabilia_images.product_id and products_ecomc.category_id = '2')";
$q_noimgcnt = $conn->prepare($qry_noimgcnt);
$q_noimgcnt->execute();
$q_noimgcnt->setFetchMode(PDO::FETCH_ASSOC);
$row_noimgcnt = $q_noimgcnt->fetch();
$noimg_cnt = $row_noimgcnt['count_noimg'];


$qry_yesimgcnt = "SELECT count(prodid) count_yesimg from products_ecomc where
 products_ecomc.category_id = '2' and prodid IN(
SELECT products_ecomc.prodid from products_ecomc,memorabilia_images 
where products_ecomc.prodid = memorabilia_images.product_id and products_ecomc.category_id ='2')";
$q_yesimgcnt = $conn->prepare($qry_yesimgcnt);
$q_yesimgcnt->execute();
$q_yesimgcnt->setFetchMode(PDO::FETCH_ASSOC);
$row_yesimgcnt = $q_yesimgcnt->fetch();
$yesimg_cnt = $row_yesimgcnt['count_yesimg'];


$qry_memcnt1 = "select a.prod_id,a.prodname,a.m_image_name,count(a.prod_id) count_prod  from
(SELECT access_log.*,memorabilia_images.m_image_id,memorabilia_images.product_id,
 memorabilia_images.m_image_name,memorabilia_images.m_image_category_text,products_ecomc.prodname 
 FROM `access_log`,`memorabilia_images`,`products_ecomc`
 where access_log.prod_id = memorabilia_images.m_image_id 
 AND products_ecomc.prodid = memorabilia_images.product_id AND type='memoribilia_image' ) a
group by a.prod_id order by count_prod desc limit 10";
$q_memcnt1 = $conn->prepare($qry_memcnt1);
$q_memcnt1->execute();
$q_memcnt1->setFetchMode(PDO::FETCH_ASSOC);
while ($row_memcnt1 = $q_memcnt1->fetch()) {
    $memcnt1_list[] = array(
        'prod_id' => $row_memcnt1['prod_id'],
        'prodname' => $row_memcnt1['prodname'],
        'm_image_name' => $row_memcnt1['m_image_name'],
        'count_prod' => $row_memcnt1['count_prod']
    );
}


$qry_memcnt2 = "select a.prod_id,a.prodname,count(a.prod_id) count_prod  from
(SELECT access_log.*,products_ecomc.prodname 
 FROM `access_log`,`products_ecomc`
 where access_log.prod_id = products_ecomc.prodid 
  AND type='memoribilia' ) a
group by a.prod_id order by count_prod desc limit 10";
$q_memcnt2 = $conn->prepare($qry_memcnt2);
$q_memcnt2->execute();
$q_memcnt2->setFetchMode(PDO::FETCH_ASSOC);
while ($row_memcnt2 = $q_memcnt2->fetch()) {
    $memcnt2_list[] = array(
        'prod_id' => $row_memcnt2['prod_id'],
        'prodname' => $row_memcnt2['prodname'],
        'count_prod' => $row_memcnt2['count_prod']
    );
}



$qry_vacnt2 = "select a.prod_id,a.prodname,count(a.prod_id) count_prod  from
(SELECT access_log.*,products_ecomc.prodname 
 FROM `access_log`,`products_ecomc`
 where access_log.prod_id = products_ecomc.prodid 
  AND type='visualarchive' ) a
group by a.prod_id order by count_prod desc limit 10";
$q_vacnt2 = $conn->prepare($qry_vacnt2);
$q_vacnt2->execute();
$q_vacnt2->setFetchMode(PDO::FETCH_ASSOC);
while ($row_vacnt2 = $q_vacnt2->fetch()) {
    $vacnt2_list[] = array(
        'prod_id' => $row_vacnt2['prod_id'],
        'prodname' => $row_vacnt2['prodname'],
        'count_prod' => $row_vacnt2['count_prod']
    );
}


$qry_bibcnt2 = "select a.prod_id,a.prodname,count(a.prod_id) count_prod  from
(SELECT access_log.*,products_ecomc.prodname 
 FROM `access_log`,`products_ecomc`
 where access_log.prod_id = products_ecomc.prodid 
  AND type='bibliography' ) a
group by a.prod_id order by count_prod desc limit 10";
$q_bibcnt2 = $conn->prepare($qry_bibcnt2);
$q_bibcnt2->execute();
$q_bibcnt2->setFetchMode(PDO::FETCH_ASSOC);
while ($row_bibcnt2 = $q_bibcnt2->fetch()) {
    $bibcnt2_list[] = array(
        'prod_id' => $row_bibcnt2['prod_id'],
        'prodname' => $row_bibcnt2['prodname'],
        'count_prod' => $row_bibcnt2['count_prod']
    );
}



$sqlva = "select * from "
        . "visual_archive_images order by va_date_created desc limit 12";
$qva = $conn->prepare($sqlva);
$qva->execute();
$qva->setFetchMode(PDO::FETCH_ASSOC);
$countva = $qva->rowCount();
while ($rowva = $qva->fetch()) {
    $image_listva[] = array(
        'va_image_id' => $rowva['va_image_id'],
        'va_image_name' => $rowva['va_image_name'],
        'va_date_created' => $rowva['va_date_created']
    );
}

include(ADMIN_HTML . "admin-headerInc.php");
?>
<div class="col-sm-9 col-md-9">
    <div class="panel panel-default">
        <div class="panel-heading">

            <h3 class="panel-title">Dashboard</h3>
        </div>
        <div class="panel-body">
            <div role="tabpanel">


                <div class="col-md-12">
                    <div class='col-md-4 admin-details-box'>
                        <p class="count-heading">Memorabilia count</p>
                        <p class="count-result"><?php echo $mem_cnt; ?><small><?php echo ' / Att: ' . $attr_cnt; ?></small></p>
                    </div>
                    <div class='col-md-4 admin-details-box'>
                        <p class="count-heading">Film Images</p>
                        <p class="count-result"><?php echo $img_cnt; ?></p>
                    </div>
                    <div class='col-md-4 admin-details-box'>
                        <p class="count-heading">Films without Image</p>
                        <p class="count-result"><?php echo $noimg_cnt; ?> <small><?php echo ' / ' . $yesimg_cnt; ?></small></p>
                    </div>
                </div>
                <div class="col-md-12"> 
                    <div class='col-md-4 admin-details-box'>
                        <p class="count-heading">Bibliography Count</p>
                        <p class="count-result"><?php echo $bib_cnt; ?></p>
                    </div>
                

                    <div class='col-md-4 admin-details-box'>
                        <p class="count-heading">VA Count</p>
                        <p class="count-result"><?php echo $va_cnt; ?></p>
                    </div>


                    <div class='col-md-4 admin-details-box'>
                        <p class="count-heading">VA Images</p>
                        <p class="count-result"><?php echo $vaimg_cnt; ?></p>
                    </div>

                </div>
                <div class="col-md-12">
                    <div class='col-md-4 admin-details-box'>
                        <p class="count-heading">Customers</p>
                        <p class="count-result"><?php echo $cust_cnt; ?></p>
                    </div>
                    <div class='col-md-4 admin-details-box'>
                        <p class="count-heading">Orders</p>
                        <p class="count-result"><?php echo $ord_cnt; ?></p>
                    </div>

                </div>
                <div class="col-md-12">   

                    <div class='col-md-4'>
                        <h4>Memorabilia images hits</h4>
                        <table class="table table-striped" >
                            <thead>
                                <tr>
                                    <th>Item</th>
                                    <th>Image</th>
                                    <th>Count</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (!empty($memcnt1_list)): ?>
                                    <?php
                                    $i = 1;
                                    foreach ($memcnt1_list as $k => $v):
                                        ?>
                                        <tr>
                                            <td style="text-align: left;"><?php echo $v['prodname']; ?></td>
                                            <td style="text-align: left;"><img src="<?php echo SITE_URL . '/product_images/thumbs/' . $v['m_image_name']; ?>" style="height:50px; width: 50px;"></td>
                                            <td style="text-align: left;"><?php echo $v['count_prod']; ?></td>
                                        </tr>
                                        <?php
                                        $i++;
                                    endforeach;
                                    ?>
                                <?php endif; ?>
                            </tbody>
                        </table>

                    </div>
                    <div class='col-md-4'>
                        <h4>Memorabilia film hits</h4>
                        <table class="table table-striped" >
                            <thead>
                                <tr>
                                    <th>Film</th>
                                    <th>Image</th>
                                    <th>Count</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (!empty($memcnt2_list)): ?>
                                    <?php
                                    $i = 1;
                                    foreach ($memcnt2_list as $k2 => $v2):
                                        ?>
                                        <tr>
                                            <td style="text-align: left;"><?php echo $v2['prodname']; ?></td>
                                            <td style="text-align: left;"><?php
                                                $qry_prod_img1 = "SELECT m_image_name from memorabilia_images where product_id = '" . $v2['prod_id'] . "' and is_featured = '1' limit 1";
                                                $q_prod_img1 = $conn->prepare($qry_prod_img1);
                                                $q_prod_img1->execute();
                                                $q_prod_img1->setFetchMode(PDO::FETCH_ASSOC);
                                                $img_exists = $q_prod_img1->rowCount();
                                                $row_prod_img1 = $q_prod_img1->fetch();
                                                $prod_img1 = $row_prod_img1['m_image_name'];
                                                if ($img_exists > 0) {
                                                    ?>
                                                    <img src="<?php echo SITE_URL . '/product_images/thumbs/' . $prod_img1; ?>" style="height:50px; width: 50px;">
                                                    <?php
                                                }
                                                ?>
                                            </td>
                                            <td style="text-align: left;"><?php echo $v2['count_prod']; ?></td>
                                        </tr>
                                        <?php
                                        $i++;
                                    endforeach;
                                    ?>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                    <div class='col-md-4'>
                        <h4>Bibliography Hits</h4>
                        <table class="table table-striped" >
                            <thead>
                                <tr>
                                    <th>Item</th>
                                    <th>Count</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (!empty($bibcnt2_list)): ?>
                                    <?php
                                    $i = 1;
                                    foreach ($bibcnt2_list as $k3 => $v3):
                                        ?>
                                        <tr>
                                            <td style="text-align: left;"><?php echo $v3['prodname']; ?></td>                 
                                            <td style="text-align: left;"><?php echo $v3['count_prod']; ?></td>
                                        </tr>
                                        <?php
                                        $i++;
                                    endforeach;
                                    ?>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="clearfix"></div>
                
                
                
                
                
                <div class="col-md-12">  
                
                <div class='col-md-4'>
                        <h4>VA Hits</h4>
                        <table class="table table-striped" >
                            <thead>
                                <tr>
                                    <th>Item</th>
                                    <th>Count</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (!empty($vacnt2_list)): ?>
                                    <?php
                                    $i = 1;
                                    foreach ($vacnt2_list as $k4 => $v4):
                                        ?>
                                        <tr>
                                            <td style="text-align: left;"><?php echo $v4['prod_id'].'('.$v4['prodname'].')'; ?></td>                 
                                            <td style="text-align: left;"><?php echo $v4['count_prod']; ?></td>
                                        </tr>
                                        <?php
                                        $i++;
                                    endforeach;
                                    ?>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                
                </div>
                
                
                
                
                
                <hr>
                <div class="clearfix"></div>
                <div class="col-md-12">
                    <h3>Last Uploaded Memorabilia Images</h3>
                    <?php if (!empty($image_list)): ?>
                        <?php
                        $i = 1;
                        foreach ($image_list as $k => $v):
                            ?>
                            <div class="col-md-1 last-uploaded-images">
                                <img class="img-responsive last-image" src="<?php echo SITE_URL . '/product_images/thumbs/' . $v['m_image_name']; ?>">
                                <span class="datetime-mem-image"><?php echo $v['date_created']; ?></span>
                            </div>
                            <?php
                            $i++;
                        endforeach;
                        ?>
                    <?php endif; ?>

                </div> 
                <div class="clearfix"></div>
                <div class="col-md-12">
                    <h3>Last Uploaded VA Images</h3>
                    <?php if (!empty($image_listva)): ?>
                        <?php
                        $i = 1;
                        foreach ($image_listva as $kva => $vva):
                            ?>
                            <div class="col-md-1 last-uploaded-images">
                                <img class="img-responsive last-image" src="<?php echo SITE_URL . '/' . VA_THUMB_IMGS  . $vva['va_image_name']; ?>">
                                <span class="datetime-mem-image"><?php echo $vva['va_date_created']; ?></span>
                            </div>
                            <?php
                            $i++;
                        endforeach;
                        ?>
                    <?php endif; ?>

                </div> 
            </div>
        </div>
    </div>
</div>
<?php
//include(ADMIN_HTML . 'products-tpl.php');
include(ADMIN_HTML . "admin-footerInc.php");

