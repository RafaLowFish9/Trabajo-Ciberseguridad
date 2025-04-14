<?php

    function conex(){
        $host = "localhost";
        $user = "root";
        $password = "";

        $bd = "eventosusc";
        $con = mysqli_connect($host, $user, $password);

        mysqli_select_db($con, $bd);

        return $con;
    };


?>