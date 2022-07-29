<?php

use App\Http\Controllers\ContentsController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\PricingController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\TemplateController;
use App\Http\Controllers\TemplateParameterController;
use App\Http\Controllers\TemplateTypeController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;



/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

// Resourses (Controller alias name)
Route::resource('loginCon', 'LoginController');
Route::resource('RegisterCon', 'RegisterController');
Route::resource('DashboardCon', 'DashboardController');


// Routes
Route::get('/', [LoginController::class, 'index'])->name('login');
Route::post('/', [LoginController::class, 'chk_login'])->name('check_login');
Route::get('/logout', [LoginController::class, 'logout'])->name('logout');
Route::get('/register', [RegisterController::class, 'index'])->name('register');

Route::get('/users/list', [LoginController::class, 'get_all_users'])->name('get_all_users');

// Route::get('/test/register', [RegisterController::class, 'register1']);
// Route::post('/test/register', [RegisterController::class, 'register1_process']);

Route::get('/forgot-password', [RegisterController::class, 'forgot_password'])->name('forgot_password');
Route::post('/forgot-password', [RegisterController::class, 'forgot_password_submit'])->name('forgot_password_submit');
Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');


Route::get('/dashboard/users/list', [UserController::class, 'index'])->name('users_list');
Route::get('/dashboard/users/add', [UserController::class, 'add_users'])->name('users_add');
Route::post('/dashboard/users/add', [UserController::class, 'add_users_data'])->name('users_add_data');
Route::get('/dashboard/users/update/{id}', [UserController::class, 'update_users'])->name('users_update');
Route::post('/dashboard/users/update', [UserController::class, 'update_users_data'])->name('users_update_data');
Route::get('/dashboard/users/delete/{id}', [UserController::class, 'delete_users'])->name('users_delete');
Route::get('/dashboard/users/status_change/{id}/{op}', [UserController::class, 'status_change'])->name('users_status_change');

Route::get('/dashboard/user-generated-outputs/list/{id}', [UserController::class, 'user_outputs'])->name('output_list');
Route::get('/dashboard/user-generated-outputs/status_change/{id}/{op}', [UserController::class, 'status_change_output'])->name('output_status_change');

Route::get('/dashboard/user-documents/list/{id}', [UserController::class, 'user_documents'])->name('document_list');
Route::get('/dashboard/user-documents/status_change/{id}/{op}', [UserController::class, 'status_change_document'])->name('document_status_change');

Route::get('/dashboard/template/list', [TemplateController::class, 'index'])->name('template_list');
Route::get('/dashboard/template/add', [TemplateController::class, 'add_template'])->name('template_add');
Route::post('/dashboard/template/add', [TemplateController::class, 'add_template_data'])->name('template_add_data');
Route::get('/dashboard/template/update/{id}', [TemplateController::class, 'update_template'])->name('template_update');
Route::post('/dashboard/template/update', [TemplateController::class, 'update_template_data'])->name('template_update_data');
Route::get('/dashboard/template/delete/{id}', [TemplateController::class, 'delete_template'])->name('template_delete');
Route::get('/dashboard/template/status_change/{id}/{op}', [TemplateController::class, 'status_change'])->name('template_status_change');

Route::get('/dashboard/template-parameter/template-list', [TemplateParameterController::class, 'index'])->name('template_list_parameter');
Route::get('/dashboard/template-parameter/list/{id}', [TemplateParameterController::class, 'parameter_list'])->name('template_parameter_list');
Route::get('/dashboard/template-parameter/add/{id}', [TemplateParameterController::class, 'add_parameter'])->name('add_template_parameter');
Route::post('/dashboard/template-parameter/add/{id}', [TemplateParameterController::class, 'add_parameter_data'])->name('add_template_parameter_data');
Route::get('/dashboard/template-parameter/update/{id}', [TemplateParameterController::class, 'update_template_parameter'])->name('template_parameter_update');
Route::post('/dashboard/template-parameter/update', [TemplateParameterController::class, 'update_template_parameter_data'])->name('template_parameter_update_data');
Route::get('/dashboard/template-parameter/delete/{id}', [TemplateParameterController::class, 'delete_template_parameter'])->name('template_parameter_delete');
Route::get('/dashboard/template-parameter/status_change/{id}/{op}', [TemplateParameterController::class, 'status_change'])->name('template_parameter_status_change');


Route::get('/dashboard/template-type/list', [TemplateTypeController::class, 'index'])->name('template_type_list');
Route::get('/dashboard/template-type/add', [TemplateTypeController::class, 'add_template_type'])->name('template_type_add');
Route::post('/dashboard/template-type/add', [TemplateTypeController::class, 'add_template_type_data'])->name('template_type_add_data');
Route::get('/dashboard/template-type/update/{id}', [TemplateTypeController::class, 'update_template_type'])->name('template_type_update');
Route::post('/dashboard/template-type/update', [TemplateTypeController::class, 'update_template_type_data'])->name('template_type_update_data');
Route::get('/dashboard/template-type/delete/{id}', [TemplateTypeController::class, 'delete_template_type'])->name('template_type_delete');
Route::get('/dashboard/template-type/status_change/{id}/{op}', [TemplateTypeController::class, 'status_change'])->name('template_type_status_change');


Route::get('/dashboard/contents/list', [ContentsController::class, 'index'])->name('contents_list');
Route::get('/dashboard/contents/add', [ContentsController::class, 'add_contents'])->name('contents_add');
Route::post('/dashboard/contents/add', [ContentsController::class, 'add_contents_data'])->name('contents_add_data');
Route::get('/dashboard/contents/update/{id}', [ContentsController::class, 'update_contents'])->name('contents_update');
Route::post('/dashboard/contents/update', [ContentsController::class, 'update_contents_data'])->name('contents_update_data');
Route::get('/dashboard/contents/delete/{id}', [ContentsController::class, 'delete_contents'])->name('contents_delete');
Route::get('/dashboard/contents/status_change/{id}/{op}', [ContentsController::class, 'status_change'])->name('contents_status_change');


Route::get('/dashboard/pricing/list', [PricingController::class, 'index'])->name('pricing_list');
Route::get('/dashboard/pricing/add', [PricingController::class, 'add_pricing'])->name('pricing_add');
Route::post('/dashboard/pricing/add', [PricingController::class, 'add_pricing_data'])->name('pricing_add_data');
Route::get('/dashboard/pricing/update/{id}', [PricingController::class, 'update_pricing'])->name('pricing_update');
Route::post('/dashboard/pricing/update', [PricingController::class, 'update_pricing_data'])->name('pricing_update_data');
Route::get('/dashboard/pricing/delete/{id}', [PricingController::class, 'delete_pricing'])->name('pricing_delete');
Route::get('/dashboard/pricing/status_change/{id}/{op}', [PricingController::class, 'status_change'])->name('pricing_status_change');






Route::get('/dashboard/pricing/test_datat', [PricingController::class, 'test_datat'])->name('test_datat');

Route::get('/test/test/test', function () {
    return 'Some test data.';
});









// These are testing routes that will be used to check all the functions on the go.
Route::get('/test/generate_password', function () {
    $users = DB::table('tbl_user')->where('email', 'amitkumar@mail.com')->first();
    return Hash::check('123456',$users->password)?'Matched':'Failed';
});
Route::get('/test/check_password', function () {
    return Hash::check('123456','$2y$10$bxKtsbyHZdWVmMbYkjng2e14e/CBvoy8lUFryzq7x2Ik/WVg.U8Mu');
});
Route::get('/test/check_db',[LoginController::class, 'test_db_function']);

