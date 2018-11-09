<?php
    require('db.php');
    session_start();
    $status[] = "";

    if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
        $username = $_SESSION['name'];

        if(isset($_GET["varname"]))
            $playlist = $_GET['varname'];
        else
        {
            header("Location:main.php");
            exit();
        }


        if(isset($_POST['new']) && $_POST['new']==1){
            $search = $_REQUEST['search'];
            $search_query="select * from Tracks where Track_Name like '%{$search}%'";
            $result = mysqli_query($con,$search_query);
            $status[] = "";
            if(mysqli_num_rows($result)!=0)
            {
                $count=0;
                while($row = mysqli_fetch_assoc($result))
                {
                    $status[$count] = $row["Track_Name"];
                    $count++;
                }
            }
            else
            {
                $status[0] = "Track not found";
            }
        }

        if(isset($_POST['newto']) && $_POST['newto']==1){
            $track = $_REQUEST['newval'];
            $sel_query="select * from Tracks where Track_Name = '$track'";
            $result = mysqli_query($con,$sel_query);
            $row = mysqli_fetch_assoc($result);
            $name = $row["Name"];
            $title = $row["Title"];
            $check_query="select count(*) as num from Playlist_Tracks where Name = '$name' and Track_Name = '$track' and PName = '$playlist' and Username = '$username'";
            $check = mysqli_query($con,$check_query);
            $row = mysqli_fetch_assoc($check);
            if($row["num"] == 0){
                $ins_query="insert into Playlist_Tracks values ('$name', '$title', '$track', '$username', '$playlist')";
                mysqli_query($con,$ins_query)
                or die('error');
                $message = "Track added";
                echo "<script type='text/javascript'>alert('$message');</script>";
            }
            else {
                $message = "Track already added";
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
        <link href="newlistcss.css" rel="stylesheet" />
        
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

    <div class="container-fluid search-container">
        <div class = "row">
            <div class = "col">
                
            <form name="form" method="post" action="">
                <input type="hidden" name="new" value="1" />
                <input type="text" name="search" placeholder="Search...">
            </form>
            </div>
        </div>
    </div>

    <div class="container-fluid">           
        <table class="table table-bordered">
            <thead>
            <tr>
                <th>Song name</th>
                <th></th>
            </tr>
            </thead>
            <tbody>
            <?php
                for($i=0; $i < count($status); $i++) { ?>
                <tr>    
                    <td><?php echo $status[$i]; ?></td>
                    <form name="form" method="post" action="">
                    <input type="hidden" name="newto" value="1" />
                    <input type="hidden" name="newval" value="<?php echo $status[$i]; ?>" />
                    <td><button type="submit" class="btn btn-primary">Add</button></td>
                    </form>
                </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
    </body>
</html>
