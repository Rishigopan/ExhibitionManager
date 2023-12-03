<?php

include '../MAIN/Dbconfig.php';

if(isset($_COOKIE['custtypecookie']) && isset($_COOKIE['custidcookie'])){

    if($_COOKIE['custtypecookie'] == 'SuperAdmin' || $_COOKIE['custtypecookie'] == 'Admin'){

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
                            <a href="./Dashboard.php">
                                <i class="material-icons">home</i>
                                <span>Dashboard</span>
                            </a>
                        </li>
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
                            <a href="./view_items.php">
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
                        <li class=" <?php if($_COOKIE['custtypecookie'] == 'SuperAdmin'){} else{ echo "d-none" ;} ?>">
                            <a href="./user_master.php">
                                <i class="material-icons">home</i>
                                <span>User</span>
                            </a>
                        </li>
                        <li class=" <?php if($_COOKIE['custtypecookie'] == 'SuperAdmin' || $_COOKIE['custtypecookie'] == 'Admin'){} else{ echo "d-none" ;} ?>">
                            <a href="./itemWiseReport.php">
                                <i class="material-icons">home</i>
                                <span>Product Wise Report</span>
                            </a>
                        </li>
                        <li class=" <?php if($_COOKIE['custtypecookie'] == 'SuperAdmin' || $_COOKIE['custtypecookie'] == 'Admin'){} else{ echo "d-none" ;} ?>">
                            <a href="./manufacturerWiseReport.php"  class="active">
                                <i class="material-icons">home</i>
                                <span>Manufacturer Wise Report</span>
                            </a>
                        </li>
                        <li class=" <?php if($_COOKIE['custtypecookie'] == 'SuperAdmin' || $_COOKIE['custtypecookie'] == 'Admin' || $_COOKIE['custtypecookie'] == 'Executive'){} else{ echo "d-none" ;} ?>">
                            <a href="./customerWiseReport.php">
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
                <div class="card card-body p-2 px-3 text-white">
                    <div class="row">
                        <div class="col-7 col-md-6">
                            <div class="col-12 col-md-6">
                                <label for="Search" class="d-flex">
                                    <span class="mt-2">Search</span>
                                    <input type="text" class="form-control ms-2 shadow-none" id="searchbox">
                                </label>
                            </div>
                        </div>
                        <div class="col-5 col-md-6 text-end">
                            <h5 class="mt-2"><strong>Manufacturer Wise Report</strong></h5>
                        </div>
                    </div>
                    
                </div>
            </div>

            <div class="card card-body mt-2 table-card p-0 py-1">

                <form action="" id="frm">
                    <div class="table-responsive">
                        <table class="table table-striped display" id="manufacturerWiseReport" style="width:100% ;">
                            <thead  >
                                <tr>
                                    <th class="text-center">Sl.No</th>
                                    <th class="text-center">Manufacturer Name</th>
                                    <th class="text-center">Product Count</th>
                                    <th class="text-center">Total Quantity</th>
                                    <th class="text-center">Total Weight</th>
                                    <th class="text-center">Details</th>
                                </tr>
                            </thead>
                            <tbody class="text-center">


                            </tbody>
                        </table>
                    </div>
                </form>
            </div>


        </div>





    </div>


    <a href="#" id="back-to-top" class="back-to-top d-flex align-items-center justify-content-center "> <i class="ri-arrow-up-line"></i>  </a>



    <script>
        
        $(document).ready(function() {

            var itemTable = $('#manufacturerWiseReport').DataTable({
                "processing": true,
                "ajax": "manufacturerWiseReportData.php",
                //"responsive": true,
                //"fixedHeader": true,
                "dom": '<"top"pl>rt<"bottom"ip>',
                //"select":true,

                "columns": [
                    { "data": null,"sortable": true, 
                        render: function (data, type, row, meta) {
                            return meta.row + meta.settings._iDisplayStart + 1;
                        }  
                    },
                    {
                        data: 'goldsmith_name',
                    },
                    {
                        data: 'totalPieces'
                    },
                    {
                        data: 'totalQty'
                    },
                    {
                        data: 'totalWgt'
                    },
                    {
                        data: "goldsmith_id",
                        render:function(data, type, row, meta){
                            return '<a style="text-decoration:none" target="_blank" href="manufacturerPrint.php?ManufacturerId=' + data  +'">View Detailed</a>'
                        }
                    }
                    
                ]


            });

            $('#searchbox').keyup(function() {
                itemTable.search($(this).val()).draw();
            });


           
        });


    </script>


</body>

</html>