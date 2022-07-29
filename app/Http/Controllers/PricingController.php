<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Faker\Core\File as CoreFile;
use File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;



class PricingController extends Controller
{
    //
    public function index(){
        if(session('email') == ""){
            return redirect('/');
        }
        else{
            $pricing = DB::table('tbl_pricing')->get();
            return view('pages.pricing.pricing', ['pricing'=>$pricing]);
        }

    }

    public function add_pricing(Request $r){

        if($r->session()->get('email') == ""){
            return redirect('/');
        }
        else{
            return view('pages.pricing.add-pricing');
        }

    }

    public function add_pricing_data(Request $request){

        if($request->session()->get('email') == ""){
            return redirect('/');
        }
        else{
            $request->validate([
                'plan_name' => 'required|max:100',
                'short_desc' => 'required|max:500',
                'long_desc' => 'required|max:500',
                // 'billable' => 'required|max:500',
                // 'billable_content' => 'required|max:500',
                'monthly_amt' => 'required',
                'yearly_amt' => 'required',
                // 'plan_icon'=>'file|size:100'
            ]);

            $ins_data = [
                'plan_name'=>$request->input('plan_name'),
                'short_desc'=>$request->input('short_desc'),
                'long_desc'=>$request->input('long_desc'),
                'billable'=>($request->input('billable')!=1?0:1),
                'billable_content'=>$request->input('billable_content'),
                'plan_icon'=>$request->input('plan_icon'),
                'monthly_amt'=>$request->input('monthly_amt'),
                'yearly_amt'=>$request->input('yearly_amt'),
                'status'=>'1'
            ];
            
            // echo '<pre>';
            // print_r($ins_data);
            // exit();

            // $path = Storage::putFile('site_assets.pricing_icons', $request->file('plan_icon'));
            // if($path){
                $users = DB::table('tbl_pricing')->insertGetId($ins_data);
                if($users){
                    return redirect()->to('/dashboard/pricing/list')->withErrors([
                        'error_msg' => 'Pricing added successfully.',
                    ]);
                }
            // }
            // else{
            //     exit('File was not added.');
            //     return redirect()->to('/dashboard/pricing/list')->withErrors([
            //         'error_msg' => 'File was not added.',
            //     ]);
            // }

        }

    }

    public function update_pricing(Request $request, $id){
        if($request->session()->get('email') == ""){
            return redirect('/');
        }
        else{
            $template_data = DB::table('tbl_pricing')->where('id', $id)->first();
            return view('pages.pricing.update-pricing', ['template_data'=>$template_data]);
        }

    }

    public function update_pricing_data(Request $request){
        if($request->session()->get('email') == ""){
            return redirect('/');
        }
        else{
            $mytime = Carbon::now();

            $upd_data = [
                'plan_name'=>$request->input('plan_name'),
                'short_desc'=>$request->input('short_desc'),
                'long_desc'=>$request->input('long_desc'),
                'billable'=> ($request->input('billable')!=1?0:1),
                'billable_content'=>$request->input('billable_content'),
                'plan_icon'=>$request->input('plan_icon'),
                'monthly_amt'=>$request->input('monthly_amt'),
                'yearly_amt'=>$request->input('yearly_amt'),
                'status'=>'1'
            ];

            $users = DB::table('tbl_pricing')
            ->where('id', $request->input('id'))
            ->update($upd_data);

            if($users){
                return redirect()->to('/dashboard/pricing/list')->withErrors([
                    'error_msg' => 'Pricing updated successfully.',
                ]);
            }
            else{
                return redirect()->back()->withErrors([
                    'error_msg' => 'Failed to update pricing.',
                ]);
            }
        }

    }

    public function delete_pricing($id){

        if(session('email') == ""){
            return redirect('/');
        }
        else{
            $template = DB::table('tbl_pricing')->where('id', $id)->delete();
            if($template){
                return redirect()->to('/dashboard/pricing/list')->withErrors([
                    'error_msg' => 'Pricing deleted successfully.',
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
            $users = DB::table('tbl_pricing')
            ->where('id', $id)
            ->update([
                'status' => $op
            ]);

            if($users){
                return redirect()->to('/dashboard/pricing/list')->withErrors([
                    'error_msg' => 'Pricing status updated successfully.',
                ]);
            }
            else{
                return redirect()->back()->withErrors([
                    'error_msg' => 'Failed to update pricing status.',
                ]);
            }

        }

    }

}
