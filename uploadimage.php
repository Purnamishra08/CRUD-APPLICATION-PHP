<?php
$conn = mysqli_connect('localhost', 'root', '', 'myproject');
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"></script>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upload Image</title>
</head>

<body>
    <div class="jumbotron">
        <div class="container" id="a1">
            <form method="POST" enctype="multipart/form-data">
                <div>
                    <label>Name</label>
                    <input type="text" name="aname" id="aname" class="form-control"><br>
                    <span id="aname1"></span>
                </div>

                <div>
                    <label>phone</label>
                    <input type="number" name="aphone" id="aphone" class="form-control"><br>
                    <span id="aphone1"></span>
                </div>

                <div>
                    <label for="">Image</label>
                    <input type="file" name="img" id="img">
                </div>
                <input type="submit" name="submit" value="submit" class="btn btn-success">
                <span id="message" style="text-align: center;"></span>

            </form>
        </div>
    </div>
    <script>
        function dlt(val) {
            var dltid = val;
            $.ajax({
                type: 'POST',
                data: {dltid: dltid},
                url: 'uploadimage1.php',
                success: function(data) {
                    console.log(data);
                    if (data == "done") {
                        $("#message").html("<span style='color:green;'>Deleted successfully</span>");

                        setTimeout(function() {
                            window.location.reload();
                        }, 1000);
                    } else {
                        $("#message").html("<span style='color:red;'>Not Deleted</span>");
                    }
                }

            });
        }
    </script>
    

    <?php
    if (isset($_POST['submit'])) {
        $name = $_POST['aname'];
        $phone = $_POST['aphone'];
        $img = $_FILES['img']['name'];
        if (move_uploaded_file($_FILES['img']['tmp_name'], "images/" . $img)) {
            $insert = mysqli_query($conn, "INSERT INTO `imageupload`(`name`, `phone`, `image`) VALUES ('$name','$phone','$img')");
            if ($insert) {
                echo "Done";
                header('location:uploadimage.php');
            } else {
                echo "Not Done";
            }

            exit;
        }
    }
    ?>
    <?php
    $fetchquery = "SELECT * FROM imageupload";
    $fetchresult = mysqli_query($conn, $fetchquery);
    $rowcount = mysqli_num_rows($fetchresult);
    if ($rowcount != 0) {
    ?>
        <?php

        while ($data = mysqli_fetch_assoc($fetchresult)) {
        ?>

            <div class="container">
                <h2>Employee Data</h2>
                <div class="card" style="width:400px" style="display:inline-flex">
                    <img class="card-img-top" src="images/<?php echo $data['image']; ?>" alt="Card image" style="width:100%">
                    <div class="card-body">
                        <h4 class="card-title"><?php echo $data['name']; ?></h4>
                        <p class="card-text"><?php echo $data['phone']; ?></p>
                        <button class="btn btn-primary ">See Profile</button>
                        <button class="btn btn-danger" onclick="dlt(<?php echo $data['id']; ?>)">Delete Profile </button>
                    </div>
                </div>
            </div>

    <?php
        }
    }
    ?>

    <?php


    ?>
    
</body>

</html>