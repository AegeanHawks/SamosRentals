<?php
include 'admin/configuration.php';
session_start();
$registered = false;

//Check if already logged
if (islogged()) {
    die("<script>window.history.back()</script>");
}
?>
<!DOCTYPE html>
<html>
<head lang="en">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
    <!--Let browser know website is optimized for mobile-->
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no"/>
    <meta name="msapplication-TileColor" content="#fa7c1a">

    <title>Samos Rentals - Registation</title>
    <link rel="icon" type="image/png" href="images/website/favicon.ico"/>

    <!-- CSS  -->
    <link href="css/materialize.css" type="text/css" rel="stylesheet" media="screen,projection"/>
    <link href="css/style.css" type="text/css" rel="stylesheet" media="screen,projection"/>
    <link href="css/animate.css" type="text/css" rel="stylesheet">
    <style>
        .registration {
            position: absolute;
            width: 100%;
            height: 91%;
            text-align: center;
            align-content: center;
        }

        .registration .coll {
            display: inline-block;
            float: none;
        }

        .registration .coll h1 {
            margin-top: 4rem;
        }

        .registration h1 {
            color: #fff;
            text-align: center;
            margin-top: 5%;
            font-size: 3.5rem;
        }

        .registration p {
            color: #fff;
            text-align: center;
            margin-top: 0;
        }

        .reg-form {
            background-color: #fafafa;
            margin: 1rem auto 3rem;
            border-radius: 5px;
            padding: 1.5rem 2rem 0.5rem !important;
        }

    </style>

    <!--  Scripts-->
    <script src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
    <script src="js/materialize.js"></script>
    <script src="js/init.js"></script>
    <script src='https://www.google.com/recaptcha/api.js'></script>

</head>
<body class="light-blue">

<!--Navigation Menu-->
<?php
include 'header.php';
?>
<!--Navigation Menu-->


