<?php
// Inisialisasi variabel pesan
$message = '';
$messageType = '';

// Cek jika form disubmit
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Ambil data dari form
    $nama = strip_tags(trim($_POST["nama"]));
    $email = strip_tags(trim($_POST["email"]));
    $telepon = strip_tags(trim($_POST["telepon"]));
    $pesan = strip_tags(trim($_POST["pesan"]));

    // Validasi input
    if (empty($nama) || empty($email) || empty($telepon) || empty($pesan)) {
        $message = "Mohon lengkapi semua field.";
        $messageType = "danger";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $message = "Format email tidak valid.";
        $messageType = "danger";
    } else {
        // Siapkan pesan email
        $to = "corecomputer@domain.com";
        $subject = "Pesan Baru dari Website - Core Computer";
        $email_content = "Nama: $nama\n";
        $email_content .= "Email: $email\n";
        $email_content .= "Telepon: $telepon\n\n";
        $email_content .= "Pesan:\n$pesan\n";

        // Header email
        $headers = "From: $nama <$email>";

        // Kirim email
        if (mail($to, $subject, $email_content, $headers)) {
            $message = "Terima kasih! Pesan Anda telah terkirim.";
            $messageType = "success";
        } else {
            $message = "Maaf, terjadi kesalahan. Silakan coba lagi nanti.";
            $messageType = "danger";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Proses Form - Core Computer</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body text-center">
                        <?php if ($message): ?>
                            <div class="alert alert-<?php echo $messageType; ?>" role="alert">
                                <?php echo $message; ?>
                            </div>
                        <?php endif; ?>
                        <h4 class="mb-4">Status Pengiriman Pesan</h4>
                        <a href="index.php" class="btn btn-primary">Kembali ke Beranda</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html> 