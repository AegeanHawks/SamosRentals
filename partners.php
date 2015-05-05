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

<!--Map with all partners-->
<div class="container">
    <!--Google Map-->
    <div class="col s12" style="padding: 40px 0px 40px 0px;">
        <div class="z-depth-1 video-container">
            <iframe
                frameborder="0"
                src="https://www.google.com/maps/embed/v1/place?key=AIzaSyCd_JYBOj9Se48naYvNkIRAITiAwteJzbU&q=37.9776183,23.734979">
            </iframe>
        </div>
    </div>
    <!--Google Map-->
</div>
<!--Map with all partners-->

<?php
include 'footer.php';
?>
</body>
</html>