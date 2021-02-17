<?php

/**
 * E-Voting Codeigniter 4
 * Robbi Abdul Rohman
 * https://github.com/robbiabd
 */

namespace App\Models;

use CodeIgniter\Model;
use CodeIgniter\HTTP\RequestInterface;
use Config\Services;

class UserModel extends Model
{
    protected $table      = 'users';
    protected $primaryKey = 'id_user';
    protected $allowedFields = ['nama', 'email', 'password', 'id_level'];
    protected $useTimestamps = true;


    // datatables config
    protected $column_order = array(0, 1, 2, 3, 4, 5);
    protected $column_search = array('nama', 'email');
    protected $order = array('created_at' => 'desc');
    protected $request;

    function __construct(RequestInterface $request = null)
    {
        parent::__construct();
        $this->request = $request;
    }

    public function _get_datatables_query()
    {
        $request = Services::request();
        $i = 0;
        foreach ($this->column_search as $item) {
            if ($request->getPost('search')['value']) {
                if ($i === 0) {
                    $this->groupStart();
                    $this->like($item, $request->getPost('search')['value']);
                } else {
                    $this->orLike($item, $request->getPost('search')['value']);
                }
                if (count($this->column_search) - 1 == $i)
                    $this->groupEnd();
            }
            $i++;
        }

        if ($request->getPost('order')) {
            $this->orderBy($this->column_order[$request->getPost('order')['0']['column']], $request->getPost('order')['0']['dir']);
        } else if (isset($this->order)) {
            $order = $this->order;
            $this->orderBy(key($order), $order[key($order)]);
        }
    }

    public function get_datatables()
    {
        $request = Services::request();
        $this->_get_datatables_query();
        if ($request->getPost('length') != -1)
            $this->limit($request->getPost('length'), $request->getPost('start'));
        $query = $this->get();
        return $query->getResult();
    }

    public function count_filtered()
    {
        $this->_get_datatables_query();
        return $this->countAllResults();
    }

    public function count_all()
    {
        $tbl_storage = $this->db->table($this->table);
        return $tbl_storage->countAllResults();
    }
}
