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

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

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
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button"
                data-bs-toggle="dropdown" aria-expanded="false">
                Dropdown link
              </a>
              <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                <li><a class="dropdown-item" href="#">Action</a></li>
                <li><a class="dropdown-item" href="#">Another action</a></li>
                <li><a class="dropdown-item" href="#">Something else here</a></li>
              </ul>
            </li>
          </ul>



          <form class="d-flex">
            <select name="" id="" class="form-select">
              <option value="DE">Niemiecki</option>
              <option value="SP">Hiszpański</option>
            </select>
          </form>
        </div>
      </div>
    </nav>


  </div>

  <div class="container">
    <br>
    <p><b>Przetłumacz: {{słowo}}</b></p>
    <p>Counter: {{counter}} </p>

  </div>

  <script src="script.js"></script>

</body>

</html>