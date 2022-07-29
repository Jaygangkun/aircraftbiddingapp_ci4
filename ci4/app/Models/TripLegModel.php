<?php 
namespace App\Models;
use CodeIgniter\Model;

class TripLegModel extends Model
{
    protected $table = 'trip_legs';
    protected $primaryKey = 'id';

	protected $returnType = 'array';

	protected $allowedFields = ['name', 'trip', 'from', 'to', 'date', 'time'];

    protected $db;
}