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
$sql = $con->prepare('SELECT COUNT(id) AS allhotels FROM Hotel');
$sql->execute();
$result = $sql->get_result();
$row = mysqli_fetch_array($result);
$AllHotels = $row['allhotels'];

//We check for next page request
$page = 1;
if (isset($_GET['page'])) {
    $page = htmlspecialchars($_GET['page']);
}

//Calculate how many page do we need
$pages = ceil($AllHotels / 6);
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
    $Page_Title = "Ξενοδοχεία";
    include 'head.php';
    ?>
    <!--CSS-->
    <link href="css/star-rating.min.css" rel="stylesheet">
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!--Scripts-->
    <script src="js/Masonry.js"></script>
    <script src="js/star-rating.min.js"></script>

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
</head>
<body class="grey lighten-3">

<!--Navigation Menu-->
<?php
include 'header.php';
?>
<!--Navigation Menu-->

<!--Search-->
<div class="row" style="z-index: 100;">
    <nav class="blue z-depth-1">
        <div class="nav-wrapper">
            <form method="get" class="offset-l2 col l8 m12" style="margin-top: 10px;">
                <div class="input-field ">
                    <input id="search" name="search" type="search" placeholder="    Αναζητήστε εδώ..."
                           required>
                    <label for="search"><i class="mdi-action-search"></i></label>
                    <i class="mdi-navigation-close"></i>
                </div>
            </form>
        </div>
    </nav>
</div>
<!--Search-->

<!--Hotel Info-->
<div class="container" style="padding-top: 50px;">
    <div class="row">
        <div id="stream">
            <?php
            if (isset($_GET['search'])) {
                // SQL query to fetch information of hotel.
                $search = '%' . str_replace(" ", "%", $_GET['search']) . '%';
                $sql = $con->prepare('SELECT Hotel.*, User.LastName,User.FirstName,User.Image AS M_Image FROM Hotel, User WHERE User.Username=Hotel.Manager AND (Hotel.Name LIKE ? OR Hotel.Description LIKE ?) ORDER BY Hotel.id'); //SELECT * FROM Auction
                $sql->bind_param('ss', $search, $search);
                $sql->execute();
            } else {
                // SQL query to fetch information of hotel.
                $sql = $con->prepare('SELECT Hotel.*, User.LastName,User.FirstName,User.Image AS M_Image FROM Hotel, User WHERE User.Username=Hotel.Manager ORDER BY Hotel.id DESC LIMIT ? , ?'); //SELECT * FROM Hotel
                $id = ($page - 1) * 6;
                $end = $id + 6;
                $sql->bind_param('ii', $id, $end);
                $sql->execute();
            }

            $result = $sql->get_result();
            if (mysqli_num_rows($result) == 0) {
                //die(include '404.php');
            }
            while ($row = mysqli_fetch_array($result)) {
                $id = $row['ID'];
                $Name = $row['Name'];
                $Tel = $row['Tel'];
                $Description = $row['Description'];
                $Grade = $row['Grade'];
                $Image = $row['Image'];
                $Manager = $row['Manager'];
                $lname = $row['LastName'];
                $fname = $row['FirstName'];
                $m_image = $row['M_Image'];
                ?>
                <div class="col s12 m6 l4">
                    <div id="<?php echo 'hotel_' . $id; ?>" class="card">
                        <div class="card-image waves-effect waves-block waves-light">
                            <img class="activator" onclick="flip('<?php echo 'hotel_' . $id; ?>')"
                                 src="<?php echo $Image; ?>">
                        </div>
                        <div class="card-content">
                        <span onclick="flip('<?php echo 'hotel_' . $id; ?>')" src="images/office1.jpg"
                              class="card-title activator grey-text text-darken-4"><?php echo $Name; ?><i
                                class="mdi-navigation-more-vert right"></i></span>

                            <p><span><?php echo $Description; ?></span>
                            </p>

                            <p><a href="<?php echo 'hotel.php?id=' . $id; ?>"
                                  onclick="$('#<?php echo 'hotel_' . $id; ?>').addClass('animated  pulse')"
                                  src="images/office1.jpg">Διαβάστε
                                    περισσότερα...</a></p>
                        </div>
                        <div class="card-reveal">
                            <span class="card-title grey-text text-darken-4"
                                  onclick="flip('<?php echo 'hotel_' . $id; ?>')">Περιγραφή</span>

                            <p><?php echo $Description; ?>

                            <li class="divider"></li>
                            <div style="padding: 10px 0px 10px 0px;">Τηλέφωνο: <?php echo $Tel; ?></div>
                            <li class="divider"></li>
                            <p>Βαθμολογία: <?php echo round($Grade, 1); ?>
                                <input id="input-id" type="number" class="rating" value="<?php echo $Grade; ?>" max="5"
                                       readonly="true" data-size="xs"></p>
                            <li class="divider"></li>
                            <div
                                style="padding-top: 10px; font-size: 1.2em;">
                                Μάνατζερ: <?php echo $lname . ' ' . $fname; ?></div>

                            <div class="center valign-wrapper" style="padding: 5px 50px 0px 50px;">
                                <img id="<?php echo 'img_prof' . $id; ?>"
                                     onclick="rotate('<?php echo 'img_prof' . $id; ?>')"
                                     class=" circle responsive-img z-depth-3 grey lighten-3" "
                                src="<?php echo $m_image; ?>">
                            </div>
                            </p>
                        </div>
                    </div>
                </div>
                <?php
            }

            mysqli_free_result($result);
            ?>
        </div>
    </div>

    <?php
    if ($AllHotels > 6) {
        ?>
        <div class="row">
            <div id="pages">
                <ul class="pagination right">
                    <li class=<?php if ($page < 2) echo '"disabled"><a>'; else echo '"waves-effect"><a href="hotels.php?page=' . ($page - 1) . '">'; ?><i
                        class="mdi-navigation-chevron-left"></i></a></li>
                    <?php
                    $i = 1;
                    while ($i <= $pages && $i < 7) {
                        //debug_to_console($page);

                        if ($pages > 6 && $i == 6) {
                            echo '<li>...</li><li class="';
                            if ($page == $i) {
                                echo 'active';
                            } else {
                                echo 'waves-effect';
                            }
                            echo '"><a href="hotels.php?page=' . $pages . '">' . $pages . '</a></li>';
                        } else {
                            echo '<li class="';
                            if ($page == $i) {
                                echo 'active';
                            } else {
                                echo 'waves-effect';
                            }
                            echo '"><a href="hotels.php?page=' . $i . '">' . $i . '</a></li>';
                        }
                        $i++;
                    }
                    ?>
                    <li class=<?php if ($page + 1 > $pages) echo '"disabled"><a>'; else echo '"waves-effect"><a href="hotels.php?page=' . ($page + 1) . '">'; ?><i
                        class="mdi-navigation-chevron-right"></i></a></li>
                </ul>
            </div>
        </div>
    <?php
    }
    ?>
</div>
<!--Hotel Info-->

<!--footer-->
<?php
include 'footer.php';
?>
<!--footer-->

</body>
</html>