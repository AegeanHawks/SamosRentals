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
    $Page_Title = "Δημοπρασίες";
    include 'head.php';
    ?>

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
    </div>
    <div class="row2 row">
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
    <div class="row3 row">
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