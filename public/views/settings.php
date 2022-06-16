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

    <div class="container">
      <p id="messages"></p>

        <div class="mb-2">
            <span style="margin-bottom:0px;line-height:2rem;">Counterset:</span>
            <select class="mr-1" id="countersettypeselect">
              <option value="<"> < </option>
              <option value=">"> > </option>
            </select>
            <input style="width:50px" type="number" id="countersetvalueinput">
            <button type="button" name="button" @click="reload">Ustaw</button>
        </div> 

        <div class="mb-2">
          <label for="">Rodzaj materiału:</label>
          <select name="" id="">
            <option value="words">Słowa</option>
            <option value="sentences">Zdania</option>

          </select>
        </div>
      
          <p style="margin-right:20px">Random: <input type="checkbox" v-model="randomset"></p>

     



    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.19.2/axios.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
      crossorigin="anonymous"></script>

    <script src="../js/add.js"></script>

</body>

</html>