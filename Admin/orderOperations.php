<?php 

        
    include '../MAIN/Dbconfig.php';

    $biller_id = $_COOKIE['custidcookie'];

    $biller_name = $_COOKIE['custnamecookie'];

    $cartTable = $biller_id.'_'.$biller_name ;
    //Add item
    if(isset($_POST['barcode'])){

 
        $itemBarcode = $_POST['barcode'];
        $itemQty = $_POST['quantity'];

        $find_itemId = mysqli_query($con, "SELECT item_id FROM item_master WHERE item_barcode = '$itemBarcode'");
        foreach($find_itemId as $items){
            $itemID = $items['item_id'];
        }

        if( $itemID > 0){
            $check_query = mysqli_query($con, "SELECT * FROM $cartTable WHERE item_id = '$itemID'");
            if(mysqli_num_rows($check_query) > 0){
            
                $update_Table = mysqli_query($con, "UPDATE $cartTable SET item_qty = item_qty + $itemQty WHERE item_id = '$itemID'");

                if($update_Table){
                    echo json_encode(array('addItem' => '3'));//updated
                }
                else{
                    echo json_encode(array('addItem' => '2'));//failed
                }
            }
            else{

                $find_maxId = mysqli_query($con, "SELECT MAX(id) FROM $cartTable ");
                foreach($find_maxId as $Maxids){
                    $max_id = $Maxids['MAX(id)'] + 1;
                }

                $add_Table =  mysqli_query($con, "INSERT INTO $cartTable (id,item_id,item_qty) VALUES ('$max_id','$itemID','$itemQty')");

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
       
        $delete_query =  mysqli_query($con, "DELETE FROM $cartTable WHERE id = '$DeleteItem'");

        if($delete_query){
            echo json_encode(array('delStatus' => '1'));
        }
        else{
            echo json_encode(array('delStatus' => '0'));
        }
        
    }


    //delete all items
    if(isset($_POST['delAll'])){

        //$delAll = $_POST['delAll'];

        $delAllItems = mysqli_query($con, "DELETE FROM $cartTable ");
        if($delAllItems){
            echo json_encode(array('delAllStatus' => 1));
        }
        else{
            echo json_encode(array('delAllStatus' => 0));
        }

    }
    

    //update qty
    if(isset($_POST['editValue'])){
        $updtId = $_POST['editID'];
        $updtQty = $_POST['editValue'];

        $edit_category = mysqli_query($con, "UPDATE $cartTable SET item_qty = '$updtQty' WHERE id = '$updtId'");
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

        $update_desc = mysqli_query($con, "UPDATE $cartTable SET item_desc = '$descValue' WHERE id = '$descId'");
        if($update_desc){
            
            echo json_encode(array('updtDescStatus' => 1));
        }
        else{
            echo json_encode(array('updtDescStatus' => 0));
        }
     
    }



?>