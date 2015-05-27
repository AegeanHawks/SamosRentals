<!DOCTYPE html>
<html>
    <head lang="en">
        <?php
        /**
         * Created by PhpStorm.
         * User: Nickos
         * Date: 2/5/2015
         * Time: 12:16 πμ
         */
        include 'configuration.php';

        $Page_Title = "Ξενοδοχεία";
        include '../head.php';
        ?>
    </head>
    <body class="white">
        <?php
// Create connection
        $conn = new mysqli($SERVER, $DB_USERNAME, $DB_PASSWORD);

// Check connection
        Print_MSG('Σύνδεση στην βάση...');
        if ($conn->connect_error) {
            die("Αποτυχία σύνδεσης: " . $conn->connect_error);
        }
        Print_MSG("Επιτυχής σύνδεση στην βάση!");

// Create database
        $sql = "DROP DATABASE IF EXISTS " . $DB_NAME;
        if ($conn->query($sql) === TRUE) {
            Print_MSG("Η παλιά βάση " . $DB_NAME . " διαγράφηκε επιτυχώς!<br>");
        }

// Create database
        $sql = "CREATE DATABASE " . $DB_NAME . " COLLATE utf8_general_ci;";
        if ($conn->query($sql) === TRUE) {
            Print_MSG("Η βάση " . $DB_NAME . " δημιουργήθηκε επιτυχώς!<br>");
        } else {
            die("Πρόβλημα κατά την δημιουργία της βάσης: " . $conn->error . "<br>");
        }

//Select Database
        $db = mysqli_select_db($conn, $DB_NAME);

// Create Tables
        $sql = "
SET CHARACTER SET 'utf8';
SET NAMES 'utf8';
CREATE TABLE User (
  Username  VARCHAR(60) UNIQUE,
  Password  VARCHAR(30)  NOT NULL,
  LastName  VARCHAR(30)  NOT NULL,
  FirstName VARCHAR(30)  NOT NULL,
  Sex       VARCHAR(12)  NOT NULL,
  Tel       VARCHAR(20),
  Mail      VARCHAR(255) NOT NULL UNIQUE,
  Birthday  VARCHAR(30),
  Image     TEXT,
  Role      INT          NOT NULL,
  Upgrade   INT          NOT NULL,
  Active    BOOLEAN      NOT NULL DEFAULT 1,
  PRIMARY KEY (Username)
);

CREATE TABLE Hotel (
  ID          INT UNIQUE AUTO_INCREMENT,
  Name        VARCHAR(255) NOT NULL,
  Tel         VARCHAR(255) NOT NULL,
  Description VARCHAR(1000) NOT NULL,
  Coordinates VARCHAR(255) NOT NULL,
  Comforts    VARCHAR(255) NOT NULL,
  Grade       FLOAT        NOT NULL,
  Manager     VARCHAR(255) NOT NULL,
  Image       TEXT,
  Website     VARCHAR(255),
  PRIMARY KEY (ID),
  FOREIGN KEY (Manager) REFERENCES User (Username)
);

CREATE TABLE Auction (
  ID          INT UNIQUE AUTO_INCREMENT,
  Name        VARCHAR(255) NOT NULL,
  Description VARCHAR(255) NOT NULL,
  PeopleCount INT          NOT NULL,
  Closed      INT          NULL DEFAULT 0,
  Bid_Price   INT          NOT NULL,
  Buy_Price   INT          NOT NULL,
  Hotel       INT          NOT NULL,
  Images      TEXT         NOT NULL,
  End_Date    DATETIME     NOT NULL,
  GradeOfHotel  int(1)       NULL,
  GradeOfUser  int(1)       NULL,
  Highest_Bidder VARCHAR(60) NULL,
  PRIMARY KEY (ID),
  FOREIGN KEY (Hotel) REFERENCES Hotel (ID),
  FOREIGN KEY (Highest_Bidder) REFERENCES User (Username)
);

