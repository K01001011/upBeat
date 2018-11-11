<?php
    require('db.php');
    session_start();
    $status = "";
    $status1 = "";
    $status2 = "";

    if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
        $username = $_SESSION['name'];

        if(isset($_POST['new']) && $_POST['new']==1 && isset($_POST['artist'])){
            $name = $_REQUEST['Name'];
            $pic = $_REQUEST['Picture'];
            $band = $_REQUEST['Band'];
            $genre = $_REQUEST['Genre'];
            if(empty($band))
                $band = null;
            $status = $band;
            $search_query="select count(*) as num from Artist where Name='$name'";
            $result = mysqli_query($con,$search_query)
            or die(mysqli_error($con));
            $row = mysqli_fetch_assoc($result);
            if($row["num"] == 0)
            {
                if($band === null)
                    $ins_query="insert into Artist (Name, Picture, Genre) values ('$name', '$pic', '$genre')";
                else
                    $ins_query="insert into Artist values ('$name', '$pic', '$band', '$genre')";
                mysqli_query($con,$ins_query)
                or die(mysqli_error($con));
                $status = "Added";
            }
            else
                $status = "Artist already exists";
        }
        if(isset($_POST['new']) && $_POST['new']==1 && isset($_POST['album'])){
            $Title = $_REQUEST['Title'];
            $Album_Pic = $_REQUEST['Album_Pic'];
            $Name = $_REQUEST['Name'];
            //$search_query="select count(*) as num from Album where USERNAME='$user'";
            //$result = mysqli_query($con,$search_query)
            //or die(mysqli_error($con));
            //$row = mysqli_fetch_assoc($result);
            //if($row["num"] == 0)
            //{
                
                $ins_query="insert into Album values ('$Title', '$Album_Pic', 0, '$Name')";
                mysqli_query($con,$ins_query)
                or die(mysqli_error($con));
                $status1 = "Added";
            //}
            //else
            //    $status1 = "FAIL";
        }
        if(isset($_POST['new']) && $_POST['new']==1 && isset($_POST['track'])){
            $Track_Name = $_REQUEST['Track_Name'];
            $Youtube_Link = $_REQUEST['Youtube_Link'];
            $Name = $_REQUEST['Name'];
            $Title = $_REQUEST['Title'];
            //$search_query="select count(*) as num from Users where USERNAME='$user'";
            //$result = mysqli_query($con,$search_query)
            //or die(mysqli_error($con));
            //$row = mysqli_fetch_assoc($result);
            //if($row["num"] == 0)
            //{
                
                $ins_query="insert into Tracks values ('$Track_Name', null, '$Youtube_Link', '$Name', '$Title')";
                mysqli_query($con,$ins_query)
                or die(mysqli_error($con));
                $status2 = "Added";
            //}
            //else
            //    $status2 = "FAIL";
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

    <div id = "home">
        <div class = "row">
            <div class = "col" align="center">
                    <form name="form" method="post" action=""> 
                        <input type="hidden" name="new" value="1" />
                        <p><input type="text" name="Name" placeholder="Name" required /></p>
                        <p><input type="text" name="Picture" placeholder="Picture" required /></p>
                        <p><input type="text" name="Band" placeholder="Band" /></p>
                        <p><input type="text" name="Genre" placeholder="Genre" required /></p>
                        <br>
                        <button  name="artist" type="submit" class="btn btn-primary">Add</button>
                    </form>
                    <p style="color:#FF0000;"><?php echo $status; ?></p>
            </div>
            <div class = "col" align="center">
                    <form name="form" method="post" action=""> 
                        <input type="hidden" name="new" value="1" />
                        <p><input type="text" name="Title" placeholder="Title" required /></p>
                        <p><input type="text" name="Album_Pic" placeholder="Album_Pic" required /></p>
                        <p><input type="text" name="Name" placeholder="Name" required /></p>
                        <br>
                        <button  name="album" type="submit" class="btn btn-primary">Add</button>
                    </form>
                    <p style="color:#FF0000;"><?php echo $status1; ?></p>
            </div>
            <div class = "col" align="center">
                    <form name="form" method="post" action=""> 
                        <input type="hidden" name="new" value="1" />
                        <p><input type="text" name="Track_Name" placeholder="Track_Name" required /></p>
                        <p><input type="text" name="Youtube_Link" placeholder="Youtube_Link" required /></p>
                        <p><input type="text" name="Name" placeholder="Name" required /></p>
                        <p><input type="text" name="Title" placeholder="Title" required /></p>
                        <br>
                        <button  name="track" type="submit" class="btn btn-primary">Add</button>
                    </form>
                    <p style="color:#FF0000;"><?php echo $status2; ?></p>
            </div>
        </div>
    </div>

    </body>
</html>