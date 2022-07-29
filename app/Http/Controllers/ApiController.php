<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Mail;


class ApiController extends Controller
{

    // --- Api for user login ---
    public function userLogin(Request $request){
        $users = DB::table('tbl_user')
                        ->where('role', 2)
                        ->where('email', $request->input('email'))
                        // ->where('password', $request->input('password'))
                        ->first();

        if($users){
            $chk_pass = Hash::check($request->input('password'), $users->password);

            if($chk_pass){
                return response()->json([
                    "status" => 1,
                    "token" => base64_encode($users->id),
                    // "token1" => base64_decode(base64_encode($users->id)),
                    "data" => $users,
                    "message" => "Login successful."
                ], 200);
            }
            else{
                return response()->json([
                    "status" => 0,
                    "message" => "Wrong password"
                ], 200);
            }
        }
        else{
            return response()->json([
                "status" => 0,
                "message" => "Login Failed."
            ], 200);
        }

    }
    
    public function forgotPassword(Request $request){
        $users = DB::table('tbl_user')
                        ->where('role', 2)
                        ->where('email', $request->input('email'))
                        // ->where('password', $request->input('password'))
                        ->first();

        if($users){
            $pass=rand(100000,999999);
            $upd_data = [
                'password'=> Hash::make($pass)
            ];
            $updt = DB::table('tbl_user')
            ->where('id', $users->id)
            ->update($upd_data);

            if($updt){
                //send mail start
                $to = $request->input('email');
                $subject = "Uktob: Forgot Password Mail";
                
                $message = "
                <html>
                <head>
                <title>Uktob: Forgot Password Mail</title>
                </head>
                <body>
                <p>Dear ".$users->first_name." ".$users->last_name.", </p>
                <p>Your password has been reset successfully.</p>
                <p><strong>Updated password : </strong>".$pass."</p><br/>
                <p>Regards,</p>
                <p>Uktob Team</p>
                </body>
                </html>";
                // Always set content-type when sending HTML email
                $headers = "MIME-Version: 1.0" . "\r\n";
                $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
                // More headers
                $headers .= 'From: <debrajsarkar86@gmail.com>' . "\r\n";
                mail($to,$subject,$message,$headers);
                //send mail end
                
                return response()->json([
                    "status" => 1,
                    // "token1" => base64_decode(base64_encode($users->id)),
                    "data" => $pass,
                    "message" => "Reset Password Successful."
                ], 200);
            }
            else{
                return response()->json([
                    "status" => 0,
                    "message" => "Reset Password Failed"
                ], 200);
            }
        }
        else{
            return response()->json([
                "status" => 0,
                "message" => "Couldn't found user."
            ], 200);
        }

    }

    // --- Api method for regsitration ---
    public function userRegister(Request $request){

        $users = DB::table('tbl_user')
                        ->where('role', 2)
                        ->where('email', $request->input('email'))
                        ->first();
        
        if($users){
            return response()->json([
                "status" => 0,
                "data" => $users,
                "message" => "Sorry, Email already exists."
            ], 200);
        }
        else{
            $ins_data = [
                'first_name'=>$request->input('firstname'),
                'last_name'=>$request->input('lastname'),
                'email'=>$request->input('email'),
                'password'=> Hash::make($request->input('password')),
                'role'=>2,
                'status'=>1
            ];
            // $users = DB::table('template_type')->insert($ins_data);
            $users_id = DB::table('tbl_user')->insertGetId($ins_data);

            if($users_id){
                
                //send mail start
                $to = $request->input('email');
                $subject = "Uktob: Registration Mail";
                
                $message = "
                <html>
                <head>
                <title>Uktob: Registration Mail</title>
                </head>
                <body>
                <p>Dear ".$request->input('firstname')." ".$request->input('lastname').", </p>
                <p>Your signup process has been completed successfully.Please find your sign in details below </p>
                <table>
                <tr>
                <td><strong>Email : </strong></td>
                <td>".$request->input('email')."</td>
                </tr>
                <tr>
                <td><strong>Password : </strong></td>
                <td>".$request->input('password')."</td>
                </tr>
                </table><br/>
                <p>Regards,</p>
                <p>Uktob Team</p>
                </body>
                </html>";
                // Always set content-type when sending HTML email
                $headers = "MIME-Version: 1.0" . "\r\n";
                $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
                // More headers
                $headers .= 'From: <debrajsarkar86@gmail.com>' . "\r\n";
                mail($to,$subject,$message,$headers);
                //send mail end
                
                return response()->json([
                    "status" => 1,
                    "message" => "User registration was successfull."
                ], 200);
            }
            else{
                return response()->json([
                    "status" => 0,
                    "message" => "Sorry, Failed to register. Please check your database functions."
                ], 200);
            }
        }

    }
    
    public function getUser(Request $request){
        $user_id = base64_decode($request->input('id'));
        $user = DB::table('tbl_user')->where(['id' => $user_id,'status' => 1])->get();
        
        return response()->json([
                "status" => 1,
                "user" => $user[0],
                "message" => "User loaded successfully."
            ], 200);
    }  
    
