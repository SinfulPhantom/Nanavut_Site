<?php
    $db = openDB();

    extract($_POST);

    $username = $_POST['username'];
    $password = $_POST['password'];

    $query = "select * from registration where username = '$username' and password = aes_encrypt('$password', 'key')";

    $res = mysqli_query( $db, $query );

    if(mysqli_num_rows($res) == 0)
    {
        print('false');
    }
    else
        print('true');
?>
