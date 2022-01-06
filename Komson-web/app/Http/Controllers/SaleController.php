<?php

namespace App\Http\Controllers;

use App\Doctor;
use App\Http\Requests\SaleStoreRequest;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use App\Product;
use App\Sale;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use League\CommonMark\Extension\Table\Table;

class SaleController extends Controller
{
    public function index()
    {
        $result['data'] = Sale::all();
        //dd($result['data']);
        return view('admin/sale', $result);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function manage_sale(Request $request, $id = '')
    {

        if ($id > 0) {
            $arr = Sale::where(['id' => $id])->get();
            $result['doctor_name'] = $arr['0']->doctor_name;
            $result['distributor_name'] = $arr['0']->distributor_name;
            $result['product_name'] = $arr['0']->product_name;
            $result['quentity'] = $arr['0']->quentity;
            $result['activity'] = $arr['0']->activity;
            $result['totel_value'] = $arr['0']->totel_value;
            $result['status'] = $arr['0']->status;
            $result['id'] = $arr['0']->id;
        } else {
            $result['doctor_name'] = '';
            $result['distributor_name'] = '';
            $result['product_name'] = '';
            $result['quentity'] = '';
            $result['activity'] = '';
            $result['totel_value'] = '';
            $result['status'] = '';
            $result['id'] = 0;
        }
        // print_r($result);
        // die;
        $result['doctor'] = DB::table('doctors')->where(['status' => 1])->get();
        $result['product'] = DB::table('products')->where(['status' => 1])->get();
        $result['distributor'] = DB::table('distributors')->where(['status' => 1])->get();
        return view('admin/manage_sale', $result);
    }
    public function manage_sale_process(SaleStoreRequest $request)
    {
        if ($request->post('id') > 0) {
            $model = Sale::find($request->post('id'));
            $msg = "Sale Updated";
            $product_name = $request->post('product_name');
            $quentity = $request->post('quentity');
            if ($product_name) {
                for ($index = 0; $index < count($request->post('product_name')); $index++) {
                    $model = new Sale();
                    $model->doctor_name = $request->post('doctor_name');
                    $model->distributor_name = $request->post('distributor_name');
                    $model->product_name = $product_name[$index];
                    $model->quentity = $quentity[$index];
                    $model->activity = $request->post('activity');
                    $model->totel_value = $request->post('totel_value');
                    $model->status = 1;
                    $model->save();
                }
            }
        } else {
            $msg = "Sale inserted";
            $product_name = $request->post('product_name');
            $quentity = $request->post('quentity');
            if ($product_name) {
                for ($index = 0; $index < count($request->post('product_name')); $index++) {
                    $model = new Sale();
                    $model->doctor_name = $request->post('doctor_name');
                    $model->distributor_name = $request->post('distributor_name');
                    $model->product_name = $product_name[$index];
                    $model->quentity = $quentity[$index];
                    $model->activity = $request->post('activity');
                    $model->totel_value = $request->post('totel_value');
                    $model->status = 1;
                    $model->save();
                }
            }
        }


        $request->session()->flash('message',  $msg);
        return redirect('admin/sale');
    }
    public function delete(Request $request, $id)
    {
        $model = sale::find($id);
        $model->delete();
        $request->session()->flash('error', 'Sale Deleted');
        return redirect('admin/sale');
    }
    public function status(Request $request, $status, $id)
    {
        $model = Sale::find($id);
        $model->status = $status;
        $model->save();
        $request->session()->flash('message', 'Status Updated');
        return redirect('admin/sale');
    }
    public function get_activity(Request $request)
    {
        if ($request->ajax()) {
            $data = $request->all();
            $getActivity = Doctor::where(['name' => $data['doctor_id']])->select('activity')->get();
            //$getActivity = json_decode(json_encode($getActivity), true);
            return view('admin.add_activity')->with(compact('getActivity'));
        }
    }
}