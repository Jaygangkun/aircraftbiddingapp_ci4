<?php 
namespace App\Models;
use CodeIgniter\Model;

class OperatorBidModel extends Model
{
    protected $table = 'operator_bids';
    protected $primaryKey = 'id';

	protected $returnType = 'array';

	protected $allowedFields = ['bid', 'operator', 'pax', 'cost', 'aircraft', 'status'];

    protected $db;

    public function get_bid_operators_table_data($bid_id)
    {
        $query = $this->db->query('SELECT operator_bids.*, operators.name AS operator_name, aircrafts.name AS aircraft_name, aircraft_categories.name AS aircraft_category_name, aircraft_categories.id AS aircraft_category_id FROM operator_bids LEFT JOIN operators ON operator_bids.operator=operators.id LEFT JOIN aircrafts ON operator_bids.aircraft=aircrafts.id LEFT JOIN aircraft_categories ON aircrafts.category=aircraft_categories.id WHERE operator_bids.bid="'.$bid_id.'"');
        return $query->getResult();
    }
}