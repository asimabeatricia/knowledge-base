<?= $this->extend('layout/template2'); ?>
<?= $this->section('content'); ?>

<link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">
<meta name="viewport" content="width=device-width, initial-scale=1">



<div class="mt-4 px-4">
    <div class="container px-2 px-md-4">
        <div class="d-flex align-items-center justify-content-between mb-3">
            <h1 style="color:#3A85D3;">Halaman Utama</h1>
            <div class="d-flex align-items-center">
                <?php if (in_groups('admin')) : ?>
                    <a href="/pages/create" class="btn btn-outline-primary me-2 ">
                        <i class="fa fa-pencil"></i> Buat
                    </a>
                    <a href="/pages/history" class="btn btn-outline-primary me-2 ml-2">
                        <i class="fa fa-history"></i> History
                    </a>
                <?php endif; ?>
                <?php if (in_groups('user')) : ?>
                    <div class="filter-btn-mobile mb-2">
                        <button type="button" class="btn btn-outline-primary" data-toggle="modal" data-target="#exampleModal">
                            <i class="fa fa-filter"></i> Filter
                        </button>
                    </div>
                <?php endif; ?>
            </div>
        </div>

        <hr style="border-top: 1px solid #EAEFF5;">

        <!-- Flash Modal -->
        <?php if (session()->getFlashdata('pesan')) : ?>
            <div id="ModalMessage" class="modal fade" tabindex="-1" role="dialog">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content shadow border-0" style="position: relative;">
                        <button type="button" class="custom-close-btn" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">
                                <svg width="18" height="18" viewBox="0 0 18 18" fill="none">
                                    <line x1="4" y1="4" x2="14" y2="14" stroke="#2471A3" stroke-width="2" stroke-linecap="round" />
                                    <line x1="14" y1="4" x2="4" y2="14" stroke="#2471A3" stroke-width="2" stroke-linecap="round" />
                                </svg>
                            </span>
                        </button>
                        <div class="modal-header" style="background: linear-gradient(to bottom right, #3A85D3, #5DAF57); border-bottom: none;">
                            <div class="d-flex justify-content-center w-100">
                                <img src="img/icon-park-solid_success.png" class="mb-2" style="height: 100px;">
                            </div>
                        </div>

                        <div class="modal-body text-center">
                            <h5 style="color: #3BAB47;"><b>Keren!</b></h5>
                            <p><?= session()->getFlashdata('pesan') ?></p>
                        </div>
                    </div>
                </div>
            </div>


            <script>
                $(document).ready(function() {
                    $('#ModalMessage').modal('show');
                });
            </script>
        <?php endif; ?>


        <!-- Grid Content -->
        <div class="mt-4">
            <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4 mt-3">
                <?php foreach ($manual as $m) : ?>
                    <div class="col">
                        <a href="/pages/manual/<?= $m['slug']; ?>" style="text-decoration: none;">
                            <div class="gradient-border">
                                <div class="tile-card">
                                    <div>
                                        <h5><b><?= $m['title']; ?></b></h5>
                                        <p>Aplikasi <?= ucfirst($m['category']); ?></p>
                                        <?php if (in_groups('admin')) : ?>
                                            <p style="font-size: 0.75rem; margin-top: 0.5rem;">
                                                <?php if ($m['status'] == 'draft') : ?>
                                                    <span class="badge bg-warning text-dark">Draft</span>
                                                <?php else : ?>
                                                    <span class="badge bg-success text-white">Published</span>
                                                <?php endif; ?>
                                            </p>
                                        <?php endif; ?>
                                    </div>
                                    <?php if (!empty($m['icon']) && $m['icon'] !== 'default.png') : ?>
                                        <img src="<?= base_url('/img/icons/' . esc($m['icon'])) ?>" class="tile-icon" alt="<?= esc($m['title']); ?>">
                                    <?php endif; ?>
                                    <i class="fa fa-chevron-right tile-chevron"></i>
                                </div>
                            </div>
                        </a>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</div>


