<?php
if(!empty($_POST)){
    die(implode($_POST));
}

function RegisterUser()
{
    if (!isset($_POST['submitted'])) {
        return false;
    }

    $formvars = array();

    if (!$this->ValidateRegistrationSubmission()) {
        return false;
    }

    $this->CollectRegistrationSubmission($formvars);

    if (!$this->SaveToDatabase($formvars)) {
        return false;
    }

    if (!$this->SendUserConfirmationEmail($formvars)) {
        return false;
    }

    $this->SendAdminIntimationEmail($formvars);

    return true;
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

    <!--  Scripts-->
    <script src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
    <script src="js/materialize.js"></script>
    <script src="js/init.js"></script>
    <script src='https://www.google.com/recaptcha/api.js'></script>

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
    <script type="text/javascript">
        $('.datepicker').pickadate({
            selectMonths: true, // Creates a dropdown to control month
            selectYears: 15 // Creates a dropdown of 15 years to control year
        });
    </script>

</head>
<body class="light-blue">

<!--Navigation Menu-->
<?php
include 'header.php';
?>
<!--Navigation Menu-->

<!-- Registration form-->
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

    <div class="row animated slideInUp center-align">
        <!-- Registration Form -->
        <div class="white reg-form z-depth-3 coll"> <!--"reg-form z-depth-3 col s10 m8 l6 offset-s1 offset-m2 offset-l3"-->
            <form action="register.php" autocomplete="off"
                  method="POST">

                <div class="input-field">
                    <i class="mdi-social-person prefix"></i>
                    <input type="text" name="username" pattern="^[a-zA-Z][a-zA-Z0-9-_\.]{2,20}$" id="username"
                           maxlength="30" class="validate" required>
                    <label for="username">Όνομα Χρήστη</label>
                </div>

                <div class="row">
                    <div class="input-field col s12 m6">
                        <i class="mdi-action-assignment-ind prefix"></i>
                        <input id="first_name" pattern="^[Α-Ω][α-ωa-zA-Z-ά-ώ]{3,20}$" type="text" class="validate"
                               maxlength="15"
                               required>
                        <label for="first_name">Όνομα</label>
                    </div>
                    <div class="input-field col s12 m6">
                        <input id="last_name" pattern="^[Α-Ω][α-ωa-zA-Z-ά-ώ]{2,20}$" type="text" class="validate"
                               maxlength="30"
                               required>
                        <label for="last_name">Επώνυμο</label>
                    </div>
                </div>

                <div class="input-field">
                    <i class="mdi-content-mail prefix"></i>
                    <input type="email" name="email" id="email" maxlength="30" class="validate" required>
                    <label for="email">E-mail</label>
                </div>

                <div class="input-field  tooltipped" data-position="top" data-delay="50"
                     data-tooltip="Ο κωδικός είναι 8 χαρακτήρων και περιέχει τουλάχιστον 1 αριθμό,κεφαλαίο και μικρό γράμμα.">
                    <i class="mdi-communication-vpn-key prefix"></i>
                    <input type="password" pattern='(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}'
                           onchange="form.reenter_password.pattern = this.value;" name="password" id="password"
                           maxlength="30" class="validate" required>
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
                    <input id="icon_telephone" type="tel" pattern='[\+]\d{2}\d{10}'
                           placeholder='Κινητό ή σταθερό (+30699999999 ή +302222022222)' class="validate" required>
                    <label for="icon_telephone">Τηλέφωνο</label>
                </div>
                <div class="input-field">
                    <i class="mdi-social-cake prefix"></i>
                    <input id="birthdate" type="date" class="datepicker picker__input" required>
                    <label for="birthdate">Ημερομηνία Γέννησης</label>
                </div>

                <div class="input-field col offset-s1 s11">
                    <select id="sex">
                        <option value="1">Άνδρας</option>
                        <option value="2">Γυναίκα</option>
                    </select>
                    <label for="sex">Φύλο</label>
                </div>

                <div class="g-recaptcha coll" data-sitekey="6Ldc7AUTAAAAANnRbW3E9zA9nNaS5HVV9fmmxZaL"></div>
                <div class="row">
                    <button type="submit" class="center-btn waves-effect waves-light btn" id="register_btn"><i
                            class="mdi-action-done left"></i>Εγγραφη
                    </button>
                </div>
            </form>
        </div>
        <!-- Registration Form -->
    </div>
</div>
<!-- Registration form-->

</body>
</html>

<?php

function debug_to_console($data)
{
    if (is_array($data) || is_object($data)) {
        echo("<script>console.log('PHP: " . json_encode($data) . "');</script>");
    } else {
        echo("<script>console.log('PHP: " . $data . "');</script>");
    }
}

?>