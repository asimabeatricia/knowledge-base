<?= $this->extend('layout/template2'); ?>
<?= $this->section('content'); ?>
<div class="container">
    <div class="row">
        <div class="col">
            <a href="/pages" class="d-flex align-items-center m-2 w-fit" style="border-bottom: 3px solid #dee2e6 !important;">
                <img src="/img/backLogo.png" alt="" class="" style="max-height:25px">
                <p class="d-none d-md-flex m-0">Kembali ke Menu Awal</p>
            </a>
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h1 class="m-0" style="color: #3A85D3;">What's New</h1>
                <?php if (in_groups('admin')) : ?>
                    <div class="d-flex" style="gap: 8px;">
                        <a href="/whatsnew/create" class="btn btn-outline-primary">
                            <i class="fa fa-pencil"></i>
                            Buat
                        </a>
                        <a href="/whatsnew/history" class="btn btn-outline-primary">
                            <i class="fa fa-history"></i> History
                        </a>
                    </div>
                <?php endif ?>
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

                <script>
                    $(document).ready(function() {
                        $('#ModalMessage').modal('show');
                    });
                </script>
            <?php endif; ?>

            <table class="table">
                <caption></caption>
                <thead>
                    <tr>
                        <th scope="col">No</th>
                        <th scope="col">Nama Aplikasi</th>
                        <th scope="col">Versi</th>
                        <th scope="col">Deskripsi Singkat</th>
                        <th scope="col">Tanggal</th>
                        <th scope="col">Detail</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if ($whatsnew && count($whatsnew) > 0): ?>
                        <?php $i = 1;
                        foreach ($whatsnew as $n): ?>
                            <tr>
                                <td><?= $i++; ?></td>
                                <td><?= esc($n['nama']); ?></td>
                                <td><?= esc($n['versi']); ?></td>
                                <td><?= esc(strip_tags($n['short_desc'])); ?></td>
                                <td><?= esc($n['tanggal']); ?></td>
                                <td>
                                    <a href="<?= base_url('whatsnew/detail/' . $n['slug']) ?>" class="btn btn-primary btn-sm">Lihat</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="6" class="text-center">Data tidak ditemukan.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>


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

<?= $this->endSection(); ?>