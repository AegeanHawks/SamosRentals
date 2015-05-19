
<div class="card row col s12 m8 tabregion" id="section_15">
    <?php
    try {
        // SQL query to fetch 
        //http://localhost:8000/profile.php?user=Chuck#gomytab_15
        if (!isset($_GET['editAuction'])) {
            throw new Exception("Variable editAuction is not set at url");
        }
        $auctionsDetailsStmt = "SELECT auction.ID, auction.Name, auction.Description, PeopleCount, Closed, Bid_Price, Buy_Price, End_Date FROM auction, hotel WHERE hotel.Manager=? AND auction.Hotel=hotel.id AND auction.ID=?";

        // <editor-fold defaultstate="collapsed" desc="Prepare and run statement">
        // <editor-fold defaultstate="collapsed" desc="Error checking">
        if (!$auctionDetails = $con->prepare($auctionsDetailsStmt)) {
            throw new Exception("\nPrepared '".$auctionsDetailsStmt."' statement failed. \nDetails: ".mysqli_error($con));
        }
        // </editor-fold>
        $auctionDetails->bind_param('si', $_SESSION['userid'], $_GET['editAuction']);

        // <editor-fold defaultstate="collapsed" desc="Error checking">
        if (!$auctionDetails->execute()) {
            error_log("Execute error: \"" . $auctionsDetailsStmt . "\"" . "\n", 3, $errorpath);
            error_log("Execute failed: (" . $auctionDetails->errno . ") " . $auctionDetails->error . "\"" . "\n", 3, $errorpath);
            throw new Exception("Statement failed to execute");
        }
        // </editor-fold>

        $resultAuctionDetails = $auctionDetails->get_result();

        // <editor-fold defaultstate="collapsed" desc="Error checking">
        if (!(mysqli_num_rows($resultAuctionDetails) == 1)) {
            throw new Exception("Query lines are " . mysqli_num_rows($resultAuctionDetails) . " instead of 1");
        }
        // </editor-fold>
        // </editor-fold>

        $auctionDetailsRow = mysqli_fetch_array($resultAuctionDetails);
        ?>

        <div class="col offset-s1 s12" style='padding-bottom: 20px'>
            <a class="waves-effect waves-light btn" href="#gomytab_15" onclick="return UserEditsProfile(true, 15)"><i class="mdi-editor-mode-edit right"></i>Επεξεργασια</a>
        </div>
        <form action="profile/saveauction.php" method="get" id="SaveAuctionDetailsForm">
            <div class="col offset-s1 s10">
                <p class="col s4 detailshead">Όνομα: </p>

                <p class="col s8 detailsbody_s_15"><?php echo $auctionDetailsRow["Name"] ?></p>
                <div class="input-field col s6 hidden_form_s_15">
                    <input name="AuctionName" type="text" class="validate" value="<?php echo $auctionDetailsRow["Name"] ?>">
                </div>
            </div>
            <div class="col offset-s1 s10 divider"></div>
            <div class="col offset-s1 s10">
                <p class="col s4 detailshead">Περιγραφή: </p>

                <p class="col s8 detailsbody_s_15"><?php echo $auctionDetailsRow["Description"] ?></p>
                <div class="input-field col s6 hidden_form_s_15">
                    <textarea name="Description" class="materialize-textarea" length="100"><?php echo $auctionDetailsRow["Description"] ?></textarea>
                </div>
            </div>
            <div class="col offset-s1 s10 divider"></div>
            <div class="col offset-s1 s10">
                <p class="col s4 detailshead">Αριθμός ατόμων: </p>

                <p class="col s8 detailsbody_s_15"><?php echo "  " . $auctionDetailsRow["PeopleCount"] ?></p>
                <div class="input-field col s6 hidden_form_s_15">
                    <input name="PeopleCount" type="text" class="validate" value="<?php echo $auctionDetailsRow["PeopleCount"] ?>">
                </div>
            </div>
            <div class="col offset-s1 s10 divider"></div>
            <div class="col offset-s1 s10">
                <p class="col s4 detailshead">Κατάσταση: </p>

                <p class="col s8 detailsbody_s_15">
                    <?php
                    if ($auctionDetailsRow["Closed"] = 1) {
                        echo "Ενεργή";
                    } else {
                        echo "Ανενεργή";
                    }
                    ?>
                </p>
                <div class="input-field col s6 hidden_form_s_15">
                    <select name="Closed" class="validate" required form="SaveAuctionDetailsForm">
                        <option value="1">Ενεργή
                        </option>
                        <option value="0">Ανενεργή
                        </option>
                    </select>
                </div>
            </div>
            <div class="col offset-s1 s10 divider"></div>
            <div class="col offset-s1 s10">
                <p class="col s4 detailshead">Αρχική τιμή: </p>

                <p class="col s8 detailsbody_s_15"><?php echo $auctionDetailsRow["Bid_Price"] ?></p>
                <div class="input-field col s6 hidden_form_s_15">
                    <textarea name="Bid_Price" id="HotelDescriptionInput" class="materialize-textarea"><?php echo $auctionDetailsRow["Bid_Price"] ?></textarea>
                </div>
            </div>
            <div class="col offset-s1 s10 divider"></div>
            <div class="col offset-s1 s10">
                <p class="col s4 detailshead">Τιμή αγοράς: </p>

                <p class="col s6 detailsbody_s_15"><?php echo $auctionDetailsRow["Buy_Price"] ?></p>
                <div class="input-field col s6 hidden_form_s_15">
                    <input name="Buy_Price" id="HotelLocationInput" type="text" class="validate" value="<?php echo $auctionDetailsRow["Buy_Price"] ?>">
                </div>
            </div>
            <div class="col offset-s1 s10 divider"></div>
            <div class="col offset-s1 s10">
                <p class="col s4 detailshead">Ημερομηνία λήξης: </p>

                <p class="col s6 detailsbody_s_15"><?php echo $auctionDetailsRow["End_Date"] ?></p>
                <div class="col s6 input-field hidden_form_s_15">
                    <input  name="End_Date" type="text" class="datepicker picker__input" value="<?php echo $auctionDetailsRow["End_Date"]; ?>"
                            required form="SaveAuctionDetailsForm">
                </div>
            </div>
            <div class="col offset-s1 s10 divider"></div>
            <div class="col s6 m6 l5 file-field input-field hidden_form_s_15">
                <input name="Images" placeholder="Φωτογραφία" class="file-path validate" type="text"/>
                <div class="btn">
                    <span>File</span>
                    <input type="file" />
                </div>
            </div>
            <div class="col offset-s1 s10 divider"></div>
            <input name="AuctionID" style="display: none" type="text" class="validate" value="<?php echo $auctionDetailsRow["ID"] ?>">
            <input name="SaAuDeAction" style="display: none" type="text" class="validate" value="edit">
            <div class="col s12" style="padding-bottom: 20px;padding-top: 40px">
                <button class="btn waves-effect waves-light hidden_form_s_15" type="submit" name="action">ΚΑΤΑΧΩΡΗΣΗ
                    <i class="mdi-content-send right"></i>
                </button>
            </div>
            <div class="col s12 hidden_form_s_15" style='padding-bottom: 20px'>
                <a class="waves-effect waves-light btn" href="#gomytab_15" onclick="return UserEditsProfile(false,15)" id='mytabE_13'><i class="mdi-editor-mode-edit right"></i>Ακύρωση</a>
            </div>
        </form>
        <!--Hotel Details-->
        <?php
    } catch (Exception $e) {
    error_log("##Error at ".__FILE__."\"\nDetails: " . $e->getMessage() . "\"" . "\n", 3, $errorpath);
        $errormessage = "<div class=\"col offset-s1 s10\">
                            <p class=\"col s12\">Κάτι πήγε στραβά </p></div>";
        echo $errormessage;
    }
    ?>
</div>