<?php

use Myth\Auth\Collectors\Auth;
?>
<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700,800,900" rel="stylesheet">


    <!-- JS: jQuery, Popper, Bootstrap -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.min.js" integrity="sha384-+sLIOodYLS7CIrQpBjl+C7nPvqq+FbNUBDunl/OZv93DB7Ln/533i8e/mZXLi/P+" crossorigin="anonymous"></script>

    <!-- css -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="/css/style.css">
    <link href='https://fonts.googleapis.com/css?family=Poppins' rel='stylesheet'>
    <title><?= isset($title) ? esc($title) : 'Judul Halaman'; ?></title>
</head>

<body class="sidebar-open">
    <nav class="navbar navbar-expand-sm navbar-light bg-white shadow-none" id="navbar">

        <div class="container-fluid mt-4 justify-content-center">
            <section id="main-logo" class="col-sm-4 justify-content-around h-fit align-items-center">
                <button button type="button" id="sidebarCollapse" class="h-fit btn btn-info  d-inline-block rounded-circle mx-2" style="background-color:#226DA8">
                    <i class="fa fa-bars"></i>
                    <span class="sr-only">Toggle Menu</span>
                </button>
                <a class=" h-fit navbar-brand d-inline-block col-8 mr-0" href="/pages">
                    <img src="/img/logoWarna.png" alt="" class="img-fluid">
                </a>
                <?php if (getenv('appFlag')) : ?>
                    <a class="h-fit btn d-inline-block d-sm-none p-0 m-0 shadow collapsed rounded-circle" href="<?= (!service('authentication')->check()) ? base_url('login') :  base_url('logout'); ?>">
                        <i class="fa fa-user p-2 rounded-circle" style=" color:white; background:linear-gradient(45deg,#3A85D3, #5DAF57) ;"></i>
                    </a>
                <?php endif ?>
            </section>


            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="nav navbar-nav w-100 justify-content-between align-items-center">
                    <li class="nav-item" style="flex:1; min-width:250px; max-width:600px;">
                        <div class="search-bar-wrapper" style="width:100%;">
                            <form action="/pages/searchPage" method="get" style="width:100%;">
                                <?= csrf_field(); ?>
                                <div class="search-bar shadow bg-white rounded-pill px-4 py-2 d-flex align-items-center" style="width:100%;">
                                    <input type="text" class="form-control border-0 bg-transparent" placeholder="Cari Petunjuk" name="keyword" style="box-shadow:none;">
                                    <button class="btn" type="submit" name="submit" style="background: none;">
                                        <i class="fa fa-search"></i>
                                    </button>
                                </div>
                            </form>
                        </div>
                    </li>
                    <li class="nav-item">
                        <?php if (session()->get('isLoggedIn')) : ?>
                            <div class="dropdown">
                                <button class="btn dropdown-toggle px-sm-auto px-md-4 py-2 bg-white text-black shadow rounded-pill d-flex align-items-center"
                                    type="button"
                                    id="userDropdown"
                                    data-toggle="dropdown"
                                    aria-haspopup="true"
                                    aria-expanded="false">
                                    <i class="fa fa-user p-2 rounded-circle mr-3"
                                        style="color:white; background:linear-gradient(45deg,#3A85D3, #5DAF57);"></i>
                                    <?php if (logged_in()) : ?>
                                        <?= esc(user()->username) ?>
                                    <?php endif; ?>

                                </button>
                                <div class="dropdown-menu dropdown-menu-right mt-2 shadow" style="right: 0.5rem; " aria-labelledby="userDropdown">
                                    <a class="dropdown-item" href="/logout">Logout</a>
                                </div>
                            </div>
                        <?php endif; ?>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <main>
        <?= $this->renderSection('content'); ?>
    </main>

    <footer id="footer">
        <?= $this->include('layout/footer'); ?>
    </footer>

    <style>
        html,
        body {
            height: 100%;
            margin: 0;
            padding-top: 80px;
        }

        #navbar {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 90px;
            background: #fff;
            z-index: 1050;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
        }

        #sidebar {
            position: fixed;
            top: 80px;
            left: 0;
            width: 340px;
            height: calc(100vh - 80px);
            background: #fff;
            z-index: 1000;
            overflow: hidden;
            display: flex;
            flex-direction: column;
        }

        body {
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }

        main {
            flex: 1;
        }

        footer {
            width: 100%;
        }

        #navbar .container-fluid {
            display: flex;
            align-items: center;
            justify-content: space-between;
            flex-wrap: nowrap;
        }

        #main-logo {
            display: flex;
            align-items: center;
            min-width: 100px;
            transition: all 0.3s;
        }

        .search-bar-wrapper {
            flex: 1 1 0;
            max-width: 600px;
            margin: 0 auto !important;
            transition: none !important;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .search-bar {
            width: 100%;
        }

        body.sidebar-open .search-bar-wrapper {
            margin-left: 0 !important;
        }

        /* Sembunyikan tombol hamburger saat sidebar aktif */
        #sidebar.active~#navbar #sidebarCollapse,
        body.sidebar-open #sidebarCollapse {
            display: none !important;
        }

        /* --- LOGO geser ke kiri saat sidebar terbuka --- */
        body.sidebar-open #main-logo {
            margin-left: -120px !important;
            /* geser lebih kiri */
            transition: all 0.3s;
        }

        @media (max-width: 600px) {
            body.sidebar-open #main-logo {
                margin-left: -40px !important;
            }
        }
    </style>

    <script>
        function previewImg() {
            const icon = document.querySelector("#icon")
            const iconLabel = document.querySelector(".custom-file-label")
            const imgPreview = document.querySelector(".img-preview")

            iconLabel.textContent = icon.files[0].name

            const fileIcon = new FileReader()
            fileIcon.readAsDataURL(icon.files[0])

            fileIcon.onload = function(e) {
                imgPreview.src = e.target.result
            }
        }
    </script>

    <?php if (session()->getFlashdata('pesan')) : ?>
        <script>
            $('#ModalMessage').modal('show');
        </script>
    <?php endif ?>

    <script>
        $(document).ready(function() {
            // Tombol hamburger (buka sidebar)
            $('#sidebarCollapse').on('click', function() {
                $('#sidebar').addClass('active');
                $('body').addClass('sidebar-open');
                $('#sidebarCollapse').hide(); // Sembunyikan tombol hamburger
            });
            // Tombol close (tutup sidebar)
            $('#sidebarCollapse2').on('click', function() {
                $('#sidebar').removeClass('active');
                $('body').removeClass('sidebar-open');
                $('#sidebarCollapse').show(); // Tampilkan tombol hamburger
            });
        });
    </script>

    <script>
        document.getElementById('sidebarCollapse').onclick = function() {
            document.body.classList.toggle('sidebar-open');
        };

        $(document).ready(function() {
            // Toggle sidebar dengan jQuery
            $('#sidebarCollapse, #sidebarCollapse2').on('click', function() {
                $('#sidebar').toggleClass('active');
                if ($('#sidebar').hasClass('active')) {
                    $('#main-logo').addClass('active');
                } else {
                    $('#main-logo').removeClass('active');
                }
            });
            $('.toc a').on('click', function(event) {
                if ($(window).width() <= 768) {
                    $('#sidebar').toggleClass('active');
                    if ($('#sidebar').hasClass('active')) {
                        $('#main-logo').addClass('active');
                    } else {
                        $('#main-logo').removeClass('active');
                    }
                }
            });
            if ($('#sidebar').hasClass('active')) {
                $('#main-logo').addClass('active');
            }
        });

        // Sticky sidebar (aman dari error)
        const sidebar = document.getElementById('sidebar');
        const sidebarContainer = document.getElementById('sidebar-container');
        const headerDivBottom = document.getElementById('header-bottom');
        const detailContent = document.getElementById('detail-content');
        const footer = document.getElementById('footer');
        let headerBottom = 0;
        if (headerDivBottom) {
            headerBottom = headerDivBottom.getBoundingClientRect().bottom + window.pageYOffset;
        }
        let footerBottom = 0;
        let footerOffsetTop = 0;
        if (detailContent && footer) {
            footerBottom = detailContent.offsetHeight - footer.offsetHeight;
            footerOffsetTop = footer.offsetHeight;
        }
        const updateSidebarPosition = () => {
            const scrollPosition = window.pageYOffset || document.documentElement.scrollTop;
            if (scrollPosition > headerBottom && scrollPosition < footerBottom) {
                if (sidebarContainer && sidebar) {
                    sidebarContainer.style.position = 'fixed';
                    sidebarContainer.style.top = '0';
                    sidebarContainer.style.width = `calc(${sidebar.offsetWidth}px)`;
                }
            } else {
                if (sidebarContainer) {
                    sidebarContainer.style.position = 'relative';
                    sidebarContainer.style.width = 'auto';
                }
            }
        };
        const initSidebarPosition = () => {
            const scrollPosition = window.pageYOffset || document.documentElement.scrollTop;
            if (scrollPosition > headerBottom && scrollPosition < footerBottom) {
                if (sidebarContainer && sidebar) {
                    sidebarContainer.style.position = 'fixed';
                    sidebarContainer.style.top = '0';
                    sidebarContainer.style.width = `${sidebar.offsetWidth}px`;
                }
            } else {
                if (sidebarContainer) {
                    sidebarContainer.style.position = 'relative';
                    sidebarContainer.style.width = 'auto';
                }
            }
        };
        // Cek window sebelum addEventListener
        if (typeof window !== 'undefined' && typeof updateSidebarPosition === 'function') {
            window.addEventListener('scroll', updateSidebarPosition);
        }
        if (typeof window !== 'undefined' && typeof initSidebarPosition === 'function') {
            window.addEventListener('load', initSidebarPosition);
        }
    </script>
</body>

</html>