    public function userUpdate(Request $request){
        $user_id = base64_decode($request->input('user'));
        $form = $request->input('form');
        $upd_data = array();
        if($form==1){
            $upd_data = [
                'company_name'=>$request->input('company_name'),
                'website'=>$request->input('website'),
                'email'=>$request->input('email')
            ];
        }elseif($form==2){
            $upd_data = [
                'first_name'=>$request->input('first_name'),
                'last_name'=>$request->input('last_name')
            ];
        }elseif($form==3){
            $upd_data = [
                'password'=> Hash::make($request->input('password'))
            ];
        }
        
        $updt = DB::table('tbl_user')->where('id', $user_id)->update($upd_data);
       /* return response()->json([
                "status" => 1,
                "message" => "User updated successfully.",
                "user" => $upd_data
            ], 200);*/
        if($updt){
            return response()->json([
                "status" => 1,
                "message" => "User updated successfully.",
                "user" => $upd_data
            ], 200);
        }
        else{
            return response()->json([
                "status" => 0,
                "message" => "Sorry, Failed to update user. Please check your database functions."
            ], 200);
        }
    }
    
    public function templatetypes(Request $request){
        
        $template_types = DB::table('mst_template_type')->where('status', '1')->get();
                        
        
        foreach($template_types as $key => $val){
            $data[$key] = [
                "id"=>$val->id,
                "name"=>$val->name
            ];
        }
        
        return response()->json([
                "status" => 1,
                "type" => $data,
                "message" => "Template types loaded successfully."
            ], 200);
    }  
    
    public function templates(Request $request){
        
        if(!empty($request->input('type'))){
            // $template_types = $request->input('type');
            $template_types = DB::table('tbl_template')
                        ->where('type_id', $request->input('type'))
                        ->where('status', '1')
                        ->get();
        }
        else if(!empty($request->input('search'))){
            // $template_types = $request->input('search');
            $template_types = DB::table('tbl_template')
                        ->where('title', 'LIKE', '%'.$request->input('search').'%')
                        ->orwhere('description', 'LIKE', '%'.$request->input('search').'%')
                        ->where('status', '1')
                        ->get();
        }
        else if(!empty($request->input('type')) && !empty($request->input('search'))){
            $template_types = DB::table('tbl_template')
                        ->where('type_id', 'LIKE', $request->input('type'))
                        ->andwhere('title', 'LIKE', '%'.$request->input('search').'%')
                        ->orwhere('description', 'LIKE', '%'.$request->input('search').'%')
                        ->where('status', '1')
                        ->get();
        }
        else{
            // $template_types = 'nothis';
            $template_types = DB::table('tbl_template')->where('status', '1')->get();
        }
        
        
        foreach($template_types as $key => $val){
            $data[$key] = [
                "id"=>$val->id,
                "type_id"=>$val->type_id,
                "title"=>$val->title,
                "description"=>$val->description,
                "word_limit"=>$val->word_limit,
                "icon"=>$val->icon,
                "is_pro"=>$val->is_pro,
                "is_favorite"=>$val->is_favorite,
                "status"=>$val->status
            ];
        }

                        
        return response()->json([
                "status" => 1,
                "templates" => $data,
                "message" => "Templatessss loaded successfully."
            ], 200);
    }
    
    public function tones(Request $request){
        
        $tones = DB::table('tbl_tone')->where('status', '1')->get();
        
        return response()->json([
                "status" => 1,
                "tones" => $tones,
                "message" => "Tones loaded successfully."
            ], 200);
    }  
    
     public function templateparameters(Request $request){
        $params = DB::table('tbl_template_parameters')
                ->where('template_id', $request->input('id'))
                ->get();
        if(count($params)>0){
            $template = DB::table('tbl_template')
                ->where('id', $request->input('id'))
                ->get();
            return response()->json([
                    "status" => 1,
                    "params" => $params,
                    "template" => $template,
                    "message" => "Parameters loaded successfully."
                ], 200);
        }else{
            return response()->json([
                    "status" => 0,
                    "message" => "Parameters not loaded."
                ], 200);
        }

    }
    
    
    // --- Api method for Project creation ---
    public function projectCreate(Request $request){
        $ins_data = [
            'user_id'      => base64_decode($request->input('user_id')),
            'keyword'      => $request->input('keyword'),
            'content_long' => $request->input('content_long'),
            'title'        => $request->input('title'),
            'paragraph'    => $request->input('paragraph'),
            'status'       => 1
        ];
        // $users = DB::table('template_type')->insert($ins_data);
        $project_id = DB::table('tbl_projects')->insertGetId($ins_data);

        if($project_id){
            return response()->json([
                "status" => 1,
                "message" => "Project created successfully."
            ], 200);
        }
        else{
            return response()->json([
                "status" => 1,
                "message" => "Sorry, Failed to create the project. Please check your database functions."
            ], 201);
        }

    }
    
    public function projectList(Request $request){
        $projects = DB::table('tbl_projects')
                ->where(['user_id'=>base64_decode($request->input('user_id')), 'status'=>1])
                ->get();
        
        return response()->json([
                "status" => 1,
                "projects" => $projects,
                "message" => "Projects loaded successfully."
            ], 200);

    }
    
