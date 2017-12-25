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
SET GLOBAL event_scheduler = ON;

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
  Role      INT          NOT NULL DEFAULT 2,
  Upgrade   INT          NOT NULL DEFAULT 0,
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
('Petros', 'Password1', 'Petros', 'Gleoudis', 'male', 'p.Gleoudis@samaina.gr', 1, '5 May,1968','images/hotelier.jpg',''),
('scar', 'Password1', 'Scarlett', 'Johansson', 'female', 'j.scarlet@hololywood.com', 1, '22 November,1984','images/hotelier.jpg', '+306598526655'),
('user', 'Password1', 'user', 'user', 'female', 'j.ssscarlet@hololywood.com', 2, '22 November,1984','http://img0.ndsstatic.com/wallpapers/d2dd90c6e7f7d3e51f34f885a6e7ce7b_large.jpeg', '+306598526655');

INSERT INTO Hotel (Name, Tel, Description, Coordinates, Grade, Manager, Image, Comforts)
VALUE ('Zeus', '+302273095373', 'Just 500 metres from the sea, in a magical green environment in the historical village of Ireon, lies the Zeus Studios. The complex features a beautiful garden, free Wi-Fi and free on-site parking. The Zeus studios and apartments are self catering, whilst are also suitable for guests with limited mobility. The apartments have a separate seating area and balcony with great views to the Ireon and the sea. Studios Zeus complex also features an outdoor pool. The pool area also includes a pool bar serving refreshments and light meals.',
'37.667805,26.875562', 4.0, 'armageddonas', 'http://zeushotelsamos.com/images/temp_slide_2.jpg;http://zeushotelsamos.com/images/temp_slide_4.jpg;http://zeushotelsamos.com/images/temp_slide_5.jpg','Parking, Animation, Restaurant Bar, Balcony Terrace, Sea View, Air Condition, TV, Fridge, Room Service'),
('Gagou Beach', '+302273080911', 'Το ξενοδοχείο GAGOU BEACH HOTEL είναι αμφιθεατρικά χτισμένο σ’ έναν όμορφο κολπίσκο, στην παραλία της Γάγκου. Με νοτιοδυτικό προσανατολισμό προσφέρει όχι μόνο μοναδική θέα αλλά και εικόνες του πιο όμορφου ηλιοβασιλέματος. Απέχει μόλις 500 μέτρα από το λιμάνι της Σάμου και 700 μέτρα από την κεντρική πλατεία της πόλης. Είναι εύκολα προσβάσιμο είτε οδικώς είτε με τα πόδια στο πιο τουριστικό κομμάτι της πόλης. Απέχει 17 Κm από το αεροδρόμιο της Σάμου και αποτελεί ιδανική αφετηρία για όλες τις εξορμήσεις σας στο νησί.',
'37.764956, 26.965506', 4, 'Chuck', 'https://c4.staticflickr.com/8/7222/7186472763_91de078823_b.jpg;https://www.secureshop.gr/POOL/gagoubeachutf8/booking_manager/images/articles/ART706213396003788712021173177_small.JPG;https://www.secureshop.gr/POOL/gagoubeachutf8/booking_manager/images/articles/ART133713396003788712021173177_small.JPG;https://c2.staticflickr.com/6/5324/7371697954_6bcf83340d_b.jpg;https://c2.staticflickr.com/6/5347/7186464779_4533cfd438_b.jpg;https://c4.staticflickr.com/8/7104/7186470097_1b148d20be_b.jpg;https://c1.staticflickr.com/9/8001/7371706004_2a373ee79c_b.jpg;https://c1.staticflickr.com/9/8024/7371705518_7ec17538ea_b.jpg;https://c1.staticflickr.com/9/8161/7186464493_4519a51862_b.jpg',
'Parking, Animation, Restaurant Bar, Balcony Terrace, Sea View, Air Condition, TV, Fridge, Room Service'),
('Doryssa Seaside Resort', '+302273088300', 'Doryssa Seaside Resort- situated next to the historic Pythagoreio, one of the most magical seaside locations on the island of Samos. The high standard complex, overlooking an impressive beach and view of the Aegean Sea. Luxury meets with tradition and the summer transforms into an authentic experience.',
'37.690266,26.9288319', 4.5, 'rambou','https://doryssa.gr/photos/Home_backgrounds_EN/pool_new.jpg;https://doryssa.gr/photos/Home_backgrounds_EN/backround_only_gardenview.jpg;https://doryssa.gr/photos/Home_backgrounds_EN/pool_aerial.jpg;https://doryssa.gr/photos/Home_backgrounds_EN/plateia.jpg;https://doryssa.gr/photos/Home_backgrounds_EN/the_beach.jpg;https://doryssa.gr/photos/Home_backgrounds_EN/lake.jpg;https://doryssa.gr/photos/Home_backgrounds_EN/interior1.jpg;https://doryssa.gr/photos/Home_backgrounds_EN/doryssa_aero.jpg;https://doryssa.gr/photos/Home_backgrounds_EN/village2.jpg','Swimming Pool, Parking, Sports, Restaurant, Bar, Balcony, Sea View, Air Condition, Suitable for Disabled, Room Service, WLAN'),
('Samaina', '+306936078159', 'If you like to spend the most precious time of the year, your holidays, in a hotel where people really care about you and your wishes, Samaina Hotel on the Greek island of Samos is the place to be! The owner Petros Gleoudis uses his 30 years of experience in hotel management and customer service to let his guests have an unforgettable time in his hotel. This objective, the comfortable rooms, the hotel location in a quiet part of the picturesque village of Pythagorion and not to forget the almost infinite possibilities which the beautiful island of Samos offers to its visitors – this all makes vacationers dreams come true. Since guests are coming back to Samaina Hotel Samos year after year you can be sure to choose the ideal address for your holidays in Greece if you get in touch with the Gleoudis family. You will also enjoy their remarkable hospitality, remember it and finally return to Samaina Hotel as so many others do. See you there!',
'37.691376,26.943239', 3.6, 'Petros', 'https://doryssa.gr/photos/Home_backgrounds_EN/pool_new.jpg;https://doryssa.gr/photos/Home_backgrounds_EN/backround_only_gardenview.jpg;https://doryssa.gr/photos/Home_backgrounds_EN/pool_aerial.jpg;https://doryssa.gr/photos/Home_backgrounds_EN/plateia.jpg;https://doryssa.gr/photos/Home_backgrounds_EN/the_beach.jpg;https://doryssa.gr/photos/Home_backgrounds_EN/lake.jpg;https://doryssa.gr/photos/Home_backgrounds_EN/interior1.jpg;https://doryssa.gr/photos/Home_backgrounds_EN/doryssa_aero.jpg;https://doryssa.gr/photos/Home_backgrounds_EN/village2.jpg','Parking, Bar, Balcony, Sea View, Air Condition, Fridge, WLAN'),
('Aegeon Ξενοδοχείο', '+302273035412', 'Το ξενοδοχείο «ΑΙΓΑΙΟ» βρίσκεται στο Καρλόβασι της Σάμου και είναι χτισμένο με την  παραδοσιακή αρχιτεκτονική του νησιού. Διαθέτει 57 δωμάτια με δυναμικότητα 109 κλινών και μπορεί να σας προσφέρει τις ιδανικές διακοπές με την πείρα 20 χρόνων. Το ξενοδοχείο μας διαθέτει ειδικά διαμορφωμένους χώρους για άτομα με κινητικά προβλήματα που θα κάνουν ευκολότερη τη διαμονή τους.',
'37.796212,26.707275', 4.0, 'rambou', 'https://lh3.googleusercontent.com/-0fcG-Rbz82U/U9GzhgrDZ9I/AAAAAAAAAA8/Y9d1Q8SSLq8/s203/IMG_0597.JPG;https://www.aegeonhotel.gr/images/NEW%20PHOTO%20OK%20500X333/DSC_1714.jpg;https://lh3.googleusercontent.com/-7bWrCAmdogA/U9G0odBs7GI/AAAAAAAAACQ/q53SMnRE-jY/s203/PROSOPSI%2BRETOUS%2B1%2BIMG_725.jpg;https://lh5.googleusercontent.com/-WV6zIWtGhlY/VNvu6T9o1pI/AAAAAAAAADM/R_5hQ7LTt0s/s203/photo.jpg;https://lh4.googleusercontent.com/-eiDuS77cCtU/VNvu5qS2mKI/AAAAAAAAADE/-AmjRASxorQ/s203/photo.jpg;https://lh3.googleusercontent.com/-PZxdf2l6tCs/VNvu8fkesgI/AAAAAAAAADk/umy4C7idqPs/s203/photo.jpg;https://lh6.googleusercontent.com/-FDt1MabC4Z4/VNvu4iRgEeI/AAAAAAAAAC0/yV0bMjYA_mI/s203/photo.jpg',
'Parking, Bar, Balcony, Sea View, Air Condition, Fridge, WLAN'),
('Nefeli Hotel', '+302273034000', 'Άνετο, κομψό, οικογενειακό σχεδιασμένο με σεβασμό στην τοπική παραδοσιακή αρχιτεκτονική. Οι εσωτερικοί χώροι περιλαμβάνουν τραπεζαρία, σαλόνι – αίθουσα τηλεόρασης, bar, αναγνωστήριο και ασύρματο ίντερνετ. Στους εξωτερικούς χώρους υπάρχει πισίνα & Jacuzzi οικολογικής λειτουργίας (ιονισμού και οξυγόνωσης, χωρίς  τη χρήση επιβλαβών χημικών που χρησιμοποιούνται  σε όλες τις συμβατικές πισίνες), poolbar και ασύρματο ίντερνετ. Βρίσκεται στη δυτική Σάμο, στο πιο πράσινο κομμάτι του νησιού και απέχει 150 μέτρα από τη θάλασσα και 1000 μέτρα από το λιμάνι.',
'37.796524, 26.702724', 3.2, 'armageddonas', 'http://www.hotelnepheli.com/uploads/photos/1_13.jpg;http://www.hotelnepheli.com/uploads/photos/1_18.jpg;https://www.hotelnepheli.com/uploads/photos/1_2.jpg;http://www.hotelnepheli.com/uploads/photos/1_29.jpg;http://www.hotelnepheli.com/uploads/photos/1_31.jpg;http://www.hotelnepheli.com/uploads/photos/1_32.jpg;http://www.hotelnepheli.com/uploads/photos/1_33.jpg;http://www.hotelnepheli.com/uploads/photos/1_34.jpg','Parking, Bar, Balcony, Sea View, Air Condition, Fridge, WLAN'),
('Arion', '+302273092020', 'The four star Arion Hotel is located on the north part of Samos Island , near the village of Kokkari , 10 Kms from Samos town and 25 Kms from the airport. Since the hotel is set in a magic landscape of captivating natural beauty far from any kind of disturbance , the Arion is the ideal place for people whose dream is a relaxing holiday. The rooms , all fully air conditoning , are equipped with the latest amenties including a TV set and regrigerator.Their large verandas overlook the deep blue Aegean Sea and the lush green surrounding.',
'37.77883,26.87744', 5.0, 'scar', 'https://d1p98clqffzjxh.cloudfront.net/templates/2569/files/arion.jpg;http://www.arion-hotel.com/photos/025.jpg;http://www.arion-hotel.com/photos/015.jpg;http://www.arion-hotel.com/photos/019.jpg','Parking, Bar, Balcony, Sea View, Air Condition, Fridge, WLAN');

