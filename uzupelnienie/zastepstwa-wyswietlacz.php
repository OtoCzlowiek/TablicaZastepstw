<?php
include "test.php";

//pobieranie z bazy
$sel="SELECT * FROM `zas`";
$que=mysqli_query($con, $sel);

?>

<!doctype html>
<html>

<head>
	<title>Zastępstwa w T19</title>
	<meta charset="utf-8">
	<link rel="stylesheet" href="zastepstwa-wyswietlacz.css" />
</head>

<body>
	<div class="cien">
	<content id="cnt">
		<h1>Zastępstwa na dzień dzisiejszy</h1>
		<p id="dziendzis"></p>
		<table>
			<tbody>
				<tr>
					<th>Klasa</th>
					<th>Godziny</th>
					<th>Przedmiot</th>
					<th>Zastępstwo za</th>
					<th>Zastępujący</th>
				</tr>
				<?php
                    //wklejanie do tabelki (w 118 link do usuwania z niej)
                    $num = mysqli_num_rows($que);
                    if ($num>0){
                        while ($result=mysqli_fetch_assoc($que)){
                            echo "<tr>
                                    <td>".$result['klasa']."</td>
                                    <td>".$result['godziny_od']."</td>
                                    <td>".$result['przedmiot']."</td>
                                    <td>".$result['zastepstwo_za']."</td>
                                    <td>".$result['zastepstwo']."</td>
                                </tr>";
                        }
                    }
                ?>
			</tbody>
		</table>
		<p id="credits">Opracowanie strony: Jacob & Janusz 3gc</p>
	</content>
	</div>

	<script>
		var d = new Date();
		var d_dt = d.getDay();
		var d_mc = d.getMonth() + 1;
		var d_rok = d.getYear() + 1900;
		var d_cd = ', ' + d.getDate() + '.' + d_mc + '.' + d_rok;

		if (d_dt == 1) { document.getElementById('dziendzis').innerHTML = 'Poniedziałek' + d_cd; }
		if (d_dt == 2) { document.getElementById('dziendzis').innerHTML = 'Wtorek' + d_cd; }
		if (d_dt == 3) { document.getElementById('dziendzis').innerHTML = 'Środa' + d_cd; }
		if (d_dt == 4) { document.getElementById('dziendzis').innerHTML = 'Czwartek' + d_cd; }
		if (d_dt == 5) { document.getElementById('dziendzis').innerHTML = 'Piątek' + d_cd; }
		if (d_dt == 6) { document.getElementById('dziendzis').innerHTML = 'Sobota' + d_cd; }
		if (d_dt == 7) { document.getElementById('dziendzis').innerHTML = 'Niedziela' + d_cd; }
		
		window.setInterval(function() {
  			var elem = document.getElementById('cnt');
 			elem.scrollTop = elem.scrollHeight;}, 6000);
		setTimeout(function(){location.reload('dziendzis')},12000)

//		var scoll = setInterval(function(){window.scrollBy(0,1); }, 2);
	</script>
</body>

</html>