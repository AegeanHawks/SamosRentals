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

    <!--  Scripts-->
    <script src="js/jquery-2.1.1.min.js"></script>
    <script src="js/materialize.js"></script>
    <script src="js/init.js"></script>

    <script type="text/javascript" src="js/jquery.countdown.js"></script>

    <style>
        ::-webkit-scrollbar {
            width: 12px;
        }

        ::-webkit-scrollbar-track {
            -webkit-box-shadow: inset 0 0 6px rgba(0, 0, 0, 0.3);
        }

        ::-webkit-scrollbar-thumb {
            -webkit-box-shadow: inset 0 0 6px rgba(0, 0, 0, 0.5);
        }

        .countdown-styled div {
            display: inline-block;
            margin: 0 5px 1em;
            font-size: 30px;
            font-weight: 100;
            line-height: 1;
            text-align: right;

            /* IE7 inline-block hack */
            *display: inline;
            *zoom: 1;
        }

        .countdown-styled div:first-child {
            margin-left: 0;
        }

        .countdown-styled div:last-child {
            margin-right: 0;
        }

        .countdown-styled div span {
            display: block;
            border-top: 1px solid #cecece;
            padding-top: 3px;
            font-size: 12px;
            font-weight: normal;
            text-transform: uppercase;
            text-align: left;
        }
    </style>
</head>
<body class="grey lighten-3">

<!--Navigation Menu-->
<?php
include 'header.php';
?>
<!--Navigation Menu-->
<!-- Rooms Auctions -->
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
<!-- Rooms Auctions -->

<!--footer-->
<footer class="page-footer blue darken-3">
    <div class="container">
        <div class="row">
            <div class="col l6 s12">
                <h5 class="white-text">Ποίοι είμαστε</h5>

                <p class="grey-text text-lighten-4">Είμαστε μια ομάδα φοιτητών του τμηματος Μηχανικών Πληροφοριακών
                    και επικοινωνιακών Συστημάτων στο πανεπιστήμιο Αιγαίου που κατασκευάσαν
                    το Samos Rentals ως μέρος πανεπιστημιακής εργασίας. Η εγγραφή και η
                    συμμετοχής σας είναι χρήσιμη για την συνεχισή του.</p>
            </div>
            <div class="col l3 s12">
                <h5 class="white-text">Χρήσιμα</h5>
                <ul>
                    <li><a class="white-text" href="#">Σχετικά</a></li>
                    <li><a class="white-text" href="#">Όροι χρήσης</a></li>
                </ul>
            </div>
            <div class="col l3 s12">
                <h5 class="white-text">Κοινωνικά Δίκτυα</h5>
                <ul>
                    <li>
                        <i class="mdi-action-bug-report"></i><a class="white-text"
                                                                href="https://github.com/AegeanHawks"> Github</a></li>
                </ul>
            </div>
        </div>
    </div>
    <div class="footer-copyright">
        <div class="container">
            Κατασκευάσθηκε από τους <a class="brown-text text-lighten-3" href="https://github.com/Rambou">Rambou</a> και
            <a class="brown-text text-lighten-3" href="https://github.com/Armageddonas">Armageddona</a>
        </div>
    </div>
</footer>
<!--footer-->

<script>
    function nextpage() {
        document.getElementById('pages').getElementsByTagName('li').item(0).setAttribute('class', 'waves-effect');
        document.getElementById('pages').getElementsByTagName('li').item(1).setAttribute('class', 'waves-effect');
        document.getElementById('pages').getElementsByTagName('li').item(2).setAttribute('class', 'active');
        //alert(document.getElementById('pages').getElementsByTagName('li').item(0).classList);
    }
</script>

<script type="text/javascript">
    $(function () {
        $('.countdown-styled').countdown({
            render: function (data) {
                var el = $(this.el);
                el.empty()
                        .
                        append("<div>" + this.leadingZeros(data.days, 3) + " <span>μέρες</span></div>")
                        .append("<div>" + this.leadingZeros(data.hours, 2) + " <span>ώρες</span></div>")
                        .append("<div>" + this.leadingZeros(data.min, 2) + " <span>λεπτά</span></div>")
                        .append("<div>" + this.leadingZeros(data.sec, 2) + " <span>δεύτερα</span></div>");
            }
        });
    });

    var options = [
        {selector: '.row1', offset: 50, callback: 'Materialize.showStaggeredList(".row2")' },
        {selector: '#footer', offset: 205, callback: 'Materialize.toast("Please continue scrolling!", 1500 )' },
        {selector: '#footer', offset: 400, callback: 'Materialize.showStaggeredList("#staggered-test")' }
    ];
    Materialize.scrollFire(options);
</script>

</body>
</html>