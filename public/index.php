<?php
// session_start();

// if(!isset($_SESSION['zalogowany'])){
//    // header('Location: /login.php');
// }

// if($_SESSION['zalogowany']){
    
// }
?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Egzaminer js</title>

  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
  <link rel="stylesheet" href="css/mybootstrap.css">
  <link rel="stylesheet" href="css/style.css">
</head>

<body>

  <?php require 'views/navbar.php'; ?>

  <div class="container mt-4">
      <p><b>Przetłumacz:</b> <span id="currentquestionquestion"></span>  <i class="bi bi-volume-up" style="cursor:pointer" id="speak"></i></p>
      <p>Counter:  <span id="currentquestioncounter"></span>  <span  style="font-size:8px">id: <span id="currentquestionid"></span> </span></p>
     
      <p id="komunikaty"> &nbsp</p>
      <div>
        <div class="mb-3">
          <input style="width:250px" class="form-control" id="answerinput" type="text" v-model="answer" placeholder="odpowiedź" :disabled="disabledInput" autocomplete="off"/>
        </div>
        <div class="mb-3">
          <button class="btn btn-primary" @click="answerm" id="answerbutton" onclick="handleAnswer(this)">answer</button>
        </div>

        <div class="mb-3">
          <button type="button" class="btn btn-success" onclick="updatecounter(1,true)" >Counter +1</button>
          <button type="button" class="btn btn-success"  onclick="updatecounter(5,true)" >Counter +5</button>
          <button type="button" class="btn btn-danger"  onclick="updatecounter(0,true)">Zresetuj</button>
        </div>

        <div class="mb-3">
          <button id="nextbutton" type="button" class="btn btn-success" onclick="next()">Dalej</button>
          <button id="prevbutton" type="button" class="btn btn-secondary" onclick="prev()">Prev</button>
          <button id="editbutton" type="button" class="btn btn-warning" style="margin-left:20px" onclick="edytuj()">Edytuj</button>
          <button id="deletebutton" type="button" class="btn btn-danger" style="margin-left:20px" onclick="deleteQuestion()">Usuń</button>
        </div>

        <div style="display:flex;align-items:center;" id="collinsy" v-if="ready">
          <a href="'" id="collinslink" target="_blank">
            <div style="background-color:#333;width:100px;height:30px;margin:.3em;padding:8px" class="icon">
              <img src="https://www.collinsdictionary.com/external/images/logo.png?version=4.0.35" class="img-fluid"/>
            </div>
          </a>

          <a :href="''+currentQuestion.answer" id="wiktionarylink" target="_blank">
            <div style="height:60px;width:60px;margin:.3em" class="icon">
              <img src="https://pl.wiktionary.org/static/images/project-logos/plwiktionary.png" class="img-fluid"/>
            </div>
          </a>

          <a :href="'https://pl.wiktionary.org/wiki/'+currentQuestion.answer" id="bablalink"  target="_blank">
            <div style="background:#333399;width:100px;height:30px;padding:8px" class="icon">
              <img src="https://static.bab.la/img/babla-logo-white.svg" class="img-fluid" alt />
            </div>
          </a>
        </div>
        <hr>
        <div class="mb-2">
            <span style="margin-bottom:0px;line-height:2rem;">Counterset:</span>
            <select class="mr-1" id="operatorselect">
              <option value="<"> < </option>
              <option value=">"> > </option>
            </select>
            <input style="width:40px" type="number" id="counterinput">
            <button type="button" name="button" onclick="saveCounterset()">Ustaw</button>

          
        </div> 

        <div class="mb-2">
          <label for="">Rodzaj materiału:</label>
          <select name="" id="senctencesselect" onchange="saveSettings()">
            <option value="0">Słowa</option>
            <option value="1">Zdania</option>
          </select>
        </div>

        <div class="mb-2">
          <label for="tryb">Tryb</label>
          <select name="" id="trybselect">
              <option value="POLDE">Polski - obcy</option>
              <option value="DEPOL">Obcy - polski</option>
            </select>
        </div>

        <label for="random">Random</label>
        <input type="checkbox" onchange="settings.random = !settings.random;saveSettings()" id="randomcheck"></input>

      <div>
        <hr>
        <p id="messages"></p>
        
      </div>
      
          <!-- <p style="margin-right:20px">Random: <input type="checkbox" v-model="randomset"></p> -->

    </div>

  </div>

  <script src="js/mybootstrap.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/1.0.0-alpha.1/axios.min.js" integrity="sha512-xIPqqrfvUAc/Cspuj7Bq0UtHNo/5qkdyngx6Vwt+tmbvTLDszzXM0G6c91LXmGrRx8KEPulT+AfOOez+TeVylg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
  <script src="https://cdn.jsdelivr.net/npm/lodash@4.17.21/lodash.min.js"></script>
  <script src="js/script.js"></script>

</body>

</html>