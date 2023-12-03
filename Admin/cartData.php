<?php


require "../MAIN/Dbconfig.php";


$biller_id = $_COOKIE['custidcookie'];

$biller_name = $_COOKIE['custnamecookie'];

$cartTable = $biller_id.'_'.$biller_name ;

//Display cart items
if (isset($_POST["cart"])) {

?>

    <div class="d-flex justify-content-between mb-2">
        <h4 class="m-0 pb-2 my-auto">Order Cart</h4>
        <button class="btn py-0 shadow-none btn-danger clearAllBtn" type="button">Clear all</button>
    </div>

    <div class="table-responsive">

    

    <table class="table-striped table table_items">
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
    $fetchCart = mysqli_query($con, "SELECT *, (SELECT SUM(o.item_qty) FROM $cartTable o INNER JOIN item_master i ON o.item_id = i.item_id) AS itemCount,(SELECT SUM(o.item_qty * i.item_weight) FROM $cartTable o INNER JOIN item_master i ON o.item_id = i.item_id) AS totalWeight FROM $cartTable o INNER JOIN item_master i ON o.item_id = i.item_id GROUP BY o.id;");

    
    if (mysqli_num_rows($fetchCart) > 0) {
    foreach ($fetchCart as $Cart) {


?>
    <tr>
        <td><?php echo $Cart['id'];?></td>
        <td><?php echo $Cart['item_code']; ?></td>
       <!-- <td> <img class="" src="../IMAGES/<?php echo $Cart['item_image'] ?>" alt="">  </td> -->
        <td><input type="number" id="<?php echo $Cart['id']; ?>" class="form-control numberInput change_btn text-center px-1 m-0" value="<?php echo $Cart['item_qty'];?>"></td>
        <td> <?php echo number_format($Cart['item_weight']);?> GM</td>
        <td><input type="text" id="<?php echo $Cart['id']; ?>" class="form-control change_desc text-center m-0" value="<?php echo $Cart['item_desc'];?>"></td>
        <td><button class="btn px-2 py-1 delete_btn btn_delete shadow-none ms-3" type="button" value="<?php echo $Cart['id'];?>" > <i class="ri-delete-bin-4-line"></i> </button></td>
    </tr>
        <?php

        }
?>

        </tbody>

        </table>

        </div>


        <div class="d-flex justify-content-between mt-2">
            <h5 class="text-end">Total Qty : <span>(<?php if($Cart['itemCount'] > 0){echo $Cart['itemCount'];} else{ echo '0'; }  ?>)</span></h5>
            <h5 class="text-end">Total Wgt: <span>(<?php echo number_format($Cart['totalWeight']);?> gm)</span></h5>
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


