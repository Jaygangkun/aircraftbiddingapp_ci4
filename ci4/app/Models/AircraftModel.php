<?php 
namespace App\Models;
use CodeIgniter\Model;

class AircraftModel extends Model
{
    protected $table = 'aircrafts';
    protected $primaryKey = 'id';

	protected $returnType = 'array';

	protected $allowedFields = ['name', 'category'];

    protected $db;

    public function get_aircrafts_with_category()
    {
        $query = $this->db->query('SELECT aircrafts.*, aircraft_categories.name AS aircraft_category_name FROM aircrafts LEFT JOIN aircraft_categories ON aircrafts.category=aircraft_categories.id');
        return $query->getResult();
    }

    public function get_aircraft_with_category_by_id($aircraft_id)
    {
        $query = $this->db->query('SELECT aircrafts.*, aircraft_categories.name AS aircraft_category_name FROM aircrafts LEFT JOIN aircraft_categories ON aircrafts.category=aircraft_categories.id WHERE aircrafts.id="'.$aircraft_id.'"');
        $result = $query->getResult();
        if(count($result) > 0) {
            return $result[0];
        }
        return null;
    }
}