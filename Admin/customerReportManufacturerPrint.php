<?php

include '../MAIN/Dbconfig.php';

if(isset($_COOKIE['custtypecookie']) && isset($_COOKIE['custidcookie'])){

    if($_COOKIE['custtypecookie'] == 'SuperAdmin' || $_COOKIE['custtypecookie'] == 'Admin'){

        $manufacturerId = $_GET['manufacturerId'];
        $orderId = $_GET['orderId'];
    }
    else{
        header("location:../login.php");
    }
    
}
else{

header("location:../login.php");

}

?>

<!doctype html>
<html lang="en">

<head>




    <?php


    include '../MAIN/Header.php';

    ?>



</head>

<body>

    <div class="wrapper">
        
       
       

        <!--CONTENTS-->
        <div class="container-fluid px-4 main-content">
            <div class="toolbar">
                <div class="card card-body p-2 px-3 text-white text-center">
                    <?php 
                        $find_orderDetails = mysqli_query($con, "SELECT order_id,customer_name,phone_number,contact_person,location,branch FROM order_table WHERE order_id = '$orderId'");
                        foreach($find_orderDetails as $orderDetails){
                        }
                    ?>
                    <h3>
                        <strong>
                            ORDER ID : #<?php echo $orderDetails['order_id']; ?>
                        </strong>
                    
                    </h3>
                </div>
            </div>

            <div class="container">
                <div class="card mt-3">
                    <div class="card-header"><h4 class="text-center">Customer Details</h4></div>
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
                                        $find_manufacturer = mysqli_query($con, "SELECT goldsmith_name FROM goldsmith_master WHERE goldsmith_id = '$manufacturerId'");
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

            <div class="row p-0 py-1 mb-4 mt-3" id="printManfacture">

                <?php 

                    $displayImages = mysqli_query($con, "SELECT i.item_code,i.item_image,oi.ord_itemQty,oi.ord_itemDesc,i.item_weight FROM order_items oi INNER JOIN item_master i ON oi.ord_itemId = i.item_id  INNER JOIN goldsmith_master g ON i.item_manufacturer = g.goldsmith_id WHERE oi.ord_id = '$orderId' AND g.goldsmith_id = '$manufacturerId'");
                    while($displayAll = mysqli_fetch_array($displayImages)){
                ?>
                    <div class="col-xl-3 mt-2 col-md-6">
                        <div class="card gold_view">
                            <div class="card-header text-center">
                            <?php echo $displayAll['item_code']; ?>
                            </div>
                            <div class="card-body p-0">
                                <img src="../IMAGES/<?php echo $displayAll['item_image']; ?>" class="img-fluid mx-auto d-block" alt="">
                            </div>
                            <div class="card-footer ">
                                <div class="d-flex justify-content-between"> 
                                    <h5>Qty : <?php echo $displayAll['ord_itemQty']; ?> Nos</h5>
                                    <h5>Wgt : <?php echo number_format($displayAll['item_weight']); ?> GM</h5>
                                </div>
                                <h6 class="text-center">Description : <?php echo $displayAll['ord_itemDesc']; ?></h6>
                            </div>
                        </div>
                    </div>

                <?php
                    }
                
                ?>

                
                

               

               
            </div>


        </div>





    </div>




</body>

</html>