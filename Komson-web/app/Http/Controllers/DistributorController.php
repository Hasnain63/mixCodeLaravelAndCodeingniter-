<?php

namespace App\Http\Controllers;

use App\Distributor;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use League\CommonMark\Extension\Table\Table;

class DistributorController extends Controller
{
    public function index()
    {
        $result['data'] = Distributor::all();
        return view('admin/distributor', $result);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function manage_distributor(Request $request, $id = '')
    {
        if ($id > 0) {
            $arr = Distributor::where(['id' => $id])->get();
            $result['name'] = $arr['0']->name;
            $result['area'] = $arr['0']->area;
            $result['sale'] = $arr['0']->sale;
            $result['status'] = $arr['0']->status;
            $result['id'] = $arr['0']->id;
        } else {
            $result['name'] = '';
            $result['area'] = '';
            $result['sale'] = '';
            $result['status'] = '';
            $result['id'] = 0;
        }
        // print_r($result);
        // die;

        return view('admin/manage_distributor', $result);
    }
    public function manage_distributor_process(Request $request)
    {
        if ($request->post('id') > 0) {
            $image_validation = 'mimes:jpeg,png,jgp';
        } else {
            $image_validation = 'required|mimes:jpeg,png,jgp';
        }
        $validator = validator::make($request->all(), [
            'name' => 'required|max:255',
            // 'image' =>  $image_validation,
            'area' => 'required|unique:distributors,area,' . $request->post('id'),

        ]);

        if ($validator->fails()) {
            // error
            return redirect('admin/distributor/manage_distributor')->withErrors($validator)->withInput();
        }
        if ($request->post('id') > 0) {
            $model = Distributor::find($request->post('id'));
            $msg = "Distributor Updated";
        } else {
            $model = new Distributor();
            $msg = "Distributor inserted";
        }
        $model->name = $request->post('name');
        $model->area = $request->post('area');
        $model->sale = $request->post('sale');
        $model->status = 1;
        $model->save();
        $request->session()->flash('message',  $msg);
        return redirect('admin/distributor');
    }
    public function delete(Request $request, $id)
    {
        $model = Distributor::find($id);
        $model->delete();
        $request->session()->flash('error', 'Distributor Deleted');
        return redirect('admin/distributor');
    }
    public function status(Request $request, $status, $id)
    {
        $model = Distributor::find($id);
        $model->status = $status;
        $model->save();
        $request->session()->flash('message', 'Status Updated');
        return redirect('admin/distributor');
    }
}