<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{

    public function index(){
        if(session('email') == ""){
            return redirect('/');
        }
        else{
            $users = DB::table('tbl_user')->where('role', 2)->get();
            return view('pages.users.users', ['users'=>$users]);
        }

    }

    public function add_users(){
        
        if(session('email') == ""){
            return redirect('/');
        }
        else{
            return view('pages.users.add-users');
        }

    }


    public function add_users_data(Request $request){
        
        if($request->session()->get('email') == ""){
            return redirect('/');
        }
        else{
            $ins_data = [
                'first_name'=>$request->input('first_name'),
                'last_name'=>$request->input('last_name'),
                'email'=>$request->input('email'),
                'password'=> Hash::make($request->input('password')),
                'role'=>2,
                'status'=>$request->input('status')
            ];
            // $users = DB::table('template_type')->insert($ins_data);
            $users = DB::table('tbl_user')->insertGetId($ins_data);
            if($users){
                return redirect()->to('/dashboard/users/list')->withErrors([
                    'error_msg' => 'User added successfully.',
                ]);
            }
        }
    }

    public function update_users(Request $request, $id){
        if($request->session()->get('email') == ""){
            return redirect('/');
        }
        else{
            $user_data = DB::table('tbl_user')->where('id', $id)->first();
            return view('pages.users.update-users', ['user_data'=>$user_data]);
        }

    }

    public function update_users_data(Request $request){

        if($request->session()->get('email') == ""){
            return redirect('/');
        }
        else{
            // return $request->all();
            $mytime = Carbon::now();

            $upd_data = [
                'first_name'=>$request->input('first_name'),
                'last_name'=>$request->input('last_name'),
                'email'=>$request->input('email'),
                'password'=> Hash::make($request->input('password'))
            ];

            $users = DB::table('tbl_user')
            ->where('id', $request->input('id'))
            ->update($upd_data);

            if($users){
                return redirect()->to('/dashboard/users/list')->withErrors([
                    'error_msg' => 'User updated successfully.',
                ]);
            }
            else{
                return redirect()->back()->withErrors([
                    'error_msg' => 'Failed to update user.',
                ]);
            }
        }

    }

    public function delete_users($id){
        if(session('email') == ""){
            return redirect('/');
        }
        else{
            $template = DB::table('tbl_user')->where('id', $id)->delete();
            if($template){
                return redirect()->to('/dashboard/users/list')->withErrors([
                    'error_msg' => 'User deleted successfully.',
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
            $users = DB::table('tbl_user')
            ->where('id', $id)
            ->update([
                'status' => $op
            ]);

            if($users){
                return redirect()->to('/dashboard/users/list')->withErrors([
                    'error_msg' => 'User status updated successfully.',
                ]);
            }
            else{
                return redirect()->back()->withErrors([
                    'error_msg' => 'Failed to update template status.',
                ]);
            }
        }

    }
    
    public function user_outputs(Request $request, $id){
        if($request->session()->get('email') == ""){
            return redirect('/');
        }
        else{
            $user_data = DB::table('tbl_user')->where('id', $id)->first();
            $outputs = DB::table('tbl_text_gen') ->join('tbl_template', 'tbl_text_gen.template_id', '=', 'tbl_template.id')->select('tbl_text_gen.*','tbl_template.title')->where('tbl_text_gen.user_id',$id)->get();
            return view('pages.users.user-outputs', ['user_data'=>$user_data, 'outputs'=>$outputs]);
        }

    }
    
    public function status_change_output($id, $op){
        if(session('email') == ""){
            return redirect('/');
        }
        else{
            $users = DB::table('tbl_text_gen')
            ->where('id', $id)
            ->update([
                'status' => $op
            ]);
            
            $output = DB::table('tbl_text_gen')->where('id', $id)->first();

            if($users){
                return redirect()->to('/dashboard/user-generated-outputs/list/'.$output->user_id)->withErrors([
                    'error_msg' => 'Output status updated successfully.',
                ]);
            }
            else{
                return redirect()->back()->withErrors([
                    'error_msg' => 'Failed to update output status.',
                ]);
            }
        }

    }
    
     public function user_documents(Request $request, $id){
        if($request->session()->get('email') == ""){
            return redirect('/');
        }
        else{
            $user_data = DB::table('tbl_user')->where('id', $id)->first();
            $documents = DB::table('tbl_projects')->where('user_id',$id)->get();
            return view('pages.users.user-documents', ['user_data'=>$user_data, 'documents'=>$documents]);
        }

    }
    
    public function status_change_document($id, $op){
        if(session('email') == ""){
            return redirect('/');
        }
        else{
            $users = DB::table('tbl_projects')
            ->where('id', $id)
            ->update([
                'status' => $op
            ]);
            
            $document = DB::table('tbl_projects')->where('id', $id)->first();

            if($users){
                return redirect()->to('/dashboard/user-documents/list/'.$document->user_id)->withErrors([
                    'error_msg' => 'Document status updated successfully.',
                ]);
            }
            else{
                return redirect()->back()->withErrors([
                    'error_msg' => 'Failed to update document status.',
                ]);
            }
        }

    }

}
