
<?php

include '../MAIN/Dbconfig.php';

if(isset($_COOKIE['custtypecookie']) && isset($_COOKIE['custidcookie'])){

    if($_COOKIE['custtypecookie'] == 'SuperAdmin' || $_COOKIE['custtypecookie'] == 'Admin'){

        $printvalue = $_GET['printValue'];
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
        <div class="container px-4 main-content">
            <div class="toolbar">
                <div class="card card-body p-2 px-3 text-white text-center">
                    <strong>
                        <?php 
                            $find_product = mysqli_query($con, "SELECT item_name,item_id FROM item_master WHERE item_code = '$printvalue'");
                            foreach($find_product as $product){
                                echo $product['item_name'];
                                $itemId = $product['item_id'];
                            }
                        ?>
                    </strong>
                </div>
            </div>

            <div class="row p-0 py-1 mb-4" id="printManfacture">

                <?php

                $findItems = mysqli_query($con, "SELECT ot.ord_itemId,i.item_code,i.item_name,i.item_weight,i.item_image,g.goldsmith_name,c.category_name,SUM(ot.ord_itemQty) AS totalQty, SUM(ot.ord_itemQty * i.item_weight) AS totalWgt FROM order_items ot INNER JOIN item_master i ON ot.ord_itemId = i.item_id INNER JOIN goldsmith_master g ON i.item_manufacturer = g.goldsmith_id INNER JOIN category_master c ON c.category_id = i.item_category WHERE i.item_code = '$printvalue'");
                
                while($findResults = mysqli_fetch_array($findItems)){
                    
                ?>
                
                    <div class="row">
                        <div class="col-6">
                            <div class="card card-body mt-3 img_card">
                                <div class="img_container">
                                    <img class="img-fluid mx-auto d-block" src="../IMAGES/<?php echo $findResults['item_image']; ?>" alt="">
                                </div>
                            </div>
                        </div>

                        <div class="col-6">
                            
                            <div class="mt-3">
                                    <div class="row mt-3">
                                        <div class="col-6">
                                            <h3> Product Name :</h3>
                                        </div>
                                        <div class="col-6">
                                            <h3> <?php echo $findResults['item_name']; ?></h3>
                                        </div>
                                    </div>

                                    <div class="row mt-3">
                                        <div class="col-6">
                                            <h3> Product Code :</h3>
                                        </div>
                                        <div class="col-6">
                                            <h3> <?php echo $findResults['item_code']; ?></h3>
                                        </div>
                                    </div>

                                    <div class="row mt-3">
                                        <div class="col-6">
                                            <h3> Manufacturer :</h3>
                                        </div>
                                        <div class="col-6">
                                            <h3> <?php echo $findResults['goldsmith_name']; ?></h3>
                                        </div>
                                    </div>

                                    <div class="row mt-3">
                                        <div class="col-6">
                                            <h3> Product  Category:</h3>
                                        </div>
                                        <div class="col-6">
                                            <h3> <?php echo $findResults['category_name']; ?></h3>
                                        </div>
                                    </div>

                                    <div class="row mt-3">
                                        <div class="col-6">
                                            <h3> Per Piece Weight:</h3>
                                        </div>
                                        <div class="col-6">
                                            <h3> <?php echo $findResults['item_weight']; ?>GM</h3>
                                        </div>
                                    </div>

                                    <div class="row mt-3">
                                        <div class="col-6">
                                            <h3> Total Quantity:</h3>
                                        </div>
                                        <div class="col-6">
                                            <h3> <?php echo $findResults['totalQty']; ?> Nos</h3>
                                        </div>
                                    </div>

                                    <div class="row mt-3">
                                        <div class="col-6">
                                            <h3> Total Weight:</h3>
                                        </div>
                                        <div class="col-6">
                                            <h3> <?php echo $findResults['totalWgt']; ?> GM</h3>
                                        </div>
                                    </div>


                            </div>

                        </div>

                    </div>
                    

                <?php
                }
                ?>
                
                

               

               
            </div>

            <div class="card card-body p-0">
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





    </div>


    <script>

        
        $(document).ready(function() {
            window.print();
        });

        
    </script>



</body>

</html>