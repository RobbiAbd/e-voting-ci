<?php 
namespace App\Models;

use CodeIgniter\Model;
use CodeIgniter\HTTP\RequestInterface;

class KandidatModel extends Model
{
	protected $table      = 'kandidat';
    protected $primaryKey = 'id_kandidat';
    protected $allowedFields = ['nama', 'visi', 'misi', 'avatar'];
    protected $useTimestamps = true;
    

    // datatables config
    protected $column_order = array(0,1,2,3,4,5,6);
    protected $column_search = array('nama');
    protected $order = array('created_at' => 'desc');
    protected $request;

    function __construct(RequestInterface $request = null)
    {
        parent::__construct();
       $this->request = $request;
    }

    public function get_kandidat_pemilih()
    {
        return $this->select('kandidat.nama, COUNT(pemilih.id_kandidat) as total_voting ')
                ->join('pemilih', 'pemilih.id_kandidat = kandidat.id_kandidat', 'left')
                ->groupBy('kandidat.nama')
                ->get()->getResultArray();
    }

    public function _get_datatables_query()
    {
        $i = 0;
        foreach ($this->column_search as $item){
        if($this->request->getPost('search')['value']){ 
            if($i===0){
                $this->groupStart();
                $this->like($item, $this->request->getPost('search')['value']);
            }
            else{
                $this->orLike($item, $this->request->getPost('search')['value']);
            }
            if(count($this->column_search) - 1 == $i)
                $this->groupEnd();
        }
        $i++;
        }

        if($this->request->getPost('order')){
            $this->orderBy($this->column_order[$this->request->getPost('order')['0']['column']], $this->request->getPost('order')['0']['dir']);
        } 
        else if(isset($this->order)){
            $order = $this->order;
            $this->orderBy(key($order), $order[key($order)]);
        }
    }

    public function get_datatables(){
        $this->_get_datatables_query();
        if($this->request->getPost('length') != -1)
        $this->limit($this->request->getPost('length'), $this->request->getPost('start'));
        $query = $this->get();
        return $query->getResult();
    }

    public function count_filtered(){
        $this->_get_datatables_query();
        return $this->countAllResults();
    }

    public function count_all(){
        $tbl_storage = $this->db->table($this->table);
        return $tbl_storage->countAllResults();
    }
}