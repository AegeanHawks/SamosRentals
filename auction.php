<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head lang="en">
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
        <!--Let browser know website is optimized for mobile-->
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no"/>
        <title>Auction</title>
        <link rel="icon" type="image/png" href="images/website/favicon.ico"/>

        <!-- CSS  -->
        <link href="css/materialize.css" type="text/css" rel="stylesheet" media="screen,projection"/>
        <link href="css/style.css" type="text/css" rel="stylesheet" media="screen,projection"/>

        <!--  Scripts-->
        <script src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
        <script src="js/materialize.js"></script>
        <script src="js/init.js"></script>

        <style>
            .bidnumber{
                font-size: 90px !important; 
                color: white !important;   
                text-shadow: -2px 0 orange, 0 2px orange, 2px 0 orange, 0 -2px orange !important;
                text-align: center;
            }
            .bidheader{
                text-align: center;

            }
        </style>
    </head>
    <body>
        <?php
        include 'header.php';
        ?>

        <div class="parallax-container">
            <div class="parallax"><img src="http://static2.wallpedes.com/wallpaper/beach/beach-wallpapers-widescreen-best-desktop-3d-hd-wallpapers-beach-house-wallpaper-download-for-pc-android-mobile-windows-7-name-nature-animation.jpg"></div>
        </div>

        <div class="container">
            <div class="section no-pad-bot" style="margin-top: -5%;">
                <div class="row">
                    <div class="col offset-l2 l8 s12 white z-depth-3">
                        <div class="col l12 m8 s12">
                            <h4 class="grey-text darken-2 light">Grand budapest hotel</h4>
                            <p class="grey-text darken-3">Replacing the former Olympic Palace Hotel in the heart of Athens, originally built in 1958 by Iasonas Rizos, the modernisit architecture of the outside is matched by a blend of art, sculpture and design on the inside. Replacing the former Olympic Palace Hotel in the heart of Athens, originally built in 1958 by Iasonas Rizos, the modernisit architecture of the outside is matched by a blend of art, sculpture and design on the inside.</p>
                        </div>
                    </div>
                </div>
            </div>


            <div class="row" >
                <div class="col s12 m12 l4">
                    <ul class="collection">
                        <li class="collection-item avatar" >
                            <i class="mdi-action-accessibility circle blue"></i>
                            <span class="title truncate">Αριθμός ατόμων</span>
                            <p>2
                            </p>                                            
                        </li>
                        <li class="collection-item avatar">
                            <i class="mdi-communication-messenger circle orange"></i>
                            <span class="title truncate">Πληροφορίες ξενοδοχείου</span>
                            <p><a href="#">Grand Budapest Hotel</a>
                            </p>                                            
                        </li>

                        <li class="collection-item avatar" >
                            <i class="mdi-communication-phone circle green"></i>
                            <span class="title">Τηλέφωνο επικοινωνίας</span>
                            <p>2
                            </p>
                        </li>
                        <li class="collection-item" >
                            <span class="title" >Βαθμολογία ξενοδοχείου</span><br>
                            <i class="mdi-action-star-rate circle amber accent-3"></i>
                            <i class="mdi-action-star-rate circle amber accent-3"></i>
                            <i class="mdi-action-star-rate circle amber accent-3"></i>
                            <i class="mdi-action-star-rate circle amber accent-3"></i>
                            <i class="mdi-action-star-rate circle amber accent-3"></i>
                        </li>
                    </ul>
                </div>
                <div class="col s12 m12 l7 right">
                    <div class="col s12 m6 l4 z-depth-1" style="padding: 20px; height: 285px;">
                        <h5 class="grey-text bidheader truncate">TΩΡΙΝΗ ΤΙΜΗ</h5>

                        <p class="bidnumber">33</p>
                    </div>
                    <div class="col s12 m6 l4 z-depth-1" style="padding: 20px; height: 285px;">
                        <button class="btn waves-effect waves-light" type="submit" name="action">Πλειοδοτησε 
                            <i class="mdi-content-send right"></i>
                        </button>
                        <input class="validate bidnumber" style="height: 90px; margin-top: 66px" placeholder="" size="90" id="last_name" type="text" >
                    </div>
                    <div class="col s12 m6 l4 z-depth-1" style="padding: 20px;height: 285px;">
                        <button class="btn waves-effect waves-light" type="submit" name="action">Αγορασε τωρα
                            <i class="mdi-content-send right"></i>
                        </button>
                        <p class="bidnumber">33</p>
                    </div>
                </div>
            </div>
            <!--Slider-->
            <div class="slider col s8 offset-s2" >
                <ul class="slides" >
                    <li>
                        <img src="http://www.gabelliconnect.com/wp-content/uploads/2014/08/luxury-hotel-rooms-pamilla-cape-town.jpg"> <!-- random image -->
                        <div class="caption center-align">
                            <h3>This is our big Tagline!</h3>
                            <h5 class="light grey-text text-lighten-3">Here's our small slogan.</h5>
                        </div>
                    </li>
                    <li>
                        <img src="http://hoteldolphinkatra.co.in/wp-content/gallery/dolphin/four-bed.jpg"> <!-- random image -->
                        <div class="caption left-align">
                            <h3>Left Aligned Caption</h3>
                            <h5 class="light grey-text text-lighten-3">Here's our small slogan.</h5>
                        </div>
                    </li>
                    <li>
                        <img src="http://www.themresort.com/media/gallery/images/HOTEL-ROOMS/M-Resort-Hotel-Room-One-Bedroom-2.jpg"> <!-- random image -->
                        <div class="caption right-align">
                            <h3>Right Aligned Caption</h3>
                            <h5 class="light grey-text text-lighten-3">Here's our small slogan.</h5>
                        </div>
                    </li>
                    <li>
                        <img src="http://www.hotelpanorama.com.hk/d/panaroma/media/__thumbs_980_490_crop/Room_1_Superior_Silver_twin-bed47a2ae.jpg?1362096164"> <!-- random image -->
                        <div class="caption center-align">
                            <h3>This is our big Tagline!</h3>
                            <h5 class="light grey-text text-lighten-3">Here's our small slogan.</h5>
                        </div>
                    </li>
                </ul>
            </div>
            <!--Slider End-->
        </div>

        <?php
        include 'footer.php';
        ?>
    </body>
</html>