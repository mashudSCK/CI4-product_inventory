<?php
namespace App\Controllers;

use App\Models\ProductModel;

class ProductController extends BaseController
{
    public function index()
    {
        $model            = new ProductModel();
        $perPage          = 9; // Number of products per page
        $page             = $this->request->getGet('page') ?? 1;
        $selectedCategory = $this->request->getGet('category');
        $search           = $this->request->getGet('search');

        $builder = $model;
        if ($selectedCategory) {
            $builder = $builder->where('category', $selectedCategory);
        }
        if ($search) {
            $builder = $builder->like('product_name', $search);
        }

        try {
            $data['products'] = $builder->paginate($perPage, 'products');
            $data['pager']    = $model->pager;
            // Get all unique categories for filter dropdown
            $data['categories'] = $model->select('category')->distinct()->orderBy('category')->findAll();
            $data['categories'] = array_filter(array_map(function ($row) {return $row['category'];}, $data['categories']));
            $data['selectedCategory'] = $selectedCategory;
            $data['search']           = $search;
        } catch (\Exception $e) {
            $data['products']         = [];
            $data['pager']            = null;
            $data['categories']       = [];
            $data['selectedCategory'] = $selectedCategory;
            $data['search']           = $search;
            session()->setFlashdata('error', 'Failed to fetch products: ' . $e->getMessage());
        }
        return view('product_view', $data);
    }

    public function create()
    {
        $validation = \Config\Services::validation();
        $rules      = [
            'product_name' => 'required|min_length[2]|max_length[100]',
            'description'  => 'required|min_length[2]|max_length[255]',
            'category'     => 'required|min_length[2]|max_length[100]',
            'price'        => 'required|numeric|greater_than_equal_to[0]',
            'stock'        => 'required|integer|greater_than_equal_to[0]',
            'image'        => 'permit_empty|is_image[image]|max_size[image,2048]|mime_in[image,image/jpg,image/jpeg,image/png]',
        ];

        if (! $this->validate($rules)) {
            return redirect()->back()->withInput()->with('error', implode('<br>', $validation->getErrors()));
        }

        $model     = new ProductModel();
        $imageFile = $this->request->getFile('image');
        $imageName = null;

        if ($imageFile && $imageFile->isValid() && ! $imageFile->hasMoved()) {
            $imageName = $imageFile->getRandomName();
            $imageFile->move('uploads/products', $imageName);
        }

        $data = [
            'product_name' => $this->request->getPost('product_name'),
            'description'  => $this->request->getPost('description'),
            'category'     => $this->request->getPost('category'),
            'price'        => $this->request->getPost('price'),
            'stock'        => $this->request->getPost('stock'),
            'image'        => $imageName,
        ];

        try {
            $model->createProduct($data);
            return redirect()->to('/products')->with('success', 'Product created successfully!');
        } catch (\Exception $e) {
            return redirect()->back()->withInput()->with('error', 'Failed to create product: ' . $e->getMessage());
        }
    }

    

    public function update($id)
    {
        $validation = \Config\Services::validation();
        $rules      = [
            'product_name' => 'required|min_length[2]|max_length[100]',
            'description'  => 'required|min_length[2]|max_length[255]',
            'category'     => 'required|min_length[2]|max_length[100]',
            'price'        => 'required|numeric|greater_than_equal_to[0]',
            'stock'        => 'required|integer|greater_than_equal_to[0]',
            'image'        => 'permit_empty|is_image[image]|max_size[image,2048]|mime_in[image,image/jpg,image/jpeg,image/png]',
        ];

        if (! $this->validate($rules)) {
            return redirect()->back()->withInput()->with('error', implode('<br>', $validation->getErrors()));
        }

        $model     = new ProductModel();
        $imageFile = $this->request->getFile('image');
        $imageName = null;

        if ($imageFile && $imageFile->isValid() && ! $imageFile->hasMoved()) {
            $imageName = $imageFile->getRandomName();
            $imageFile->move('uploads/products', $imageName);
        }

        $data = [
            'product_name' => $this->request->getPost('product_name'),
            'description'  => $this->request->getPost('description'),
            'category'     => $this->request->getPost('category'),
            'price'        => $this->request->getPost('price'),
            'stock'        => $this->request->getPost('stock'),
        ];
        if ($imageName) {
            $data['image'] = $imageName;
        }

        try {
            $model->updateProduct($id, $data);
            return redirect()->to('/products')->with('success', 'Product updated successfully!');
        } catch (\Exception $e) {
            return redirect()->back()->withInput()->with('error', 'Failed to update product: ' . $e->getMessage());
        }
    }

    public function delete($id)
    {
        $model = new ProductModel();
        try {
            $model->deleteProduct($id);
            return redirect()->to('/products')->with('success', 'Product deleted successfully!');
        } catch (\Exception $e) {
            return redirect()->to('/products')->with('error', 'Failed to delete product: ' . $e->getMessage());
        }
    }

    public function bulk_action()
    {
        $action      = $this->request->getPost('bulk_action');
        $selectedIds = $this->request->getPost('selected_ids');
        $model       = new ProductModel();

        if (! $selectedIds || ! is_array($selectedIds) || empty($action)) {
            return redirect()->back()->with('error', 'No products selected or no action chosen.');
        }

        try {
            if ($action === 'delete') {
                foreach ($selectedIds as $id) {
                    $model->deleteProduct($id);
                }
                return redirect()->to('/products')->with('success', 'Selected products deleted.');
            }
            // Add more actions as needed
            return redirect()->to('/products')->with('success', 'Bulk action completed.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Bulk action failed: ' . $e->getMessage());
        }
    }
}
