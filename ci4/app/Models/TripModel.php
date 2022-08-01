<?php 
namespace App\Models;
use CodeIgniter\Model;

class TripModel extends Model
{
    protected $table = 'trips';
    protected $primaryKey = 'id';

	protected $returnType = 'array';

	protected $allowedFields = ['name', 'customer', 'date', 'pax', 'aircraft_category', 'note', 'status'];

    protected $db;

}