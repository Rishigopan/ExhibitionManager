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

        <!-- Modal -->
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
                        <div class="col-5 col-md-6">
                            <div class=" text-end">
                                <a href="javascript:void(0)" class="btn_printall btn-success btn" onclick="delete_all();">Bulk Print</a>
                            </div>
                        </div>
                    </div>
                    
                </div>
            </div>

            <div class="card card-body mt-2 table-card p-0 py-1">

                <form action="" id="frm">
                    <div class="table-responsive">
                        <table class="table table-striped display" id="product_table" style="width:100% ;">
                            <thead class="text-center">
                                <tr>
                                    <th></th>
                                    <th>Sl.No</th>
                                    <th>Image</th>
                                    <th>Product Name</th>
                                    <th>Product Code</th>
                                    <th>Manufacturer</th>
                                    <th>Category</th>
                                    <th>Venue</th>
                                    <th>Weight</th>
                                    <th>Print</th>
                                    <th>Edit</th>
                                    <th>Delete</th>
                                </tr>
                            </thead>
                            <tbody class="">


                            </tbody>
                        </table>
                    </div>
                </form>
            </div>


        </div>





    </div>


    <a href="#" id="back-to-top" class="back-to-top d-flex align-items-center justify-content-center "> <i class="ri-arrow-up-line"></i>  </a>



    <script src="https://cdn.jsdelivr.net/npm/@emretulek/jbvalidator"></script>

    <script src="../JS/masters.js"></script>

    <script>
        function delete_all() {
            var check = confirm("Are you sure?");
            if (check == true) {
                var dta = $('#frm').serialize();
                console.log(dta);
                jQuery.ajax({
                    url: 'bulkprint.php',
                    type: 'POST',
                    data: dta,
                    success: function(result) {
                        console.log(result);
                        $('#frm')[0].reset();
                        toastr.warning(result);
                        var bulkPrint = window.open("");
                        bulkPrint.document.write(result);
                        bulkPrint.window.stop();
                        bulkPrint.window.print();
                        bulkPrint.window.close();

                        /*
                        jQuery('input[type=checkbox]').each(function(){
                            if(jQuery('#'+this.id).prop("checked")){
                                jQuery('#box'+this.id).remove();
                            }
                        });
                        */
                    }
                });
            }
        }

        
        $(document).ready(function() {

           

            var itemTable = $('#product_table').DataTable({
                "processing": true,
                
                "ajax": "viewItemsData.php",
                //"responsive": true,
                //"fixedHeader": true,
                "dom": '<"top"pl>rt<"bottom"ip>',
                //"select":true,

                "columns": [{
                        data: 'item_id',
                        "render": function(data, type, row, meta) {
                            if (type == 'display') {
                                data = '<input type="checkbox" class="form-check-input" name="checkbox[]" value= "' + data + '"></input>';
                            }
                            return data;
                        }
                    },
                    {
                        data: 'item_id'
                    },
                    {
                        data: 'item_image',
                        "render": function(data, type, row, meta) {
                            if (type == 'display') {
                                data = '<img src="../IMAGES/' + data + '" class=" img-fluid img_jewel">';
                            }
                            return data;
                        }
                    },
                    {
                        data: 'item_name'
                    },
                    {
                        data: 'item_code'
                    },
                    {
                        data: 'goldsmith_name'
                    },
                    {
                        data: 'category_name'
                    },
                    {
                        data: 'item_venue'
                    },
                    {
                        data: 'item_weight'
                    },
                    {
                        data: 'item_id',
                        "render": function(data, type, row, meta) {
                            if (type == 'display') {
                                data = '<button class="print_btn  btn shadow-none" type="button" value="' + data + '"> <i class="material-icons">print</i> </button>';
                            }
                            return data;
                        }
                    },
                    {
                        data: 'item_id',
                        "render": function(data, type, row, meta) {
                            if (type == 'display') {
                                data = '<a class="edit_btn btn" target="_blank" href="update_items.php?update_id=' + data + '" ><i class="material-icons">edit</i></a>';
                            }
                            return data;
                        }
                    },
                    {
                        data: 'item_id',
                        "render": function(data, type, row, meta) {
                            if (type == 'display') {
                                data = '<button class="del_btn btn shadow-none " type="button" value="' + data + '"> <i class="material-icons">delete_outline</i> </button>';
                            }
                            return data;
                        }
                    },



                ]


            });

            $('#searchbox').keyup(function() {
                itemTable.search($(this).val()).draw();
            });



            //print item
            $('#product_table tbody').on('click', '.print_btn', function() {
                var printValue = $(this).val();
                console.log(printValue);
                $.ajax({
                    type: "POST",
                    url: "print.php",
                    data: {
                        printValue: printValue
                    },
                    beforeSend: function() {
                        //$('#delModal').modal('hide');
                    },
                    success: function(data) {
                        //console.log(data);
                        var printResponse = JSON.parse(data);
                        console.log(printResponse.value);
                        if(printResponse.status == 1){
                            var printingWindow = window.open("");
                            printingWindow.document.write(printResponse.value);
                            printingWindow.stop();
                            printingWindow.print();
                            printingWindow.close();
                        }
                        else{
                            toastr.error("some error occured");
                        }
                    }
                        
                });
            });

 
            //delete item
            $('#product_table tbody').on('click', '.del_btn', function() {
                var delValue = $(this).val();
                console.log(delValue);
                $('#delModal').modal('show');
                $('#confirmYes').click(function() {
                    $.ajax({
                        type: "POST",
                        url: "master_operations.php",
                        data: {
                            delValue: delValue
                        },
                        beforeSend: function() {
                            $('#delModal').modal('hide');
                        },
                        success: function(data) {
                            console.log(data);
                            var delResponse = JSON.parse(data);
                            if (delResponse.delItem == 0) {
                                toastr.warning("Product is Already in Use");
                            } else if (delResponse.delItem == 1) {
                                toastr.success("Successfully Deleted");
                                $('#product_table').DataTable().ajax.reload();
                            } else {
                                toastr.error("Some Error Occured");
                            }

                            delValue = undefined;
                            delete window.delValue;
                        }
                    });
                });
                $('#confirmNo').click(function() {
                    delValue = undefined;
                    delete window.delValue;
                });
            });
        });


        toastr.options = {
            "debug": false,
            "newestOnTop": false,
            "progressBar": false,
            "positionClass": "toast-bottom-right",
            "preventDuplicates": true,
            "onclick": null,
            "showDuration": "300",
            "hideDuration": "1000",
            "timeOut": "3000",
            "extendedTimeOut": "1000",
            "showEasing": "swing",
            "hideEasing": "linear",
            "showMethod": "fadeIn",
            "hideMethod": "fadeOut"
        }
    </script>


</body>

</html>