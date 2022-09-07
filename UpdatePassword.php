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
$passErr = "";
$boolPass = false;
// $email = $_REQUEST['email'];
?>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    if (isset($_POST['setPassword'])) {

        if (empty($_POST["newPass"]) && empty($_POST["confirmPass"])) {
            $passErr = "password is required";
        } else if ($_POST["newPass"] === $_POST["confirmPass"]) {
            // check if name only contains letters and whitespace
            if (strlen($_POST["newPass"]) < 50) {
                if (!preg_match("/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{8,}$/", $_POST["newPass"])) {
                    $passErr = "minimum 8 characters in length.At least one uppercase,one lowercase, one digit,one special character.";
                } else {
                    $password = test_input($_POST["newPass"]);
                    $boolPass = true;
                }
            } else {
                $passErr = "Password Length exceeds limit";
            }
        } else {
            $passErr = "Password doesn't match";
        }
    }

    if ($boolPass) {
        $time = date("Y-m-d H:i:s");
        $pass = md5($password);
        $email = $_POST['email'];
        $sql = mysqli_query($conn, "Update userstable set Password='$pass', updated_at='$time' where Email='$email'");
        if ($sql) {
            $last_id = mysqli_insert_id($conn);
            echo "Updated Successfully!";
            echo "Back to <a href='index.php?action=login'>Login</a>";
            exit;
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
            echo "Something went wrong";
        }
        $boolpass = false;
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
                        <td>Email:</td>
                        <td>
                            <input type='email' name='email' value=<?php echo $_REQUEST['email']; ?> />
                        </td>
                    </tr>
                    <tr>
                        <td>Enter your new Password:</td>
                        <td><input type='text' name='newPass' /></td>
                    </tr>
                    <tr></tr>
                    <tr>
                        <td>Confirm your Password:</td>
                        <td><input type='text' name='confirmPass' /></td>
                    </tr>
                    <tr>
                        <td><span class="error">* <?php echo $passErr; ?></span></td>
                    </tr>
                    <tr>
                        <td><input type='submit' name='setPassword' value='Update Password' /></td>
                    </tr>
                </table>
            </form>
</body>

</html>