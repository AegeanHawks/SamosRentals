function getHighestBid(id) {

    var xmlhttp;
    if (window.XMLHttpRequest) {// code for IE7+, Firefox, Chrome, Opera, Safari
        xmlhttp = new XMLHttpRequest();
    }
    else {// code for IE6, IE5
        xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
    }
    xmlhttp.onreadystatechange = function () {
        if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
            $highestBidResponse = JSON.parse(xmlhttp.responseText);

            if ($highestBidResponse["success"] == "yes" && $highestBidResponse["value"] > 0) {
                document.getElementById("parAuctionHighestBid").innerHTML = $highestBidResponse["value"];
            } else if ($highestBidResponse["success"] == "no") {
                document.getElementById("parAuctionHighestBid").innerHTML = "Failed";
            }
        }
    }
    xmlhttp.open("GET", window.location.toString().replace('auction.php?id=' + id, '') + "/bid/highest_bid.php?auctionID=" + id, true);
    xmlhttp.send();
}

function initFuncIntervals(auctionId) {
    setInterval(function () {
        getHighestBid(auctionId)
    }, 800);
    setInterval(function () {
        userLastBid(auctionId)
    }, 800);
}

//var highestValStatic = 0;
//var higestValFlag = false;
function userBid(auctionID) {

    var xmlhttp;
    if (window.XMLHttpRequest) {// code for IE7+, Firefox, Chrome, Opera, Safari
        xmlhttp = new XMLHttpRequest();
    }
    else {// code for IE6, IE5
        xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
    }
    xmlhttp.onreadystatechange = function () {
        if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
            $highestBidResponse = JSON.parse(xmlhttp.responseText);

            if ($highestBidResponse["success"] == "yes") {
                document.getElementById("auctionUserBid").innerHTML = $highestBidResponse["value"];
                Materialize.toast('Είστε ο υψηλότερος πλειοδότης', 5000);

            } else if ($highestBidResponse["success"] == "no") {
                if ($highestBidResponse["state"] == "-1") {
                    Materialize.toast('Η τιμή που πλειοδοτήσατε είναι μικρότερη από τη τρέχουσα η μεγαλύτερη από τη μέγιστη', 5000);
                } else {
                    document.getElementById("auctionUserBid").innerHTML = "Failed";
                }
            }
        }
    }

    var value = document.getElementById("auctionUserBid").value;
    xmlhttp.open("GET", window.location.toString().replace('auction.php?id=' + auctionID, '') + "/bid/attempt_bid.php?bid_value=" + value + "&auctionID=" + auctionID, true);
    xmlhttp.send();
}

function auctionBuyNow(auctionID) {

    var xmlhttp;
    if (window.XMLHttpRequest) {// code for IE7+, Firefox, Chrome, Opera, Safari
        xmlhttp = new XMLHttpRequest();
    }
    else {// code for IE6, IE5
        xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
    }
    xmlhttp.onreadystatechange = function () {
        if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
            $evaluate = JSON.parse(xmlhttp.responseText);

            if ($evaluate["success"] == "yes") {
                Materialize.toast('Συγχαρητήρια, κερδίσατε τη δημοπρασία', 5000);
            } else if ($evaluate["success"] == "no") {
                //document.getElementById("BuyNowValue").innerHTML = "Failed";
            }
        }
    }

    xmlhttp.open("GET", window.location.toString().replace('auction.php?id=' + auctionID, '') + "/bid/buy_now.php?auctionID=" + auctionID, true);
    xmlhttp.send();
}

function userLastBid(auctionID) {

    var xmlhttp;
    if (window.XMLHttpRequest) {// code for IE7+, Firefox, Chrome, Opera, Safari
        xmlhttp = new XMLHttpRequest();
    }
    else {// code for IE6, IE5
        xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
    }
    xmlhttp.onreadystatechange = function () {
        if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
            $highestBidResponse = JSON.parse(xmlhttp.responseText);

            if ($highestBidResponse["success"] == "yes") {
                document.getElementById("LastUserBid").innerHTML = $highestBidResponse["value"];
            } else if ($highestBidResponse["success"] == "no") {
                document.getElementById("LastUserBid").innerHTML = "Failed";
            }
        }
    }
    xmlhttp.open("GET", window.location.toString().replace("auction.php?id=" + auctionID, "/bid/last_user_bid.php?auctionID=" + auctionID), true);
    xmlhttp.send();
}