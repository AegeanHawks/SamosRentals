<?php
if (!isset($_POST["userID"]) || empty($_POST["userID"])) {
} else {
    $con = db_connect();
// SQL query to fetch information of registerd users and finds user match.
    $sql = $con->prepare('DELETE FROM user WHERE Username=?');
    $sql->bind_param('s', $_POST["userID"]);
    $sql->execute();

}
?>
<div class="card col s12 m8 tabregion" id="section_12">
    <div class=" white col s12 " style="padding-top: 15px;padding-bottom: 15px; font-weight: bold">
        <div class="col s12 m5">Ψευδώνυμο</div>
        <div class="col s12 m3">E-mail</div>
        <div class="col s12 m2">Επεξεργασία</div>
        <div class="col s12 m2">Διαγραφή</div>
    </div>
    <?php
    $con = db_connect();
    // SQL query to fetch information of registerd users and finds user match.
    $sql = $con->prepare('SELECT * FROM user');
    $sql->execute();

    $result = $sql->get_result();
    for ($i = 0; $i < mysqli_num_rows($result); $i++) {
        $resultRow = mysqli_fetch_array($result);
        ?>

        <div class="white col s12 ElementOFUserList" id="ElementOFUserList_<?php echo $i ?>"
             style="padding-top: 10px;padding-bottom: 10px;">
            <span class="divider col s12"></span>
            <a class="col m5 truncate"><i
                    class="mdi-action-home"></i> <?php echo $resultRow["Username"] ?>
            </a>
            <a class="col m3 truncate"><i class="mdi-action-home"></i> <?php echo $resultRow["Mail"] ?>
            </a>

            <div class="col s12 m2 flow-text center">
                <a class="btn-floating grey"
                   href="?editHotel=<?php echo $resultRow["ID"]; ?>#gomytab_14"><i
                        class="mdi-editor-mode-edit"></i></a>
            </div>
            <div class="col s12 m2 flow-text center">
                <a class="btn-floating grey" onclick="deleterUser(<?php echo $resultRow["ID"]; ?>)"><i
                        class="mdi-editor-mode-edit"></i></a>
            </div>
        </div>
    <?php
    }
    ?>
    <span class="divider col s12"></span>

    <div class="white col s12" style="padding-top: 20px;padding-bottom: 20px;">
        <ul class="pagination" id="HotelPaginationList">
            <li class="disabled"><a onclick="return PaginAuctionsHistory(-2)" href="#!"><i
                        class="mdi-navigation-chevron-left"></i></a></li>
            <li class="active" id="PaginationNumHotel_0"><a
                    onclick="return Paginate('PaginationNumHotel_', 'ElementOFHotelList', 'HotelPaginationList', 0)"
                    href="#!">1</a></li>
            <?php
            for ($i = 1; $i < mysqli_num_rows($result) / 6; $i++) {
                ?>
                <li class="waves-effect" id="PaginationNumHotel_<?php echo $i ?>"><a
                        onclick="return Paginate('PaginationNumHotel_', 'ElementOFHotelList', 'HotelPaginationList', <?php echo $i ?>)"><?php echo $i + 1 ?></a>
                </li>
            <?php
            }
            ?>
            <li class="waves-effect"><a href="#!"><i class="mdi-navigation-chevron-right"></i></a></li>
        </ul>
    </div>
</div>