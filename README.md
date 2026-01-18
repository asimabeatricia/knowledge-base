# BPJS Ketenagakerjaan Knowledge Base with AI Chatbot

Aplikasi **Knowledge Base** berbasis web yang dirancang untuk mengelola dan mendistribusikan panduan penggunaan aplikasi internal bagi karyawan BPJS Ketenagakerjaan. Proyek ini mengintegrasikan fitur manajemen konten (CRUD) dengan kecerdasan buatan (Chatbot) untuk meningkatkan efisiensi bantuan teknis.

## Fitur Utama

### Portal Admin (Management Side)
* **CRUD User Manual**: Admin memiliki kendali penuh untuk Menambah (Create), Melihat (Read), Mengubah (Update), dan Menghapus (Delete) dokumen panduan.
* **Content Management**: Pengelolaan dokumen panduan aplikasi yang terorganisir untuk memudahkan akses informasi.

### Fitur AI Chatbot (User Side)
* **Automated Assistant**: Integrasi dengan **Google Dialogflow API** yang memungkinkan user bertanya secara alami mengenai panduan aplikasi.
* **Real-time Interaction**: Respons chatbot yang cepat menggunakan AJAX/Fetch API untuk pengalaman pengguna yang mulus.

## 💻 Tech Stack
* **Framework**: CodeIgniter 4 (PHP 8.1+)
* **UI/UX**: Bootstrap 4 & JavaScript
* **Database**: MySQL
* **AI Engine**: Google Dialogflow (Natural Language Understanding)

## 🔧 Instalasi & Konfigurasi

1. **Clone & Install**:
   ```bash
   git clone [https://github.com/username/knowledge-base.git](https://github.com/username/knowledge-base.git)
   composer install
   
2. **Environment Setup**
    - Salin file env menjadi .env
    - Atur database dan path kredensial Google Cloud : GOOGLE_APPLICATION_CREDENTIALS = "path/to/your/new-key.json"

3. **Database**:
    Impor database ke MySQL dan sesuaikan pengaturan di .env
   