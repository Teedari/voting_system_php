<nav class="navbar navbar-expand-lg navbar-white bg-white shadow">
  <a class="navbar-brand" href="../home.php">
    <img src="./images/logo/logo2.png" />
  </a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse " id="navbarNav">
    <ul class="navbar-nav ml-auto">
      <li class="nav-item">
        <a class="nav-link active" href="index.php">Home<span class="sr-only">(current)</span></a>
      </li>
      <?php echo isset($_SESSION['activate']) && $_SESSION['activate'] ? 
      '<li class="nav-item">
        <a class="nav-link" href="result.php">Result</a>
      </li>'
      : '' ; 
      ?>
      <li class="nav-item">
        <a class="nav-link" href="./admin/includes/logout.php">Logout</a>
      </li>
    </ul>
  </div>
</nav>
  <section class="bg-secondary p-2">
    <h3 class="display-5 text-white"></h3>
  </section>