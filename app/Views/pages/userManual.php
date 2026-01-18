<?= $this->extend('layout/template2'); ?>
<?= $this->section('content'); ?>

<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">


<div class="manual-header text-center">
    <h1><?= esc($title); ?></h1>
    <a href="/pages" style="color: #fefefe; text-decoration: underline; font-size: 0.9rem;">← Kembali ke halaman utama</a>
    <div class="d-flex justify-content-center mt-3">
        <a href="/manual/edit/<?= esc($manual['id']) ?>" class="btn btn-outline-light mr-2">
            <i class="fas fa-edit"></i> Edit
        </a>
        <a href="/manual/history/<?= esc($manual['id']) ?>" class="btn btn-outline-light">
            <i class="fas fa-history"></i> History
        </a>
    </div>
</div>

<!-- Sidebar -->
<!-- <div class="sidebar-left">
    <h5>Contents</h5>
    <ul>
        <li><a href="#pendahuluan">Pendahuluan</a></li>
        <li><a href="#ruang-lingkup">Ruang Lingkup</a></li>
        <li><a href="#pengguna">Pengguna</a></li>
        <li><a href="#panduan-pengguna">Panduan Pengguna</a></li>
    </ul>
</div> -->



<!-- Content -->
 <div class="manual-content">
    <?= $manual['content'] ?>
</div>


<style>
    body {
        font-family: 'Inter', sans-serif;
        background-color: #f9fafb;
    }
    .manual-header {
    background-image: url("<?= base_url('img/judulBgDetail.png'); ?>");
    background-size: cover;
    background-repeat: no-repeat;
    background-position: center;
    color: white;
    padding: 2rem 1rem;
    }

    .manual-header h1 {
        font-size: 1.8rem;
        margin-bottom: 0.5rem;
    }
    .sidebar-left {
    position: fixed;
    top: 120px;
    left: 250px; 
    width: 240px;
    padding: 1.5rem;
    background: white;
    border-radius: 0 1rem 1rem 0;
    box-shadow: 2px 0 10px rgba(0,0,0,0.05);
    z-index: 900; 
    height: calc(100% - 120px);
    overflow-y: auto;
  }

    .sidebar-left h5 {
        color: #3A85D3;
        margin-bottom: 1rem;
    }
    .sidebar-left ul {
        list-style: none;
        padding: 0;
    }
    .sidebar-left ul li {
        margin: 0.7rem 0;
    }
    .sidebar-left ul li a {
        color: #374151;
        text-decoration: none;
        font-size: 0.95rem;
    }
    .sidebar-left ul li a:hover {
        color: #3A85D3;
    }
    .manual-content {
        margin-left: 520px;
        padding: 2rem;
    }
    .manual-content h3 {
        color: #3A85D3;
        margin-top: 2rem;
    }
    .manual-content p {
        color: #374151;
        font-size: 0.95rem;
        line-height: 1.7;
    }
    .manual-content img {
        max-width: 100%;
        border-radius: 0.5rem;
        margin: 1rem 0;
    }
</style>


<?= $this->endSection(); ?>
