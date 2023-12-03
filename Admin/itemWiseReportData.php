<?php



if (isset($_COOKIE['custtypecookie']) && isset($_COOKIE['custidcookie'])) {

    if ($_COOKIE['custtypecookie'] == 'SuperAdmin' || $_COOKIE['custtypecookie'] == 'Admin') {
    } else {
        header("location:../login.php");
    }
} else {

    header("location:../login.php");
}

include '../MAIN/Dbconfig.php';


$find_data = mysqli_query($con, "SELECT ot.ord_itemId,i.item_code,i.item_name,g.goldsmith_name,c.category_name,SUM(ot.ord_itemQty) AS totalQty, SUM(ot.ord_itemQty * i.item_weight) AS totalWgt FROM order_items ot INNER JOIN item_master i ON ot.ord_itemId = i.item_id INNER JOIN goldsmith_master g ON i.item_manufacturer = g.goldsmith_id INNER JOIN category_master c ON c.category_id = i.item_category GROUP by ot.ord_itemId");
while ($dataRow = mysqli_fetch_assoc($find_data)) {
    $rows[] = $dataRow;
}

$dataset = array(
    "data" => $rows
);

echo json_encode($dataset);
