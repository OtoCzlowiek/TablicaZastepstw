<?php

$conn = new mysqli('localhost','root','','zastepstwa');
$del = "DELETE FROM `zas` WHERE UNIX_TIMESTAMP(now()) - UNIX_TIMESTAMP(date_added) > 1800"

//https://stackoverflow.com/questions/20615029/sql-how-can-i-delete-a-row-after-a-time
//dziekujemy drugiej odpowiedzi za pomoc w palacej kwestii!
?>