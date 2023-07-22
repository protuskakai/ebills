<?php
$conexion = new PDO("informix:host=192.168.1.16; service=1543;
    database=water; server=ids_wan_remote; protocol=onsoctcp;
    EnableScrollableCursors=1", "pkakai", "abc123");
    $sql    = "SELECT * FROM test";
    $prep   = $conexion->prepare($sql);
    $prep->execute();
    $result = $prep->fetchAll(PDO::FETCH_ASSOC);
    var_dump($result);
?>