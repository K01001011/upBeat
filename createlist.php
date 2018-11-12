<?php
    require('db.php');
    session_start();
    $status = "";

    if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
        $username = $_SESSION['name'];

        if(isset($_POST['new']) && $_POST['new']==1){
            $input = $_REQUEST['pname'];
            $sel_query="select count(*) as num from Playlist where PName = '$input' and Username = '$username'";
            $check = mysqli_query($con,$sel_query);
            $row = mysqli_fetch_assoc($check);
            if($row["num"] == 0) {
                $ins_query="insert into Playlist values ('$input', '$username')";
                mysqli_query($con,$ins_query)
                or die('error');
                $status = "Created";
            }
            else {
                $message = "Playlist already exists";
                echo "<script type='text/javascript'>alert('$message');</script>";
            }
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
        <meta name="viewport" content="width=device-width, initial-scale=1">
       
        <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
        <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script> -->
        <!-- Bootstrap core JavaScript -->
        <script src="vendor/jquery/jquery.min.js"></script>
        <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
        <!-- <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script> -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <link href="new.css" rel="stylesheet" />
        
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

    <div class="container-fluid  form-container">
        <form name="form" method="post" action="">
            <input type="hidden" name="new" value="1" />
            <input type="text" name="pname" placeholder="Playlist name">
            <input name="submit" type="submit" value="Create" />
        </form>
        <p style="color:#FF0000;"><?php echo $status; ?></p>
    </div>

    </body>
</html>