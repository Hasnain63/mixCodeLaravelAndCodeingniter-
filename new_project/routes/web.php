<?php

use App\Models\Project;
use App\Models\Proposal;
use App\Models\MidTermReport;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\GroupController;
use App\Http\Controllers\Group\ProfileController;
use App\Http\Controllers\Group\ProjectController;
use App\Http\Controllers\Supervisor\VivaController;
use App\Http\Controllers\Admin\PermissionController;
use App\Http\Controllers\Admin\SupervisorController;
use App\Http\Controllers\Group\MidTermReportController;
use App\Http\Controllers\Frontend\RegistrationController;
use App\Http\Controllers\Admin\StudentApplicationController;
use App\Http\Controllers\Group\ProposalController as GroupProposalController;
use App\Http\Controllers\Supervisor\ProjectController as SupervisorProjectController;
use App\Http\Controllers\Supervisor\ProposalController as SupervisorProposalController;
use App\Http\Controllers\Supervisor\MidTermReportController as SupervisorMidTermReportController;
use App\Models\Viva;

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

Route::get('/', function () {


    $projects = Proposal::where('is_accepted', 1)->get();
    return view('index', compact('projects'));
});
Route::get('/dashboard', function () {
    if (auth()->user()->hasRole(['admin'])) {
        return redirect()->intended('/admin');
    } else if (auth()->user()->hasRole(['group'])) {
        return redirect()->intended('/group');
    } else if (auth()->user()->hasRole(['supervisor'])) {
        return redirect()->intended('/supervisor');
    }
    // return view('dashboard');
})->name('dashboard');
Route::prefix('admin')->group(function () {
    Route::group(['middleware' => ['auth', 'role:admin']], function () {
        Route::get('/', function () {
            return view('backend.index');
        })->name('dashboard');
        Route::resource('users', UserController::class);
        Route::resource('roles', RoleController::class);
        Route::resource('permissions', PermissionController::class);
        Route::resource('applications', StudentApplicationController::class);
        Route::resource('groups', GroupController::class);
        Route::resource('supervisors', SupervisorController::class);
    });
});

Route::prefix('group')->group(function () {
    Route::group(['middleware' => ['auth', 'role:group']], function () {

        Route::get('/', function () {
            $proposals = Proposal::with('user')->where(['user_id' => auth()->id()])->whereIn('is_accepted', [1, 2])->get()->map(function ($item) {
                $item['name'] = 'proposal';
                $item['created'] = $item['created_at']->diffForHumans();
                return $item;
            })->toArray();
            $mid_term_reports = MidTermReport::with('user')->where(['user_id' => auth()->id()])->whereIn('is_accepted', [1, 2])->get()->map(function ($item) {
                $item['name'] = 'Mid Term Report';
                $item['created'] = $item['created_at']->diffForHumans();
                return $item;
            })->toArray();
            $project = Project::with('user')->where(['user_id' => auth()->id()])->whereIn('is_accepted', [1, 2])->get()->map(function ($item) {
                $item['name'] = 'project';
                $item['created'] = $item['created_at']->diffForHumans();
                return $item;
            })->toArray();
            $project_data = collect(array_merge($proposals, $mid_term_reports, $project))->sortByDesc('created_at')->groupBy('created_at')->values()->all();
            // $project_accepted = Project::with('user')->where(['user_id' => auth()->id(), 'is_accepted' => 1])->get();
            return view('backend.index', compact('proposals', 'mid_term_reports', 'project', 'project_data'));
        })->name('dashboard');
        Route::get('supervisors', [GroupProposalController::class, 'index'])->name('supervisors.index');
        Route::get('report-status', [MidTermReportController::class, 'status'])->name('report.status');
        Route::get('project-status', [ProjectController::class, 'status'])->name('project.status');
        Route::resource('proposals', GroupProposalController::class);
        Route::resource('mid-term-report', MidTermReportController::class);
        Route::resource('project', ProjectController::class);
        Route::post('update-profile', [ProfileController::class, 'changePassword'])->name('change.password');
        Route::resource('profile', ProfileController::class);
        Route::resource('viva', \App\Http\Controllers\Group\VivaController::class);
    });
});

Route::prefix('supervisor')->group(function () {
    Route::group(['middleware' => ['auth', 'role:supervisor']], function () {
        Route::get('/', function () {
            $proposals = Proposal::with('user')->where(['supervisor_id' => auth()->id(), 'is_accepted' => 0])->get()->map(function ($item) {
                $item['name'] = 'proposal';
                $item['created'] = $item['created_at']->diffForHumans();
                return $item;
            })->toArray();
            $mid_term_reports = MidTermReport::with('user')->where(['supervisor_id' => auth()->id(), 'is_accepted' => 0])->get()->map(function ($item) {
                $item['name'] = 'Mid Term Report';
                $item['created'] = $item['created_at']->diffForHumans();
                return $item;
            })->toArray();
            $project = Project::with('user')->where(['supervisor_id' => auth()->id(), 'is_accepted' => 0])->get()->map(function ($item) {
                $item['name'] = 'project';
                $item['created'] = $item['created_at']->diffForHumans();
                return $item;
            })->toArray();
            $project = collect(array_merge($proposals, $mid_term_reports, $project))->sortByDesc('created_at')->groupBy('created_at')->values()->all();
            return view('backend.index', compact('proposals', 'mid_term_reports', 'project'));
        })->name('dashboard');
        Route::resource('student-proposals', SupervisorProposalController::class);
        Route::get('media', [SupervisorProposalController::class, 'mediaDownload']);
        Route::resource('mid-term-report', SupervisorMidTermReportController::class);
        Route::post('update-profile', [ProfileController::class, 'changePassword'])->name('change.password');
        Route::resource('projects', SupervisorProjectController::class);
        Route::resource('profile', ProfileController::class);
        Route::resource('viva', VivaController::class);
    });
});


require __DIR__ . '/auth.php';
Route::resource('register', RegistrationController::class);
Route::get('singeRegister', [RegistrationController::class, 'singleUserRegister']);
Route::post('save', [RegistrationController::class, 'save']);