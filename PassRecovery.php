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
$mailErr = "";
$boolmail = false;
?>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['recover'])) {

        if (empty($_POST["email"])) {
            $mailErr = "Email is required";
        } else {
            // check if e-mail address is well-formed
            if (!filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) {
                $mailErr = "Invalid email format";
            } else if (strlen($_POST["email"]) >= 50) {
                $mailErr = "Email too long";
            } else {
                $email = test_input($_POST["email"]);
                $boolmail = true;
            }
        }
        if ($boolmail) {
            $email = test_input($_POST['email']);
            $query = mysqli_query($conn, "select * from `userstable` where email='$email'");
            if (mysqli_num_rows($query) == 0) {
                $_SESSION['Msg'] = "Email not Found!";
            } else {

                $row = mysqli_fetch_assoc($query);
                $fetch_email = $row['Email'];
                $email_id = $row['Id'];
                if ($email == $fetch_email) {
                    $path = "<a href='UpdatePassword.php?email=$fetch_email'>Recover your password from here</a>";
                    echo "<br>", $path, "<br>";
                    exit;
                } else {
                    echo 'invalid email';
                }
            }
        }
    }
}

function test_input($data)
{
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

?>
<!DOCTYPE HTML>
<html>

<head>
    <style type="text/css">
        input {
            border: 1px solid green;
            border-radius: 2px;
        }

        h1 {
            color: darkblue;
            font-size: 18px;
            text-align: center;
        }
    </style>
</head>

<body>
    <h1>Forgot Password<h1>
            <form method='post' action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                <table cellspacing='5' align='center'>
                    <tr>
                        <td>Enter your Email:</td>
                        <td><input type='text' name='email' /></td>
                        <td>
                            <span class="error">* <?php echo $mailErr; ?></span>
                        </td>
                    </tr>
                    <tr></tr>
                    <tr>
                        <td></td>
                        <td><input type='submit' name='recover' value='Recover' /></td>
                    </tr>
                </table>
            </form>
</body>

</html>