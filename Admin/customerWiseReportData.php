<?php



if (isset($_COOKIE['custtypecookie']) && isset($_COOKIE['custidcookie'])) {

    if ($_COOKIE['custtypecookie'] == 'SuperAdmin' || $_COOKIE['custtypecookie'] == 'Admin' || $_COOKIE['custtypecookie'] == 'Executive') {
    } else {
        header("location:../login.php");
    }
} else {

    header("location:../login.php");
}

include '../MAIN/Dbconfig.php';


$find_data = mysqli_query($con, "SELECT ot.order_id,ot.customer_name,ot.phone_number,ot.contact_person,ot.location,ot.branch,ud.fullName AS Biller,SUM(oi.ord_itemQty) AS totalQty,SUM(oi.ord_itemQty * i.item_weight) AS totalWgt, COUNT(DISTINCT(oi.ord_itemId)) AS itemCount FROM `order_table` ot INNER JOIN order_items oi ON ot.order_id = oi.ord_id INNER JOIN item_master i ON i.item_id = oi.ord_itemId INNER JOIN user_db ud ON ud.userId = ot.biller_id  GROUP BY ot.customer_name,ot.phone_number ORDER BY ot.order_id DESC");
while ($dataRow = mysqli_fetch_assoc($find_data)) {
    $rows[] = $dataRow;
}

$dataset = array(
    "data" => $rows
);

echo json_encode($dataset);


?>