<?php
//Check if Method Is POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    //Gather Data from post
    $username = htmlspecialchars($_POST['username']);
    $password = htmlspecialchars($_POST['password']);
    $fname = htmlspecialchars($_POST['first_name']);
    $lname = htmlspecialchars($_POST['last_name']);
    $birthday = htmlspecialchars($_POST['birthday']);
    $tel = htmlspecialchars($_POST['tel']);
    $sex = htmlspecialchars($_POST['sex']);
    $email = htmlspecialchars($_POST['email']);

    //Validate Data
    if (preg_match('/^[Α-ΩA-Z][α-ωa-zA-Z-ά-ώ]{3,20}$/', $fname)) {
        $valid = true;
    } else {
        $valid = false;
    }

    if (preg_match('/^[Α-ΩA-Z][α-ωa-zA-Z-ά-ώ]{3,20}$/', $lname)) {
        $valid = true;
    } else {
        $valid = false;
    }

    if (preg_match('/^[a-zA-Z][a-zA-Z0-9-_\.]{2,20}$/', $username)) {
        $valid = true;
    } else {
        $valid = false;
    }

    if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $valid = true;
    } else {
        $valid = false;
    }

    if (preg_match('/(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}/', $password)) {
        $valid = true;
    } else {
        $valid = false;
    }

    if (preg_match('/[\+]\d{2}\d{10}/', $tel)) {
        $valid = true;
    } else {
        $valid = false;
    }

    if (preg_match('/(male)|(female)/', $sex)) {
        $valid = true;
    } else {
        $valid = false;
    }

    if (preg_match('/^[0-9]{2}[ ][a-zA-Z]{3,}[,][ ][0-9]{4}$/', $birthday)) {
        $valid = true;
    } else {
        $valid = false;
    }

    //Send post to google recaptcha server to check whether user insert the correct data
    include("getCurlData.php");
    $google_url = "https://www.google.com/recaptcha/api/siteverify";
    $secret = '6Ldc7AUTAAAAAAXcvwdsViWimL2UE014Y27imAeG';
    $url = $google_url . "?secret=" . $secret . "&response=" . $_POST["g-recaptcha-response"] . "&remoteip=" . $_SERVER['REMOTE_ADDR'];
    $res = getCurlData($url);
    $res = json_decode($res, true);

    //reCaptcha success check
    if (!$res['success']) {
        // What happens when the CAPTCHA was entered incorrectly
        $valid = false;
        $error_msg = "Εισάγετε σωστά το reCaptcha!";
        echo "<script>Materialize.toast('" . $error_msg . "', 5000)</script>";
    } else {
        //Connect
        $con = db_connect();
        if ($con->connect_errno) {
            return;
        }

        // SQL query to fetch information of registerd users and finds user match.
        $sql = $con->prepare('SELECT * FROM user WHERE Username= ?');
        $sql->bind_param('s', $username);
        $sql->execute();

        $result = $sql->get_result();
        $num_row = mysqli_num_rows($result);
        if ($num_row != 0) {
            $valid = false;
            $error_msg = "Το Όνομα Χρήστη υπάρχει!";
        }

        $sql = $con->prepare('SELECT * FROM user WHERE Mail= ?');
        $sql->bind_param('s', $email);
        $sql->execute();

        $result = $sql->get_result();
        $num_row = mysqli_num_rows($result);
        if ($num_row != 0) {
            $valid = false;
            $error_msg = "Το Email υπάρχει!";
        }

        // SQL query to fetch information of registerd users and finds user match.
        if (!$valid) {
            echo "<script>Materialize.toast('" . $error_msg . "', 5000)</script>";
        } else {
            $sql = $con->prepare("INSERT INTO User (Username, Password, FirstName, LastName, Sex, Mail, Tel, Birthday, Role,Image)
              VALUE (?, ?, ?, ?, ?, ?, ?, ?, 2,'images/website/avatar.jpg')");
            $sql->bind_param('ssssssss', $username, $password, $fname, $lname, $sex, $email, $tel, $birthday);
            $sql->execute();

            $result = $sql->get_result();
            $registered = true;
        }

        $con->close();
    }
}
?>

