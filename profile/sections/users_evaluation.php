<div class="z-depth-3 col s12 m8 tabregion" id="section_3">
    <div class="white col s12 " style="padding-top: 15px;padding-bottom: 15px;">
        <div class="col s12 m4 l4">Ονομ/νυμο</div>
        <div class="col s12 m3 l4">Δωμάτιο</div>
        <div class="col s12 m5 l4">Βαθμολόγηση</div>
    </div>
    <span class="divider col s12"></span>

    <?php

    $sql = $con->prepare("SELECT auction.Highest_Bidder, auction.GradeOfUser as Evaluation, auction.Name as auctionName, auction.ID as auctionID FROM auction, hotel WHERE hotel.Manager=? AND Highest_Bidder IS NOT NULL AND auction.Hotel=hotel.ID AND Closed=1");

    $sql->bind_param('s', $_SESSION["userid"]);
    $sql->execute();

    $result = $sql->get_result();

    for ($i = 0; $i < mysqli_num_rows($result); $i++) {
        $resultRow = mysqli_fetch_array($result);
        ?>

        <div class=" white col s12 ElementOFUserEvaluation" id="ElementOFUserEvaluation_<?php echo $i ?>"
             style="padding-top: 15px;padding-bottom: 15px;">
            <a class="col s12 m4 l4" href="profile.php?user=<?php echo $resultRow["Highest_Bidder"] ?>"><i
                    class="mdi-maps-hotel"></i> <?php echo $resultRow["Highest_Bidder"] ?> </a>
            <a class="col s12 m3 l4" href="auction.php?id=<?php echo $resultRow["auctionID"] ?>"><i
                    class="mdi-action-home"></i><?php echo $resultRow["auctionName"] ?>
            </a>


            <?php
            /*
        <input type="number" class="rating" value="<?php echo $resultRow["Evaluation"]; ?>" max="5"
                data-size="xs">
        <div class="col s12 m5 l4">*/
            for ($j = 0; $j < $resultRow["Evaluation"]; $j++) {
                echo '<a onclick="evaluateTheUser(\'' . $resultRow["Highest_Bidder"] . '\',' . ($j + 1) . ')" href="#gomytab_3"><i class="mdi-action-star-rate circle amber accent-3"></i></a>';
            }
            for ($j = $resultRow["Evaluation"]; $j < 5; $j++) {
                echo '<a onclick="evaluateTheUser(\'' . $resultRow["Highest_Bidder"] . '\',' . ($j + 1) . ')" href="#gomytab_3"><i class="mdi-action-star-rate circle gray"></i></a>';
            }
            ?>
        </div>
    <?php

    }
    ?>
    <span class="divider col s12"></span>

    <div class="white col s12" style="padding-top: 20px;padding-bottom: 20px;">
        <ul class="pagination" id="UserEvalPaginationList">
            <li class="disabled"><a onclick="" href="#!"><i class="mdi-navigation-chevron-left"></i></a></li>
            <li class="active" id="PaginationNumEvalUser_0"><a
                    onclick="return Paginate('PaginationNumEvalUser_', 'ElementOFUserEvaluation', 'UserEvalPaginationList', 0)"
                    href="#!">1</a></li>
            <?php
            for ($i = 1; $i < mysqli_num_rows($result) / 6; $i++) {
                ?>
                <li class="waves-effect" id="PaginationNumEvalUser_<?php echo $i ?>"><a
                        onclick="return Paginate('PaginationNumEvalUser_', 'ElementOFUserEvaluation', 'UserEvalPaginationList', <?php echo $i ?>)"><?php echo $i + 1 ?></a>
                </li>
            <?php
            }
            ?>
            <li class="waves-effect"><a href="#!"><i class="mdi-navigation-chevron-right"></i></a></li>
        </ul>
    </div>
</div>