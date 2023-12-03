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


if(isset($_POST['ManufacturerId'])){

    $ManufacturerId = $_POST['ManufacturerId'];
    $orderId = $_POST['OrderId'];


        $order_details = mysqli_query($con, "SELECT i.item_id,i.item_code,oi.ord_itemQty FROM order_items oi INNER JOIN item_master i ON oi.ord_itemId = i.item_id  INNER JOIN goldsmith_master g ON i.item_manufacturer = g.goldsmith_id WHERE oi.ord_id = '$orderId' AND g.goldsmith_id = '$ManufacturerId'");
        foreach($order_details as $ord_details){
    ?>
        <tr>
            <td class=""> <input type="checkbox" class="form-check-input" name="itemCheckbox[]" id="" value="<?php echo $ord_details['item_id']; ?> ">  </td>
            <td class="rowCount"></td>
            <td> <?php echo $ord_details['item_code']; ?> </td>
            <td> <?php echo $ord_details['ord_itemQty']; ?> </td>
            
        </tr>
    <?php
        }
    ?>
                        
<?php
       
}

?>