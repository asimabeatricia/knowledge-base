<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\Files\UploadedFile;
use App\Models\ManualModel;
use App\Models\NewManualModel;

class Pages extends BaseController
{
    protected $manualModel;

    public function __construct()
    {
        $this->manualModel = new \App\Models\ManualModel();
    }


    public function login()
    {
        $username = $this->request->getPost('username');
        $password = $this->request->getPost('password');

        $user = $this->manualModel->where('username', $username)->first();

        if ($user && password_verify($password, $user['password'])) {
            session()->set([
                'isLoggedIn' => true,
                'username' => $user['username'],
                'user_email' => $user['email'],
                'userId' => $user['id'],
                'role' => $user['role']
            ]);
            return redirect()->to('/pages');
        } else {
            return redirect()->back()->with('error', 'Username atau password salah');
        }
    }

    public function index()
    {
        $model = new \App\Models\ManualModel();

        if (in_groups('admin')) {
            $manual = $model->findAll();
        } else {
            $manual = $model->where('status', 'published')->findAll();
        }

        $data = [
            'manual' => $manual,
        ];
        return view('pages/index', $data);
    }

    private function viewPage($slug, $isManual = false)
    {
        $manual = $this->manualModel->where('slug', $slug)->first();

        if (!$manual) {
            log_message('error', 'Page with slug ' . $slug . ' not found.');
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Halaman tidak ditemukan.');
        }

        $data = [
            'title' => $isManual ? 'User Manual ' . $manual['title'] : $manual['title'],
            'manual' => $manual
        ];

        return view('pages/detail', [
            'data' => $data,
            'slug' => $slug,
            'manual' => $manual,
            'title'  => 'Judul Halaman Anda'
        ]);
    }

    public function manual($slug)
    {
        $manual = $this->manualModel->where('slug', $slug)->first();

        if (!$manual) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Manual tidak ditemukan.');
        }

        $data = [
            'title' => $manual['title'],
            'manual' => $manual
        ];

