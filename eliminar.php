<?php
require 'conexion.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id_clase'])) {
    $id_clase = (int) $_POST['id_clase'];

    $delete_query = "DELETE FROM clase WHERE id_clase = $id_clase";

    if ($mysqli->query($delete_query)) {
        header("Location: adminIndex.php?mensaje=success");
    } else {
        header("Location: adminIndex.php?mensaje=error");
    }
} else {
    header("Location: adminIndex.php");
}

$mysqli->close();
?>
