<?php
include "koneksi.php"; 

// Tampilkan Gallery
$gallery = "SELECT * FROM gallery";
$result = $conn->query($gallery);
?>
<!doctype html>
<html lang="en" data-bs-theme="light">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>My Journal</title>
    <link rel="icon" href="fiks.jpeg"/>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css"> -->
    <!-- <link rel="stylesheet" href="https://cdn.datatables.net/2.2.0/css/dataTables.bootstrap5.css"> -->
  </head>
  <body>
    <!-- nav begin -->
    <nav class="navbar navbar-expand-lg bg-body-tertiary sticky-top">
      <div class="container">
        <a class="navbar-brand" href="#">My Journal</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav ms-auto mb-2 mb-lg-0 text dark">
            <li class="nav-item">
              <a class="nav-link" href="#">Home</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#article">Article</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#gallery">Gallery</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#Schedule">Schedule</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="#About me">About me</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="login.php">Login</a>
              </li>
            <button id="themeToggle" class="btn btn-secondary">
              <i class="bi bi-moon-fill"></i>
            </button>
          </ul>
        </div>
      </div>
    </nav>
    <!-- nav end -->

    <!-- hero begin -->
    <section id="hero" class="text-center p-5 bg-primary-subtle text-sm-start">
      <div class="container">
        <div class="d-sm-flex flex-sm-row-reverse align-items-center">
          <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTV98I1gBc5rn4-aaq96b8pcgA8cAYElWzp9A&s" class="img-fluid" width="300">
          <div>
            <h1 class="fw-bold display-4">cerita hidup</h1>
            <h4 class="lead display-6">Hidup kadang ada pait dan manisnya.</h4>
            <span id="tanggal"></span>
            <span id="jam"></span>
          </div>
        </div>
      </div>
    </section>
    <!-- hero end -->

   <!-- article begin -->
<section id="article" class="text-center p-5">
  <div class="container">
    <h1 class="fw-bold display-4 pb-3">article</h1>
    <div class="row">
      <?php
      $sql = "SELECT * FROM article ORDER BY tanggal DESC";
      $hasil = $conn->query($sql); 

      $no = 1;
      while($row = $hasil->fetch_assoc()){
        ?>
        <div class="container">
          <div class="row">
            <div class="col-lg-5">
            <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRAulr-he_FPTWAEfmTEIxLLp649sutQle7vQ&s" class="rounded-circle">
            </div>
            <div class="col-lg-7">
              <span>Omo Kucrut Bukan DJ Biasa Dunia akting dan musik bagi Omo Kucrut tak ubahnya dua sisi mata uang. Pria yang bernama lengkap Heri Purnomo itu adalah bintang sinetron yang dikenal publik lewat perannya sebagai si Ceking dalam sinetron “Ronaldowati”1. Dalam sinetron yang pertama tayang di TPI (sekarang MNCTV) tahun 2008, Omo Kucrut digambarkan sebagai sosok pemain bola yang dapat berlari secepat kilat. Hidup lelaki yang kini berusia 36 tahun itu memang penuh kejutan, serba tidak terduga1.Omo Kucrut lahir di Jakarta, 8 April 1986. Sewaktu kecil, Omo Kucrut mempunyai cita-cita menjadi seorang insinyur sipil1. Namun seiring berjalannya waktu, ia justru lebih tertarik dalam dunia entertainment.</span>
            </div>
          </div>
        </div>
        <?php
      }
      ?> 
    </div>
  </div>
