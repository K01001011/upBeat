<?php
    require('db.php');
?>

<!DOCTYPE html>
<html>
    <head>
        <title>View Records</title>
        <link rel="stylesheet" href="css/style.css" />
    </head>
    <body>
        <div class="form">
            <p><a href="test.php">Back</a> </p>
            <h2>View Records</h2>
            <table width="100%" border="1" style="border-collapse:collapse;">
            <thead>
                <tr>
                <th><strong>USN</strong></th>
                <th><strong>Name</strong></th>
                <th><strong>Age</strong></th>
                </tr>
                </thead>
            <tbody>
            <?php
                $sel_query="Select * from test;";
                $result = mysqli_query($con,$sel_query);
                while($row = mysqli_fetch_assoc($result)) { ?>
                    <tr><td align="center"><?php echo $row["USN"]; ?></td>
                    <td align="center"><?php echo $row["Name"]; ?></td>
                    <td align="center"><?php echo $row["Age"]; ?></td>
                    </tr>
                <?php } ?>
            </tbody>
            </table>
        </div>
    </body>
</html>