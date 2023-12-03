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
    <style>
        
        .disable {
            opacity: 0.3;
            pointer-events: none;
        }
        
    </style>


</head>

<body>

    <div class="wrapper">
        <!-- Modal -->
        <div class="modal" id="itemModal"  role="dialog" tabindex="-1" aria-labelledby="exampleModalLabel" >
            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                <div class="modal-content">
                    <div class="modal-header text-white" style="background-color: #fe8a00;">
                        <h5 class="modal-title" id="exampleModalLabel">Add an Item</h5>
                        <button type="button" id="itemCloseBtn" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body bg-white">
                        <form action="" id="add_item">
                            <div class="product_details">
                                <div class="inputs">
                                    <label class="form-label" for="Barcode">Barcode</label>
                                    <input type="text" class="form-control" id="Barcode" placeholder="" name="barcode">
                                </div>

                                <div class="row">
                                    <div class="col-6">
                                        <div class="inputs">
                                            <label class="form-label" for="Product_Name">Product Name</label>
                                            <input type="text" class="form-control" id="Product_Name" placeholder="" name="product_Name" disabled>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="inputs">
                                            <label class="form-label" for="Product_Code">Product Code</label>
                                            <input type="text" class="form-control" id="Product_Code" placeholder="" name="product_Code">
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="inputs">
                                            <label class="form-label" for="Product_Manufacturer">Product Manufacturer</label>
                                            <input type="text" class="form-control" id="Product_Manufacturer" placeholder="" name="product_Manufacturer" disabled>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-6">
                                        <div class="inputs">
                                            <label class="form-label" for="Weight">Weight</label>
                                            <input type="number" class="form-control" id="Weight" placeholder="" name="weight" disabled>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="inputs">
                                            <label class="form-label" for="Quantity">Quantity</label>
                                            <input type="number" class="form-control" id="Quantity" placeholder="" value="1" name="quantity">
                                        </div>
                                    </div>
                                </div>
                                <div class="mt-4 text-center">
                                    <button type="submit" class="btn btn_submit px-3 py-2">Add item</button>
                                </div>
                            </div>
                        </form>

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
                            <a href="./category_master.php" >
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
                            <a href="./orderForm.php" class="active">
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




        <!--CONTENTS-->
        <div class="container-lg container-fluid  main-content">

            <h3 class="mt-3 title shadow-sm  py-2 text-center">Order Form</h3>

            <div class="card card-body main-card shadow-sm">
            <form action="" id="add_product" enctype="multipart/form-data" novalidate>
                <div class="row product_details">
                    <div class="col-md-6 product_details ">
                        <div class="inputs">
                            <label class="form-label" for="Customer_name">Customer Name</label>
                            <input type="text" class="form-control" id="Customer_name" tabindex="1" placeholder="" name="customer_name" data-v-max-length="20" data-v-message="Maximum 20 characters" required>
                        </div>

                        <div class="row">
                            <div class="col-md-6 col-6">
                                <div class="inputs">
                                    <label class="form-label" for="Phone">Phone Number</label>
                                    <input type="number" class="form-control" id="Phone" tabindex="2" placeholder="" name="phone"  data-v-max-length="20" data-v-message="Enter proper phone number" required>
                                </div>
                                <div class="inputs ">
                                    <label class="form-label" for="Location">Location</label>
                                    <input type="text" class="form-control" id="Location" tabindex="4" placeholder="" name="location" data-v-max-length="20" data-v-message="Maximum 20 characters">
                                </div>
                            </div>
                            <div class="col-md-6 col-6">
                                <div class="inputs">
                                    <label class="form-label" for="Contact_person">Contact Person</label>
                                    <input type="text" class="form-control" id="Contact_person" tabindex="3" placeholder="" name="contact_person" data-v-max-length="20" data-v-message="Maximum 20 characters">
                                </div>
                                <div class="inputs ">
                                    <label class="form-label" for="Branch">Branch</label>
                                    <input type="text" class="form-control" id="Branch" tabindex="5" placeholder="" name="branch" data-v-max-length="20" data-v-message="Maximum 20 characters">
                                </div>
                            </div>
                        </div>


                        <div class="text-center mt-3 " id="add_itemDiv">
                            <a class="btn btn_add" data-bs-toggle="modal" href="#itemModal" type="button"> <i class="ri-add-line"></i> <span>Add Product</span></a>
                        </div>

                        <div class=" submit_btn text-center mt-5">
                            <button class="btn shadow-none btn_submit">Take Order</button>
                        </div>
                    </div>
                    <div class="col-md-6 mt-5 mt-md-0 ">
                     
                        <div class="card card-body d-none" id="loadCard"> 

                            <div id="loader" class="mx-auto"></div>
                        
                        </div>

                        <div class="card card-body item_card" id="displayCart">
                        
                        </div>
                       
                    </div>

                    
                </div>
            </form>
            </div>


        </div>





    </div>



    <script src="https://cdn.jsdelivr.net/npm/@emretulek/jbvalidator"></script>


    <script src="../JS/cart.js"></script>

    

    <script>

        getcartData(); //get cart details

        $(document).ready(function() {  

            
            DelAll(); //delete all items on page start

            //delete all function
            function DelAll() {
                var delAll = '*';
                $.ajax({
                    type: "POST",
                    url: "orderOperations.php",
                    data: { delAll: delAll },
                    beforeSend: function() {
                        $('#displayCart').addClass("d-none");
                        $('#loadCard').removeClass("d-none");
                    },
                    success: function(data) {
                        console.log(data);
                        $('#displayCart').removeClass("d-none");
                        $('#loadCard').addClass("d-none");
                        var response = JSON.parse(data);
                        if (response.delAllStatus == "0") {
                            getcartData();
                            toastr.error("Failed Deleting All");
                        } else if (response.delAllStatus == "1") {
                            getcartData();
                            //toastr.success("Successfully Deleted All");
                        } else {
                            toastr.error("Some Error Occured");
                        }
                    }
                });
            }


            //focus input on modal shown
            const addItemModal = document.getElementById('itemModal');
            addItemModal.addEventListener('shown.bs.modal', event => {
                document.getElementById('Barcode').focus();
            });

            $('#itemCloseBtn').click(function(){
               $('#add_item')[0].reset();
            });

            
            //Delete all items from cart
            $('#displayCart').on('click','.clearAllBtn',function(){

                let confirmation = window.confirm("Do you want to clear this cart?");
                if(confirmation == true){
                    var delAll = '*';
                    $.ajax({
                        type: "POST",
                        url: "orderOperations.php",
                        data: {delAll:delAll},
                        beforeSend: function() {
                            $('#displayCart').addClass("d-none");
                            $('#loadCard').removeClass("d-none");
                        },
                        success: function(data) {
                            console.log(data);
                            $('#displayCart').removeClass("d-none");
                            $('#loadCard').addClass("d-none");
                            var response = JSON.parse(data);
                            if (response.delAllStatus == "0") {
                                getcartData();
                                toastr.error("Failed Deleting All");
                            } else if (response.delAllStatus == "1") {
                                getcartData();
                                toastr.success("Successfully Deleted All");
                            } else {
                                toastr.error("Some Error Occured");
                            }
                        }
                    });
                    getcartData();
                }
                
            });


            //add items by barcode
            $('#Barcode').keyup(function(){
                var itemBarcode = $(this).val();
                console.log(itemBarcode);

                if(itemBarcode.trim().length == 0){
                    console.log("empty");
                }
                else{
                    $.ajax({
                        type: "POST",
                        url: "orderOperations.php",
                        data: {itemBarcode:itemBarcode},
                        beforeSend: function() {
                           $('#add_item').addClass('disable');
                        },
                        success: function(data) {
                            console.log(data);
                            $('#add_item').removeClass('disable');
                            var response = JSON.parse(data);
                            if (response.itemStatus == "0") {
                                toastr.warning("No item for this barcode");
                                $('#Product_Name').val('');
                                $('#Weight').val('');
                                $('#Product_Code').val('');
                                $('#Product_Manufacturer').val('');
                            } else if (response.itemStatus== "1") {
                                $('#Product_Name').val(response.itemName);
                                $('#Weight').val(response.itemWeight);
                                $('#Product_Code').val(response.itemCode);
                                $('#Product_Manufacturer').val(response.itemManufacturer);
                            } else {
                                toastr.error("Some Error Occured");
                            }
                        }
                    });
                }
            });



            //add items by product code
            $('#Product_Code').keyup(function(){
                var itemPrCode = $(this).val();
                console.log(itemPrCode);

                if(itemPrCode.trim().length == 0){
                    console.log("empty");
                    $('#add_item')[0].reset();
                }
                else{
                    $.ajax({
                        type: "POST",
                        url: "orderOperations.php",
                        data: {itemPrCode:itemPrCode},
                        beforeSend: function() {
                           $('#add_item').addClass('disable');
                        },
                        success: function(data) {
                            console.log(data);
                            $('#add_item').removeClass('disable');
                            var response = JSON.parse(data);
                            if (response.PrcodeStatus == "0") {
                                toastr.warning("No item for this product code");
                                $('#Product_Name').val('');
                                $('#Weight').val('');
                                $('#Barcode').val('');
                                $('#Product_Manufacturer').val('');
                            } else if (response.PrcodeStatus == "1") {
                                $('#Product_Name').val(response.itemNameByCode);
                                $('#Weight').val(response.itemWeightByCode);
                                $('#Barcode').val(response.itemBarcodeByCode);
                                $('#Product_Manufacturer').val(response.itemManufactureByCode);
                            } else {
                                toastr.error("Some Error Occured");
                            }
                        }
                    });
                }
            });


            //delete items from cart
            $('#displayCart').on('click', '.delete_btn', function() {
                var delValue = $(this).val();
                console.log(delValue);
                $.ajax({
                    type: "POST",
                    url: "orderOperations.php",
                    data: {delValue: delValue},
                    beforeSend: function() {
                        $('#displayCart').addClass("d-none");
                        $('#loadCard').removeClass("d-none");
                    },
                    success: function(data) {
                        console.log(data);
                        $('#displayCart').removeClass("d-none");
                        $('#loadCard').addClass("d-none");
                        var deleteResponse = JSON.parse(data);
                        console.log(deleteResponse);
                        if(deleteResponse.delStatus == 0){
                            toastr.error("Delete failed");
                        }
                        else if (deleteResponse.delStatus == 1){
                            toastr.success("Successfully Deleted");
                            getcartData();
                        }
                        else{
                            toastr.error("some error occured");
                        }
                    }  
                });
            });


            //update items in cart
            $('#displayCart').on('change', '.change_btn', function() {
                var editValue = $(this).val();
                var editID = $(this).attr('id');
                //console.log(editValue);
                //console.log(editID);
                $.ajax({
                    type: "POST",
                    url: "orderOperations.php",
                    data: {editValue: editValue,editID:editID},
                    beforeSend: function() {
                        $('#displayCart').addClass("d-none");
                        $('#loadCard').removeClass("d-none");
                    },
                    success: function(data) {
                        console.log(data);
                        $('#displayCart').removeClass("d-none");
                        $('#loadCard').addClass("d-none");
                        var editResponse = JSON.parse(data);
                        console.log(editResponse);
                        if(editResponse.updtStatus == 0){
                            toastr.error("Update failed");
                        }
                        else if (editResponse.updtStatus == 1){
                            toastr.success("Successfully Updated");
                            getcartData();
                        }
                        else{
                            toastr.error("some error occured");
                        }
                    }  
                });
            });


            //update description in cart
            $('#displayCart').on('change', '.change_desc', function() {
                var descValue = $(this).val();
                var descID = $(this).attr('id');
                console.log(descValue);
                console.log(descID);
                
                $.ajax({
                    type: "POST",
                    url: "orderOperations.php",
                    data: {descValue: descValue,descID:descID},
                    beforeSend: function() {
                        $('#displayCart').addClass("d-none");
                        $('#loadCard').removeClass("d-none");
                    },
                    success: function(data) {
                        console.log(data);
                        $('#displayCart').removeClass("d-none");
                        $('#loadCard').addClass("d-none");
                        var descResponse = JSON.parse(data);
                        if(descResponse.updtDescStatus == 0){
                            toastr.error("Update description failed");
                        }
                        else if (descResponse.updtDescStatus == 1){
                            toastr.success("Successfully Updated description");
                            getcartData();
                        }
                        else{
                            toastr.error("some error occured");
                        }
                    }  
                });
                
            });


            /* Add items */
            $(function() {

                let validator = $('#add_item').jbvalidator({
                    language: 'dist/lang/en.json',
                    successClass: false,
                    html5BrowserDefault: true
                });

                $(document).on('submit', '#add_item', (function(g) {
                    g.preventDefault();
                    var itemData = new FormData(this);
                    $.ajax({
                        type: "POST",
                        url: "orderOperations.php",
                        data: itemData,
                        beforeSend: function() {
                            $('#displayCart').addClass("d-none");
                            $('#loadCard').removeClass("d-none");
                        },
                        success: function(data) {
                            console.log(data);
                            $('#displayCart').removeClass("d-none");
                            $('#loadCard').addClass("d-none");
                            var response = JSON.parse(data);
                            if (response.addItem == "1") {
                                toastr.success("Product Added Successfully");
                                getcartData();
                                //$('#itemModal').modal('hide');
                                $('#add_item')[0].reset();
                            } else if (response.addItem == "2") {
                                toastr.error("Failed Adding Product");
                                getcartData();
                            } else if (response.addItem == "3") {
                                toastr.success("Product Updated Successfully");
                                getcartData();
                                //$('#itemModal').modal('hide');
                                $('#add_item')[0].reset();
                            }
                            else {
                                toastr.error("Some Error Occured");
                            }
                        },
                        cache: false,
                        contentType: false,
                        processData: false
                    });
                }));

            });
            /* Add items */
            

            /* Add order */
            $(function() {

                let validator = $('#add_product').jbvalidator({
                    language: 'dist/lang/en.json',
                    successClass: false,
                    html5BrowserDefault: true
                });

                validator.validator.custom = function(el, event) {
                    if ($(el).is('#Customer_name,#Phone') && $(el).val().trim().length == 0) {
                        return 'Cannot be empty';
                    }
                }

                $(document).on('submit', '#add_product', (function(e) {
                    e.preventDefault();
                    var orderData = new FormData(this);
                    $.ajax({
                        type: "POST",
                        url: "place_order.php",
                        data: orderData,
                        beforeSend: function() {
                            $('#addCategoryForm').addClass("disable");
                        },
                        success: function(data) {
                            console.log(data);
                            $('#addCategoryForm').removeClass("disable");
                            var response = JSON.parse(data);
                            if (response.status == "1") {
                                $('#add_product')[0].reset();
                                toastr.success("Successfully Placed Order");
                                getcartData();
                            } else if (response.status == "0") {
                                toastr.error("Failed Taking Order");
                               
                            }else if (response.status == "3"){
                                toastr.warning("Please Add Something To Cart");
                            }
                            else {
                                toastr.error("Some Error Occured");
                            }
                        },
                        cache: false,
                        contentType: false,
                        processData: false
                    });
                }));

            });
            /* Add order */

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