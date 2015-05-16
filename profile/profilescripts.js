function CurrentTab() {
    var url = window.location.href;
    //console.log("url: " + url);
    var num = url.match(/#.*/);
    //alert(num);

    if (num == null) {
        $("#section_1").show();
    } else {
        //console.log("Current active tab: " + num);
        numarray = num[0].match(/\d+/);
        if (numarray == null) {
            $("#section_1").show();
        } else {
            $(".tabregion").hide();
            $("#section_" + numarray[0]).show();
        }
    }
}
function rotate(id) {
    var cont = document.getElementById(id).className;
    if (cont.indexOf('rotateIn') != -1) {
        $('#' + id).removeClass('rotateIn');
    } else {
        $('#' + id).addClass('animated rotateIn');
        setTimeout(function () {
            $('#' + id).removeClass('rotateIn');
        }, 1000);
    }
}
function UserEditsProfile(edits) {
    if (edits == true) {
        $(".detailsbody").hide();
        $(".hidden_form_s_1").show();
    } else {
        $(".detailsbody").show();
        $(".hidden_form_s_1").hide();
    }
    return true;
    //detailsbody
}

function PaginAuctionsHistory(pagenumber) {
    var step = 6;
    firstvalue = pagenumber * step;

    //console.log("PaginationNumAuct_: " + "PaginationNumAuct_" + pagenumber.toString());
    //console.log("sd: " + document.getElementById("AuctionPaginationList").childElementCount);
    var totalpagenumber = document.getElementById("AuctionPaginationList").childElementCount - 2;

    for (var $i = 0; $i < totalpagenumber; $i++) {
        document.getElementById("PaginationNumAuct_" + $i).className = "waves-effect";
    }

    document.getElementById("PaginationNumAuct_" + pagenumber.toString()).className = "active";


    $(".PaginAuctionsHiEd").hide();
    for (var $i = firstvalue; $i < firstvalue + step; $i++) {
        $("#PaginAuctionsHiEd_" + $i).show();
    }
    return false;
}

$(document).ready(function () {
    $('.mytab').focus(function () {
        var num = this.id.match(/\d+/)[0];
        $(".tabregion").hide();
        $("#section_" + num).show();
        /*if (this.id == "mytabE_13") {
         document.getElementById("SaUsState").value = "edit";
         document.getElementById("SaUsTitle").innerHTML = "Επεξεργασία";
         } else if (this.id == "mytab_13") {
         document.getElementById("SaUsState").value = "new";
         document.getElementById("SaUsTitle").innerHTML = "Προσθήκη";
         }*/
    });
});