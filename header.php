<div class="navbar-fixed">
    <nav class="blue darken-4 z-depth-3" role="navigation">
        <div class="nav-wrapper container">
            <div class="valign-demo valign-wrapper left">
                <a id="logo-container" href="index.php" class="brand-logo"
                   onclick="$('#logo-container').addClass('animated pulse')">
                    <div class="hide-on-med-and-down" style="margin-top: 80px">
                        <span class="left" style="height: 74px; z-index: 99;"><img src="images/website/logo.png"></span>
                        <span class="white-text left " style="padding-left:15px;font-size: 0.7em;font-weight:300;">Samos Rentals</span>
                    </div>
                    <div class="hide-on-large-only" style="margin-top: 65px">
                        <span class="white-text truncate">Samos Rentals</span>
                    </div>
                </a>
            </div>

            <?php
            if (!islogged()) { ?>
            <div class="right hide-on-med-and-down">
                <p><a href="login.php" class="waves-effect waves-light btn white-text"><span
                        class="mdi-action-input right" style="padding-left: 10px"></span>Συνδεση</a></p>
            </div>


                <ul id="nav-mobile" class="right side-nav blue accent-3">
                    <li><a href="hotels.php" class="white-text">Ξενοδοχεία</a></li>
                    <li><a href="auctions.php" class="white-text">Δημοπρασίες</a></li>
                    <li><a href="register.php" class=" white-text waves-effect waves-stamplay btn-flat">Εγγραφη</a></li>
                    <li><a href="login.php" class="waves-effect waves-light btn white-text">Συνδεση</a></li>
                </ul>
            <?php } else { ?>
                    <a class="dropdown-button right hide-on-med-and-down" data-beloworigin="true" data-activates="dropdown"
                       href="#">
                        <div class="card waves-effect waves-teal white z-depth-2 valign-wrapper">
                                <span class="grey-text truncate valign"
                                      style="margin-right: 10px; margin-left: 10px; font-size: 1.2em;"><img
                                        src="<?php echo $_SESSION['avatar']; ?>"
                                        style="padding-top: 5px;height: 48px;margin-right: 10px;"
                                        class="valign circle left"><span><?php echo $_SESSION['fname'] . ' ' . $_SESSION['lname']; ?></span></span>
                        </div>
                    </a>

                <ul id="dropdown" class="card dropdown-content animated swing">
                    <?php if (isRole("user")) { ?>
                        <li><a href="profile.php?user=<?php echo $_SESSION['userid']; ?>#gomytab_11"><span
                                    class="mdi-action-settings left black-text"
                                    style="padding-right: 10px"></span>Ιστορικό</a></li>
                    <?php } else if (isRole("hotelier")) { ?>
                        <li><a href="profile.php?user=<?php echo $_SESSION['userid']; ?>#gomytab_9"><span
                                    class="mdi-action-settings left black-text"
                                    style="padding-right: 10px"></span>Το ξενοδοχείο</a></li>
                    <?php } ?>
                        <li><a href="profile.php?user=<?php echo $_SESSION['userid']; ?>"><span
                                    class="mdi-social-person left black-text"
                                               style="padding-right: 10px"></span>Προφίλ</a></li>
                        <li class="divider"></li>
                        <li><a href="logout.php"><span class="mdi-action-settings-power left black-text"
                                               style="padding-right: 10px"></span>Αποσύνδεση</a></li>
                    </ul>

                <ul id="nav-mobile" class="right side-nav blue accent-3">
                    <li class="blue darken-3"><img
                            src="<?php echo $_SESSION['avatar']; ?>"
                            style="padding-top: 5px;height: 48px;margin-right: 10px;"
                            class="valign circle left">
                        <span><?php echo $_SESSION['fname'] . ' ' . $_SESSION['lname']; ?></span>
                    </li>
                    <li><a href="profile.php?user=<?php echo $_SESSION['userid']; ?>" class="white-text">Προφίλ</a>
                    <li><a href="hotels.php" class="white-text">Ξενοδοχεία</a></li>
                    <li><a href="auctions.php" class="white-text">Δημοπρασίες</a></li>
                    <li><a href="logout.php" class="white-text waves-red">Αποσύνδεση</a></li>
                    </li>
                </ul>
            <?php
            }
            ?>

            <ul class="right hide-on-med-and-down">
                <li class="waves-effect waves-light"><a href="hotels.php" class="white-text" id="menu_hotels"
                                                        onclick="$('#menu_hotels').addClass('animated swing')">Ξενοδοχεία</a>
                </li>
                <li class="waves-effect waves-light"><a href="auctions.php" class="white-text" id="menu_auctions"
                                                        onclick="$('#menu_auctions').addClass('animated swing')">Δημοπρασίες</a>
                </li>
            </ul>

            <a class="button-collapse" href="#" data-activates="nav-mobile"><i class="mdi-navigation-menu"></i></a>
        </div>
    </nav>
</div>