<!-- Filter Modal -->
<?php if (in_groups('user')) : ?>
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content p-3">
                <form action="/pages/filter" method="post">
                    <?= csrf_field() ?>
                    <div class="modal-body">
                        <h5 class="modal-title mb-3" style="color: #3A85D3;">Filter berdasarkan kategori :</h5>
                        <div class="d-flex justify-content-around mb-3">
                            <div>
                                <input type="checkbox" name="kategori[]" value="internal" id="internal">
                                <label for="internal"> Internal</label>
                            </div>
                            <div>
                                <input type="checkbox" name="kategori[]" value="eksternal" id="eksternal">
                                <label for="eksternal"> Eksternal</label>
                            </div>
                        </div>
                        <div class="modal-footer d-flex justify-content-between">
                            <a href="/pages" class="btn btn-link" style="color: #3BAB47; ">Reset filter</a>
                            <button type="submit" name="submit" class="btn btn-success text-white">Terapkan Filter</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
<?php endif; ?>


<style>
    /* General Font */
    body {
        font-family: 'Inter', sans-serif;
    }

    .tile-card {
        position: relative;
        border-radius: 22px;
        min-height: 160px;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        padding: 1.2rem 1.2rem 1.5rem 1.5rem;
        background: #fff;
        border: none;
        color: #3A85D3;
        transition: 0.2s ease;
        z-index: 1;
    }

    .gradient-border {
        padding: 1.5px 1.5px;
        border-radius: 24px;
        background: linear-gradient(90deg, #D3DB29 0%, #72BC63 44%, #208CCC 100%);
        transition: box-shadow 0.2s;
    }

    .tile-card:hover {
        transform: translateY(-3px);
        background: linear-gradient(90deg, #D3DB29 0%, #72BC63 44%, #208CCC 100%);
        color: #fff;
        box-shadow: 0 10px 18px rgba(0, 0, 0, 0.1);
    }

    .tile-card h5 {
        font-size: 1rem;
        font-weight: 600;
        margin-bottom: 0.3rem;
        color: #3A85D3;
    }

    .tile-card p {
        font-size: 0.8rem;
        color: #6B7280;
        margin-bottom: 0;
    }

    .tile-icon {
        position: absolute;
        top: 1rem;
        right: 1rem;
        height: 70px;
        width: 80px;
        object-fit: contain;
    }

    .tile-chevron {
        align-self: flex-end;
        color: #3A85D3;
    }


    .tile-card:hover h5,
    .tile-card:hover p,
    .tile-card:hover .badge,
    .tile-card:hover .tile-chevron {
        color: #fff !important;
    }

    .tile-card:hover .tile-chevron {
        filter: brightness(200%);
    }

    .tile-card:hover .badge.bg-success {
        background: #fff !important;
        color: #3BAB47 !important;
    }

    .tile-card:hover .badge.bg-warning {
        background: #fff !important;
        color: #F4B400 !important;
    }

    .tile-card:hover .tile-icon {
        filter: brightness(100%) drop-shadow(0 2px 8px rgba(0, 0, 0, 0.10));
    }

    h3 {
        font-size: 1.5rem;
        font-weight: 600;
        margin-bottom: 1rem;
    }

    .row.row-cols-1 .col,
    .row.row-cols-md-2 .col,
    .row.row-cols-lg-3 .col {
        margin-bottom: 2rem;
    }

    .swal2-close.swal2-close-custom {
        font-size: 2rem;
        top: 10px;
        right: 10px;
    }

    .modal-footer .btn-success {
        border-radius: 20px !important;
        /* Atur sesuai kebutuhan, misal 8px */
        padding: 0.375rem 1rem;
        border: 1px solid #3BAB47;
        transition: background 0.2s;
    }

    input[type="checkbox"] {
        accent-color: #3A85D3;
    }

    @media (max-width: 1024px) {

        .main-content,
        .apps-wrapper {
            max-width: 98vw;
            padding: 1.5rem 0.5rem;
        }
    }

    @media (max-width: 768px) {

        .container,
        .container-fluid,
        .container-sm,
        .container-md,
        .container-lg,
        .container-xl,
        .container-xxl {
            padding-left: 0.7rem !important;
            padding-right: 0.7rem !important;
            width: 100% !important;
            max-width: 100vw !important;
            box-sizing: border-box;
        }

        .row {
            flex-direction: column !important;
            align-items: stretch !important;
            margin-left: 0 !important;
            margin-right: 0 !important;
        }

        .col,
        .col-12,
        .col-md-4 {
            width: 100% !important;
            max-width: 100% !important;
            min-width: 0 !important;
            margin-bottom: 2px !important;
            padding-left: 0 !important;
            padding-right: 0 !important;
            box-sizing: border-box;
        }

        .tile-card {
            min-height: 140px !important;
            padding: 1.2rem 1rem !important;
            font-size: 1rem;
            border-radius: 1.2rem;
            box-sizing: border-box;
            display: flex;
            flex-direction: row;
            align-items: center;
            gap: 0.7rem;
        }

        .tile-icon {
            height: 48px !important;
            width: 56px !important;
            top: 1rem !important;
            right: 1rem !important;
            position: absolute;
            object-fit: contain;
        }

        .tile-card h5 {
            font-size: 1.05rem !important;
        }

        .tile-card p {
            font-size: 0.9rem !important;
        }

        .d-flex.align-items-center.justify-content-between.mb-3 {
            flex-direction: row !important;
            align-items: center !important;
            justify-content: space-between !important;
            flex-wrap: nowrap !important;
            gap: 0.5rem !important;
            width: 100%;
        }

        .d-flex.align-items-center.justify-content-between.mb-3 h1 {
            font-size: 1.6rem !important;
            margin-bottom: 0 !important;
            white-space: nowrap !important;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .search-bar,
        input[type="search"] {
            width: 100% !important;
            max-width: 100vw !important;
            margin: 0 0 1rem 0 !important;
            min-width: 0 !important;
            display: block !important;
        }

        .filter-btn {
            display: flex !important;
            justify-content: flex-end !important;
            border-radius: 20px;
            width: 100%;
            flex-shrink: 0;
            margin-bottom: 0 !important;
        }
    }

    @media (max-width: 480px) {
        .tile-card {
            min-height: 90px;
            padding: 0.8rem 0.6rem;
            font-size: 0.97rem;
            border-radius: 0.8rem;
        }

        .tile-icon {
            height: 36px;
            width: 38px;
            top: 0.5rem;
            right: 0.5rem;
        }

        #chatbot-popup {
            width: 98vw !important;
            height: 90vh !important;
            left: 1vw !important;
            right: 1vw !important;
            bottom: 2vh !important;
            border-radius: 8px !important;
            max-height: 100vh !important;
        }

        #chatbot-popup iframe {
            width: 100% !important;
            height: 100% !important;
            border-radius: 8px !important;
            display: block;
        }

        #chatbot-toggle {
            right: 6px !important;
            bottom: 6px !important;
            width: 40px !important;
            height: 40px !important;
        }
    }

    body,
    html {
        overflow-x: hidden !important;
        max-width: 100vw !important;
    }

    .custom-close-btn {
        position: absolute;
        top: 20px;
        right: 20px;
        width: 36px;
        height: 36px;
        background: #fff;
        border-radius: 50%;
        border: 1px solid #e0e0e0;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.10);
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        z-index: 10;
        transition: box-shadow 0.2s, background 0.2s;
        padding: 0;
    }

    .custom-close-btn:hover {
        background: #f0f6fa;
        box-shadow: 0 4px 16px rgba(58, 133, 211, 0.13);
    }

    .custom-close-btn span svg {
        display: block;
    }

    #chatbot-toggle {
        position: fixed;
        bottom: 32px;
        right: 32px;
        z-index: 1000;
        background: #2986f5;
        color: #fff;
        border: none;
        border-radius: 50%;
        width: 56px;
        height: 56px;
        box-shadow: 0 4px 16px rgba(0, 0, 0, 0.15);
        cursor: pointer;
        font-size: 2rem;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    #chatbot-popup {
        display: none;
        position: fixed;
        bottom: 100px;
        right: 32px;
        z-index: 2000;
        box-shadow: 0 8px 32px rgba(0, 0, 0, 0.18);
        border-radius: 24px;
        background: transparent;
        overflow: hidden;
        width: 440px;
        height: 600px;
        max-width: 100%;
        max-height: 100%;
    }

    #chatbot-popup.show {
        display: block !important;
    }

    #chatbot-popup iframe {
        width: 440px;
        height: 600px;
        border-radius: 24px;
        border: none;
        display: block;
    }

    @media (max-width: 768px) {
        #chatbot-popup {
            width: 92vw !important;
            height: 68vh !important;
            left: 4vw !important;
            right: 4vw !important;
            bottom: 6vh !important;
            top: auto !important;
            border-radius: 12px !important;
            box-shadow: 0 4px 18px rgba(0, 0, 0, 0.09) !important;
            padding: 0 !important;
            overflow: hidden !important;
            display: none;
        }

        #chatbot-popup.show {
            display: block !important;
        }

        #chatbot-popup iframe {
            width: 100% !important;
            height: 100% !important;
            border-radius: 12px !important;
            display: block;
        }
    }

    @media (max-width: 480px) {
        #chatbot-popup {
            width: 98vw !important;
            height: 90vh !important;
            left: 1vw !important;
            right: 1vw !important;
            bottom: 2vh !important;
            border-radius: 8px !important;
            max-height: 100vh !important;
        }

        #chatbot-popup iframe {
            width: 100% !important;
            height: 100% !important;
            border-radius: 8px !important;
            display: block;
        }
    }

    #ModalMessage .modal-dialog {
        max-width: 420px;
    }

    #ModalMessage .modal-content {
        min-height: 240px;
        border-radius: 24px;
        padding: 0;
        display: flex;
        flex-direction: column;
        justify-content: flex-start;
        overflow: hidden;
    }

    #ModalMessage .modal-header {
        min-height: 140px;
        border-radius: 24px 24px 0 0;
        padding: 0;
        background: linear-gradient(to bottom right, #3A85D3, #5DAF57);
        display: flex;
        align-items: center;
        justify-content: center;
        position: relative;
    }

    #ModalMessage .modal-header .d-flex {
        width: 100%;
        justify-content: center;
        align-items: center;
        margin-top: 24px;
        margin-bottom: 24px;
    }

    #ModalMessage .modal-body {
        padding: 1.2rem 1.5rem 1.5rem 1.5rem;
        border-radius: 0 0 24px 24px;
        background: #fff;
    }
