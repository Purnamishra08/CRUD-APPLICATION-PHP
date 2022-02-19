<?php
$con = mysqli_connect('localhost', 'root', '', 'myproject');
?>
<?php
if (isset($_POST['name'])) {
    $name = $_POST['name'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];
    $address = $_POST['address'];

    $insert = mysqli_query($con, "INSERT INTO `ajaxform`(`name`, `phone`, `email`, `Address`) VALUES ('$name','$phone','$email','$address')");

    if ($insert) {
        $response = "done";
    } else {
        $response = "sorry";
    }
    echo $response;
exit;
}

if(isset($_POST['updtid'])){
   
    $aname = $_POST['uname'];
    $aphone = $_POST['uphone'];
    $aemail = $_POST['uemail'];
    $aaddress = $_POST['uaddress'];

    $update= mysqli_query($con,"UPDATE `ajaxform` SET `name`='$aname',`phone`='$aphone',`email`='$aemail',`Address`='$aaddress' WHERE id='".$_POST['updtid']."'");
    if ($update) {
        $response = "done";
    } else {
        $response = "sorry";
    }
    echo $response;
     exit;
    

}

if(isset($_POST['dltid']))
{
    $dltid=$_POST['dltid'];
    $delete=mysqli_query($con,"DELETE FROM ajaxform WHERE id=$dltid");
    if ($delete) {
        $response = "done";
    } else {
        $response = "sorry";
    }
    echo $response;
     exit;
}
?>
 