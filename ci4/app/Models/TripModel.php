<?php 
namespace App\Models;
use CodeIgniter\Model;

class TripModel extends Model
{
    protected $table = 'trips';
    protected $primaryKey = 'id';

	protected $returnType = 'array';

	protected $allowedFields = ['name', 'date_from', 'date_to', 'place_from', 'place_to'];

    protected $db;
}