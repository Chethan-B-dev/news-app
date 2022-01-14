<header>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
  <div class="container-fluid">
    <a class="navbar-brand" href="index.php">News-App</a>
    
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        


        <?php if(!isset($_SESSION['isLoggedIn'])): ?>

        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="login.php">Login</a>
        </li>

        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="register.php">Register</a>
        </li>

        <?php endif ?>

        <?php if(isset($_SESSION['isLoggedIn'])): ?>

          <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="likes.php">My Likes</a>
        </li>

        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="logout.php">logout</a>
        </li>

        <?php endif ?>


    </ul>
    </div>
  </div>
</nav>
</header>