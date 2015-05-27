
<div class="card col s12 m8 tabregion" id="section_13">
    <div class="white col s12" style="padding-top: 15px;padding-bottom: 15px;">
        <h4 id='SaUsTitle'></h4>

        <form id="SaveCreateUser" action="profile/saveuser.php" method="POST" enctype="multipart/form-data">
            <div class="input-field col s6">
                <i class="mdi-action-account-circle prefix"></i>
                <input name="SaUsFirstName" id="SaUsFirstName" type="text" class="validate">
                <label for="SaUsFirstName">Όνομα</label>
            </div>
            <div class="input-field col s6">
                <i class="mdi-social-group prefix"></i>
                <input name="SaUsLastname" id="SaUsLastname" type="text" class="validate">
                <label for="SaUsLastname">Επώνυμο</label>
            </div>
            <div class="input-field col s6">
                <i class="mdi-social-whatshot prefix"></i>
                <input name="SaUsUsername" id="SaUsUsername" type="text" class="validate">
                <label for="SaUsUsername">Ψευδώνυμο</label>
            </div>
            <div class="input-field col s6">
                <i class="mdi-communication-phone prefix"></i>
                <input name="SaUsTel" id="SaUsTel" type="text" pattern='[0-9]{0,12}' class="validate">
                <label for="SaUsTel">Τηλέφωνο</label>
            </div>
            <div class="col s12 input-field tooltipped" data-position="top" data-delay="50"
                 data-tooltip="Ο κωδικός είναι 8 χαρακτήρων και περιέχει τουλάχιστον 1 αριθμό,κεφαλαίο και μικρό γράμμα.">
                <i class="mdi-communication-vpn-key prefix"></i>
                <input name="SaUsPassword" type="password" pattern='(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}'
                       onchange="form.reenter_password.pattern = this.value;" id="SaUsPassword"
                       maxlength="30" class="validate" value="<?php echo $resultRow["Password"] ?>">
                <label for="SaUsPassword">Κωδικός</label>
            </div>
            <div class="col s12 input-field">
                <i class="mdi-action-verified-user prefix"></i>
                <input type="password" name="password" id="reenter_password" maxlength="30" class="validate"
                       required>
                <label for="reenter_password">Ξαναβάλε τον κωδικό</label>
            </div>
            <div class="input-field col s12">
                <i class="mdi-communication-email prefix"></i>
                <input name="SaUsMail" id="SaUsMail" type="text" class="validate">
                <label for="SaUsMail">E-mail</label>
            </div>
            <div class="col s12 input-field">
                <i class="mdi-social-cake prefix"></i>
                <input  name="SaUsBirthday" id="SaUsBirthday" type="text" class="datepicker picker__input"
                        required form="SaveCreateUser">
                <label for="SaUsBirthday">Ημερομηνία Γέννησης</label>
            </div>
            <?php
            if (isRole("admin")) {
                ?>
                <div class="offset-s1 input-field col s11">
                    <select id="SaUsRole" name="SaUsRole" class="validate" required form="SaveCreateUser">
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
            }
            ?>
            <div class="input-field col offset-s1 s11">
                <select id="SaUsSex" name="SaUsSex" class="validate" required form="SaveCreateUser">
                    <option value="male">Άνδρας
                    </option>
                    <option value="female">Γυναίκα
                    </option>
                </select>
                <label for="SaUsSex">Φύλο</label>
            </div>

            <div class="col s12 file-field input-field">
                <div class="file-field input-field">
                    <input name="Images" placeholder="Φωτογραφία" class="file-path validate" type="text"/>

                    <div class="btn">
                        <span>File</span>
                        <input id="fileToUpload" name="fileToUpload" type="file"/>
                    </div>
                </div>
            </div>

            <input name="SaUsState" id="SaUsState" style='display: none' value="new">

            <div class="input-field col s12" style="padding-top: 10px; padding-bottom: 10px">
                <button class="btn waves-effect waves-light" type="submit" name="action">Καταχωρηση
                    <i class="mdi-content-send right"></i>
                </button>
            </div>
        </form>
    </div>
</div>