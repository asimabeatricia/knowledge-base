<?php helper('url'); ?>
<?= $this->extend('layout/template3'); ?>
<?= $this->section('content'); ?>

<head>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>


<body>
    <div class=" manual-header justify-content-between d-flex align-items-center p-0 p-sm-1">
        <a href="/pages" class="d-flex align-items-center ml-5">
            <img src="/img/backLogo.png" alt="" class="m-2" style="max-height:25px">
            <p class="d-none d-md-flex m-0">Kembali ke Menu Awal</p>
        </a>
        <h1 class="card-title"><?= $manual['title']; ?></h1>
        <br>
    </div>


    <!-- Sidebar -->
    <div class="wrapper" id="wrapper">
        <nav id="sidebar" class="shadow" style="background-color: white;">
            <div class="sidebar-header d-flex flex-column px-3 py-3" style="background-color: white; position: sticky; top: 0; z-index: 2;">
                <div class="d-flex align-items-center justify-content-between w-100 mt-5">
                    <h1 class="sidebar-title m-0 ml-3" style="color: #3A85D3; font-size:2rem; font-weight:500; white-space:nowrap; overflow:hidden; text-overflow:ellipsis;">Daftar Isi</h1>
                    <button type="button" id="sidebarCollapse2" class="btn btn-primary d-inline-block rounded-circle mr-1" style="background:#3A85D3">
                        <i class="fa fa-times"></i>
                        <span class="sr-only">Toggle Menu</span>
                    </button>
                </div>
                <div class="mt-3 mb-2 px-2 w-100">
                    <a href="/pages" class="d-flex align-items-center" style="text-decoration:none;">
                        <img src="/img/backLogo.png" alt="" style="max-height:25px; margin-right:10px;">
                        <span style="color:#3A85D3; font-weight:500; font-size:1rem;">Kembali ke Menu Awal</span>
                    </a>
                </div>
            </div>
            <div class="sidebar-content px-3" style="overflow-y: auto; max-height: calc(100vh - 80px);">
                <div data-toc style="color:black;" class="toc"></div>
            </div>
        </nav>

        <div id="main-content">
            <div class="container mt-4" id="detail-content" data-content>
                <div class="row">
                    <div class="col-1" id="main-logo">
                        <div class="container">
                            <div class="row align-items-center mt-4">
                            </div>
                        </div>
                    </div>

                    <div class="ml-4 col-10">
                        <div class="row mt-3">
                            <div class="col d-flex align-items-end">
                                <div class="d-flex flex-column mb-5">
                                    <p class="m-0"><b>Last Updated: </b><?= $manual['created_at']; ?></p>
                                    <p class="card-text m-0"><b> Editor : </b><?= $manual['editor']; ?></p>
                                    <p class="card-text m-0"><b> Version : </b><?= $manual['versioning']; ?></p>
                                </div>
                            </div>
                            <div class="col d-flex justify-content-end">
                                <div class="d-inline mx-2">
                                    <button type="button"
                                        class="btn btn-primary rounded-lg bg-white btn-deskripsi"
                                        style="border-color:#3A85D3; color:#3A85D3;"
                                        data-slug="<?= $manual['slug']; ?>">
                                        <i class="fa fa-book"></i>
                                        Deskripsi
                                    </button>
                                </div>


                                <?php if (in_groups('admin')) : ?>
                                    <div class="d-inline mx-2">
                                        <a href="<?= base_url('pages/edit/' . $manual['id']) ?>" class="btn btn-primary rounded-lg bg-white" style="border-color:#3A85D3; color:#3A85D3;">
                                            <i class="fa fa-pencil"></i>
                                            Edit
                                        </a>
                                    </div>

                                    <div class="d-inline mx-2">
                                        <a href="<?= base_url('pages/history/' . $manual['slug']) ?>" class="btn btn-primary rounded-lg bg-white" style="border-color:#3A85D3; color:#3A85D3;">
                                            <i class="fa fa-history"></i>
                                            History
                                        </a>
                                    </div>

                                    <form action="/pages/<?= $manual['id']; ?>" method="post" class="d-inline" style="border-color:#3A85D3; color:#3A85D3;">
                                        <?= csrf_field(); ?>
                                        <input type="hidden" name="_method" value="DELETE">
                                        <button type="submit" class="btn rounded-lg bg-white ml-2 delete-btn" style="border-color:#3A85D3; color:#3A85D3;" onclick="confirmDelete(event, this)">
                                            <i class="fa fa-trash"></i> Delete
                                        </button>
                                    </form>
                                    <br>
                                <?php endif ?>
                            </div>
                        </div>

                        <div class="row justify-content-center" id="content">
                            <div class="col">
                                <div data-content>
                                    <div class="manual-content">
                                        <?= $manual['content'] ?>
                                    </div>
                                </div>

                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


            <!-- Original modal -->
            <div class="modal fade" id="DescModal" tabindex="-1" role="dialog" aria-labelledby="DescModalTitle" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document" style="max-width: 70vw;">
                    <div class="modal-content" style="min-width: 60vw;">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLongTitle">Deskripsi</h5>
                            <div class="d-flex">
                                <?php if (in_groups('admin')) : ?>
                                    <button type="button" class="w-fit border-0 btn btn-primary mx-2 d-block bg-white" id="editButton" style="border-color:#3A85D3; color:#3A85D3;" onclick="openEditModal('<?= esc($manual['slug']) ?>')">
                                        <span aria-hidden="true"><i class="fa fa-pencil"></i></span>
                                    </button>
                                <?php endif ?>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        </div>
                        <div class="modal-body" id="modalBody">
                            <div class="text-center text-muted">Memuat data...</div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>


            <!-- New modal with form -->
            <?php if (in_groups('admin')) : ?>
                <?php if (session()->getFlashdata('success')): ?>
                    <div id="customSuccessModal" class="custom-modal">
                        <div class="custom-modal-content">
                            <div class="custom-modal-header">
                                <button class="custom-modal-close" onclick="document.getElementById('customSuccessModal').style.display='none'" aria-label="Close">&times;</button>
                                <div class="custom-modal-icon">
                                    <img src="/img/icon-park-solid_success.png" alt="Success" style="width:80px; height:80px;">
                                </div>
                            </div>
                            <div class="custom-modal-body">
                                <h2 style="color:#2471A3; font-weight:700; margin-bottom:0.5rem;">Keren!</h2>
                                <p style="color:#888;"><?= session()->getFlashdata('success'); ?></p>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>

                <div class="modal fade" id="EditModal" tabindex="-1" role="dialog" aria-labelledby="EditModalTitle" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document" style="max-width: 70vw;">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="EditModalTitle">Edit Deskripsi</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body" style="max-height:80vh; overflow-y: auto;">
                                <form action="<?= base_url('/pages/saveOrUpdateManual') ?>" method="post" id="form">
                                    <?= csrf_field(); ?>
                                    <input type="hidden" name="slug" id="slug" value="<?= esc($slug ?? '') ?>">
                                    <div class="form-group">
                                        <label for="layanan" class="col-form-label">Layanan TI</label>
                                        <input type="text" class="form-control" id="layanan" name="layanan" value="">
                                    </div>
                                    <div class="form-group">
                                        <label for="komponen" class="col-form-label">Komponen Layanan</label>
                                        <textarea class="form-control" id="komponen" name="komponen"></textarea>
                                    </div>
                                    <div class="form-group">
                                        <label for="deskripsi" class="col-form-label">Deskripsi</label>
                                        <textarea class="form-control" id="deskripsi" name="deskripsi" autofocus></textarea>
                                    </div>
                                    <div class="form-group">
                                        <label for="keterkaitan" class="col-form-label">Keterkaitan Dengan Layanan Lain</label>
                                        <textarea class="form-control" id="keterkaitan" name="keterkaitan"></textarea>
                                    </div>
                                    <div class="form-group">
                                        <label for="penyedia" class="col-form-label">Penyedia Layanan</label>
                                        <textarea class="form-control" id="penyedia" name="penyedia"></textarea>
                                    </div>
                                    <div class="form-group">
                                        <label for="jam" class="col-form-label">Jam Layanan</label>
                                        <input type="text" class="form-control" id="jam" name="jam" value="">
                                    </div>
                                    <div class="form-group">
                                        <label for="target" class="col-form-label">Target Ketersediaan</label>
                                        <input type="text" class="form-control" id="target" name="target" value="">
                                    </div>
                                    <div class="form-group">
                                        <label for="jamDukungan" class="col-form-label">Jam Dukungan</label>
                                        <input type="text" class="form-control" id="jamDukungan" name="jamDukungan" value="">
                                    </div>
                                    <div class="form-group">
                                        <label for="unit" class="col-form-label">Unit Bisnis Pemilik Layanan</label>
                                        <textarea class="form-control" id="unit" name="unit"></textarea>
                                    </div>
                                    <div class="form-group">
                                        <label for="lastVersion" class="col-form-label">Versi Terakhir</label>
                                        <input type="text" class="form-control" id="lastVersion" name="lastVersion" value="">
                                    </div>
                                    <div class="modal-footer">
                                        <button type="submit" class="btn" id="saveEdit" style="background-color: #3A85D3; color:white;">Save</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endif ?>
        </div>
    </div>
