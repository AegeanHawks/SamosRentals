
<div class="card row col s12 m8 tabregion" id="section_14">
    <?php
    try {
        // SQL query to fetch 

        if (!isset($_GET['editHotel'])) {
            throw new Exception("Variable editAuction is not set at url");
        }
        if (isRole("admin")) {
            $hotelsDetailsStmt = "SELECT ID,Name, Tel, Description, Coordinates,Comforts,Grade, Manager FROM hotel WHERE ID=?";
            $hotelDetails = $con->prepare($hotelsDetailsStmt);
            $hotelDetails->bind_param('i', $_GET['editHotel']);
        } else {
            $hotelsDetailsStmt = "SELECT ID,Name, Tel, Description, Coordinates,Comforts,Grade, Manager FROM hotel WHERE hotel.Manager=? AND ID=?";
            $hotelDetails = $con->prepare($hotelsDetailsStmt);
            $hotelDetails->bind_param('si', $_SESSION['userid'], $_GET['editHotel']);
        }

        // <editor-fold defaultstate="collapsed" desc="Error checking">
        if (!$hotelDetails->execute()) {
            trigger_error("Execute error: \"" . $hotelsDetailsStmt . "\"" . "\n");
            trigger_error("Execute failed: (" . $hotelDetails->errno . ") " . $hotelDetails->error . "\"" . "\n");
            throw new Exception("Execute statement failed");
        }
        // </editor-fold>

        $resulthoteldetails = $hotelDetails->get_result();
        $hotelDetailsRow;

        // <editor-fold defaultstate="collapsed" desc="Error checking">
        if (!(mysqli_num_rows($resulthoteldetails) == 1)) {
            throw new Exception("Query lines are " . mysqli_num_rows($resulthoteldetails) . " instead of 1");
        }
        // </editor-fold>

        $hotelDetailsRow = mysqli_fetch_array($resulthoteldetails);
        ?>

        <div class="col offset-s1 s12" style='padding-bottom: 20px'>
            <a class="waves-effect waves-light btn" href="#gomytab_14" onclick="return UserEditsProfile(true, 14)"><i class="mdi-editor-mode-edit right"></i>Επεξεργασια</a>
        </div>
        <form action="profile/savehotel.php" method="post" id="SaveHotelForm">
            <div class="col offset-s1 s10">
                <p class="col s4 detailshead">Όνομα: </p>

                <p class="col s8 detailsbody_s_14"><?php echo $hotelDetailsRow["Name"] ?></p>
                <div class="input-field col s6 hidden_form_s_14">
                    <input name="SaEdHotName" id="HotelNameInput" type="text" class="validate" value="<?php echo $hotelDetailsRow["Name"] ?>">
                </div>
            </div>
            <div class="col offset-s1 s10 divider"></div>
            <div class="col offset-s1 s10">
                <p class="col s4 detailshead">Περιγραφή: </p>

                <p class="col s8 detailsbody_s_14"><?php echo $hotelDetailsRow["Description"] ?></p>
                <div class="input-field col s6 hidden_form_s_14">
                    <textarea name="SaEdHotDescription" id="HotelDescriptionInput" class="materialize-textarea" length="100"><?php echo $hotelDetailsRow["Description"] ?></textarea>
                </div>
            </div>
            <div class="col offset-s1 s10 divider"></div>
            <div class="col offset-s1 s10">
                <p class="col s4 detailshead">Τηλέφωνο: </p>

                <p class="col s8 detailsbody_s_14"><?php echo $hotelDetailsRow["Tel"] ?></p>
                <div class="input-field col s6 hidden_form_s_14">
                    <input name="SaEdHotTel" id="SaEdHotTel" type="text" class="validate" value="<?php echo $hotelDetailsRow["Tel"] ?>">
                </div>
            </div>
            <div class="col offset-s1 s10 divider"></div>
            <div class="col offset-s1 s10">
                <p class="col s4 detailshead">Βαθμολογία: </p>

                <p class="col s8 detailsbody_s_14"><?php echo "  " . $hotelDetailsRow["Grade"] ?></p>
                <p class="col s6 detailsbody_s_14 hidden_form_s_14"><?php echo "  " . $hotelDetailsRow["Grade"] ?></p>
            </div>
            <div class="col offset-s1 s10 divider"></div>
            <div class="col offset-s1 s10">
                <p class="col s4 detailshead">Ανέσεις: </p>

                <p class="col s8 detailsbody_s_14"><?php echo $hotelDetailsRow["Comforts"] ?></p>
                <div class="input-field col s6 hidden_form_s_14">
                    <textarea name="SaEdHotComforts" id="HotelDescriptionInput" class="materialize-textarea"><?php echo $hotelDetailsRow["Comforts"] ?></textarea>
                </div>
            </div>
            <div class="col offset-s1 s10 divider"></div>
            <div class="col offset-s1 s10">
                <p class="col s4 detailshead">Μανατζερ: </p>
                <p class="col s4 detailsbody_s_14"><?php echo $hotelDetailsRow["Manager"] ?></p>

                <p class="col s4 hidden_form_s_14"><?php echo $hotelDetailsRow["Manager"] ?></p>

                <div class="input-field col s6" style="display: none">
                    <input name="SaEdHotChooseHotelier" type="text" class="validate"
                           value="<?php echo $hotelDetailsRow["Manager"] ?>">
                </div>
            </div>
            <div class="col offset-s1 s10 divider"></div>
            <div class="col offset-s1 s10">
                <p class="col s4 detailshead">Τοποθεσία: </p>

                <p class="col s6 detailsbody_s_14"><?php echo $hotelDetailsRow["Coordinates"] ?></p>

                <div class="input-field col s12 detailsbody_s_14">
                    <div align="center" id="map1" style="width:auto;height:300px;"></div>
                    <script>
                        function initialize1() {
                            var location = ['<?php echo $hotelDetailsRow["Name"] ?>', <?php echo $hotelDetailsRow["Coordinates"] ?>];
                            var marker = new google.maps.Marker({
                                position: new google.maps.LatLng(location[1], location[2])
                            });

                            var mapProp = {
                                zoom: 11,
                                center: new google.maps.LatLng(location[1], location[2]),
                                mapTypeId: google.maps.MapTypeId.ROADMAP
                            };

                            var infowindow = new google.maps.InfoWindow({
                                content: location[0]
                            });
                            var map = new google.maps.Map(document.getElementById("map1"), mapProp);
                            marker.setMap(null);
                            marker = new google.maps.Marker({
                                position: new google.maps.LatLng(location[1], location[2]),
                                map: map
                            });
                            google.maps.event.addListener(marker, 'click', function () {
                                infowindow.open(map, marker);
                            });
                        }
                        google.maps.event.addDomListener(window, 'load', initialize1);

                    </script>
                </div>
                <div class="input-field col s6 hidden_form_s_14">
                    <input name="SaEdHotCoordinates" id="HotelLocationInput1" type="text" class="validate"
                           value="<?php echo $hotelDetailsRow["Coordinates"] ?>">
                </div>
                <div class="input-field col s12 hidden_form_s_14">
                    <div align="center" id="map2" style="width:auto;height:300px;"></div>
                    <br>
                    <script>
                        function initialize2() {
                            var mcenter = new google.maps.LatLng(<?php echo $hotelDetailsRow["Coordinates"] ?>);
                            var marker = new google.maps.Marker({
                                position: mcenter
                            });
                            var mapProp = {
                                zoom: 11,
                                center: mcenter,
                                mapTypeId: google.maps.MapTypeId.ROADMAP
                            };
                            var map = new google.maps.Map(document.getElementById("map2"), mapProp);
                            marker.setMap(null);
                            marker = new google.maps.Marker({
                                position: mcenter,
                                map: map
                            });
                            google.maps.event.addListener(map, 'click', function (event) {
                                marker.setMap(null);
                                marker = new google.maps.Marker({
                                    position: event.latLng,
                                    map: map
                                });
                                document.getElementById('HotelLocationInput1').value = marker.getPosition().lat() + "," + marker.getPosition().lng();
                            });
                        }
                        google.maps.event.addDomListener(window, 'load', initialize2);
                    </script>
                </div>
            </div>
            <div class="col offset-s1 s10 divider"></div>
            <div class="col offset-s1 s6 file-field input-field hidden_form_s_14">
                <input name="SaEdHotImage" placeholder="Φωτογραφία" class="file-path validate" type="text"/>
                <div class="btn">
                    <span>File</span>
                    <input id="fileToUpload" name="fileToUpload" type="file"/>
                </div>
            </div>
            <input name="SaEdHotID" style="display: none" type="text" class="validate" value="<?php echo $hotelDetailsRow["ID"] ?>">
            <input name="SaEdHotAction" style="display: none" type="text" class="validate" value="edit">
            <div class="col s12" style="padding-bottom: 20px;padding-top: 40px">
                <button class="btn waves-effect waves-light hidden_form_s_14" type="submit" name="action">ΚΑΤΑΧΩΡΗΣΗ
                    <i class="mdi-content-send right"></i>
                </button>
            </div>
            <div class="col s12 hidden_form_s_14" style='padding-bottom: 20px'>
                <a class="waves-effect waves-light btn" href="#gomytab_1" onclick="return UserEditsProfile(false,14)"
                   id='mytabE_13'><i class="mdi-editor-mode-edit right"></i>Ακύρωση</a>
            </div>
        </form>
        <!--Hotel Details-->
        <?php
    } catch (Exception $e) {
        trigger_error("##Error at " . __FILE__ . "\"\nDetails: " . $e->getMessage() . "\"" . "\n");
        $errormessage = "<div class=\"col offset-s1 s10\"><p class=\"col s12\">Κάτι πήγε στραβά </p></div>";
        echo $errormessage;
    }
    ?>
</div>