<?php 
        
    include '../MAIN/Dbconfig.php';

    
    
    $writer_id = $_COOKIE['custidcookie'];

    //$quality = 40;
    //Add manufacturer
    if(isset($_POST['manufacturer_name'])){
 
        $manufacturerName = $_POST['manufacturer_name'];
        //$manufacturerPhone = $_POST['phone_number'];
        //$manufacturerAddress = $_POST['manufacturer_address'];
       

        $check_query = mysqli_query($con, "SELECT * FROM goldsmith_master WHERE goldsmith_name = '$manufacturerName' ");
        if(mysqli_num_rows($check_query) > 0){
            echo json_encode(array('addmanufacturer' => '0'));
        }
        else{

            $find_max = mysqli_query($con, "SELECT MAX(goldsmith_id) FROM goldsmith_master");
            foreach($find_max as $max_id){
                $manufactureId = $max_id['MAX(goldsmith_id)'] + 1;
            }
           
            $add_query =  mysqli_query($con, "INSERT INTO goldsmith_master (goldsmith_id,goldsmith_name) 
            VALUES ('$manufactureId','$manufacturerName')");

            if($add_query){
                echo json_encode(array('addmanufacturer' => '1'));
            }
            else{
                echo json_encode(array('addmanufacturer' => '2'));
            }
        }
        

    }

    //delete manufacturer
    if(isset($_POST['del_manufacture_id'])){
 
        $Deletemanufacturer = $_POST['del_manufacture_id'];
       
        $check_cat_query = mysqli_query($con, "SELECT * FROM item_master WHERE item_manufacturer = '$Deletemanufacturer' ");
        if(mysqli_num_rows($check_cat_query) > 0){
            echo json_encode(array('manufacturerdel' => '0'));
        }
        else{
            $delete_query =  mysqli_query($con, "DELETE FROM goldsmith_master WHERE goldsmith_id = '$Deletemanufacturer'");

            if($delete_query){
                echo json_encode(array('manufacturerdel' => '1'));
            }
            else{
                echo json_encode(array('manufacturerdel' => '2'));
            }
        
        }
        

        

    }

    //Edit Manufacturer
    if(isset($_POST['edit_manufacturer_id'])){
        $manufacturer_edit_id = $_POST['edit_manufacturer_id'];

        $edit_manufacturer = mysqli_query($con, "SELECT goldsmith_name FROM goldsmith_master WHERE goldsmith_id = '$manufacturer_edit_id'");
        if($edit_manufacturer){
            foreach($edit_manufacturer as $edit_manufacturers){
                $manufacturer_value = $edit_manufacturers['goldsmith_name'];
                echo json_encode(array('manufacturervalue' => $manufacturer_value));
            }
        }
        else{
            echo json_encode(array('manufacturervalue' => 'error'));
        }
     
    }



    //Update Manufacturer
    if(isset($_POST['UpdateManufacturerId'])){
        $UpdateManufacturerName = $_POST['updateManufacturer_name'];

        $updateManufacturerId = $_POST['UpdateManufacturerId'];


        $check_manufacturer_query = mysqli_query($con, "SELECT * FROM goldsmith_master WHERE goldsmith_name = '$UpdateManufacturerName'  AND goldsmith_id <> '$updateManufacturerId'");
        if(mysqli_num_rows($check_manufacturer_query) > 0){
            echo json_encode(array('updatemanufacturer' => '0'));
        }
        else{
           
            $update_query =  mysqli_query($con, "UPDATE goldsmith_master SET goldsmith_name = '$UpdateManufacturerName' WHERE goldsmith_id = '$updateManufacturerId'");

            if($update_query){
                echo json_encode(array('updatemanufacturer' => '1'));
            }
            else{
                echo json_encode(array('updatemanufacturer' => '2'));
            }
        }
    }


    //ADD Product
    if(isset($_POST['product_name']) && !empty($_POST['product_name'])){

        $itemName = $_POST['product_name'];
        $itemCode = $_POST['product_Code'];
        $itemCategory = $_POST['category'];
        $itemWeight = $_POST['weight'];
        $itemVenue = $_POST['venue'];
        $itemGoldsmith = $_POST['manufacturer'];
        $data = $_POST["uploadImage"];
    
        //$itemImage = $_FILES['item_image']['name'];
        //$extension = pathinfo($itemImage, PATHINFO_EXTENSION);
        //$tempimage = $_FILES['item_image']['tmp_name'];
        //$final_image_name = $itemCode.".".$extension;
        //$folder = "../IMAGES/".$final_image_name;
        


    
        $check_item_already = mysqli_query($con, "SELECT item_code FROM item_master WHERE item_code = '$itemCode' AND item_category = '$itemCategory'");
        if(mysqli_num_rows($check_item_already) > 0){
            echo json_encode(array('addpr' => 0));
        
        }
        else{

        
            if(!empty($_FILES['item_image']['name']) && !empty($data)){


                $image_array_1 = explode(";", $data);
                $image_array_2 = explode(",", $image_array_1[1]);
                $data = base64_decode($image_array_2[1]);
                $itemImageName = '../IMAGES/' .$itemCode. '.png';
                $final_image_name = $itemCode.".png";

                if(file_put_contents($itemImageName, $data)){
                    
                    $max_product_id = mysqli_query($con, "SELECT MAX(item_id) AS max_itemId, MAX(item_barcode) AS barmax FROM item_master");
                    foreach($max_product_id as $max_prid_result){
                        $itemBarcode = $max_prid_result['barmax'] + 1;
                        $max_prid = $max_prid_result['max_itemId'] + 1;
                    }
        
            
                    $product_add_query = mysqli_query($con, "INSERT INTO item_master (item_id,item_name,item_code,item_manufacturer,item_category,item_weight,item_venue,item_barcode,item_image,entered_by) 
                    VALUES ('$max_prid','$itemName','$itemCode','$itemGoldsmith','$itemCategory','$itemWeight','$itemVenue','$itemBarcode','$final_image_name','$writer_id')");
        
                    if($product_add_query){
                        echo json_encode(array('addpr' => 1));
                    }
                    else{
                        echo json_encode(array('addpr' => 2));
                    }
                }
                else{
                    echo json_encode(array('addpr' => 2));
                }
                
                
            
            }
            else{
            
                $max_product_id = mysqli_query($con, "SELECT MAX(item_id) AS max_itemId, MAX(item_barcode) AS barmax FROM item_master");
                foreach($max_product_id as $max_prid_result){
                    $itemBarcode = $max_prid_result['barmax'] + 1;
                    $max_prid = $max_prid_result['max_itemId'] + 1;
                }
        
            
                $product_add_query = mysqli_query($con, "INSERT INTO item_master (item_id,item_name,item_code,item_manufacturer,item_category,item_weight,item_venue,item_barcode,entered_by) 
                VALUES ('$max_prid','$itemName','$itemCode','$itemGoldsmith','$itemCategory','$itemWeight','$itemVenue','$itemBarcode','$writer_id')");
        
                if($product_add_query){
                    echo json_encode(array('addpr' => 1));
                }
                else{
                    echo json_encode(array('addpr' => 2));
                }
                
                
            }

        

        }
        
    }
    else{
    // echo json_encode(array('type' => 3));
    }



    /* //update Product
    if(isset($_POST['updateproduct_name']) && !empty($_POST['updateproduct_name'])){
        $updateItemId = $_POST['updateItemId'];
        $updateitemName = $_POST['updateproduct_name'];
        $updateitemCode = $_POST['updateproduct_Code'];
        $updateitemCategory = $_POST['updatecategory'];
        $updateitemWeight = $_POST['updateweight'];
        $updateitemVenue = $_POST['updatevenue'];
        $updateitemGoldsmith = $_POST['updatemanufacturer'];
        $updateitemImage = $_FILES['updateitem_image']['name'];
        $updateextension = pathinfo($updateitemImage, PATHINFO_EXTENSION);
        $updatetempimage = $_FILES['updateitem_image']['tmp_name'];
        $updatefinal_image_name = $updateitemCode.".".$updateextension;
        $updatefolder = "../IMAGES/".$updatefinal_image_name;


        $check_update_item_already = mysqli_query($con, "SELECT item_code FROM item_master WHERE item_code = '$updateitemCode' AND item_category = '$updateitemCategory' AND item_id  <> '$updateItemId'");
        if(mysqli_num_rows($check_update_item_already) > 0){
            echo json_encode(array('updatepr' => 0));
           
        }
        else{

            if(!empty($_FILES['updateitem_image']['name'])){
                $itemFetch_query = mysqli_query($con, "SELECT item_image FROM item_master WHERE item_id = '$updateItemId'");
                foreach($itemFetch_query as $varItem){
                    $imageValue = $varItem['item_image'];
                    $imagePath = "../IMAGES/".$varItem['item_image'];
                }
                if($imageValue != null){
                    if(unlink($imagePath)){
    
                        if(move_uploaded_file($updatetempimage, $updatefolder)){
                            $product_update_query = mysqli_query($con, "UPDATE item_master SET item_name = '$updateitemName',item_code = '$updateitemCode',item_manufacturer ='$updateitemGoldsmith',item_category = '$updateitemCategory',item_weight = '$updateitemWeight',item_venue = '$updateitemVenue',item_image = '$updatefinal_image_name',entered_by = '$writer_id' WHERE item_id = '$updateItemId'");
                
                            if($product_update_query){
                                echo json_encode(array('updatepr' => 1));
                            }
                            else{
                                echo json_encode(array('updatepr' => 2));
                            }
                        }
                        
                    }
                    else{
                        echo json_encode(array('updatepr' => 2));
                    }  
                }
                else{
                    if(move_uploaded_file($updatetempimage, $updatefolder)){
                        $product_update_query = mysqli_query($con, "UPDATE item_master SET item_name = '$updateitemName',item_code = '$updateitemCode',item_manufacturer ='$updateitemGoldsmith',item_category = '$updateitemCategory',item_weight = '$updateitemWeight',item_venue = '$updateitemVenue',item_image = '$updatefinal_image_name',entered_by = '$writer_id' WHERE item_id = '$updateItemId'");
            
                        if($product_update_query){
                            echo json_encode(array('updatepr' => 1));
                        }
                        else{
                            echo json_encode(array('updatepr' => 2));
                        }
                    }
                } 
           }
           else{
                $product_update_query = mysqli_query($con, "UPDATE item_master SET item_name = '$updateitemName', item_code = '$updateitemCode', item_manufacturer = '$updateitemGoldsmith', item_category = '$updateitemCategory', item_weight = '$updateitemWeight', item_venue = '$updateitemVenue',entered_by = '$writer_id' WHERE item_id = '$updateItemId'");
        
                if($product_update_query){
                    echo json_encode(array('updatepr' => 1));
                }
                else{
                    echo json_encode(array('updatepr' => 2));
                }
           }
        }
    }
    else{
       
    } */





    //update Product
    if(isset($_POST['updateproduct_name']) && !empty($_POST['updateproduct_name'])){
        $updateItemId = $_POST['updateItemId'];
        $updateitemName = $_POST['updateproduct_name'];
        $updateitemCode = $_POST['updateproduct_Code'];
        $updateitemCategory = $_POST['updatecategory'];
        $updateitemWeight = $_POST['updateweight'];
        $updateitemVenue = $_POST['updatevenue'];
        $updateitemGoldsmith = $_POST['updatemanufacturer'];
        $updatedata = $_POST["updateuploadImage"];
        // $updateitemImage = $_FILES['updateitem_image']['name'];
        // $updateextension = pathinfo($updateitemImage, PATHINFO_EXTENSION);
        // $updatetempimage = $_FILES['updateitem_image']['tmp_name'];
        // $updatefinal_image_name = $updateitemCode.".".$updateextension;
        // $updatefolder = "../IMAGES/".$updatefinal_image_name;


        $check_update_item_already = mysqli_query($con, "SELECT item_code FROM item_master WHERE item_code = '$updateitemCode' AND item_category = '$updateitemCategory' AND item_id  <> '$updateItemId'");
        if(mysqli_num_rows($check_update_item_already) > 0){
            echo json_encode(array('updatepr' => 0));
           
        }
        else{

            if(!empty($_FILES['updateitem_image']['name']) && !empty($updatedata)){

                $update_image_array_1 = explode(";", $updatedata);
                $update_image_array_2 = explode(",", $update_image_array_1[1]);
                $updatedata = base64_decode($update_image_array_2[1]);
                $updateitemImageName = '../IMAGES/' .$updateitemCode. '.png';
                $update_final_image_name = $updateitemCode.".png";



                $itemFetch_query = mysqli_query($con, "SELECT item_image FROM item_master WHERE item_id = '$updateItemId'");
                foreach($itemFetch_query as $varItem){
                    $imageValue = $varItem['item_image'];
                    $imagePath = "../IMAGES/".$varItem['item_image'];
                }
                if($imageValue != null){
                    if(unlink($imagePath)){
    
                        if(file_put_contents($updateitemImageName, $updatedata)){
                            $product_update_query = mysqli_query($con, "UPDATE item_master SET item_name = '$updateitemName',item_code = '$updateitemCode',item_manufacturer ='$updateitemGoldsmith',item_category = '$updateitemCategory',item_weight = '$updateitemWeight',item_venue = '$updateitemVenue',item_image = '$update_final_image_name',entered_by = '$writer_id' WHERE item_id = '$updateItemId'");
                
                            if($product_update_query){
                                echo json_encode(array('updatepr' => 1));
                            }
                            else{
                                echo json_encode(array('updatepr' => 2));
                            }
                        }
                        
                    }
                    else{
                        echo json_encode(array('updatepr' => 2));
                    }  
                }
                else{
                    if(file_put_contents($updateitemImageName, $updatedata)){
                        $product_update_query = mysqli_query($con, "UPDATE item_master SET item_name = '$updateitemName',item_code = '$updateitemCode',item_manufacturer ='$updateitemGoldsmith',item_category = '$updateitemCategory',item_weight = '$updateitemWeight',item_venue = '$updateitemVenue',item_image = '$update_final_image_name',entered_by = '$writer_id' WHERE item_id = '$updateItemId'");
            
                        if($product_update_query){
                            echo json_encode(array('updatepr' => 1));
                        }
                        else{
                            echo json_encode(array('updatepr' => 2));
                        }
                    }
                } 
            }
            else{
                    $product_update_query = mysqli_query($con, "UPDATE item_master SET item_name = '$updateitemName', item_code = '$updateitemCode', item_manufacturer = '$updateitemGoldsmith', item_category = '$updateitemCategory', item_weight = '$updateitemWeight', item_venue = '$updateitemVenue',entered_by = '$writer_id' WHERE item_id = '$updateItemId'");
            
                    if($product_update_query){
                        echo json_encode(array('updatepr' => 1));
                    }
                    else{
                        echo json_encode(array('updatepr' => 2));
                    }
            }
        }
    }
    else{
       
    }















    //Delete product

    if(isset($_POST['delValue'])){
        $delvalue = $_POST['delValue'];

        $check_item_exists = mysqli_query($con, "SELECT * FROM order_items WHERE ord_itemId = '$delvalue'");
        if(mysqli_num_rows($check_item_exists) > 0){
            echo json_encode(array('delItem' => 0));
        }
        else{
            $delImage_query = mysqli_query($con, "SELECT item_image FROM item_master WHERE item_id = '$delvalue'");
            foreach($delImage_query as $delImages){
                $delImage = $delImages['item_image'];
                $delImagePath = "../IMAGES/".$delImages['item_image'];
            }
            if($delImage != null){
                if(unlink($delImagePath)){
    
                    $delItemWithImage = mysqli_query($con, "DELETE FROM item_master WHERE item_id = '$delvalue'");
                    if($delItemWithImage){
                        echo json_encode(array('delItem' => 1));
                    }
                    else{
                        echo json_encode(array('delItem' => 2));
                    }
    
                }
                else{
                    echo json_encode(array('delItem' => 2));
                }  
            }
            else{
                $delItemWithImage = mysqli_query($con, "DELETE FROM item_master WHERE item_id = '$delvalue'");
                if($delItemWithImage){
                    echo json_encode(array('delItem' => 1));
                }
                else{
                    echo json_encode(array('delItem' => 2));
                }
            }
        }

        


    }

   











    

?>