</style>

<?php if (in_groups('user')) : ?>
    <button id="chatbot-toggle" style="
    position: fixed;
    bottom: 32px;
    right: 32px;
    z-index: 1000;
    background: #2986f5;
    color: #fff;
    border: none;
    border-radius: 50%;
    width: 56px;
    height: 56px;
    box-shadow: 0 4px 16px rgba(0,0,0,0.15);
    cursor: pointer;
    font-size: 2rem;
    display: flex;
    align-items: center;
    justify-content: center;
">
        <img src="<?= base_url('img/chat-bot.png') ?>" alt="Chatbot" style="width:32px;">
    </button>

    <!-- Popup Chatbot -->
    <div id="chatbot-popup">
        <iframe src="/chatbot"></iframe>
    </div>

    <script>
        const chatbotToggle = document.getElementById('chatbot-toggle');
        const chatbotPopup = document.getElementById('chatbot-popup');

        function toggleChatbot(e) {
            e.stopPropagation();
            chatbotPopup.classList.toggle('show');
        }

        chatbotToggle.addEventListener('click', toggleChatbot);

        // Klik di luar popup untuk menutup (mobile & desktop)
        document.addEventListener('click', function(e) {
            if (
                chatbotPopup.classList.contains('show') &&
                !chatbotPopup.contains(e.target) &&
                e.target !== chatbotToggle
            ) {
                chatbotPopup.classList.remove('show');
            }
        });

        // Agar klik di dalam popup tidak menutup popup
        chatbotPopup.addEventListener('click', function(e) {
            e.stopPropagation();
        });
    </script>
<?php endif; ?>

<?= $this->endSection(); ?>