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
    $Page_Title = "Ξενοδοχείο";
    include 'head.php';
    ?>

    <style>
        .video-container {
            position: relative;
            overflow: hidden;
        }

        iframe {
            position: absolute;
        }
    </style>
</head>
<body class="white">

<?php
include 'header.php';
?>

<div class="parallax-container" style="height: 600px">
    <div class="parallax"><img src="images/hotel1.jpg"></div>
</div>

<div class="row container">

    <!--Title and Description-->
    <div class="section no-pad-bot" style="margin-top: -5%;">
        <div class="row">
            <div class="col offset-l2 l8 s12 white z-depth-3">
                <div class="col l12 m8 s12">
                    <h4 class="grey-text darken-2 light">Samos Resorts</h4>

                    <p class="grey-text darken-3">Ένα από τα πιο γνωστά ξενοδοχεία στο νησί, βρίσκεται στο πιο κεντρικό
                        σημείο
                        της γραφικής πρωτεύουσας Βαθύ. Προσφέρουμε ανέσεις και υπηρεσίες υψηλού επιπέδου στις διακοπές
                        σας ή
                        απλά στον καφέ που απολαμβάνετε κοντά μας. Η διεύθυνση και το προσωπικό καταβάλλουμε κάθε
                        προσπάθεια για
                        ευχάριστη παραμονή και αξέχαστες εμπειρίες. Χαρείτε τη διαμονή σας στη Σάμο, κάθε μέρα...</p>
                </div>
            </div>
        </div>
    </div>
    <!--Title and Description-->
    <div class="card row" style="padding: 10px;margin-top: 40px;margin-bottom: 40px;">
        <ul class="z-depth-1 col s12 l6 collection">
            <li class="collection-item avatar">
                <i class="mdi-action-accessibility circle blue"></i>
                <span class="title truncate">Αριθμός ατόμων</span>

                <p>
                    2
                </p>
            </li>
            <li class="collection-item avatar">
                <i class="mdi-communication-messenger circle orange"></i>
                <span class="title truncate">Πληροφορίες ξενοδοχείου</span>

                <p><a href="#">
                        Grand Budapest Hotel
                    </a>
                </p>
            </li>

            <li class="collection-item avatar">
                <i class="mdi-communication-phone circle green"></i>
                <span class="title">Τηλέφωνο επικοινωνίας</span>

                <p>
                    2
                </p>
            </li>
            <li class="collection-item">
                <span class="title">Βαθμολογία ξενοδοχείου</span><br>
                <i class="mdi-action-star-rate circle amber accent-3"></i>
                <i class="mdi-action-star-rate circle amber accent-3"></i>
                <i class="mdi-action-star-rate circle amber accent-3"></i>
                <i class="mdi-action-star-rate circle amber accent-3"></i>
                <i class="mdi-action-star-rate circle amber accent-3"></i>
            </li>
        </ul>
        <!--Google Map-->
        <div class="col s12 l6">
            <div class="z-depth-1 video-container">
                <iframe
                    frameborder="0"
                    src="https://www.google.com/maps/embed/v1/place?key=AIzaSyCd_JYBOj9Se48naYvNkIRAITiAwteJzbU&q=37.9776183,23.734979">
                </iframe>
            </div>
        </div>
        <!--Google Map-->
    </div>

    <!--All Auctions-->
    <div class="card row">
        <div class="col s12 tabregion" id="section_2">
            <div class=" white col s12 " style="padding-top: 15px;padding-bottom: 15px; font-weight: bold">
                <div class="col s12 m3">Τίτλος</div>
                <div class="col s12 m3">Τιμή Έναρξης</div>
                <div class="col s12 m4">Υψηλότερη Πλειοδοσία</div>
                <div class="col s12 m2">Ενεργά</div>
            </div>
            <li class="divider col s12"></li>
            <div class="white col s12" style="padding-top: 10px;padding-bottom: 10px;">
                <a class="col s12 m3 truncate" href="#!"><i class="mdi-action-home"></i> Δωμάτια σε τιμή ευκαιρίας
                    ευκαιρίας ευκαιρίας</a>

                <div class="col s12 m3 flow-text"><i class="mdi-editor-attach-money"> </i>35</div>
                <div class="col s12 m4 flow-text"><i class="mdi-editor-attach-money"> </i>55</div>
                <div class="col s12 m2 flow-text">
                    <div class="btn-floating green"><i class="mdi-av-play-circle-outline"> </i></div>
                </div>
                <div class="divider"></div>
            </div>
            <li class="divider col s12"></li>
            <div class="white col s12" style="padding-top: 10px;padding-bottom: 10px;">
                <a class="col s12 m3" href="#!"><i class="mdi-action-home"></i> Δωμάτια σε τιμή ευκαιρίας </a>

                <div class="col s12 m3 flow-text"><i class="mdi-editor-attach-money"> </i>35</div>
                <div class="col s12 m4 flow-text"><i class="mdi-editor-attach-money"> </i>40</div>
                <div class="col s12 m2 flow-text">
                    <div class="btn-floating red disabled"><i class="mdi-av-pause"></i></div>
                </div>
            </div>
        </div>
    </div>
    <!--All Auctions-->

</div>

<?php
include 'footer.php';
?>
</body>
</html>