        return view('pages/detail',  [
            'data' => $data,
            'slug' => $slug,
            'manual' => $manual,
            'title'  => 'Halaman User Manual'
        ]);
    }

    public function detail($slug)
    {
        return $this->viewPage($slug);
    }

    public function search()
    {
        $keyword = $this->request->getGet('keyword');
        $model = new \App\Models\ManualModel();


        $results = $model
            ->groupStart()
            ->like('title', $keyword)
            ->orLike('content', $keyword)
            ->orLike('editor', $keyword)
            ->orLike('category', $keyword)
            ->groupEnd()
            ->findAll();

        return view('pages/searchPage', [
            'results' => $results,
            'keyword' => $keyword
        ]);
    }

    public function create()
    {
        helper(['form']);

        if ($this->request->getMethod() === 'post') {
            $status = $this->request->getPost('status');
            $validationRules = [
                'title' => 'required|min_length[3]',
                'content' => 'required',
                'icon' => 'uploaded[icon]|is_image[icon]|max_size[icon,2048]|ext_in[icon,png,jpg,jpeg]'
            ];

            if (!$this->validate($validationRules)) {
                return view('pages/create', [
                    'title' => 'Tambah Panduan',
                    'validation' => $this->validator
                ]);
            }

            $icon = $this->request->getFile('icon');
            $iconName = $this->uploadIconToCeph($icon);
            $icon->move(FCPATH . 'img/icons', $iconName);

            $slug = url_title($this->request->getPost('title'), '-', true);
            $data = [
                'title' => $this->request->getPost('title'),
                'slug' => $slug,
                'content' => $this->request->getPost('content'),
                'icon' => $iconName,
                'is_published' => $this->request->getPost('publish') ? 1 : 0,
                'editor' => $this->request->getPost('editor'),
            ];

            $this->manualModel->save($data);
            $newManualId = $this->manualModel->getInsertID();

            $requestData = [
                'title' => $this->request->getPost('title'),
                'slug' => $slug,
                'content' => $this->request->getPost('content'),
                'icon' => $iconName,
                'is_published' => $this->request->getPost('publish') ? 1 : 0,
                'editor' => session()->get('username'),
            ];

            $historyModel = new \App\Models\HistoryModel();
            $historyModel->insert([
                'user_manual_id' => $newManualId,
                'action'         => 'create',
                'editor'         => session()->get('username'),
                'content_after'  => json_encode($requestData)
            ]);

            return redirect()->to('/pages');
        }

        return view('pages/create', ['title' => 'Tambah Panduan']);
    }


    public function edit($id)
    {
        $model = new \App\Models\ManualModel();
        $manual = $model->find($id);

        if (!$manual) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Manual tidak ditemukan.');
        }


        return view('pages/edit', ['manual' => $manual]);
    }




    public function delete($id)
    {
        $manual = $this->manualModel->find($id);
        if (!$manual) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException("Halaman tidak ditemukan.");
        }

        $beforeData = $manual;

        $historyModel = new \App\Models\HistoryModel();
        $editor = $manual['editor'] ?? null;

        $historyModel->insert([
            'user_manual_id' => $id,
            'action'         => 'delete',
            'description'    => $manual['title'] ?? '',
            'editor'         => $editor,
            'content_before' => json_encode($manual),
            'content_after'  => null,
            'created_at'     => date('Y-m-d H:i:s'),
        ]);

        $this->manualModel->delete($id);

        return redirect()->to('/pages')->with('pesan', 'User manual berhasil dihapus!');
    }

    private function uploadIconToCeph(UploadedFile $icon): string
    {
        $client = \Config\Services::curlrequest();
        $fileName = $icon->getRandomName();
        $tempPath = WRITEPATH . 'uploads/' . $fileName;
        $icon->move(WRITEPATH . 'uploads', $fileName);

        $response = $client->request('PUT', 'http://ceph-api/icon/' . $fileName, [
            'headers' => ['Content-Type' => $icon->getMimeType()],
            'body' => file_get_contents($tempPath)
        ]);

        if ($response->getStatusCode() == 200) {
            unlink($tempPath);
        } else {
            log_message('error', 'Gagal mengupload icon ke Ceph: ' . $fileName);
        }

        return $fileName;
    }

    private function deleteIconFromCeph(string $iconName)
    {
        $client = \Config\Services::curlrequest();
        $client->request('DELETE', 'http://ceph-api/icon/' . $iconName);
    }

    public function save()
    {
        $validation = \Config\Services::validation();
        $rules = [
            'judul'    => 'required',
            'kategori' => 'required',
            'editor'   => 'required',
            'link'     => 'required',
            'icon'     => 'uploaded[icon]|is_image[icon]|mime_in[icon,image/jpg,image/jpeg,image/png]',
            'isi'      => 'required'
        ];

        // Build validation rules
        if (!$this->validate($rules)) {
            // Kirim error ke view
            return redirect()->back()
                ->withInput()
                ->with('validation', $validation);
        }

        // Clean and validate the content
        $isi = $this->request->getPost('isi');
        $isiClean = trim(strip_tags($isi));
        if ($isiClean === '') {
            return redirect()->back()
                ->withInput()
                ->with('validation', $validation)
                ->with('pesan', 'Isi tidak boleh kosong.');
        }

        // Handle icon upload
        $iconFile = $this->request->getFile('icon');
        $iconName = 'default.png';
        if ($iconFile->isValid() && !$iconFile->hasMoved()) {
            $iconName = $iconFile->getRandomName();
            $iconFile->move(FCPATH . 'img/icons', $iconName);
        }

        // Save the manual data
        $status = $this->request->getPost('status') ?? 'published';
        $this->manualModel->save([
            'title'      => $this->request->getPost('judul'),
            'slug'       => url_title($this->request->getPost('judul'), '-', true),
            'editor'     => $this->request->getPost('editor'),
            'content'    => $isi, // Simpan versi HTML
            'icon'       => $iconName,
            'description' => '',
            'versioning' => 1,
            'category'   => $this->request->getPost('kategori'),
            'link'       => $this->request->getPost('link'),
            'published'  => $status === 'published' ? 1 : 0,
            'status'     => $status
        ]);

        // Insert to history table
        $manualId = $this->manualModel->getInsertID();
        $historyModel = new \App\Models\HistoryModel();
        $historyModel->insert([
            'user_manual_id' => $manualId,
            'action'         => 'create',
            'description'    => $this->request->getPost('judul'),
            'editor'         => $this->request->getPost('editor'),
            'content_before' => null,
            'content_after'  => json_encode([
                'title'      => $this->request->getPost('judul'),
                'slug'       => url_title($this->request->getPost('judul'), '-', true),
                'editor'     => $this->request->getPost('editor'),
                'content'    => $isi,
                'icon'       => $iconName,
                'description' => '',
                'versioning' => 1,
                'category'   => $this->request->getPost('kategori'),
                'link'       => $this->request->getPost('link'),
                'published'  => $status === 'published' ? 1 : 0,
                'status'     => $status
            ]),
            'created_at'     => date('Y-m-d H:i:s'),
        ]);

        session()->setFlashdata('pesan', 'User manual berhasil disimpan!');
        return redirect()->to('/pages');
    }

    public function adminIndex()
    {
        // Menampilkan semua data untuk admin
        $data['pages'] = $this->manualModel->findAll();
        return view('pages/index', $data);
    }

    public function filter()
    {
        $model = new \App\Models\ManualModel();
        $kategori = $this->request->getPost('kategori');

        if (in_groups('admin')) {

            if ($kategori) {
                $manual = $model->whereIn('category', $kategori)->findAll();
            } else {
                $manual = $model->findAll();
            }
        } else {

            if ($kategori) {
                $manual = $model->where('status', 'published')->whereIn('category', $kategori)->findAll();
            } else {
                $manual = $model->where('status', 'published')->findAll();
            }
        }

        return view('pages/index', [
            'manual' => $manual,
        ]);
    }

    public function resetFilter()
    {
        log_message('info', 'Reset filter dipanggil.');

        session()->remove('filter_internal');
        session()->remove('filter_eksternal');


        return redirect()->to('/pages');
    }

    public function history($slug = null)
    {
        $historyModel = new \App\Models\HistoryModel();
        $manualModel = new \App\Models\ManualModel();


        $manuals = [];
        foreach ($manualModel->findAll() as $m) {
            $manuals[$m['id']] = $m;
        }

        if (!$slug) {
            $history = $historyModel->orderBy('created_at', 'DESC')->findAll();
            return view('pages/history', [
                'manual' => null,
                'history' => $history,
                'manuals' => $manuals
            ]);
        }

        $manual = $manualModel->where('slug', $slug)->first();
        if (!$manual) {
            return redirect()->to('/pages')->with('error', 'Manual tidak ditemukan');
        }
        $user_manual_id = $manual['id'];
        $history = $historyModel->where('user_manual_id', $user_manual_id)
            ->orderBy('created_at', 'DESC')
            ->findAll();

        return view('pages/history', [
            'manual' => $manual,
            'history' => $history,
            'manuals' => $manuals
        ]);
    }

    public function deleteHistory($id)
    {
        $historyModel = new \App\Models\HistoryModel();
        $historyModel->delete($id);

        session()->setFlashdata('pesan', 'History berhasil dihapus!');
        return redirect()->to('/pages/history');
    }

    public function oldDetail($slug, $versioning)
    {
        $model = new \App\Models\ManualModel();
        $manual = $model->getAllManualsHistory($slug, $versioning);

        if (!$manual) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound("Manual tidak ditemukan");
        }

        $data = [
            'title' => 'Detail Manual Versi Lama',
            'manual' => $manual
        ];
        return view('pages/oldDetail', $data);
    }

    public function update($id)
    {
        $model = new \App\Models\ManualModel();

        // Handle icon upload or retain old icon
        $iconFile = $this->request->getFile('icon');
        $manual = $model->find($id);
        $iconName = $manual ? $manual['icon'] : 'default.png';
        if ($iconFile && $iconFile->isValid() && !$iconFile->hasMoved()) {
            $iconName = $iconFile->getRandomName();
            $iconFile->move(FCPATH . 'img/icons', $iconName);
        }

        $data = [
            'id'        => $id,
            'title'     => $this->request->getPost('judul'),
            'editor'    => session()->get('username'),
            'link'      => $this->request->getPost('link'),
            'content'   => $this->request->getPost('isi'),
            'category'  => $this->request->getPost('kategori'),
            'icon'      => $iconName
        ];

        $publish = $this->request->getPost('publish');
        $data['status'] = ($publish === 'publish') ? 'published' : 'draft';
        $data['published'] = ($publish === 'publish') ? 1 : 0;

        if (!$model->save($data)) {
            return redirect()->back()->withInput()->with('errors', $model->errors());
        }

        $manualBefore = $model->find($id);
        $manualAfter = $model->find($id);

        $historyModel = new \App\Models\HistoryModel();
        $historyModel->insert([
            'user_manual_id'  => $id,
            'action'          => 'update',
            'description'     => $this->request->getPost('description'),
            'editor'          => $this->request->getPost('editor'),
            'content_before'  => json_encode($manualBefore),
            'content_after'   => json_encode($manualAfter),
            'created_at'      => date('Y-m-d H:i:s'),
        ]);

        return redirect()->to('/pages')->with('pesan', 'Data berhasil diupdate!');
    }

    public function uploadImage()
    {
        $file = $this->request->getFile('file');
        if ($file && $file->isValid() && !$file->hasMoved()) {
            $newName = $file->getRandomName();
            $file->move(FCPATH . 'img/uploads', $newName);
            $url = base_url('img/uploads/' . $newName);
            return $this->response->setJSON(['location' => $url]);
        }
        return $this->response->setStatusCode(400)->setBody('Upload failed');
    }



    public function getManualDesc($slug)
    {
        $model = new \App\Models\NewManualModel();
        $data = $model->where('slug', $slug)->first();

        if ($data) {
            return $this->response->setJSON([
                'status' => 'success',
                'data' => $data
            ]);
        } else {
            return $this->response->setJSON([
                'status' => 'empty',
                'message' => 'Data tidak ditemukan'
            ]);
        }
    }

    public function manualForm($slug = null)
    {
        $model = new NewManualModel();
        $manual = null;
        if ($slug) {
            $manual = $model->where('slug', $slug)->first();
        }
        return view('pages/manual_form', [
            'manual' => $manual,
            'slug'   => $slug
        ]);
    }


    public function saveManual()
    {
        $model = new NewManualModel();
        $data = [
            'slug'         => $this->request->getPost('slug'),
            'layanan'      => $this->request->getPost('layanan'),
            'komponen'     => $this->request->getPost('komponen'),
            'deskripsi'    => $this->request->getPost('deskripsi'),
            'keterkaitan'  => $this->request->getPost('keterkaitan'),
            'penyedia'     => $this->request->getPost('penyedia'),
            'jam'          => $this->request->getPost('jam'),
            'target'       => $this->request->getPost('target'),
            'jamDukungan'  => $this->request->getPost('jamDukungan'),
            'unit'         => $this->request->getPost('unit'),
            'lastVersion'  => $this->request->getPost('lastVersion'),
        ];
        $model->insert($data);
        return redirect()->to('/pages/manual/' . $data['slug'])->with('success', 'Data berhasil ditambahkan');
    }


    public function updateDesc($slug)
    {
        $manualModel = new \App\Models\NewManualModel();
        $data = $this->request->getPost();

        $manualModel->where('slug', $slug)->set([
            'layanan'      => $data['layanan'],
            'komponen'     => $data['komponen'],
            'deskripsi'    => $data['deskripsi'],
            'keterkaitan'  => $data['keterkaitan'],
            'penyedia'     => $data['penyedia'],
            'jam'          => $data['jam'],
            'target'       => $data['target'],
            'jamDukungan'  => $data['jamDukungan'],
            'unit'         => $data['unit'],
            'lastVersion'  => $data['lastVersion'],
        ])->update();

        return redirect()->to('/pages/manual/' . $slug)->with('success', 'Deskripsi berhasil diubah');
    }

    public function editDesc($slug)
    {
        $manualModel = new \App\Models\NewManualModel();
        $manual = $manualModel->where('slug', $slug)->first();

        return view('pages/edit_desc', [
            'manual' => $manual,
            'slug'   => $slug
        ]);
    }

    public function saveOrUpdateManual()
    {
        $model = new \App\Models\NewManualModel();
        $slug = $this->request->getPost('slug');
        $data = [
            'slug'         => $slug,
            'layanan'      => $this->request->getPost('layanan'),
            'komponen'     => $this->request->getPost('komponen'),
            'deskripsi'    => $this->request->getPost('deskripsi'),
            'keterkaitan'  => $this->request->getPost('keterkaitan'),
            'penyedia'     => $this->request->getPost('penyedia'),
            'jam'          => $this->request->getPost('jam'),
            'target'       => $this->request->getPost('target'),
            'jamDukungan'  => $this->request->getPost('jamDukungan'),
            'unit'         => $this->request->getPost('unit'),
            'lastVersion'  => $this->request->getPost('lastVersion'),
        ];

        $existing = $model->where('slug', $slug)->first();

        if ($existing) {
            $model->where('slug', $slug)->set($data)->update();
            $msg = 'Data berhasil diubah';
        } else {
            $model->insert($data);
            $msg = 'Data berhasil ditambahkan';
        }

        if (!$slug) {
            return redirect()->to('/pages')->with('error', 'Slug tidak boleh kosong');
        }

        return redirect()->to('/pages/manual/' . $slug)->with('success', $msg);
    }
}
