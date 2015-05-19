function getHighestBid(id) {

    var xmlhttp;
    if (window.XMLHttpRequest)
    {// code for IE7+, Firefox, Chrome, Opera, Safari
        xmlhttp = new XMLHttpRequest();
    }
    else
    {// code for IE6, IE5
        xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
    }
    xmlhttp.onreadystatechange = function ()
    {
        if (xmlhttp.readyState == 4 && xmlhttp.status == 200)
        {
            $highestBidResponse = JSON.parse(xmlhttp.responseText);

            if ($highestBidResponse["success"] == "yes" && $highestBidResponse["value"] > 0) {
                document.getElementById("parAuctionHighestBid").innerHTML = $highestBidResponse["value"];
            } else if ($highestBidResponse["success"] == "no") {
                document.getElementById("parAuctionHighestBid").innerHTML = "Failed";
            }
        }
    }
    xmlhttp.open("GET", "../bid/highest_bid.php?auctionID=" + id, true);
    xmlhttp.send();
}

function initFuncIntervals(auctionId)
{
    setInterval(function () {
        getHighestBid(auctionId)
    }, 800);
    setInterval(function () {
        userLastBid(auctionId)
    }, 800);
}

function userBid(auctionID) {

    var xmlhttp;
    if (window.XMLHttpRequest)
    {// code for IE7+, Firefox, Chrome, Opera, Safari
        xmlhttp = new XMLHttpRequest();
    }
    else
    {// code for IE6, IE5
        xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
    }
    xmlhttp.onreadystatechange = function ()
    {
        if (xmlhttp.readyState == 4 && xmlhttp.status == 200)
        {
            $highestBidResponse = JSON.parse(xmlhttp.responseText);

            if ($highestBidResponse["success"] == "yes") {
                document.getElementById("auctionUserBid").innerHTML = $highestBidResponse["value"];
            } else if ($highestBidResponse["success"] == "no") {
                document.getElementById("auctionUserBid").innerHTML = "Failed";
            }
        }
    }

    var value = document.getElementById("auctionUserBid").value;
    xmlhttp.open("GET", "../bid/attempt_bid.php?bid_value=" + value + "&auctionID=" + auctionID, true);
    xmlhttp.send();
}

function auctionBuyNow(auctionID) {

    var xmlhttp;
    if (window.XMLHttpRequest)
    {// code for IE7+, Firefox, Chrome, Opera, Safari
        xmlhttp = new XMLHttpRequest();
    }
    else
    {// code for IE6, IE5
        xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
    }
    xmlhttp.onreadystatechange = function ()
    {
        if (xmlhttp.readyState == 4 && xmlhttp.status == 200)
        {
            $highestBidResponse = JSON.parse(xmlhttp.responseText);

            if ($highestBidResponse["success"] == "yes") {
                //document.getElementById("BuyNowValue").innerHTML = $highestBidResponse["value"];
            } else if ($highestBidResponse["success"] == "no") {
                //document.getElementById("BuyNowValue").innerHTML = "Failed";
            }
        }
    }

    xmlhttp.open("GET", "../bid/buy_now.php?auctionID=" + auctionID, true);
    xmlhttp.send();
}

function userLastBid(auctionID) {

    var xmlhttp;
    if (window.XMLHttpRequest)
    {// code for IE7+, Firefox, Chrome, Opera, Safari
        xmlhttp = new XMLHttpRequest();
    }
    else
    {// code for IE6, IE5
        xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
    }
    xmlhttp.onreadystatechange = function ()
    {
        if (xmlhttp.readyState == 4 && xmlhttp.status == 200)
        {
            $highestBidResponse = JSON.parse(xmlhttp.responseText);

            if ($highestBidResponse["success"] == "yes") {
                document.getElementById("LastUserBid").innerHTML = $highestBidResponse["value"];
            } else if ($highestBidResponse["success"] == "no") {
                document.getElementById("LastUserBid").innerHTML = "Failed";
            }
        }
    }
    xmlhttp.open("GET", "../bid/last_user_bid.php?auctionID=" + auctionID, true);
    xmlhttp.send();
}