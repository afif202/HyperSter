<?php
// Simple contact handler (no mailer), shows submitted data safely
function e($s){ return htmlspecialchars($s ?? '', ENT_QUOTES, 'UTF-8'); }

$method = $_SERVER['REQUEST_METHOD'] ?? 'GET';

if ($method === 'POST') {
  $hp = $_POST['hp_name'] ?? '';
  if ($hp) { header('Location: index.html'); exit; } // honeypot => treat as bot
  $name = trim($_POST['name'] ?? '');
  $email = trim($_POST['email'] ?? '');
  $message = trim($_POST['message'] ?? '');

  $valid = filter_var($email, FILTER_VALIDATE_EMAIL) && $name !== '' && $message !== '';

  ?><!DOCTYPE html>
  <html lang="id">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Terima Kasih • HyperSter</title>
    <link rel="stylesheet" href="assets/style.css" />
  </head>
  <body>
    <div class="bg-gradient"></div>
    <nav class="nav">
      <div class="container wrap">
        <a href="index.html" class="brand">
          <span class="brand-badge"></span>
          <span>HyperSter Protocol</span>
        </a>
        <div class="row">
          <a href="index.html" class="btn">Beranda</a>
          <a href="about.html" class="btn">Tentang</a>
        </div>
      </div>
    </nav>

    <main class="section">
      <div class="container">
        <div class="card">
          <?php if($valid): ?>
            <h1 class="mt-0">Terima kasih, <?= e($name) ?>!</h1>
            <p class="lead">Pesanmu sudah kami terima. Balasan akan dikirim ke <b><?= e($email) ?></b>.</p>
            <div class="card" style="margin-top:12px">
              <h3>Ringkasan Pesan</h3>
              <p><?= nl2br(e($message)) ?></p>
            </div>
          <?php else: ?>
            <h1 class="mt-0">Input tidak valid</h1>
            <p class="lead">Pastikan email valid dan semua kolom terisi.</p>
          <?php endif; ?>
          <div class="row" style="margin-top:16px">
            <a class="button" href="index.html#contact">Kembali ke Form</a>
            <a class="button secondary" href="index.html">Kembali ke Beranda</a>
          </div>
        </div>
      </div>
    </main>

    <footer class="footer">
      <div class="container">© 2025 HyperSter Protocol</div>
    </footer>
  </body>
  </html>
  <?php
  exit;
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Kontak • HyperSter</title>
  <link rel="stylesheet" href="assets/style.css" />
  <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
</head>
<body>
  <div class="bg-gradient"></div>
  <nav class="nav">
    <div class="container wrap">
      <a href="index.html" class="brand">
        <span class="brand-badge"></span>
        <span>HyperSter Protocol</span>
      </a>
      <div class="row">
        <a href="index.html" class="btn">Beranda</a>
        <a href="about.html" class="btn">Tentang</a>
      </div>
    </div>
  </nav>

  <main class="section">
    <div class="container">
      <div class="card">
        <h1 class="mt-0">Hubungi Kami</h1>
        <form class="row" action="contact.php" method="POST">
          <input type="text" name="hp_name" style="display:none" tabindex="-1" autocomplete="off"/>
          <input required name="name" placeholder="Nama" style="flex:1; min-width:220px; padding:12px 14px; border-radius:12px; border:1px solid var(--card-border); background:rgba(255,255,255,0.04); color:var(--text)" />
          <input required type="email" name="email" placeholder="Email" style="flex:1; min-width:220px; padding:12px 14px; border-radius:12px; border:1px solid var(--card-border); background:rgba(255,255,255,0.04); color:var(--text)" />
          <textarea required name="message" placeholder="Pesan" rows="4" style="width:100%; padding:12px 14px; border-radius:12px; border:1px solid var(--card-border); background:rgba(255,255,255,0.04); color:var(--text)"></textarea>
          <button class="button" type="submit">Kirim</button>
        </form>
      </div>
    </div>
  </main>

  <footer class="footer">
    <div class="container">© 2025 HyperSter Protocol</div>
  </footer>
</body>
</html>