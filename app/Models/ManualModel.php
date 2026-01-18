<?php

namespace App\Models;

use CodeIgniter\Model;
use Myth\Auth\Authorization\GroupModel;
use Myth\Auth\Authentication\Authenticator;

class ManualModel extends Model
{
    protected $table = 'manuals';
    protected $primaryKey = 'id';
    protected $useTimestamps = true;
    protected $allowedFields = ['id', 'title', 'slug', 'editor', 'content', 'icon', 'description', 'versioning', 'category', 'link', 'published', 'status'];

    protected $app_flag;

    public function __construct()
    {
        parent::__construct();
        $this->app_flag = getenv('appFlag') ?? false; // Default to false if not set
    }

    public function getAllAppbyCategory($category)
    {
        $query = $this->join('newmanual', 'newmanual.id = manuals.id')
            ->where('manuals.category', $category);

        if (!$this->app_flag) {
            $query->where('manuals.category', 'eksternal');
        }

        return $query->get()->getResultArray();
    }

    public function deleteAll($id)
    {
        $slug = $this->select('slug')->where('id', $id)->first()['slug'];
        $query = $this->where('slug', $slug);

        if (!$this->app_flag) {
            $query->where('category', 'eksternal');
        }

        $query->delete();
    }

    public function getAllManualsHistory($slug = false, $versioning = false)
    {
        $query = $this->where('slug', $slug);

        if ($versioning) {
            $query->where('versioning', $versioning);
        }

        if (!$this->app_flag) {
            $query->where('category', 'eksternal');
        }

        return $versioning ? $query->first() : $query->orderBy('versioning', 'DESC')->findAll();
    }

    public function countAllManualsHistory($slug = false)
    {
        $query = $this->where('slug', $slug);

        if (!$this->app_flag) {
            $query->where('category', 'eksternal');
        }

        return $query->countAllResults();
    }

    public function deleteOldestManuals($slug = false)
    {
        $query = $this->where('slug', $slug)->orderBy('versioning', 'ASC')->limit(1);

        if (!$this->app_flag) {
            $query->where('category', 'eksternal');
        }

        $query->delete();
    }

    public function getAvailableManualsID($slug = false)
    {
        $query = $this->select('id')->where('slug', $slug);

        if (!$this->app_flag) {
            $query->where('category', 'eksternal');
        }

        return $query->get()->getRowArray()['id'];
    }

    public function getSlug($id)
    {
        $query = $this->select('slug')->where('id', $id);

        if (!$this->app_flag) {
            $query->where('category', 'eksternal');
        }

        return $query->first()['slug'];
    }

    public function getNewestManuals($slug = false)
    {
        if (!$slug) {
            if (in_groups('admin')) {
                $query = $this->join('newmanual', 'newmanual.id = manuals.id');
            } else {
                $query = $this->join('newmanual', 'newmanual.slug = manuals.slug')
                    ->where('manuals.published', 1)
                    ->where('manuals.versioning = newmanual.lastVersion', null, false);
            }

            if (!$this->app_flag) {
                $query->where('manuals.category', 'eksternal');
            }

            return $query->findAll();
        } else {
            if (in_groups('admin')) {
                $query = $this->join('newmanual', 'newmanual.id = manuals.id')
                    ->where('manuals.slug', $slug);
            } else {
                $query = $this->join('newmanual', 'newmanual.slug = manuals.slug')
                    ->where('manuals.published', 1)
                    ->where('manuals.versioning = newmanual.lastVersion', null, false)
                    ->where('manuals.slug', $slug);
            }

            if (!$this->app_flag) {
                $query->where('manuals.category', 'eksternal');
            }

            return $query->first();
        }
    }

    public function search($keyword)
    {
        $query = $this->select('*')
            ->join('newmanual', 'newmanual.id = manuals.id')
            ->like('title', $keyword)
            ->orLike('content', $keyword);

        if (!$this->app_flag) {
            $query->where('manuals.category', 'eksternal');
        }

        return $query->findAll();
    }

    public function getAllHistory()
    {
        $query = $this->orderBy('created_at', 'DESC');
        if (!$this->app_flag) {
            $query->where('category', 'eksternal');
        }
        return $query->findAll();
    }
}
