
<?php
// Start session
// session_start();
@include('koneksi.php');

// Check if the admin is logged in
if (!isset($_SESSION['username'])) {
    header('Location: login.php'); // Redirect to login page if not logged in
    exit;
}

$username = $_SESSION['username']; // User ID stored in session after login

// Handle profile image upload
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['foto'])) {
    $target_dir = "foto/";
    $target_file = $target_dir . basename($_FILES['foto']['name']);
    $upload_ok = 1;
    $image_file_type = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    // Check if the file is an actual image
    $check = getimagesize($_FILES['foto']['tmp_name']);
    if ($check !== false) {
        $upload_ok = 1;
    } else {
        echo "File is not an image.";
        $upload_ok = 0;
    }

    // Check file size
    if ($_FILES['foto']['size'] > 500000) { // Limit: 500KB
        echo "Sorry, your file is too large.";
        $upload_ok = 0;
    }

    // Allow certain file formats
    if ($image_file_type != "jpg" && $image_file_type != "png" && $image_file_type != "jpeg" && $image_file_type != "gif") {
        echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
        $upload_ok = 0;
    }

    // Check if $upload_ok is set to 0 by an error
    if ($upload_ok == 0) {
        echo "Sorry, your file was not uploaded.";
    } else {
        // Attempt to upload the file
        if (move_uploaded_file($_FILES['foto']['tmp_name'], $target_file)) {
            // Update the database with the new profile image
            $sql = "UPDATE user SET foto = '" . basename($_FILES['foto']['name']) . "' WHERE id = $admin_id";
            if ($conn->query($sql) === TRUE) {
                echo "The file " . htmlspecialchars(basename($_FILES['foto']['name'])) . " has been uploaded.";
                header('Location: profile.php'); // Refresh the page
                exit;
            } else {
                echo "Error updating profile image: " . $conn->error;
            }
        } else {
            echo "Sorry, there was an error uploading your file.";
        }
    }
}

// Close the connection
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gallery CRUD</title>
</head>
<body>
    <div class="card border-0 mb-5">
        <div class="card-body shadow">
            <form action="" method="POST" enctype="multipart/form-data">
            <div class="mb-3">
                <label for="password" class="form-label">Ganti Password</label>
                <input type="password" id="password" name="password" class="form-control" value="" placeholder="Tuliskan password baru jika ingin mengubah password saja">
            </div>
            <div class="mb-3">
                <label for="foto" class="form-label">Ganti Foto Profil</label>
                <input type="file" id="foto" name="foto" class="form-control">
            </div>
            <div class="mb-3">
                <label for="foto" class="form-label">Foto Profil Saat Ini</label>
                <img src="" alt="">
            </div>
            <button type="submit" class="btn btn-md btn-success">Simpan</button>
            </form>
        </div>
    </div>
</body>
</html>
