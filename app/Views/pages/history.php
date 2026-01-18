<?= $this->extend('layout/template2'); ?>
<?= $this->section('content'); ?>

<head>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<div class="container">
    <div class="row">
        <div class="col">
            <a href="/pages/" class="d-flex align-items-center m-2 w-fit" style="border-bottom: 3px solid #dee2e6 !important;">
                <img src="/img/backLogo.png" alt="back" style="max-height:25px">
                <p class="d-none d-md-flex m-0">Kembali ke Menu Awal</p>
            </a>
            <h1 class="mt-4 mb-4" style="color: #3A85D3;">
                History
                <?php if (!empty($manual)) : ?>
                    <?= esc($manual['title']) ?>
                <?php endif; ?>
            </h1>
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">No</th>
                        <th scope="col">Tanggal</th>
                        <th scope="col">Versi</th>
                        <th scope="col">Keterangan</th>
                        <th scope="col">Editor</th>
                        <th scope="col">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $i = 1; ?>
                    <?php foreach ($history as $row): ?>
                        <tr>
                            <td><?= $i++; ?></td>
                            <td><?= $row['created_at']; ?></td>
                            <td>
                                <?= isset($manuals[$row['user_manual_id']]['versioning']) && $manuals[$row['user_manual_id']]['versioning']
                                    ? esc($manuals[$row['user_manual_id']]['versioning'])
                                    : '-' ?>
                            </td>
                            <td><?= $row['description']; ?></td>
                            <td><?= $row['editor']; ?></td>
                            <td>
                                <?php if (!empty($manual)) : ?>
                                    <a href="<?= site_url('pages/manual/' . $manual['slug']) ?>" class="btn btn-primary">Lihat</a>
                                <?php elseif (!empty($manuals[$row['user_manual_id']]['slug'])) : ?>
                                    <a href="<?= site_url('pages/manual/' . $manuals[$row['user_manual_id']]['slug']) ?>" class="btn btn-primary">Lihat</a>
                                <?php else: ?>
                                    -
                                <?php endif; ?>
                                <a href="<?= base_url('pages/history/delete/' . $row['id']) ?>"
                                    class="btn btn-outline-primary ml-4 delete-history">
                                    <i class="fa fa-trash"></i>
                                </a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

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

    <style>
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
    </style>


    <script>
        $(document).ready(function() {
            $('#ModalMessage').modal('show');
        });
    </script>
<?php endif; ?>

<script>
    document.addEventListener('DOMContentLoaded', function() {

        const deleteButtons = document.querySelectorAll('.delete-history');

        deleteButtons.forEach(function(button) {
            button.addEventListener('click', function(e) {
                e.preventDefault();

                const href = this.getAttribute('href');

                Swal.fire({
                    title: 'Hapus History',
                    text: 'Yakin hapus history ini?',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Hapus',
                    cancelButtonText: 'Batalkan',
                    confirmButtonColor: '#d33',
                    cancelButtonColor: 'gray'
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = href;
                    }
                });
            });
        });
    });
</script>

<?= $this->endSection(); ?>