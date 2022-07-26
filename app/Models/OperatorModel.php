<?php 
namespace App\Models;
use CodeIgniter\Model;

class OperatorModel extends Model
{
    protected $table = 'operators';
    protected $primaryKey = 'id';

	protected $returnType = 'array';

	protected $allowedFields = ['name', 'telephone', 'contact'];

    protected $db;

    // public function get_all_data()
    // {
    //     $query = $this->db->query('SELECT * FROM ' . $this->table);
    //     return $query->getResult();
    // }
}