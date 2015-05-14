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
<head lang="gr">
    <?php
    $Page_Title = "Αρχική";
    include 'head.php';
    ?>
</head>
<body class="white">

<!--Navigation Menu-->
<?php
include 'header.php';
?>
<!--Navigation Menu-->

<div class="parallax-container" style="height: 550px">
    <div class="parallax"><img src="images/website/header.jpg"></div>
</div>
<?php
if (!$logged) {
    ?>
    <div class="section no-pad-bot" style="margin-top: -8%;">
        <div class="row">
            <div class="col offset-l3 l6 s12 white z-depth-3">
                <div class="entry-content">

                    <div class="col s12">
                        <h4 class="grey-text darken-2 light center-align">Καλωσήρθες</h4>
                        <h5 class="grey-text darken-2 light">Ανακάλυψε και κάνε κράτηση δωματίου για τις διακοπές των
                            ονείρων σου...</h5>

                        <p class="grey-text darken-3">Το Samos Rentals περιέχει μια τεράστια βάση από 100+ δωμάτια και
                            ξενοδοχεία στο νησί. Αν έχεις ξενοδοχείο ή ενοικιαζόμενα δωμάτια τότε εγγράχου στην υπηρεσία μας
                            και δες την επιχείρηση και τα κέρδη σου να απογειώνονται!!!</p>

                        <p class="grey-text darken-3">Αν δεν έχεις γίνει ακόμα μέλος, τότε κάνε εγγραφή για να μπορείς και
                            εσύ να κατοχυρώσεις ένα από τα δεκάδες δωμάτια που δημοπρατούνται καθημερινά...</p>

                        <div class="col s6 offset-s4">
                            <p><a id="btn_register" onclick="$('#btn_register').addClass('animated fadeOutUp')"
                                  class="waves-effect waves-light btn light-blue darken-3" href="register.php"><i
                                    class="mdi-content-create left"></i>Εγγραψου τωρα!</a>
                            </p>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
<?php }
?>
<div class="" id="about">
    <div class="container">
        <div class="row">
            <div class="col m12 l10 offset-l1">
                <h2 class="grey-text darken-2 light center-align">Όλα τα ξενοδοχεία του νησιού</h2>

                <p class="grey-text darken-2 light flow-text center-align .disBlock">Το Samos Rentals είναι μια μοναδική
                    πλατφόρμα που
                    βοηθά τουρίστες και ιδιοκτήτες ξενοδοχείων να αλληλεπιδρούν ακόμα καλύτερα. Αν είστε ξενοδόχος
                    μπορείτε να διαφημίσετε το ξενοδοχείο σας, καθώς και να αυξήσετε την πληρότητα των δωματίων σας μέσα
                    από την μοναδική διαδικτυακή μας πλατφόρμα. Αν πάλι ψάχνετε δωμάτιο τότε μπορείτε απλά να κάνετε
                    κράτηση!</p>
            </div>

            <div class="col s12 m11 offset-m1">
                <div class="row" id="projects">
                    <div class="col s4 m3">
                        <img src="images/website/samos1.jpg"
                             class="circle materialboxed responsive-img z-depth-1 grey lighten-2" style="padding: 5px">
                    </div>
                    <div class="col s4 m3 offset-m1 offset-l1">
                        <img src="images/website/samos2.jpg"
                             class="circle materialboxed responsive-img z-depth-1 grey lighten-2" style="padding: 5px">
                    </div>
                    <div class="col s4 m3 offset-m1 offset-l1">
                        <img src="images/website/samos3.jpg"
                             class="circle materialboxed responsive-img z-depth-1 grey lighten-2" style="padding: 5px">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
include 'footer.php';
?>

</body>
</html>