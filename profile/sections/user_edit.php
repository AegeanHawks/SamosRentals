<?php

$con = db_connect();
// SQL query to fetch information of registerd users and finds user match.
$sql = $con->prepare('SELECT * FROM user WHERE Active=1 ORDER BY Upgrade DESC, Username ASC ');
$sql->execute();
$result = $sql->get_result();

?>
<div class="card col s12 m8 tabregion" id="section_12">
    <ul class="collapsible" data-collapsible="accordion">
        <?php
        for ($i = 0; $i < mysqli_num_rows($result); $i++) {
            $resultRow = mysqli_fetch_array($result);
            ?>
            <li class="ElementOFEditUsers_" id="ElementOFEditUsers__<?php echo $i ?>">
                <div class="collapsible-header ">
                    <div class="col s2 truncate"><?php echo $resultRow["Username"] ?></div>
                    <div class="col s3 truncate"><?php echo $resultRow["FirstName"] ?></div>
                    <div class="col s3 truncate"><?php echo $resultRow["LastName"] ?></div>
                    <?php if ($resultRow["Upgrade"] == 1) { ?>
                        <div class="col s4 truncate"><a class="waves-effect light-green waves-light btn right"
                                                        onclick="updateUser('<?php echo $resultRow["Username"] ?>')"
                                                        href="#updateuser_12">ΑΝΑΒΑΘΜΙΣΗ</a></div>
                    <?php } ?>
                </div>
                <div class="collapsible-body">
                    <form class="FormAdminEditsUser" id="FormAdminEditsUser_<?php echo $i ?>"
                          action="profile/saveuser.php" method="post">
                        <div class="row col s12">
                            <div class="input-field col m4 l3 s12">
                                <i class="mdi-action-account-circle prefix"></i>
                                <input name="SaUsFirstName" id="icon_prefix" type="text" class="validate" placeholder=""
                                       value="<?php echo $resultRow["FirstName"] ?>">
                                <label for="icon_prefix">Όνομα</label>
                            </div>
                            <div class="input-field col m4 l3 s12">
                                <input name="SaUsLastname" id="icon_prefix" type="text" class="validate" placeholder=""
                                       value="<?php echo $resultRow["LastName"] ?>">
                                <label for="icon_prefix">Επώνυμο</label>
                            </div>
                            <div class="input-field col m4 l3 s12">
                                <i class="mdi-action-assignment-ind prefix"></i>
                                <input name="SaUsUsername" id="icon_prefix" type="text" class="validate" placeholder=""
                                       disabled="disabled"
                                       value="<?php echo $resultRow["Username"] ?>">
                                <label for="icon_prefix">Ψευδώνυμο</label>
                            </div>
                            <div class="col  m4 l3 s12 input-field tooltipped" data-position="top" data-delay="50"
                                 data-tooltip="Ο κωδικός είναι 8 χαρακτήρων και περιέχει τουλάχιστον 1 αριθμό,κεφαλαίο και μικρό γράμμα.">
                                <input name="SaUsPassword" type="password" pattern='(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}'
                                       onchange="form.reenter_password.pattern = this.value;"
                                       maxlength="30" class="validate" value="<?php echo $resultRow["Password"] ?>">
                            </div>
                            <div class="input-field col m4 l3 s12">
                                <i class="mdi-communication-email prefix"></i>
                                <input name="SaUsMail" id="icon_prefix" type="email" class="validate" placeholder=""
                                       value="<?php echo $resultRow["Mail"] ?>">
                                <label for="icon_prefix">Email</label>
                            </div>
                            <div class="input-field col m4 l3 s12">
                                <i class="mdi-action-today prefix"></i>
                                <input name="SaUsBirthday" id="icon_prefix" type="date" class="validate">
                            </div>
                            <div class="input-field col m4 l3 s12">
                                <i class="mdi-maps-local-phone prefix"></i>
                                <input name="SaUsTel" id="icon_prefix" type="tel" class="validate" placeholder=""
                                       value="<?php echo $resultRow["Tel"] ?>">
                                <label for="icon_prefix">Τηλέφωνο</label>
                            </div>
                            <div class="input-field col m4 l3 s12">
                                <select name="SaUsSex">
                                    <option value="1" <?php if ($resultRow["Sex"] == "male") {
                                        echo "selected";
                                    } ?>>Άνδρας
                                    </option>
                                    <option value="2" <?php if ($resultRow["Sex"] == "female") {
                                        echo "selected";
                                    } ?>>Γυναίκα
                                    </option>
                                </select>
                                <label>Φύλο</label>
                            </div>

                            <div class="col s12 m12">
                                <div class="col s2 m4">
                                    <img class="circle responsive-img " src="images/website/avatar.jpg">
                                </div>
                                <div class="col s10 m8 file-field input-field">
                                    <div class="input-field col s12 m12">
                                        <input class="file-path validate" type="text"/>

                                        <div class="btn">

                                            <span>File</span>
                                            <input type="file"/>
                                        </div>
                                        <div class="input-field col s12 m12">
                                            <select id="SaUsRole" name="SaUsRole" class="validate">
                                                <option value="0" <?php if ($resultRow["Role"] == 0) {
                                                    echo "selected";
                                                } ?>>Administrator
                                                </option>
                                                <option value="1" <?php if ($resultRow["Role"] == 1) {
                                                    echo "selected";
                                                } ?>>Hotelier
                                                </option>
                                                <option value="2" <?php if ($resultRow["Role"] == 2) {
                                                    echo "selected";
                                                } ?>>User
                                                </option>
                                            </select>
                                            <label>Ρολος</label>
                                        </div>
                                    </div>
                                </div>
                                <input name="SaUsState" style='display: none' value="adminedit">
                                <input name="SaUsUsername" style='display: none' id="icon_prefix" type="text"
                                       class="validate" placeholder=""
                                       value="<?php echo $resultRow["Username"] ?>">
                            </div>

                        </div>

                        <button type="submit" class="waves-effect green waves-light btn right" href="#adduser_12">
                            Αποθήκευση
                        </button>

                        <a class="waves-effect red waves-light btn left"
                           onclick="removeUser('<?php echo $resultRow["Username"] ?>')" href="#deleteuser_12"><i
                                class="mdi-content-save left"></i>Διαγραφή</a>
                    </form>
                </div>
            </li>
        <?php
        }
        ?>
    </ul>


    <div class="white col s12" style="padding-top: 20px;padding-bottom: 20px;">
        <ul class="pagination" id="EditUsersPaginationList">
            <li class="disabled"><a onclick="return PaginAuctionsHistory(-2)" href="#!"><i
                        class="mdi-navigation-chevron-left"></i></a></li>
            <li class="active" id="PaginationNumEditUsers_0"><a
                    onclick="return Paginate('PaginationNumEditUsers_', 'ElementOFEditUsers_', 'EditUsersPaginationList', 0)"
                    href="#!">1</a></li>
            <?php
            for ($i = 1; $i < mysqli_num_rows($result) / 6; $i++) {
                ?>
                <li class="waves-effect" id="PaginationNumEditUsers_<?php echo $i ?>"><a
                        onclick="return Paginate('PaginationNumEditUsers_', 'ElementOFEditUsers_', 'EditUsersPaginationList', <?php echo $i ?>)"><?php echo $i + 1 ?></a>
                </li>
            <?php
            }
            ?>
            <li class="waves-effect"><a href="#!"><i class="mdi-navigation-chevron-right"></i></a></li>
        </ul>
    </div>
</div>