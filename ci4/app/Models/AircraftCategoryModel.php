<?php 
namespace App\Models;
use CodeIgniter\Model;

class AircraftCategoryModel extends Model
{
    protected $table = 'aircraft_categories';
    protected $primaryKey = 'id';

	protected $returnType = 'array';

	protected $allowedFields = ['name'];

    protected $db;
}