
<div class="z-depth-3 col s12 m8 tabregion" id="section_5">

    <div class="col s12" style="padding-top: 20px; padding-bottom: 30px;">
        <a class="waves-effect waves-light orange darken-1 btn">ΠΡΟΒΟΛΗ ΣΕΛΙΔΑΣ</a>
    </div>

    <form action="profile/savehotel.php" method="GET" id="CreateEditHotel">
        <div class="input-field col s6">
            <i class="mdi-action-account-circle prefix"></i>
            <input name="SaEdHotName" id="HotelNameInput" type="text" class="validate">
            <label for="HotelNameInput">Όνομα ξενοδοχείου</label>
        </div>
        <?php
        if (isRole("admin")) {
            ?>
            <div class="input-field col s6">
                <select name="SaEdHotChooseHotelier" form="CreateEditHotel">
                    <option value="" disabled selected>Επιλέξτε εδώ</option>
                    <?php
                    // SQL query to fetch all hotels
                    $allhoteliersQuery = "SELECT Username FROM user WHERE role<2 ORDER BY Username";

                    if (!$allhoteliers = $con->prepare($allhoteliersQuery)) {
                        debug_to_console("Error: \"" . $allhotelsStatement . "\"" . "\n", 3, $errorpath);
                    } else {
                        $allhoteliers->execute();

                        if ($allhoteliers == NULL) {
                            debug_to_console("Could not run query: \"" . $allhoteliersQuery . "\"" . "\n", 3, $errorpath);
                        }
                        $resultHoteliers = $allhoteliers->get_result();

                        for ($i = 0; $i < mysqli_num_rows($resultHoteliers); $i++) {
                            $hoteliersRow = mysqli_fetch_array($resultHoteliers);
                            echo '<option value="' . $hoteliersRow["Username"] . '">' . $hoteliersRow["Username"] . '</option>';
                        }
                    }
                    ?>
                </select>
                <label>Ξενοδόχοι</label>
            </div>
            <?php
        }
        ?>
        <div class="input-field col s6">
            <i class="mdi-communication-phone prefix"></i>
            <input name="SaEdHotTel" id="SaEdHotTel" type="text" class="validate">
            <label for="SaEdHotTel">Τηλέφωνο</label>
        </div>
        <div class="input-field col s6">
            <i class="mdi-communication-location-on prefix"></i>
            <input name="SaEdHotCoordinates" id="HotelLocationInput" type="text" class="validate">
            <label for="HotelLocationInput">Τοποθεσία</label>
        </div>
        <div class="input-field col s12">
            <i class="mdi-action-description prefix"></i>
            <textarea name="SaEdHotDescription" id="HotelDescriptionInput" class="materialize-textarea" length="500"></textarea>
            <label for="HotelDescriptionInput">Περιγραφή</label>
        </div>
        <div class="input-field col s12">
            <i class="mdi-action-face-unlock prefix"></i>
            <textarea name="SaEdHotComforts" id="HotelDescriptionInput" class="materialize-textarea"></textarea>
            <label for="HotelDescriptionInput">Ανέσεις</label>
        </div>
        <div class="col s6 m6 l5 file-field input-field">
            <input name="SaEdHotImage" placeholder="Φωτογραφία" class="file-path validate" type="text"/>
            <div class="btn">
                <span>File</span>
                <input type="file" />
            </div>
        </div>
        <div class="input-field col s12" style="display: none;">
            <input value="new" name="SaEdHotAction" type="text">
        </div>
        <div class="col s12" style="padding-bottom: 20px;padding-top: 40px">
            <button class="btn waves-effect waves-light" type="submit" name="action">ΚΑΤΑΧΩΡΗΣΗ
                <i class="mdi-content-send right"></i>
            </button>
        </div>
    </form>
</div>