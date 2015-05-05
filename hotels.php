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
    <?php
    $Page_Title = "Ξενοδοχεία";
    include 'head.php';
    ?>

    <script src="js/Masonry.js"></script>
</head>
<body class="white">

<!--Navigation Menu-->
<?php
include 'header.php';
?>
<!--Navigation Menu-->

<!--Hotel Info-->
<div class="container" style="padding-top: 50px;">
    <div class="row">
        <div id="stream">

            <?php

            //Connect
            $con = db_connect();
            if ($con->connect_errno) {
                return;
            }

            //Ελέγχουμε ποίες αγγελίες θέλει να δεί ο χρήστης
            if (!empty($_GET['id'])) {
                debug_to_console($_GET['id']);
            }
            ?>
            <div class="col s12 m12 l4">
                <div class="card">
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

            <div class="col s12 m12 l4">
            <div class="card">
                <div class="card-image waves-effect waves-block waves-light">
                    <img class="activator" src="images/office2.jpg">
                </div>
                <div class="card-content">
            <span class="card-title activator grey-text text-darken-4">Card Title <i
                    class="mdi-navigation-more-vert right"></i></span>

                    <p><a href="#">This is a link</a></p>

                    <p><a href="#">This is a link</a></p>

                    <p><a href="#">This is a link</a></p>

                    <p><a href="#">This is a link</a></p>

                    <p><a href="#">This is a link</a></p>

                    <p><a href="#">This is a link</a></p>

                    <p><a href="#">This is a link</a></p>

                    <p><a href="#">This is a link</a></p>

                    <p><a href="#">This is a link</a></p>
                </div>
                <div class="card-reveal">
            <span class="card-title grey-text text-darken-4">Card Title <i
                    class="mdi-navigation-close right"></i></span>

                    <p>Here is some more information about this product that is only revealed once clicked on.</p>
                </div>
            </div>
        </div>

            <div class="col s12 m12 l4">
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

            <div class="col s12 m12 l4">
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

            <div class="col s12 m12 l4">
            <div class="card">
                <div class="card-image waves-effect waves-block waves-light">
                    <img class="activator" src="images/office2.jpg">
                </div>
                <div class="card-content">
            <span class="card-title activator grey-text text-darken-4">Card Title <i
                    class="mdi-navigation-more-vert right"></i></span>

                    <p><a href="#">This is a link</a></p>

                    <p><a href="#">This is a link</a></p>

                    <p><a href="#">This is a link</a></p>

                    <p><a href="#">This is a link</a></p>

                    <p><a href="#">This is a link</a></p>

                    <p><a href="#">This is a link</a></p>

                    <p><a href="#">This is a link</a></p>

                    <p><a href="#">This is a link</a></p>

                    <p><a href="#">This is a link</a></p>

                    <p><a href="#">This is a link</a></p>

                    <p><a href="#">This is a link</a></p>

                    <p><a href="#">This is a link</a></p>

                    <p><a href="#">This is a link</a></p>


                </div>
                <div class="card-reveal">
            <span class="card-title grey-text text-darken-4">Card Title <i
                    class="mdi-navigation-close right"></i></span>

                    <p>Here is some more information about this product that is only revealed once clicked on.</p>
                </div>
            </div>
        </div>

            <div class="col s12 m12 l4">
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

            <div class="col s12 m12 l4">
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

            <div class="col s12 m12 l4">
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