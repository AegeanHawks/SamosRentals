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

            if ($highestBidResponse["success"] == "yes") {
                document.getElementById("parAuctionHighestBid").innerHTML = $highestBidResponse["value"];
            } else if ($highestBidResponse["success"] == "no") {
                document.getElementById("parAuctionHighestBid").innerHTML = "Failed";
            }
        }
    }
    xmlhttp.open("GET", "../bid/highest_bid.php?" + id, true);
    xmlhttp.send();
}