<?php 
namespace App\Models;
use CodeIgniter\Model;

class BidModel extends Model
{
    protected $table = 'bids';
    protected $primaryKey = 'id';

	protected $returnType = 'array';

	protected $allowedFields = ['customer', 'operator_bids', 'trip', 'date', 'pax', 'cost', 'aircraft', 'status'];

    protected $db;

    public function get_bids_table_data()
    {
        $query = $this->db->query('SELECT bids.*, customers.name AS customer_name, aircrafts.name AS aircraft_name, trips.name AS trip_name, aircraft_categories.name AS aircraft_category_name, aircraft_categories.id AS aircraft_category_id FROM bids LEFT JOIN customers ON bids.customer=customers.id LEFT JOIN aircrafts ON bids.aircraft=aircrafts.id LEFT JOIN trips ON trips.id=bids.trip LEFT JOIN aircraft_categories ON aircrafts.category=aircraft_categories.id');
        return $query->getResult();
    }

    public function get_bid_details($bid_id)
    {
        $query = $this->db->query('SELECT bids.*, aircrafts.name AS aircraft_name FROM bids LEFT JOIN aircrafts ON bids.aircraft=aircrafts.id WHERE bids.id="'.$bid_id.'"');
        return $query->getResult();
    }
}