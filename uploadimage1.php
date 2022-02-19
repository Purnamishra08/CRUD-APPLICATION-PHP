<?php
$conn = mysqli_connect('localhost', 'root', '', 'myproject');
?>
<?php
    if (isset($_POST['dltid'])) {
        $dltid = $_POST['dltid'];
        $delete = mysqli_query($conn, "DELETE FROM imageupload WHERE id=$dltid");
        if ($delete) {
            $response = "done";
        } else {
            $response = "sorry";
        }
        echo $response;
        exit;
    }
    ?>