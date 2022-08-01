<?php 
namespace App\Models;
use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table = 'users';
    protected $primaryKey = 'id';

	protected $returnType = 'array';

	protected $allowedFields = ['username', 'email', 'password', 'status', 'role'];

    protected $db;

    public function checkUser($username, $password)
    {
        $query = $this->db->query('SELECT * FROM users WHERE username="'.$username.'" AND password="'.$password.'"');

        $result = $query->getResult();
        if(count($result)) {
            return $result[0];
        }

        return null;
    }
}