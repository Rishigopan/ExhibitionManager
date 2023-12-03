<?php 

include '../MAIN/Dbconfig.php';

?>

<!doctype html>
<html lang="en">

<head>




    <?php


    include '../MAIN/Header.php';

    ?>


</head>

<body>

    <div class="wrapper container px-4">
        
        <div class="row">

        
    
            <?php





                if(isset($_POST['itemCheckbox'])){

                    $manufactureFormId = $_POST['manufactureFormId'];
                    $orderFormID = $_POST['orderFormId'];

                    $itemCheckbox = $_POST['itemCheckbox'];
?>

<?php 
                    $find_orderDetails = mysqli_query($con, "SELECT * FROM order_table WHERE order_id = '$orderFormID'");
                        foreach($find_orderDetails as $orderDetails){
                        }
                    ?>

                    <div class="container">
                        <div class="card mt-3">
                            <div class="card-header" style="background-color: #fe8000;color:white"><h4 class="text-center">Order-manufacturer Details</h4></div>
                            <div  class="card-body ">
                                <div class="row gx-5">
                                    <div class="col-6">
                                        <h5 class="text-end">Customer Name :</h5>
                                    </div>
                                    <div class="col-6">
                                        <h5 class="text-start"> <?php echo $orderDetails['customer_name']; ?> </h5>
                                    </div>
                                </div>
                                <div class="row gx-5">
                                    <div class="col-6">
                                        <h5 class="text-end">Customer Phone :</h5>
                                    </div>
                                    <div class="col-6">
                                        <h5 class="text-start"> <?php echo $orderDetails['phone_number']; ?> </h5>
                                    </div>
                                </div>
                                <div class="row gx-5">
                                    <div class="col-6">
                                        <h5 class="text-end">Contact Person :</h5>
                                    </div>
                                    <div class="col-6">
                                        <h5 class="text-start"> <?php echo $orderDetails['contact_person']; ?> </h5>
                                    </div>
                                </div>
                                <div class="row gx-5">
                                    <div class="col-6">
                                        <h5 class="text-end">Location :</h5>
                                    </div>
                                    <div class="col-6">
                                        <h5 class="text-start"> <?php echo $orderDetails['location']; ?> </h5>
                                    </div>
                                </div>
                                <div class="row gx-5">
                                    <div class="col-6">
                                        <h5 class="text-end">Branch :</h5>
                                    </div>
                                    <div class="col-6">
                                        <h5 class="text-start"> <?php echo $orderDetails['branch']; ?> </h5>
                                    </div>
                                </div>

                                <div class="row gx-5">
                                    <div class="col-6">
                                        <h5 class="text-end">Manufacturer :</h5>
                                    </div>
                                    <div class="col-6">
                                        <h5 class="text-start"> 
                                            <?php 
                                                $find_manufacturer = mysqli_query($con, "SELECT goldsmith_name FROM goldsmith_master WHERE goldsmith_id = '$manufactureFormId'");
                                                foreach($find_manufacturer as $manufacturer){
                                                    echo $manufacturer['goldsmith_name'];
                                                }
                                            ?>
                                        </h5>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>

<?php

                    foreach($itemCheckbox as $items){
                        $fetchItemDetails = mysqli_query($con, "SELECT * FROM order_items oi INNER JOIN item_master i ON oi.ord_itemId = i.item_id INNER JOIN goldsmith_master g ON i.item_manufacturer = g.goldsmith_id WHERE oi.ord_id = '$orderFormID' AND g.goldsmith_id = '$manufactureFormId' AND oi.ord_itemId = '$items'");
                        foreach($fetchItemDetails as $ItemDetails){
                        
                        ?>
                            <div class="col-xl-3 mt-2 col-md-6">
                                <div class="card gold_view">
                                    <div class="card-header text-center">
                                    <?php echo $ItemDetails['item_code']; ?>
                                    </div>
                                    <div class="card-body p-0">
                                        <img src="../IMAGES/<?php echo $ItemDetails['item_image']; ?>" class="img-fluid mx-auto d-block" alt="">
                                    </div>
                                    <div class="card-footer ">
                                        <div class="d-flex justify-content-between"> 
                                            <h5>Qty : <?php echo $ItemDetails['ord_itemQty']; ?> Nos</h5>
                                            <h5>Wgt : <?php echo number_format($ItemDetails['item_weight']); ?> GM</h5>
                                        </div>
                                        <h6 class="text-center">Description : <?php echo $ItemDetails['ord_itemDesc']; ?></h6>
                                    </div>
                                </div>
                            </div>


                        <?php

                        }
                        
                        

                    }
                }




            ?>



        </div>

    </div>

</body>


</html>