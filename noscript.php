<!DOCTYPE html>
<html>
<head lang="en">
    <?php
    $Page_Title = "Ενεργοποιήστε τα Javascript";
    ?>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <!--Let browser know website is optimized for mobile-->
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no"/>
    <title><?php echo $Page_Title; ?></title>
    <link rel="icon" type="image/png" href="images/website/favicon.ico"/>

    <!-- CSS  -->
    <link href="css/materialize.css" type="text/css" rel="stylesheet" media="screen,projection"/>
    <link href="css/style.css" type="text/css" rel="stylesheet" media="screen,projection"/>
    <link href="css/animate.css" rel="stylesheet">

    <script>
        window.location = "index.php";
    </script>
    <style>
        .Error404 {
            position: absolute;
            width: 100%;
            height: 90%;
            text-align: center;
        }

        .Error404 .col {
            display: inline-block;
            float: none;
            text-align: left;
        }

        .Error404 h1 {
            color: #fff;
            text-align: center;
            margin-top: 20%;
            font-size: 3.5rem;
        }

        .Error404 #error-404-img {
            display: block;
            width: 16rem;
            height: auto;
            margin: 3% auto;
        }

        .Error404 #error-404-img:hover {
            cursor: Default
        }

        .Error404 p {
            color: #fff;
            text-align: center;
            margin-top: 2%;
        }
    </style>
</head>
<body class="light-blue">
<div class="row Error404">
    <div class="col m6">
        <h1>Ooopsss, κάτι πήγε στραβά!</h1>
        <img id="error-404-img" src="images/website/error-404.png" alt="Chyba 404">

        <p class="flow-text">
            <b>Η σελίδα χρειάζεται Javascript για να λειτουργήσει!</b> Παρακαλούμε ενεργοποιείστε το Javascript για
            να συνεχίσετε την πλοήγηση στην ιστοσελίδα με την καλύτερη δυνατή εμπειρία.</p>

        <div class="center">
            <a class="btn-floating btn-large waves-effect waves-light light-green" href="index.php">Σπιτι</a>
        </div>
    </div>
</div>
</body>
</html>