<?php
    require('db.php');
    session_start();

    if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
        $username = $_SESSION['name'];
    } else {
        header("Location:test.php");
        exit();
    }
?>  

<!DOCTYPE html>
<html>
    <head>
        <title>DBMS</title>

        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
       
        <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
        <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script> -->
        <!-- Bootstrap core JavaScript -->
        <script src="vendor/jquery/jquery.min.js"></script>
        <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
        <!-- <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script> -->
        <link href="style.css" rel="stylesheet" />
        
    </head>
    <body>

    <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
      <div class="container">
        <a class="navbar-brand" href="">Welcome, <?php echo $username; ?></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
          <ul class="navbar-nav ml-auto">
            <li class="nav-item active">
              <a class="nav-link" href="main.php">Home
                <span class="sr-only">(current)</span>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="logout.php">Logout</a>
            </li>
          </ul>
        </div>
      </div>
    </nav>
    <!-- carouselExampleIndicators -->
    <header>
      <div id="myCarousel" class="carousel slide" data-ride="carousel">
        <ol class="carousel-indicators">
          <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
          <li data-target="#myCarousel" data-slide-to="1"></li>
          <li data-target="#myCarousel" data-slide-to="2"></li>
        </ol>
        <div class="carousel-inner" role="listbox">
          <div class="carousel-item active">
          <img src="img/imaginedragons.png" class="img-responsive" alt="">
            <div class="carousel-caption d-none d-md-block">
              <h3>Imagine Dragons</h3>
              <p>I'm on top of the world.</p>
            </div>
          </div>
          <div class="carousel-item">
          <img src="img/queenbg.jpg" class="img-responsive" alt="">
            <div class="carousel-caption d-none d-md-block">
              <h3>Queen</h3>
              <p>Another one bites the dust.</p>
            </div>
          </div>
          <div class="carousel-item">
          <img src="img/linkinpark.jpg" class="img-responsive" alt="">
            <div class="carousel-caption d-none d-md-block">
              <h3>Linkin Park</h3>
              <p>In the end.</p>
            </div>
          </div>
        </div>
        <a class="carousel-control-prev" href="#myCarousel" role="button" data-slide="prev">
          <span class="carousel-control-prev-icon" aria-hidden="true"></span>
          <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#myCarousel" role="button" data-slide="next">
          <span class="carousel-control-next-icon" aria-hidden="true"></span>
          <span class="sr-only">Next</span>
        </a>
      </div>
    </header>

    <section class="py-5">
      <div class="container">
      <a href = "artist.php">
      <h4>Artists</h4>
      </a>
      <p></p>
        <!-- <div class="col-sm-6 col-md-6"> -->
            <div class="row">
                <?php
                  $sel_query="select * from Artist where Band is NULL;";
                  $result = mysqli_query($con,$sel_query);?>
                <div class="col" align="center">
                  <?php $row = mysqli_fetch_assoc($result);
                  $loc = $row["Picture"];
                  $name = $row["Name"];?>
                  <a href = "artist.php?varname=<?php echo $name; ?>">
                  <img src="img/<?php echo $loc; ?>" class="img-responsive" alt="" height="200" width="200">
                  </a>
                </div>
                <div class="col" align="center">
                  <?php $row = mysqli_fetch_assoc($result);
                  $loc = $row["Picture"];
                  $name = $row["Name"];?>
                  <a href = "artist.php?varname=<?php echo $name; ?>">
                  <img src="img/<?php echo $loc; ?>" class="img-responsive" alt="" height="200" width="200">
                  </a>
                </div>
                <div class="col" align="center">
                  <?php $row = mysqli_fetch_assoc($result);
                  $loc = $row["Picture"];
                  $name = $row["Name"];?>
                  <a href = "artist.php?varname=<?php echo $name; ?>">
                  <img src="img/<?php echo $loc; ?>" class="img-responsive" alt="" height="200" width="200">
                  </a>
                </div>
                <div class="col" align="center">
                  <?php $row = mysqli_fetch_assoc($result);
                  $loc = $row["Picture"];
                  $name = $row["Name"];?>
                  <a href = "artist.php?varname=<?php echo $name; ?>">
                  <img src="img/<?php echo $loc; ?>" class="img-responsive" alt="" height="200" width="200">
                  </a>
                </div>
            </div>
        </div>
      <!-- </div> -->
    </section>

    <section class="py-5">
      <div class="container">
      <a href = "album.php">
      <h4>Albums</h4>
      </a>
      <p></p>
        <!-- <div class="col-sm-4 col-md-4"> -->
            <div class="row">
                <?php
                  $sel_query="select * from Album;";
                  $result = mysqli_query($con,$sel_query);?>
                <div class="col" align="center">
                  <?php $row = mysqli_fetch_assoc($result);
                  $Aloc = $row["Album_Pic"];
                  $Atitle = $row["Title"];
                  $Aname = $row["Name"];?>
                  <a href = "album.php?varname=<?php echo $Atitle; ?>">
                  <img src="img/<?php echo $Aloc; ?>" class="img-responsive" alt="" height="200" width="200">
                  </a>
                </div>
                <div class="col" align="center">
                  <?php $row = mysqli_fetch_assoc($result);
                  $Aloc = $row["Album_Pic"];
                  $Atitle = $row["Title"];
                  $Aname = $row["Name"];?>
                  <a href = "album.php?varname=<?php echo $Atitle; ?>">
                  <img src="img/<?php echo $Aloc; ?>" class="img-responsive" alt="" height="200" width="200">
                  </a>
                </div>
                <div class="col" align="center">
                  <?php $row = mysqli_fetch_assoc($result);
                  $Aloc = $row["Album_Pic"];
                  $Atitle = $row["Title"];
                  $Aname = $row["Name"];?>
                  <a href = "album.php?varname=<?php echo $Atitle; ?>">
                  <img src="img/<?php echo $Aloc; ?>" class="img-responsive" alt="" height="200" width="200">
                  </a>
                </div>
                <div class="col" align="center">
                  <?php $row = mysqli_fetch_assoc($result);
                  $Aloc = $row["Album_Pic"];
                  $Atitle = $row["Title"];
                  $Aname = $row["Name"];?>
                  <a href = "album.php?varname=<?php echo $Atitle; ?>">
                  <img src="img/<?php echo $Aloc; ?>" class="img-responsive" alt="" height="200" width="200">
                  </a>
                </div>
            </div>
        <!-- </div> -->
      </div>
    </section>

    <section class="py-5">
      <div class="container">
      <a href = "playlist.php">
      <h4>Playlist</h4>
      </a>
      <p></p>
        <!-- <div class="col-sm-4 col-md-4"> -->
            <div class="row">
                <?php
                  $sel_query="select count(*) as num from Playlist where Username = '$username'";
                  $result = mysqli_query($con,$sel_query);
                  $row = mysqli_fetch_assoc($result);
                  $count = $row["num"]; 
                  if($row["num"] == 0)
                  {
                    echo "No Playlists Found";
                    echo "";
                  } else { 
                    $sel_query="select * from Playlist where Username = '$username'";
                    $result = mysqli_query($con,$sel_query);
                    ?>
                <div class="col" align="center">
                  <?php
                    $count--;
                    $row = mysqli_fetch_assoc($result);
                    $Pname = $row["PName"];?>
                    <a href = "playview.php?varname=<?php echo $Pname; ?>">
                    <img src="img/playlist.jpg" class="img-responsive" alt="" height="200" width="200">
                    </a>
                    <p></p>
                    <p><b><?php echo $Pname; ?></b></p>
                </div>
                <div class="col" align="center">
                  <?php
                    if($count!=0) { 
                      $count--;   
                    $row = mysqli_fetch_assoc($result);
                    $Pname = $row["PName"];?>
                    <a href = "playview.php?varname=<?php echo $Pname; ?>">
                    <img src="img/playlist.jpg" class="img-responsive" alt="" height="200" width="200">
                    </a>
                    <p></p>
                    <p><?php echo $Pname; ?></p>
                    <?php } ?>
                </div>
                <div class="col" align="center">
                  <?php
                    if($count!=0) { 
                    $row = mysqli_fetch_assoc($result);
                    $Pname = $row["PName"];?>
                    <a href = "playview.php?varname=<?php echo $Pname; ?>">
                    <img src="img/playlist.jpg" class="img-responsive" alt="" height="200" width="200">
                    </a>
                    <p></p>
                    <p><?php echo $Pname; ?></p>
                    <?php } ?>
                </div>
                <?php } ?>
                <div class="col" align="center">
                  <?php
                    //$row = mysqli_fetch_assoc($result);
                    //$Pname = $row["PName"];?>
                    <a href = "createlist.php">
                    <p>Create playlist</p>
                    <!-- <img src="img/playlist.jpg" class="img-responsive" alt="" height="200" width="200"> -->
                    </a>
                    
                </div>
            </div>
        <!-- </div> -->
      </div>
    </section>


    </body>
</html>