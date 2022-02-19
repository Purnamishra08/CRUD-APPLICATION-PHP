<?php
$con = mysqli_connect('localhost', 'root', '', 'myproject');
?>
 <?php
if (isset($_POST['editid'])) {
    $up_name = $_POST['editid'];
    $update = mysqli_query($con, "select * from ajaxform where id='$up_name' ");
    // $update= mysqli_query($con,"UPDATE ajxform SET name='$up_name', email='$up_email', phone='$up_phone', address='$up_add' where id='$editid'");
    $view = mysqli_fetch_assoc($update);
    echo $form = '<form>
    <form method="POST">
                <div>
                    <label>Name</label>
                    <input type="text" name="aname" id="aname" value="' . $view['name'] . '" class="form-control"><br>
                    <span id="aname1"></span>
                </div>

                <div>
                    <label>phone</label>
                    <input type="number" name="aphone" id="aphone" value="' . $view['phone'] . '" class="form-control"><br>
                    <span id="aphone1"></span>
                </div>

                <div>
                    <label>email</label>
                    <input type="email" name="aemail" id="aemail"  value="' . $view['email'] . '" class="form-control"><br>
                    <span id="aemail1"></span>
                </div>

                <div>
                    <label>address</label>
                    <input type="text" name="aaddress" id="aaddress"  value="' . $view['Address'] . '" class="form-control"><br>
                    <span id="aaddress1"></span>
                </div>
                <input type="button" name="submit" value="Update" onclick="myupdate('.$view['id'].')" class="btn btn-success">
                <span id="message" style="text-align: center;"></span>
            </form>
    
    </form>';
    exit;
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ajax test</title>
</head>

<body>
    <div class="jumbotron">
        <div class="container" id="a1">
            <form method="POST">
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
                    <label>email</label>
                    <input type="email" name="aemail" id="aemail" class="form-control"><br>
                    <span id="aemail1"></span>
                </div>

                <div>
                    <label>address</label>
                    <input type="text" name="aaddress" id="aaddress" class="form-control"><br>
                    <span id="aaddress1"></span>
                </div>
                <input type="button" name="submit" value="submit" onclick="myclick()" class="btn btn-success">
                <span id="message" style="text-align: center;"></span>
                
            </form>
        </div>
    </div>
    <?php
    $fetchquery = "select * from ajaxform";
    $fetchresult = mysqli_query($con, $fetchquery);
    $rowcount = mysqli_num_rows($fetchresult);

    ?>

    <div class="jumbotron">
        <div class="container" id="a2">
            <table class="table table-light table-bordered">
                <tr>
                    <th style="background-color: yellowgreen">ID</th>
                    <th style="background-color: yellowgreen">Name</th>
                    <th style="background-color: yellowgreen">Phone</th>
                    <th style="background-color: yellowgreen">Email</th>
                    <th style="background-color: yellowgreen">Address</th>
                    <th style="background-color: yellowgreen; text-align:center;" colspan="3">ACTION</th>
                </tr>
                <?php
                $i = 1;
                while ($data = mysqli_fetch_assoc($fetchresult)) {
                ?>
                    <tr>
                        <td><?php echo $i;  ?></td>
                        <td><?php echo $data['name']; ?></td>
                        <td><?php echo $data['phone']; ?></td>
                        <td><?php echo $data['email']; ?></td>
                        <td><?php echo $data['Address']; ?></td>
                        <td> <button class="btn btn-primary" onclick="edit(<?php echo $data['id']; ?>)">EDIT</button>

                            <button class="btn btn-danger" onclick="dlt(<?php echo $data['id']; ?>)">DELETE </button>
                            
                        </td>
                       

                    </tr>
                <?php
                    $i++;
                }
                ?>
            </table>
        </div>
    </div>




    <script>
        function myclick() {
            var name = document.getElementById("aname").value;
            var phone = document.getElementById("aphone").value;
            var email = document.getElementById("aemail").value;
            var address = document.getElementById("aaddress").value;
            var ab = bc = cd = ef = 0;


            if (name == "") {
                document.getElementById('aname1').style.color = "red";
                document.getElementById('aname1').innerHTML = "name can't blank";

            } else {
                document.getElementById('aname1').innerHTML = "";
                ab = 1;

            }

            if (phone == "") {
                document.getElementById('aphone1').style.color = "red";
                document.getElementById('aphone1').innerHTML = "number can't blank";

            } else {
                document.getElementById('aphone1').innerHTML = "";
                bc = 1;

            }
            if (email == "") {
                document.getElementById('aemail1').style.color = "red";
                document.getElementById('aemail1').innerHTML = "email can't blank";

            } else {
                document.getElementById('aemail1').innerHTML = "";
                cd = 1;

            }
            if (address == "") {
                document.getElementById('aaddress1').style.color = "red";
                document.getElementById('aaddress1').innerHTML = "address can't blank";

            } else {
                document.getElementById('aaddress1').innerHTML = "";
                ef = 1;

            }
            if (ab != 0 && bc != 0 && cd != 0 && ef != 0) {
                $.ajax({
                    type: 'POST',
                    data: {
                        name: name,
                        phone: phone,
                        email: email,
                        address: address
                    },
                    url: 'indexajax.php',
                    success: function(data) {
                        console.log(data);
                        if (data == "done") {
                            $("#message").html("<span style='color:green;'>data inserted successfully</span>");

                            setTimeout(function() {
                                window.location.reload();
                            }, 1000);
                        } else {
                            $("#message").html("<span style='color:red;'>data not inserted</span>");
                        }

                    }


                });
            }
        }
 ////////////////edit functio////////////////
        function edit(val) {
            //    alert(val); 
            var editid = val;
            $.ajax({
                type: 'POST',
                data: {
                    editid: editid
                },
                url: 'ajax.php',
                success: function(data) {
                    $('#a1').html(data);
                    $('#a2').hide();
                }

            });

        }
//////////////////////////Update Function ///////////////////////////////////////
        function myupdate(val) {
            var updtid=val;
            var uname = document.getElementById("aname").value;
            var uphone = document.getElementById("aphone").value;
            var uemail = document.getElementById("aemail").value;
            var uaddress = document.getElementById("aaddress").value;
            var ab = bc = cd = ef = 0;


            if (uname == "") {
                document.getElementById('aname1').style.color = "red";
                document.getElementById('aname1').innerHTML = "name can't blank";

            } else {
                document.getElementById('aname1').innerHTML = "";
                ab = 1;

            }

            if (uphone == "") {
                document.getElementById('aphone1').style.color = "red";
                document.getElementById('aphone1').innerHTML = "number can't blank";

            } else {
                document.getElementById('aphone1').innerHTML = "";
                bc = 1;

            }
            if (uemail == "") {
                document.getElementById('aemail1').style.color = "red";
                document.getElementById('aemail1').innerHTML = "email can't blank";

            } else {
                document.getElementById('aemail1').innerHTML = "";
                cd = 1;

            }
            if (uaddress == "") {
                document.getElementById('aaddress1').style.color = "red";
                document.getElementById('aaddress1').innerHTML = "address can't blank";

            } else {
                document.getElementById('aaddress1').innerHTML = "";
                ef = 1;

            }
            if (ab != 0 && bc != 0 && cd != 0 && ef != 0) {
                $.ajax({
                    type: 'POST',
                    data: {
                        uname: uname,
                        uphone: uphone,
                        uemail: uemail,
                        uaddress: uaddress,updtid:updtid
                    },
                    url: 'indexajax.php',
                    success: function(data) {
                        console.log(data);
                        if (data == "done") {
                            $("#message").html("<span style='color:green;'>Data Update successfully</span>");

                            setTimeout(function() {
                                window.location.reload();
                            }, 1000);
                        } else {
                            $("#message").html("<span style='color:red;'>Couldnot upadte</span>");
                        }

                    }


                });
            }
        }

        /////////////////////DELETE/////////////////////////////
        function dlt(valu){
            var dltid= valu;

            $.ajax({
                type: 'POST',
                data: {dltid:dltid},
                url: 'indexajax.php',
                success: function(data){
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


</body>

</html>