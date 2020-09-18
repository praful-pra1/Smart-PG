<?php error_reporting (E_ALL ^ E_NOTICE); ?>
<?php 
include 'connection.php';

$input = file_get_contents('php://input'); 
$data =(object) json_decode($input, true); 
$message = array();
   global $data;
   
$f_name = $data->f_name;
$m_name = $data->m_name;
$l_name = $data->l_name;
$address = $data->address;
$pincode = $data->pincode;
$city = $data->city;
$dob = $data->dob;
$gender = $data->gender;
$email = $data->email;
$contact_no = $data->contact_no;
$password = $data->password;

//if($data->action == "insert"){

    
//}

 $query = "INSERT INTO `registration`(`f_name`, `m_name`, `l_name`, `address`, `pincode`, `city`, `dob`, `gender`, `email`, `contact_no`, `password`) "
         . "VALUES ('$f_name','$m_name','$l_name','$address','$pincode','$city','$dob','$gender','$email','$contact_no','$password')";
// $query = "INSERT INTO `registration`(`f_name`, `m_name`, `l_name`, `address`, `pincode`, `city`, `dob`, `gender`, `email`, `contact_no`, `password`) "
//        . "VALUES ('ami','g','soni','ahmedabad','123456','ahd','1212/12/12','f','ami@g.com','789456130','ami')";
  //echo $query;
$result = mysqli_query($con, $query);
if ($query) {	
   $message['status'] = "success"; 
   }
else{
    $message['status'] = "error";
	}
//echo $query;
  echo json_encode($message);
 
mysqli_close($con);


?>