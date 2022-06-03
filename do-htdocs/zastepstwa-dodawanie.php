<?php
include "test.php";

//usuwanie z bazy za pomocą przycisku
if (isset($_GET['noweid'])){
    $id=$_GET['noweid'];
    $delete=mysqli_query($con, "DELETE FROM `zas` WHERE `noweid`='$id'");
}

//pobieranie z bazy
$sel="SELECT * FROM `zas`";
$que=mysqli_query($con, $sel);

?>

<!DOCTYPE html>
<html lang="pl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Zastępsta Nauczycieli</title>
    <link rel="stylesheet" href="zastepstwa-dodawanie.css">
    <style>
        th, td, table {border: 1px solid black;}
        table {border-collapse: collapse;}
    </style>
</head>

<body>
    <header>
        <div>
            <img id="logo" src="logo-banner.png" alt="Technikum Nr 19">
        </div>
    </header>
    <header2>
        <p>Proszę o wprowadzenie danych na temat zastępstw</p>
    </header2>
    <article style="flex-direction: column">
        <h2 id="data">Zastępstwa na dzień:</h2>
        <form id='zastepstwa' action="/connect.php" method="post">
            <div style="border-right: 2px dotted #bbb">
                <label for="klasa">Klasa</label>
                <input type="text" id="klasa" style="width: 6vw;" name="klasa">
            </div>
            <div style="border-right: 2px dotted #bbb">
                <label>Godziny zwolnione</label>
                <div style="display: flex; flex-direction: row;">
                    <label for="od" style="padding: 0px 10px;">Od</label>
                    <select id="godzina_lekcyjna_od" style="width: 6vw;" name="godziny_od">
                        <option id="od" value="0">0 - 07:10</option>
                        <option id="od" value="1">1 - 8:00</option>
                        <option id="od" value="2">2 - 8:50</option>
                        <option id="od" value="3">3 - 9:45</option>
                        <option id="od" value="4">4 - 10:40</option>
                        <option id="od" value="5">5 - 11:35</option>
                        <option id="od" value="6">6 - 12:35</option>
                        <option id="od" value="7">7 - 13:30</option>
                        <option id="od" value="8">8 - 14:25</option>
                        <option id="od" value="9">9 - 15:15</option>
                        <option id="od" value="10">10 - 16:05</option>
                    </select>
                    <label for="do" style="padding: 0px 10px;">Do</label>
                    <select id="godzina_lekcyjna_do" style="width: 6vw;" name="godziny_do">
                        <option id="do" value="0">0 - 07:10</option>
                        <option id="do" value="1">1 - 8:00</option>
                        <option id="do" value="2">2 - 8:50</option>
                        <option id="do" value="3">3 - 9:45</option>
                        <option id="do" value="4">4 - 10:40</option>
                        <option id="do" value="5">5 - 11:35</option>
                        <option id="do" value="6">6 - 12:35</option>
                        <option id="do" value="7">7 - 13:30</option>
                        <option id="do" value="8">8 - 14:25</option>
                        <option id="do" value="9">9 - 15:15</option>
                        <option id="do" value="10">10 - 16:05</option>
                    </select>
                </div>
            </div>
            <div style="border-right: 2px dotted #bbb">
                <label for="przedmiot">Przedmiot</label>
                <input type="text" id="przedmiot" name="przedmiot">
            </div>
            <div style="border-right: 2px dotted #bbb">
                <label for="zastepstwo_za">Zastępstwo za</label>
                <input type="text" id="zastepstwo_za" name="zastepstwo_za">
            </div>
            <div>
                <label for="zastepujacy">Zastępujący</label>
                <input type="text" id="zastepujacy" name="zastepstwo">
            </div>
            <input id='dodaj_zastepstwo' value='Dodaj Zastępstwo' form="zastepstwa" type="submit">
        </form>
        <button id='dodaj_zastepstwo' value='Update' form="zastepstwa" type="submit">Dodaj Zastępstwo</button>
        
    </article>
    <section>
        <p id="status"></p>

        <table>
            <tbody>
                <tr>
                    <th>LP</th>
                    <th>klasa</th>
                    <th>od</th>
                    <th>do</th>
                    <th>przedmiot</th>
                    <th>zastępowany</th>
                    <th>zastępujący</th>
                    <th>Usuwanie</th>
                </tr>
                <?php
                    //wklejanie do tabelki (w 118 link do usuwania z niej)
                    $num = mysqli_num_rows($que);
                    if ($num>0){
                        while ($result=mysqli_fetch_assoc($que)){
                            echo "<tr>
                                    <td>".$result['noweid']."</td>
                                    <td>".$result['klasa']."</td>
                                    <td>".$result['godziny_od']."</td>
                                    <td>".$result['godziny_do']."</td>
                                    <td>".$result['przedmiot']."</td>
                                    <td>".$result['zastepstwo_za']."</td>
                                    <td>".$result['zastepstwo']."</td>
                                    <td><a href='zastepstwa-dodawanie.php?id=".$result['noweid']."'>Usuń</a></td>
                                </tr>";
                        }
                    }
                ?>
            </tbody>
        </table>
    </section>
    <footer>
        <p id="credits">Stronę opracowali: Jacob & Janusz 3GC</p>
    </footer>
    <script>
        function aktualizuj_date() {
            const dzisiaj = new Date();
            let yyyy = dzisiaj.getFullYear();
            let mm = dzisiaj.getMonth() + 1; // Miesiąc zaczyona się od 0
            let dd = dzisiaj.getDate();

            if (dd < 10) dd = '0' + dd;
            if (mm < 10) mm = '0' + mm;

            var data_DD_MM_YYYY = dd + '.' + mm + '.' + yyyy;
            document.getElementById("data").innerHTML = "Zastępstwa na dzień: " + data_DD_MM_YYYY;
        }
        aktualizuj_date();
        // TWORZENIA REKORDU ZASTĘPSTWA
        function dodaj_zastepstwo(){
            let klasa = document.getElementById("klasa").value;
            let godzina_od = document.getElementById("godzina_lekcyjna_od").value;
            let godzina_do = document.getElementById("godzina_lekcyjna_do").value;
            let przedmiot = document.getElementById("przedmiot").value;
            let nauczyciel_za = document.getElementById("zastepstwo_za").value;
            let nauczyciel_brak = document.getElementById("zastepujacy").value;
            
            const lista = [klasa,godzina_od,godzina_do,przedmiot,nauczyciel_za,nauczyciel_brak];

            console.log(lista);

            const rekord = (">"+lista.join(";"));
            
            console.log(rekord);
            document.getElementById("status").innerHTML += '<br>'+rekord;
            // WPISYWANIE REKORDU DO PLIKU
            
            //Uh oh problem
            
        }
 
    </script>
</body>

</html>