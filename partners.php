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

//Fetch all cordinates
// SQL query to fetch information of all hotels.
$sql = $con->prepare('SELECT * FROM Hotel');
$sql->execute();

$result = $sql->get_result();
while ($row = mysqli_fetch_array($result)) {
    $name = $row['Name'];
    $Coordinates[$name] = $row['Coordinates'];
}
?>

<!DOCTYPE html>
<html>
<head lang="gr">
    <?php
    $Page_Title = "Συνεργάτες";
    include 'head.php';
    ?>
    <script src="http://maps.google.com/maps/api/js?sensor=false"
            type="text/javascript"></script>
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
        <div id="parts_map" class="z-depth-1 video-container">
        </div>
    </div>
    <!--Google Map-->
</div>
<!--Map with all partners-->

<script type="text/javascript">

    var locations = [
        <?php
        foreach ($Coordinates as $key => &$val) {
            echo "['" . $key . "'," . $val . '],';
        }
        ?>
    ];

    var map = new google.maps.Map(document.getElementById('parts_map'), {
        zoom: 11,
        center: new google.maps.LatLng(37.75, 26.80),
        mapTypeId: google.maps.MapTypeId.ROADMAP
    });

    var infowindow = new google.maps.InfoWindow();

    var marker, i;

    for (i = 0; i < locations.length; i++) {
        marker = new google.maps.Marker({
            position: new google.maps.LatLng(locations[i][1], locations[i][2]),
            map: map
        });

        google.maps.event.addListener(marker, 'click', (function (marker, i) {
            return function () {
                infowindow.setContent(locations[i][0]);
                infowindow.open(map, marker);
            }
        })(marker, i));
    }
</script>

<?php
include 'footer.php';
?>
</body>
</html>