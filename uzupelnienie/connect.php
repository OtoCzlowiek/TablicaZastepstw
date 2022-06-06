<?php
    $klasa = $_POST['klasa'];
    $godziny_od = $_POST['godziny_od'];
    $przedmiot = $_POST['przedmiot'];
    $zastepstwo_za = $_POST['zastepstwo_za'];
    $zastepstwo = $_POST['zastepstwo'];
    var_dump($_POST);

    //łączenie się z bazą
    $conn = new mysqli('localhost','root','','zastepstwa');
    if($conn->connect_error){
        die('Connection Failed: '.$conn->connect_error);
    }
    else{
        //Wysyłanie zapytania
        $stmt = $conn->prepare("insert into zas(klasa, godziny_od, przedmiot, zastepstwo_za, zastepstwo)
            values(?, ?, ?, ?, ?)");
        $stmt->bind_param("sisss", $klasa, $godziny_od, $przedmiot, $zastepstwo_za, $zastepstwo);
        $stmt->execute();
        echo "<h1>Dodano zastępstwo!</h1><a href='../zastepstwa-dodawanie.php'>Dodaj kolejne</a><br><img src='logo-banner.png'/>";
        $stmt->close();
        $conn->close();
    }
    header('Location: .\zastepstwa-dodawanie.php')
?>