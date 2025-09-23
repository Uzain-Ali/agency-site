<?php
require_once("../includes/auth.php");
require_once("../includes/db.php");

if (isset($_GET['id'])) {
    $id = intval($_GET['id']);
    $stmt = $conn->prepare("DELETE FROM testimonials WHERE id=?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $stmt->close();
}

header("Location: ../admin/testimonials.php?deleted=1");
exit;
?>