    public function projectDetails(Request $request){
        $projects = DB::table('tbl_projects')
                ->where('id', $request->input('id'))
                ->get();
        
        return response()->json([
                "status" => 1,
                "projects" => $projects,
                "message" => "Projects loaded successfully."
            ], 200);

    }
    
    public function projectDelete(Request $request){
        $upd_data = [
                'status'=>2
            ];
        $projects = DB::table('tbl_projects')
                ->where('id', $request->input('id'))
                ->update($upd_data);
        
        return response()->json([
                "status" => 1,
                "projects" => $projects,
                "message" => "Projects trashed successfully."
            ], 200);

    }
    
    public function deletedProjects(Request $request){
        $projects = DB::table('tbl_projects')
                ->where(['status'=> 2, 'user_id'=>base64_decode($request->input('user_id'))])
                ->get();
        
        return response()->json([
                "status" => 1,
                "projects" => $projects,
                "message" => "Deleted projects loaded successfully."
            ], 200);

    }
    
    public function projectRevert(Request $request){
        $upd_data = [
                'status'=>1
            ];
        $projects = DB::table('tbl_projects')
                ->where('id', $request->input('id'))
                ->update($upd_data);
        
        return response()->json([
                "status" => 1,
                "projects" => $projects,
                "message" => "Projects Reverted successfully."
            ], 200);

    }
    
    public function addChoices(Request $request){
        $choices = json_decode($request->input('choices'));
        $text ='';
        $i=0;
        $ins_data= array();
        foreach($choices as $choice){
            //$text.=$choice->text;
           $ins_data = [
                'user_id'        => base64_decode($request->input('user')),
                'template_id'    => $request->input('template'),
                'generated_text' => $choices[$i]->text,
                'status'         => 1
            ];
            $gentext_id = DB::table('tbl_text_gen')->insertGetId($ins_data);
            $i++;
        }
        return response()->json([
                "status" => 1,
                "message" => "Successfully added generated text",
                "choices"=>$ins_data
            ], 200);
    }
    
    public function outputs(Request $request){
        $user_id = base64_decode($request->input('user'));
        $outputs = DB::table('tbl_text_gen')->select('tbl_text_gen.*','tbl_template.title','tbl_template.is_pro','tbl_template.is_favorite')->join('tbl_template','tbl_template.id','=','tbl_text_gen.template_id')->where(['tbl_text_gen.user_id' => $user_id, 'tbl_text_gen.status'=>1])->get();
        
        return response()->json([
                "status" => 1,
                "outputs" => $outputs,
                "message" => "Outputs loaded successfully."
            ], 200);
    } 
    
    public function outputsFavourite(Request $request){
        $user_id = base64_decode($request->input('user'));
        $outputs = DB::table('tbl_text_gen')->select('tbl_text_gen.*','tbl_template.title','tbl_template.is_pro','tbl_template.is_favorite')->join('tbl_template','tbl_template.id','=','tbl_text_gen.template_id')->where(['tbl_text_gen.user_id' => $user_id, 'tbl_text_gen.status'=>1, 'tbl_template.is_favorite'=>1])->get();
        
        return response()->json([
                "status" => 1,
                "outputs" => $outputs,
                "message" => "Outputs loaded successfully."
            ], 200);
    } 
    
    public function outputsFlagged(Request $request){
        $user_id = base64_decode($request->input('user'));
        $outputs = DB::table('tbl_text_gen')->select('tbl_text_gen.*','tbl_template.title','tbl_template.is_pro','tbl_template.is_favorite')->join('tbl_template','tbl_template.id','=','tbl_text_gen.template_id')->where(['tbl_text_gen.user_id' => $user_id, 'tbl_text_gen.status'=>1, 'tbl_template.is_pro'=>1])->get();
        
        return response()->json([
                "status" => 1,
                "outputs" => $outputs,
                "message" => "Outputs loaded successfully."
            ], 200);
    }
    
    public function outputDelete(Request $request){
        $upd_data = [
                'status'=>2
            ];
        $projects = DB::table('tbl_text_gen')
                ->where('id', $request->input('id'))
                ->update($upd_data);
        
        return response()->json([
                "status" => 1,
                "outputs" => $projects,
                "message" => "Generated text trashed successfully."
            ], 200);

    }
    
    public function deletedOutputs(Request $request){
        $projects = DB::table('tbl_text_gen')
                ->where(['status'=> 2, 'user_id'=>base64_decode($request->input('user_id'))])
                ->get();
        
        return response()->json([
                "status" => 1,
                "outputs" => $projects,
                "message" => "Deleted text loaded successfully."
            ], 200);

    }
    
    public function outputRevert(Request $request){
        $upd_data = [
                'status'=>1
            ];
        $projects = DB::table('tbl_text_gen')
                ->where('id', $request->input('id'))
                ->update($upd_data);
        
        return response()->json([
                "status" => 1,
                "outputs" => $projects,
                "message" => "Generated Text Reverted successfully."
            ], 200);

    }
}
