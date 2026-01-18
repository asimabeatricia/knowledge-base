<?php

use Myth\Auth\Collectors\Auth;
use App\Models\ManualModel;


$this->manualModel = new ManualModel();
$internalApp = $this->manualModel->getAllAppbyCategory('internal');
$externalApp = $this->manualModel->getAllAppbyCategory('eksternal');

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

    <!-- css -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="/css/style.css">
    <!-- <script src="/quill/image-resize.min.js"></script> -->
    <!-- <script src="/template.js"></script>  -->
    <link href='https://fonts.googleapis.com/css?family=Poppins' rel='stylesheet'>
    <title><?= isset($title) ? $title : 'Halaman Utama'; ?></title>
    <?php if (!isset($title)) {
        $title = 'Halaman Utama';
    } ?>
</head>


<body>
    <div class="wrapper">
        <!-- Sidebar  -->
        <nav id="sidebar">
            <div class="sidebar-header">
                <div class="container">
                    <div class="row no-gutters align-items-center justify-content-between">
                        <a class="navbar-brand d-inline-block p-1 m-0" href="/pages" style="max-width:70%;">
                            <img src="/img/logoPutih.png" alt="" class="img-fluid">
                        </a>
                        <button type="button" id="sidebarCollapse2" class="btn btn-primary d-inline-block rounded-circle ml-auto" style="background:#3A85D3">
                            <i class="fa fa-times"></i>
                            <span class="sr-only">Toggle Menu</span>
                        </button>
                    </div>
                </div>
            </div>

            <ul class="list-unstyled components px-3">

                <li class="active">
                    <a href="/">
                        <i class="fa fa-home"></i>
                        Home
                    </a>
                </li>
                <?php if (getenv('appFlag')) : ?>
                    <li>
                        <a href="#internalSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle border-bottom">Internal</a>
                        <ul class="collapse list-unstyled" id="internalSubmenu">
                            <?php foreach ($internalApp  as $i) : ?>
                                <li>
                                    <a href="/pages/<?= $i['slug']; ?>"><?= $i['judul']; ?></a>
                                </li>
                            <?php endforeach ?>
                        </ul>
                    </li>

                    <li>
                        <a href="#eksternalSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle border-bottom">Eksternal</a>
                        <ul class="collapse list-unstyled" id="eksternalSubmenu">
                            <?php foreach ($externalApp  as $e) : ?>
                                <li>
                                    <a href="/pages/<?= $e['slug']; ?>"><?= $e['judul']; ?></a>
                                </li>
                            <?php endforeach ?>
                        </ul>
                    </li>

                <?php else : ?>
                    <?php foreach ($externalApp  as $e) : ?>
                        <li>
                            <a href="/pages/<?= $e['slug']; ?>"><?= $e['judul']; ?></a>
                        </li>
                    <?php endforeach ?>

                <?php endif ?>
                <li>
                    <a href="/whatsnew">
                        <i class="fa fa-bell"></i>
                        What's New
                    </a>
                </li>
            </ul>
        </nav>


        <!-- Page Content  -->
        <div id="content">
            <?php if (in_groups('admin')) : ?>
                <div class="home-background">
                    <?= $this->include('layout/navbar'); ?>
                    <?php if (!preg_match('/\/pages\/(manual|create)/', current_url())) : ?>
                        <div class="home-background-content col justify-content-center d-flex align-items-center py-5"
                            style="color:white; height: fit-content; background-repeat: no-repeat; background-size: cover; background-position: center;">
                            <div class="text-white my-5">
                                <h1 class="font-weight-bold " style="text-align: center;">Selamat Datang, Admin!</h1>
                                <h3 class="font-weight-light " style="text-align: center; font-style:italic;">Kelola User Manual dengan Baik</h3>
                            </div>
                        </div>
                    <?php endif ?>
                </div>
            <?php else: ?>
                <?= $this->include('layout/navbar'); ?>
            <?php endif; ?>

            <?= $this->renderSection('content'); ?>
            <footer>
                <?= $this->include('layout/footer'); ?>
            </footer>
        </div>

        <style>
            .body {
                font-family: Tahoma, sans-serif;
            }

            #sidebar .btn-danger {
                margin-top: 20px;
            }

            .home-background {
                background-image: url('/img/backgroundHome2.png');
                background-repeat: no-repeat;
                background-size: cover;
                background-position: center;
                width: 100%;
                height: 400px;
                position: relative;
            }

            .navbar {
                background: transparent !important;
                box-shadow: none !important;
            }

            .home-background-content {
                padding-top: 60px;
            }

            @media (max-width: 768px) {
                .home-background {
                    height: auto !important;
                    min-height: unset !important;
                    padding-bottom: 16px !important;
                }

                .home-background-content {
                    padding: 0 0.5rem !important;
                    margin: 0 !important;
                    height: auto !important;
                    min-height: unset !important;
                    display: block !important;
                    align-items: unset !important;
                    justify-content: unset !important;
                }

                .home-background-content .my-5 {
                    margin: 0.5rem 0 0 0 !important;
                }

                .home-background-content h1,
                .home-background-content h3 {
                    font-size: 3rem !important;
                    margin-bottom: 0.3rem !important;
                    text-align: center !important;
                }

                .sidebar-header .container,
                .sidebar-header .row {
                    padding: 0 !important;
                    margin: 0 !important;
                    width: 100% !important;
                    display: flex !important;
                    flex-direction: row !important;
                    align-items: center !important;
                    justify-content: space-between !important;
                    flex-wrap: nowrap !important;
                }

                .sidebar-header .navbar-brand {
                    max-width: 65% !important;
                    margin-bottom: 0 !important;
                    padding: 0 !important;
                    display: flex !important;
                    align-items: center !important;
                }

                .sidebar-header .navbar-brand img {
                    max-height: 60px !important;
                    width: auto !important;
                }

                #sidebarCollapse2 {
                    margin-left: 0 !important;
                    margin-bottom: 0 !important;
                    align-self: center !important;
                    position: static !important;
                }
            }

            @media (max-width: 480px) {
                .home-background-content h1 {
                    font-size: 1rem !important;
                }

                .home-background-content h3 {
                    font-size: 0.85rem !important;
                }
            }
        </style>



        <!-- jQuery (FULL version) -->
        <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

        <!-- Popper.js & Bootstrap -->
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>


        <!-- bs-custom-file-input -->
        <script src="https://cdn.jsdelivr.net/npm/bs-custom-file-input/dist/bs-custom-file-input.min.js"></script>


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
            <?php if (session()->getFlashdata('pesan')) : ?>
                $('#ModalMessage').modal('show');
            <?php endif ?>

            $(document).ready(function() {
                bsCustomFileInput.init();

                $('#sidebarCollapse').on('click', function() {
                    $('#sidebar').toggleClass('active');
                    if ($('#sidebar').hasClass('active')) {
                        $('#main-logo').addClass('active');
                    } else {
                        $('#main-logo').removeClass('active');
                    }
                });
                $('#sidebarCollapse2').on('click', function() {
                    $('#sidebar').toggleClass('active');
                    if ($('#sidebar').hasClass('active')) {
                        $('#main-logo').addClass('active');
                    } else {
                        $('#main-logo').removeClass('active');
                    }
                });

                if ($('#sidebar').hasClass('active')) {
                    $('#main-logo').addClass('active');
                }

                $('.lihat-topik-btn').on('click', function(e) {
                    e.stopPropagation();
                    $('#sidebar').removeClass('active');
                });
            });
        </script>



</body>

</html>