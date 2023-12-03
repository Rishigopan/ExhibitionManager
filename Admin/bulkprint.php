<?php error_reporting(E_ALL);

include '../MAIN/Dbconfig.php';

    $val = '';

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

    
    /*
    $val = '
    ^XA
    ^MMT
    ^PW607
    ^LL0130
    ^LS0
    ^BY2,3,45^FT25,166^BCN,,Y,N
    ^FD'.$itemBarcode.'^FS
    ^FT25,115^A0N,15,20^FH\^FD'.$itemName.'^FS
    ^FT25,80^A0N,20,18^FH\^FDIW : '.$itemWeight.'^FS
    ^FT25,57^A0N,20,18^FH\^FDIC : '.$itemCode.'^FS
    ^FT25,34^A0N,20,18^FH\^FDIM : '.$itemManufacturer.'^FS
    ^PQ1,0,1,Y^XZ
    ';
    */


    echo $val;
    
}

if(isset($_POST['checkbox'])){

    $checkbox = $_POST['checkbox'];

    foreach($checkbox as $ids){
        $itemId = $ids;
        $fetchItemDetails = mysqli_query($con, "SELECT SUBSTRING(i.item_barcode,10,length(i.item_barcode)) AS itembarcode,i.item_weight,i.item_name,i.item_code,g.goldsmith_name,i.item_barcode FROM item_master i INNER JOIN goldsmith_master g ON i.item_manufacturer = g.goldsmith_id WHERE i.item_id = '$itemId'");
        foreach($fetchItemDetails as $ItemDetails){
        
        }
        
        $itemWeight = number_format($ItemDetails['item_weight']);
        $itemName = $ItemDetails['item_name'];
        $itemCode = $ItemDetails['item_code'];
        //$itemManufacturer = $ItemDetails['goldsmith_name'];
        $itemBarcode = $ItemDetails['itembarcode'];
        
        
        printBarcode($itemName,$itemWeight,$itemCode,$itemBarcode);

    }
}




?>
