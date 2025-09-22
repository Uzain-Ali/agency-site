<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

function getUserPermissions($user_id, $conn) {
    $perms = [];

    // Role-based permissions
    $sql = "SELECT p.name FROM permissions p
            JOIN role_permissions rp ON rp.permission_id = p.id
            JOIN user_roles ur ON ur.role_id = rp.role_id
            WHERE ur.user_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $res = $stmt->get_result();
    while ($row = $res->fetch_assoc()) {
        $perms[] = $row['name'];
    }
    $stmt->close();

    // User-specific permissions (optional)
    $sql = "SELECT p.name FROM permissions p
            JOIN user_permissions up ON up.permission_id = p.id
            WHERE up.user_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $res = $stmt->get_result();
    while ($row = $res->fetch_assoc()) {
        $perms[] = $row['name'];
    }
    $stmt->close();

    return array_unique($perms);
}
?>