<?php

include '../MAIN/Dbconfig.php';



if(isset($_POST['printValue'])){


    function printBarcode($itemName,$itemWeight,$itemCode,$itemBarcode){

        $val = '~n|
        ~M0500|
        ~KcLW0363;|
        ~O0220|
        ~d|
        ~L|
        D11|
        ySPM|
        A2|
        1911A1000090025'.$itemWeight.'GM|
        1911A1000420025'.$itemName.'|
        1e4202700270143'.$itemBarcode.'|
        1911A0800130157'.$itemBarcode.'|
        1911A1000260025'.$itemCode.'|
        Q0001|
        E|
        ';
    
        
        echo json_encode(array('status' => 1, 'value' => $val ));
    }


    $itemId = $_POST['printValue'];

    $fetchItemDetails = mysqli_query($con, "SELECT SUBSTRING(i.item_barcode,10,length(i.item_barcode)) AS itembarcode, i.item_weight,i.item_name,i.item_code,g.goldsmith_name,i.item_barcode FROM item_master i INNER JOIN goldsmith_master g ON i.item_manufacturer = g.goldsmith_id WHERE i.item_id = '$itemId'");
    foreach($fetchItemDetails as $ItemDetails){
    
    }
    
    $itemWeight = number_format($ItemDetails['item_weight']);
    $itemName = $ItemDetails['item_name'];
    $itemCode = $ItemDetails['item_code'];
    //$itemManufacturer = $ItemDetails['goldsmith_name'];
    $itemBarcode = $ItemDetails['itembarcode'];
    
    
    printBarcode($itemName,$itemWeight,$itemCode,$itemBarcode);
    
    
}




?>
