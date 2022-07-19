<?php

require_once("../require.php");
require_once("../" . INCLUDED_FILES . "config.inc.php");
require_once("../" . INCLUDED_FILES . "dbConn.php");
require_once("../" . INCLUDED_FILES . "functionsInc.php");

$stylesheet = '<style>' . file_get_contents('pdf.css') . '</style>';
check_auth_admin();
$conn = dbconnect();
require('WriteHTML.php');

$pdf = new PDF_HTML();

$pdf->AliasNbPages();
$pdf->SetAutoPageBreak(true, 15);

$pdf->AddPage();
$pdf->Image('../logo.gif', 10, 5, 30, 30);
$order_id = $_GET['ord_id'];

$sql = "select ord.*,cust.fname,cust.lname,cust.email,cust.phone,gateway.name gateway_name,c_add.street_address,c_add.city,c_add.state,c_add.country,c_add.zip,c_add.landmark,c_add.parent_id from "
        . "tbl_order ord,customer_login cust,gateway,customer_address c_add"
        . " where ord.customer_id=cust.id and ord.gateway_id=gateway.id and ord.address_id=c_add.id and ord.order_id = '$order_id' order by ord.order_id desc";
$q = $conn->prepare($sql);
$q->execute();
$q->setFetchMode(PDO::FETCH_ASSOC);
$count = $q->rowCount();
$row = $q->fetch();

$order_id = $row['order_id'];
$order_org_id = $row['order_org_id'];
$customer_id = $row['customer_id'];
$gateway_id = $row['gateway_id'];
$address_id = $row['address_id'];
$note = $row['note'];
$price = $row['price'];
$order_date = $row['date'];
$fname = $row['fname'];
$lname = $row['lname'];
$email = $row['email'];
$phone = $row['phone'];
$gateway_name = $row['gateway_name'];
$street_address = $row['street_address'];
$city = $row['city'];
$state = $row['state'];
$country = $row['country'];
$zip = $row['zip'];
$landmark = $row['landmark'];
$parent_id = $row['parent_id'];


$pdf->SetFont('Arial', 'B', 16);
$pdf->SetY(13);
$pdf->SetX(105);
$pdf->Cell(0, 0, 'RASA GALLERY', 0, 1, 'L');
$pdf->SetFont('Arial', '', 10);
$pdf->SetY(17);
$pdf->SetX(105);
$pdf->Cell(0, 5, 'Address: ', 0, 1, 'L');
$pdf->SetX(105);
$pdf->Cell(0, 5, 'Kolkata 700 000', 0, 1, 'L');
$pdf->SetX(105);
$pdf->Cell(0, 5, 'Phone: ', 0, 1, 'L');
$pdf->SetX(105);
$pdf->Cell(0, 5, 'Email: info@rasagallery.com', 0, 1, 'L');

$pdf->SetFont('Arial', 'B', 13);
$pdf->Cell(0, 7, '', 0, 1, 'L');
$pdf->Cell(0, 7, '', 0, 1, 'L');
$pdf->Cell(0, 7, 'PACKING SLIP', 0, 1, 'L');
$pdf->SetFont('Arial', '', 9);
$pdf->Cell(0, 7, 'Order Number: ' . $order_org_id, 0, 1, 'L');
//$pdf->Cell(0, 7, 'Invoice Number: ' . $order_id, 0, 1, 'L');
$pdf->Cell(0, 7, 'Order Date: ' . $order_date, 0, 1, 'L');
$pdf->Cell(0, 7, 'Payment Methad: ' . $gateway_name, 0, 1, 'L');

$pdf->SetFont('Arial', 'B', 12);
$pdf->Cell(0, 7, 'Customer Details: ', 0, 1, 'L');

$pdf->SetFont('Arial', '', 9);
$pdf->Cell(0, 7, 'Name: ' . $fname . ' ' . $lname, 0, 1, 'L');
$pdf->Cell(0, 7, 'Email: ' . $email, 0, 1, 'L');
$pdf->Cell(0, 7, 'Phone: ' . $phone, 0, 1, 'L');
$pdf->Cell(0, 7, 'Address: ' . $street_address, 0, 1, 'L');
$pdf->Cell(0, 7, 'City: ' . $city, 0, 1, 'L');
$pdf->Cell(0, 7, 'State: ' . $state, 0, 1, 'L');
$pdf->Cell(0, 7, 'Country: ' . $country, 0, 1, 'L');
$pdf->Cell(0, 7, 'Zipcode: ' . $zip, 0, 1, 'L');
$pdf->Cell(0, 7, 'Landmark: ' . $landmark, 0, 1, 'L');


$pdf->SetFont('Arial', 'B', 10);
$sql_prod = "select * from order_products where order_id = '$order_id'";
$q_prod = $conn->prepare($sql_prod);
$q_prod->execute();
$q_prod->setFetchMode(PDO::FETCH_ASSOC);
while ($row_prod = $q_prod->fetch()) {
    $prod_list[] = array(
        'product_name' => $row_prod['product_name'],
        'imagetype' => $row_prod['imagetype'],
        'details' => $row_prod['details'],
        'quantity' => $row_prod['quantity'],
        'price' => $row_prod['price']
    );
}
$htmlTable = '<table class="tbl"><thead>
<tr>
<td>Product Name</td>
<td>Type</td>
<td>Details</td>
<td>Quantity</td>

</tr><thead>';

foreach ($prod_list as $k => $v) {

    $htmlTable.='<tbody>
<tr>
<td>' . $v['product_name'] . '</td>
<td>' . $v['imagetype'] . '</td>
<td>' . $v['details'] . '</td>
<td>' . $v['quantity'] . '</td>

</tr><tbody>';
}

$htmlTable.='</table>';
$pdf->SetY(145);

$pdf->WriteHTML("<br>$htmlTable");

$pdf->Output();
?>