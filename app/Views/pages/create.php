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
                <h2 class="my-3 col-8 p-0" style="color: #3A85D3;">Buat User Manual</h2>
                <a href="<?= base_url('/pages/history') ?>" class="btn btn-primary my-3 col-sm-2 w-fit h-fit px-0 px-auto">
                    Lihat History
                </a>

            </div>

            <?php $validation = \Config\Services::validation(); ?>


            <?php if (session()->getFlashdata('validation_errors')): ?>
                <ul class="alert alert-danger">
                    <?php foreach ($errors as $error) : ?>
                        <li><?= $error ?></li>
                    <?php endforeach ?>
                </ul>
            <?php endif ?>

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


            <form id="formCreate" action="<?= base_url('pages/save') ?>" method="post" enctype="multipart/form-data" class="mb-4">
                <?= csrf_field(); ?>

                <!-- Logo Upload -->
                <div class="form-group row">
                    <label for="icon" class="col-sm-2 col-form-label">Logo</label>
                    <div class="col-sm-2">
                        <img id="logoPreview" src="<?= base_url('/img/default.png') ?>" alt="Preview Logo" class="img-fluid">
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
                        <input type="text" class="form-control <?= !empty($errors['judul']) ? 'is-invalid' : '' ?>" id="judul" name="judul" value="<?= esc(old('judul')); ?>">
                        <?php if (!empty($errors['judul'])) : ?>
                            <div class="invalid-feedback"><?= $errors['judul']; ?></div>
                        <?php endif ?>
                    </div>
                </div>

                <!-- Kategori -->
                <div class="form-group row">
                    <label for="kategori" class="col-sm-2 col-form-label">Kategori</label>
                    <div class="col">
                        <select class="form-select form-select-lg" id="kategori" name="kategori">
                            <option value="internal" <?= old('kategori') === 'internal' ? 'selected' : '' ?>>Aplikasi Internal</option>
                            <option value="eksternal" <?= old('kategori') === 'eksternal' ? 'selected' : '' ?>>Aplikasi Eksternal</option>
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
                        <input type="text" class="form-control <?= !empty($errors['link']) ? 'is-invalid' : '' ?>" id="link" name="link" value="<?= esc(old('link')); ?>">
                        <?php if (!empty($errors['link'])) : ?>
                            <div class="invalid-feedback"><?= $errors['link']; ?></div>
                        <?php endif ?>
                    </div>
                </div>

                <!-- Isi (TinyMCE) -->
                <div class="form-group row">
                    <label for="isi" class="col-sm-2 col-form-label">Isi</label>
                    <div class="col">
                        <textarea id="isi" name="isi"><?= old('isi') ?></textarea>
                        <?php if (!empty($errors['isi'])) : ?>
                            <div class="invalid-feedback d-block"><?= $errors['isi']; ?></div>
                        <?php endif ?>
                    </div>
                </div>

                <!-- Buttons -->
                <div class="row justify-content-center">
                    <div class="col-sm-2"></div>
                    <div class="d-flex">
                        <div class="col p-0" style="max-width: fit-content;">
                            <button type="reset" class="btn" style="background-color: #A3A3A3; color:white;"><b>Batalkan</b></button>
                        </div>
                        <div class="col" style="max-width: fit-content;">
                            <button type="submit" name="status" value="draft" class="btn btn-primary">Simpan sebagai Draf</button>
                        </div>
                        <div class="col p-0" style="max-width: fit-content;">
                            <button type="submit" name="status" value="published" class="btn btn-success">Simpan</button>
                        </div>
                    </div>
                </div>
            </form>

        </div>
    </div>

    <!-- TinyMCE -->
    <script src="https://cdn.jsdelivr.net/npm/tinymce@6.8.3/tinymce.min.js"></script>
    <script>
        tinymce.init({
            selector: '#isi',
            height: 400,
            plugins: 'advlist autolink lists link image charmap preview anchor searchreplace visualblocks code fullscreen insertdatetime media table code help wordcount',
            toolbar: 'undo redo | styles | bold italic underline | alignleft aligncenter alignright alignjustify | bullist numlist | outdent indent | link image | code preview',
            menubar: false,
            branding: false
        });
    </script>


    <script>
        window.onload = function() {
            // Logo preview
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



    <!-- Validasi frontend untuk semua field di formCreate -->
    <script>
        document.getElementById('formCreate').addEventListener('submit', function(e) {
            let errors = [];
            // Bersihkan error sebelumnya
            document.querySelectorAll('.invalid-feedback').forEach(el => el.remove());
            document.querySelectorAll('.is-invalid').forEach(el => el.classList.remove('is-invalid'));
            let errorList = document.getElementById('frontendErrorList');
            if (errorList) errorList.remove();

            // Logo (icon)
            let icon = document.getElementById('icon');
            if (!icon.value) {
                errors.push('Logo wajib diupload.');
                icon.classList.add('is-invalid');
                let div = document.createElement('div');
                div.className = 'invalid-feedback';
                div.innerText = 'Logo wajib diupload.';
                icon.parentNode.appendChild(div);
            }

            // Judul
            let judul = document.getElementById('judul');
            if (!judul.value.trim()) {
                errors.push('Judul wajib diisi.');
                judul.classList.add('is-invalid');
                let div = document.createElement('div');
                div.className = 'invalid-feedback';
                div.innerText = 'Judul wajib diisi.';
                judul.parentNode.appendChild(div);
            }

            // Kategori
            let kategori = document.getElementById('kategori');
            if (!kategori.value) {
                errors.push('Kategori wajib dipilih.');
                kategori.classList.add('is-invalid');
                let div = document.createElement('div');
                div.className = 'invalid-feedback';
                div.innerText = 'Kategori wajib dipilih.';
                kategori.parentNode.appendChild(div);
            }

            // Editor
            let editor = document.querySelector('input[name="editor"]');
            if (!editor.value.trim()) {
                errors.push('Editor wajib diisi.');
                editor.classList.add('is-invalid');
                let div = document.createElement('div');
                div.className = 'invalid-feedback';
                div.innerText = 'Editor wajib diisi.';
                editor.parentNode.appendChild(div);
            }

            // Link
            let link = document.getElementById('link');
            if (!link.value.trim()) {
                errors.push('Link wajib diisi.');
                link.classList.add('is-invalid');
                let div = document.createElement('div');
                div.className = 'invalid-feedback';
                div.innerText = 'Link wajib diisi.';
                link.parentNode.appendChild(div);
            }

            // Isi (TinyMCE)
            let isi = tinymce.get('isi').getContent({
                format: 'text'
            }).trim();
            let isiTextarea = document.getElementById('isi');
            if (!isi) {
                errors.push('Isi wajib diisi.');
                let div = document.createElement('div');
                div.className = 'invalid-feedback d-block';
                div.innerText = 'Isi wajib diisi.';
                isiTextarea.parentNode.appendChild(div);
            }

            if (errors.length > 0) {
                e.preventDefault();
                // Tampilkan error di atas form
                let form = document.getElementById('formCreate');
                let ul = document.createElement('ul');
                ul.className = 'alert alert-danger';
                ul.id = 'frontendErrorList';
                errors.forEach(function(err) {
                    let li = document.createElement('li');
                    li.innerText = err;
                    ul.appendChild(li);
                });
                form.parentNode.insertBefore(ul, form);
                // Scroll ke atas agar error terlihat
                window.scrollTo({
                    top: form.offsetTop - 100,
                    behavior: 'smooth'
                });
            }
        });
    </script>

</div>

<?= $this->endSection(); ?>