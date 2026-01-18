<?php

namespace App\Controllers;

use App\Models\WhatsNewModel;
use App\Models\HistoryWhatsnewModel;

class WhatsNew extends BaseController
{
    protected $whatsNewModel;
    public function __construct()
    {
        $this->whatsNewModel = new WhatsNewModel();
    }

    public function index()
    {
        $data['whatsnew'] = $this->whatsNewModel->findAll();
        return view('whatsnew/index', $data);
    }

    public function detail($slug)
    {
        $model = new \App\Models\WhatsNewModel();
        $new = $model->where('slug', $slug)->first();

        if (!$new) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound("What's New tidak ditemukan");
        }

        return view('whatsnew/detail', [
            'new' => $new,
            'title' => 'Detail Whats New'
        ]);
    }

    public function save()
    {
        helper(['form']);
        $rules = [
            'nama' => 'required',
            'versi' => 'required',
            'category' => 'required',
            'tanggal' => 'required',
            'short_desc' => 'required',
            'full_desc' => 'required',
            'user_manual_link' => 'required',
        ];

        if (!$this->validate($rules)) {
            session()->setFlashdata('validation_errors', $this->validator->getErrors());
            session()->setFlashdata('pesan', 'Isi tidak boleh kosong.');
            return redirect()->to('/whatsnew/create')->withInput();
        }

        $whatsnewModel = new \App\Models\WhatsNewModel();
        $data = [
            'nama' => $this->request->getVar('nama'),
            'versi' => $this->request->getVar('versi'),
            'category' => $this->request->getVar('category'),
            'tanggal' => $this->request->getVar('tanggal'),
            'short_desc' => $this->request->getVar('short_desc'),
            'full_desc' => $this->request->getVar('full_desc'),
            'user_manual_link' => $this->request->getVar('user_manual_link'),
            'slug' => url_title($this->request->getVar('nama'), '-', true) . '-' . $this->request->getVar('versi')
        ];
        $whatsnewModel->insert($data);

        $historyModel = new HistoryWhatsnewModel();
        $changedBy = session('username') ?? (user()->username ?? 'admin');
        $historyModel->insert([
            'whatsnew_id' => $whatsnewModel->getInsertID(),
            'action' => 'create',
            'changed_by' => $changedBy,
            'changed_at' => date('Y-m-d H:i:s'),
            'old_data' => null,
            'new_data' => json_encode($data)
        ]);

        session()->setFlashdata('pesan', "Kamu berhasil membuat What's New ini.");

        return redirect()->to('/whatsnew');
    }

    public function delete($id)
    {
        $whatsnewModel = new \App\Models\WhatsNewModel();
        $historyModel = new HistoryWhatsnewModel();

        $whatsnew = $whatsnewModel->find($id);

        $changedBy = session('username') ?? (user()->username ?? 'admin'); 
        $historyModel->insert([
            'whatsnew_id' => $id,
            'action' => 'delete',
            'changed_by' => $changedBy,
            'changed_at' => date('Y-m-d H:i:s'),
            'old_data' => json_encode($whatsnew),
            'new_data' => null
        ]);

        $whatsnewModel->delete($id);

        session()->setFlashdata('pesan', 'Data berhasil dihapus.');
        return redirect()->to('/whatsnew');
    }

    public function create()
    {
        helper(['form']);

        $model = new \App\Models\WhatsNewModel();
        $data['whatsnew'] = $model->findAll();

        if ($this->request->getMethod() === 'post') {
            $rules = [
                'nama' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Nama harus diisi.'
                    ]
                ],
                'versi' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Versi harus diisi.'
                    ]
                ],
                'category' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Kategori harus diisi.'
                    ]
                ],
                'tanggal' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Tanggal harus diisi.'
                    ]
                ],
                'short_desc' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Deskripsi singkat harus diisi.'
                    ]
                ],
                'full_desc' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Deskripsi lengkap harus diisi.'
                    ]
                ],
                'user_manual_link' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Link user manual harus diisi.'
                    ]
                ],
            ];

            if (!$this->validate($rules)) {
                return view('whatsnew/create', [
                    'validation' => $this->validator
                ]);
            }
        }

        return view('whatsnew/create');
    }

    public function edit($slug)
    {
        $whatsnewModel = new \App\Models\WhatsNewModel();
        $whatsnew = $whatsnewModel->where('slug', $slug)->first();

        if (!$whatsnew) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Data tidak ditemukan');
        }

        return view('whatsnew/edit', [
            'whatsnew' => $whatsnew,
            'errors'   => session()->getFlashdata('validation_errors') ?? []
        ]);
    }

    public function update($slug)
    {
        $whatsnewModel = new \App\Models\WhatsNewModel();
        $historyModel = new HistoryWhatsnewModel();

        $whatsnew = $whatsnewModel->where('slug', $slug)->first();
        $oldData = $whatsnew;

        if (!$whatsnew) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Data tidak ditemukan');
        }

        $validation = \Config\Services::validation();
        $rules = [
            'nama'            => 'required',
            'versi'           => 'required',
            'category'        => 'required',
            'tanggal'         => 'required',
            'short_desc'      => 'required',
            'full_desc'       => 'required',
            'user_manual_link' => 'required'
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()
                ->withInput()
                ->with('validation_errors', $validation->getErrors());
        }

        $data = [
            'nama'             => $this->request->getPost('nama'),
            'versi'            => $this->request->getPost('versi'),
            'category'         => $this->request->getPost('category'),
            'tanggal'          => $this->request->getPost('tanggal'),
            'short_desc'       => $this->request->getPost('short_desc'),
            'full_desc'        => $this->request->getPost('full_desc'),
            'user_manual_link' => $this->request->getPost('user_manual_link'),
        ];

        $whatsnewModel->update($whatsnew['id'], $data);

        $changedBy = session('username') ?? (user()->username ?? 'admin');

        $historyModel->insert([
            'whatsnew_id' => $whatsnew['id'],
            'action' => 'update',
            'changed_by' => $changedBy,
            'changed_at' => date('Y-m-d H:i:s'),
            'old_data' => json_encode($oldData),
            'new_data' => json_encode($data)
        ]);

        return redirect()->to('/whatsnew')->with('pesan', 'Data berhasil diupdate.');
    }

    public function history()
    {
        $db = \Config\Database::connect();
        $builder = $db->table('history_whatsnew');
        $builder->select('history_whatsnew.*, whatsnew.nama, whatsnew.versi');
        $builder->join('whatsnew', 'whatsnew.id = history_whatsnew.whatsnew_id', 'left');
        $builder->orderBy('history_whatsnew.changed_at', 'DESC');
        $query = $builder->get();
        $data['history'] = $query->getResultArray();

        return view('whatsnew/history', $data);
    }

    public function historyDetail($id)
    {
        $historyModel = new \App\Models\HistoryWhatsnewModel();
        $history = $historyModel->find($id);

        if (!$history) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException("What's New tidak ditemukan");
        }

        $new = null;
        $oldData = json_decode($history['old_data'], true);
        $newData = json_decode($history['new_data'], true);

        if ($newData) {
            $new = $newData;
        } elseif ($oldData) {
            $new = $oldData;
        }

        return view('whatsnew/detail', [
            'new' => $new,
            'history' => $history,
            'title' => 'Detail History Whats New'
        ]);
    }

    public function deleteHistory($id)
    {
        $historyModel = new \App\Models\HistoryWhatsnewModel();
        $historyModel->delete($id);

        return redirect()->to('/whatsnew/history')->with('pesan', 'History berhasil dihapus!');
    }
}

