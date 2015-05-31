<?php

$sql = $con->prepare("SELECT avg(auction.GradeOfUser) as Grade FROM auction, bid, user WHERE user.Username=? AND bid.Username=user.Username AND bid.idAuction=auction.ID GROUP BY user.Username");
$sql->bind_param('s', $_SESSION["userid"]);
$sql->execute();

$result = $sql->get_result();
$resultRow = mysqli_fetch_array($result);
?>
<div class="card row col s12 m8 tabregion" id="section_1" style="display: none">
    <?php if (ownsProfile()) {
        ?>
        <div class="col offset-s1 s12" style='padding-bottom: 20px'>
            <a class="waves-effect waves-light btn" href="#gomytab_1" onclick="return UserEditsProfile(true, 1)"
               id='mytabE_13'><i class="mdi-editor-mode-edit right"></i>Επεξεργασια</a>
        </div>
    <?php }
    ?>
    <form action="profile/saveuser.php" id="EditUserForm" method="POST" enctype="multipart/form-data">
        <div class="col offset-s1 s10">
            <p class="col s4 detailshead">Όνομα: </p>

            <p class="col s8 detailsbody_s_1"><?php echo $fname; ?></p>

            <div class="input-field col s6 hidden_form_s_1">
                <input name="SaUsFirstName" type="text" class="validate" pattern="^[Α-ΩA-Z][α-ωa-zA-Z-ά-ώ]{3,20}$"
                       value="<?php echo $fname; ?>">
            </div>
        </div>
        <div class="col offset-s1 s10 divider"></div>
        <div class="col offset-s1 s10">
            <p class="col s4 detailshead">Επώνυμο: </p>

            <p class="col s8 detailsbody_s_1"><?php echo $lname; ?></p>

            <div class="input-field col s6 hidden_form_s_1">
                <input name="SaUsLastname" type="text" class="validate" pattern="^[Α-ΩA-Z][α-ωa-zA-Z-ά-ώ]{2,20}$"
                       value="<?php echo $lname; ?>">
            </div>
        </div>
        <div class="col offset-s1 s10 divider"></div>
        <div class="col offset-s1 s10">
            <p class="col s4 detailshead">Ψευδώνυμο: </p>

            <p class="col s8 detailsbody_s_1"><?php echo $username; ?></p>

            <p class="col s8 hidden_form_s_1"><?php echo $username; ?></p>
        </div>
        <div class="col offset-s1 s10 divider"></div>
        <div class="col offset-s1 s10">
            <p class="col s4 detailshead">Τηλέφωνο: </p>

            <p class="col s8 detailsbody_s_1"><?php echo $tel; ?></p>

            <div class="input-field col s6 hidden_form_s_1">
                <input name="SaUsTel" type="text" pattern='[\+]\d{2}\d{10}' class="validate"
                       value="<?php echo $tel; ?>">
            </div>
        </div>
        <div class="col offset-s1 s10 divider"></div>
        <div class="col offset-s1 s10">
            <p class="col s4 detailshead">E-mail: </p>

            <p class="col s8 detailsbody_s_1"><?php echo $mail; ?></p>

            <div class="input-field col s6 hidden_form_s_1">
                <input name="SaUsMail" type="email" class="validate" value="<?php echo $mail; ?>">
            </div>
        </div>
        <div class="col offset-s1 s10 divider"></div>
        <div class="col offset-s1 s10">
            <p class="col s4 detailshead">Ημερομηνία γέννησης: </p>

            <p class="col s8 detailsbody_s_1"><?php echo $birthday; ?></p>

            <div class="col s6 input-field hidden_form_s_1">
                <input name="SaUsBirthday" type="text" class="datepicker picker__input" value="<?php echo $birthday; ?>"
                       required form="EditUserForm">
            </div>
        </div>
        <div class="col offset-s1 s10 divider hidden_form_s_1"></div>
        <div class="col offset-s1 s10 hidden_form_s_1">
            <p class="col s4 detailshead">Κωδικός: </p>

            <div class="col s8 input-field tooltipped" data-position="top" data-delay="50"
                 data-tooltip="Ο κωδικός είναι 8 χαρακτήρων και περιέχει τουλάχιστον 1 αριθμό,κεφαλαίο και μικρό γράμμα.">
                <input name="SaUsPassword" type="password" pattern='(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}'
                       onchange="form.reenter_password.pattern = this.value;"
                       maxlength="30" class="validate">
            </div>
        </div>
        <?php
        if (isRole("user")) {
            ?>
            <div class="col offset-s1 s10 divider"></div>
            <div class="col offset-s1 s10">
                <p class="col s4 detailshead">Βαθμολογία: </p>

                <p class="col s6 detailsbody_s_1"><?php echo floor($resultRow["Grade"] * 10) / 10 ?></p>
            </div>
        <?php
        } ?>
        <div class="col offset-s1 s10 divider"></div>
        <div class="col offset-s1 s10">
            <p class="col s4 detailshead">Φύλλο: </p>

            <p class="col s8 detailsbody_s_1"><?php echo $sex; ?></p>

            <div class="input-field col s6 hidden_form_s_1">
                <select name="SaUsSex" class="validate" required form="EditUserForm">
                    <option value="male">Άνδρας
                    </option>
                    <option value="female">Γυναίκα
                    </option>
                </select>
            </div>
        </div>
        <div class="col offset-s1 s10 divider"></div>
        <div class="col offset-s1 s10">
            <p class="col s4 detailshead">Ρόλος: </p>

            <p class="col s8 detailsbody_s_1"><?php echo $role; ?></p>
            <?php
            if (isRole("admin")) {
                ?>
                <div class="offset-s1 input-field col s6 hidden_form_s_1">
                    <select id="SaUsRole" name="SaUsRole" class="validate" required form="EditUserForm">
                        <option value="0">Administrator
                        </option>
                        <option value="1">Hotelier
                        </option>
                        <option value="2">User
                        </option>
                    </select>
                    <label for="SaUsSex">Τύπος</label>
                </div>
            <?php
            } else {
                ?>
                <p class="col s6 hidden_form_s_1"><?php echo $role; ?></p>
            <?php
            }
            ?>
        </div>
        <div class="col offset-s1 s10 divider"></div>
        <div class="col offset-s1 s2 file-field input-field hidden_form_s_1">
            <img class="circle responsive-img "
                 src="<?php if (empty($image)) echo 'images/website/avatar.jpg'; else echo $image; ?>">
        </div>
        <div class="col s8 file-field input-field hidden_form_s_1">
            <div class="file-field input-field">
                <input name="Images" placeholder="Φωτογραφία" class="file-path validate" type="text"/>

                <div class="btn">
                    <span>File</span>
                    <input id="fileToUpload" name="fileToUpload" type="file"/>
                </div>
            </div>
        </div>

        <?php if (ownsProfile()) {
            ?>
            <div class="col offset-s1 s12 hidden_form_s_1" style='padding-bottom: 20px'>
                <button class="btn waves-effect waves-light" type="submit">Υποβολή
                    <i class="mdi-content-send right"></i>
                </button>
            </div>
            <div class="col offset-s1 s12 hidden_form_s_1" style='padding-bottom: 20px'>
                <a class="waves-effect waves-light btn" href="#gomytab_1" onclick="return UserEditsProfile(false,1)"
                   id='mytabE_13'><i class="mdi-editor-mode-edit right"></i>Ακύρωση</a>
            </div>
        <?php } ?>

        <input name="SaUsState" id="SaUsState" style='display: none' value="edit">
    </form>
</div>