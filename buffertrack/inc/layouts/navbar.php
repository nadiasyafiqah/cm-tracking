<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <a class="navbar-brand" href="#">CM Inventory</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item">
        <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item dropdown">
      <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
      Transactions
      </a>
      <div class="dropdown-menu" aria-labelledby="navbarDropdown">
        <a class="dropdown-item" href="transactions.php?action=checkin">Asset Check-in</a>
        <a class="dropdown-item" href="transactions.php?action=checkout">Asset Check-out</a>
        <a class="dropdown-item" href="transactions.php?action=transfer">Asset Transfer</a>
        <a class="dropdown-item" href="transactions.php">View Transactions</a>
      </div>
      </li>
      <li class="nav-item dropdown">
      <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
      Assets
      </a>
      <div class="dropdown-menu" aria-labelledby="navbarDropdown">
        <a class="dropdown-item" href="assets.php">View Asset</a>
        <a class="dropdown-item" href="assets.php?action=add">Add Asset</a>
      </div>
      </li>
      <li class="nav-item dropdown">
      <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
      Locations
      </a>
      <div class="dropdown-menu" aria-labelledby="navbarDropdown">
        <a class="dropdown-item" href="locations.php">View Locations</a>
        <a class="dropdown-item" href="locations.php?action=add">Add Locations</a>
      </div>
      </li>
      <li class="nav-item dropdown">
      <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
      Reports
      </a>
      <div class="dropdown-menu" aria-labelledby="navbarDropdown">
        <a class="dropdown-item" href="locations.php">Qty per Location</a>
      </div>
      </li>
    </ul>
    <div>
      <form class="form-inline" action="search.php" method="post">
        <div class="form-group">
          <label for="search"></label>
          <input type="text" name="search" id="" class="form-control" placeholder="Search Serial" aria-describedby="helpId">
        </div>
      </form>
    </div>
  </div>
</nav>