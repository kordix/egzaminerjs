<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista słówek</title>
    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@latest/dist/style.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
    <link rel="stylesheet" href="/css/mybootstrap.css">
    <link rel="stylesheet" href="/css/style.css">

    <style>
        .hide{
            visibility:hidden;
        }
    </style>
</head>

<body>

<?php require '../views/navbar.php'; ?>
    <div class="container">
        <p id="messages"></p>

        <div id="addform">
        <p><b id="addheader">Dodaj słówko</b></p>
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
            <input type="text" id="crudanswerinput">
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
            <input type="checkbox" id="sentencecheckbox">
        </div>

        <button type="button" id="savebutton" class="btn btn-primary" onclick="add()">Dodaj</button>
        <button type="button" id="updatebutton" class="btn btn-primary" style="display:none" onclick="updateTheQuestion()">Zapisz zmiany</button>
        </div>

        <div style="position:relative">
          <button style="position:absolute;top:20px;right:300px" onclick="toggleAnswers()">Ukryj tłumaczenia</button>
        </div>
        <table id="myTable" class="table">
            <thead>
                <tr>
                    <th>id</th>
                    <th>Pytanie</th>
                    <th>Tłumaczenie</th>
                    <th>Counter</th>
                    <th>Usuń</th>
                    <th>Edytuj</th>
                </tr>
            </thead>
            <tbody id="tablebody">
            </tbody>
        </table>


  


    </div>

    <script src="https://cdn.jsdelivr.net/npm/simple-datatables@latest" type="text/javascript"></script>
    <script src="../js/lista.js"></script>
    <script src="../js/mybootstrap.js"></script>

</body>

</html>