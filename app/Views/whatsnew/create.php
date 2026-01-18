<?= $this->extend('layout/template2'); ?>
<?= $this->section('content'); ?>

<div class="container">
    <?php $errors = session()->getFlashdata('validation_errors'); ?>

    <?php if ($errors): ?>
        <ul class="alert alert-danger">
            <?php foreach ($errors as $error) : ?>
                <li><?= $error ?></li>
            <?php endforeach ?>
        </ul>
    <?php endif ?>

    <div class="row justify-content-center">
        <div class="col-8">
            <a href="/pages/" class="d-flex align-items-center m-2 w-fit" style="border-bottom: 3px solid #dee2e6 !important;">
                <img src="/img/backLogo.png" alt="" class="" style="max-height:25px" alt="back">
                <p class="d-none d-md-flex m-0">Kembali ke Menu Awal</p>
            </a>
            <div class="row my-3 justify-content-between">
                <h2 class="my-3 col-8 p-0" style="color: #3A85D3;">What's New</h2>
                <a href="/whatsnew/history" class="btn btn-primary my-3 col-sm-2 w-fit h-fit px-0 px-auto">
                    Lihat History
                </a>
            </div>

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
                                <h4 class="font-weight-bold text-danger mb-2">Maaf...</h4>
                                <p><?= session()->getFlashdata('pesan'); ?></p>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endif ?>

            <form id="form" action="/whatsnew/save" method="post" enctype="multipart/form-data" class="mb-4">

                <?= csrf_field(); ?>

                <?php if (isset($validation)): ?>
                    <div class="alert alert-danger">
                        <?= $validation->listErrors() ?>
                    </div>
                <?php endif; ?>

                <div class="form-group row">
                    <label for="nama" class="col-sm-2 col-form-label">Nama Aplikasi</label>
                    <div class="col">
                        <input type="text" name="nama" class="form-control <?= isset($errors['nama']) ? 'is-invalid' : '' ?>" value="<?= old('nama') ?>">
                        <?php if (isset($errors['nama'])): ?>
                            <div class="invalid-feedback"><?= $errors['nama']; ?></div>
                        <?php endif ?>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="versi" class="col-sm-2 col-form-label">Versi</label>
                    <div class="col">
                        <input type="text" class="form-control 
                        <?= !empty($errors['versi']) ? 'is-invalid' : '' ?>" id="versi" name="versi" autofocus value="<?= esc(old('versi')); ?>">
                        <?php if (!empty($errors['versi'])) : ?>
                            <div class="invalid-feedback">
                                <?= $errors['versi']; ?>
                            </div>
                        <?php endif ?>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="category" class="col-sm-2 col-form-label" style="overflow: hidden;">Kategori</label>
                    <div class="col">
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="category" id="category1" value="internal" <?= old('category') == 'internal' ? 'checked' : '' ?>>
                            <label class="form-check-label" for="category1">Internal</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="category" id="category2" value="eksternal" <?= old('category') == 'eksternal' ? 'checked' : '' ?>>
                            <label class="form-check-label" for="category2">Eksternal</label>
                        </div>
                    </div>
                    <?php if (!empty($errors['category'])) : ?>
                        <div class="col">
                            <p class="invalid-feedback d-block"><?= $errors['category']; ?></p>
                        </div>
                    <?php endif ?>
                </div>

                <div class="form-group row">
                    <label for="tanggal" class="col-sm-2 col-form-label">Tanggal</label>
                    <div class="col">
                        <input type="date" class="form-control 
                        <?= !empty($errors['tanggal']) ? 'is-invalid' : '' ?>" id="tanggal" name="tanggal" autofocus value="<?= esc(old('tanggal')); ?>">
                        <?php if (!empty($errors['tanggal'])) : ?>
                            <div class="invalid-feedback">
                                <?= $errors['tanggal']; ?>
                            </div>
                        <?php endif ?>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="shortDesc" class="col-sm-2 col-form-label" style="overflow: hidden;">Deskripsi Singkat</label>
                    <div class="col-10 h-100 w-100">
                        <textarea id="shortDesc" name="short_desc" class="form-control <?= !empty($errors['shortDesc']) ? 'is-invalid' : '' ?>" rows="4"><?= esc(old('shortDesc')) ?></textarea>
                        <?php if (!empty($errors['shortDesc'])) : ?>
                            <div class="invalid-feedback">
                                <?= $errors['shortDesc']; ?>
                            </div>
                        <?php endif ?>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="desc" class="col-sm-2 col-form-label">Deskripsi Lengkap</label>
                    <div class="col h-100">
                        <textarea id="desc" name="full_desc" class="form-control <?= !empty($errors['desc']) ? 'is-invalid' : '' ?>" rows="10"><?= esc(old('desc')) ?></textarea>
                        <?php if (!empty($errors['desc'])) : ?>
                            <div class="invalid-feedback">
                                <?= $errors['desc']; ?>
                            </div>
                        <?php endif ?>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="link" class="col-sm-2 col-form-label">Link User Manual</label>
                    <div class="col d-flex align-items-center">
                        <input type="text" class="form-control 
                        <?= !empty($errors['link']) ? 'is-invalid' : '' ?>" id="link" name="user_manual_link" autofocus value="<?= esc(old('link')); ?>">
                        <?php if (!empty($errors['link'])) : ?>
                            <div class="invalid-feedback">
                                <?= $errors['link']; ?>
                            </div>
                        <?php endif ?>
                    </div>
                </div>


                <div class="row justify-content-center">
                    <div class="col-sm-2 col-form-label"></div>
                    <div class="d-flex ">
                        <div class="col p-0">
                            <button type="reset" class="btn" style="background-color: #A3A3A3; color:white;"><b>Reset</b></button>
                        </div>
                        <div class="col" style="max-width: fit-content;">
                            <button type="submit" class="btn " style="background-color: #3A85D3; color:white;"><b>Save</b></button>
                        </div>
                    </div>
                </div>


            </form>


            <tbody>
                <?php if (isset($whatsnew) && is_array($whatsnew)): ?>
                    <?php $no = 1;
                    foreach ($whatsnew as $item): ?>
                        <tr>
                            <td><?= $no++ ?></td>
                            <td><?= esc($item['nama']) ?></td>
                            <td><?= esc($item['versi']) ?></td>
                            <td><?= esc($item['short_desc']) ?></td>
                            <td><?= esc($item['tanggal']) ?></td>
                            <td><a href="...">Lihat</a></td>
                        </tr>
                    <?php endforeach ?>
                <?php endif; ?>
            </tbody>
            </table>
        </div>
    </div>
