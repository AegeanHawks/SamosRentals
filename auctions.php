<?php
include 'admin/configuration.php';
session_start();

//Check if logged
$logged = false;
if (islogged()) {
    $logged = true;
}

//Connect
$con = db_connect();
if ($con->connect_errno) {
    return;
}

//Get number of all hotels in database
$sql = $con->prepare('SELECT COUNT(id) AS allAuction FROM Auction');
$sql->execute();
$result = $sql->get_result();
$row = mysqli_fetch_array($result);
$AllAuction = $row['allAuction'];

//We check for next page request
$page = 1;
if (isset($_GET['page'])) {
    $page = htmlspecialchars($_GET['page']);
}

//Calculate how many page do we need
$pages = ceil($AllAuction / 6);
//debug_to_console($page . ' ' . $pages);

if ($page > $pages || $page < 1) {
    //Returns error that page not found
    die(include '404.php');
}
?>

<!DOCTYPE html>
<html>
<head lang="en">
    <?php
    $Page_Title = "Δημοπρασίες";
    include 'head.php';
    ?>
    <!--Scripts-->
    <script src="js/Masonry.js"></script>
    <script type="text/javascript" src="js/jquery.countdown.js"></script>
    <script>
        function flip(id) {
            var cont = document.getElementById(id).className;
            if (cont.indexOf('flipInY') != -1) {
                $('#' + id).removeClass('flipInY');
            } else {
                $('#' + id).addClass('animated flipInY');
                setTimeout(function () {
                    $('#' + id).removeClass('flipInY');
                }, 1000);
            }
        }
        function rotate(id) {
            var cont = document.getElementById(id).className;
            if (cont.indexOf('rotateIn') != -1) {
                $('#' + id).removeClass('rotateIn');
            } else {
                $('#' + id).addClass('animated rotateIn');
                setTimeout(function () {
                    $('#' + id).removeClass('rotateIn');
                }, 1000);
            }
        }
    </script>

    <style>
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

<!--Search-->
<div class="row">
    <nav class="blue z-depth-1">
        <div class="nav-wrapper">
            <form method="get" class="offset-l2 col l8 m12">
                <div class="input-field">
                    <input id="search" name="search" type="search" placeholder="Αναζητήστε εδώ..." required>
                    <label for="search"><i class="mdi-action-search"></i></label>
                    <i class="mdi-navigation-close"></i>
                </div>
            </form>
        </div>
    </nav>
</div>
<!--Search-->

<!-- Rooms Auctions -->
<div class="container" style="padding-top: 50px;">
    <div class="row">
        <div id="stream">
            <div class="col s12 m12 l4">
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
<!-- Rooms Auctions -->

<!--footer-->
<?php
include 'footer.php'
?>
<!--footer-->

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