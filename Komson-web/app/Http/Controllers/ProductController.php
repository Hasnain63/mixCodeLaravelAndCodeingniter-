<?php

namespace App\Http\Controllers;

use App\Product;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use League\CommonMark\Extension\Table\Table;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $result['data'] = Product::all();
        return view('admin/product', $result);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function manage_product(Request $request, $id = '')
    {
        if ($id > 0) {
            $arr = Product::where(['id' => $id])->get();
            $result['name'] = $arr['0']->name;
            $result['quantity'] = $arr['0']->quantity;
            $result['generic'] = $arr['0']->generic;
            // $result['image'] = $arr['0']->image;
            $result['market_price'] = $arr['0']->market_price;
            $result['ex_factory_price'] = $arr['0']->ex_factory_price;
            $result['trade_price'] = $arr['0']->trade_price;
            $result['status'] = $arr['0']->status;
            $result['id'] = $arr['0']->id;
        } else {
            $result['name'] = '';
            $result['quantity'] = '';
            $result['generic'] = '';
            $result['image'] = '';
            $result['market_price'] = '';
            $result['trade_price'] = '';
            $result['ex_factory_price'] = '';
            $result['status'] = '';
            $result['id'] = 0;
        }
        // print_r($result);
        // die;

        return view('admin/manage_product', $result);
    }
    public function manage_product_process(Request $request)
    {
        if ($request->post('id') > 0) {
            $image_validation = 'mimes:jpeg,png,jgp';
        } else {
            $image_validation = 'required|mimes:jpeg,png,jgp';
        }
        $validator = validator::make($request->all(), [
            'name' => 'required|max:255',
            // 'image' =>  $image_validation,
            'quantity' => 'required|unique:products,quantity,' . $request->post('id'),

        ]);

        if ($validator->fails()) {
            // error
            return redirect('admin/product/manage_product')->withErrors($validator)->withInput();
        }
        if ($request->post('id') > 0) {
            $model = Product::find($request->post('id'));
            $msg = "Product Updated";
        } else {
            $model = new Product();
            $msg = "Product inserted";
        }
        // if ($request->hasFile('image')) {
        //     $image = $request->file('image');
        //     $ext = $image->extension();
        //     $image_name = time() . '.' . $ext;
        //     $image->storeAS('/public/media/products', $image_name);
        //     $model->image = $image_name;
        // }

        $model->name = $request->post('name');
        $model->quantity = $request->post('quantity');
        $model->generic = $request->post('generic');
        $model->market_price = $request->post('market_price');
        $model->trade_price = $request->post('trade_price');
        $model->ex_factory_price = $request->post('ex_factory_price');
        $model->status = 1;
        $model->save();
        $request->session()->flash('message',  $msg);
        return redirect('admin/product');
    }
    public function delete(Request $request, $id)
    {
        $model = Product::find($id);
        $model->delete();
        $request->session()->flash('error', 'Product Deleted');
        return redirect('admin/product');
    }
    public function status(Request $request, $status, $id)
    {
        $model = Product::find($id);
        $model->status = $status;
        $model->save();
        $request->session()->flash('message', 'Status Updated');
        return redirect('admin/product');
    }
}