CREATE TABLE Bid(
    Username    VARCHAR(60),
    idAuction   INT,
    BidMoney    INT,
    Won BOOLEAN,
    FOREIGN KEY (Username) REFERENCES User (Username),
    FOREIGN KEY (idAuction) REFERENCES Auction (ID)
);

INSERT INTO User (username, Password, FirstName, LastName, sex, mail, Role, Birthday, Image, Tel)
VALUE ('rambou', 'Password1', 'Νικόλαος', 'Μπούσιος', 'male', 'rambou@samosrentals.gr', 0, '9 September,1992','https://avatars2.githubusercontent.com/u/4427553?v=3&s=460',''),
('armageddonas', 'Password1', 'Κωνσταντίνος', 'Χασιώτης', 'male', 'armageddonas@samosrentals.gr', 0, '25 February,1993','images/website/armageddonas.jpg',''),
('Chuck', 'Password1', 'Chuck', 'Norris', 'male', 'N.Chuck@samosrentals.gr', 1, '8 September,1970','images/hotelier.jpg',''),
('alex', 'Password1', 'Alexis', 'Ren', 'female', 'R.Alexis@samosrentals.gr', 2, '9 June,1993','images/user.jpg',''),
('Petros', 'Password1', 'Petros', 'Gleoudis', 'male', 'p.Gleoudis@samaina.gr', 1, '5 May,1968','//www.samaina-hotel-samos.com/pic-b/pic5-b.jpg',''),
('scar', 'Password1', 'Scarlett', 'Johansson', 'female', 'j.scarlet@hololywood.com', 1, '22 November,1984','http://img0.ndsstatic.com/wallpapers/d2dd90c6e7f7d3e51f34f885a6e7ce7b_large.jpeg', '+306598526655'),
('user', 'Password1', 'user', 'user', 'female', 'j.ssscarlet@hololywood.com', 2, '22 November,1984','http://img0.ndsstatic.com/wallpapers/d2dd90c6e7f7d3e51f34f885a6e7ce7b_large.jpeg', '+306598526655');

