
<div class="card col s12 m8 tabregion" id="section_9">
    <div class=" white col s12 " style="padding-top: 15px;padding-bottom: 15px; font-weight: bold">
        <div class="col s12 m9">Ξενοδοχεία</div>
        <div class="col s12 m3">Επεξεργασία</div>
    </div>
    <?php
    try {
        // SQL query to fetch 
        //http://localhost:8000/profile.php?user=Chuck#gomytab_15
        if (isRole("hotelier")) {
            $hotelsViewDetailsStmt = "SELECT ID, Name FROM hotel WHERE hotel.Manager=?";
        } else if (isRole("admin")) {
            $hotelsViewDetailsStmt = "SELECT ID, Name FROM hotel";
        }
        // <editor-fold defaultstate="collapsed" desc="Prepare and run statement">
        // <editor-fold defaultstate="collapsed" desc="Error checking">
        if (!$hotelsViewDetails = $con->prepare($hotelsViewDetailsStmt)) {
            throw new Exception("\nPrepared '" . $hotelsViewDetailsStmt . "' statement failed. \nDetails: " . mysqli_error($con));
        }
        // </editor-fold>
        if (isRole("hotelier")) {
            $hotelsViewDetails->bind_param('s', $_SESSION['userid']);
        }

        // <editor-fold defaultstate="collapsed" desc="Error checking">
        if (!$hotelsViewDetails->execute()) {
            trigger_error("Execute error: \"" . $hotelsViewDetailsStmt . "\"" . "\n");
            trigger_error("Execute failed: (" . $hotelsViewDetails->errno . ") " . $hotelsViewDetails->error . "\"" . "\n");
            throw new Exception("Statement failed to execute");
        }
        // </editor-fold>

        $resultHotelsViewDetails = $hotelsViewDetails->get_result();
        // </editor-fold>

        for ($i = 0; $i < mysqli_num_rows($resultHotelsViewDetails); $i++) {
            $hotelsViewDetailsRow = mysqli_fetch_array($resultHotelsViewDetails);
            ?>

            <div class="white col s12 ElementOFHotelList" id="ElementOFHotelList_<?php echo $i ?>" style="padding-top: 10px;padding-bottom: 10px;">
                <span class="divider col s12"></span>
                <a class="col m9 truncate"><i class="mdi-action-home"></i> <?php echo $hotelsViewDetailsRow["Name"] ?></a>

                <div class="col s12 m3 flow-text center">
                    <a class="btn-floating grey" href="?editHotel=<?php echo $hotelsViewDetailsRow["ID"]; ?>#gomytab_14"><i class="mdi-editor-mode-edit"></i></a>
                </div>
            </div>
            <?php
        }
    } catch (Exception $e) {
        trigger_error("##Error at " . __FILE__ . "\"\nDetails: " . $e->getMessage() . "\"" . "\n");
        $errormessage = "<div class=\"col offset-s1 s10\">
                            <p class=\"col s12\">Κάτι πήγε στραβά </p></div>";
        echo $errormessage;
    }
    ?>
    <span class="divider col s12"></span>    
    <div class="white col s12" style="padding-top: 20px;padding-bottom: 20px;">
        <ul class="pagination" id="HotelPaginationList">
            <li class="disabled"><a onclick="return PaginAuctionsHistory(-2)" href="#!"><i class="mdi-navigation-chevron-left"></i></a></li>
            <li class="active" id="PaginationNumHotel_0"><a onclick="return Paginate('PaginationNumHotel_', 'ElementOFHotelList', 'HotelPaginationList', 0)" href="#!">1</a></li>
            <?php
            for ($i = 1; $i < mysqli_num_rows($resultHotelsViewDetails) / 6; $i++) {
                ?>
                <li class="waves-effect" id="PaginationNumHotel_<?php echo $i ?>"><a onclick="return Paginate('PaginationNumHotel_', 'ElementOFHotelList', 'HotelPaginationList', <?php echo $i ?>)"><?php echo $i + 1 ?></a></li>
                <?php
            }
            ?>
            <li class="waves-effect"><a href="#!"><i class="mdi-navigation-chevron-right"></i></a></li>
        </ul>
    </div>
</div>