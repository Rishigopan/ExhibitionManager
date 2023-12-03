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
        $orderId  = $_POST['orderID'];

        mysqli_autocommit($con, FALSE);

            $add_customer = mysqli_query($con, "UPDATE order_table SET customer_name = '$custName',phone_number = '$phoneNumber',contact_person = '$contactPerson',location = '$location',branch = '$Branch',biller_id = '$biller_id' WHERE order_id = '$orderId'");

            if($add_customer){
                mysqli_commit($con);
                echo json_encode(array('status' => 1));
            }
            else{
                mysqli_rollback($con);
                echo json_encode(array('status' => 0));
            }

        }

        else{
            echo json_encode(array('status' => 3));
        }

        

    

  
  

   
    

   











    

?>