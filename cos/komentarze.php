<?php 
    session_start();
?>
<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Posty</title>
    <style>textarea{resize: none;}</style>
    <link rel="stylesheet" href="kom.css">
</head>
<body>
    <main>
    <?php 
        $serwer = 'localhost';
        $uzytkownik = 'root';
        $haslo = '';
        $baza = 'aliensg';

        $polcz = mysqli_connect($serwer, $uzytkownik, $haslo, $baza);

        error_reporting(0);
    ?>
    <h1>Posty</h1>
        <form action="komentarze.php" method="post">
            <label for="h"></label><button id="h" name="h" type="submit">zmien login</button>
            <label for="str"></label><button type="submit" name="str" id="str"><a href="rejekt.php">idz sie zarejestrowac</a></button>
        </form>
    <?php
        if(isset($_POST['h'])){
    echo '<section class="logowanie">
    <form action="komentarze.php" method="post">
        <label for="login">Login:</label><input type="text" name="login" id="login"><br>
        <label for="haslo">Haslo:</label><input type="password" name="haslo" id="haslo"><br>
        <label for="zaloguj"></label><button type="submit" name="zaloguj" id="zaloguj">Zaloguj</button><br>
        <label for="rejest">Nie masz konta? to je załóż:</label><button id="rejest" name="rejest"><a href="rejekt.php">Zarejestrój</a></button>   
    </form>
</section>';
        };
if(isset($_POST['zaloguj'])) {
    $wynik = mysqli_query($polcz, "SELECT * FROM `loginy` where login = '{$_POST['login']}' and haslo = '{$_POST['haslo']}'");

    if(mysqli_num_rows($wynik) > 0) {
        $_SESSION['zalog'] = 1;
        echo "jesteś zalogowany";
    }
    else {
        $_SESSION['zalog'] = 0;
        echo "wprowadzone wartości są błędne lub nie istnieją ";
    }
};
   if(isset($_SESSION["zalog"]) && $_SESSION["zalog"] == 1){
        #jeśli jest zalogowany to wyświetla wszystko
    echo '<section class="posty">;
       <img src="eyre.png">
        <img src="Nienazwany.png">
        <img src="teeee3.png">
    </section>
    <section class="wpisy">
        <form action="komentarze.php" method="post">
            <label for="wpis">Wpisz wpis:</label><textarea cols="80" rows="10" id="wpis" name="wpis"></textarea>
            <button type="submit" name="wyslij">wyślij</button>
        </form>
    </section>';
    $wynik = mysqli_query($polcz, "SELECT * FROM `wpisy`");
     while($row = mysqli_fetch_array($wynik)){
        echo "<br>
        <table><tr><td>{$row['wpis']}</td>
        <td><form action='komentarze.php' method='post'><input type='hidden' name='usun' value='{$row['id']}'>
        <button type='submit'>usun</buttom></form></td></tr>";
     };
        $wpis = $_POST['wpis'];
        if(isset($_POST['wyslij'])){
            mysqli_query($polcz, "INSERT INTO wpisy (wpis) VALUES ('$wpis')");
            header('Refresh:0');
        }
        
    }
    if(isset($_POST['usun'])){
        $usun = $_POST['usun'];
        mysqli_query($polcz, "DELETE FROM wpisy WHERE id = $usun");
        header('Refresh:0');
     };
    
    mysqli_close($polcz);

    var_dump($_SESSION);
    ?>
    </main>
</body>
</html>