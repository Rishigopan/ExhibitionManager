<?php

include '../MAIN/Dbconfig.php';

if(isset($_COOKIE['custtypecookie']) && isset($_COOKIE['custidcookie'])){

    if($_COOKIE['custtypecookie'] == 'SuperAdmin' || $_COOKIE['custtypecookie'] == 'Admin' || $_COOKIE['custtypecookie'] == 'Executive'){

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

        <!-- delete Modal -->
        <div class="modal fade" id="delModal" tabindex="-1" data-bs-backdrop="static" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Delete Confirmation</h5>
                        
                    </div>
                    <div class="modal-body">
                        <h4 class="text-center">Do you want to delete this item?</h4>

                        <div class="text-center mt-3">
                            <button type="button" id="confirmYes" class="btn btn-primary me-5">Yes</button>
                            <button type="button" id="confirmNo" class="btn btn-secondary ms-5" data-bs-dismiss="modal">No</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <!-- Modal -->
        <div class="modal modal-lg " id="ViewModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered ">
                <div class="modal-content ">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Order Detailed View</h5>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <ul class="nav nav-tabs" id="myTab" role="tablist">
                            <li class="nav-item me-4" role="presentation">
                                <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home-tab-pane" type="button" role="tab" aria-controls="home-tab-pane" aria-selected="true">Customer</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="profile-tab" value="" data-bs-toggle="tab" data-bs-target="#profile-tab-pane" type="button" role="tab" aria-controls="profile-tab-pane" aria-selected="false">Manufacturer</button>
                            </li>
                        </ul>
                        <div class="tab-content" id="myTabContent">

                            <div class="tab-pane fade show active" id="home-tab-pane" role="tabpanel" aria-labelledby="home-tab" tabindex="0">
                                <div id="DetailedView">
                    
                                </div>
                            </div>
                            <div class="tab-pane fade" id="profile-tab-pane" role="tabpanel" aria-labelledby="profile-tab" tabindex="0">
                                
                                <div id="ManufacturerDetailed" style="min-height: 350px;"> 
                                   
                                </div>
                            
                            </div>
                        </div>
                    
                    </div>
                </div>
            </div>
        </div>
        
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
                            <a href="./view_items.php" >
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
                            <a href="./manufacturerWiseReport.php">
                                <i class="material-icons">home</i>
                                <span>Manufacturer Wise Report</span>
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
                            <h5 class="mt-2"><strong>Customer Wise Report</strong></h5>
                        </div>
                    </div>
                    
                </div>
            </div>

            <div class="card card-body mt-2 table-card p-0 py-1">

                <form action="" id="frm">
                    <div class="table-responsive">
                        <table class="table table-striped display" id="itemWiseReport" style="width:100% ;">
                            <thead class="text-center">
                                <tr>
                                    <th class="text-center">Order Id</th>
                                    <th class="text-center">Customer Name</th>
                                    <th class="text-center">Phone Number</th>
                                    <th class="text-center">Contact Person</th>
                                    <th class="text-center">Location</th>
                                    <th class="text-center">Branch</th>
                                    <th class="text-center">Product Count</th>
                                    <th class="text-center">Total Qty</th>
                                    <th class="text-center">Total Wgt</th>
                                    <th class="text-center">Biller</th>
                                    <th class="text-center">Detailed</th>
                                    <th class="text-center">Edit</th>
                                    <th class="text-center">Delete</th>
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

            

            var itemTable = $('#itemWiseReport').DataTable({
                "processing": true,
                
                "ajax": "customerWiseReportData.php",
                //"responsive": true,
                //"fixedHeader": true,
                "dom": '<"top"pl>rt<"bottom"ip>',
                //"select":true,

                "columns": [
                    { 
                        data: 'order_id',
                        render: function(data,type,row,meta){
                            return '<a style="text-decoration:none" class="viewDetails"  id="' + data + '" href= "">' + data + '</a>'
                        }
                    },
                    {
                        data: 'customer_name',
                    },
                    {
                        data: 'phone_number'
                    },
                    {
                        data: 'contact_person'
                    },
                    {
                        data: 'location'
                    },
                    {
                        data: 'branch'
                    },
                    {
                        data: 'itemCount'
                    },
                    {
                        data : 'totalQty'
                    },
                    {
                        data : 'totalWgt'
                    },
                    {
                        data : 'Biller'
                    },
                    {
                        data: 'order_id',
                        render: function(data,type,row,meta){
                            return '<a style="text-decoration:none" target="_blank" href= "CustomerWiseReportPrint.php?order_id=' + data + '">View Detailed</a>'
                        }
                    },
                    {
                        data: 'order_id',
                        render: function(data,type,row,meta){
                            return '<a style="text-decoration:none" class="edit_btn btn" type="button" target="_blank" href= "OrderFormEdit.php?orderID=' + data + '"><i class="material-icons">edit</i></a>'
                        }
                    },
                    {
                        data: 'order_id',
                        "render": function(data, type, row, meta) {
                            if (type == 'display') {
                                data = '<button class="del_btn btn shadow-none " type="button" value="' + data + '"> <i class="material-icons">delete_outline</i> </button>';
                            }
                            return data;
                        }
                    }

                ]


            });

            $('#searchbox').keyup(function() {
                itemTable.search($(this).val()).draw();
            });



            //view order
            $('#itemWiseReport tbody').on('click', '.viewDetails', function(s) {
                s.preventDefault();
                var ordId = $(this).attr('id');
                console.log(ordId);
                $.ajax({
                    type: "POST",
                    url: "customerReportViewData.php",
                    data: {ordId: ordId},
                    beforeSend: function() {
                        //$('#delModal').modal('hide');
                        $('#ViewModal').modal('show');
                    },
                    success: function(data) {
                        //console.log(data);
                        const triggerFirstTabEl = document.querySelector('#myTab li:first-child button')
                        bootstrap.Tab.getInstance(triggerFirstTabEl).show() // Select first tab
                        $('#profile-tab').val(ordId);
                        $('#DetailedView').html(data);
                       
                    }
                        
                });
            });

            
            //view customer manufacturer detail view 
            $('#profile-tab').click(function(){
                var ManufacturerOrderId = $(this).val();
                console.log(ManufacturerOrderId);
                $.ajax({
                    type: "POST",
                    url: "customerReportViewManufacturerDetailsData.php",
                    data: {ManufacturerOrderId: ManufacturerOrderId},
                    beforeSend: function() {
                        //$('#ViewModal').modal('show');
                    },
                    success: function(data) {
                        //console.log(data);
                        $('#ManufacturerDetailed').html(data);
                       
                    }
                        
                });
            });


            //view manufacture items
            $('#ViewModal #ManufacturerDetailed').on('change', '#manufacturerSelect', function(s) {
                var ManufacturerId = $(this).val();
                var OrderId = $(this).data('value');
                console.log(OrderId);
                console.log(ManufacturerId);
                $.ajax({
                    type: "POST",
                    url: "CustomerReportViewManufactureWiseItems.php",
                    data: {ManufacturerId: ManufacturerId,OrderId: OrderId},
                    beforeSend: function() {
                        
                    },
                    success: function(data) {
                        //console.log(data);
                        $('#all_itemsForm')[0].reset();
                        $('#ViewModal #ManufacturerDetailed #ManufacturerFormId').val(ManufacturerId);
                        $('#ViewModal #ManufacturerDetailed #OrderFormId').val(OrderId);
                        $('#display_allitems').html(data);
                    }
                });
            });



            //delete order
            $('#itemWiseReport tbody').on('click', '.del_btn', function(s) {
                s.preventDefault();
                var delId = $(this).val();
                console.log(delId);
                $('#delModal').modal('show');
                $('#confirmYes').click(function() {
                    $.ajax({
                        type: "POST",
                        url: "orderEditOperations.php",
                        data: {delId: delId},
                        beforeSend: function() {
                            $('#delModal').modal('hide');
                        },
                        success: function(data) {
                            var response = JSON.parse(data);
                            if (response.delOrder == "0") {
                                toastr.error("Failed Deleting Order");
                            } else if (response.delOrder == "1") {
                                $('#itemWiseReport').DataTable().ajax.reload();
                                toastr.success("Successfully Deleted Order");
                            } else {
                                toastr.error("Some Error Occured");
                            }

                            delId = undefined;
                            delete window.delId;
                        }  
                    });
                });
                $('#confirmNo').click(function() {
                    delId = undefined;
                    delete window.delId;
                });
            });





            $('#ViewModal #ManufacturerDetailed').on('submit', '#all_itemsForm', function(e) {
              
                e.preventDefault();
                var ItemData = $(this).serialize();
                console.log(ItemData);
                $.ajax({
                    url: "customerReportViewSingleManufactureWise.php",
                    type: "POST",
                    data: ItemData,
                    beforeSend: function() {
                        
                    },
                    success: function(data) {
                        //console.log(data);
                        var PrintItems = window.open("");
                       
                        PrintItems.document.write(data);
                        
                    }
                });
                
            });


          
        });


    </script>


</body>

</html>