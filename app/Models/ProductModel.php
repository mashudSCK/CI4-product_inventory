<?php
namespace App\Models;

use CodeIgniter\Model;

class ProductModel extends Model
{
    protected $table         = 'products';
    protected $primaryKey    = 'id';
    protected $allowedFields = ['product_name', 'description', 'price', 'image', 'stock', 'category'];
// Create
    public function createProduct($data)
    {
        return $this->insert($data);
    }
// Read
    public function getProduct($id)
    {
        return $this->find($id);
    }
// Update
    public function updateProduct($id, $data)
    {
        return $this->update($id, $data);

    }
// Delete
    public function deleteProduct($id)
    {
        return $this->delete($id);
    }
}
