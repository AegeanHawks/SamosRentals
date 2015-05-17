
<div class="card col s12 m8 tabregion" id="section_4">
    <div class="white col s12" style="padding-top: 15px;padding-bottom: 15px;">
        <form id="CreateEditAuction" action="profile/saveauction.php" method="GET">
            <div class="input-field col s6">
                <i class="mdi-action-account-circle prefix"></i>
                <input name="AuctionName" id="AuctionTitleInput" type="text" class="validate">
                <label for="AuctionTitleInput">Τίτλος</label>
            </div>
            <div class="input-field col s6">
                <select name="CreateAuctionHotelID" form="CreateEditAuction">
                    <option value="" disabled selected>Επιλέξτε εδώ</option>
                    <?php
                    // SQL query to fetch all hotels
                    $allhotelsStatement;
                    if (isRole("admin")) {
                        $allhotelsStatement = "SELECT Name,ID FROM hotel ORDER BY Name";
                    } else {
                        $allhotelsStatement = "SELECT Name,ID FROM hotel WHERE Manager=? ORDER BY Name";
                    }
                    if (!$allhotels = $con->prepare($allhotelsStatement)) {
                        error_log("Error: \"" . $allhotelsStatement . "\"" . "\n", 3, $errorpath);
                    } else {
                        $allhotels->bind_param('s', $_SESSION['userid']);

                        if (!$allhotels->execute()) {
                            error_log("Error: \"" . $allhotelsStatement . "\"" . "\n", 3, $errorpath);
                            error_log("Execute failed: (" . $allhotels->errno . ") " . $allhotels->error . "\"" . "\n", 3, $errorpath);
                        } else {
                            $resultHotels = $allhotels->get_result();
                            for ($i = 0; $i < mysqli_num_rows($resultHotels); $i++) {
                                $hotelsRow = mysqli_fetch_array($resultHotels);
                                echo '<option value="' . $hotelsRow["ID"] . '">' . $hotelsRow["Name"] . '</option>';
                            }
                        }
                    }
                    ?>
                </select>
                <label>Ξενοδοχεία</label>
            </div>
            <div class="col s12">
                <div class="row">
                    <div class="input-field col s12">
                        <i class="mdi-social-people prefix"></i>
                        <textarea name="Description" id="AuctionDescriptionInput" class="materialize-textarea" length="500"></textarea>
                        <label for="AuctionDescriptionInput">Περιγραφή</label>
                    </div>
                </div>
            </div>
            <div class="input-field col s12 m12 l6">
                <i class="mdi-editor-attach-money prefix"></i>
                <input name="Bid_Price" id="AuctionStartPrice" type="text" pattern="[0-9]{0,6}" class="validate">
                <label for="AuctionStartPrice">Τιμή εκκίνησης</label>
            </div>
            <div class="input-field col s12 m12 l6">
                <i class="mdi-editor-attach-money prefix"></i>
                <input name="Buy_Price" id="AuctionBuyPriceInput" type="text" pattern="[0-9]{0,6}" class="validate">
                <label for="AuctionBuyPriceInput">Τιμή αγοράς</label>
            </div>
            <div class="input-field col s12">
                <i class="mdi-action-description prefix"></i>
                <input name="PeopleCount" id="AuctionPeopleInput" type="text" pattern="[0-9]{0,2}" class="validate">
                <label for="AuctionPeopleInput">Αριθμός ατόμων</label>
            </div>
            <div class="input-field col s12">
                <div class="input-field">
                    <i class="mdi-social-cake prefix"></i>
                    <input name="End_Date" id="birthday" type="text" class="datepicker picker__input">
                    <label for="birthday">Ημερομηνία λήξης</label>
                </div>
            </div>
            <div class="col s12 file-field input-field">
                <div class="file-field input-field">
                    <input name="Images" placeholder="Φωτογραφία" class="file-path validate" type="text"/>
                    <div class="btn">
                        <span>File</span>
                        <input type="file" />
                    </div>
                </div>
            </div>
            <div class="input-field col s12" style="display: none;">
                <input value="null" name="AuctionIDSave" type="text">
            </div>
            <div class="input-field col s12">
                <button class="btn waves-effect waves-light" type="submit">Υποβολή
                    <i class="mdi-content-send right"></i>
                </button>
            </div>
        </form>
    </div>
</div>