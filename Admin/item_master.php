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


        <link rel="stylesheet" href="https://unpkg.com/dropzone/dist/dropzone.css" />
		<link href="https://unpkg.com/cropperjs/dist/cropper.css" rel="stylesheet"/>
		<script src="https://unpkg.com/dropzone"></script>
		<script src="https://unpkg.com/cropperjs"></script>


    <?php


    include '../MAIN/Header.php';

    ?>

    <style>
        .disable {
            opacity: 0.3;
            pointer-events: none;
        }

        #sample_image{
            width: 100%;
        }

        .preview {
  			overflow: hidden;
  			width: 160px; 
  			height: 160px;
  			margin: 10px;
  			border: 1px solid red;
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
                            <a href="./item_master.php" class="active">
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
        <div class="modal fade" id="modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="img-container">
                            <div class="row">
                                <div class="col-md-8">
                                    <img src="" id="sample_image" />
                                </div>
                                <div class="col-md-4">
                                    <div class="preview" id="preview"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary" id="crop">Crop</button>
                    </div>
                </div>
            </div>
        </div>



<!-- 
        
        <div class="modal fade" id="modal" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
			  	<div class="modal-dialog modal-lg" role="document">
			    	<div class="modal-content">
			      		<div class="modal-header">
			        		<h5 class="modal-title" id="modalLabel">Crop Image Before Upload</h5>
			        		<button type="button" class="btn-close" data-dismiss="modal" aria-label="Close">
			          			<span aria-hidden="true">×</span>
			        		</button>
			      		</div>
			      		<div class="modal-body">
			        		<div class="img-container">
			            		<div class="row">
			                		<div class="col-md-8">
			                    		<img src="" id="sample_image" />
			                		</div>
			                		<div class="col-md-4">
			                    		<div class="preview"></div>
			                		</div>
			            		</div>
			        		</div>
			      		</div>
			      		<div class="modal-footer">
			        		<button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
			        		<button type="button" class="btn btn-primary" id="crop">Crop</button>
			      		</div>
			    	</div>
			  	</div>
		</div>		 -->

        <div class="container main-content">

            <h3 class="mt-3 title text-center shadow-sm  py-2">Add Product</h3>

            <div class="card card-body main-card shadow-sm">
                <form action="" id="add_product" enctype="multipart/form-data" novalidate>
                    <div class="row">
                        <div class="col-md-8 order-1 order-lg-0 product_details px-xl-5">
                            <div class="inputs">
                                <label class="form-label" for="Product_name">Product Name</label>
                                <input type="text" class="form-control" id="Product_name" placeholder="" tabindex="1" name="product_name" data-v-max-length="20" data-v-message="maximum 20 characters" required>
                            </div>

                            <div class="row">
                                <div class="col-6 ">
                                    <div class="inputs">
                                        <label class="form-label" for="Product_Code">Product Code</label>
                                        <input type="text" class="form-control" id="Product_Code" placeholder="" tabindex="2" name="product_Code" data-v-max-length="15" data-v-message="maximum 15 characters" required>
                                    </div>
                                    <div class="inputs">
                                        <label class="form-label" for="Category">Category</label>
                                        <select class="form-select" name="category" id="Category" tabindex="4" data-v-message="Please choose a category" required>
                                            <option hidden value="">Choose...</option>
                                            <?php
                                            $find_category = mysqli_query($con, "SELECT category_id,category_name FROM category_master ");
                                            foreach ($find_category as $categories) {
                                                echo '<option value=' . $categories['category_id'] . '>' . $categories['category_name'] . '</option>';
                                            }
                                            ?>
                                        </select>
                                    </div>
                                    <div class="inputs">
                                        <label class="form-label" for="Goldsmith_Manufacturer">Goldsmith</label>
                                        <select class="form-select" name="manufacturer" id="Goldsmith_Manufacturer" data-v-message="Please choose a manufacturer" tabindex="6" required>
                                            <option hidden value="">Choose...</option>
                                            <?php
                                            $find_manufacturer = mysqli_query($con, "SELECT goldsmith_id,goldsmith_name FROM goldsmith_master ");
                                            foreach ($find_manufacturer as $manufacturers) {
                                                echo '<option value=' . $manufacturers['goldsmith_id'] . '>' . $manufacturers['goldsmith_name'] . '</option>';
                                            }
                                            ?>

                                        </select>
                                    </div>
                                </div>
                                <div class="col-6 ">
                                    <div class="inputs">
                                        <label class="form-label" for="Weight">Weight</label>
                                        <input type="number" class="form-control" id="Weight" placeholder="" tabindex="3" name="weight" step="0.001" data-v-message="Upto  3 decimal points" required>
                                    </div>

                                    <div class="inputs">
                                        <label class="form-label" for="Venue">Venue</label>
                                        <input type="text" class="form-control" list="datalistVenue" name="venue" tabindex="5" data-v-max-length="20" data-v-message="maximum 20 characters" id="Venue">
                                        <datalist id="datalistVenue">

                                            <?php
                                            $find_venue = mysqli_query($con, "SELECT  DISTINCT(item_venue) AS venue FROM item_master ");
                                            foreach ($find_venue as $venue) {
                                                echo '<option value=' . $venue['venue'] . '>';
                                            }
                                            ?>

                                        </datalist>


                                    </div>
                                </div>
                            </div>

                            <div class="text-center submit_btn">
                                <button class="btn btn_submit">Save Product</button>
                            </div>
                        </div>
                        <div class="col-md-4 order-0 order-lg-1 px-xl-5">

                            <div class="img-box">
                                <div class="d-flex justify-content-center">
                                <div class="photo">
                                    <img src="../add_image.png" alt="Choose an image" id="photo_img">
                                    <div class="photo_add">
                                        <input type="file" id="photo_input" name="item_image" tabindex="7" class="form-control" style="opacity: 0;" accept="image/*"  >
                                        <label for="photo_input" class="form-label ">
                                            <div class="text-center ">

                                            </div>
                                        </label>
                                    </div>
                                </div>

                                

                                </div>
                                <div class="img-details ">
                                    <label class="form-label d-none d-md-flex" for="">Upload Picture</label>
                                    <p class="d-none d-md-flex">Upload Picture size should be less than 50 kb and having a size of 300*300</p>
                                </div>


                                <input type="text" name="uploadImage" id="base64Encoded" hidden>

                            </div>


                        </div>
                    </div>
                </form>
            </div>


        </div>





    </div>



    <script src="https://cdn.jsdelivr.net/npm/@emretulek/jbvalidator"></script>


    <script>



       /*  function showPreview(event) {
            if (event.target.files.length > 0) {
                var src = URL.createObjectURL(event.target.files[0]);
                var preview = document.getElementById("photo_img");
                preview.src = src;
                preview.style.display = "block";
            }
        }
        */

 
        function revertPreview() {
            var newpreview = document.getElementById("photo_img");
            newpreview.src = '../add_image.png';
        } 
  

        $(document).ready(function() {

            var $modal = $('#modal');
            var image = document.getElementById('sample_image');
            var cropper;

            //$("body").on("change", ".image", function(e){
            $('#photo_input').change(function(event){
                var files = event.target.files;
                var done = function (url) {
                    image.src = url;
                    $modal.modal('show');
                };
                //var reader;
                //var file;
                //var url;

                if (files && files.length > 0)
                {
                    /*file = files[0];
                    if(URL)
                    {
                        done(URL.createObjectURL(file));
                    }
                    else if(FileReader)
                    {*/
                        reader = new FileReader();
                        reader.onload = function (event) {
                            done(reader.result);
                        };
                        reader.readAsDataURL(files[0]);
                    //}
                }
            });


            $modal.on('shown.bs.modal', function() {
                imagePreview = document.getElementById("preview");
                cropper = new Cropper(image, {
                    aspectRatio: 1,
                    viewMode: 3,
                    preview: imagePreview
                });
            });

            $modal.on('hidden.bs.modal', function() {
                cropper.destroy();
                cropper = null;
            });

            $("#crop").click(function(){
                canvas = cropper.getCroppedCanvas({
                    width: 500,
                    height: 500,
                });

                canvas.toBlob(function(blob) {
                    //url = URL.createObjectURL(blob);
                    var reader = new FileReader();
                    reader.readAsDataURL(blob); 
                    reader.onloadend = function() {
                        var base64data = reader.result;  
                        $('#base64Encoded').val(base64data);
                        //console.log(base64data);
                        $('#photo_img').attr('src', base64data);
                        
                    }
                },'image/jpeg',0.5);

                $modal.modal('hide');
                
            });



            $('#Product_name').focus();

            /* Add item Start */
            $(function() {

                let validator = $('#add_product').jbvalidator({
                    language: 'dist/lang/en.json',
                    successClass: false,
                    html5BrowserDefault: true
                });

                validator.validator.custom = function(el, event) {
                    if ($(el).is('#Product_name,#Product_Code,#Weight') && $(el).val().trim().length == 0) {
                        return 'Cannot be empty';
                    }
                }

                $(document).on('submit', '#add_product', (function(e) {
                    e.preventDefault();
                    var ItemData = new FormData(this);
                    $.ajax({
                        type: "POST",
                        url: "master_operations.php",
                        data: ItemData,
                        beforeSend: function() {
                            $('#add_product').addClass("disable");
                        },
                        success: function(data) {
                            console.log(data);
                            $('#add_product').removeClass("disable");
                            var response = JSON.parse(data);
                            if (response.addpr == "0") {
                                toastr.warning("Product Already Exists");
                            } else if (response.addpr == "1") {
                                toastr.success("Successfully Added Product");
                                //$('#add_product')[0].reset();
                                $('#Product_name').val('');
                                $('#Product_Code').val('');
                                $('#Weight').val('');
                                $('#photo_input').val('');
                                $('#base64Encoded').val('');
                                $('#Venue').val('');
                                $('#Product_name').focus();
                                //$('#Goldsmith_Manufacturer').val().change();
                                revertPreview();
                            } else if (response.addpr == "2") {
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
            /* Add item  End */







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