INSERT INTO Hotel (Name, Tel, Description, Coordinates, Grade, Manager, Image, Comforts)
VALUE ('Zeus', '+302273095373', 'Just 500 metres from the sea, in a magical green environment in the historical village of Ireon, lies the Zeus Studios. The complex features a beautiful garden, free Wi-Fi and free on-site parking. The Zeus studios and apartments are self catering, whilst are also suitable for guests with limited mobility. The apartments have a separate seating area and balcony with great views to the Ireon and the sea. Studios Zeus complex also features an outdoor pool. The pool area also includes a pool bar serving refreshments and light meals.',
'37.667805,26.875562', 4.0, 'armageddonas', 'http://zeushotelsamos.com/images/temp_slide_2.jpg;http://zeushotelsamos.com/images/temp_slide_4.jpg;http://zeushotelsamos.com/images/temp_slide_5.jpg','Parking, Animation, Restaurant Bar, Balcony Terrace, Sea View, Air Condition, TV, Fridge, Room Service'),
('Gagou Beach', '+302273080911', 'Το ξενοδοχείο GAGOU BEACH HOTEL είναι αμφιθεατρικά χτισμένο σ’ έναν όμορφο κολπίσκο, στην παραλία της Γάγκου. Με νοτιοδυτικό προσανατολισμό προσφέρει όχι μόνο μοναδική θέα αλλά και εικόνες του πιο όμορφου ηλιοβασιλέματος. Απέχει μόλις 500 μέτρα από το λιμάνι της Σάμου και 700 μέτρα από την κεντρική πλατεία της πόλης. Είναι εύκολα προσβάσιμο είτε οδικώς είτε με τα πόδια στο πιο τουριστικό κομμάτι της πόλης. Απέχει 17 Κm από το αεροδρόμιο της Σάμου και αποτελεί ιδανική αφετηρία για όλες τις εξορμήσεις σας στο νησί.',
'37.764956, 26.965506', 4, 'Chuck', '//c4.staticflickr.com/8/7222/7186472763_91de078823_b.jpg;//www.secureshop.gr/POOL/gagoubeachutf8/booking_manager/images/articles/ART706213396003788712021173177_small.JPG;//www.secureshop.gr/POOL/gagoubeachutf8/booking_manager/images/articles/ART133713396003788712021173177_small.JPG;//c2.staticflickr.com/6/5324/7371697954_6bcf83340d_b.jpg;//c2.staticflickr.com/6/5347/7186464779_4533cfd438_b.jpg;//c4.staticflickr.com/8/7104/7186470097_1b148d20be_b.jpg;//c1.staticflickr.com/9/8001/7371706004_2a373ee79c_b.jpg;//c1.staticflickr.com/9/8024/7371705518_7ec17538ea_b.jpg;//c1.staticflickr.com/9/8161/7186464493_4519a51862_b.jpg',
'Parking, Animation, Restaurant Bar, Balcony Terrace, Sea View, Air Condition, TV, Fridge, Room Service'),
('Doryssa Seaside Resort', '+302273088300', 'Doryssa Seaside Resort- situated next to the historic Pythagoreio, one of the most magical seaside locations on the island of Samos. The high standard complex, overlooking an impressive beach and view of the Aegean Sea. Luxury meets with tradition and the summer transforms into an authentic experience.',
'37.690266,26.9288319', 4.5, 'rambou','//doryssa.gr/photos/Home_backgrounds_EN/pool_new.jpg;//doryssa.gr/photos/Home_backgrounds_EN/backround_only_gardenview.jpg;//doryssa.gr/photos/Home_backgrounds_EN/pool_aerial.jpg;//doryssa.gr/photos/Home_backgrounds_EN/plateia.jpg;//doryssa.gr/photos/Home_backgrounds_EN/the_beach.jpg;//doryssa.gr/photos/Home_backgrounds_EN/lake.jpg;//doryssa.gr/photos/Home_backgrounds_EN/interior1.jpg;//doryssa.gr/photos/Home_backgrounds_EN/doryssa_aero.jpg;//doryssa.gr/photos/Home_backgrounds_EN/village2.jpg','Swimming Pool, Parking, Sports, Restaurant, Bar, Balcony, Sea View, Air Condition, Suitable for Disabled, Room Service, WLAN'),
('Samaina', '+306936078159', 'If you like to spend the most precious time of the year, your holidays, in a hotel where people really care about you and your wishes, Samaina Hotel on the Greek island of Samos is the place to be! The owner Petros Gleoudis uses his 30 years of experience in hotel management and customer service to let his guests have an unforgettable time in his hotel. This objective, the comfortable rooms, the hotel location in a quiet part of the picturesque village of Pythagorion and not to forget the almost infinite possibilities which the beautiful island of Samos offers to its visitors – this all makes vacationers dreams come true. Since guests are coming back to Samaina Hotel Samos year after year you can be sure to choose the ideal address for your holidays in Greece if you get in touch with the Gleoudis family. You will also enjoy their remarkable hospitality, remember it and finally return to Samaina Hotel as so many others do. See you there!',
'37.691376,26.943239', 3.6, 'Petros', '//www.samaina-hotel-samos.com/pic-b/pic1-b.jpg;//www.samaina-hotel-samos.com/pic-b/pic3-b.jpg;//www.samaina-hotel-samos.com/pic-b/pic4-b.jpg;//www.samaina-hotel-samos.com/pic-b/pic7-b.jpg;//www.samaina-hotel-samos.com/pic-b/pic8-b.jpg;//www.samaina-hotel-samos.com/pic-b/pic9-b.jpg','Parking, Bar, Balcony, Sea View, Air Condition, Fridge, WLAN'),
('Aegeon Ξενοδοχείο', '+302273035412', 'Το ξενοδοχείο «ΑΙΓΑΙΟ» βρίσκεται στο Καρλόβασι της Σάμου και είναι χτισμένο με την  παραδοσιακή αρχιτεκτονική του νησιού. Διαθέτει 57 δωμάτια με δυναμικότητα 109 κλινών και μπορεί να σας προσφέρει τις ιδανικές διακοπές με την πείρα 20 χρόνων. Το ξενοδοχείο μας διαθέτει ειδικά διαμορφωμένους χώρους για άτομα με κινητικά προβλήματα που θα κάνουν ευκολότερη τη διαμονή τους.',
'37.796212,26.707275', 4.0, 'rambou', '//lh3.googleusercontent.com/-0fcG-Rbz82U/U9GzhgrDZ9I/AAAAAAAAAA8/Y9d1Q8SSLq8/s203/IMG_0597.JPG;//www.aegeonhotel.gr/images/NEW%20PHOTO%20OK%20500X333/DSC_1714.jpg;https://lh3.googleusercontent.com/-7bWrCAmdogA/U9G0odBs7GI/AAAAAAAAACQ/q53SMnRE-jY/s203/PROSOPSI%2BRETOUS%2B1%2BIMG_725.jpg;https://lh5.googleusercontent.com/-WV6zIWtGhlY/VNvu6T9o1pI/AAAAAAAAADM/R_5hQ7LTt0s/s203/photo.jpg;https://lh4.googleusercontent.com/-eiDuS77cCtU/VNvu5qS2mKI/AAAAAAAAADE/-AmjRASxorQ/s203/photo.jpg;https://lh3.googleusercontent.com/-PZxdf2l6tCs/VNvu8fkesgI/AAAAAAAAADk/umy4C7idqPs/s203/photo.jpg;https://lh6.googleusercontent.com/-FDt1MabC4Z4/VNvu4iRgEeI/AAAAAAAAAC0/yV0bMjYA_mI/s203/photo.jpg',
'Parking, Bar, Balcony, Sea View, Air Condition, Fridge, WLAN'),
('Nefeli Hotel', '+302273034000', 'Άνετο, κομψό, οικογενειακό σχεδιασμένο με σεβασμό στην τοπική παραδοσιακή αρχιτεκτονική. Οι εσωτερικοί χώροι περιλαμβάνουν τραπεζαρία, σαλόνι – αίθουσα τηλεόρασης, bar, αναγνωστήριο και ασύρματο ίντερνετ. Στους εξωτερικούς χώρους υπάρχει πισίνα & Jacuzzi οικολογικής λειτουργίας (ιονισμού και οξυγόνωσης, χωρίς  τη χρήση επιβλαβών χημικών που χρησιμοποιούνται  σε όλες τις συμβατικές πισίνες), poolbar και ασύρματο ίντερνετ. Βρίσκεται στη δυτική Σάμο, στο πιο πράσινο κομμάτι του νησιού και απέχει 150 μέτρα από τη θάλασσα και 1000 μέτρα από το λιμάνι.',
'37.796524, 26.702724', 3.2, 'armageddonas', 'http://www.hotelnepheli.com/uploads/photos/1_13.jpg;http://www.hotelnepheli.com/uploads/photos/1_18.jpg;//www.hotelnepheli.com/uploads/photos/1_2.jpg;http://www.hotelnepheli.com/uploads/photos/1_29.jpg;http://www.hotelnepheli.com/uploads/photos/1_31.jpg;http://www.hotelnepheli.com/uploads/photos/1_32.jpg;http://www.hotelnepheli.com/uploads/photos/1_33.jpg;http://www.hotelnepheli.com/uploads/photos/1_34.jpg','Parking, Bar, Balcony, Sea View, Air Condition, Fridge, WLAN'),
('Arion', '+302273092020', 'The four star Arion Hotel is located on the north part of Samos Island , near the village of Kokkari , 10 Kms from Samos town and 25 Kms from the airport. Since the hotel is set in a magic landscape of captivating natural beauty far from any kind of disturbance , the Arion is the ideal place for people whose dream is a relaxing holiday. The rooms , all fully air conditoning , are equipped with the latest amenties including a TV set and regrigerator.Their large verandas overlook the deep blue Aegean Sea and the lush green surrounding.',
'37.77883,26.87744', 5.0, 'scar', '//d1p98clqffzjxh.cloudfront.net/templates/2569/files/arion.jpg;http://www.arion-hotel.com/photos/025.jpg;http://www.arion-hotel.com/photos/015.jpg;http://www.arion-hotel.com/photos/019.jpg','Parking, Bar, Balcony, Sea View, Air Condition, Fridge, WLAN'),
('Lido Palace', '+302109212346', 'Το Lido Palace καθιερώθηκε το 1981 και βρίσκεται στη λεωφόρο Συγγρού 101. To club είναι περίπου 500 τετραγωνικά μέτρα και έχει χωρητικότητα περίπου 300 ατόμων. Ο χώρος κλιματίζεται και είναι διακοσμημένος με χιλιάδες οπτικές ίνες που δημιουργούν μια πρωτότυπη και χαλαρωτική ατμόσφαιρα. Εξωτερικά υπάρχει άνετος και δωρεάν χώρος στάθμευσης για το όχημά σας.  Αν και υπάρχουν πολλά strip clubs στην Αθήνα, το Lido Palace είναι διάσημο από τη δεκαετία του \'80. Αυτό συμβαίνει επειδή φιλοξενούμε τις ομορφότερες εξωτικές χορεύτριες. Είμαστε πάντα σε αναζήτηση νέων ταλέντων και μόλις τα ανακαλύψουμε στις περισσότερες περιπτώσεις θα κάνουμε το αδύνατο δυνατό για να τα φέρουμε στο club έτσι ώστε να τα απολαύσουν οι πελάτες μας. Έχουμε χορεύτριες από όλο τον κόσμο προσφέροντας έτσι μια ποικιλία στo show του Lido Palace. Αυτό καθιστά το Lido Palace μοναδικό.',
'37.958545,23.719464', 4.5, 'Chuck', 'https://scontent-vie.xx.fbcdn.net/hphotos-xpf1/t31.0-8/1655099_279227022246395_1919956323_o.jpg;https://scontent-vie.xx.fbcdn.net/hphotos-xpf1/t31.0-8/904636_279228625579568_26480372_o.jpg;https://scontent-vie.xx.fbcdn.net/hphotos-xta1/v/t1.0-9/10917358_10152614373352543_5595763220626204857_n.jpg?oh=1b048e342b418721a581004a01927498&oe=55C57E82;https://fbcdn-sphotos-g-a.akamaihd.net/hphotos-ak-xpa1/v/t1.0-9/10922553_10152618435002543_2751694248850244023_n.jpg?oh=3934c37e508d722831313e0dca307743&oe=560DADF4&__gda__=1439362274_91fc80589a0d35a5124595fbda8e0fe0;https://scontent-vie.xx.fbcdn.net/hphotos-xpf1/v/t1.0-9/11081221_10152765793922543_987972985133053954_n.jpg?oh=756b728e390d4c323fad5fd2448ddeca&oe=560B1042','ΣΚΛΗΡΟ ΛΕΣΒΙΑΚΟ, ΟΙ ΦΥΛΑΚΙΣΜΕΝΟΙ, BLADE, ΤΖΑΚΣΟΝ, ΛΕΣΒΙΑΚΟ ΑΠΛΟ, ΔΙΟΝΥΣΙΑΚΑ, ΠΥΡΙΝΙΚΟΣ ΠΟΛΕΜΟΣ, ΑΣΤΥΝΟΜΟΣ, Ες-Ες, ΜΠΑΛΑΡΙΝΑ, ΙΝΔΙΑΝΑ ΚΑΙ ΚΑΟΥΜΠΟΙ, ΠΕΙΡΑΤΕΣ, ΜΠΑΤΜΑΝ');

