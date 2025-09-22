<?php
require_once("../includes/auth.php");
require_once("../includes/db.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
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
    }

    $stmt = $conn->prepare("INSERT INTO services (title, slug, description, price_basic, price_premium, image) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("sssdds", $title, $slug, $description, $price_basic, $price_premium, $image);
    $stmt->execute();
    $stmt->close();

    header("Location: ../admin/services.php?success=1");
    exit;
}
?>