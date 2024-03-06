<?php 
    session_start();
?>
<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>rejestracja</title>
    <link rel="stylesheet" href="kom.css">
</head>
<body>
    <main>
    <h1>zarejestruj się</h1>
    <form action="rejekt.php" method="post">
        <label for="osoba">Nazwa użytkownika:</label><input type="text" name="osoba" id="osoba"><br>
        <label for="login">Login:</label><input type="text" name="login" id="login"><br>
        <label for="haslo">Haslo:</label><input type="text" name="haslo" id="haslo"><br>
        <label for="reje"></label><button type="submit" name="reje" id="reje">Rejestruj</button>
        <label for="str"></label><button type="submit" name="str" id="str"><a href="komentarze.php">przejdz do strony</a></button>
    </form>
    <?php 
      $serwer = 'localhost';
      $uzytkownik = 'root';
      $haslo = '';
      $baza = 'aliensg';
      error_reporting(0);

      if(isset($_POST['reje'])) {
        $poloczenie = mysqli_connect($serwer, $uzytkownik, $haslo, $baza);


        $wynik = mysqli_query($poloczenie, "SELECT * FROM `loginy` where login = '{$_POST['login']}'");

        if(mysqli_num_rows($wynik) > 0) {
            $_SESSION['zalog'] = 0;
            echo "login już istnieje ";
        }
        else {
            $_SESSION['zalog'] = 1;
            $login = $_POST['login'];
            $haslo = $_POST['haslo'];
            $osoba = $_POST['osoba'];
            mysqli_query($poloczenie, "INSERT INTO loginy (osoba, login, haslo) VALUES ('$osoba', '$login' , '$haslo')");
            echo "zarejestrowany ";
        }

    }
        mysqli_close($poloczenie);
        var_dump($_SESSION);
    ?>
    </main>
</body>
</html>