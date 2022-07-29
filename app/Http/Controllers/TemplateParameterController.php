<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TemplateParameterController extends Controller
{
     public function index(){
        // echo 'template list will be here...';
        
        if(session('email') == ""){
            return redirect('/');
        }
        else{
            $templates = DB::table('tbl_template')->get();
            return view('pages.template-parameters.templates', ['templates'=>$templates]);
        }

    }
    
    public function parameter_list(Request $request, $id){
        // echo 'template list will be here...';
        if(session('email') == ""){
            return redirect('/');
        }
        else{
            $template = DB::table('tbl_template')->where('id', $id)->get();
            $parameters = DB::table('tbl_template_parameters')->where('template_id', $id)->get();
            return view('pages.template-parameters.parameters', ['parameters'=>$parameters, 'template'=>$template]);
        }

    }
    
    public function add_parameter($id){
        // echo 'Add a template...';
        if(session('email') == ""){
            return redirect('/');
        }
        else{
            
            return view('pages.template-parameters.add-template-parameter', ['template_id'=>$id]);
        }

    }

    public function add_parameter_data(Request $request,$id){

        if($request->session()->get('email') == ""){
            return redirect('/');
        }
        else{
            
            $ins_data = [
                'template_id'=> $id,
                'type'=>$request->input('type'),
                'parameter'=>$request->input('parameter'),
                'text_length'=>$request->input('text_length'),
                'is_required'=>$request->input('is_required'),
                'status'=>'1'
            ];
            // $users = DB::table('template_type')->insert($ins_data);
            $users = DB::table('tbl_template_parameters')->insertGetId($ins_data);
            if($users){
                return redirect()->to('/dashboard/template-parameter/list/'.$id)->withErrors([
                    'error_msg' => 'Parameter added successfully.',
                ]);
            }
        }

    }
    
    public function update_template_parameter(Request $request, $id){
        if($request->session()->get('email') == ""){
            return redirect('/');
        }
        else{
           
            $template_data = DB::table('tbl_template_parameters')->where('id', $id)->first();
            return view('pages.template-parameters.update-template-parameter', ['template_data'=>$template_data]);
        }

    }

    public function update_template_parameter_data(Request $request){

        if($request->session()->get('email') == ""){
            return redirect('/');
        }
        else{
            // return $request->all();
            $mytime = Carbon::now();
            
            $tp_id=$request->input('template_id');

            $upd_data = [
                'type'=>$request->input('type'),
                'parameter'=>$request->input('parameter'),
                'text_length'=>$request->input('text_length'),
                'is_required'=>$request->input('is_required')
            ];

            $users = DB::table('tbl_template_parameters')
            ->where('id', $request->input('id'))
            ->update($upd_data);

            if($users){
                return redirect()->to('/dashboard/template-parameter/list/'.$tp_id)->withErrors([
                    'error_msg' => 'Parameter updated successfully.',
                ]);
            }
            else{
                return redirect()->back()->withErrors([
                    'error_msg' => 'Failed to update parameter.',
                ]);
            }
        }

    }
    
    public function delete_template_parameter($id){
        if(session('email') == ""){
            return redirect('/');
        }
        else{
            $tp = DB::table('tbl_template_parameters')->where('id', $id)->get();
            $tp_id=$tp[0]->template_id;
            $template = DB::table('tbl_template_parameters')->where('id', $id)->delete();
            if($template){
                return redirect()->to('/dashboard/template-parameter/list/'.$tp_id)->withErrors([
                    'error_msg' => 'Template Parameter deleted successfully.',
                ]);
            }
            else{
                return redirect()->back();
            }
        }

    }

    public function status_change($id, $op){

        if(session('email') == ""){
            return redirect('/');
        }
        else{
            $tp = DB::table('tbl_template_parameters')->where('id', $id)->get();
            $tp_id=$tp[0]->template_id;
            $users = DB::table('tbl_template_parameters')
            ->where('id', $id)
            ->update([
                'status' => $op
            ]);

            if($users){
                return redirect()->to('/dashboard/template-parameter/list/'.$tp_id)->withErrors([
                    'error_msg' => 'Parameter status updated successfully.',
                ]);
            }
            else{
                return redirect()->back()->withErrors([
                    'error_msg' => 'Failed to update parameter status.',
                ]);
            }
        }

    }
}