INSERT INTO Auction (Name, Description, PeopleCount, Closed, Bid_Price, Buy_Price, Hotel, Images, End_Date) VALUES
('CH3', 'CH3', 2, 0, 11, 13, 7, 'https://i.ytimg.com/vi/09pDca1mITM/maxresdefault.jpg', '2015-05-30 23:59:59'),
('CH4', 'CH4', 2, 0, 11, 13, 7, 'https://i.ytimg.com/vi/09pDca1mITM/maxresdefault.jpg', '2015-05-30 23:59:59'),
('CH5', 'CH5', 2, 0, 11, 13, 7, 'https://i.ytimg.com/vi/09pDca1mITM/maxresdefault.jpg', '2015-05-30 23:59:59'),
('CH6', 'CH6', 2, 0, 11, 13, 7, 'https://i.ytimg.com/vi/09pDca1mITM/maxresdefault.jpg', '2015-05-30 23:59:59'),
('CH7', 'CH7', 2, 0, 11, 13, 7, 'https://i.ytimg.com/vi/09pDca1mITM/maxresdefault.jpg', '2015-05-30 23:59:59'),
('CH8', 'CH8', 2, 0, 11, 13, 2, 'https://i.ytimg.com/vi/09pDca1mITM/maxresdefault.jpg', '2015-05-30 23:59:59'),
('CH10', 'CH10', 2, 0, 11, 13, 7, 'https://i.ytimg.com/vi/09pDca1mITM/maxresdefault.jpg', '2015-05-30 23:59:59'),
('CH9', 'CH9', 2, 0, 11, 13, 7, 'https://i.ytimg.com/vi/09pDca1mITM/maxresdefault.jpg', '2015-05-30 23:59:59'),
('Lux Suit', 'Η πιο γαμάτη σουίτα!', 4, 0, 10, 60, 1, 'https://i.ytimg.com/vi/09pDca1mITM/maxresdefault.jpg', '2015-05-18 16:48:17'),
('mpla mpla', 'Η πιο γαμάτη σουίτα!', 4, 0, 10, 5, 1, 'https://i.ytimg.com/vi/09pDca1mITM/maxresdefault.jpg', '2015-05-20 16:48:17'),
('White room - Doryssa', 'Προσφορά το λευκό δωμάτιο. Εξαιρετικό για διαμονή με την κοπέλα σας. Το σίγουρο είναι πως στο τέλος της νύχτας το λευκό δωμάτιο θα λεκιάσει...', 3, 0, 26, 60, 3, 'https://doryssa.gr/photos/Home_backgrounds_EN/backround_only_gardenview.jpg', NOW() + Interval 1 DAY ),
('2 persom room - Samaina', 'Προσφορά μέτριας κατηγορίας δωμάτιο στο πυθαγόριο. Κοντά στην θάλλασα και στο χωρίο, είναι ότι πρέπει για να έχετε ένα σημείο ξεκούρασης κατα την διάρκεια των διακοπών σας.', 2, 0, 10, 25, 4, 'http://www.samainahotels.gr/images/sliderhome/slider_5.jpg', NOW() + Interval 3 DAY ),
('Προσφορά στο Zeus', 'Η ποιο γαμάτη σουίτα!', 4, 1, 28, 30, 1, 'http://www.marinabaysands.com/content/dam/singapore/marinabaysands/master/main/home/hotel/rooms-suites/hotel-rooms-banner-920x340.jpg', NOW() + Interval 3 DAY ),
('Προσφορά στο Nefeli', 'Προσφορά μόνο για λίγες μέρες. Τρέξτε να το κλείσετε...', 4, 0, 32, 40, 6, 'http://www.hotelnepheli.com/uploads/photos/1_34.jpg;http://www.arion-hotel.com/photos/019.jpg', NOW() + Interval 4 DAY );
";

        if ($conn->multi_query($sql) === TRUE) {
            Print_MSG("Οι πίνακες δημιουργήθηκαν επιτυχώς!");
        } else {
            Print_MSG("Πρόβλημα κατά την δημιουργία πινάκων: " . $conn->error);
            mysqli_query($conn, "DROP DATABASE " . $DB_NAME . ";");
        }
        sleep(1);
