<?php
require_once("../includes/auth.php");
require_once("../includes/db.php");

if (isset($_GET['id'])) {
    $id = intval($_GET['id']);
    // Optionally, delete the image file from disk here if you want

    $stmt = $conn->prepare("DELETE FROM services WHERE id=?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $stmt->close();
}

header("Location: ../admin/services.php?deleted=1");
exit;
?>