<?php

use App\Http\Controllers\ApiController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


// Route::post('users/login', 'ApiController@userLogin');
Route::post('/users/login', [ApiController::class, 'userLogin'])->name('user_login');
Route::post('/users/register', [ApiController::class, 'userRegister'])->name('user_register');
Route::post('/users/forgot-password', [ApiController::class, 'forgotPassword'])->name('user_forgot_password');
Route::post('/users/update', [ApiController::class, 'userUpdate'])->name('user_update');
Route::post('/users/user', [ApiController::class, 'getUser'])->name('get_user');

Route::post('/template/templatetypes', [ApiController::class, 'templatetypes'])->name('template.templatetypes');
Route::post('/template/templates', [ApiController::class, 'templates'])->name('template.templates');
Route::post('/template/templateparameters', [ApiController::class, 'templateparameters'])->name('template.templateparameters'); 
Route::get('/template/tones', [ApiController::class, 'tones'])->name('template.tones');
Route::post('/project/create', [ApiController::class, 'projectCreate'])->name('project.projectcreate');
Route::post('/project/list', [ApiController::class, 'projectList'])->name('project.projectlist');
Route::post('/project/edit', [ApiController::class, 'projectDetails'])->name('project.projectDetails');
Route::post('/project/delete', [ApiController::class, 'projectDelete'])->name('project.projectDelete');
Route::post('/project/deleted-projects', [ApiController::class, 'deletedProjects'])->name('project.deletedProjects');
Route::post('/project/revert', [ApiController::class, 'projectRevert'])->name('project.projectRevert');
Route::post('/choices/add', [ApiController::class, 'addChoices'])->name('choices.addChoices');
Route::post('/output/outputs', [ApiController::class, 'outputs'])->name('output.outputs');
Route::post('/output/outputs-favourite', [ApiController::class, 'outputsFavourite'])->name('output.outputsFavourite');
Route::post('/output/outputs-flagged', [ApiController::class, 'outputsFlagged'])->name('output.outputsFlagged');
Route::post('/output/delete', [ApiController::class, 'outputDelete'])->name('output.outputDelete');
Route::post('/output/deleted-outputs', [ApiController::class, 'deletedOutputs'])->name('output.deletedOutputs');
Route::post('/output/revert', [ApiController::class, 'outputRevert'])->name('output.outputRevert');