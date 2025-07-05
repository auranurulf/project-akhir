<!DOCTYPE html>

<?php
$show_output = false;
$output_data = [];
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $conn = new mysqli("localhost", "root", "", "ppdb");
    if ($conn->connect_error) {
        die("Koneksi gagal: " . $conn->connect_error);
    }
    // Ambil data dari form
    $nama_lengkap = $conn->real_escape_string($_POST['nama_lengkap']);
    $nama_panggilan = $conn->real_escape_string($_POST['nama_panggilan']);
    $jenis_kelamin = $conn->real_escape_string($_POST['jenis_kelamin']);
    $tempat_lahir = $conn->real_escape_string($_POST['tempat_lahir']);
    $tanggal_lahir = $conn->real_escape_string($_POST['tanggal_lahir']);
    $agama = $conn->real_escape_string($_POST['agama']);
    $alamat_kk = $conn->real_escape_string($_POST['alamat_kk']);
    $nama_ayah = $conn->real_escape_string($_POST['nama_ayah']);
    $pendidikan_ayah = $conn->real_escape_string($_POST['pendidikan_ayah']);
    $pekerjaan_ayah = $conn->real_escape_string($_POST['pekerjaan_ayah']);
    $nama_ibu = $conn->real_escape_string($_POST['nama_ibu']);
    $pendidikan_ibu = $conn->real_escape_string($_POST['pendidikan_ibu']);
    $pekerjaan_ibu = $conn->real_escape_string($_POST['pekerjaan_ibu']);

    // Simpan ke tabel students
    $sql = "INSERT INTO students (nama_lengkap, nama_panggilan, jenis_kelamin, tempat_lahir, tanggal_lahir)
            VALUES ('$nama_lengkap', '$nama_panggilan', '$jenis_kelamin', '$tempat_lahir', '$tanggal_lahir')";
    if ($conn->query($sql) === TRUE) {
        $student_id = $conn->insert_id;
        // Simpan ke tabel guardians
        $sql2 = "INSERT INTO guardians (student_id, nama_ayah, pendidikan_ayah, pekerjaan_ayah, nama_ibu, pendidikan_ibu, pekerjaan_ibu, agama, alamat_kk)
                 VALUES ($student_id, '$nama_ayah', '$pendidikan_ayah', '$pekerjaan_ayah', '$nama_ibu', '$pendidikan_ibu', '$pekerjaan_ibu' , '$agama', '$alamat_kk')";
        $conn->query($sql2);
       // Siapkan data untuk output
        $show_output = true;
        $output_data = [
            'Nomor Pendaftaran' => $student_id,
            'Nama Lengkap' => $nama_lengkap,
            'Nama Panggilan' => $nama_panggilan,
            'Jenis Kelamin' => $jenis_kelamin == 'L' ? 'Laki-laki' : 'Perempuan',
            'Tempat Lahir' => $tempat_lahir,
            'Tanggal Lahir' => $tanggal_lahir,
            'Agama' => $agama,
            'Alamat KK' => $alamat_kk,
            'Nama Ayah' => $nama_ayah,
            'Pendidikan Ayah' => $pendidikan_ayah,
            'Pekerjaan Ayah' => $pekerjaan_ayah,
            'Nama Ibu' => $nama_ibu,
            'Pendidikan Ibu' => $pendidikan_ibu,
            'Pekerjaan Ibu' => $pekerjaan_ibu
        ];
    } else {
        echo "<script>alert('Gagal menyimpan data!');</script>";
    }
    $conn->close();
}
?>

