<?php



if (isset($_COOKIE['custtypecookie']) && isset($_COOKIE['custidcookie'])) {

    if ($_COOKIE['custtypecookie'] == 'SuperAdmin' || $_COOKIE['custtypecookie'] == 'Admin' ) {
    } else {
        header("location:../login.php");
    }
} else {

    header("location:../login.php");
}

include '../MAIN/Dbconfig.php';


if(isset($_POST['itemId'])){

    $itemCode = $_POST['itemId'];

    $findid = mysqli_query($con, "SELECT item_id FROM item_master WHERE item_code = '$itemCode'");
    foreach($findid as $idresult){
        $itemId = $idresult['item_id'];
    }
    
    
?>
        <div class="row">

            <div class="col-lg-12">
                <div class="table-responsive mt-lg-0 mt-3" id="table_container">
                    <table class="table table-striped" id="viewDetailTable">
                        <thead class="">
                            <tr>
                                <th>Sl.No</th>
                                <th>Product Code</th>
                                <th>Customer Name</th>
                                <th>Phone Number</th>
                                <th>Quantity</th>
                                <th>Total Weight</th>
                            </tr>
                        </thead>
                        <tbody class="text-center">
                            <?php
                                $order_details = mysqli_query($con, "SELECT *,oi.ord_itemQty * i.item_weight AS requiredWeight FROM order_table ot INNER JOIN order_items oi ON ot.order_id = oi.ord_id INNER JOIN item_master i ON oi.ord_itemId = i.item_id where oi.ord_itemId =  '$itemId'");
                                foreach($order_details as $ord_details){
                            ?>
                                <tr>
                                    <td class="rowCount"></td>
                                    <td> <?php echo $ord_details['item_code']; ?> </td>
                                    <td> <?php echo $ord_details['customer_name']; ?> </td>
                                    <td> <?php echo $ord_details['phone_number']; ?> </td>
                                    <td> <?php echo $ord_details['ord_itemQty']; ?> </td>
                                    <td> <?php echo $ord_details['requiredWeight']; ?> </td>
                                </tr>
                            <?php
                                }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <?php
    
}

?>