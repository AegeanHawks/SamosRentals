
<div class="col s12 m8 tabregion" id="section_6">
    <div class="col s12 m12">
        <div class="center-align card" style="height: 400px;">
            <div class="flow-text" style="padding: 20px">
                <p>Με την αναβάθμιση του λογαριασμού σας έχετε το δικαίωμα να θέτετε σε δημοπρασία τα
                    δωμάτια του ξενοδοχείου σας</p>
            </div>
            <?php
            if ($Upgrade == 0) {
                ?>
                <form action="profile.php" method="post">
                    <button class="btn waves-effect waves-light" type="submit" name="upgrade" value="1">ΑΝΑΒΑΘΜΙΣΗ ΤΩΡΑ
                        <i class="mdi-content-send right"></i>
                    </button>
                </form>
            <?php
            } else {
                ?>
                <div class="flow-text" style="padding: 20px">
                    <p>Έχετε ήδη υποβάλει αίτηση!</p>
                </div>
            <?php
            }
            ?>
        </div>
    </div>
</div>