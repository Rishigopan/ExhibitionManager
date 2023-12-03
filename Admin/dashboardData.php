<?php

require_once "../MAIN/Dbconfig.php";

//total orders
if (isset($_POST["action"])) {

    $fetchTotalOrders = mysqli_query($con, "SELECT COUNT(order_id) AS totalCount FROM order_table");
    if (mysqli_num_rows($fetchTotalOrders) > 0) {
        foreach ($fetchTotalOrders as $TotalOrders) {
            echo '<span>'.$TotalOrders['totalCount'].'</span>';
        }
    } else {
        echo '<span>0</span>';
    }
}



//total quantity
if (isset($_POST["totalQty"])) {

    $fetchTotalQuantity = mysqli_query($con, "SELECT SUM(ord_itemQty) AS totalQty FROM order_items");
    if (mysqli_num_rows($fetchTotalQuantity) > 0) {
        foreach ($fetchTotalQuantity as $TotalQuantity) {
            echo '<span>'.$TotalQuantity['totalQty'].'&nbsp; Nos</span>';
        }
    } else {
        echo '<span>0 Nos</span>';
    }
}



//total weight
if (isset($_POST["totalWgt"])) {

    $fetchTotalWeight = mysqli_query($con, "SELECT SUM(i.item_weight * oi.ord_itemQty) AS totalWgt FROM order_items oi INNER JOIN item_master i ON oi.ord_itemId = i.item_id");
    if (mysqli_num_rows($fetchTotalWeight) > 0) {
        foreach ($fetchTotalWeight as $TotalWeight) {
            echo '<span>'. number_format($TotalWeight['totalWgt']).' &nbsp;GM</span>';
        }
    } else {
        echo '<span>0 &nbsp;GM</span>';
    }
}



//category wise
if (isset($_POST["CatWise"])) {

    $fetchCatWise = mysqli_query($con, "SELECT SUM(oi.ord_itemQty) AS totalQty,c.category_name AS categoryName FROM `order_items` oi INNER JOIN item_master i ON oi.ord_itemId = i.item_id INNER JOIN category_master c ON c.category_id = i.item_category GROUP BY category_id");
    if (mysqli_num_rows($fetchCatWise) > 0) {
        foreach ($fetchCatWise as $CatWise) {
        ?>

            <tr>
                <td><?php  echo $CatWise['categoryName'];  ?></td>
                <td><?php  echo $CatWise['totalQty'];  ?></td>
            </tr>

        <?php 
          
        }
    } else {
        echo ' <tr>
                <td colspan="2">No Data</td>
            </tr>';
    }
}



//staff wise
if (isset($_POST["StaffWise"])) {

    $fetchStaffWise = mysqli_query($con, "SELECT SUM(oi.ord_itemQty) AS totalQTy,(SELECT COUNT(*) FROM order_table WHERE biller_id  = ot.biller_id) AS orderTotal,ud.fullName FROM order_table ot INNER JOIN user_db ud ON ot.biller_id = ud.userId INNER JOIN order_items oi ON ot.order_id = oi.ord_id GROUP BY ot.biller_id;");
    if (mysqli_num_rows($fetchStaffWise) > 0) {
        foreach ($fetchStaffWise as $StaffWise) {
        ?>

            <tr>
                <td><?php  echo $StaffWise['fullName'];  ?></td>
                <td><?php  echo $StaffWise['orderTotal'];  ?></td>
                <td><?php  echo $StaffWise['totalQTy'];  ?></td>
            </tr>

        <?php 
          
        }
    } else {
        echo ' <tr>
                <td colspan="3">No Data</td>
            </tr>';
    }
}




?>

