<?php

namespace App\Http\Controllers;

use App\Doctor;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class DoctorController extends Controller
{
    public function index()
    {
        $result['data'] = Doctor::all();
        return view('admin/doctor', $result);
    }


    public function manage_doctor(Request $request, $id = '')
    {
        if ($id > 0) {
            $arr = Doctor::where(['id' => $id])->get();
            $result['brick_name'] = $arr['0']->brick_name;
            $result['pmdc_no'] = $arr['0']->pmdc_no;
            $result['name'] = $arr['0']->name;
            $result['dateof_birth'] = $arr['0']->dateof_birth;
            $result['cnic'] = $arr['0']->cnic;
            $result['mobile'] = $arr['0']->mobile;
            $result['qualification'] = $arr['0']->qualification;
            $result['designation'] = $arr['0']->designation;
            $result['activity'] = $arr['0']->activity;
            $result['morning_address'] = $arr['0']->morning_address;
            $result['evening_address'] = $arr['0']->evening_address;
            $result['par_day_patients'] = $arr['0']->par_day_patients;
            $result['select_type'] = $arr['0']->evening_address;
            $result['status'] = $arr['0']->status;
            $result['id'] = $arr['0']->id;
        } else {
            $result['brick_name'] = '';
            $result['pmdc_no'] = '';
            $result['name'] = '';
            $result['dateof_birth'] = '';
            $result['cnic'] = '';
            $result['mobile'] = '';
            $result['qualification'] = '';
            $result['designation'] = '';
            $result['activity'] = '';
            $result['morning_address'] = '';
            $result['evening_address'] = '';
            $result['par_day_patients'] = '';
            $result['select_type'] = '';
            $result['status'] = '';
            $result['id'] = 0;
        }
        // print_r($result);
        // die;

        return view('admin/manage_doctor', $result);
    }
    public function manage_doctor_process(Request $request)
    {
        $validator = validator::make($request->all(), [
            'name' => 'required|max:255',
        ]);

        if ($validator->fails()) {
            // error
            return redirect('admin/doctor/manage_doctor')->withErrors($validator)->withInput();
        }
        if ($request->post('id') > 0) {
            $model = Doctor::find($request->post('id'));
            $msg = "Doctor Updated";
        } else {
            $model = new Doctor();
            $msg = "Doctor inserted";
        }
        $model->brick_name     = $request->post('brick_name');
        $model->pmdc_no = $request->post('pmdc_no');
        $model->name = $request->post('name');
        $model->dateof_birth = $request->post('dateof_birth');
        $model->cnic = $request->post('cnic');
        $model->mobile = $request->post('mobile');
        $model->qualification = $request->post('qualification');
        $model->designation = $request->post('designation');
        $model->activity = $request->post('activity');
        $model->morning_address = $request->post('morning_address');
        $model->evening_address = $request->post('evening_address');
        $model->par_day_patients = $request->post('par_day_patients');
        $model->select_type = $request->post('select_type');
        $model->status = 1;
        $model->save();
        $request->session()->flash('message',  $msg);
        return redirect('admin/doctor');
    }

    public function delete(Request $request, $id)
    {
        $model = Doctor::find($id);
        $model->delete();
        $request->session()->flash('error', 'Doctor Deleted');
        return redirect('admin/doctor');
    }
    public function status(Request $request, $status, $id)
    {
        $model = Doctor::find($id);
        $model->status = $status;
        $model->save();
        $request->session()->flash('message', 'Status Updated');
        return redirect('admin/doctor');
    }
}