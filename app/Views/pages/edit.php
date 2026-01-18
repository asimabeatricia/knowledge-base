<?= $this->extend('layout/template2'); ?>
<?= $this->section('content'); ?>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-8">
            <a href="/pages/" class="d-flex align-items-center m-2 w-fit" style="border-bottom: 3px solid #dee2e6 !important;">
                <img src="/img/backLogo.png" alt="back" style="max-height:25px">
                <p class="d-none d-md-flex m-0">Kembali ke Menu Awal</p>
            </a>

            <div class="row my-3 justify-content-between">
                <h2 class="my-3 col-8 p-0" style="color: #3A85D3;">Edit User Manual</h2>
                <a href="<?= base_url('pages/history/' . $manual['slug']) ?>" class="btn btn-primary my-3 col-sm-2 w-fit h-fit px-0 px-auto">
                    Lihat History
                </a>
            </div>

            <?php $validation = \Config\Services::validation(); ?>

            <?php if (!empty($errors)): ?>
                <div class="alert alert-danger">
                    <ul>
                        <?php foreach ($errors as $error): ?>
                            <li><?= esc($error) ?></li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            <?php endif; ?>


            <?php if (session()->getFlashdata('pesan')) : ?>
                <div class="modal fade" id="errorModal" tabindex="-1" role="dialog">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content shadow border-0" style="border-radius: 1rem; overflow: hidden; position: relative;">
                            <button type="button" class="close position-absolute" style="top: 10px; right: 10px; z-index: 1051; background: white; border-radius: 50%; width: 30px; height: 30px; border: none;" data-dismiss="modal">
                                &times;
                            </button>

                            <div class="modal-header p-0" style="background: #C60000; height: 120px;">
                                <div class="w-100 d-flex justify-content-center align-items-center" style="height: 100%;">
                                    <img src="/img/icon-park-solid_fail.png" alt="Error Icon" style="height: 60px;">
                                </div>
                            </div>
                            <div class="modal-body text-center">
                                <h4 class="font-weight-bold text-danger mb-2">Error!</h4>
                                <p>Mohon maaf, terjadi kesalahan.</p>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endif ?>

            <form id="formEdit" action="/pages/update/<?= $manual['id'] ?>" method="post" enctype="multipart/form-data">
                <?= csrf_field(); ?>
                <input type="hidden" name="id" value="<?= $manual['id']; ?>">

                <!-- Logo Upload -->
                <div class="form-group row">
                    <label for="icon" class="col-sm-2 col-form-label">Logo</label>
                    <div class="col-sm-2">
                        <img id="logoPreview" src="<?= base_url('img/icons/' . ($manual['icon'] ?? 'default.png')) ?>"
                            alt="Preview Logo" class="img-fluid">
                    </div>
                    <div class="col-sm-8">
                        <div class="custom-file">
                            <input type="file" class="custom-file-input <?= !empty($errors['icon']) ? 'is-invalid' : '' ?>" id="icon" name="icon" onchange="previewImg()">
                            <label class="custom-file-label" for="icon">Upload</label>
                            <?php if (!empty($errors['icon'])) : ?>
                                <div class="invalid-feedback"><?= $errors['icon']; ?></div>
                            <?php endif ?>
                        </div>
                    </div>
                </div>

                <!-- Judul -->
                <div class="form-group row">
                    <label for="judul" class="col-sm-2 col-form-label">Judul</label>
                    <div class="col">
                        <input type="text" class="form-control <?= !empty($errors['title']) ? 'is-invalid' : '' ?>" id="title" name="judul" value="<?= esc(old('title', $manual['title'] ?? '')) ?>">
                        <?php if (!empty($errors['title'])) : ?>
                            <div class="invalid-feedback"><?= $errors['title']; ?></div>
                        <?php endif ?>
                    </div>
                </div>

                <!-- Kategori -->
                <div class="form-group row">
                    <label for="kategori" class="col-sm-2 col-form-label">Kategori</label>
                    <div class="col">
                        <select class="form-select form-select-lg" id="category" name="kategori">
                            <option value="internal" <?= (old('kategori', $manual['category'] ?? '') === 'internal') ? 'selected' : '' ?>>Aplikasi Internal</option>
                            <option value="eksternal" <?= (old('kategori', $manual['category'] ?? '') === 'eksternal') ? 'selected' : '' ?>>Aplikasi Eksternal</option>
                        </select>
                    </div>
                </div>

                <!-- Editor -->
                <div class="form-group row">
                    <label for="editor" class="col-sm-2 col-form-label">Editor</label>
                    <div class="col">
                        <input type="text" name="editor" value="<?= old('editor', $manual['editor'] ?? '') ?>">
                        <?php if (!empty($errors['editor'])) : ?>
                            <div class="invalid-feedback"><?= $errors['editor']; ?></div>
                        <?php endif ?>
                    </div>
                </div>

                <!-- Link -->
                <div class="form-group row">
                    <label for="link" class="col-sm-2 col-form-label">Link</label>
                    <div class="col">
                        <input type="text" class="form-control <?= !empty($errors['link']) ? 'is-invalid' : '' ?>" id="link" name="link" value="<?= esc(old('link', $manual['link'] ?? '')) ?>">
                        <?php if (!empty($errors['link'])) : ?>
                            <div class="invalid-feedback"><?= $errors['link']; ?></div>
                        <?php endif ?>
                    </div>
                </div>

                <!-- Isi -->
                <div class="form-group row">
                    <label for="isi" class="col-sm-2 col-form-label">Isi</label>
                    <div class="col">
                        <textarea id="isi" name="isi"><?= old('content', $manual['content'] ?? '') ?></textarea>
                        <?php if (!empty($errors['content'])) : ?>
                            <div class="invalid-feedback d-block"><?= $errors['content']; ?></div>
                        <?php endif ?>
                    </div>
                </div>

                <!-- Keterangan Perubahan -->
                <div class="form-group row">
                    <label for="description" class="col-sm-2 col-form-label">Keterangan</label>
                    <div class="col">
                        <textarea id="description" name="description" class="form-control" rows="2" placeholder="Jelaskan perubahan yang dilakukan..."></textarea>
                    </div>
                </div>

                <!-- Buttons -->
                <div class="row justify-content-center">
                    <div class="col-sm-2"></div>
                    <div class="d-flex">
                        <div class="col p-0" style="max-width: fit-content;">
                            <a href="/pages/" class="btn btn-secondary"><b>Batal</b></a>
                        </div>
                        <div class="col" style="max-width: fit-content;">
                            <button type="submit" name="publish" value="draft" class="btn" style="background-color: #3A85D3; color:white;"><b>Simpan Draf</b></button>
                        </div>
                        <div class="col p-0" style="max-width: fit-content;">
                            <button type="submit" name="publish" value="publish" class="btn" style="background-color: #3BAB47; color:white;"><b>Update & Simpan</b></button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- TinyMCE & Script -->
    <script src="https://cdn.jsdelivr.net/npm/tinymce@6.8.3/tinymce.min.js"></script>
    <script>
        tinymce.init({
            selector: '#isi',
            height: 400,
            plugins: 'advlist autolink lists link image charmap preview anchor searchreplace visualblocks code fullscreen insertdatetime media table code help wordcount',
            toolbar: 'undo redo | styles | bold italic underline | alignleft aligncenter alignright alignjustify | bullist numlist | outdent indent | link image | code preview',
            menubar: false,
            branding: false,
            images_upload_url: '/pages/uploadImage', // endpoint upload gambar
            automatic_uploads: true,
            images_upload_credentials: true,
            file_picker_types: 'image',
            images_reuse_filename: true,
            file_picker_callback: function(cb, value, meta) {
                if (meta.filetype === 'image') {
                    var input = document.createElement('input');
                    input.setAttribute('type', 'file');
                    input.setAttribute('accept', 'image/*');
                    input.onchange = function() {
                        var file = this.files[0];
                        var reader = new FileReader();
                        reader.onload = function() {
                            cb(reader.result, {
                                title: file.name
                            });
                        };
                        reader.readAsDataURL(file);
                    };
                    input.click();
                }
            }
        });

        document.getElementById('formEdit').addEventListener('submit', function() {
            tinymce.triggerSave(); // paksa TinyMCE sinkronkan isi ke textarea
        });

        window.onload = function() {
            document.querySelector('#icon').addEventListener('change', function() {
                const icon = this;
                const iconLabel = document.querySelector('.custom-file-label');
                const imgPreview = document.querySelector('#logoPreview');

                if (!icon.files || !icon.files[0]) return;

                iconLabel.textContent = icon.files[0].name;

                const fileReader = new FileReader();
                fileReader.onload = function(e) {
                    imgPreview.src = e.target.result;
                };
                fileReader.readAsDataURL(icon.files[0]);
            });

            $(document).ready(function() {
                <?php if (session()->getFlashdata('pesan')): ?>
                    $('#errorModal').modal('show');
                <?php endif ?>
            });
        };
    </script>
</div>

<?= $this->endSection(); ?>