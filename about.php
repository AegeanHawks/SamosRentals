<?php
include 'admin/configuration.php';
session_start();
?>

<!DOCTYPE html>
<html>
<head lang="en">
    <?php
    $Page_Title = "Ποίοι είμαστε";
    include 'head.php';
    ?>
    <script src="js/typewriter.js"></script>
    <script>
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
</head>
<body class="white">

<!--Navigation Menu-->
<?php
include 'header.php';
?>
<!--Navigation Menu-->

<div class="container" style="padding: 50px 0px 10px 0px;">
    <div class="row center-align">
        <div class="col s6 offset-s3 center-align" style="padding: 20px">
            <div class="flow-text easter_egg"></div>
            <script>
                var tw = new Typewriter('.easter_egg', {
                    text: 'Μια φορά και έναν καιρό, στο μακρινό βασίλειο του Καρλοβάσου ζούσαν 2 πλάσματα περίεργα. Το ένα ήταν ατάλαντος κιθαρίστας και το άλλο ένα άθλιο TROLL....',
                    interval: 'human',
                    lowerBound: 30,
                    upperBound: 130
                });
                tw.type();
            </script>
        </div>
        <div class="col l4 m6 offset-l1" style="padding: 20px">
            <img id="rambou" onclick="rotate('rambou')" class="circle responsive-img z-depth-1 grey lighten-3"
                 style="padding: 5px"
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
            <img id="armag" onclick="rotate('armag')" class="circle responsive-img z-depth-1 grey lighten-3"
                 style="padding: 5px"
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
    </div>

</div>
<?php
include 'footer.php';
?>

</body>
</html>
