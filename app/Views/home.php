<?= $this->extend('layout/template'); ?>
<?= $this->section('content'); ?>

<meta name="viewport" content="width=device-width, initial-scale=1.0">

<div class="home-bg" style="position: relative;">
    <!-- Background Section -->
    <div class="home-bg-img"></div>

    <nav class="navbar navbar-expand-lg py-3 mb-3 d-flex justify-content-between align-items-center shadow-none main-navbar">
        <a class="navbar-brand m-0" href="#"><img src="/img/logoPutih.png" alt="" class="img-fluid"></a>
        <div class="d-flex align-items-center">
            <?php if (session()->get('isLoggedIn')): ?>
                <!-- Logout button -->
                <a class="auth-btn d-flex btn px-4 py-2 bg-white text-black shadow rounded-pill align-items-center" href="<?= base_url('logout'); ?>">
                    <i class="fa fa-sign-out p-2 rounded-circle mr-3" style="color:white; background:linear-gradient(45deg, #3A85D3, #5DAF57);"></i>
                    <div class="pr-auto">Log Out</div>
                    <svg class="ml-2" width="20" height="20" viewBox="0 0 24 24" style="fill:#888;">
                        <path d="M9.29 6.71a1 1 0 0 1 1.42 0l4 4a1 1 0 0 1 0 1.42l-4 4a1 1 0 1 1-1.42-1.42L12.59 12l-3.3-3.29a1 1 0 0 1 0-1.42z" />
                    </svg>
                </a>
            <?php else: ?>
                <!-- Login button -->
                <a class="auth-btn d-flex btn px-4 py-2 bg-white text-black shadow rounded-pill align-items-center" href="<?= base_url('login'); ?>">
                    <i class="fa fa-user p-2 rounded-circle mr-3" style="color:white; background:linear-gradient(45deg, #3A85D3, #5DAF57);"></i>
                    <div class="pr-auto">Log In</div>
                    <svg class="ml-2" width="20" height="20" viewBox="0 0 24 24" style="fill:#888;">
                        <path d="M9.29 6.71a1 1 0 0 1 1.42 0l4 4a1 1 0 0 1 0 1.42l-4 4a1 1 0 1 1-1.42-1.42L12.59 12l-3.3-3.29a1 1 0 0 1 0-1.42z" />
                    </svg>
                </a>
            <?php endif; ?>
        </div>
    </nav>

    <!-- Welcome Section -->
    <div class="main-content">
        <div class="text-white mt-2 mb-5 text-center">
            <h1 class="font-weight-bold">Selamat Datang di Knowledge Base BPJS Ketenagakerjaan</h1>
            <h3 class="font-weight-light">Anda Cari, Kami Sediakan</h3>
        </div>

        <!-- Container putih tengah -->
        <!-- Container putih tengah -->
        <div class="apps-wrapper mx-auto">
            <div class="row justify-content-center">
                <?php foreach ($manual as $m): ?>
                    <div class="col-12 col-md-4 mb-4 d-flex align-items-stretch">
                        <a href="<?= base_url('pages/manual/' . $m['slug']) ?>" style="text-decoration:none; width:100%;">
                            <div class="card h-100 border-0 shadow-sm text-center">
                                <div class="card-body d-flex align-items-center justify-content-center">
                                    <img src="<?= base_url('img/' . $m['icon']) ?>" alt="<?= $m['judul'] ?>"
                                        class="card-img-top img-fluid"
                                        style="max-width: 80px; height: auto; margin-right: 16px;">
                                    <div class="text-left" style="color: #3A85D3">
                                        <h5 class="card-title font-weight-bold mb-1"><?= $m['judul']; ?></h5>
                                        <p class="card-text mb-0"><?= $m['kategori']; ?></p>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>

        <!-- Button Section -->
        <div class="button-wrapper text-center">
            <?php if (isset($isLoggedIn) && $isLoggedIn): ?>
                <a href="<?= base_url('pages'); ?>" class="btn btn-primary py-2 px-4 shadow rounded-lg lihat-topik-btn" style="background-color:#3A85D3;">
                    <div class="d-flex align-items-center justify-content-center">
                        Lihat semua topik
                        <img src="/img/rightArrow.png" class="ml-2 img-fluid" style="max-height:15px" alt="->">
                    </div>
                </a>
            <?php else: ?>
                <a href="<?= base_url('login'); ?>" class="btn btn-primary py-2 px-4 shadow rounded-lg lihat-topik-btn" style="background-color:#3A85D3;">
                    <div class="d-flex align-items-center justify-content-center">
                        Lihat semua topik
                        <img src="/img/rightArrow.png" class="ml-2 img-fluid" style="max-height:15px" alt="->">
                    </div>
                </a>
            <?php endif; ?>
        </div>
    </div>
</div>


