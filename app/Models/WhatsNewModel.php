<?php

namespace App\Models;

use App\Controllers\WhatsNew;
use CodeIgniter\Model;

class WhatsNewModel extends Model
{
    protected $table = 'whatsnew';
    protected $primaryKey = 'id';
    protected $useTimestamps = false;
    protected $allowedFields = [
        'nama',
        'versi',
        'category',
        'tanggal',
        'short_desc',
        'full_desc',
        'user_manual_link',
        'slug'
    ];

    protected $app_flag;

    public function __construct()
    {
        parent::__construct();
        $this->app_flag = getenv('appFlag') ?? false; // Default to false if not set
    }

    public function getWhatsNew($slug = false)
    {
        if (!$slug) {
            $query = $this->select('*')->table('whatsnew');
            if (!$this->app_flag) {
                $query->where('whatsnew.category', 'eksternal');
            }
            return $query->findAll();
        } else {
            $query = $this->select('*')->table('whatsnew')->where('whatsnew.slug', $slug);
            if (!$this->app_flag) {
                $query->where('whatsnew.category', 'eksternal');
            }
            return $query->first();
        }
    }

    public function search($keyword)
    {
        $query = $this->select('*')
            ->table('whastnew')
            ->like('judul', $keyword);

        if (!$this->app_flag) {
            $query->where('whatsnew.category', 'eksternal');
        }

        return $query->findAll();
    }
}
