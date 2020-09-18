<?php error_reporting(E_ALL ^ E_NOTICE); ?>
<?php

header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Credentials: true");
header("Access-Control-Allow-Methods: POST, GET, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type, Authorization, X-Requested-With");
header("Content-Type: application/json; charset=utf-8");
include 'connection.php';

$f_name = $_POST['f_name'];
$m_name = $_POST['m_name'];
$l_name = $_POST['l_name'];
$address = $_POST['address'];
$pincode = $_POST['pincode'];
$city = $_POST['city'];
$dob = $_POST['dob'];
$gender = $_POST['gender'];
$email = $_POST['email'];
$contact_no = $_POST['contact_no'];
$password = $_POST['password'];

$valid_formats = array("jpg", "jpeg", "png");
$max_file_size = 1024 * 1024 * 1; //1 MB
$targetPath = "";
$flagFileUpload = FALSE;
if (isset($_FILES["flUserPhoto"]["type"])) {
    $file_extension = strtolower(pathinfo($_FILES["flUserPhoto"]["name"], PATHINFO_EXTENSION));
    //($_FILES["flUserPhoto"]["type"] == "application/pdf") &&
    if (($_FILES["flUserPhoto"]["size"] <= $max_file_size) && in_array($file_extension, $valid_formats)) {
        if ($_FILES["flUserPhoto"]["error"] > 0) {
            $flag = FALSE;
            echo "Please enter valid photo: " . $_FILES["flUserPhoto"]["error"] . "<br/><br/>";
        } else {
            $sourcePath = $_FILES['flUserPhoto']['tmp_name']; // Storing source path of the file in a variable
            $targetPath = '../profilephoto/' . time() . '_' . uniqid() . '.' . $file_extension; // Target path where file is to be stored
            $fileResult = move_uploaded_file($sourcePath, $targetPath); // Moving Uploaded file    
            $flagFileUpload = TRUE;
        }
    }
}
$query = "INSERT INTO `registration`(`f_name`, `m_name`, `l_name`, `address`, `pincode`, `city`, `dob`, `gender`, `email`, `contact_no`, `password`, `profile_photo`) "
        . "VALUES ('" . $f_name . "','" . $m_name . "','" . $l_name . "','" . $address . "','" . $pincode . "','" . $city . "','" . $dob . "','" . $gender . "','" . $email . "','" . $contact_no . "','" . $password . "','" . $targetPath . "')";
//$query = "INSERT INTO `registration`(`f_name`, `m_name`, `l_name`, `address`, `pincode`, `city`, `dob`, `gender`, `email`, `contact_no`, `password`, `profile_photo`) "
//        . "VALUES ('Ami','G','Soni','Ahmn','123456','ahd','1897/12/14','F','ami@gmail.com','987456123','123456','demo')";

echo $query;
$result = mysqli_query($con, $query);
if (!$result) {
    $flag = FALSE;
    die('invalid query');
} else {
    echo 'success';
}
mysqli_close($con);
?>
