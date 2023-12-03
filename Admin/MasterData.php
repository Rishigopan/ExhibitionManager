<?php


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


require_once "../MAIN/Dbconfig.php";



//Display Manufacturer
if (isset($_POST["action"])) {

    $fetchManufacturer = mysqli_query($con, "SELECT goldsmith_id,goldsmith_name FROM goldsmith_master");
    if (mysqli_num_rows($fetchManufacturer) > 0) {
        foreach ($fetchManufacturer as $Manufacturer) {
?>

            <li class="p-2 ">
                <div class="row  px-3">
                    <div class="col-8 col-xxl-10 col-md-8 col-lg-9">
                        <h5 class="mt-2"><?php echo $Manufacturer['goldsmith_name']; ?></h5>
                    </div>
                    <div class="col-4 d-flex col-xxl-2 col-md-4 col-lg-3">
                        <div><button class="btn btn_edit" value="<?php echo $Manufacturer['goldsmith_id']; ?>"> <i class="ri-pencil-fill"></i></button></div>
                        <div><button class="btn btn_delete" value="<?php echo $Manufacturer['goldsmith_id']; ?>"> <i class="ri-delete-bin-fill"></i> </button></div>
                    </div>
                </div>
            </li>

        <?php

        }
    } else {
        ?>
            <li class="p-2 ">
                <div class="row  px-3">
                    <div class="col-12 ">
                        <h5 class="mt-2 text-center">No Manufacturer Data</h5>
                    </div>

                </div>
            </li>
        <?php
    }
}


?>







<script>
    //Edit manufacturer
    $('.btn_edit').click(function() {
        var edit_manufacturer_id = $(this).val();
        console.log(edit_manufacturer_id);

        $.ajax({
            method: "POST",
            url: "master_operations.php",
            data: {
                edit_manufacturer_id: edit_manufacturer_id
            },
            beforeSend: function() {
                $('#addManufacturerForm').addClass("disable");
            },
            success: function(data) {

                console.log(data);
                var editmanufacturer = JSON.parse(data);
                if (editmanufacturer.manufacturervalue == 'error') {
                    toastr.error("Some Error Occured");
                } else {
                    $('#addManufacturerForm').removeClass("disable");
                    $('#updateManufacturer_name').val(editmanufacturer.manufacturervalue);
                    $('#editManufacturerId').val(edit_manufacturer_id);
                    $('#updateManufacturer_name').focus();
                    $('#updateManufacturerForm').show();
                    $('#addManufacturerForm').hide();
                }

            },
            error: function() {
                alert("Error");
            }
        })
    });

    //DELETE manufacturer
    $('.btn_delete').click(function() {
        var del_manufacture_id = $(this).val();
        console.log(del_manufacture_id);
        $.ajax({
            method: "POST",
            url: "master_operations.php",
            data: {
                del_manufacture_id: del_manufacture_id
            },
            beforeSend: function() {
                $('#addManufacturerForm').addClass("disable");
            },
            success: function(data) {

                $('#addManufacturerForm').removeClass("disable");
                console.log(data);

                var deleteMan = JSON.parse(data);
                if (deleteMan.manufacturerdel == '0') {
                    toastr.warning("Manufacturer Is In Use");
                } else if (deleteMan.manufacturerdel == '1') {
                    toastr.success("Successfully Deleted");
                    getManufacturerData();

                } else if (deleteMan.manufacturerdel == '2') {
                    toastr.error("Failed Deleting Manufacturer");
                }

            },
            error: function() {
                alert("Error");
            }
        })
    });
</script>