<?php
    require('db.php');
    session_start();

    if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
        $username = $_SESSION['name'];
        $sel_query="select * from Playlist where Username = '$username'";
        $result = mysqli_query($con,$sel_query);
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
        <link href="artist.css" rel="stylesheet" />
        
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

    <div class="container-fluid">
      <h3 class="my-4">Playlists</h3>
      <?php 
            $count = 0;
            while($row = mysqli_fetch_assoc($result)) { 
               $name = $row["PName"];
               if($count%4 == 0) {?>
                <div class="row">
                <?php } ?>
                <div class="col">
                    <a href="playview.php?varname=<?php echo $name; ?>">
                    <img class="img-fluid" src="img/playlist.jpg" alt=""  height="500" width="300">
                    </a>
                    <p><?php echo $name; ?></p>
                </div>
                <?php $count++;
                if($count%4 == 0) {?>
                </div>
                <?php } ?>
            <?php } ?>
    </div>

    </body>
</html>
