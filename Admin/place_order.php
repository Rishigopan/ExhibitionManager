<?php 
        
    include '../MAIN/Dbconfig.php';

    $biller_id = $_COOKIE['custidcookie'];

    $biller_name = $_COOKIE['custnamecookie'];

    $cartTable = $biller_id.'_'.$biller_name ;

    //Place order
    if(isset($_POST['customer_name'])){

 
        $custName = $_POST['customer_name'];
        $phoneNumber = $_POST['phone'];
        $contactPerson = $_POST['contact_person'];
        $location = $_POST['location'];
        $Branch = $_POST['branch'];
        

        $checkCartEmpty = mysqli_query($con, "SELECT * FROM $cartTable");
        if(mysqli_num_rows($checkCartEmpty) > 0){
            mysqli_autocommit($con, FALSE);

            $find_already = mysqli_query($con, "SELECT * FROM order_table WHERE customer_name = '$custName' AND phone_number = '$phoneNumber'");
            if(mysqli_num_rows($find_already) > 0){

                $find_order = mysqli_query($con, "SELECT order_id FROM order_table WHERE customer_name = '$custName' AND phone_number = '$phoneNumber'");
                foreach($find_order as $findId){
                    $oldId = $findId['order_id'];
                }
                $Add_items = mysqli_query($con, "SELECT item_id,item_qty,item_desc FROM $cartTable");
                foreach($Add_items as $items){
                    $itemId = $items['item_id'];
                    $itemQty = $items['item_qty'];
                    $itemDesc = $items['item_desc'];
                    $add_query = mysqli_query($con, "INSERT INTO order_items (ord_id,ord_itemId,ord_itemQty,ord_itemDesc) VALUES('$oldId','$itemId','$itemQty','$itemDesc')");

                }
                if($add_query){
                    $del_all = mysqli_query($con, "DELETE FROM $cartTable");
                    if($del_all){
                        mysqli_commit($con);
                        echo json_encode(array('status' => 1));
                    }
                    else{
                        mysqli_rollback($con);
                        echo json_encode(array('status' => 0));
                    } 
                }
                else{
                    mysqli_rollback($con);
                    echo json_encode(array('status' => 0));
                }

            }
            else{

                $find_max = mysqli_query($con, "SELECT MAX(order_id) FROM order_table");
                foreach($find_max as $maxs){
                    $maxId = $maxs['MAX(order_id)'] + 1;
                }

                $add_customer = mysqli_query($con, "INSERT INTO order_table (order_id,customer_name,phone_number,contact_person,location,branch,biller_id) VALUES ('$maxId','$custName','$phoneNumber','$contactPerson','$location','$Branch','$biller_id')");

                if($add_customer){
                    $Add_items = mysqli_query($con, "SELECT item_id,item_qty,item_desc FROM $cartTable");
                    foreach($Add_items as $items){
                        $itemId = $items['item_id'];
                        $itemQty = $items['item_qty'];
                        $itemDesc = $items['item_desc'];
                        $add_query = mysqli_query($con, "INSERT INTO order_items (ord_id,ord_itemId,ord_itemQty,ord_itemDesc) VALUES('$maxId','$itemId','$itemQty','$itemDesc')");

                    }

                    if($add_query){
                        $del_all = mysqli_query($con, "DELETE FROM $cartTable");
                        if($del_all){
                            mysqli_commit($con);
                            echo json_encode(array('status' => 1));
                        }
                        else{
                            mysqli_rollback($con);
                            echo json_encode(array('status' => 0));
                        } 
                    }
                    else{
                        mysqli_rollback($con);
                        echo json_encode(array('status' => 0));
                    }
                }
                else{
                    mysqli_rollback($con);
                    echo json_encode(array('status' => 0));
                }

            }
        }

        else{
            echo json_encode(array('status' => 3));
        }

        

    
    }

  
  

   
    

   











    

?>