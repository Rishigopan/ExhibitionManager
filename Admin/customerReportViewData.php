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


if(isset($_POST['ordId'])){

    $ordId = $_POST['ordId'];


    $find_custDetails = mysqli_query($con, "SELECT order_id,customer_name,phone_number,contact_person,location,branch FROM order_table WHERE order_id = '$ordId'");
    while($Details = mysqli_fetch_array($find_custDetails)){
        $order_id = $Details['order_id'];
        ?>
        <div class="row">
            <div class="col-lg-3 d-flex justify-content-center my-auto">
                <div class="">
                    <div class="d-flex pb-2">
                        <dt class="me-3">Name :</dt>
                        <dd> <?php echo $Details['customer_name']; ?> </dd>
                    </div>
                    <div class="d-flex pb-2">
                        <dt class="me-3">Phone :</dt>
                        <dd> <?php echo $Details['phone_number']; ?> </dd>
                    </div>
                    <div class="d-flex pb-2">
                        <dt class="me-3">Location :</dt>
                        <dd> <?php echo $Details['location']; ?> </dd>
                    </div>
                    <div class="d-flex pb-2">
                        <dt class="me-3">Branch :</dt>
                        <dd> <?php echo $Details['branch']; ?> </dd>
                    </div>
                    <div class="d-flex ">
                        <dt class="me-3">Contact Person :</dt>
                        <dd> <?php echo $Details['contact_person']; ?> </dd>
                    </div>
                </div>
            </div>

            <div class="col-lg-9">
                <div class="table-responsive mt-lg-0 mt-3" id="table_container">
                    <table class="table table-striped" id="viewDetailTable">
                        <thead class="">
                            <tr>
                                <th>Sl.No</th>
                                <th>Code</th>
                                <th>Quantity</th>
                                <th>Description</th>
                                <th>Manufacturer</th>
                                <th>Print</th>
                            </tr>
                        </thead>
                        <tbody class="text-center">
                            <?php
                                $order_details = mysqli_query($con, "SELECT i.item_code,oi.ord_itemQty,oi.ord_itemDesc,g.goldsmith_name,g.goldsmith_id FROM order_items oi INNER JOIN item_master i ON oi.ord_itemId = i.item_id  INNER JOIN goldsmith_master g ON i.item_manufacturer = g.goldsmith_id WHERE oi.ord_id = '$ordId'");
                                foreach($order_details as $ord_details){
                            ?>
                                <tr>
                                    <td class="rowCount"></td>
                                    <td> <?php echo $ord_details['item_code']; ?> </td>
                                    <td> <?php echo $ord_details['ord_itemQty']; ?> </td>
                                    <td> <?php echo $ord_details['ord_itemDesc']; ?> </td>
                                    <td> <?php echo $ord_details['goldsmith_name']; ?> </td>
                                    <td><a style="text-decoration:none" class="print_btn btn" type="button" target="_blank" href= "customerReportManufacturerPrint.php?orderId=<?php echo $order_id;?>&manufacturerId=<?php echo $ord_details['goldsmith_id'];?>"><i class="material-icons">print</i></a></td>
                                 
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
}

?>