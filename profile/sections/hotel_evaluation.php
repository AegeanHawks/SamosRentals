<div class="z-depth-3 col s12 m8 tabregion" id="section_10">
    <div class="white col s12 " style="padding-top: 15px;padding-bottom: 15px;">
        <div class="col s12 m4 l4">Ξενοδοχείο</div>
        <div class="col s12 m3 l4">Δημοπρασία</div>
        <div class="col s12 m5 l4">Βαθμολόγηση</div>
    </div>
    <span class="divider col s12"></span>

    <?php

    $sql = $con->prepare("SELECT Evaluation, hotel.Name as hotelName, auction.ID as auctionID, hotel.ID as hotelID, auction.name as auctionName FROM auction, hotel WHERE hotel.id=auction.hotel AND auction.Highest_Bidder=? AND Closed=1");
    $sql->bind_param('s', $_SESSION["userid"]);
    $sql->execute();

    $result = $sql->get_result();

    for ($i = 0; $i < mysqli_num_rows($result); $i++) {
        $resultRow = mysqli_fetch_array($result);
        ?>

        <div class=" white col s12 ElementOFHotelEvaluation" id="ElementOFHotelEvaluation_<?php echo $i ?>"
             style="padding-top: 15px;padding-bottom: 15px;">
            <a class="col s12 m4 l4" href="hotel.php?id=<?php echo $resultRow["hotelID"] ?>"><i
                    class="mdi-maps-hotel"></i> <?php echo $resultRow["hotelName"] ?> </a>
            <a class="col s12 m3 l4" href="auction.php?id=<?php echo $resultRow["auctionID"] ?>"><i
                    class="mdi-action-home"></i><?php echo $resultRow["auctionName"] ?>
            </a>


            <?php
            /*
        <input type="number" class="rating" value="<?php echo $resultRow["Evaluation"]; ?>" max="5"
                data-size="xs">
        <div class="col s12 m5 l4">*/
            for ($j = 0; $j < $resultRow["Evaluation"]; $j++) {
                echo '<a onclick="evaluateBid(' . $resultRow["auctionID"] . ',' . ($j + 1) . ')" href="#gomytab_10"><i class="mdi-action-star-rate circle amber accent-3"></i></a>';
            }
            for ($j = $resultRow["Evaluation"]; $j < 5; $j++) {
                echo '<a onclick="evaluateBid(' . $resultRow["auctionID"] . ',' . ($j + 1) . ')" href="#gomytab_10"><i class="mdi-action-star-rate circle gray"></i></a>';
            }
            ?>
        </div>
    <?php

    }
    ?>
    <span class="divider col s12"></span>
    <div class="white col s12" style="padding-top: 20px;padding-bottom: 20px;">
        <ul class="pagination" id="HotelEvalPaginationList">
            <li class="disabled"><a onclick="" href="#!"><i class="mdi-navigation-chevron-left"></i></a></li>
            <li class="active" id="PaginationNumHotelEval_0"><a
                    onclick="return Paginate('PaginationNumHotelEval_', 'ElementOFHotelEvaluation', 'HotelEvalPaginationList', 0)"
                    href="#!">1</a></li>
            <?php
            for ($i = 1; $i < mysqli_num_rows($result) / 6; $i++) {
                ?>
                <li class="waves-effect" id="PaginationNumHotelEval_<?php echo $i ?>"><a
                        onclick="return Paginate('PaginationNumHotelEval_', 'ElementOFHotelEvaluation', 'HotelEvalPaginationList', <?php echo $i ?>)"><?php echo $i + 1 ?></a>
                </li>
            <?php
            }
            ?>
            <li class="waves-effect"><a href="#!"><i class="mdi-navigation-chevron-right"></i></a></li>
        </ul>
    </div>
</div>
