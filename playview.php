<?php
    require('db.php');
    session_start();
    $status[] = "";
    $somename[] = "";

    if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
        $username = $_SESSION['name'];

        if(isset($_GET["varname"])) {
            $playlist = $_GET['varname'];
            $status[] = "";
            $somename[] = "";
            $sel_query="select count(*) as num from Playlist_Tracks where PName = '$playlist' and Username = '$username'";
            $result = mysqli_query($con,$sel_query);
            $row = mysqli_fetch_assoc($result);
            if($row["num"] != 0)
            {
                $sel_query="select * from Playlist_Tracks where PName = '$playlist' and Username = '$username'";
                $result = mysqli_query($con,$sel_query);
                $count=0;
                while($row = mysqli_fetch_assoc($result))
                {
                    $status[$count] = $row["Track_Name"];
                    $temp = $row["Name"];
                    $get_query="select * from Tracks where Track_Name = '$status[$count]' and Name = '$temp'";
                    $result1 = mysqli_query($con,$get_query);
                    $row1 = mysqli_fetch_assoc($result1);
                    $somename[$count] = $row1["Youtube_Link"];
                    $message = "'$somename[$count]'";
                    echo "<script type='text/javascript'>alert('$message');</script>";
                    $count++;
                }
            }

            if(isset($_POST['newto']) && $_POST['newto']==1){
                $track = $_REQUEST['newval'];
                $track_link = $_REQUEST['newval1'];
                $sel_query="select * from Tracks where Youtube_Link = '$track_link'";
                $result = mysqli_query($con,$sel_query);
                $row = mysqli_fetch_assoc($result);
                $track = $row["Track_Name"];
                $check_query="select count(*) as num from Playlist_Tracks where Track_Name = '$track' and PName = '$playlist' and Username = '$username'";
                $check = mysqli_query($con,$check_query);
                $row = mysqli_fetch_assoc($check);
                if($row["num"] != 0){
                    $del_query="delete from Playlist_Tracks where Track_Name = '$track' and PName = '$playlist' and Username = '$username'";
                    mysqli_query($con,$del_query)
                    or die('error');
                    $message = "Track removed";
                    echo "<script type='text/javascript'>alert('$message');</script>";
                }
                else {
                    $message = "Track already removed";
                    echo "<script type='text/javascript'>alert('$message');</script>";
                }
            }
            
        }
        else
        {
            header("Location:main.php");
            exit();
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
                
            <form name="form" method="post" action="newlist.php?varname=<?php echo $playlist; ?>">
                <input type="hidden" name="new" value="1" />
                <input type="submit" value="Add" name="Add" placeholder="Add">
                <br>
            </form>
            </div>
        </div>
    </div>

    <div class="container-fluid">           
        <table class="table table-bordered">
            <thead>
            <tr>
                <th>Song</th>
                <th></th>
            </tr>
            </thead>
            <tbody>
            <?php
                if(mysqli_num_rows($result)!=0) {
                for($i=0; $i < count($status); $i++) { ?>
                <tr>   
                    <td>
                    <a href = "play.php?varname=<?php echo $somename[$i]; ?>">
                    <?php echo $status[$i]; ?>
                    </a>
                    </td>
                    <form name="form" method="post" action="">
                    <input type="hidden" name="newto" value="1" />
                    <input type="hidden" name="newval" value="<?php echo $status[$i]; ?>" />
                    <input type="hidden" name="newval1" value="<?php echo $somename[$i]; ?>" />
                    <td><button type="submit" class="btn btn-primary">Remove</button></td>
                    </form>
                </tr>
                <?php } } ?>
            </tbody>
        </table>
    </div>
    </body>
</html>