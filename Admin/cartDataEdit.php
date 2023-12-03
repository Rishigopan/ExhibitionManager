<?php


require "../MAIN/Dbconfig.php";

$cartTable = 'order_items';

//Display cart items
if (isset($_POST["updatecart"])) {
    $orderId = $_POST['updatecart'];

?>

    <div class="d-flex justify-content-start mb-2">
        <h4 class="m-0 pb-2 my-auto">Order Cart</h4>
    </div>

    <div class="table-responsive" id="table_container">

    

    <table class="table-striped table table_items" id="viewDetailTable">
        <thead class="text-center">
            <tr>
                <th>Sl</th>
                <th>Code</th>
                <!--<th>Image</th>-->
                <th>Qty</th>
                <th>Weight</th>
                <th>Description</th>
                <th>Delete</th>
            </tr>
        </thead>
        <tbody>

    <?php
    $fetchCart = mysqli_query($con, "SELECT * FROM `order_items` ot INNER JOIN item_master i ON ot.ord_itemId = i.item_id WHERE ot.ord_id = '$orderId'");    
    if (mysqli_num_rows($fetchCart) > 0) {
    foreach ($fetchCart as $Cart) {


?>
    <tr>
        <td class="rowCount">  </td>
        <td><?php echo $Cart['item_code']; ?></td>
        <!--<td> <img class="" src="../IMAGES/<?php echo $Cart['item_image'] ?>" alt="">  </td> -->
        <td><input type="number" id="<?php echo $Cart['main_id']; ?>" class="form-control numberInput change_btn text-center px-1 m-0" value="<?php echo $Cart['ord_itemQty'];?>"></td>
        <td> <?php echo number_format($Cart['item_weight']);?> GM</td>
        <td><input type="text" id="<?php echo $Cart['main_id']; ?>" class="form-control change_desc text-center m-0" value="<?php echo $Cart['ord_itemDesc'];?>"></td>
        <td><button class="btn px-2 py-1 delete_btn btn_delete shadow-none ms-3" type="button" value="<?php echo $Cart['main_id'];?>" > <i class="ri-delete-bin-4-line"></i> </button></td>
    </tr>
        <?php

        }
?>

        </tbody>

        </table>

        </div>
            <?php
                $fetchTotals = mysqli_query($con, "SELECT SUM(ot.ord_itemQty) AS totalQty,SUM(ot.ord_itemQty * i.item_weight) AS totalWgt FROM `order_items` ot INNER JOIN item_master i ON ot.ord_itemId = i.item_id WHERE ot.ord_id = '$orderId';");    
                foreach ($fetchTotals as $Totals) {

                }
            ?>

        <div class="d-flex justify-content-between mt-2">
            <h5 class="text-end">Total Qty : <span>(<?php if($Totals['totalQty'] > 0){echo $Totals['totalQty'];} else{ echo '0'; }  ?>)</span></h5>
            <h5 class="text-end">Total Wgt: <span>(<?php if($Totals['totalWgt'] > 0){echo number_format($Totals['totalWgt']) ;} else{ echo '0';} ?> gm)</span></h5>
        </div>



<?php
    } 
    else {
        ?>

            <tr>
                <td class="text-center" colspan="7"> <strong>Please add some products</strong> </td>
            </tr>

        <?php
    }



?>
    <?php
}

?>


