<?php

namespace App\Models;

use CodeIgniter\Database\MySQLi\Builder;
use CodeIgniter\Model;

class NewManualModel extends Model
{
    protected $table      = 'newmanual';
    protected $primaryKey = 'slug';
    // Dates
    protected $useTimestamps = false;
    protected $useAutoIncrement = false;
    protected $allowedFields = ['id', 'slug', 'jam', 'jamDukungan', 'target', 'penyedia', 'keterkaitan', 'deskripsi', 'unit', 'layanan', 'komponen', 'lastVersion'];


    public function deleteAll($id)
    {
        $slug = $this->select('slug')->where(['id' => $id])->findAll()[0]['slug'];
        $this->where('slug', $slug)->delete();
    }
}
