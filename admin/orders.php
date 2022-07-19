<?php

    require_once("../require.php");
    require_once("../" . INCLUDED_FILES . "config.inc.php");
    require_once("../" . INCLUDED_FILES . "dbConn.php");
    require_once("../" . INCLUDED_FILES . "functionsInc.php");
    check_auth_admin();
    $conn = dbconnect();

    try {

        if (isset($_GET['st'])) {
            $qry = "UPDATE " . ORDERS_TBL . "
                   SET status=:st,
                     status_date=now()
               WHERE orderid=:oi ";
            $q = $conn->prepare($qry);
            $q->bindParam(':st', $_GET['st']);
            $q->bindParam(':oi', $_GET['oi']);

            $q->execute();
        }
        $sql = "SELECT *, CONCAT(firstname, ' ',lastname) as n,
                                 date_format(order_date, '%b %d %h:%i') as d
                         FROM " . ORDERS_TBL . " order by order_date desc";
        $q = $conn->query($sql);
        $q->setFetchMode(PDO::FETCH_ASSOC);
        $count = $q->rowCount();
        $sql2 = '';
        if (!isset($_GET['page'])) {
            $_GET['page'] = 1;
        }
        $pages = pagination($_GET['page'], $count, PER_PAGE, 'orders?', 0);

        $sql2 .= $sql . " LIMIT  " . $pages['qstart'] . "," . PER_PAGE;
        $q = $conn->query($sql2);

        $q->setFetchMode(PDO::FETCH_ASSOC);
        $items = '';

        while ($row = $q->fetch()) {
            if ($row['status'] == 0) {
                $order_status = ORDER_CANCELLED;
                $order_colour = 'danger';
            } elseif ($row['status'] == 1) {
                $order_status = ORDER_PENDING;
                $order_colour = 'info';
            } elseif ($row['status'] == 2) {
                $order_status = ORDER_COMPLETED;
                $order_colour = 'primary';
            } elseif ($row['status'] == 3) {
                $order_status = ORDER_DESPATCHED;
                $order_colour = 'success';
            } else {
                $order_status = $order_colour = '';
            }

            $order_list[] = array(
                'orderid' => $row['orderid'],
                'name' => $row['n'],
                'date' => $row['d'],
                'status' => $order_status,
                'colour' => $order_colour,
                'total' => ($row['order_total'] + $row['shipping']),
                'stat_date' => $row['status_date']
            );

        }

        include(ADMIN_HTML . "admin-headerInc.php");
        include(ADMIN_HTML . 'orders-tpl.php');
        include(ADMIN_HTML . "admin-footerInc.php");
    } catch (PDOException $pe) {
        echo $err = $pe->getMessage();
    }

?>  