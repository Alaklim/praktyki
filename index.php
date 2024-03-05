<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formularz</title>
    <style>body{text-align: center};</style>
</head>
<body>
    <?php 
#try {
    #połączenie z bazą danych
    $serwer = 'localhost';
    $uzytkownik = 'root';
    $haslo = '';
    $baza = 'informacje';

    $poloczenie = mysqli_connect($serwer, $uzytkownik, $haslo, $baza);
    #usówanie informacji o errorach 
    error_reporting(0);

    ?>
    <!--formularz-->
    <h3>Prosze wypełnić poniższe informacje</h3>
    <form action="index.php" method="POST">
        <label for="imie">Imie:</label><input type="text" name="imie"><br>
        <label for="nazwisko">Nazwisko:</label><input type="text" name="nazwisko"><br>
        <label for="mail">e-mail:</label><input type="text" name="mail"><br>
        <label for="tele">Nr Telefonu:</label><input type="text" name="tele"><br>
        <button type="submit">wyślij</button><br>
        <label for="wpisy">wejdz by zobaczyć wpisy</label><button name="wpisy"><a href="new.php" target="_blank">Zobacz</a></button>
    </form>
    <?php 
        $imie = $_POST['imie'];
        $nazwisko = $_POST['nazwisko'];
        $mail = $_POST['mail'];
        $tele = $_POST['tele'];
        mysqli_query($poloczenie, "INSERT INTO inf (imie, nazwisko, mail, tele) VALUES ('$imie', '$nazwisko', '$mail', '$tele')");

        mysqli_close($poloczenie);


    ?>

</body>
</html>