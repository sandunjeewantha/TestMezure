<?php
    function connect(){
        $conn=mysqli_connect('localhost','root','','testmezure');
        if(!$conn){
            die("Connection failed".mysqli_connect_error());
        }
        return $conn;
    }

function disconnect($conn){
    mysqli_close($conn);
}

function get_data($sql){
    $conn=connect();
    $result=mysqli_query($conn,$sql); 
    return $result;
    disconnect($conn);
}

function set_data($sql){
    $conn=connect();
    if (mysqli_query($conn, $sql)) {
        return true;
    } else {
        echo "<div class='alert alert-danger'>Error Please try again.".mysqli_error($conn)."</div>";
        return false;
    }
    disconnect($conn);
}

?>