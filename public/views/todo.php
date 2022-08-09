<?php
session_start();

if (!isset($_SESSION['zalogowany'])) {
    //  header('Location: /login.php');
}

?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Egzaminer js - to do</title>

  <link rel="stylesheet" href="/css/mybootstrap.css">
  <link rel="stylesheet" href="/css/style.css">


  <style>
    #wyloguj {
      display: block;
    }
  </style>
</head>

<body>

  <div>
    <?php  include 'navbar.php' ?>

    <div class="container pt-3">
        <ul>
            <li>wygodne dodawanie tagów</li>
            <li>tryb auto</li>
            <li>opcjonalne rodzajniki</li>
            <li>podobne, alfabetycznie</li>
            <li>losowe</li>
            <li>statystyki</li>
            <li>Lista</li>
        </ul>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.19.2/axios.js"></script>
    <script src="../js/mybootstrap.js"></script>

    <script src="../js/add.js"></script>

</body>

</html>