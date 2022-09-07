<?php
session_start();
// Enter your host name, database username, password, and database name.
// If you have not set database password on localhost then set empty.
$conn = mysqli_connect("localhost", "root", "", "phptask");
// Check connection
if (mysqli_connect_errno()) {
    echo "Failed to connect to MySQL: " . mysqli_connect_error() . "<br>";
} else {
    echo "connection successfull <br>";
}
?>
<!doctype html>
<html lang="en">

<head>
    <title>Email Verification</title>
</head>

<body>
    <?php
    if (isset($_GET['email'])) {
        $email = $_GET['email'];
        $query = mysqli_query($conn, "SELECT * FROM `userstable` WHERE `email`='" . $email . "';");
        $d = '1';
        if (mysqli_num_rows($query) > 0) {
            $row = mysqli_fetch_array($query);
            if ($row['Email_verified_at'] == '0') {
                mysqli_query($conn, "UPDATE userstable set email_verified_at ='" . $d . "' WHERE email='" . $email . "'");
                $msg = "Congratulations! Your email has been verified.";
                $_SESSION['message'] = "Congratulations! Your email has been verified.";
                header('location: index.php?action=login');
            } else {
                $msg = "You have already verified your account.";
            }
        } else {
            $msg = "This email has been not registered.";
        }
    } else {
        $msg = "Danger! Your something goes to wrong.";
    }
    ?>
    <div class="container mt-3">
        <div class="card">
            <div class="card-header text-center">
                User Account Activation by Email Verification using PHP
            </div>
            <div class="card-body">
                <p><?php echo $msg; ?></p>
            </div>
        </div>
    </div>
</body>

</html>