<?php

include '../MAIN/Dbconfig.php';

if(isset($_COOKIE['custtypecookie']) && isset($_COOKIE['custidcookie'])){

    if($_COOKIE['custtypecookie'] == 'SuperAdmin' || $_COOKIE['custtypecookie'] == 'Admin'){

        $ManufacturerId = $_GET['ManufacturerId'];
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
        
        <!--NAVBAR-->
        <nav class="navbar fixed-top navbar-expand-lg bg-light p-1">
            <div class="container-fluid px-xl-5">
                <button class="btn btn-menu rounded-pill" type="button" data-bs-toggle="offcanvas" data-bs-target="#staticBackdrop"> <i class="material-icons">menu</i> <span class="d-md-inline-block d-none"> Menu </span></button>
                <a class="navbar-brand" href="#"> <strong>BETA</strong> </a>
                <button class="btn btn-menu  rounded-pill"> <span class="d-md-inline-block d-none"> <?php echo $_COOKIE['custnamecookie']; ?> </span> <i class="material-icons">account_circle</i> </button>

            </div>
        </nav>


        <div class="offcanvas offcanvas-start" tabindex="-8" id="staticBackdrop" aria-labelledby="staticBackdropLabel">

            <div class="offcanvas-body">
                <div class="text-center" id="Menu_heading">
                    <h5>BETA</h5>
                </div>

                <div id="Customer" class="text-center">
                    <img src="../User.png" alt="">
                    <h4><?php echo $_COOKIE['custnamecookie']; ?></h4>
                </div>

                <div id="Menu_options">
                    <ul class="list-unstyled">
                        <li class=" <?php if($_COOKIE['custtypecookie'] == 'SuperAdmin' || $_COOKIE['custtypecookie'] == 'Admin'){} else{ echo "d-none" ;} ?>" >
                            <a href="./item_master.php">
                                <i class="material-icons">home</i>
                                <span>Product</span>
                            </a>
                        </li>
                        <li class=" <?php if($_COOKIE['custtypecookie'] == 'SuperAdmin' || $_COOKIE['custtypecookie'] == 'Admin'){} else{ echo "d-none" ;} ?> ">
                            <a href="./category_master.php">
                                <i class="material-icons">home</i>
                                <span>Category</span>
                            </a>
                        </li>
                        <li class=" <?php if($_COOKIE['custtypecookie'] == 'SuperAdmin' || $_COOKIE['custtypecookie'] == 'Admin'){} else{ echo "d-none" ;} ?>">
                            <a href="./manufacturer_master.php">
                                <i class="material-icons">home</i>
                                <span>Manufacturer</span>
                            </a>
                        </li>
                        <li class=" <?php if($_COOKIE['custtypecookie'] == 'SuperAdmin' || $_COOKIE['custtypecookie'] == 'Admin'){} else{ echo "d-none" ;} ?>">
                            <a href="./view_items.php" class="active">
                                <i class="material-icons">home</i>
                                <span>Product List</span>
                            </a>
                        </li>
                        <li class=" <?php if($_COOKIE['custtypecookie'] == 'SuperAdmin' || $_COOKIE['custtypecookie'] == 'Admin' || $_COOKIE['custtypecookie'] == 'Executive'){} else{ echo "d-none" ;} ?>">
                            <a href="./orderForm.php">
                                <i class="material-icons">home</i>
                                <span>Order Form</span>
                            </a>
                        </li>
                        <li class=" <?php if($_COOKIE['custtypecookie'] == 'SuperAdmin' || $_COOKIE['custtypecookie'] == 'Admin' || $_COOKIE['custtypecookie'] == 'Executive'){} else{ echo "d-none" ;} ?>">
                            <a href="./customerWiseReport.php" class="active">
                                <i class="material-icons">home</i>
                                <span>Customer Wise Report</span>
                            </a>
                        </li>
                        <li>
                            <a href="../signout.php">
                                <i class="material-icons">home</i>
                                <span>Signout</span>
                            </a>
                        </li>

                    </ul>
                </div>
            </div>
        </div>

       

        <!--CONTENTS-->
        <div class="container-fluid px-4 main-content">
            <div class="toolbar">
                <div class="card card-body p-2 px-3 text-white text-center">
                    <strong>
                        <?php 
                            $find_manufacturer = mysqli_query($con, "SELECT goldsmith_name FROM goldsmith_master WHERE goldsmith_id = '$ManufacturerId'");
                            foreach($find_manufacturer as $manufacturer){
                                echo $manufacturer['goldsmith_name'];
                            }
                        ?>
                    </strong>
                </div>
            </div>

            <div class="row p-0 py-1 mb-4" id="printManfacture">

                <?php

                $findItems = mysqli_query($con, "SELECT i.item_id,i.item_code,i.item_weight,i.item_image,SUM(ot.ord_itemQty) AS totalQty FROM `order_items` ot INNER JOIN item_master i ON ot.ord_itemId = i.item_id INNER JOIN goldsmith_master g ON g.goldsmith_id = i.item_manufacturer WHERE g.goldsmith_id = '$ManufacturerId' GROUP BY ot.ord_itemId;");
                while($findResults = mysqli_fetch_array($findItems)){
                    $itemId = $findResults['item_id'];
                ?>
                <div class="col-xl-3 col-md-6 mt-3">
                    <div class="card gold_view">
                        <div class="card-header text-center">
                        <?php echo $findResults['item_code']; ?>
                        </div>
                        <div class="card-body p-0">
                            <img src="../IMAGES/<?php echo $findResults['item_image']; ?>" class="img-fluid mx-auto d-block" alt="">
                        </div>
                        <div class="card-footer ">
                            <div class="d-flex justify-content-between"> 
                                <h5>Total Qty : <?php echo $findResults['totalQty']; ?> Nos</h5>
                                <h5>Weight : <?php echo $findResults['item_weight']; ?> GM</h5>
                            </div>
                            <div>
                                <p class="m-0">[
                                    <?php  
                                        $find_description = mysqli_query($con, "SELECT ord_itemQty,ord_itemDesc FROM order_items WHERE ord_itemId = '$itemId'");
                                        foreach($find_description as $descResults){
                                            $itemDesc = $descResults['ord_itemDesc'];
                                            if($itemDesc == ''){
                                                echo "&nbsp;";
                                            }
                                            else{
                                                echo $descFull = $descResults['ord_itemDesc'].'(x '.$descResults['ord_itemQty'].'),';
                                            }
                                            
                                        }  
                                    ?>]
                                </p>
                            </div>
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