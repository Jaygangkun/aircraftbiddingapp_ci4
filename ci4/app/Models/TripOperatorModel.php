<?php 
namespace App\Models;
use CodeIgniter\Model;

class TripOperatorModel extends Model
{
    protected $table = 'trip_operators';
    protected $primaryKey = 'id';

	protected $returnType = 'array';

	protected $allowedFields = ['trip', 'operator', 'pax', 'cost', 'aircraft', 'status'];

    protected $db;

    public function get_trip_operators_table_data($trip_id)
    {
        $query = $this->db->query('SELECT trip_operators.*, operators.name AS operator_name, aircrafts.name AS aircraft_name, aircraft_categories.name AS aircraft_category_name, aircraft_categories.id AS aircraft_category_id FROM trip_operators LEFT JOIN operators ON trip_operators.operator=operators.id LEFT JOIN aircrafts ON trip_operators.aircraft=aircrafts.id LEFT JOIN aircraft_categories ON aircrafts.category=aircraft_categories.id WHERE trip_operators.trip="'.$trip_id.'"');
        return $query->getResult();
    }
}