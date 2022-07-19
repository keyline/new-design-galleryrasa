<?php
require_once("../require.php");
require_once("../" . INCLUDED_FILES . "config.inc.php");
require_once("../" . INCLUDED_FILES . "dbConn.php");
require_once("../" . INCLUDED_FILES . "functionsInc.php");
require_once("../" . PAYU_FILES . "PayUMoney.php");
require_once("../" . PAYU_FILES . "PurchaseResult.php");


$payumoney = new PayUMoney(['merchantId' => 'rjQUPktU',
                            'secretKey'  => 'e5iIg1jwi8',
                            'testMode'   => true
                            ]);
                    

$result = $payumoney->completePurchase($_POST);
$postdata = $result->getParams();
//print "<pre>";
//print_r($postdata);
//var_dump($result->checksumIsValid());
//var_dump($result->getStatus());
//print_r($payumoney);

        $txnid = $postdata['txnid'];
    	$order_id = explode('_', $txnid);
	$order_id = (int)$order_id[0];    //get rid of time part
        $amount      		= 	$postdata['amount'];
	$productInfo  		= 	$postdata['productinfo'];
	$firstname    		= 	$postdata['firstname'];
	$email        		=	$postdata['email'];
        
        $order = get_order_status_byID($order_id);
        
        if (isset($postdata['status']) && $postdata['status'] == 'success') {
                
                    if ($result->checksumIsValid()) {
                        
                        $message = array(
                            'text'  => "<h1>Thank you for shopping with us. Your account has been charged and your transaction is successful with following order details:</h1> 
								
							<br> 
								<strong>Order Id:</strong> $order_id <br/>
								<strong>Amount:</strong> $amount 
								<br />
								
									
						We will be shipping your order to you soon.",
                            'class' => 'success'
                        );
                        
                        if($order['status'] == 'processing' || $order['status'] == 'completed' )
						{
							//do nothing
                                                }else{
                                                    //Place the order
                                                    $columns = array(
                                                        'id' => 'null',
                                                        'order_id'=> ':orderID',
                                                        'status'    => ':orderStatus',
                                                        'comment'   => ':orderComment',
                                                        'date'      => 'now()'
                                                    );
                                                    $bind = array(
                                                        ':orderID' => $order['order_id'],
                                                        ':orderStatus'=> 'placed',
                                                        ':orderComment'=> 'Payment has been made',
                                                        
                                                    );
                                                    
                                                    //Payment Table
                                                    $pay_col = array(
                                                        'payment_id'    => 'null',
                                                        'payment_token'         => ':payment_token',
                                                        'order_id'         => ':order_id',
                                                        'payment_status'        => ':payment_status',
                                                        'date_added'    => 'now()'
                                                    );
                                                    $pay_bind = array(
                                                        ':payment_token'    => $postdata['txnid'],
                                                        ':order_id'         => $order['order_id'],
                                                        ':payment_status'   => $postdata['status']
                                                    );
                                                    
                                                    //Payment Meta table
                                                    $pay_meta_col = array(
                                                        'meta_id'   => 'null',
                                                        'p_token_id'     => ':p_token_id',
                                                        'card_name'      => ':card_name',
                                                        'card_number'   => ':card_number',
                                                        'pg_type'      => ':pg_type',
                                                        'bank_ref_no'=> ':bank_ref_no',
                                                        'pg_id'      => ':pg_id',
                                                        'amt_debited'       => ':amt_debited',
                                                        'payment_mode'      => ':payment_mode',
                                                        'date_added'=> 'now()'
                                                    );
                                                    $pay_meta_bind = array(
                                                        
                                                       ':p_token_id'    => $postdata['txnid'],
                                                        ':card_name'    => $postdata['name_on_card'],
                                                        ':card_number'  => $postdata['cardnum'],
                                                        ':pg_type'      => $postdata['PG_TYPE'],
                                                        ':bank_ref_no'  => $postdata['bank_ref_num'],
                                                        ':pg_id'        => $postdata['payuMoneyId'],
                                                        ':amt_debited'  => $postdata['net_amount_debit'],
                                                        ':payment_mode' => $postdata['mode']
                                                    );
                                                    
                                                    try{
                                                        $conn = dbconnect();
                                                        $qry = insert("order_status", $columns);
                                                        $q = $conn->prepare($qry);
                                                        $q->execute($bind);
                                                         $id  = $conn->lastInsertId();
                                                        
                                                        //Inserting Payment table
                                                        $qry1 = insert(PAYMENT, $pay_col);
                                                        $q1 = $conn->prepare($qry1);
                                                        $q1->execute($pay_bind);
                                                        $id_payment = $conn->lastInsertId();
                                                        
                                                        //Inserting Payment Meta
                                                        $qry2 = insert(PAYMENTMETA, $pay_meta_col);
                                                        $q2 = $conn->prepare($qry2);
                                                        $q2->execute($pay_meta_bind);
                                                        $id_payment_meta = $conn->lastInsertId();
                                                                
                                                        
                                                    } catch (PDOException $pe){
                                                        echo db_error($pe->getMessage());
                                                    }
                                                }
                        
                    }else{
                        //tampered
                        
                        //Payment Table
                                                    $pay_col = array(
                                                        'payment_id'    => 'null',
                                                        'token'         => ':payment_token',
                                                        'ordID'         => ':order_id',
                                                        'status'        => ':payment_status',
                                                        'date_added'    => 'now()'
                                                    );
                                                    $pay_bind = array(
                                                        ':payment_token'    => $postdata['txnid'],
                                                        ':order_id'         => $order['order_id'],
                                                        ':payment_status'   => $postdata['status']
                                                    );
                                                    try{
                                                        $conn = dbconnect();
                                                        //Inserting Payment table
                                                        $qry1 = insert(PAYMENT, $pay_col);
                                                        $q1 = $conn->prepare($qry1);
                                                        $q1->execute($pay_bind);
                                                        $id_payment = $conn->lastInsertId();
                                                        
                                                    } catch (PDOException $pe){
                                                        
                                                        echo db_error($pe->getMessage());
                                                    }
                        $message = array(
                            'class' => 'error',
                            'text'  => "<h1>Thank you for shopping with us. However, the payment failed</h1>"
                        );
                    }
            
        }else{
            $message = array(
                        'class' => 'error',
                        'text'  => "<h1>Thank you for shopping with us. However, the transaction has been declined.</h1>"
            );
        }
        
        $payment = file_get_contents("../" .VIEWS_FOLDER . 'payment-message.Inc.php');
        $search = array('{payment-status}','{payment-message}', '{site-home}');
        $replace = array($message['class'], $message['text'], SITE_URL);
        include("../" .INC_FOLDER . "headerInc.php");
        echo str_replace($search, $replace, $payment);
        include("../" . INC_FOLDER . "footerInc.php");

