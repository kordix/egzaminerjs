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

  <!-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"> -->

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

  <link rel="stylesheet" href="style.css">

  <style>
    #wyloguj {
      display: block;
    }
  </style>
</head>

<body>

  <div>

    <nav class="navbar navbar-expand-lg navbar-light shadow-sm">
      <div class="container">
        <a class="navbar-brand" href="#">Egzaminer JS Bootstrap 5</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
          aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav me-auto mb-2 mb-lg-0">
            <li class="nav-item">
              <a class="nav-link" aria-current="page" href="#">Tester</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" aria-current="page" href="#">Dodawanie</a>
            </li>

          </ul>

          <ul class="navbar-nav mb-2 mb-lg-0">
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button"
                data-bs-toggle="dropdown" aria-expanded="false">
                Admin
              </a>
              <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                <li><a class="dropdown-item" href="#">Wyloguj</a></li>
              </ul>
            </li>
            <li class="nav-item">

            </li>
          </ul>




          <!-- <form class="d-flex">
            <select name="" id="" class="form-select">
              <option value="DE">Niemiecki</option>
              <option value="SP">Hiszpański</option>
            </select>
          </form> -->
        </div>
      </div>
    </nav>


  </div>

  <div class="container mt-4">
      <p><b>Przetłumacz:</b>{{currentQuestion.question}}</p>
      <p>Counter: {{currentQuestion.counter}} <span style="font-size:8px">id: {{currentQuestion.id}}</span></p>
      <label for="answer">Odpowiedź:</label>
      <form action @submit="answerm">
        <div class="mb-3">
          <input style="width:250px" class="form-control" id="answerinput" type="text" v-model="answer" placeholder="odpowiedź" :disabled="disabledInput" autocomplete="off"/>
        </div>
        <div class="mb-3">
          <button class="btn btn-primary" @click="answerm" id="answerbutton">answer</button>
        </div>

        <div class="mb-3">
          <button type="button" class="btn btn-success" name="button" @click="plusCounter(1)" >Counter +1</button>
          <button type="button" class="btn btn-success" name="button" @click="plusCounter(5)" >Counter +5</button>
          <button type="button" class="btn btn-success" name="button" @click="plusCounter0">Zresetuj</button>
        </div>

        <div class="mb-3">
          <button id="nextbutton" type="button" class="btn btn-success" @click="next">Dalej</button>
          <button id="prevbutton" type="button" class="btn btn-secondary" @click="prev">Prev</button>
          <button id="editbutton" type="button" class="btn btn-secondary" style="margin-left:20px" @click="editbool=!editbool">Edytuj</button>
          <button id="deletebutton" type="button" class="btn btn-danger" style="margin-left:20px" @click="deleteQuestion"
          >Usuń</button>
        </div>
      </form>

  </div>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/1.0.0-alpha.1/axios.min.js" integrity="sha512-xIPqqrfvUAc/Cspuj7Bq0UtHNo/5qkdyngx6Vwt+tmbvTLDszzXM0G6c91LXmGrRx8KEPulT+AfOOez+TeVylg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
  <script src="script.js"></script>

</body>

</html>