</body>

<style>
    pre {
        font-family: Tahoma, sans-serif;
    }

    .wrapper {
        display: flex;
        width: 100%;
        overflow-x: hidden;
    }

    body {
        overflow-x: hidden;
    }

    #sidebar {
        width: 260px;
        min-width: 220px;
        max-width: 300px;
        background: #fff;
        padding: 0 24px;
        display: block;
        flex-shrink: 0;
        margin: 0;
        box-shadow: 0 0 8px rgba(0, 0, 0, 0.04);
    }

    #main-content {
        flex: 1;
        max-width: 1200px;
        min-width: 700px;
        margin: 0 auto;
        padding: 0 24px;
        transition: margin-left 0.3s;
        display: flex;
        flex-direction: column;
    }

    body.sidebar-open #main-content {
        margin-left: 320px;
    }

    body:not(.sidebar-open) #main-content {
        margin-left: auto;
        margin-right: auto;
    }

    .manual-content ul,
    .manual-content ol {
        padding-left: 1.5em !important;
        /* default padding for bullets */
        margin-left: 0 !important;
        white-space: normal !important;
    }

    .manual-content li {
        margin-bottom: 0.5em;
        text-indent: 0 !important;
        padding-left: 0 !important;
        white-space: normal !important;
    }

    .manual-content li>* {
        margin-left: 0 !important;
        padding-left: 0 !important;
        white-space: normal !important;
    }

    .manual-content li pre {
        display: inline !important;
        white-space: normal !important;
        margin: 0 !important;
        padding: 0 !important;
        background: none !important;
        border: none !important;
    }

    @media (max-width: 1200px) {
        #main-content {
            max-width: 98vw !important;
            min-width: 0 !important;
        }
    }

    @media (max-width: 1000px) {
        #sidebar {
            position: absolute;
            width: 80vw;
            left: 0;
            top: 0;
            height: 100vh;
            z-index: 10;
            display: none;
        }

        #sidebar.active {
            display: block;
        }

        #main-content {
            margin-left: 0 !important;
            margin-right: 0 !important;
            max-width: 100vw !important;
            min-width: 0 !important;
        }

        .row.mt-3>.col {
            width: 100% !important;
            flex: 0 0 100% !important;
            max-width: 100% !important;
            display: block !important;
        }

        .row.mt-3 {
            flex-direction: column !important;
            align-items: stretch !important;
        }

        .row.mt-3 .d-flex {
            flex-direction: column !important;
            align-items: stretch !important;
            width: 100% !important;
        }

        .row.mt-3 .d-inline,
        .row.mt-3 form.d-inline {
            display: block !important;
            width: 100% !important;
            margin: 0 0 8px 0 !important;
        }

        .row.mt-3 .btn,
        .row.mt-3 button.btn,
        .row.mt-3 a.btn {
            width: 100% !important;
            margin: 0 0 8px 0 !important;
            display: block !important;
            text-align: center !important;
            min-width: 0 !important;
            max-width: 100% !important;
            box-sizing: border-box !important;
        }
    }


    .row.mt-3 button.btn,
    .row.mt-3 a.btn {
        width: 100% !important;
        margin: 0 0 8px 0 !important;
        display: block !important;
        text-align: center !important;
    }

    /* END BUTTON GROUP */

    .sidebar-header {
        margin-top: 0 !important;
    }

    .manual-content img,
    img {
        max-width: 100% !important;
        height: auto !important;
    }

    .manual-content,
    pre {
        word-break: break-word !important;
        white-space: pre-wrap !important;
    }

    @media (max-width: 480px) {
        .manual-header {
            padding: 0.7rem 0.3rem !important;
            min-height: 50px !important;
        }

        .manual-header h1 {
            font-size: 1rem !important;
        }

        #sidebar {
            padding: 0 2px !important;
        }

        #main-content {
            padding: 0 2px !important;
        }

        .row.mt-3 .btn-deskripsi {
            width: auto !important;
            min-width: 110px !important;
            padding: 6px 18px !important;
            font-size: 1rem !important;
            text-align: center !important;
            margin: 0 !important;
            border-radius: 8px !important;
            box-sizing: border-box !important;
        }

        .row.mt-3 .col.d-flex.justify-content-end {
            justify-content: flex-end !important;
            display: flex !important;
        }
    }




    [data-toc] ul li a {
        transition: background 0.2s, color 0.2s;
        padding: 6px 12px;
        border-radius: 6px;
        display: block;
    }

    [data-toc] ul li a:hover,
    [data-toc] ul li a.active-toc {
        background: #e3f1fb;
        color: #226DA8 !important;
        text-decoration: none;
    }

    .content {
        flex: 1;
        padding-left: 24px;
    }

    input[type="text"] {
        flex-grow: 1;
        margin-right: 10px;
        padding: 5px;
        border-radius: 4px;
        border: 1px solid #ccc;
    }

    .manual-header {
        width: 100vw;
        position: relative;
        left: 50%;
        right: 50%;
        margin-left: -50vw;
        margin-right: -50vw;
        background-image: url("<?= base_url('img/judulBgDetail.png'); ?>");
        background-size: cover;
        background-repeat: no-repeat;
        background-position: center;
        color: white;
        min-height: 150px;
        max-height: 150px;
        padding: 2rem 1rem;
        box-sizing: border-box;
        z-index: 1;
    }

    .manual-header h1 {
        font-size: 1.8rem;
        margin-bottom: 0.5rem;
    }

    .custom-modal {
        position: fixed;
        z-index: 9999;
        left: 0;
        top: 0;
        width: 100vw;
        height: 100vh;
        background: rgba(0, 0, 0, 0.2);
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .custom-modal-content {
        background: #fff;
        border-radius: 20px;
        overflow: hidden;
        width: 400px;
        max-width: 90vw;
        box-shadow: 0 8px 32px rgba(0, 0, 0, 0.15);
    }

    .custom-modal-header {
        background: linear-gradient(90deg, #3A85D3 0%, #4EC18F 100%);
        padding: 2rem 1rem 1rem 1rem;
        position: relative;
        text-align: center;
    }

    .custom-modal-icon {
        margin: 0 auto;
    }

    .custom-modal-close {
        position: absolute;
        top: 20px;
        right: 20px;
        width: 48px;
        height: 48px;
        background: rgba(255, 255, 255, 0.95);
        border-radius: 50%;
        box-shadow: 0 4px 16px rgba(0, 0, 0, 0.18);
        border: none;
        font-size: 2rem;
        color: #3A85D3;
        font-weight: bold;
        cursor: pointer;
        z-index: 10;
        display: flex;
        align-items: center;
        justify-content: center;
        transition: box-shadow 0.2s, background 0.2s;
    }

    .custom-modal-close:hover {
        background: #f0f6fa;
        box-shadow: 0 8px 24px rgba(58, 133, 211, 0.25);
    }

    .custom-modal-body {
        padding: 2rem 1rem 2rem 1rem;
        text-align: center;
    }
</style>



<script src="https://cdn.jsdelivr.net/npm/tocbot@4.20.1/dist/tocbot.min.js"></script>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/tocbot@4.20.1/dist/tocbot.css">


<script>
    // document.addEventListener('DOMContentLoaded', () => {
    //     const searchInput = document.getElementById('searchInput');
    //     const prevButton = document.getElementById('prevButton');
    //     const nextButton = document.getElementById('nextButton');
    //     const closeButton = document.getElementById('closeButton');
    //     const content = document.querySelector('.content');

    //     let searchTerms = '';

    // const findText = () => {
    //     if (searchTerms.trim() === '') return;

    //     const found = window.find(searchTerms, false, false, true);
    // };

    // const executeSearch = () => {
    //     searchTerms = searchInput.value;
    //     findText();
    // };



    // searchInput.addEventListener('keydown', (event) => {
    //     if (event.keyCode === 13) { // Check if Enter key is pressed
    //         executeSearch();
    //         event.preventDefault(); // Prevent default Enter key behavior (e.g., form submission)
    //     }
    // });

    // prevButton.addEventListener('click', () => {
    //     const found = window.find(searchTerms, false, true, true);
    // });

    // nextButton.addEventListener('click', () => {
    //     const found = window.find(searchTerms, false, false, true);
    // });

    // closeButton.addEventListener('click', () => {
    //     searchInput.value = '';
    //     searchTerms = '';
    //     window.find('', false, false, true);
    // });
    // });
</script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const content = document.querySelector('[data-content]');
        const tocContainer = document.querySelector('[data-toc]');
        if (!content || !tocContainer) return;

        const headings = content.querySelectorAll('h1, h2, h3, h4, h5, h6');
        if (headings.length === 0) {
            tocContainer.innerHTML = '<em>Tidak ada daftar isi</em>';
            return;
        }

        let tocHTML = '<ul class="list-unstyled">';
        headings.forEach(function(heading, idx) {
            if (!heading.id) {
                heading.id = 'toc-' + idx;
            }
            tocHTML += `<li style="margin-left:${(parseInt(heading.tagName[1])-1)*16}px">
            <a href="#${heading.id}" style="color:#3A85D3;text-decoration:none;">${heading.innerText}</a>
        </li>`;
        });
        tocHTML += '</ul>';
        tocContainer.innerHTML = tocHTML;
    });
