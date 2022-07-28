<?php 
namespace App\Models;
use CodeIgniter\Model;

class AircraftModel extends Model
{
    protected $table = 'aircrafts';
    protected $primaryKey = 'id';

	protected $returnType = 'array';

	protected $allowedFields = ['name'];

    protected $db;
}