INSERT INTO Auction (Name, Description, PeopleCount, Closed, Bid_Price, Buy_Price, Hotel, Images, End_Date) VALUES
('White room - Doryssa', 'Προσφορά το λευκό δωμάτιο. Εξαιρετικό για διαμονή με την κοπέλα σας. Το σίγουρο είναι πως στο τέλος της νύχτας το λευκό δωμάτιο θα λεκιάσει...', 3, 0, 26, 60, 3, '//doryssa.gr/photos/Home_backgrounds_EN/backround_only_gardenview.jpg', NOW() + Interval 1 DAY ),
('2 persom room - Samaina', 'Προσφορά μέτριας κατηγορίας δωμάτιο στο πυθαγόριο. Κοντά στην θάλλασα και στο χωρίο, είναι ότι πρέπει για να έχετε ένα σημείο ξεκούρασης κατα την διάρκεια των διακοπών σας.', 2, 0, 10, 25, 4, '//www.samaina-hotel-samos.com/pic-b/pic3-b.jpg', NOW() + Interval 3 DAY ),
('Προσφορά στο Zeus', 'Η ποιο γαμάτη σουίτα!', 4, 1, 28, 30, 1, 'http://lunar.thegamez.net/bedroomideaspic/contemporary-interior-design-ideas/modern-interior-design-hotel-room-ventasaludcom-1120x840.jpg', NOW() + Interval 3 DAY ),
('Μόνο για λίγες μέρες στο Lido', 'Ψηλή ξανθιά γαλανομάτα γκόμενα. Μωρό εισαγώμενο κατευθείαν από Ουκρανία (το κορίτσι έφυγε λόγο εμφύλιου)...', 1, 0, 65, 100, 8, 'images/alcatraz111.jpg', NOW() + Interval 9 DAY ),
('Προσφορά στο Nefeli', 'Προσφορά μόνο για λίγες μέρες. Τρέξτε να το κλείσετε...', 4, 0, 32, 40, 6, 'http://www.hotelnepheli.com/uploads/photos/1_34.jpg', NOW() + Interval 4 DAY ),
('Lux Suit', 'Η ποιο γαμάτη σουίτα!', 4, 0, 10, 60, 1, 'images/office.jpg', '2015-05-18 16:48:17'),
('mpla mpla', 'Η ποιο γαμάτη σουίτα!', 4, 0, 10, 5, 1, 'images/office.jpg', '2015-05-20 16:48:17'),
('CH3', 'CH3', 2, 0, 11, 13, 8, '', '2015-05-30 23:59:59'),
('CH4', 'CH4', 2, 0, 11, 13, 8, '', '2015-05-30 23:59:59'),
('CH5', 'CH5', 2, 0, 11, 13, 8, '', '2015-05-30 23:59:59'),
('CH6', 'CH6', 2, 0, 11, 13, 8, '', '2015-05-30 23:59:59'),
('CH7', 'CH7', 2, 0, 11, 13, 8, '', '2015-05-30 23:59:59'),
('CH8', 'CH8', 2, 0, 11, 13, 2, '', '2015-05-30 23:59:59'),
('CH10', 'CH10', 2, 0, 11, 13, 8, '', '2015-05-30 23:59:59'),
('CH9', 'CH9', 2, 0, 11, 13, 8, '', '2015-05-30 23:59:59');
";

        if ($conn->multi_query($sql) === TRUE) {
            Print_MSG("Οι πίνακες δημιουργήθηκαν επιτυχώς!");
        } else {
            Print_MSG("Πρόβλημα κατά την δημιουργία πινάκων: " . $conn->error);
            mysqli_query($conn, "DROP DATABASE " . $DB_NAME . ";");
        }

//Close Connection
        $conn->close();
        Print_MSG("Η σύνδεση με την βάση έκλεισε.");

        function Print_MSG($msq) {
            echo '<span class="flow-text">';
            echo $msq;
            echo '</span>';
            echo '<br>';
        }
        ?>

    </body>
</html>