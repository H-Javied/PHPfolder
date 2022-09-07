<?php
session_start();
// Enter your host name, database username, password, and database name.
// If you have not set database password on localhost then set empty.
$con = mysqli_connect("localhost", "root", "", "phptask");
// Check connection
if (mysqli_connect_errno()) {
    echo "Failed to connect to MySQL: " . mysqli_connect_error() . "<br>";
} else {
    echo "connection successfull <br>";
}
?>
<!DOCTYPE HTML>
<html>

<head>
    <title>PHPTask</title>
    <style>
        .error {
            color: #FF0000;
        }
    </style>
</head>

<body>
    <?php
    // define variables and set to empty values
    $fnameErr = $lnameErr = $emailErr = $phoneErr = $passwordErr = $roleErr = $countryIdErr = $cityIdErr = $zipcodeErr = $stateErr = $businessErr = $socialIdErr = $socialProviderErr = "";
    $fname = $lname = $email = $phone = $password = $role = $countryId = $cityId = $zipcode = $state = $business = $socialId = $socialProvider = $address1 = $address2 = "";
    $boolfname = $boollname = $boolemail = $boolphone = $boolpassword = $boolrole = $boolcountryId = $boolcityId = $boolzipcode = $boolstate = $boolbusiness = $boolsocialId = $boolsocialProvider = $booladdress1 = $booladdress2 = false;

    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        if (isset($_POST['submit'])) {
            if (empty($_POST["fname"])) {
                $fnameErr = "First Name is required";
            } else {
                // check if name only contains letters and whitespace
                if (!preg_match("/^[a-zA-Z-' ]*$/", $_POST["fname"])) {
                    $fnameErr = "Only letters and white space allowed";
                } else if (strlen($_POST["fname"]) >= 30) {
                    $fnameErr = "Name too long";
                } else {
                    $fname = test_input($_POST["fname"]);
                    $boolfname = true;
                }
            }

            if (empty($_POST["lname"])) {
                $lnameErr = "Last Name is required";
            } else {

                // check if name only contains letters and whitespace
                if (!preg_match("/^[a-zA-Z-' ]*$/", $_POST["lname"])) {
                    $lnameErr = "Only letters and white space allowed";
                } else if (strlen($_POST["lname"]) >= 30) {
                    $fnameErr = "Name too long";
                } else {
                    $lname = test_input($_POST["lname"]);
                    $boollname = true;
                }
            }

            if (empty($_POST["email"])) {
                $emailErr = "Email is required";
            } else {
                $email = test_input($_POST["email"]);
                // check if e-mail address is well-formed
                if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                    $emailErr = "Invalid email format";
                } else if (strlen($email) >= 50) {
                    $emailErr = "Email too long";
                } else {
                    $email = test_input($_POST["email"]);
                    $boolemail = true;
                }
            }

            if (empty($_POST["socialid"])) {
                // $emailErr = "Email is required";
                // $socialId = test_input($_POST["socialid"]);
            } else if (strlen($_POST["socialid"]) >= 30) {
                $socialIdErr = "ID too long";
            } else {
                $socialId = test_input($_POST["socialid"]);
                echo 'socialId: ', $socialId;
                $boolsocialId = true;
            }

            if (empty($_POST["socialprovider"])) {
                // $emailErr = "Email is required";
                // $socialProvider = test_input($_POST["socialprovider"]);
            } else if (strlen($_POST["socialprovider"]) >= 30) {
                $socialIdErr = "Value too long";
            } else {
                $socialProvider = test_input($_POST["socialprovider"]);
                $boolsocialProvider = true;
            }

            if (empty($_POST["phone"])) {
                $phoneErr = "phone is required";
            } else {
                // check if name only contains letters and whitespace
                if (!preg_match("/((\+*)((0[ -]*)*|((92 )*))((\d{12})+|(\d{10})+))|\d{5}([- ]*)\d{6}/", $_POST["phone"])) {
                    $phoneErr = "Enter number in the format +923*********";
                } else {
                    $phone = test_input($_POST["phone"]);
                    $boolphone = true;
                }
            }

            if (empty($_POST["passcode"])) {
                $passwordErr = "password is required";
            } else {
                // check if name only contains letters and whitespace
                if (strlen($_POST["passcode"]) < 50) {
                    if (!preg_match("/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{8,}$/", $_POST["passcode"])) {
                        $passwordErr = "minimum 8 characters in length.At least one uppercase,one lowercase, one digit,one special character.";
                    } else {
                        $password = test_input($_POST["passcode"]);
                        $boolpassword = true;
                    }
                } else {
                    $passwordErr = "Password Length exceeds limit";
                }
            }

            if (empty($_POST["role"])) {
                // $emailErr = "Email is required";
                // $role = test_input($_POST["role"]);
            } else if (strlen($_POST["role"]) >= 10) {
                $roleErr = "value too long";
            } else {
                $role = test_input($_POST["role"]);
                $boolrole = true;
            }

            if (empty($_POST["countryId"])) {
                // $emailErr = "Email is required";
                // $countryId = test_input($_POST["countryId"]);
            } else if (strlen($_POST["countryId"]) >= 15) {
                $countryIdErr = "Value too long";
            } else {
                $countryId = test_input($_POST["countryId"]);
                $boolcountryId = true;
            }

            if (empty($_POST["cityId"])) {
                // $emailErr = "Email is required";
                // $cityId = test_input($_POST["cityId"]);
            } else if (strlen($_POST["cityId"]) >= 15) {
                $countryIdErr = "Value too long";
            } else {
                $cityId = test_input($_POST["cityId"]);
                $boolcityId = true;
            }

            if (empty($_POST["zipcode"])) {
                // $emailErr = "Email is required";
                // $zipcode = test_input($_POST["zipcode"]);
            } else if (strlen($_POST["zipcode"]) >= 15) {
                $countryIdErr = "Value too long";
            } else {
                $zipcode = test_input($_POST["zipcode"]);
                $boolzipcode = true;
            }

            if (empty($_POST["state"])) {
                // $emailErr = "Email is required";
                // $state = test_input($_POST["state"]);
            } else if (strlen($_POST["state"]) >= 15) {
                $countryIdErr = "Value too long";
            } else {
                $state = test_input($_POST["state"]);
                $boolstate = true;
            }

            if (empty($_POST["business"])) {
                // $emailErr = "Email is required";
                // $nusiness = test_input($_POST["business"]);
            } else if (strlen($_POST["business"]) >= 50) {
                $countryIdErr = "Value too long";
            } else {
                $business = test_input($_POST["business"]);
                $boolbusiness = true;
            }

            if (empty($_POST["address1"])) {
                // $emailErr = "Email is required";
                // $address1 = test_input($_POST["address1"]);
            } else if (strlen($_POST["address1"]) >= 50) {
                $countryIdErr = "Value too long";
            } else {
                $address1 = test_input($_POST["address1"]);
                $booladdress1 = true;
            }


            if (empty($_POST["address2"])) {
                // $emailErr = "Email is required";
                // $address2 = test_input($_POST["address2"]);
            } else if (strlen($_POST["address2"]) >= 50) {
                $countryIdErr = "Value too long";
            } else {
                $address2 = test_input($_POST["address2"]);
                $booladdress2 = true;
            }

            if ($boolfname && $boolemail && $boolphone && $boolpassword) {
                $query = mysqli_query($con, "SELECT * FROM userstable where email='$email' or phone='$phone'");
                if (mysqli_num_rows($query) == 0) {
                    if ($boolsocialId && $boolsocialProvider) {
                        $query2 = mysqli_query($con, "SELECT * FROM usersocialaccounts where social_id='$socialId'");
                        if (mysqli_num_rows($query2) == 0) {
                            $time = date("Y-m-d H:i:s");
                            $pass = md5($password);
                            $sql = "INSERT INTO userstable 
                            (FirstName, LastName,email,password,phone,Role,CountryId,CityId,zipcode,state,Business,address1,address2,created_at,updated_at)
                            VALUES ('$fname', '$lname', '$email','$pass','$phone','$role','$countryId','$cityId','$zipcode','$state','$business','$address1','$address2','$time','$time')";

                            if (mysqli_query($con, $sql)) {
                                $last_id = mysqli_insert_id($con);
                            } else {
                                echo "Error: " . $sql . "<br>" . mysqli_error($con);
                            }
                            $boolfname = $boolemail = $boolphone = $boolpassword = false;


                            $sqll = "INSERT INTO usersocialaccounts 
                                (user_id, social_Id,social_provider,created_at,updated_at)
                                VALUES ($last_id, '$socialId', '$socialProvider','$time','$time')";
                            if (mysqli_query($con, $sqll)) {
                                echo "New record created successfully <br>";
                            } else {
                                echo "Error: " . $sqll . "<br>" . mysqli_error($con);
                            }
                            $boolsocialId = $boolsocialProvider = false;
                        } else {
                            echo "Social ID already registered! Try Another one.<br>";
                            $boolsocialId = $boolsocialProvider = false;
                        }
                    } else {
                        $time = date("Y-m-d H:i:s");
                        $pass = md5($password);
                        $sql = "INSERT INTO userstable 
                                    (FirstName, LastName,email,password,phone,Role,CountryId,CityId,zipcode,state,Business,address1,address2,created_at,updated_at)
                                    VALUES ('$fname', '$lname', '$email','$pass','$phone','$role','$countryId','$cityId','$zipcode','$state','$business','$address1','$address2','$time','$time')";

                        if (mysqli_query($con, $sql)) {
                            echo "New record created successfully <br>";
                            $last_id = mysqli_insert_id($con);
                        } else {
                            echo "Error: " . $sql . "<br>" . mysqli_error($con);
                        }
                    }
                    $boolfname = $boolemail = $boolphone = $boolpassword = false;
                    // Alert('verify your email');
                } else {
                    echo "Email or Phone already registered! Try Another one.<br>";
                }
            } else {
                echo "Fields are empty or incorrect.";
                exit;
            }
        }

        if (isset($_POST['login'])) {
            if (empty($_POST['username']) || empty($_POST['password'])) {
                // header('location: index.php?action=login');
                // echo 'Field is empty';
                $_SESSION['Msg'] = 'Field is empty!';
                // exit;
            } else {
                $email = $_POST['username'];
                $password = $_POST['password'];
                $pass = md5($password);
                $query = mysqli_query($con, "select * from `userstable` where email='$email' && password ='$pass'");
                if (mysqli_num_rows($query) == 0) {
                    $query = mysqli_query($con, "select * from `userstable` where email='$email'");
                    if (mysqli_num_rows($query) == 0) {
                        $_SESSION['Msg'] = "Login Failed. User not Found!";
                    } else {
                        $_SESSION['Msg'] = "Incorrect Password!";
                    }
                    // header('location: index.php?action=login');
                    // exit;
                    // echo '<a href=index.php?action=login>what now?</a>';
                }
                ///user exist but entered wrong password
                // if (mysqli_num_rows($query) == 1) {
                // $query = mysqli_query($con, "select * from `userstable` where email='$email' && password='$pass'");
                // if (mysqli_num_rows($query) == 0) {
                // }
                // }
                //if user is present in the database verify the email
                //set the cookie and session
                //move user to the Wellcome.php page 
                else if (mysqli_num_rows($query) == 1) {
                    // mySqli_query($con, "Update userstable set Email_verified_at='1' where email='$email'");
                    $verify_email = mysqli_query($con, "select Email_verified_at from `userstable` where email='$email'");
                    $check_verify = mysqli_fetch_array($verify_email);
                    if ($check_verify['Email_verified_at'] == '0') {
                        echo "<br>Email not verified!";
                        $_SESSION['Msg'] = "Your Account is not verified! <a href='verify.php?email=$email'>verify here</a>";
                    } else {
                        // echo "<br> Email Verified!";
                        // $query = mysqli_query($con, "select * from `userstable` where email='$email' && password='$pass'");
                        $row = mysqli_fetch_array($query);
                        // echo 'email:', $row['Email'];
                        // echo 'password: ', $row['Password'];
                        $time = date("Y-m-d H:i:s");
                        $pass = md5($password);
                        $query = mysqli_query($con, "select first_login from `userstable` where email='$email'");
                        $checkFirstLogin = mysqli_fetch_array($query);
                        if ($checkFirstLogin['first_login'] == '0000-00-00 00:00:00') {
                            mySqli_query($con, "Update userstable set first_login='$time' where email='$email'");
                        } else {
                            echo '<br>First Login Value:-', $checkFirstLogin['first_login'];
                        }
                        mySqli_query($con, "Update userstable set last_login='$time' where email='$email'");
                        if (isset($_POST['remember'])) {
                            //set up cookie
                            setcookie("email", $email, time() + (300), "/");
                            setcookie("Pass", $password, time() + (300), "/");
                        }
                        $_SESSION['id'] = $row['Id'];
                        $_SESSION['Logged_In'] = true;
                        $_SESSION['ends'] = time() + (60);
                        $_SESSION['MsgforUser'] = 'WELLCOME USER';
                        // echo 'href=index.php?action=welcome';
                        header('location:index.php?action=welcome');
                        // exit;
                        // echo 'Moved to WELLCOME';
                    }
                } else {
                    $_SESSION['Msg'] = "Please Login!";
                    // header('location:index.php?action=login');
                    // echo 'index.php?action=login';
                    // exit;
                }
            }
        } else {
            if (isset($_POST['logout'])) {
                echo 'Nthing :D';
                exit;
            }
        }
    }

    function test_input($data)
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    ?>


    <br><br>
    <?php
    if (empty($_SERVER['QUERY_STRING']) && !isset($_REQUEST['action'])) {
        $_REQUEST['action'] = 'Login';
    }
    if ($_REQUEST['action'] == "signUp" && !empty($_SERVER['QUERY_STRING'])) {
    ?>
        <h2>Registration form</h2>

        <p><span class="error">* required field</span></p>

        <form method="post" name="UserRegistrationForm" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
            First Name: <input type="text" name="fname" value="<?php echo $fname; ?>">
            <span class="error">* <?php echo $fnameErr; ?></span>
            <br><br>

            Last Name: <input type="text" name="lname" value="<?php echo $lname; ?>">
            <span class="error">* <?php echo $lnameErr; ?></span>
            <br><br>
            E-mail: <input type="text" name="email" value="<?php echo $email; ?>">
            <span class="error">* <?php echo $emailErr; ?></span>
            <br><br>
            Social ID: <input type="text" name="socialid" value="<?php echo $socialId; ?>">
            <!-- <span class="error"> <?php echo $socialIdErr; ?></span> -->
            <br><br>

            Social Provider <input type="text" name="socialprovider" value="<?php echo $socialProvider; ?>">
            <!-- <span class="error">* <?php echo $socialProviderErr; ?></span> -->
            <br><br>

            Phone: <input type="text" name="phone" value="<?php echo $phone; ?>">
            <span class="error">*<?php echo $phoneErr; ?></span>
            <br><br>
            Password: <input type="text" name="passcode" value="<?php echo $password; ?>">
            <span class="error">*<?php echo $passwordErr; ?></span>
            <p>minimum 8 characters in length.At least one uppercase,one lowercase, one digit,one special character.</p>
            <br><br>
            Role: <input type="text" name="role" value="<?php echo $role; ?>">
            <span class="error"><?php echo $roleErr; ?></span>
            <br><br>
            Country ID: <input type="text" name="countryId" value="<?php echo $countryId; ?>">
            <span class="error"><?php echo $countryIdErr; ?></span>
            <br><br>
            City ID: <input type="text" name="cityId" value="<?php echo $cityId; ?>">
            <span class="error"><?php echo $cityIdErr; ?></span>
            <br><br>
            Zip Code: <input type="text" name="zipcode" value="<?php echo $zipcode; ?>">
            <span class="error"><?php echo $zipcodeErr; ?></span>
            <br><br>
            State: <input type="text" name="state" value="<?php echo $state; ?>">
            <span class="error"><?php echo $stateErr; ?></span>
            <br><br>
            Business: <input type="text" name="business" value="<?php echo $business; ?>">
            <span class="error"><?php echo $businessErr; ?></span>
            <br><br>
            Address1: <textarea name="address1" rows="1" cols="60" value="<?php echo $address1; ?>"></textarea>
            <br><br>
            Address2: <textarea name="address2" rows="1" cols="60" value="<?php echo $address2; ?>"></textarea>
            <br><br>
            <input type="submit" name="submit" value="Submit">

            <div>Already have an account? <a href="index.php?action=login">Login</a></div>
        </form>
    <?php
        // session_start();
    } else if (empty($_SERVER['QUERY_STRING']) || $_REQUEST['action'] == "login") {
    ?>
        <h2>Login form</h2>
        <form method="post" name="UserLoginForm" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
            <label>Username:</label>
            <input type="text" value="<?php if (isset($_COOKIE["email"])) {
                                            echo $_COOKIE["email"];
                                        } ?>" name="username">

            <label>Password:</label>
            <input type="password" value="<?php if (isset($_COOKIE["Pass"])) {
                                                echo $_COOKIE["Pass"];
                                            } ?>" name="password">
            <br><br>
            <input type="checkbox" name="remember"> Remember me <br>
            <?php
            if (isset($_COOKIE["email"]) && isset($_COOKIE["Pass"])) {
                echo "<br>checked";
            }
            ?>
            <br><br>
            <input type="submit" value="Login" name="login">
            <br>
            <div>Don't have an account? <a href="index.php?action=signUp">SignUp</a> here</div>
            <div><a href="PassRecovery.php">Forgot Password?</a></div>
        </form>
        <span>
            <?php
            if (isset($_SESSION['Msg'])) {
                echo $_SESSION['Msg'];
            }
            unset($_SESSION['Msg']);
            if (isset($_SESSION['mailverified'])) {
                echo $_SESSION['mailverified'];
            }
            unset($_SESSION['mailverified']);

            ?>
        </span>

    <?php
        // session_start();
    } else if ($_REQUEST['action'] == "welcome") {
    ?>
        <div style="display:flex; justify-content:center;">
            <h2>Login Successful</h2>
            <div>
                <b>
                    <?php
                    if (isset($_SESSION['MsgforUser'])) {
                        echo $_SESSION['MsgforUser'];
                    } else {
                        echo "none";
                    }
                    ?>
                </b>
            </div>
        </div>

    <?php
    }
    ?>


</body>

</html>