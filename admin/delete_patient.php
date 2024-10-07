<?php
require_once 'logincheck.php';
$conn = new mysqli("localhost", "root", "", "hcpms") or die(mysqli_error());

// Check if the delete request is made
if (isset($_GET['id'])) {
    $itr_no = $_GET['id'];

    // Prepare the delete statement to avoid SQL injection
    $stmt = $conn->prepare("DELETE FROM itr WHERE itr_no = ?");
    $stmt->bind_param("i", $itr_no); // "i" indicates the type is integer

    // Execute the statement and check for success
    if ($stmt->execute()) {
        echo "<script>alert('Patient deleted successfully!');</script>";
    } else {
        echo "<script>alert('Error deleting patient. Please try again.');</script>";
    }

    $stmt->close();
    echo "<script>window.location.href='patient.php';</script>"; // Redirect back to patient page
} else {
    // Redirect back to the patient page if accessed directly
    header("Location: patient.php");
    exit();
}
