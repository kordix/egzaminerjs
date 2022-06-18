<nav class="navbar navbar-expand-lg navbar-light shadow-sm">
      <div class="container">
        <a class="navbar-brand" href="/">Egzaminer JS Bootstrap 5</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
          aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav me-auto mb-2 mb-lg-0">
            <li class="nav-item">
              <a class="nav-link" aria-current="page" href="/">Tester</a>
            </li>
            <!-- <li class="nav-item">
              <a class="nav-link" aria-current="page" href="/views/dodaj.php">Dodawanie</a>
            </li> -->
            <li class="nav-item">
              <a class="nav-link" aria-current="page" href="/views/todo.php">Todo</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" aria-current="page" href="/views/lista.php">Lista</a>
            </li>
          </ul>

          <ul class="navbar-nav mb-2 mb-lg-0">
            <li class="nav-item">
              <select class="form-select" id="languageinput" onchange="handleLanguageSelect(this)">
                <option value="SP">Hiszpański</option>
                <option value="DE">Niemiecki</option>
                <option value="RU">Rosyjski</option>

              </select>
            </li>

            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button"
                data-bs-toggle="dropdown" aria-expanded="false">
                Admin
              </a>
              <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                <li><a class="dropdown-item" href="#">Wyloguj</a></li>
              </ul>
            </li>
         
          </ul>
        </div>
      </div>
</nav>