//Close Connection
        $conn->close();
        Print_MSG("Η σύνδεση με την βάση έκλεισε.");

        function Print_MSG($msq) {
            echo '<span class="flow-text">';
            echo $msq;
            echo '</span>';
            echo '<br>';
        }


        $con = db_connect();
        $images = glob("../images/*");
        $sql = "SELECT Image FROM User UNION SELECT Image FROM Hotel UNION SELECT Images FROM auction";
        $result = $con->query($sql);

        echo "<span style='color:blue'><b>Στην βάση</b></span><br>";
        if ($result->num_rows > 0) {
            // output data of each row
            while ($row = $result->fetch_assoc()) {
                $localimages = explode(";", $row["Image"]);

                //στην βάση
                foreach ($localimages as $lim) {
                    if (strpos($lim, '//') !== false) {
                        break;
                    } else if (strpos($lim, 'armageddonas') !== false) {
                        break;
                    } else if (strpos($lim, 'loading') !== false) {
                        break;
                    }
                    $DatabaseImage[] = $lim;
                    echo "<span style='color:green'><b>" . $lim . "</b></span><br>";
                }
            }
        }

        echo "<span style='color:blue'><b>Τοπικα</b></span><br>";
        foreach ($images as $image) {
            $var = str_replace('../', '', $image);
            if (strpos($var, '.jpg') !== false) {
                $LocalImages[] = $image;
            } elseif (strpos($var, '.png') !== false) {
                $LocalImages[] = $image;
            }
            echo "<span style='color:green'><b>" . $var . "</b></span><br>";
        }

        echo "<br><span style='color:blue'><b>Διαγραφή</b></span><br>";
        foreach ($LocalImages as $l) {
            $Delete = true;
            $l = str_replace('../', '', $l);
            foreach ($DatabaseImage as $d) {
                if (strcmp($l, $d) == 0) {
                    $Delete = false;
                }
            }
            if ($Delete) {
                echo "<span style='color:red'><b>" . $l . "</b></span><br>";
                @unlink("../" . $l);
            }
        }
        ?>

    </body>
</html>