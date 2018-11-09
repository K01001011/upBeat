<?php
    require('db.php');
    session_start();

    if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
        $username = $_SESSION['name'];
        if(isset($_GET["varname"]))
        {
            $artist_value = $_GET['varname'];
            $sel_query="select * from Artist where Name = '$artist_value'";
            $result = mysqli_query($con,$sel_query);
            $var = true;
        }
        else
        {
            $sel_query="select * from Artist where Band is NULL";
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

    <div class="container">
      <?php if($var) { ?>
      <h1 class="my-4">
        <?php echo $artist_value; ?>
      </h1>

      <?php $row = mysqli_fetch_assoc($result);
            $loc = $row["Picture"];
            $genre = $row["Genre"];?>
      <div class="row">
        <div class="col">
          <img class="img-fluid" src="img/<?php echo $loc; ?>" alt=""  height="750" width="500">
        </div>

        <div class="col">
          <h3 class="my-3">Genre</h3>
          <p><?php echo $genre; ?></p>
          <h3 class="my-3">Artists</h3>
          <?php 
            $sel_query1="select * from Artist where Band = '$artist_value'";
            $result1 = mysqli_query($con,$sel_query1);
            while($row1 = mysqli_fetch_assoc($result1)) { ?>
               <ul>
                    <li><?php echo $row1["Name"]; ?></li>
               </ul>
            <?php } ?>
        </div>

      </div>

      <br>
      <h3 class="my-4">Albums</h3>
      <?php $sel_query2="select * from Album where Name = '$artist_value'";
            $result2 = mysqli_query($con,$sel_query2);
            $count = 0;
            while($row2 = mysqli_fetch_assoc($result2)) { 
               $Aloc = $row2["Album_Pic"];
               $album_title = $row2["Title"];
               if($count%4 == 0) {?>
                <div class="row">
                <?php } ?>
                <div class="col">
                    <a href="album.php?varname=<?php echo $album_title; ?>">
                    <img class="img-fluid" src="img/<?php echo $Aloc; ?>" alt=""  height="500" width="300">
                    </a>
                </div>
                <?php $count++;
                if($count%4 == 0) {?>
                </div>
                <?php } ?>
            <?php } ?>
    </div>
    <?php } else {?>
    <div class="container">
      <h3 class="my-4">Artists</h3>
      <?php 
            $count = 0;
            while($row = mysqli_fetch_assoc($result)) { 
               $loc = $row["Picture"];
               $name = $row["Name"];
               if($count%4 == 0) {?>
                <div class="row">
                <?php } ?>
                <div class="col">
                    <a href="artist.php?varname=<?php echo $name; ?>">
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
