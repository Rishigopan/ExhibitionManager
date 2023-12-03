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


$find_data = mysqli_query($con, "SELECT g.goldsmith_id,g.goldsmith_name,COUNT(DISTINCT(ot.ord_itemID)) AS totalPieces,SUM(ot.ord_itemQty) AS totalQty, SUM(ot.ord_itemQty * i.item_weight) AS totalWgt FROM order_items ot INNER join item_master i ON ot.ord_itemId = i.item_id INNER JOIN goldsmith_master g ON g.goldsmith_id = i.item_manufacturer GROUP BY g.goldsmith_name ORDER BY goldsmith_name ASC");
while ($dataRow = mysqli_fetch_assoc($find_data)) {
    $rows[] = $dataRow;
}

$dataset = array(
    "data" => $rows
);

echo json_encode($dataset);
