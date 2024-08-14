<?php

namespace App\Controllers;

use Exception;
use App\Models\Product;
use App\Helpers\Session;
use App\Controllers\Controller;
use Symfony\Component\HttpFoundation\Request;

class ProductController extends Controller
{

    public function index()
    {
        $products = Product::all();
        $title    = "Data Products";

        return $this->view('product.index', compact('products', 'title'));
    }

    public function create()
    {
        return $this->view('product.create');
    }

    public function store(Request $request)
    {
        try {

            Product::create([
                'name'     => $request->get('name'),
                'qty'      => $request->get('qty'),
                'category' => $request->get('category'),
            ]);

            Session::set('success', 'Data berhasil disimpan');
            return $this->redirect('/products');
        } catch (Exception $error) {
            Session::set('error', 'Data gagal disimpan');
            return $this->redirect('/products');
        }
    }

    public function show(int $id)
    {
        $product  = Product::find($id)->first();
        $title    = "Detail Products";

        return $this->view('product.show', compact('product', 'title'));
    }

    public function edit(int $id)
    {
        $product = Product::find($id)->first();

        return $this->view('product.edit', compact('produc$product'));
    }

    public function update(Request $request, $id)
    {
        try {

            $product = Product::find($id);

            $product = $product->update([
                'name'     => $request->get('name'),
                'qty'      => $request->get('qty'),
                'category' => $request->get('category'),
            ]);

            Session::set('success', 'Data berhasil di update');
            return $this->redirect('/products');
        } catch (Exception $error) {
            Session::set('error', 'Data gagal di update');
            return $this->redirect('/products');
        }
    }

    public function destroy(int $id)
    {
        try {

            $product = Product::find($id);

            if (!$product->delete()) {
                throw new Exception;
            }

            Session::set('success', 'Data berhasil dihapus');
            return $this->redirect('/products');
        } catch (Exception $error) {
            Session::set('error', 'Data gagal dihapus');
            return $this->redirect('/products');
        }
    }
}
