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
  <title>Egzaminer js - dodawanie słówek</title>

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
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
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
      crossorigin="anonymous"></script>

    <script src="../js/add.js"></script>

</body>

</html>