<?php



if (isset($_COOKIE['custtypecookie']) && isset($_COOKIE['custidcookie'])) {

    if ($_COOKIE['custtypecookie'] == 'SuperAdmin' || $_COOKIE['custtypecookie'] == 'Admin') {
    } else {
        header("location:../login.php");
    }
} else {

    header("location:../login.php");
}

include '../MAIN/Dbconfig.php';


$find_data = mysqli_query($con, "SELECT * FROM item_master i INNER JOIN goldsmith_master g ON i.item_manufacturer = g.goldsmith_id INNER JOIN category_master c ON i.item_category = c.category_id");
while ($dataRow = mysqli_fetch_assoc($find_data)) {
    $rows[] = $dataRow;
}

$dataset = array(
    "data" => $rows
);

echo json_encode($dataset);
