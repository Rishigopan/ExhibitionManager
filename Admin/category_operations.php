<?php 
        
    include '../MAIN/Dbconfig.php';


    //Add category
    if(isset($_POST['category_name'])){

 
        $categoryName = $_POST['category_name'];
        
        $check_query = mysqli_query($con, "SELECT * FROM category_master WHERE category_name = '$categoryName' ");
        if(mysqli_num_rows($check_query) > 0){
            echo json_encode(array('addCategory' => '0'));
        }
        else{

            $find_max = mysqli_query($con, "SELECT MAX(category_id) FROM category_master");
            foreach($find_max as $max_id){
                $categoryId = $max_id['MAX(category_id)'] + 1;
            }
           
            $add_query =  mysqli_query($con, "INSERT INTO category_master (category_id,category_name) 
            VALUES ('$categoryId','$categoryName')");

            if($add_query){
                echo json_encode(array('addCategory' => '1'));
            }
            else{
                echo json_encode(array('addCategory' => '2'));
            }
        }
        

    }

    

    //delete category
    if(isset($_POST['del_category_id'])){
 
        $Deletecategory = $_POST['del_category_id'];
       
        $check_category_query = mysqli_query($con, "SELECT * FROM item_master WHERE item_category = '$Deletecategory' ");
        if(mysqli_num_rows($check_category_query) > 0){
            echo json_encode(array('categorydel' => '0'));
        }
        else{
            $delete_query =  mysqli_query($con, "DELETE FROM category_master WHERE category_id = '$Deletecategory'");

            if($delete_query){
                echo json_encode(array('categorydel' => '1'));
            }
            else{
                echo json_encode(array('categorydel' => '2'));
            }
        }
        
    }


    //Edit category
    if(isset($_POST['edit_category_id'])){
        $category_edit_id = $_POST['edit_category_id'];

        $edit_category = mysqli_query($con, "SELECT category_name FROM category_master WHERE category_id = '$category_edit_id'");
        if($edit_category){
            foreach($edit_category as $edit_categorys){
                $category_value = $edit_categorys['category_name'];
                echo json_encode(array('categoryvalue' => $category_value));
            }
        }
        else{
            echo json_encode(array('categoryvalue' => 'error'));
        }
     
    }



    //Update category
    if(isset($_POST['editCategoryId'])){
        $UpdatecategoryName = $_POST['updateCategory_name'];

        $updatecategoryId = $_POST['editCategoryId'];


        $check_category_query = mysqli_query($con, "SELECT * FROM category_master WHERE category_name = '$UpdatecategoryName'  AND category_id <> '$updatecategoryId'");
        if(mysqli_num_rows($check_category_query) > 0){
            echo json_encode(array('updatecategory' => '0'));
        }
        else{
           
            $update_query =  mysqli_query($con, "UPDATE category_master SET category_name = '$UpdatecategoryName' WHERE category_id = '$updatecategoryId '");

            if($update_query){
                echo json_encode(array('updatecategory' => '1'));
            }
            else{
                echo json_encode(array('updatecategory' => '2'));
            }
        }
    }


    

   











    

?>