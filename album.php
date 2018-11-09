<?php
    require('db.php');
    session_start();

    if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
        $username = $_SESSION['name'];
        if(isset($_GET["varname"]))
        {
            $album_value = $_GET['varname'];
            $sel_query="select * from Album where Title = '$album_value'";
            $result = mysqli_query($con,$sel_query);
            $var = true;
        }
        else
        {
            $sel_query="select * from Album";
            $result = mysqli_query($con,$sel_query);
            $var = false;
        }
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
              <a class="nav-link" href="">Home
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

    <div class="container">
      <?php if($var) { ?>
      <h1 class="my-4">
        <?php echo $album_value; ?>
      </h1>

      <?php $row = mysqli_fetch_assoc($result);
            $loc = $row["Album_Pic"];
            $noof = $row["No_of_Tracks"];
            $artist = $row["Name"]; ?>
      <div class="row">
        <div class="col">
          <img class="img-fluid" src="img/<?php echo $loc; ?>" alt=""  height="750" width="500">
        </div>

        <div class="col">
          <h3 class="my-3">Artist</h3>
          <p><?php echo $artist; ?></p>
          <h3 class="my-3">Number of Tracks</h3>
          <p><?php echo $noof; ?></p>
        </div>

      </div>

      <br>
      <h3 class="my-4">Tracks</h3>
      <?php $sel_query2="select * from Tracks where Title = '$album_value' && Name = '$artist'";
            $result2 = mysqli_query($con,$sel_query2); ?>
            <table class="table table-bordered">
            <thead>
            <tr>
                <th>Song</th>
                <th></th>
            </tr>
            </thead>
            <tbody>
            <?php
            while($row2 = mysqli_fetch_assoc($result2)) { 
               $Tloc = $row2["Youtube_Link"];
               $track_title = $row2["Track_Name"]; ?>
                <tr>   
                    <td>
                    <h4 class="my-4"><?php echo $track_title ?></h4>
                    </td>
                    <form name="form" method="post" action="play.php?varname=<?php echo $Tloc; ?>">
                    <input type="hidden" name="newto" value="1" />
                    <input type="hidden" name="newval1" value="<?php echo $Tloc; ?>" />
                    <td><button type="submit" class="btn btn-primary">Play</button></td>
                    </form>
                </tr>
            <?php } ?>
    </div>
    <?php } else {?>
    <div class="container">
      <h3 class="my-4">Artists</h3>
      <?php 
            $count = 0;
            while($row = mysqli_fetch_assoc($result)) { 
               $loc = $row["Album_Pic"];
               $name = $row["Title"];
               if($count%4 == 0) {?>
                <div class="row">
                <?php } ?>
                <div class="col">
                    <a href="album.php?varname=<?php echo $name; ?>">
                    <img class="img-fluid" src="img/<?php echo $loc; ?>" alt=""  height="500" width="300">
                    </a>
                </div>
                <?php $count++;
                if($count%4 == 0) {?>
                </div>
                <?php } ?>
            <?php } ?>
    </div>
    <?php } ?>

    </body>
</html>