<style>
    html,
    body {
        height: 100%;
        min-height: 100%;
        font-size: 16px;
    }

    .home-bg {
        width: 100vw;
        min-height: 100vh;
        position: relative;
        overflow-x: hidden;
    }

    .home-bg-img {
        background-image: url('/img/backgroundHome.png');
        background-size: cover;
        background-repeat: no-repeat;
        background-position: center center;
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 90vh;
        z-index: 0;
    }

    .main-navbar {
        display: flex !important;
        flex-wrap: nowrap !important;
        align-items: center;
        justify-content: space-between;
        width: 100%;
        padding-left: 1rem !important;
        padding-right: 1rem !important;
        position: relative;
        z-index: 2;
        background: transparent !important;
    }

    .navbar-brand img {
        max-width: 200px;
        height: auto;
    }

    h1.font-weight-bold {
        font-size: 2.5rem;
    }

    h3.font-weight-light {
        font-size: 1.3rem;
        font-style: italic;
    }

    @media (max-width: 992px) {
        .navbar-brand img {
            max-width: 140px;
        }

        h1.font-weight-bold {
            font-size: 2rem;
        }

        h3.font-weight-light {
            font-size: 1.1rem;
        }
    }

    @media (max-width: 576px) {
        h1.font-weight-bold {
            font-size: 1.3rem;
        }

        h3.font-weight-light {
            font-size: 1rem;
        }
    }

    @media (max-width: 992px) {
        .main-navbar {
            padding-left: 2rem !important;
            padding-right: 2rem !important;
        }
    }

    @media (max-width: 576px) {
        .main-navbar {
            padding-left: 0.5rem !important;
            padding-right: 0.5rem !important;
        }
    }

    .main-content {
        position: relative;
        z-index: 2;
        max-width: 1200px;
        min-width: 320px;
        margin: 0 auto;
        width: 100%;
        padding: 2rem 1rem 5rem 1rem;
        box-sizing: border-box;
        background: transparent;
    }


    .apps-wrapper {
        background: #fff;
        border-radius: 16px;
        box-shadow: 0 4px 24px rgba(0, 0, 0, 0.08);
        padding: 1.5rem 1.5rem;
        max-width: 1100px;
        min-width: 320px;
        width: 100%;
        margin: 10rem auto 0 auto;
        position: relative;
        z-index: 2;
    }

    @media (max-width: 1024px) {
        .apps-wrapper {
            margin: 2.5rem auto 0 auto;
            padding: 1rem 0.5rem;
        }
    }

    @media (max-width: 768px) {
        .apps-wrapper {
            margin: 1.5rem auto 0 auto;
            padding: 0.5rem 0.2rem;
        }
    }

    .button-wrapper {
        margin-top: -1.5rem;
        margin-bottom: 2.5rem;
        z-index: 3;
        position: relative;
        display: flex;
        justify-content: center;
    }

    .lihat-topik-btn {
        width: auto !important;
        min-width: 220px;
        max-width: 320px;
        display: inline-block;
        border-radius: 15px !important;
        background-color: #3A85D3 !important;
        color: #fff !important;
        box-shadow: 0 4px 16px rgba(34, 109, 168, 0.08);
        transition: background 0.2s;
    }

    .card-section {
        width: 100%;
        margin: 0 auto;
    }

    .row {
        display: flex;
        flex-wrap: wrap;
        justify-content: center;
    }

    .col-12.col-md-4 {
        max-width: 350px;
        min-width: 250px;
        flex: 1 1 260px;
        margin: 10px;
        display: flex;
    }

    .card {
        width: 100%;
        min-height: 220px;
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
    }

    /* Responsive Auth (Login/Logout) Button */
    .auth-btn {
        white-space: nowrap;
        min-width: 80px;
        font-size: 0.95rem;
        padding: 6px 10px;
        margin-left: 0;
    }


    .main-navbar>.d-flex.align-items-center {
        margin-right: 2rem;
    }

    @media (max-width: 992px) {
        .main-navbar>.d-flex.align-items-center {
            margin-right: 1rem;
        }
    }

    @media (max-width: 576px) {
        .main-navbar>.d-flex.align-items-center {
            margin-right: 0.5rem;
        }
    }

    /* Tablet (portrait & landscape) */
    @media (max-width: 1024px) {

        .main-content,
        .apps-wrapper {
            max-width: 98vw;
            padding: 1.5rem 0.5rem;
        }

        .row {
            flex-wrap: wrap;
            justify-content: center;
        }

        .col-12.col-md-4 {
            max-width: 90vw;
            min-width: 220px;
            flex: 1 1 260px;
            margin: 10px 0;
        }

        .card {
            min-height: 160px;
            padding: 1rem 0.5rem;
        }

        .auth-btn {
            min-width: 120px;
            font-size: 0.95rem;
            padding: 7px 14px;
        }
    }

    /* Mobile */
    @media (max-width: 768px) {

        .apps-wrapper {
            margin: 1.5rem auto 0 auto;
            padding: 0.5rem 0.2rem;
        }

        .main-content,
        .apps-wrapper {
            max-width: 100vw;
            padding: 1rem 0.5rem;
        }

        .row {
            flex-direction: column;
            align-items: center;
        }

        .col-12.col-md-4 {
            max-width: 98vw;
            min-width: 0;
            margin: 10px 0;
        }

        .auth-btn {
            min-width: 100px;
            font-size: 0.9rem;
            padding: 6px 10px;
            margin-left: 0;
        }

        .card {
            min-height: 120px;
            padding: 0.5rem 0.2rem;
        }
    }

    /* Extra small mobile */
    @media (max-width: 480px) {
        .main-navbar {
            padding-left: 0.5rem !important;
            padding-right: 0.5rem !important;
        }

        .main-content,
        .apps-wrapper {
            padding: 0.5rem 0.2rem;
        }

        .auth-btn {
            min-width: 80px;
            font-size: 0.85rem;
            padding: 4px 6px;
        }

        .card {
            min-height: 100px;
            padding: 0.2rem;
        }
    }
</style>

<?= $this->endSection(); ?>