<?php
if ($registered){
    ?>
    <div class="row registration">
        <!-- Registration Header -->
        <div class="row animated slideInDown center-align">
            <h1>Καλωσήρθατε</h1>

            <div class="col l6 offset-l3">
                <p class="flow-text">Η εγγραφή ολοκληρώθηκε <b>επιτυχώς</b>!</p>
            </div>
        </div>
    </div>
    <script>
        function Redirect() {
            window.location = "login.php";
        }
        setTimeout('Redirect()', 3000);
    </script>
<?php
}else{
?>
<div class="row registration">
    <!-- Registration Header -->
    <div class="row animated slideInDown center-align">
        <h1>Εγγραφή</h1>

        <div class="col l6 offset-l3">
            <p class="flow-text">Εγγράψου συμπληρώνοντας τα στοιχεία σου παρακάτω και απόκτησε πρόσβαση σε
                <b>100+</b>
                ενοικιαζόμενα ή αν είσαι <b>κάτοχος</b> δωματίων δημοπράτησε τα!</p>
        </div>
    </div>
    <!-- Registration Header -->


    <!-- Registration Form -->
    <div class="row animated slideInUp center-align ">
        <div class="white reg-form z-depth-3 coll"> <!--"reg-form z-depth-3 col s10 m8 l6 offset-s1 offset-m2 offset-l3"-->
            <form id="register" action="register.php" autocomplete="off" accept-charset='UTF-8'
                  method="POST">

                <div class="row">
                    <div class="input-field col s12 m6">
                        <i class="mdi-action-assignment-ind prefix"></i>
                        <input type="text" id="first_name" name="first_name" pattern="^[Α-ΩA-Z][α-ωa-zA-Z-ά-ώ]{3,20}$" class="validate"
                               value="<?php if (!empty($fname)) echo $fname; ?>"
                               maxlength="15"
                               required form="register">
                        <label for="first_name">Όνομα</label>
                    </div>
                    <div class="input-field col s12 m6">
                        <input id="last_name" name="last_name" pattern="^[Α-ΩA-Z][α-ωa-zA-Z-ά-ώ]{2,20}$" type="text" class="validate"
                               value="<?php if (!empty($lname)) echo $lname; ?>"
                               maxlength="30"
                               required form="register">
                        <label for="last_name">Επώνυμο</label>
                    </div>
                </div>

                <div class="input-field">
                    <i class="mdi-social-person prefix"></i>
                    <input type="text" id="username" name="username" pattern="^[a-zA-Z][a-zA-Z0-9-_\.]{2,20}$"
                           value="<?php if (!empty($username)) echo $username; ?>"
                           maxlength="30" class="validate" required form="register">
                    <label for="username">Όνομα Χρήστη</label>
                </div>

                <div class="input-field">
                    <i class="mdi-content-mail prefix"></i>
                    <input type="email" name="email" id="email" maxlength="30" class="validate" required
                           value="<?php if (!empty($email)) echo $email; ?>"
                           form="register">
                    <label for="email">E-mail</label>
                </div>

                <div class="input-field tooltipped" data-position="top" data-delay="50"
                     data-tooltip="Ο κωδικός είναι 8 χαρακτήρων και περιέχει τουλάχιστον 1 αριθμό,κεφαλαίο και μικρό γράμμα.">
                    <i class="mdi-communication-vpn-key prefix"></i>
                    <input type="password" pattern='(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}'
                           onchange="form.reenter_password.pattern = this.value;" name="password" id="password"
                           maxlength="30" class="validate" required form="register">
                    <label for="password">Κωδικός</label>
                </div>

                <div class="input-field">
                    <i class="mdi-action-verified-user prefix"></i>
                    <input type="password" name="password" id="reenter_password" maxlength="30" class="validate"
                           required>
                    <label for="reenter_password">Ξαναβάλε τον κωδικό</label>
                </div>

                <div class="input-field">
                    <i class="mdi-communication-phone prefix"></i>
                    <input id="tel" name="tel" type="tel" pattern='[\+]\d{2}\d{10}'
                           value="<?php if (!empty($tel)) echo $tel; ?>"
                           placeholder='Κινητό ή σταθερό (+30699999999 ή +302222022222)' class="validate" required
                           form="register">
                    <label for="tel">Τηλέφωνο</label>
                </div>

                <div class="input-field">
                    <i class="mdi-social-cake prefix"></i>
                    <input id="birthday" name="birthday" type="text" class="datepicker picker__input"
                           value="<?php if (!empty($birthday)) echo $birthday; ?>"
                           required form="register">
                    <label for="birthday">Ημερομηνία Γέννησης</label>
                </div>

                <div class="input-field col offset-s1 s11">
                    <select id="sex" name="sex" class="validate" required form="register">
                        <option value="male" <?php if (!empty($sex)) if ($sex == "male") echo "selected"; ?>>Άνδρας
                        </option>
                        <option value="female" <?php if (!empty($sex)) if ($sex == "female") echo "selected"; ?>>Γυναίκα
                        </option>
                    </select>
                    <label for="sex">Φύλο</label>
                </div>

                <div class="g-recaptcha coll validate" name="recaptcha"
                     data-sitekey="6Ldc7AUTAAAAANnRbW3E9zA9nNaS5HVV9fmmxZaL"
                     form="register" required>
                </div>

                <div class="row">
                    <button type="submit" class="center-btn waves-effect waves-light btn" id="register_btn"
                            form="register"><i
                            class="mdi-action-done left"></i>Εγγραφη
                    </button>
                </div>
            </form>
        </div>
    </div>
    <!-- Registration Form -->
</div>

</body>
</html>
<?php
}
?>

