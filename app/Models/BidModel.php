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
        $query = $this->db->query('SELECT bids.*, customers.name AS customer_name, aircrafts.name AS aircraft_name, trips.name AS trip_name FROM bids JOIN customers ON bids.customer=customers.id JOIN aircrafts ON bids.aircraft=aircrafts.id JOIN trips ON trips.id=bids.trip');
        return $query->getResult();
    }

    public function get_bid_details($bid_id)
    {
        $query = $this->db->query('SELECT bids.*, aircrafts.name AS aircraft_name FROM bids LEFT JOIN aircrafts ON bids.aircraft=aircrafts.id WHERE bids.id="'.$bid_id.'"');
        return $query->getResult();
    }
}