</div>

<!-- TinyMCE CDN -->
<script src="https://cdn.jsdelivr.net/npm/tinymce@6.8.3/tinymce.min.js"></script>
<script>
    tinymce.init({
        selector: '#shortDesc, #desc',
        height: 300,
        plugins: 'advlist autolink lists link image charmap preview anchor searchreplace visualblocks code fullscreen insertdatetime media table code help wordcount',
        toolbar: 'undo redo | styles | bold italic underline | alignleft aligncenter alignright alignjustify | bullist numlist | outdent indent | link image | code preview',
        menubar: false,
        branding: false
    });
</script>
<script>
    $(document).ready(function() {
        <?php if (session()->getFlashdata('pesan')): ?>
            $('#errorModal').modal('show');
        <?php endif ?>
    });
</script>
<script>
    window.addEventListener('DOMContentLoaded', function() {
        let errorField = document.querySelector('.text-danger');
        if (errorField) {
            let input = errorField.previousElementSibling;
            if (input) input.focus();
        }
    });
</script>
<script>
    document.getElementById('form').addEventListener('submit', function(e) {
        let errors = [];
        // Bersihkan error sebelumnya
        document.querySelectorAll('.invalid-feedback').forEach(el => el.remove());
        document.querySelectorAll('.is-invalid').forEach(el => el.classList.remove('is-invalid'));
        let errorList = document.getElementById('frontendErrorList');
        if (errorList) errorList.remove();

        // Nama
        let nama = document.querySelector('input[name="nama"]');
        if (!nama.value.trim()) {
            errors.push('Nama wajib diisi.');
            nama.classList.add('is-invalid');
            let div = document.createElement('div');
            div.className = 'invalid-feedback';
            div.innerText = 'Nama wajib diisi.';
            nama.parentNode.appendChild(div);
        }

        // Versi
        let versi = document.getElementById('versi');
        if (!versi.value.trim()) {
            errors.push('Versi wajib diisi.');
            versi.classList.add('is-invalid');
            let div = document.createElement('div');
            div.className = 'invalid-feedback';
            div.innerText = 'Versi wajib diisi.';
            versi.parentNode.appendChild(div);
        }

        // Kategori (radio)
        let kategoriChecked = document.querySelector('input[name="category"]:checked');
        if (!kategoriChecked) {
            errors.push('Kategori wajib dipilih.');
            // Tampilkan error di bawah radio group
            let kategoriGroup = document.querySelector('input[name="category"]').parentNode.parentNode;
            let div = document.createElement('div');
            div.className = 'invalid-feedback d-block';
            div.innerText = 'Kategori wajib dipilih.';
            kategoriGroup.appendChild(div);
        }

        // Tanggal
        let tanggal = document.getElementById('tanggal');
        if (!tanggal.value.trim()) {
            errors.push('Tanggal wajib diisi.');
            tanggal.classList.add('is-invalid');
            let div = document.createElement('div');
            div.className = 'invalid-feedback';
            div.innerText = 'Tanggal wajib diisi.';
            tanggal.parentNode.appendChild(div);
        }

        // Deskripsi Singkat (TinyMCE)
        let shortDesc = tinymce.get('shortDesc') ? tinymce.get('shortDesc').getContent({
            format: 'text'
        }).trim() : document.getElementById('shortDesc').value.trim();
        let shortDescTextarea = document.getElementById('shortDesc');
        if (!shortDesc) {
            errors.push('Deskripsi singkat wajib diisi.');
            let div = document.createElement('div');
            div.className = 'invalid-feedback d-block';
            div.innerText = 'Deskripsi singkat wajib diisi.';
            shortDescTextarea.parentNode.appendChild(div);
        }

        // Deskripsi Lengkap (TinyMCE)
        let desc = tinymce.get('desc') ? tinymce.get('desc').getContent({
            format: 'text'
        }).trim() : document.getElementById('desc').value.trim();
        let descTextarea = document.getElementById('desc');
        if (!desc) {
            errors.push('Deskripsi lengkap wajib diisi.');
            let div = document.createElement('div');
            div.className = 'invalid-feedback d-block';
            div.innerText = 'Deskripsi lengkap wajib diisi.';
            descTextarea.parentNode.appendChild(div);
        }

        // Link User Manual
        let link = document.getElementById('link');
        if (!link.value.trim()) {
            errors.push('Link User Manual wajib diisi.');
            link.classList.add('is-invalid');
            let div = document.createElement('div');
            div.className = 'invalid-feedback';
            div.innerText = 'Link User Manual wajib diisi.';
            link.parentNode.appendChild(div);
        }

        if (errors.length > 0) {
            e.preventDefault();
            // Tampilkan error di atas form
            let form = document.getElementById('form');
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
<?= $this->endSection(); ?>