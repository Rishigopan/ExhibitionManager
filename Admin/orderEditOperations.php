<?php 
        
    include '../MAIN/Dbconfig.php';

    $biller_id = $_COOKIE['custidcookie'];

    $biller_name = $_COOKIE['custnamecookie'];

    $cartTable = $biller_id.'_'.$biller_name ;
    //Add item
    if(isset($_POST['barcode'])){

 
        $itemBarcode = $_POST['barcode'];
        $itemQty = $_POST['quantity'];
        $ordId = $_POST['ordId'];
        $find_itemId = mysqli_query($con, "SELECT item_id FROM item_master WHERE item_barcode = '$itemBarcode'");
        foreach($find_itemId as $items){
            $itemID = $items['item_id'];
        }

        if( $itemID > 0){
            $check_query = mysqli_query($con, "SELECT * FROM order_items WHERE ord_itemId = '$itemID' AND ord_id = '$ordId'");
            if(mysqli_num_rows($check_query) > 0){
            
                $update_Table = mysqli_query($con, "UPDATE order_items SET ord_itemQty = ord_itemQty + $itemQty WHERE ord_itemId = '$itemID' AND ord_id = '$ordId'");

                if($update_Table){
                    echo json_encode(array('addItem' => '3'));//updated
                }
                else{
                    echo json_encode(array('addItem' => '2'));//failed
                }
            }
            else{

                $find_maxId = mysqli_query($con, "SELECT MAX(main_id) FROM order_items ");
                foreach($find_maxId as $Maxids){
                    $max_id = $Maxids['MAX(main_id)'] + 1;
                }

                $add_Table =  mysqli_query($con, "INSERT INTO order_items (main_id,ord_id,ord_itemId,ord_itemQty) VALUES ('$max_id','$ordId','$itemID','$itemQty')");

                if($add_Table){
                    echo json_encode(array('addItem' => '1'));//success
                }
                else{
                    echo json_encode(array('addItem' => '2'));//failed
                }
            }
        }
        else{
            echo json_encode(array('addItem' => '2'));//failed
        }
        
        
        

    }

    
    //view barcode product details
    if(isset($_POST['itemBarcode'])){

        $fetchBarcode = $_POST['itemBarcode'];

        $find_itemDetails = mysqli_query($con, "SELECT item_name,item_weight,item_code,goldsmith_name FROM item_master i INNER JOIN goldsmith_master g ON i.item_manufacturer = g.goldsmith_id WHERE item_barcode = '$fetchBarcode'");
        if(mysqli_num_rows($find_itemDetails) > 0){
            foreach($find_itemDetails as $itemDetails){
                $prName = $itemDetails['item_name'];
                $prWeight = $itemDetails['item_weight'];
                $prCode = $itemDetails['item_code'];
                $prManufacturer = $itemDetails['goldsmith_name'];
            }
            echo json_encode(array('itemStatus' => 1,'itemName' => $prName,'itemWeight' => $prWeight,'itemCode' => $prCode, 'itemManufacturer' => $prManufacturer));
        }
        else{
            echo json_encode(array('itemStatus' => 0));
        }

    }


    //view product code product details
    if(isset($_POST['itemPrCode'])){

        $fetchPrcode = $_POST['itemPrCode'];

        $find_itemDetailsByCode = mysqli_query($con, "SELECT item_name,item_weight,item_barcode,goldsmith_name FROM item_master i INNER JOIN goldsmith_master g ON i.item_manufacturer = g.goldsmith_id WHERE item_code = '$fetchPrcode'");
        if(mysqli_num_rows($find_itemDetailsByCode) > 0){
            foreach($find_itemDetailsByCode as $itemDetailsByCode){
                $prCodeName = $itemDetailsByCode['item_name'];
                $prCodeWeight = $itemDetailsByCode['item_weight'];
                $prBarCode = $itemDetailsByCode['item_barcode'];
                $prCodeManufacturer = $itemDetailsByCode['goldsmith_name'];
            }
            echo json_encode(array('PrcodeStatus' => 1,'itemNameByCode' => $prCodeName,'itemWeightByCode' => $prCodeWeight, 'itemBarcodeByCode' => $prBarCode, 'itemManufactureByCode' => $prCodeManufacturer));
        }
        else{
            echo json_encode(array('PrcodeStatus' => 0));
        }

    }

    
    //delete item
    if(isset($_POST['delValue'])){
 
        $DeleteItem = $_POST['delValue'];
       
        $delete_query =  mysqli_query($con, "DELETE FROM order_items WHERE main_id = '$DeleteItem'");

        if($delete_query){
            echo json_encode(array('delStatus' => '1'));
        }
        else{
            echo json_encode(array('delStatus' => '0'));
        }
        
    }

    //delete order
    if(isset($_POST['delId'])){
 
        $DeleteOrder = $_POST['delId'];

        mysqli_autocommit($con, FALSE);
       
        $delete_sub =  mysqli_query($con, "DELETE FROM order_items WHERE ord_id = '$DeleteOrder'");

        if($delete_sub){

            $delete_Main = mysqli_query($con, "DELETE FROM order_table WHERE order_id = '$DeleteOrder'");

            if($delete_Main){
                mysqli_commit($con);
                echo json_encode(array('delOrder' => '1'));
            }
            else{
                mysqli_rollback($con);
                echo json_encode(array('delOrder' => '0'));
            }
        }
        else{
            mysqli_rollback($con);
            echo json_encode(array('delOrder' => '0'));
        }
        
    }



    //update qty
    if(isset($_POST['editValue'])){
        $updtId = $_POST['editID'];
        $updtQty = $_POST['editValue'];

        $edit_category = mysqli_query($con, "UPDATE order_items SET ord_itemQty = '$updtQty' WHERE main_id = '$updtId'");
        if($edit_category){
            
            echo json_encode(array('updtStatus' => 1));
        }
        else{
            echo json_encode(array('updtStatus' => 0));
        }
     
    }


    //update description
    if(isset($_POST['descValue'])){
        $descId = $_POST['descID'];
        $descValue = $_POST['descValue'];

        $update_desc = mysqli_query($con, "UPDATE order_items SET ord_itemDesc = '$descValue' WHERE main_id = '$descId'");
        if($update_desc){
            
            echo json_encode(array('updtDescStatus' => 1));
        }
        else{
            echo json_encode(array('updtDescStatus' => 0));
        }
     
    }



?>