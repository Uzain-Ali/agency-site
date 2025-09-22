<?php
require_once("../includes/auth.php");
require_once("../includes/db.php");

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['id'])) {
    $id           = intval($_POST['id']);
    $title        = $conn->real_escape_string($_POST['title']);
    $slug         = $conn->real_escape_string($_POST['slug']);
    $description  = $conn->real_escape_string($_POST['description']);
    $price_basic  = floatval($_POST['price_basic']);
    $price_premium= floatval($_POST['price_premium']);

    // Handle image upload
    $image = null;
    if (!empty($_FILES['image']['name'])) {
        $target_dir = "../public/assets/services/";
        $image = uniqid() . "_" . basename($_FILES["image"]["name"]);
        $target_file = $target_dir . $image;
        move_uploaded_file($_FILES["image"]["tmp_name"], $target_file);

        // Update with new image
        $stmt = $conn->prepare("UPDATE services SET title=?, slug=?, description=?, price_basic=?, price_premium=?, image=? WHERE id=?");
        $stmt->bind_param("sssddsi", $title, $slug, $description, $price_basic, $price_premium, $image, $id);
    } else {
        // Update without changing image
        $stmt = $conn->prepare("UPDATE services SET title=?, slug=?, description=?, price_basic=?, price_premium=? WHERE id=?");
        $stmt->bind_param("sssddi", $title, $slug, $description, $price_basic, $price_premium, $id);
    }
    $stmt->execute();
    $stmt->close();

    header("Location: ../admin/services.php?updated=1");
    exit;
}
?>