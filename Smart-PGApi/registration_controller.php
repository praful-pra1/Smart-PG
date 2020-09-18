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

//echo ($f_name);
//echo ($m_name);
//echo ($l_name);
//echo ($address);
//echo ($pincode);
//echo ($city);
//echo ($dob);
//echo ($gender);
//echo ($email);
//echo ($contact_no);
//echo ($password);

$query = "INSERT INTO `registration`(`f_name`, `m_name`, `l_name`, `address`, `pincode`, `city`, `dob`, `gender`, `email`, `contact_no`, `password`) "
        . "VALUES ('" . $f_name . "','" . $m_name . "','" . $l_name . "','" . $address . "','" . $pincode . "','" . $city . "','" . $dob . "','" . $gender . "','" . $email . "','" . $contact_no . "','" . $password . "')";
//$query = "INSERT INTO `registration`(`f_name`, `m_name`, `l_name`, `address`, `pincode`, `city`, `dob`, `gender`, `email`, `contact_no`, `password`, `profile_photo`) "
//        . "VALUES ('Ami','G','Soni','Ahmn','123456','ahd','1897/12/14','F','ami@gmail.com','987456123','123456','demo')";
echo $query;
$result = mysqli_query($con, $query);
echo $result;
if (!$result) {
    $flag = FALSE;
    die('invalid query');
} else {
    echo 'success';
}
mysqli_close($con);
?>
