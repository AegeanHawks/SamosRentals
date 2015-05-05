<!DOCTYPE html>
<html>
<head lang="en">
    <?php
    $Page_Title = "Η σελίδα δεν βρέθηκε";
    include 'head.php';
    ?>

    <style>
        .Error404 {
            position: absolute;
            width: 100%;
            height: 90%;
            text-align: center;
        }

        .Error404 .col {
            display: inline-block;
            float: none;
            text-align: left;
        }

        .Error404 h1 {
            color: #fff;
            text-align: center;
            margin-top: 20%;
            font-size: 3.5rem;
        }

        .Error404 #error-404-img {
            display: block;
            width: 16rem;
            height: auto;
            margin: 3% auto;
        }

        .Error404 #error-404-img:hover {
            cursor: Default
        }

        .Error404 p {
            color: #fff;
            text-align: center;
            margin-top: 2%;
        }
    </style>
</head>
<body class="light-blue">
<?php
include 'header.php';
?>

<div class="row Error404">
    <div class="col m6">
        <h1>Ooopsss, κάτι πήγε στραβά!</h1>
        <img id="error-404-img" src="images/website/error-404.png" alt="Chyba 404">

        <p class="flow-text"><b>Η σελίδα δεν βρέθηκε!</b> Μήπως ακολουθήσατε κάποιο link από το site μας; Αν φτάσατε εδώ
            από άλλη εξωτερική σελίδα παρακαλούμε επικοινωνήστε μαζί μας ώστε να διορθώσουμε το σφάλμα.

            Μήπως γράψατε εσείς τη διεύθυνση στη διαδρομή πλοήγησης; Ίσως να μην πληκτρολογήσατε σωστά. Παρακαλούμε
            βεβαιωθείτε ότι δεν έχετε κάνει λάθος.</p>

        <div class="center">
            <a class="btn-floating btn-large waves-effect waves-light light-green" href="index.php"><i class="mdi-action-home"></i></a>
        </div>
    </div>
</div>
</body>
</html>