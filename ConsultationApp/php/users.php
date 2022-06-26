<?php
    session_start();
    include_once "config.php";
    $outgoing_id = $_SESSION['unique_id'];

    $sql1 = "SELECT Role FROM users WHERE unique_id = {$outgoing_id} ";
    $query1 = mysqli_query($conn, $sql1);

    $item = mysqli_fetch_array($query1, MYSQLI_ASSOC);
    // printf ("%s\n", $item['Role']);

    if(isset($outgoing_id) && $item['Role'] =='docter'){
        $sql = "SELECT * FROM users WHERE Role='patient' and NOT unique_id = {$outgoing_id} ORDER BY user_id DESC";
    }
    else{
        $sql = "SELECT * FROM users WHERE Role='docter' and NOT unique_id = {$outgoing_id} ORDER BY user_id DESC";
    }
    $query = mysqli_query($conn, $sql);
    $output = "";
    if(mysqli_num_rows($query) == 0){
        $output .= "No users are available to chat";
    }elseif(mysqli_num_rows($query) > 0){
        include_once "data.php";
    }
    echo $output;
?>