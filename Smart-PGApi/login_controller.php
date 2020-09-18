<?php error_reporting(E_ALL ^ E_NOTICE); ?>
<?php

include 'connection.php';

$data = (object) json_decode($input, true);
$message = array();
global $data;

$email = $data->email;
$password = $data->password;

$query = "SELECT  * FROM  registration WHERE email = '" . $email . "'  AND password = '" . $password . "' ";
$result = mysqli_query($con, $query);

if (mysqli_num_rows($result) > 0) {
    if ($result) {
        $message['status'] = "success";
    }
} elseif ($email == '' && $password == '') {
    $message['status'] = "UserName OR Passwaord IS Blank";
} else {
    $message['status'] = "error";
}
echo json_encode($message);

mysqli_free_result($result);
mysqli_close($con);
?>


