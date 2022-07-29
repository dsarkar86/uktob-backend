<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;


class TemplateTypeController extends Controller
{

    public function index(){
        if(session('email') == ""){
            return redirect('/');
        }
        else{
            $template_types = DB::table('mst_template_type')->get();
            return view('pages.template-types.templates-types', ['template_types'=>$template_types]);
        }

    }

    public function add_template_type(Request $r){

        // echo session()->get('email');
        // echo 'Session : '.$r->session()->get('email');

        if($r->session()->get('email') == ""){
            return redirect('/');
        }
        else{
            return view('pages.template-types.add-template-types');
        }

    }

    public function add_template_type_data(Request $request){

        if($request->session()->get('email') == ""){
            return redirect('/');
        }
        else{

            $request->validate([
                'name' => 'required|max:10'
            ]);

            $ins_data = [
                'name'=>$request->input('name'),
                'status'=>'1'
            ];
            // $users = DB::table('template_type')->insert($ins_data);
            $users = DB::table('mst_template_type')->insertGetId($ins_data);
            if($users){
                return redirect()->to('/dashboard/template-type/list')->withErrors([
                    'error_msg' => 'Templates type added successfully.',
                ]);
            }
        }

    }

    public function update_template_type(Request $request, $id){
        if($request->session()->get('email') == ""){
            return redirect('/');
        }
        else{
            $template_data = DB::table('mst_template_type')->where('id', $id)->first();
            return view('pages.template-types.update-template-types', ['template_data'=>$template_data]);
        }

    }

    public function update_template_type_data(Request $request){
        if($request->session()->get('email') == ""){
            return redirect('/');
        }
        else{
            $mytime = Carbon::now();

            $upd_data = [
                'name' => $request->input('name'),
                'updated_at' => $mytime->toDateTimeString(),
                'status' => 1
            ];

            $users = DB::table('mst_template_type')
            ->where('id', $request->input('id'))
            ->update($upd_data);

            if($users){
                return redirect()->to('/dashboard/template-type/list')->withErrors([
                    'error_msg' => 'Template type updated successfully.',
                ]);
            }
            else{
                return redirect()->back()->withErrors([
                    'error_msg' => 'Failed to update template type.',
                ]);
            }
        }

    }

    public function delete_template_type($id){

        if(session('email') == ""){
            return redirect('/');
        }
        else{
            $template = DB::table('mst_template_type')->where('id', $id)->delete();
            if($template){
                return redirect()->to('/dashboard/template-type/list')->withErrors([
                    'error_msg' => 'Templates deleted successfully.',
                ]);
            }
            else{
                return redirect()->back();
            }
        }

    }

    public function status_change($id, $op){

        if(session('email') == ''){
            return redirect('/');
        }
        else{
            $users = DB::table('mst_template_type')
            ->where('id', $id)
            ->update([
                'status' => $op
            ]);

            if($users){
                return redirect()->to('/dashboard/template-type/list')->withErrors([
                    'error_msg' => 'Template types status updated successfully.',
                ]);
            }
            else{
                return redirect()->back()->withErrors([
                    'error_msg' => 'Failed to update template type status.',
                ]);
            }

        }

    }

}
