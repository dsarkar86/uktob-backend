<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class ContentsController extends Controller
{
    //
    public function index(){
        if(session('email') == ""){
            return redirect('/');
        }
        else{
            $contents = DB::table('tbl_contents')->get();
            return view('pages.contents.contents', ['contents'=>$contents]);
        }

    }

    public function add_contents(Request $r){

        if($r->session()->get('email') == ""){
            return redirect('/');
        }
        else{
            return view('pages.contents.add-contents');
        }

    }

    public function add_contents_data(Request $request){

        if($request->session()->get('email') == ""){
            return redirect('/');
        }
        else{

            $request->validate([
                'slug' => 'required|max:100',
                'description' => 'required|max:500'
            ]);

            $ins_data = [
                'slug'=>$request->input('slug'),
                'description'=>$request->input('description'),
                'status'=>'1'
            ];
            // $users = DB::table('template_type')->insert($ins_data);
            $users = DB::table('tbl_contents')->insertGetId($ins_data);
            if($users){
                return redirect()->to('/dashboard/contents/list')->withErrors([
                    'error_msg' => 'Content added successfully.',
                ]);
            }
        }

    }

    public function update_contents(Request $request, $id){
        if($request->session()->get('email') == ""){
            return redirect('/');
        }
        else{
            $template_data = DB::table('tbl_contents')->where('id', $id)->first();
            return view('pages.contents.update-contents', ['template_data'=>$template_data]);
        }

    }

    public function update_contents_data(Request $request){
        if($request->session()->get('email') == ""){
            return redirect('/');
        }
        else{
            $mytime = Carbon::now();

            $upd_data = [
                'slug'=>$request->input('slug'),
                'description'=>$request->input('description'),
                'updated_at' => $mytime->toDateTimeString(),
                'status' => 1
            ];

            $users = DB::table('tbl_contents')
            ->where('id', $request->input('id'))
            ->update($upd_data);

            if($users){
                return redirect()->to('/dashboard/contents/list')->withErrors([
                    'error_msg' => 'Contents updated successfully.',
                ]);
            }
            else{
                return redirect()->back()->withErrors([
                    'error_msg' => 'Failed to update contents.',
                ]);
            }
        }

    }

    public function delete_contents($id){

        if(session('email') == ""){
            return redirect('/');
        }
        else{
            $template = DB::table('tbl_contents')->where('id', $id)->delete();
            if($template){
                return redirect()->to('/dashboard/contents/list')->withErrors([
                    'error_msg' => 'Contents deleted successfully.',
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
            $users = DB::table('tbl_contents')
            ->where('id', $id)
            ->update([
                'status' => $op
            ]);

            if($users){
                return redirect()->to('/dashboard/contents/list')->withErrors([
                    'error_msg' => 'Contents status updated successfully.',
                ]);
            }
            else{
                return redirect()->back()->withErrors([
                    'error_msg' => 'Failed to update contents status.',
                ]);
            }

        }

    }

}
