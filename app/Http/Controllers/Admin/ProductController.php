<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Model\Attribute;
use App\Repositories\AttributeRepository;
use App\Repositories\IAttributeRepository;
use App\Model\Product;
use Illuminate\Http\Request;
use Illuminate\Validation\Validator;
use App\Model\ProductCategory;

class ProductController extends Controller
{
    private $repository;

    public function __construct(AttributeRepository $repository)
    {
        $this->repository = $repository;
    }

    public function index()
    {
        return view('admin.product.index');
    }

    public function create()
    {
        $productCategories = ProductCategory::all();
        $attributes = Attribute::query()
            ->with(['children'])->where('parent', '=', 0)->get();
        return view('admin.product.create', compact('productCategories', 'attributes'));
    }

    public function edit($id)
    {
        $productCategories = ProductCategory::all();
        $products = Product::where('id', $id)->first();
        return view('admin.product.edit', compact('productCategories', 'products'));
    }

    public function duplicate($id)
    {
        $productCategories = ProductCategory::all();
        $products = Product::where('id', $id)->first();
        return view('admin.product.duplicate', compact('productCategories', 'products'));
    }

    public function category()
    {
        return view('admin.product.category');
    }

    public function attribute()
    {
        return view('admin.product.attribute');
    }

    public function variation($id)
    {
        try {
            $attribute = $this->repository->show($id);
            return view('admin.product.variation', ['data' => $attribute]);
        } catch (\Throwable $th) {
            return abort(404);
        }
    }
}
