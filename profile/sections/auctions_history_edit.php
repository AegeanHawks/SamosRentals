
<div class="card col s12 m8 tabregion" id="section_2">
    <div class=" white col s12 " style="padding-top: 15px;padding-bottom: 15px; font-weight: bold">
        <div class="col s12 m3">Τίτλος</div>
        <div class="col s12 m3">Τιμή Έναρξης</div>
        <div class="col s12 m4">Τιμή Αγοράς</div>
        <div class="col s12 m2">Επεξεργασία</div>
    </div>
    <span class="divider col s12"></span>
    <?php
    // SQL query to fetch all hotels
    if (isRole("hotelier")) {
        $acutionsStatment = "SELECT auction.ID, auction.Name, Bid_Price, Buy_Price, End_Date FROM auction, hotel WHERE hotel.Manager=? AND auction.hotel=hotel.id ORDER BY End_Date desc";
    } else if (isRole("admin")) {
        $acutionsStatment = "SELECT auction.ID, auction.Name, Bid_Price, Buy_Price, End_Date FROM auction, hotel WHERE auction.hotel=hotel.id ORDER BY End_Date desc";
    }


    if (!$userauctions = $con->prepare($acutionsStatment)) {
        debug_to_console("Prepare Error: \"" . $acutionsStatment . "\"" . "\n", 3, $errorpath);
    } else {
        if (isRole("hotelier")) {
            $userauctions->bind_param('s', $_SESSION['userid']);
        }
            debug_to_console("Execute error: \"" . $acutionsStatment . "\"" . "\n", 3, $errorpath);

        if (!$userauctions->execute()) {
            debug_to_console("Execute error: \"" . $acutionsStatment . "\"" . "\n", 3, $errorpath);
            debug_to_console("Execute failed: (" . $userauctions->errno . ") " . $userauctions->error . "\"" . "\n", 3, $errorpath);
        } else {
            $resultuserauction = $userauctions->get_result();
            for ($i = 0; $i < mysqli_num_rows($resultuserauction); $i++) {
                $userauctionsRow = mysqli_fetch_array($resultuserauction);
                ?>
                <div class="white col s12 PaginAuctionsHiEd" id="PaginAuctionsHiEd_<?php echo $i; ?>" style="padding-top: 10px;padding-bottom: 10px;">
                    <a class="col s12 m3 truncate" href="#!"><i class="mdi-action-home"></i><?php echo $userauctionsRow["Name"]; ?></a>

                    <div class="col s12 m3 flow-text"><i class="mdi-editor-attach-money"> </i><?php echo $userauctionsRow["Bid_Price"]; ?></div>
                    <div class="col s12 m4 flow-text"><i class="mdi-editor-attach-money"> </i><?php echo $userauctionsRow["Buy_Price"]; ?></div>
                    <div class="col s12 m2 flow-text">
                        <a class="btn-floating grey" href="?editAuction=<?php echo $userauctionsRow["ID"]; ?>#gomytab_15"><i class="mdi-editor-mode-edit"></i></a>
                    </div>
                    <div class="divider"></div>
                </div>
                <?php
            }
        }
    }
    ?>
    <span class="divider col s12"></span>
    <div class="white col s12" style="padding-top: 20px;padding-bottom: 20px;">
        <ul class="pagination" id="AuctionPaginationList">
            <li class="disabled"><a onclick="return PaginAuctionsHistory(-2)" href="#!"><i class="mdi-navigation-chevron-left"></i></a></li>
            <li class="active" id="PaginationNumAuct_0"><a onclick="return PaginAuctionsHistory(0)" href="#!">1</a></li>
            <?php
            for ($i = 1; $i < mysqli_num_rows($resultuserauction) / 6; $i++) {
                ?>
                <li class="waves-effect" id="PaginationNumAuct_<?php echo $i ?>"><a onclick="return PaginAuctionsHistory(<?php echo $i ?>)"><?php echo $i + 1 ?></a></li>
                <?php
            }
            ?>
            <li class="waves-effect"><a href="#!"><i class="mdi-navigation-chevron-right"></i></a></li>
        </ul>
    </div>
</div>