<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Tentang Kami - MI Hidayatul Athfal Curug</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,300;0,400;0,700;1,700&display=swap"
      rel="stylesheet"
    />

    <!-- Feather Icons -->
    <script src="https://unpkg.com/feather-icons"></script>

    <!-- My Style -->
    <link rel="stylesheet" href="css/style.css" />
  </head>

  <body>
    <!-- Navbar start -->
    <nav class="navbar">
      <a href="#" class="navbar-logo">MI HIDAYATUL ATHFAL CURUG</a>

      <div class="navbar-nav">
        <a href="index.html">Home</a>
        <a href="about.html">Tentang Kami</a>
        <a href="info.html">Informasi</a>
        <a href="galeri.html">Galeri</a>
        <a href="ppdb.php">PPDB</a>
        <a href="ulasan.html">Kontak</a>
      </div>

      <div class="navbar-extra">
        <a href="#" id="hamburger-menu"><i data-feather="menu"></i></a>
      </div>
    </nav>
    <!-- Navbar end -->

    <!-- Formulir PPDB Interaktif -->
    <section class="ppdb-section">
      <h1 class="ppdb-title">Make An Admission</h1>
      <p class="ppdb-desc">Registrasi Online MI Hidayatul Athfal Curug</p>
      <form class="ppdb-form" method="POST" action="">
        <div class="ppdb-box">
          <div class="ppdb-box-title">
            <i data-feather="book-open"></i>
            <span>Data Peserta Didik Baru</span>
          </div>
          <div class="ppdb-row">
            <div class="ppdb-field">
              <label>Nama Lengkap</label>
              <input type="text" name="nama_lengkap" />
            </div>
            <div class="ppdb-field">
              <label>Nama Panggilan</label>
                <input type="text" name="nama_panggilan" />
            </div>
            <div class="ppdb-field">
              <label>Jenis Kelamin</label>
              <select name="jenis_kelamin">
                <option value="">Select</option>
                <option value="L">Laki-laki</option>
                <option value="P">Perempuan</option>
              </select>
            </div>
          </div>
          <div class="ppdb-row">
            <div class="ppdb-field">
              <label>Tempat Lahir</label>
              <input type="text" required name="tempat_lahir" />
            </div>
            <div class="ppdb-field">
              <label>Tanggal Lahir</label>
              <input type="date" required name="tanggal_lahir" />
            </div>
          </div>
        </div>
           <div class="ppdb-box">
  <div class="ppdb-box-title">
    <i data-feather="users"></i>
    <span>Data Wali Murid Peserta Didik Baru</span>
  </div>
  <div class="ppdb-row">
    <div class="ppdb-field">
      <label>Nama Ayah</label>
      <input type="text" name="nama_ayah" required />
    </div>
    <div class="ppdb-field">
      <label>Nama Ibu</label>
      <input type="text" name="nama_ibu" required />
    </div>
  </div>
  <div class="ppdb-row">
    <div class="ppdb-field">
      <label>Pendidikan Ayah</label>
      <input type="text" name="pendidikan_ayah" required />
    </div>
    <div class="ppdb-field">
      <label>Pendidikan Ibu</label>
      <input type="text" name="pendidikan_ibu" required />
    </div>
  </div>
  <div class="ppdb-row">
    <div class="ppdb-field">
      <label>Pekerjaan Ayah</label>
      <input type="text" name="pekerjaan_ayah" required />
    </div>
    <div class="ppdb-field">
      <label>Pekerjaan Ibu</label>
      <input type="text" name="pekerjaan_ibu" required />
    </div>
  </div>
  <div class="ppdb-row">
    <div class="ppdb-field">
      <label>Agama</label>
      <select name="agama">
        <option value="">Select</option>
        <option value="Islam">Islam</option>
      </select>
    </div>
    <div class="ppdb-field">
      <label>Alamat Sesuai Kartu Keluarga</label>
      <textarea rows="2" name="alamat_kk"></textarea>
    </div>
  </div>
</div>
        </div>
        <button type="submit" class="ppdb-submit">
          <i data-feather="plus-circle"></i> SUBMIT
        </button>
      </form>
    </section>
<?php if ($show_output): ?>
  <section class="ppdb-output" style="margin: 30px; padding: 20px; border: 1px solid #ccc; background: #f9f9f9;">
    <h2>Pendaftaran Berhasil!</h2>
    <p><strong>Nomor Pendaftaran Anda:</strong> <?php echo $output_data['Nomor Pendaftaran']; ?></p>
    <h3>Data yang Anda Inputkan:</h3>
    <table>
      <?php foreach ($output_data as $key => $value): ?>
        <?php if ($key !== 'Nomor Pendaftaran'): ?>
        <tr>
          <td><strong><?php echo $key; ?></strong></td>
          <td><?php echo htmlspecialchars($value); ?></td>
        </tr>
        <?php endif; ?>
      <?php endforeach; ?>
    </table>
  </section>
<?php endif; ?>
    <!-- Footer start -->
    <footer>
      <div class="credit">
        <p>Created by <a href="">Aura Nurul Fadilah</a>. | &copy; 2025.</p>
      </div>
    </footer>
    <!-- Footer end -->

    <!-- Feather Icons -->
    <script>
      feather.replace();
    </script>

    <!-- My Javascript -->
    <script src="js/script.js" defer></script>
  </body>
</html>
