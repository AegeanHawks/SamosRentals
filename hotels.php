<?php
include 'admin/configuration.php';
session_start();

//Check if logged
$logged = false;
if (islogged()) {
    $logged = true;
}
?>

<!DOCTYPE html>
<html>
<head lang="en">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
    <!--Let browser know website is optimized for mobile-->
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no"/>
    <title>Samos Rentals</title>
    <link rel="icon" type="image/png" href="images/website/favicon.ico"/>

    <!-- CSS  -->
    <link href="css/materialize.css" type="text/css" rel="stylesheet" media="screen,projection"/>
    <link href="css/style.css" type="text/css" rel="stylesheet" media="screen,projection"/>

    <!--  Scripts  -->
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

<!--Hotel Info-->
<div class="container" style="padding-top: 50px;">
    <div class="row1 row">
        <div class="col s12 m4">
            <div class="card">
                <div class="card-image waves-effect waves-block waves-light">
                    <img class="activator" src="images/office.jpg">
                </div>
                <div class="card-content">
            <span class="card-title activator grey-text text-darken-4">Τρέχουσα τιμή: 140 Euro<i
                    class="mdi-navigation-more-vert right"></i></span>

                    <p>

                    <div class="countdown-styled right-align"></div>

                    <a href="#">Διάβασε περισσότερα...</a></p>
                </div>
                <div class="card-reveal">
            <span class=" card-title grey-text text-darken-4">Card Title <i
                    class="mdi-navigation-close right"></i></span>

                    <p>I am a very simple card. I am good at containing small bits of information.
                        I am convenient because I require little markup to use effectively.fe f wfwefwefwef wef wef we
                        fwf wef we</p>

                    <p>I am a very simple card. I am good at containing small bits of information.
                        I am convenient because I require little markup to use effectively.fe f wfwefwefwef wef wef we
                        fwf wef we</p>

                    <p>I am a very simple card. I am good at containing small bits of information.
                        I am convenient because I require little markup to use effectively.fe f wfwefwefwef wef wef we
                        fwf wef we</p>

                    <p>I am a very simple card. I am good at containing small bits of information.
                        I am convenient because I require little markup to use effectively.fe f wfwefwefwef wef wef we
                        fwf wef we</p>
                </div>
            </div>
        </div>

        <div class="col s12 m4">
            <div class="card large">
                <div class="card-image waves-effect waves-block waves-light">
                    <img class="activator" src="images/office1.jpg">
                </div>
                <div class="card-content">
                    <span>I am a very simple card. I am good at containing small bits of information.
                        I am convenient because I require little markup to use effectively.fe f wfwefwefwef wef wef we fwf wef we
                    I am a very simple card. I am good at containing small bits of information. wedwedew fwefewf we fwef wefwef wefwef wef wef wef wef wef weeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeee </span>
                </div>
                <div class="card-reveal">
                    <span class="card-title grey-text text-darken-4">Card Title</span>

                    <p>Here is some more information about this product that is only revealed once clicked on.</p>
                </div>
            </div>
        </div>

        <div class="col s12 m4">
            <div class="card">
                <div class="card-image waves-effect waves-block waves-light">
                    <img class="activator" src="images/office2.jpg">
                </div>
                <div class="card-content">
            <span class="card-title activator grey-text text-darken-4">Card Title <i
                    class="mdi-navigation-more-vert right"></i></span>

                    <p><a href="#">This is a link</a></p>
                </div>
                <div class="card-reveal">
            <span class="card-title grey-text text-darken-4">Card Title <i
                    class="mdi-navigation-close right"></i></span>

                    <p>Here is some more information about this product that is only revealed once clicked on.</p>
                </div>
            </div>
        </div>
    </div>
    <div class="row2 row">
        <div class="col s12 m4">
            <div class="card">
                <div class="card-image waves-effect waves-block waves-light">
                    <img class="activator" src="images/office.jpg">
                </div>
                <div class="card-content">
            <span class="card-title activator grey-text text-darken-4">Card Title <i
                    class="mdi-navigation-more-vert right"></i></span>

                    <p><a href="#">This is a link</a></p>
                </div>
                <div class="card-reveal">
            <span class="card-title grey-text text-darken-4">Card Title <i
                    class="mdi-navigation-close right"></i></span>

                    <p>Here is some more information about this product that is only revealed once clicked on.</p>
                </div>
            </div>
        </div>

        <div class="col s12 m4">
            <div class="card">
                <div class="card-image waves-effect waves-block waves-light">
                    <img class="activator" src="images/office1.jpg">
                </div>
                <div class="card-content">
            <span class="card-title activator grey-text text-darken-4">Card Title <i
                    class="mdi-navigation-more-vert right"></i></span>

                    <p><a href="#">This is a link</a></p>
                </div>
                <div class="card-reveal">
            <span class="card-title grey-text text-darken-4">Card Title <i
                    class="mdi-navigation-close right"></i></span>

                    <p>Here is some more information about this product that is only revealed once clicked on.</p>
                </div>
            </div>
        </div>

        <div class="col s12 m4">
            <div class="card">
                <div class="card-image waves-effect waves-block waves-light">
                    <img class="activator" src="images/office2.jpg">
                </div>
                <div class="card-content">
            <span class="card-title activator grey-text text-darken-4">Card Title <i
                    class="mdi-navigation-more-vert right"></i></span>

                    <p><a href="#">This is a link</a></p>
                </div>
                <div class="card-reveal">
            <span class="card-title grey-text text-darken-4">Card Title <i
                    class="mdi-navigation-close right"></i></span>

                    <p>Here is some more information about this product that is only revealed once clicked on.</p>
                </div>
            </div>
        </div>
    </div>
    <div class="row3 row">
        <div class="col s12 m4">
            <div class="card">
                <div class="card-image waves-effect waves-block waves-light">
                    <img class="activator" src="images/office.jpg">
                </div>
                <div class="card-content">
            <span class="card-title activator grey-text text-darken-4">Card Title <i
                    class="mdi-navigation-more-vert right"></i></span>

                    <p><a href="#">This is a link</a></p>
                </div>
                <div class="card-reveal">
            <span class="card-title grey-text text-darken-4">Card Title <i
                    class="mdi-navigation-close right"></i></span>

                    <p>Here is some more information about this product that is only revealed once clicked on.</p>
                </div>
            </div>
        </div>

        <div class="col s12 m4">
            <div class="card">
                <div class="card-image waves-effect waves-block waves-light">
                    <img class="activator" src="images/office1.jpg">
                </div>
                <div class="card-content">
            <span class="card-title activator grey-text text-darken-4">Card Title <i
                    class="mdi-navigation-more-vert right"></i></span>

                    <p><a href="#">This is a link</a></p>
                </div>
                <div class="card-reveal">
            <span class="card-title grey-text text-darken-4">Card Title <i
                    class="mdi-navigation-close right"></i></span>

                    <p>Here is some more information about this product that is only revealed once clicked on.</p>
                </div>
            </div>
        </div>

        <div class="col s12 m4">
            <div class="card">
                <div class="card-image waves-effect waves-block waves-light">
                    <img class="activator" src="images/office2.jpg">
                </div>
                <div class="card-content">
            <span class="card-title activator grey-text text-darken-4">Card Title <i
                    class="mdi-navigation-more-vert right"></i></span>

                    <p><a href="#">This is a link</a></p>
                </div>
                <div class="card-reveal">
            <span class="card-title grey-text text-darken-4">Card Title <i
                    class="mdi-navigation-close right"></i></span>

                    <p>Here is some more information about this product that is only revealed once clicked on.</p>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div id="pages">
            <ul class="pagination right">
                <li class="disabled"><a href="#"><i class="mdi-navigation-chevron-left"></i></a></li>
                <li class="active"><a href="#">1</a></li>
                <li class="waves-effect"><a href="#!" onClick="nextpage();">2</a></li>
                <li class="waves-effect"><a href="#">3</a></li>
                <li class="waves-effect"><a href="#">4</a></li>
                <li class="waves-effect"><a href="#">5</a></li>
                <li class="waves-effect"><a href="#"><i class="mdi-navigation-chevron-right"></i></a></li>
            </ul>
        </div>
    </div>
</div>
<!--Hotel Info-->

<!--footer-->
<?php
include 'footer.php';
?>
<!--footer-->

</body>
</html>