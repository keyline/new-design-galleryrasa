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

$sql = "select ord.*,cust.fname,cust.lname,cust.email,cust.phone,gateway.name gateway_name,c_add.name ship_cust_name,c_add.phone ship_cust_phone,c_add.street_address,c_add.city,c_add.state,c_add.country,c_add.zip,c_add.landmark,c_add.parent_id from "
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
$ship_cust_name = $row['ship_cust_name'];
$ship_cust_phone = $row['ship_cust_phone'];
$street_address = $row['street_address'];
$city = $row['city'];
$state = $row['state'];
$country = $row['country'];
$zip = $row['zip'];
$landmark = $row['landmark'];
$parent_id = $row['parent_id'];

if($ship_cust_name != ''){
    $ship_name = $ship_cust_name;
} else {
    $ship_name = $fname . ' ' . $lname;
}
if($ship_cust_phone != ''){
    $ship_ph = $ship_cust_phone;
}else{
   $ship_ph = $phone; 
}

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
$pdf->Cell(0, 7, 'INVOICE', 0, 1, 'L');
$pdf->SetFont('Arial', '', 9);
$pdf->Cell(0, 7, 'Order Number: ' . $order_org_id, 0, 1, 'L');
$pdf->Cell(0, 7, 'Invoice Number: ' . $order_id, 0, 1, 'L');
$pdf->Cell(0, 7, 'Order Date: ' . $order_date, 0, 1, 'L');
$pdf->Cell(0, 7, 'Payment Methad: ' . $gateway_name, 0, 1, 'L');

$pdf->SetFont('Arial', 'B', 12);
$pdf->Cell(0, 7, 'Customer Details: ', 0, 1, 'L');

$pdf->SetFont('Arial', '', 9);
if ($parent_id == 0) {
    $pdf->Cell(0, 7, 'Name: ' . $fname . ' ' . $lname, 0, 1, 'L');
    $pdf->Cell(0, 7, 'Email: ' . $email, 0, 1, 'L');
    $pdf->Cell(0, 7, 'Phone: ' . $phone, 0, 1, 'L');
    $pdf->Cell(0, 7, 'Address: ' . $street_address, 0, 1, 'L');
    $pdf->Cell(0, 7, 'City: ' . $city, 0, 1, 'L');
    $pdf->Cell(0, 7, 'State: ' . $state, 0, 1, 'L');
    $pdf->Cell(0, 7, 'Country: ' . $country, 0, 1, 'L');
    $pdf->Cell(0, 7, 'Zipcode: ' . $zip, 0, 1, 'L');
    $pdf->Cell(0, 7, 'Landmark: ' . $landmark, 0, 1, 'L');
} else {
    $sql_addr = "select * from customer_address where id = '$parent_id'";
    $q_addr = $conn->prepare($sql_addr);
    $q_addr->execute();
    $q_addr->setFetchMode(PDO::FETCH_ASSOC);
    $row_addr = $q_addr->fetch();

    $pdf->Cell(0, 7, 'Name: ' . $fname . ' ' . $lname, 0, 1, 'L');
    $pdf->Cell(0, 7, 'Email: ' . $email, 0, 1, 'L');
    $pdf->Cell(0, 7, 'Phone: ' . $phone, 0, 1, 'L');
    $pdf->Cell(0, 7, 'Address: ' . $row_addr['street_address'], 0, 1, 'L');
    $pdf->Cell(0, 7, 'City: ' . $row_addr['city'], 0, 1, 'L');
    $pdf->Cell(0, 7, 'State: ' . $row_addr['state'], 0, 1, 'L');
    $pdf->Cell(0, 7, 'Country: ' . $row_addr['country'], 0, 1, 'L');
    $pdf->Cell(0, 7, 'Zipcode: ' . $row_addr['zip'], 0, 1, 'L');
    $pdf->Cell(0, 7, 'Landmark: ' . $row_addr['landmark'], 0, 1, 'L');
}
$pdf->SetFont('Arial', 'B', 12);
$pdf->SetY(89);
$pdf->SetX(110);
$pdf->Cell(0, 0, 'Shipping Address: ', 0, 1, 'L');
$pdf->SetFont('Arial', '', 9);
$pdf->SetY(95);
$pdf->SetX(110);
$pdf->Cell(0, 0, 'Name: ' . $ship_name, 0, 1, 'L');
$pdf->SetY(101);
$pdf->SetX(110);
$pdf->Cell(0, 0, 'Phone: ' . $ship_ph, 0, 1, 'L');
$pdf->SetY(107);
$pdf->SetX(110);
$pdf->Cell(0, 0, 'Address: ' . $street_address, 0, 1, 'L');
$pdf->SetY(110);
$pdf->SetX(110);
$pdf->Cell(0, 7, 'City: ' . $city, 0, 1, 'L');
$pdf->SetY(116);
$pdf->SetX(110);
$pdf->Cell(0, 7, 'State: ' . $state, 0, 1, 'L');
$pdf->SetY(122);
$pdf->SetX(110);
$pdf->Cell(0, 7, 'Country: ' . $country, 0, 1, 'L');
$pdf->SetY(128);
$pdf->SetX(110);
$pdf->Cell(0, 7, 'Zipcode: ' . $zip, 0, 1, 'L');
$pdf->SetY(134);
$pdf->SetX(110);
$pdf->Cell(0, 7, 'Landmark: ' . $landmark, 0, 1, 'L');
$pdf->SetFont('Arial', 'B', 6);

$pdf->SetFont('Arial', '', 9);

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
        'price' => $row_prod['price'],
        'tax_percentage' => $row_prod['tax_percentage'],
        'tax_amount' => $row_prod['tax_amount']
    );
}
$htmlTable = '<table width="1200" border="1"><thead>
<tr>
<td>Product Name</td>
<td>Type</td>
<td>Details</td>
<td>Quantity</td>
<td>Price</td>
<td>Tax</td>

</tr><thead>';
$total = 0;
foreach ($prod_list as $k => $v) {

    $htmlTable.='<tbody>
<tr>
<td>' . $v['product_name'] . '</td>
<td>' . $v['imagetype'] . '</td>
<td>' . $v['details'] . '</td>
<td>' . $v['quantity'] . '</td>
<td>' . 'Rs. ' . $v['price'] . '</td>
    <td>' .'Rs. '. $v['tax_amount'] . '('.$v['tax_percentage'].'%)'.'</td>
</tr><tbody>';
    $total+= $v['price'] + $v['tax_amount'];
}

$htmlTable.='</table>';
$pdf->SetY(150);
$pdf->WriteHTML("<br>$htmlTable");

$pdf->SetFont('Arial', 'B', 10);
$pdf->Cell(0, 5, 'Total: Rs.' . $total, 0, 1, 'C');
//$pdf->Cell(0, 5, 'Tax Percentage: ' . $tax_percentage . '%', 0, 1, 'C');
//$pdf->Cell(0, 5, 'Tax Amount: Rs. ' . $tax_amount, 0, 1, 'C');
$pdf->Cell(0, 5, 'Total Price: Rs. ' . $price, 0, 1, 'C');

$pdf->Output();
?>