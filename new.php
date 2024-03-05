<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>wpisy</title>
</head>
<body>
    <h2>Wpisy</h2>
    <?php 
 
    #połączenie z bazą danych
    $serwer = 'localhost';
    $uzytkownik = 'root';
    $haslo = '';
    $baza = 'informacje';

    $poloczenie = mysqli_connect($serwer, $uzytkownik, $haslo, $baza);
    #jesli cos sie nie uda

     mysqli_select_db($poloczenie, $baza);
     $wynik = mysqli_query($poloczenie, "SELECT * FROM inf");

     echo "<table><tr><th>imie</th><th>nazwisko</th><th>email</th><th>telefon</th></tr>";
     if(isset($_POST["edyt"])){
        $edyt = $_POST["edyt"];
         $imie = $_POST['imie'];
         $nazwisko = $_POST['nazwisko'];
         $mail = $_POST['mail'];
         $tele = $_POST['tele'];

         if($imie != "" && $nazwisko != "" && $mail != "" && $tele != ""){
            $rowId = $_POST['id'];
            var_dump("UPDATE `inf` SET `imie` = '$imie', `nazwisko` = '$nazwisko', `mail` = '$mail', `tele` = '$tele' WHERE `inf`.`id` = $rowId;");
             mysqli_query($poloczenie, "UPDATE `inf` SET `imie` = '$imie', `nazwisko` = '$nazwisko', `mail` = '$mail', `tele` = '$tele' WHERE `inf`.`id` = $rowId;");
             header("Refresh:0");
         }
         else{
             echo "nah";
         }
      };
     while($row = mysqli_fetch_array($wynik)){
        echo "<tr><td>{$row['imie']}</td>
        <td>{$row['nazwisko']}</td>
        <td>{$row['mail']}</td>
        <td>{$row['tele']}</td><td>
        <form action='new.php' method='POST'><input type='hidden' name='delete' value='{$row['id']}'><button type='submit' >usuń</button></form></td><td>";
        $rowId = $row['id'];
        echo "<form action='new.php' method='POST'><input type='hidden' name='edit' value='{$row['id']}'><button type='submit' >Edytuj</button></form></td></tr><br>";

        if(isset($_POST["edit"]) && $_POST["edit"] ==$row["id"]){
            $edit = $_POST["edit"];
            echo "<form method='post'>
            <label for='imie'>imie:</label><input type='text' value=" . $row['imie'] . " id='imie' name='imie'><br>
            <label for='nazwisko'>nazwisko:</label><input type='text' value=" . $row['nazwisko'] . " id='nazwisko' name='nazwisko'><br>
            <label for='mail'>e-mail:</label><input type='text' value=" . $row['mail'] . " id='mail' name='mail'><br>
            <label for='tele'>telefon:</label><input type='text' value=" . $row['tele'] . " id='tele' name='tele'><br>
            <label for='cos'></label><input type='hidden' id='cos' name='id' value='$rowId'><br>
            <label for='cos2'></label><input type='submit' id='cos2' name='edyt' value='edytuj'>
        </form>";
         
       };
     };

     if(isset($_POST['delete'])){
        $usun = $_POST['delete'];
        mysqli_query($poloczenie, "DELETE FROM inf WHERE id= $usun ;");
       echo $usun;
     };

     mysqli_close($poloczenie);
    ?>
    
</body>
</html>