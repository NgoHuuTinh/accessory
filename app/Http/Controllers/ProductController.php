<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\ProductRequest;
use App\Services\ProductService;


class ProductController extends Controller
{
    private $productService;

    public function __construct(ProductService $productService)
    {
        $this->productService = $productService;
    }

    /**
     * index
     * @param Request $request
     * @return mix
     */
    public function index(Request $request)
    {
        $data = $request->all();
        $paginator = $this->productService->getProductsList($data);
        return view('product.index', compact('paginator'));
    }

    /**
     * create
     *
     * @param ProductRequest $request
     * @return mixed
     */
    public function create(ProductRequest $request)
    {
        if ($request->isMethod('POST')) {
            $data = $request->validated();
            if ($this->productService->create($data)) {
                $request->session()->flash('success', 'Tạo mới thông tin linh kiện thiết bị thành công');
            } else {
                $request->session()->flash('error', 'Tạo mới thông tin linh kiện thiết bị thất bại');
            }
            return redirect()->route('get.products.index');
        }
        return view('product.form');
    }

    /**
     * update
     *
     * @param ProductRequest $request
     * @param int $id
     * @return json
     */
    public function update(ProductRequest $request, int $id)
    {
        $product = $this->productService->findById($id);
        if (!$product) {
            $request->session()->flash('error', 'Linh kiện thiết bị này không tồn tại');
            return redirect()->route('get.products.index');
        }

        if ($request->isMethod('POST')) {
            $data = $request->validated();
            if ($this->productService->update($id, $data)) {
                $request->session()->flash('success', 'Chỉnh sửa thông tin linh kiện thiết bị thành công');
            } else {
                $request->session()->flash('error', 'Chỉnh sửa thông tin linh kiện thiết bị thất bại');
            }
            return redirect()->route('get.products.index');
        }
        return view('product.form', compact('product'));
    }

    /**
     * delete
     * 
     * @param ProductRequest $request
     * @param int $id
     * @return mixed
     */
    public function delete(Request $request, int $id)
    {
        $product = $this->productService->findById($id);
        if (!$product) {
            $request->session()->flash('error', 'Linh kiện thiết bị này không tồn tại');
            return redirect()->route('get.products.index');
        }

        if ($this->productService->delete($id)) {
            $request->session()->flash('success', 'Xóa thông tin linh kiện thiết bị thành công');
        } else {
            $request->session()->flash('error', 'Xóa thông tin linh kiện thiết bị thất bại');
        }
        return redirect()->route('get.products.index');
    }
}