</script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const tocLinks = document.querySelectorAll('[data-toc] ul li a');
        tocLinks.forEach(link => {
            link.addEventListener('click', function() {
                tocLinks.forEach(l => l.classList.remove('active-toc'));
                this.classList.add('active-toc');
            });
        });
    });
</script>

<script>
    function openEditModal(slug) {
        $('#DescModal').modal('hide');

        $.get('/pages/getManualDesc/' + slug, function(response) {
            if (response.status === 'success') {
                let data = response.data;
                $('#slug').val(data.slug);
                $('#layanan').val(data.layanan);
                $('#komponen').val(data.komponen);
                $('#deskripsi').val(data.deskripsi);
                $('#keterkaitan').val(data.keterkaitan);
                $('#penyedia').val(data.penyedia);
                $('#jam').val(data.jam);
                $('#target').val(data.target);
                $('#jamDukungan').val(data.jamDukungan);
                $('#unit').val(data.unit);
                $('#lastVersion').val(data.lastVersion);
                $('#form').attr('action', '/pages/updateDesc/' + data.slug);
                $('#EditModal').modal('show');
            } else {
                alert('Data tidak ditemukan');
            }
        });
        $('#DescModal').off('hidden.bs.modal');
    }
</script>

<script>
    $(document).ready(function() {
        $(document).on('click', '.btn-deskripsi', function() {
            var slug = $(this).data('slug');
            $('#modalBody').html('<div class="text-center text-muted">Memuat data...</div>');
            $.get('/pages/getManualDesc/' + slug, function(response) {
                if (response.status === 'success') {
                    $('#modalBody').html(`
                    <p><b>Layanan TI :</b> ${response.data.layanan || '-'}</p>
                    <p class="m-0"><b>Komponen Layanan : </b><br></p>
                    <pre>${response.data.komponen || '-'}</pre>
                    <p class="m-0"><b>Deskripsi :</b><br></p>
                    <pre>${response.data.deskripsi || '-'}</pre>
                    <p class="m-0"><b>Keterkaitan Dengan Layanan Lain :</b><br></p>
                    <pre>${response.data.keterkaitan || '-'}</pre>
                    <p class="m-0"><b>Penyedia Layanan :</b><br></p>
                    <pre>${response.data.penyedia || '-'}</pre>
                    <p><b>Jam Layanan :</b> ${response.data.jam || '-'}</p>
                    <p><b>Target Ketersediaan Layanan : </b><br> ${response.data.target || '-'}</p>
                    <p><b>Jam Dukungan : </b><br> ${response.data.jamDukungan || '-'}</p>
                    <p class="m-0"><b>Unit Bisnis Pemilik Layanan :<br></b></p>
                    <pre>${response.data.unit || '-'}</pre>
                    <p class="m-0"><b>Versi Terakhir:<br></b></p>
                    <pre>${response.data.lastVersion || '-'}</pre>
                `);
                } else {
                    $('#modalBody').html('<div class="text-danger">Data tidak ditemukan</div>');
                }
            });
            $('#DescModal').modal('show');
        });
    });
</script>

<script>
    function confirmDelete(event, button) {
        event.preventDefault();

        Swal.fire({
            title: 'Hapus',
            text: 'Apakah Anda yakin untuk menghapus halaman ini?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Hapus',
            cancelButtonText: 'Batalkan',
            confirmButtonColor: '#d33',
            cancelButtonColor: 'gray'
        }).then((result) => {
            if (result.isConfirmed) {
                button.closest('form').submit();
            }
        });
    }
</script>

<?= $this->endSection(); ?>