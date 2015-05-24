<div class="card col s12 m8 tabregion" id="section_11">
    <div class=" white col s12 " style="padding-top: 15px;padding-bottom: 15px; font-weight: bold">
        <div class="col s12 m5">Τίτλος</div>
        <div class="col s12 m3">Τιμή Έναρξης</div>
        <div class="col s12 m4">Κερδήθηκε</div>
    </div>
    <span class="divider col s12"></span>

    <?php

    $sql = $con->prepare("SELECT Name, Highest_Bidder, Bid_Price FROM auction, bid WHERE auction.ID=bid.idAuction AND bid.Username=? AND Closed=1");
    $sql->bind_param('s', $_SESSION["userid"]);
    $sql->execute();

    $result = $sql->get_result();

    for ($i = 0; $i < mysqli_num_rows($result); $i++) {
        $resultRow = mysqli_fetch_array($result);
        ?>

        <div class="white col s12 ElementOFUserHistory" id="ElementOFUserHistory_<?php echo $i ?>"
             style="padding-top: 10px;padding-bottom: 10px;">
            <a class="col s12 m5 truncate" href="#!"><i class="mdi-action-home"></i><?php echo $resultRow["Name"] ?></a>

            <div class="col s12 m3 flow-text"><i
                    class="mdi-editor-attach-money"> </i><?php echo $resultRow["Bid_Price"] ?></div>
            <div
                class="col s12 m4 flow-text center-align"><?php if ($resultRow["Highest_Bidder"] == $_SESSION["userid"]) {
                    echo '<i class="mdi-navigation-check"> </i>';
                } else {
                    echo '<i class="mdi-navigation-close"> </i>';
                } ?></div>
            <div class="divider"></div>
        </div>
    <?php
    }
    ?>
    <span class="divider col s12"></span>
    <div class="white col s12" style="padding-top: 20px;padding-bottom: 20px;">
        <ul class="pagination" id="UserHistoryPaginationList">
            <li class="disabled"><a onclick="return PaginAuctionsHistory(-2)" href="#!"><i
                        class="mdi-navigation-chevron-left"></i></a></li>
            <li class="active" id="PaginationNumUserHistory_0"><a
                    onclick="return Paginate('PaginationNumUserHistory_', 'ElementOFUserHistory', 'UserHistoryPaginationList', 0)"
                    href="#!">1</a></li>
            <?php
            for ($i = 1; $i < mysqli_num_rows($result) / 6; $i++) {
                ?>
                <li class="waves-effect" id="PaginationNumUserHistory_<?php echo $i ?>"><a
                        onclick="return Paginate('PaginationNumUserHistory_', 'ElementOFUserHistory', 'UserHistoryPaginationList', <?php echo $i ?>)"><?php echo $i + 1 ?></a>
                </li>
            <?php
            }
            ?>
            <li class="waves-effect"><a href="#!"><i class="mdi-navigation-chevron-right"></i></a></li>
        </ul>
    </div>
</div>