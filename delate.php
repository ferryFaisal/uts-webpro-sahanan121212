<?php
require 'connect.php';

$id = $_GET['id'];
$sql = "DELETE FROM products WHERE id = '$id'";

if ($conn->query($sql) === TRUE) {
    // echo "Record deleted successfully";
    header('location: read_data.php');
} else {
    echo "Error deleting record: " . $conn->error;
}

$conn->close();
?>