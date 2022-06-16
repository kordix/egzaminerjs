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

    <div id="app">
        <?php  include 'navbar.php' ?>

        <div class="container">
                <p id="messages"></p>

                <p><b>Dodaj słówko</b></p>
                <div style="display:none" class="mb-2">
                    <label>Rodzajnik</label>
                    <select id="rodzajnikselect" onchange="handleRodzajnikSelect(this)">
                        <option value="">Wybierz</option>
                        <option value="der">der</option>
                        <option value="die">die</option>
                        <option value="das">das</option>
                    </select>
                </div>
                <div class="mb-2">
                    <label for>Pytanie (po polsku)</label>
                    <input type="text" id="questioninput">
                </div>
                <div class="mb-2">
                    <label for>Odpowiedź (po obcemu)</label>
                    <input type="text" id="answerinput">
                </div>
                <div class="mb-2">
                    <label for="category">Część mowy:</label>
                    <select name="" id="partofspeechselect">
                        <option value="nieprzypisane">nieprzypisane</option>
                        <option value="rzeczownik">rzeczownik</option>
                        <option value="czasownik">czasownik</option>
                        <option value="przymiotnik">przymiotnik</option>
                        <option value="przyimek">przyimek</option>
                        <option value="zwroty">zwroty</option>
                    </select>
                </div>
                <div class="mb-2">
                    <label for="tags">Tag:</label>
                    <select name="" id="" v-model="chosentag">
                        <option value="nieprzypisane">nieprzypisane</option>
                        <option value="" v-for="tag in $root.tags" :value="tag.name">{{tag.name}}</option>
                    </select>
                </div>
                <div>
                    <label for="">Zdanie:</label>
                    <input type="checkbox" v-model="sentence">
                </div>

                <button type="button" name="button" class="btn btn-primary" onclick="add()">Zatwierdź</button>

        </div>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.19.2/axios.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
            crossorigin="anonymous"></script>

        <script src="../js/add.js"></script>

</body>

</html>