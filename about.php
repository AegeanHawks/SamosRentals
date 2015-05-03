<?php
include 'admin/configuration.php';
session_start();
?>

<!DOCTYPE html>
<html>
<head lang="en">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <!--Let browser know website is optimized for mobile-->
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no"/>
    <title>Samos Rentals</title>
    <link rel="icon" type="image/png" href="images/website/favicon.ico"/>

    <!-- CSS  -->
    <link href="css/materialize.css" type="text/css" rel="stylesheet" media="screen,projection"/>
    <link href="css/style.css" type="text/css" rel="stylesheet" media="screen,projection"/>

    <!--  Scripts-->
    <script src="js/jquery-2.1.1.min.js"></script>
    <script src="js/materialize.js"></script>
    <script src="js/init.js"></script>
</head>
<body class="white">

<!--Navigation Menu-->
<?php
include 'header.php';
?>
<!--Navigation Menu-->

<div class="container" style="padding: 80px 0px 100px 0px;">
    <div class="row center-align">
        <div class="col l4 m6 offset-l1" style="padding: 20px">
            <img class="circle responsive-img z-depth-1 grey lighten-3" style="padding: 5px"
                 src="images/website/rambou.jpg">

            <div class="card">
                <p><span class="flow-text">Νικόλαος Μπούσιος<br>A.K.A Rambou<br></span><span>Προπτυχιακός φοιτητής στο Τμήμα Μηχανικών Πληροφοριακών και επικοινωνιακών συστημάτων του Πανεπιστημίου Αιγαίου.</span><br>
                    <span class="flow-text">Skills:</span><br>Programmer, Hacker, UI/UX Designer, Software Engineer,
                    Developer</p>
                <iframe src="https://ghbtns.com/github-btn.html?user=rambou&type=follow&count=true&size=large"
                        frameborder="0" scrolling="0" width="220px" height="30px"></iframe>
            </div>
        </div>
        <div class="col l4 m6 offset-l2" style="padding: 20px">
            <img class="circle responsive-img z-depth-1 grey lighten-3" style="padding: 5px"
                 src=" images/website/armageddonas.jpg">

            <div class="card">
                <p><span class="flow-text">Κώστας Χασιώτης<br>A.K.A Armageddonas<br></span><span>Προπτυχιακός φοιτητής στο Τμήμα Μηχανικών Πληροφοριακών και επικοινωνιακών συστημάτων του Πανεπιστημίου Αιγαίου.</span><br>
                    <span class="flow-text">Skills:</span><br>Programmer, Software Designer, UI/UX Designer, Software
                    Engineer,
                    Developer
                </p>
                <iframe src="https://ghbtns.com/github-btn.html?user=armageddonas&type=follow&count=true&size=large"
                        frameborder="0" scrolling="0" width="220px" height="30px"></iframe>
            </div>
        </div>
        <div class="col s12">


        </div>
    </div>

</div>

<?php
include 'footer.php';
?>

</body>
</html>
