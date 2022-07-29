<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TemplateController extends Controller
{
    //
    public function index(){
        // echo 'template list will be here...';
        if(session('email') == ""){
            return redirect('/');
        }
        else{
            $templates = DB::table('tbl_template')->get();
            return view('pages.template.templates', ['templates'=>$templates]);
        }

    }

    public function add_template(){
        // echo 'Add a template...';
        if(session('email') == ""){
            return redirect('/');
        }
        else{
            $template_types = DB::table('mst_template_type')->get();
            return view('pages.template.add-template', ['template_types'=>$template_types]);
        }

    }

    public function add_template_data(Request $request){

        if($request->session()->get('email') == ""){
            return redirect('/');
        }
        else{
            $ins_data = [
                'type_id'=>$request->input('type_id'),
                'title'=>$request->input('title'),
                'description'=>$request->input('description'),
                'word_limit'=>$request->input('word_limit'),
                'icon'=>$request->input('icon'),
                'temperature'=>$request->input('temperature'),
                'max_tokens'=>$request->input('max_tokens'),
                'top_p'=>$request->input('top_p'),
                'frequency_penalty'=>$request->input('frequency_penalty'),
                'presence_penalty'=>$request->input('presence_penalty'),
                'stop'=>$request->input('stop'),
                'is_pro'=>1,
                'is_favorite'=>1,
                'created_by'=>1,
                'status'=>'1'
            ];
            // $users = DB::table('template_type')->insert($ins_data);
            $users = DB::table('tbl_template')->insertGetId($ins_data);
            if($users){
                return redirect()->to('/dashboard/template/list')->withErrors([
                    'error_msg' => 'Templates added successfully.',
                ]);
            }
        }

    }

    public function update_template(Request $request, $id){
        if($request->session()->get('email') == ""){
            return redirect('/');
        }
        else{
            $template_types = DB::table('mst_template_type')->get();
            $template_data = DB::table('tbl_template')->where('id', $id)->first();
            return view('pages.template.update-template', ['template_data'=>$template_data, 'template_types'=>$template_types]);
        }

    }

    public function update_template_data(Request $request){

        if($request->session()->get('email') == ""){
            return redirect('/');
        }
        else{
            // return $request->all();
            $mytime = Carbon::now();

            $upd_data = [
                'type_id' => $request->input('type_id'),
                'title' => $request->input('title'),
                'description' => $request->input('description'),
                'word_limit' => $request->input('word_limit'),
                'temperature'=>$request->input('temperature'),
                'max_tokens'=>$request->input('max_tokens'),
                'top_p'=>$request->input('top_p'),
                'frequency_penalty'=>$request->input('frequency_penalty'),
                'presence_penalty'=>$request->input('presence_penalty'),
                'stop'=>$request->input('stop'),
                'is_pro'=>1,
                'is_favorite'=>1,
                'updated_by' => 2,
                'updated_at' => $mytime->toDateTimeString(),
                'status' => 1
            ];

            $users = DB::table('tbl_template')
            ->where('id', $request->input('id'))
            ->update($upd_data);

            if($users){
                return redirect()->to('/dashboard/template/list')->withErrors([
                    'error_msg' => 'Templates updated successfully.',
                ]);
            }
            else{
                return redirect()->back()->withErrors([
                    'error_msg' => 'Failed to update template.',
                ]);
            }
        }

    }

    public function delete_template($id){
        if(session('email') == ""){
            return redirect('/');
        }
        else{
            $template = DB::table('tbl_template')->where('id', $id)->delete();
            if($template){
                return redirect()->to('/dashboard/template/list')->withErrors([
                    'error_msg' => 'Templates deleted successfully.',
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
            $users = DB::table('tbl_template')
            ->where('id', $id)
            ->update([
                'status' => $op
            ]);

            if($users){
                return redirect()->to('/dashboard/template/list')->withErrors([
                    'error_msg' => 'Templates status updated successfully.',
                ]);
            }
            else{
                return redirect()->back()->withErrors([
                    'error_msg' => 'Failed to update template status.',
                ]);
            }
        }

    }

}
