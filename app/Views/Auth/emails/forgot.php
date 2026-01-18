<p>Halo,</p>

<p>Anda telah meminta untuk mengatur ulang kata sandi akun Anda di <strong>Knowledge Base BPJS Ketenagakerjaan</strong>.</p>

<p>Untuk mengatur ulang kata sandi, silakan gunakan kode berikut dan ikuti instruksi yang tersedia:</p>

<p><strong>Kode Anda:</strong> <?= $hash ?></p>

<p>Atau Anda bisa langsung mengunjungi tautan berikut untuk mengatur ulang kata sandi Anda:</p>

<p>
    <a href="<?= url_to('reset-password') . '?token=' . $hash ?>">Klik di sini untuk mengatur ulang kata sandi</a>
</p>

<p>Catatan: Tautan ini hanya berlaku untuk satu kali penggunaan dan akan kadaluarsa dalam beberapa waktu.</p>

<p>Jika Anda tidak merasa melakukan permintaan ini, abaikan saja email ini dan tidak ada tindakan lebih lanjut yang perlu dilakukan.</p>

<br>