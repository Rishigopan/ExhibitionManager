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
    <style>
        .disable {
            opacity: 0.3;
            pointer-events: none;
        }
    </style>


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
                            <a href="./category_master.php" class="active">
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
        <div class="container main-content">

            <h3 class="mt-3 title shadow-sm  py-2 text-center">Add Category</h3>

            <div class="card card-body main-card shadow-sm">
                <div id="add_manufacturer">
                    <div class="row">
                        <div class="col-md-5 product_details mt-2 px-xl-2">
                            <form action="" id="addCategoryForm" novalidate>
                                <div class="inputs">
                                    <label class="form-label" for="Category_name">Category Name</label>
                                    <input type="text" class="form-control" id="Category_name" data-v-max-length="20" data-v-message="Maximum 20 characters" placeholder="" name="category_name" required>
                                </div>

                                <div class="text-center submit_btn">
                                    <button class="btn btn_submit" type="submit">Save </button>
                                </div>
                            </form>
                            <form action="" id="updateCategoryForm" style="display: none;" novalidate>
                                <div class="inputs">
                                    <label class="form-label" for="updateCategory_name">Category Name</label>
                                    <input type="text" id="editCategoryId" name="editCategoryId" hidden>
                                    <input type="text" class="form-control" id="updateCategory_name" data-v-max-length="20" data-v-message="Maximum 20 characters" placeholder="" name="updateCategory_name" required>
                                </div>

                                <div class="text-center submit_btn">
                                    <button class="btn btn_submit" type="submit">Update </button>
                                </div>
                            </form>
                        </div>
                        <div class="col-md-7 p-0  px-xl-4">

                            <div class="card card-body view_details p-0">

                                <div class="card card-body bg-transparent border-0 d-none" id="loadCard"> 

                                    <div id="loader" class="mx-auto"></div>

                                </div>

                                <ul class="list-unstyled px-1" id="displayCategory">



                                </ul>

                            </div>

                        </div>
                    </div>
                </div>
            </div>


        </div>





    </div>



    <script src="https://cdn.jsdelivr.net/npm/@emretulek/jbvalidator"></script>

    <script src="../JS/masters.js?ver=1.1"></script>

    <script>

        getCategoryData();


        $(document).ready(function() {

            $('#Category_name').focus();

            /* Add category Start */
            $(function() {

                let validator = $('#addCategoryForm').jbvalidator({
                    language: 'dist/lang/en.json',
                    successClass: false,
                    html5BrowserDefault: true
                });

                validator.validator.custom = function(el, event) {
                    if ($(el).is('#Category_name') && $(el).val().trim().length == 0) {
                        return 'Cannot be empty';
                    }
                }

                $(document).on('submit', '#addCategoryForm', (function(e) {
                    e.preventDefault();
                    var categoryData = new FormData(this);
                    $.ajax({
                        type: "POST",
                        url: "category_operations.php",
                        data: categoryData,
                        beforeSend: function() {
                            $('#addCategoryForm').addClass("disable");
                        },
                        success: function(data) {
                            console.log(data);
                            $('#addCategoryForm').removeClass("disable");
                            var response = JSON.parse(data);
                            if (response.addCategory == "0") {
                                toastr.warning("Category is Already Present");
                            } else if (response.addCategory == "1") {
                                toastr.success("Successfully Added Category");
                                $('#addCategoryForm')[0].reset();
                                getCategoryData();
                                $('#Category_name').focus();
                            } else if (response.addCategory == "2") {
                                toastr.error("Some Error Occured");
                            } else {
                                toastr.error("Some Error Occured");
                            }
                        },
                        cache: false,
                        contentType: false,
                        processData: false
                    });
                }));

            });
            /* Add category  End */


            /* update category Start */
            $(function() {

                let validator = $('#updateCategoryForm').jbvalidator({
                    language: 'dist/lang/en.json',
                    successClass: false,
                    html5BrowserDefault: true
                });

                validator.validator.custom = function(el, event) {
                    if ($(el).is('#updateCategory_name') && $(el).val().trim().length == 0) {
                        return 'Cannot be empty';
                    }
                }

                $(document).on('submit', '#updateCategoryForm', (function(e) {
                    e.preventDefault();
                    var updateCategoryData = new FormData(this);
                    $.ajax({
                        type: "POST",
                        url: "category_operations.php",
                        data: updateCategoryData,
                        beforeSend: function() {
                            $('#updateCategoryForm').addClass("disable");
                        },
                        success: function(data) {
                            console.log(data);
                            $('#updateCategoryForm').removeClass("disable");
                            var updateresponse = JSON.parse(data);
                            if (updateresponse.updatecategory == "0") {
                                toastr.warning("Category is Already Present");
                            } else if (updateresponse.updatecategory == "1") {
                                toastr.success("Successfully Updated Category");
                                $('#updateCategoryForm')[0].reset();
                                getCategoryData();
                                $('#updateCategoryForm').hide();
                                $('#addCategoryForm').show();
                                $('#Category_name').focus();
                            } else if (updateresponse.updatecategory == "2") {
                                toastr.error("Some Error Occured");
                            } else {
                                toastr.error("Some Error Occured");
                            }
                        },
                        cache: false,
                        contentType: false,
                        processData: false
                    });
                }));

            });
            /* update category End */





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