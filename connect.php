<?php
    $klasa = $_POST['klasa'];
    $godziny_od = $_POST['godziny_od'];
    $godziny_do = $_POST['godziny_do'];
    $przedmiot = $_POST['przedmiot'];
    $zastepstwo_za = $_POST['zastepstwo_za'];
    $zastepstwo = $_POST['zastepstwo'];

    //łączenie się z bazą
    $conn = new mysqli('localhost','zastepstwa','awtspetsaz','technikum19');
    if($conn-->connect_error){
        die('Connection Failed: '.$conn->connect_error);
    }
    else{
        //Wysyłanie zapytania
        $stmt = $conn->prepare("insert into zastepstwa(klasa, godziny_od, godziny_do, przedmiot, zastepstwo_za, zastepstwo)
            values(?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("siisss", $klasa, $godziny_od, $godziny_do, $przedmiot, $zastepstwo_za, $zastepstwo);
        $stmt->execute();
        echo "Dodano zastępstwo!";
        $stmt->close();
        $conn->close();
    }
?>