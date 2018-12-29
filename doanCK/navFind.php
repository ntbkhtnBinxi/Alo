<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <a class="navbar-brand" href="index.php">Home</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
        <li class="nav-item">
          <a class="nav-link" href="info.php">Cá nhân</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="Find.php">Tìm kiếm</a>
        </li>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="Dangxuat.php">Đăng xuất</a>
      </li>
    </ul>
      <form class="form-inline my-2 my-lg-0" action="Find.php" method="POST">
        <input class="form-control mr-sm-2" type="search" name = "keyFindPost" placeholder="Search" aria-label="Search">
        <button class="btn btn-outline-success my-2 my-sm-0" name= "findPost" type="submit">Search</button>
      </form>
    </div>
  </nav>