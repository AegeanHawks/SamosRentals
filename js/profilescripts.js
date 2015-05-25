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
function UserEditsProfile(edits, sectionNum) {
    if (edits == true) {
        $(".detailsbody_s_" + sectionNum).hide();
        $(".hidden_form_s_" + sectionNum).show();
    } else {
        $(".detailsbody_s_" + sectionNum).show();
        $(".hidden_form_s_" + sectionNum).hide();
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

function Paginate(idPart, classOfPagin, paginationWrapper, pagenumber) {
    //var idPart = "PaginationNumHotel_";
    //var classOfPagin = "PaginAuctionsHiEd";
    //var paginationWrapper = "AuctionPaginationList";

    var step = 6;
    firstvalue = pagenumber * step;

    var totalpagenumber = document.getElementById(paginationWrapper).childElementCount - 2;

    for (var $i = 0; $i < totalpagenumber; $i++) {
        document.getElementById(idPart + $i).className = "waves-effect";
    }

    document.getElementById(idPart + pagenumber.toString()).className = "active";


    $("." + classOfPagin).hide();
    for (var $i = firstvalue; $i < firstvalue + step; $i++) {
        console.log("#" + idPart + $i);
        $("#" + classOfPagin + "_" + $i).show();
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

function evaluateBid(auctionID, grade) {

    var xmlhttp;
    if (window.XMLHttpRequest) {// code for IE7+, Firefox, Chrome, Opera, Safari
        xmlhttp = new XMLHttpRequest();
    }
    else {// code for IE6, IE5
        xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
    }
    xmlhttp.onreadystatechange = function () {
        if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
            evaluate = JSON.parse(xmlhttp.responseText);

            if (evaluate["success"] == "yes") {
                Materialize.toast('Η βαθμολογία σας καταχωρήθηκε επιτυχώς', 3000);
                setTimeout(function () {
                    location.reload(true);
                }, 3100);

            } else if (evaluate["success"] == "no") {
                Materialize.toast('Υπήρξε κάποιο πρόβλημα, παρακαλώ προσπαθήστε αργότερα', 5000);
            }
        }
    }

    xmlhttp.open("GET", window.location.toString().replace(/profile.php.*/i, '') + "/profile/evaluateBid.php?Grade=" + grade + "&auctionID=" + auctionID, true);
    xmlhttp.send();
}

function editUser(auctionID, grade) {

    var xmlhttp;
    if (window.XMLHttpRequest) {// code for IE7+, Firefox, Chrome, Opera, Safari
        xmlhttp = new XMLHttpRequest();
    }
    else {// code for IE6, IE5
        xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
    }
    xmlhttp.onreadystatechange = function () {
        if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
            evaluate = JSON.parse(xmlhttp.responseText);

            if (evaluate["success"] == "yes") {
                Materialize.toast('Η βαθμολογία σας καταχωρήθηκε επιτυχώς', 3000);
                setTimeout(function () {
                    location.reload(true);
                }, 3100);

            } else if (evaluate["success"] == "no") {
                Materialize.toast('Υπήρξε κάποιο πρόβλημα, παρακαλώ προσπαθήστε αργότερα', 5000);
            }
        }
    }

    xmlhttp.open("GET", window.location.toString().replace(/profile.php.*/i, '') + "/profile/evaluateBid.php?Grade=" + grade + "&auctionID=" + auctionID, true);
    xmlhttp.send();
}

$(document).ready(function () {
    // bind 'myForm' and provide a simple callback function
    $('#EditUserForm').ajaxForm(function () {
        location.reload();
    });
});


$(document).ready(function () {
    // bind 'myForm' and provide a simple callback function
    $('#CreateEditAuction').ajaxForm({
        success: function (response) {
            responsejson = JSON.parse(response);
            if (responsejson["success"] == "yes") {
                Materialize.toast('Η δημοπρασία καταχωρήθηκε επιτυχώς!', 4000)
            } else {
                Materialize.toast('Υπήρξε κάποιο πρόβλημα, παράκαλω ελέγξτε τις τιμές που εισάγατε!', 4000)
            }
        }
    });

});

$(document).ready(function () {
    // bind 'myForm' and provide a simple callback function
    $('#CreateEditHotel').ajaxForm({
        success: function (response) {
            responsejson = JSON.parse(response);
            if (responsejson["success"] == "yes") {
                Materialize.toast('Το ξενοδοχείο καταχωρήθηκε επιτυχώς!', 4000)
            } else {
                Materialize.toast('Υπήρξε κάποιο πρόβλημα, παράκαλω ελέγξτε τις τιμές που εισάγατε!', 4000)
            }
        }
    });

});

$(document).ready(function () {
    // bind 'myForm' and provide a simple callback function
    $('#SaveCreateUser').ajaxForm({
        success: function (response) {
            responsejson = JSON.parse(response);
            if (responsejson["success"] == "yes") {
                Materialize.toast('Ο χρήστης καταχωρήθηκε επιτυχώς!', 4000)
            } else {
                Materialize.toast('Υπήρξε κάποιο πρόβλημα, παράκαλω ελέγξτε τις τιμές που εισάγατε!', 4000)
            }
        }
    });
});

function deleterUser(userID) {

    var xmlhttp;
    if (window.XMLHttpRequest) {// code for IE7+, Firefox, Chrome, Opera, Safari
        xmlhttp = new XMLHttpRequest();
    }
    else {// code for IE6, IE5
        xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
    }
    xmlhttp.onreadystatechange = function () {
        if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
            var evaluate = JSON.parse(xmlhttp.responseText);

            if (evaluate["success"] == "yes") {
                Materialize.toast('Ο χρήστης διαγράφηκε επιτυχώς', 3000);
                setTimeout(function () {
                    location.reload(true);
                }, 3100);

            } else if (evaluate["success"] == "no") {
                Materialize.toast('Υπήρξε κάποιο πρόβλημα, παρακαλώ προσπαθήστε αργότερα', 5000);
            }
        }
    }

    xmlhttp.open("GET", window.location.toString().replace(/profile.php.*/i, '') + "/profile/user_edit.php?userID=" + userID, true);
    xmlhttp.send();
}