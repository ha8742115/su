<?php
$su_server = new mysqli($_SERVER["HTTP_HOST"], "root", "");
$sud = mysqli_select_db($su_server, "sud");
if (!$sud) {
    mysqli_query($su_server, "CREATE DATABASE sud");
    $sud = mysqli_connect($_SERVER["HTTP_HOST"], "root", "", "sud");
    mysqli_query($sud, "CREATE TABLE sut (u VARCHAR(30) NOT NULL, s VARCHAR(30) NOT NULL, d VARCHAR(30) NOT NULL)");
} else {
    $sud = mysqli_connect($_SERVER["HTTP_HOST"], "root", "", "sud");
    if (isset($_GET["nsu"])) {
        $s = "";
        $c = "AHIjklmnoBCDEvwzyz01u89!@234567JKLMNOP%^&QRSTpqrst#*(UVWXYZabcdefghiFG)";
        for ($i = 0; $i < 6; $i++) {
            $s = $s . $c[rand(0,71)];
        }
        mysqli_query($sud, "INSERT INTO sut (u,s,d) VALUES ('" . $_GET['nsu'] . "','" . $s . "','0')");
        header('location:?gsu='.$_GET["nsu"]);
    }
    if (isset($_GET["osu"])){
        $fu = mysqli_query($sud,"SELECT * FROM sut WHERE s = '".$_GET["osu"]."'");
        while ($u = mysqli_fetch_assoc($fu)){
            $uu = $u['u'];
        }
        $fd = mysqli_query($sud,"SELECT * FROM sut WHERE s = '".$_GET["osu"]."'");
        while ($d = mysqli_fetch_assoc($fd)){
            $dd = $d['d'];
        }
        mysqli_query($sud, "UPDATE sut SET d = '".($dd + 1)."' WHERE s = '".$_GET["osu"]."'");
        header('location:'.$uu);
    }
    if (isset($_GET['gsu'])){
        $fs = mysqli_query($sud,"SELECT * FROM sut WHERE u = '".$_GET["gsu"]."'");
        while ($s = mysqli_fetch_assoc($fs)){
            $ss = $s['s'];
        }
        header('location:?su='.$ss);
    }
}
?>
