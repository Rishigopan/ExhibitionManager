
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



//Display Category
if(isset($_POST["cats"])){
    
    $fetchCategory = mysqli_query($con, "SELECT category_id,category_name FROM category_master ORDER BY category_name ASC");
    if(mysqli_num_rows($fetchCategory) > 0){
        foreach($fetchCategory as $Category){
    ?> 

        <li class="p-2 ">
            <div class="row  px-3">
                <div class="col-8 col-xxl-10 col-md-8 col-lg-9">
                    <h5 class="mt-2"><?php echo $Category['category_name']; ?></h5>
                </div>
                <div class="col-4 d-flex col-xxl-2 col-md-4 col-lg-3">
                    <div><button class="btn btn_edit" value="<?php echo $Category['category_id']; ?>"> <i class="ri-pencil-fill"></i></button></div>
                    <div><button class="btn btn_delete" value="<?php echo $Category['category_id']; ?>"> <i class="ri-delete-bin-fill"></i> </button></div>
                </div>
            </div>
        </li>

    <?php

        }
    }
    else{
    ?>
        <li class="p-2 ">
            <div class="row  px-3">
                <div class="col-12 ">
                    <h5 class="mt-2 text-center">No Category Data</h5>
                </div>
                
            </div>
        </li>
    <?php
    }
}


?>







<script>




//Edit category
$('.btn_edit').click(function(){
    var edit_category_id  = $(this).val();
    console.log(edit_category_id);
    
    $.ajax({
        method:"POST",
        url:"category_operations.php",
        data:{edit_category_id:edit_category_id},
        beforeSend:function(){
            $('#addCategoryForm').addClass("disable");
        },
        success:function(data){
            console.log(data);
            var editcategory = JSON.parse(data);
            if(editcategory.categoryvalue == 'error'){
                toastr.error("Some Error Occured");
            }
            else{
                $('#addCategoryForm').removeClass("disable");
                $('#updateCategory_name').val(editcategory.categoryvalue);   
                $('#editCategoryId').val(edit_category_id);
                $('#updateCategoryForm').show();
                $('#addCategoryForm').hide(); 
            }
                    
        },
        error:function(){
            alert("Error");
        }
    })
});

//DELETE category
$('.btn_delete').click(function(){
    var del_category_id  = $(this).val();
    console.log(del_category_id);
    $.ajax({
        method:"POST",
        url:"category_operations.php",
        data:{del_category_id:del_category_id},
        beforeSend:function(){
            $('#addCategoryForm').addClass("disable");
        },
        success:function(data){
           
            $('#addCategoryForm').removeClass("disable");
            console.log(data);
            
            var deletecat = JSON.parse(data);
            if(deletecat.categorydel == '0'){
                toastr.warning("Category Is In Use");
            }
            else if(deletecat.categorydel == '1'){
                toastr.success("Successfully Deleted");
                getCategoryData();
               
            }
            else if(deletecat.categorydel == '2'){
                toastr.error("Failed Deleting Category");
            }
        
        },
        error:function(){
            alert("Error");
        }
    })
});


</script>