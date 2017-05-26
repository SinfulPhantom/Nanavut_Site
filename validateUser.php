<?php
    extract($_POST);

    $username = $_POST['username'];
    $query = "select * from registration where username = '$username'";
    $res = mysqli_query( $db, $query );

    if(mysqli_num_rows($res) == 0)
    {
        print('false');
    }
    else
        print('true');
?>
