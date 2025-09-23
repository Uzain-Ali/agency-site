<?php
// filepath: c:\xampp\htdocs\agency-site\admin\user_delete.php
require_once("../includes/auth.php");
require_once("../includes/db.php");

if (isset($_GET['id'])) {
    $id = intval($_GET['id']);
    $stmt = $conn->prepare("DELETE FROM users WHERE id=?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $stmt->close();
}

header("Location: ../admin/users.php?deleted=1");
exit;
?>