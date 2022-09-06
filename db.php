<?php
$conn = mysqli_connect('localhost', 'root', '', 'nacter');
$msg = "";
if (!$conn) {
    $msg = "Server not found";
} else {
    $msg = "1";
}
if (isset($_POST['submit'])) {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $email = $_POST['email'];
    $address = $_POST['address'];
    $contact = $_POST['contact'];
    $sq = "INSERT INTO person VALUES('$id','$name','$email','$address','$contact')";
    if ($msg == 1) {
        $query = mysqli_query($conn, $sq);
        if (mysqli_affected_rows($conn) > 0) {
            $msg = "Data inserted successfully";
        } else {
            $msg = "Data inserted failed";
        }
    }
}
if (isset($_POST['update'])) {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $email = $_POST['email'];
    $address = $_POST['address'];
    $contact = $_POST['contact'];
    $q = "update person set `Name`='$name',`Email`='$email',`Address`='$address',`Contact`='$contact' where `id`='$id'";
    if ($msg == 1) {
        $s = mysqli_query($conn, $q);
        if (mysqli_affected_rows($conn) > 0) {
            $msg = "Data updated successfully";
        } else {
            $msg = "Data update failed ";
        }
    }
}
if (isset($_POST['delete'])) {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $m = "delete from person where `id`='$id' and `Name`='$name'";
    if ($msg == 1) {
        $n = mysqli_query($conn, $m);
        if (mysqli_affected_rows($conn) > 0) {
            $msg = "Data deleted successfully";
        } else {
            $msg = "Data deleted failed";
        }
    }
}
function showData()
{
    global $conn;
    $qu = "select * from person order by `id`asc";
    $result = mysqli_query($conn, $qu);
?>
    <table align="center" border="1" width="100%" cellspacing="0" cellspacing="0">
        <caption>
            <h3>All Information</h3>
        </caption>
        <tr>
            <th align="center">Id</th>
            <th align="center">Name</th>
            <th align="center">Email</th>
            <th align="center">Address</th>
            <th align="center">Contact</th>
        </tr>
    <?php
    while ($row = mysqli_fetch_row($result)) {
        // echo "<br>Id:" . $row[0] . ",Name:" . $row[1] . ",Email:" . $row[2] . ",Address:" . $row[3] . ",Contact:" . $row[4];
        echo "<tr>
        <td align='center'>" . $row[0] . "</td>
        <td align='center'>" . $row[1] . "</td>
        <td align='center'>" . $row[2] . "</td>
        <td align='center'>" . $row[3] . "</td>
        <td align='center'>" . $row[4] . "</td>
        </tr>";
    }
    echo "</table>";
}
    ?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>CRUD</title>
    </head>

    <body>
        <form action="db.php" method="post">

            <table align="center" border="1" width="50%" cellspacing="0" cellspacing="0">
                <caption>
                    <h3>Information</h3>
                </caption>
                <tr>
                    <td>Id:</td>
                    <td align="left"><input type="text" name="id"></td>
                </tr>
                <tr>
                    <td>Name:</td>
                    <td align="left"><input type="text" name="name" placeholder="Enter your name"></td>
                </tr>
                <tr>
                    <td>Email:</td>
                    <td align="left"><input type="text" name="email" placeholder="Enter your email"></td>
                </tr>
                <tr>
                    <td>Address:</td>
                    <td align="left"><input type="text" name="address" placeholder="Enter your address"></td>
                </tr>
                <tr>
                    <td>Contact:</td>
                    <td align="left"><input type="text" name="contact" placeholder="Enter your contact number"></td>
                </tr>
                <tr>
                    <td colspan="3">
                        <input type="submit" name="submit" value="Insert">
                        <input type="submit" name="update" value="Update">
                        <input type="submit" name="delete" value="Delete">
                        <input type="submit" name="show" value="Show">
                    </td>
                </tr>
                <tr>
                    <td colspan="3" align="center"><?php if (isset($_POST['submit']) || isset($_POST['update']) || isset($_POST['delete'])) {
                                                        echo "<script>alert('$msg')</script>";
                                                        showData();
                                                    }
                                                    if (isset($_POST['show'])) {
                                                        if ($msg == 1) {
                                                            showData();
                                                        }
                                                    }
                                                    ?>
                    </td>
                </tr>
            </table>
        </form>
    </body>

    </html>
    <?php

    ?>