</section>
<!-- article end -->

    <!-- gallery begin -->
        <h1 class="fw-bold text-center display-4 pb-3">Gallery</h1>
        <div class="row container">

        <?php if ($result->num_rows > 0): ?>
            <?php while ($row = $result->fetch_assoc()): ?>
              <div class="col-3 col-md-4 col-lg-4 mb-3">
                <div class="card border-0 shadow">
                  <div class="card-body p-1">
                  <img src="uploads/<?php echo $row['gambar']; ?>" alt="Gambar" class="rounded" width="100% auto">
                  </div>
                </div>
              </div>
            <?php endwhile; ?>
        <?php endif; ?>
        </div>
        <!-- <div class="row">
          <div class="col-6 col-md-4 col-lg-4">
            <div class="card">
              <div class="card-body">

              </div>
            </div>
          </div>
          <div class="col-6 col-md-4 col-lg-4"></div>
        </div> -->
        <!-- <div id="carouselExample" class="carousel slide">
          <div class="carousel-inner">
            <div class="carousel-item active">
              <img src="img/joni.jpeg" class="d-block w-100" alt="...">
            </div>
            <div class="carousel-item">
              <img src="fimg/jo.jpeg" class="d-block w-100" alt="...">
            </div>
            <div class="carousel-item">
              <img src="img/fiks.jpeg" class="d-block w-100" alt="...">
            </div>
            <div class="carousel-item">
              <img src="img/fine.jpeg" class="d-block w-100" alt="...">
            </div>
            <div class="carousel-item">
              <img src="https://p4.wallpaperbetter.com/wallpaper/44/475/694/airplane-flight-sunset-wallpaper-preview.jpg" class="d-block w-100" alt="...">
            </div>
          </div>
          <button class="carousel-control-prev" type="button" data-bs-target="#carouselExample" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
          </button>
          <button class="carousel-control-next" type="button" data-bs-target="#carouselExample" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
          </button>
        </div> -->
      </div>
    </section>
    <!-- gallery end -->

  <!-- Schedule begin -->
  <section id="Schedule" class="text-center p-5">
    <div class="container">
      <h1 class="fw-bold display-4 pb-3">Schedule</h1>
      <div class="row row-cols-1 row-cols-md-3 g-4">
        <!-- Monday -->
        <div class="col">
          <div class="card h-100">
            <div class="card-header bg-secondary text-white">
              <h5 class="mb-0">SENIN</h5>
            </div>
            <div class="card-body">
              <ul class="list-unstyled">
                <li class="mb-3">
                  <div class="fw-bold">Etika Profesi</div>
                  <div>16:20-18:00 | H.4.4</div>
                </li>
                <li class="mb-3">
                  <div class="fw-bold">Sistem Operasi</div>
                  <div>18:30-21:00 | H.4.8</div>
                </li>
              </ul>
            </div>
          </div>
        </div>
  
        <!-- Tuesday -->
        <div class="col">
          <div class="card h-100">
            <div class="card-header bg-secondary text-white">
              <h5 class="mb-0">SELASA</h5>
            </div>
            <div class="card-body">
              <ul class="list-unstyled">
                <li class="mb-3">
                  <div class="fw-bold">Pendidikan Kewarganegaraan</div>
                  <div>12:30-13:10 | Kulino</div>
                </li>
                <li class="mb-3">
                  <div class="fw-bold">Probabilitas dan Statistik</div>
                  <div>15:30-18:00 | H.4.9</div>
                </li>
                <li class="mb-3">
                  <div class="fw-bold">Rekayasa Perangkat Lunak</div>
                  <div>10:30-12:10 | H.4.7</div>
                </li>
              </ul>
            </div>
          </div>
        </div>
  
        <!-- Wednesday -->
        <div class="col">
          <div class="card h-100">
            <div class="card-header bg-secondary text-white">
              <h5 class="mb-0">RABU</h5>
            </div>
            <div class="card-body">
              <ul class="list-unstyled">
                <li class="mb-3">
                  <div class="fw-bold">Pemograman Berbasis Web</div>
                  <div>15:30-18:00 | H.4.6</div>
                </li>
              </ul>
            </div>
          </div>
        </div>
  
        <!-- Thursday -->
        <div class="col">
          <div class="card h-100">
            <div class="card-header bg-secondary text-white">
              <h5 class="mb-0">KAMIS</h5>
            </div>
            <div class="card-body">
              <ul class="list-unstyled">
                <li class="mb-3">
                  <div class="fw-bold">Sistem Operasi</div>
                  <div>12.30-15.00 | H.5.8</div>
                </li>
                <li class="mb-3">
                  <div class="fw-bold">Pendidikan Agama Islam</div>
                  <div>16:20-18:00 | Kulino</div>
                </li>
                <li class="mb-3">
                  <div class="fw-bold">Penambangan Data</div>
                  <div>18:30-21:00 | H.4.9</div>
                </li>
              </ul>
            </div>
          </div>
        </div>
  
        <!-- Friday -->
        <div class="col">
          <div class="card h-100">
            <div class="card-header bg-secondary text-white">
              <h5 class="mb-0">JUMAT</h5>
            </div>
            <div class="card-body">
              <ul class="list-unstyled">
                <li class="mb-3">
                  <div class="fw-bold">Pemrograman Web Lanjut</div>
                  <div>10:20-12:00 | D.2.K</div>
                </li>
              </ul>
            </div>
          </div>
        </div>
  
        <!-- Saturday -->
        <div class="col">
          <div class="card h-100">
            <div class="card-header bg-secondary text-white">
              <h5 class="mb-0">SABTU</h5>
            </div>
            <div class="card-body">
              <ul class="list-unstyled">
                <li class="mb-3">
                  <div class="fw-bold">FREE</div>
                </li>
              </ul>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- Schedule end -->

  <!-- About Me -->
  <section id="A2bout me" class="text-center p-5 bg-primary-subtle text-sm-start">
    <div class="container">
      <div class="d-sm-flex flex-sm-row align-items-center justify-content-center">
        <img src="data:image/webp;base64,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" class="rounded-circle" alt="Cinque Terre" width="200">
        <div>
          <p>A11.2023.15483</p>
          <h3 class="fw-bold display">Sakti Ardino Putra Pratama</h3>
          <p class="lead display">Program Studi Teknik Informatika</p>
          <p class="fw-bold display "><a href="https://dinus.ac.id/" class="text-dark">Universitas Dian Nuswantoro</a></p>
        </div>
      </div>
    </div>
  </section>

    <!-- footer begin -->
    <footer class="text-center p-5">
      <div>
        <a href="https://www.instagram.com/sktiardino__/profilecard/?igsh=Mjhqaml0MGM0ODh6"> <i class="bi bi-instagram h2 p-2 text-dark"></i></a>
        <a href="https://x.com/ardinosakt1308?s=11"> <i class="bi bi-twitter h2 p-2 text-dark"></i></a>
        <a href="http://wa.me/6285892967291"> <i class="bi bi-whatsapp h2 p-2 text-dark"></i></a>
      </div>
      <div>Sakti Ardino Putra Pratama &copy; 2023</div>
    </footer>
    <!-- footer end -->

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script type="text/javascript">
      // Display Date and Time
      window.setTimeout("tampilWaktu()", 1000);
      function tampilWaktu () {
        var waktu = new Date();
        var bulan = waktu.getMonth() + 1;
        setTimeout("tampilWaktu()",1000);
        document.getElementById("tanggal").innerHTML = waktu.getDate() + "/" + bulan + "/" + waktu.getFullYear();
        document.getElementById("jam").innerHTML = waktu.getHours() + ":" + waktu.getMinutes() + ":" + waktu.getSeconds();
      }

      // Toggle Light/Dark Mode
      document.getElementById("themeToggle").addEventListener("click", function () {
        var currentTheme = document.documentElement.getAttribute("data-bs-theme");
        var newTheme = currentTheme === "light" ? "dark" : "light";
        document.documentElement.setAttribute("data-bs-theme", newTheme);
        this.innerHTML = newTheme === "light" ? '<i class="bi bi-moon-fill"></i>' : '<i class="bi bi-brightness-high-fill"></i>';
      });
    </script>
    <!-- Datatables -->
     <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
     <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
     <script src="https://cdn.datatables.net/2.2.0/js/dataTables.js"></script>
     <!-- <script src="https://cdn.datatables.net/2.2.0/js/dataTables.bootstrap5.js"></script> -->
     <script>
        new DataTable('#example');
     </script>
  </body>
</html>