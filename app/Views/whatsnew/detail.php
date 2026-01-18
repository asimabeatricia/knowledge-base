<?= $this->extend('layout/template3'); ?>
<?= $this->section('content'); ?>

<head>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>


<div class="card mx-auto my-3" style="max-width: 75%;">
    <div class="card-body p-0">
        <div id="header-bottom" class="col justify-content-between d-flex align-items-center p-0 p-sm-1" style="color:white; background-image: url(/img/judulBgDetail.png); min-height:100px; max-height:200px; height:20%;">
            <a href="/whatsnew" class="d-flex align-items-center">
                <img src="/img/backLogo.png" alt="" class="m-2" style="max-height:25px">
            </a>
            <div>
                <h5 class="text-center mt-5 mb-0">What's New in</h5>
                <h1 class="card-title text-center mb-5"><?= $new['nama']; ?></h1>
            </div>
            <br>
        </div>

        <div class="wrapper" id="wrapper">
            <div class="container mt-4" id="detail-content">
                <div class="row">
                    <div class="col-1" id="main-logo">
                        <div class="container">
                            <div class="row align-items-center mt-4">
                                <button type="button" id="sidebarCollapse" class=" btn btn-primary d-inline-block rounded-circle" style="background:#3A85D3">
                                    <i class="fa fa-bars"></i>
                                    <span class="sr-only">Toggle Menu</span>
                                </button>
                            </div>
                        </div>
                    </div>

                    <div class=" col-12">
                        <div class="row mt-3">
                            <div class="col d-flex">
                                <div class="d-flex flex-column">
                                    <p class="m-0"><b>Tanggal Rilis: </b><?= $new['tanggal']; ?></p>
                                    <p class=" m-0"><b>Version : </b><?= $new['versi']; ?></p>
                                </div>
                            </div>
                            <div class="col d-flex justify-content-end align-items-center">
                                <?php if (!empty($new) && isset($new['id']) && in_groups('admin')): ?>
                                    <!-- Tombol Edit -->
                                    <a href="<?= base_url('whatsnew/edit/' . $new['slug']); ?>" class="btn btn-outline-primary mr-2">
                                        <i class="fa fa-edit"></i> Edit
                                    </a>
                                    <!-- Tombol Delete -->
                                    <form action="<?= base_url('whatsnew/delete/' . $new['id']); ?>" method="post" class="d-inline delete-whatsnew">
                                        <?= csrf_field(); ?>
                                        <button type="submit" class="btn btn-outline-primary">
                                            <i class="fa fa-trash"></i> Delete
                                        </button>
                                    </form>

                                <?php endif; ?>
                            </div>
                        </div>
                    </div>

                    <div class="container mt-4" id="detail-content">
                        <div class="row justify-content-center" id="content">
                            <div class="col">
                                <div data-content>
                                    <div class="ql-editor">
                                        <?= $new['full_desc']; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="ml-4 col-12">
                        <div class="row mt-3">
                            <div class="col d-flex align-items-end">
                                <div class="d-flex flex-column">
                                    <p class="m-0"><b>Manual: </b><?= $new['user_manual_link']; ?></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

<div id="sidebar"></div>

<script>
    document.querySelectorAll('.delete-whatsnew').forEach(function(form) {
        form.addEventListener('submit', function(e) {
            e.preventDefault();
            Swal.fire({
                title: 'Hapus Data',
                text: 'Yakin hapus data ini?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, Hapus!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    form.submit();
                }
            });
        });
    });
</script>

<script>
    var sidebar = document.getElementById('sidebar');
    if (sidebar) {
        sidebar.style.left = '0px';
    }
</script>

<style>
    pre {
        font-family: Tahoma, sans-serif;
    }

    .find-container {
        position: relative;
        width: fit-content;
        padding: 10px;
        background-color: #f5f5f5;
        box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
        z-index: 10;
        display: flex;
        align-items: center;
    }

    input[type="text"] {
        flex-grow: 1;
        margin-right: 10px;
        padding: 5px;
        border-radius: 4px;
        border: 1px solid #ccc;
    }

    #sidebar {
        display: none !important;
    }

    #main-content {
        margin-left: 0 !important;
        width: 100% !important;
        max-width: 1200px;
    }
</style>

<?= $this->endSection(); ?>