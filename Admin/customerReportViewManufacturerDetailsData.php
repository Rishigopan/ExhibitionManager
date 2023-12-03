<?php



if (isset($_COOKIE['custtypecookie']) && isset($_COOKIE['custidcookie'])) {

    if ($_COOKIE['custtypecookie'] == 'SuperAdmin' || $_COOKIE['custtypecookie'] == 'Admin' || $_COOKIE['custtypecookie'] == 'Executive') {
    } else {
        header("location:../login.php");
    }
} else {

    header("location:../login.php");
}

include '../MAIN/Dbconfig.php';


if(isset($_POST['ManufacturerOrderId'])){

    $ManufacturerOrderId = $_POST['ManufacturerOrderId'];
?>
        <div class="row my-4">
            <div class="col-lg-3">
                <label for="manufacturerSelect" class="form-label"> <strong>Manufacturer</strong>  </label>
                <select name="" id="manufacturerSelect" class="form-select"  data-value="<?php echo $ManufacturerOrderId ?>"> 
                            <option value="">Choose...</option>
                        <?php
                            $find_AllManufacturers = mysqli_query($con, "SELECT g.goldsmith_name,g.goldsmith_id FROM order_items oi INNER JOIN item_master i ON oi.ord_itemId = i.item_id  INNER JOIN goldsmith_master g ON i.item_manufacturer = g.goldsmith_id WHERE oi.ord_id = '$ManufacturerOrderId' GROUP by g.goldsmith_id ");
                            foreach($find_AllManufacturers  as $manufacturers){
                                echo '<option value='.$manufacturers['goldsmith_id'].' >'.$manufacturers['goldsmith_name'].'</option>';
                            }
                        ?>
                </select>
            </div>

            <div class="col-lg-9">
                <form action="" id="all_itemsForm">
                    <div class="text-end">
                        <button type="submit" id="SubmitButton" class="btn btn_submit mb-3">Print All</button>
                    </div>
                    <div class="table-responsive mt-lg-0 mt-3" id="table_container">
                        <input type="text" name="manufactureFormId" id="ManufacturerFormId" hidden>
                        <input type="text" name="orderFormId" id="OrderFormId" hidden>
                        <table class="table table-striped" id="viewDetailTable">
                            <thead>
                                <tr>
                                    <th> <input type="checkbox" class="form-check-input" id="checkall"> </th>
                                    <th>Sl. No</th>
                                    <th>Code</th>
                                    <th>Quantity</th>
                                </tr>
                            </thead>
                            <tbody id="display_allitems">

                            </tbody>
                        
                        </table>
                    </div>
                </form>
            </div>
        </div>

        <?php
    
}

?>

<script>
    $("#checkall").click(function(){
        $('input:checkbox').not(this).prop('checked', this.checked);
    });
</script>