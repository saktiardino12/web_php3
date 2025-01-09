    <link rel="icon" href="fiks.jpeg"/>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/2.2.0/css/dataTables.bootstrap5.css"> -->
<?php

@include('koneksi.php');


// Handle form submissions
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['add'])) {
        // Add a new gallery entry
        $tanggal = $_POST['tanggal'];
        $gambar = $_FILES['gambar']['name'];

        // Upload image
        $target_dir = "uploads/";
        $target_file = $target_dir . basename($gambar);
        if (move_uploaded_file($_FILES['gambar']['tmp_name'], $target_file)) {
            $sql = "INSERT INTO gallery (tanggal, gambar) VALUES ('$tanggal', '$gambar')";
            if ($conn->query($sql) === TRUE) {
                echo "New record created successfully.";
            } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }
        } else {
            echo "Error uploading image.";
        }
    } elseif (isset($_POST['delete'])) {
        // Delete a gallery entry
        $id = $_POST['id'];
        $sql = "DELETE FROM gallery WHERE id=$id";
        if ($conn->query($sql) === TRUE) {
            echo "Record deleted successfully.";
        } else {
            echo "Error deleting record: " . $conn->error;
        }
    }
}

// Fetch gallery data
$sql = "SELECT * FROM gallery";
$result = $conn->query($sql);
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
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
    Tambah Gallery
    </button>
    <table id="example" class="table table-striped" style="width:100%">
        <thead>
            <tr>
                <th>No</th>
                <th>Tanggal</th>
                <th>Gambar</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
        <?php if ($result->num_rows > 0): ?>
            <?php while ($row = $result->fetch_assoc()): ?>
                <tr>
                    <td><?php echo $row['id']; ?></td>
                    <td><?php echo $row['tanggal']; ?></td>
                    <td><img src="uploads/<?php echo $row['gambar']; ?>" alt="Gambar" width="100"></td>
                    <td>
                    <a href="" class="btn btn-sm btn-success">Edit</a>
                    <a href="" class="btn btn-sm btn-danger">Delete</a>
                    </td>
                    <!-- <td>
                        <form action="" method="POST" style="display:inline;">
                            <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                            <button type="submit" name="delete">Delete</button>
                        </form>
                    </td> -->
                </tr>
            <?php endwhile; ?>
        <?php else: ?>
            <tr>
                <td colspan="4">No records found.</td>
            </tr>
        <?php endif; ?>
            <!-- <tr>
                <td>1</td>
                <td>10-12-2025</td>
                <td>image.jpg</td>
                <td>
                    <a href="" class="btn btn-sm btn-success">Edit</a>
                    <a href="" class="btn btn-sm btn-danger">Delete</a>
                </td>
            </tr> -->
        </tbody>
    </table>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="" method="POST" enctype="multipart/form-data">
                    <div class="mb-3">
                        <label for="tanggal" class="form-label">Tanggal</label>
                        <input type="date" class="form-control" name="tanggal" id="tanggal" required>
                    </div>
                    <div class="mb-3">
                        <label for="gambar" class="form-label">Gambar</label>
                        <input type="file" class="form-control" name="gambar" id="gambar" accept="image/*" required>
                    </div>
                    <div class="modal-footer mb-0">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary" name="add">Save changes</button>
                    </div>
                </form>

            </div>
            </div>
        </div>
    </div>
    <!-- Datatables -->
    <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
     <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script> -->
     <script src="https://cdn.datatables.net/2.2.0/js/dataTables.js"></script>
     <script src="https://cdn.datatables.net/2.2.0/js/dataTables.bootstrap5.js"></script>
     <script>
        new DataTable('#example');
     </script>
</body>
</html>

<?php
// Close the connection
$conn->close();
?>
