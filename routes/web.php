<?php


use App\Http\Controllers\ArticleController;
use App\Http\Controllers\CalendarNotifications;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\FileController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ActivitiesCommitteeMemberController;
use App\Http\Controllers\ActivityController;
use App\Http\Controllers\ChairmanController;
use App\Http\Controllers\ContactformController;
use App\Http\Controllers\NoteController;
use App\Http\Controllers\NotificationsController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RegistrationController;
use App\Http\Controllers\SignupController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\Auth\PasswordResetLinkController;
use App\Http\Controllers\Auth\NewPasswordController;
use App\Http\Controllers\Auth\ConfirmablePasswordController;
use App\Http\Controllers\Auth\EmailVerificationPromptController;
use App\Http\Controllers\Auth\EmailVerificationNotificationController;
use App\Http\Controllers\Auth\PasswordController;
use App\Http\Controllers\Auth\VerifyEmailController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('index');
});

Route::get('/dashboard', function () {
    $articles = \App\Models\Article::all();
    return view('dashboard', compact('articles'));
}, )->middleware(['auth', 'verified',])->name('dashboard');

Route::get('/dashboard/chairman', [HomeController::class, 'chairmanDashboard'])
    ->middleware(['auth', 'verified', 'role:chairman'])
    ->name('dashboard.chairman');

Route::get('/dashboard/activitiesCommitteeMember', [HomeController::class, 'activitiesCommitteeMemberDashboard'])
    ->middleware(['auth', 'verified', 'role:activities committee member'])
    ->name('dashboard.activitiesCommitteeMember');

Route::get('/dashboard/boardMember', [HomeController::class, 'boardMemberDashboard'])
    ->middleware(['auth', 'verified', 'role:board member'])
    ->name('dashboard.boardMember');

Route::get('/dashboard/headOfActivities', [HomeController::class, 'headOfActivitiesDashboard'])
    ->middleware(['auth', 'verified', 'role:head of activities'])
    ->name('dashboard.headOfActivities');

Route::get('/dashboard/headOfMedia', [HomeController::class, 'headOfMediaDashboard'])
    ->middleware(['auth', 'verified', 'role:head of media'])
    ->name('dashboard.headOfMedia');

Route::get('/dashboard/mediaTeamMember', [HomeController::class, 'mediaTeamMemberDashboard'])
    ->middleware(['auth', 'verified', 'role:media team member'])
    ->name('dashboard.mediaTeamMember');

// Public route for viewing articles
Route::get('/articles/{id}', [ArticleController::class, 'show'])->name('articles.show');

// Protected routes for creating, editing, and deleting articles
Route::middleware(['auth', 'verified', 'role:head of media|media team member'])->group(function () {
    Route::get('/dashboard/article/{id}', [ArticleController::class, 'dashboardShow'])->name('articles.dashboardShow');
    Route::get('/dashboard/articles/create', [ArticleController::class, 'create'])->name('articles.create');
    Route::post('/dashboard/articles', [ArticleController::class, 'store'])->name('articles.store');
    Route::get('/dashboard/articles/{id}/edit', [ArticleController::class, 'edit'])->name('articles.edit');
    Route::put('/dashboard/articles/{id}', [ArticleController::class, 'update'])->name('articles.update');
    Route::delete('/dashboard/articles/{id}', [ArticleController::class, 'destroy'])->name('articles.destroy');
});

Route::get('/dashboard/secretary', [HomeController::class, 'secretaryDashboard'])
    ->middleware(['auth', 'verified', 'role:secretary'])
    ->name('dashboard.secretary');

Route::get('/dashboard/treasurer', [HomeController::class, 'treasurerDashboard'])
    ->middleware(['auth', 'verified', 'role:treasurer'])
    ->name('dashboard.treasurer');

Route::get('/dashboard/treasurer', [HomeController::class, 'treasurerDashboard'])
    ->middleware(['auth', 'verified', 'role:treasurer'])
    ->name('dashboard.treasurer');
Route::post('/dashboard/treasurer', [HomeController::class, 'treasurerDashboard'])->name('dashboard.treasurer'); // Existing route

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

Route::get('/about', function () {
    return view('about');
})->name('about');

Route::get('/contact', function () {
    return view('contact');
})->name('contact');

Route::get('/news', function () {
    return view('news');
})->name('news');

//when logged in
Route::get('/dashboard/about', function () {
    return view('dashboard.about');
})->name('dashboard.about');
/*
 * The routes related to the activity features
 */
Route::resource('activities', ActivityController::class)->names('activities');
Route::get('activities/{activity}/delete', [ActivityController::class, 'delete'])->name('activities.delete');
Route::post('/registration/{activity}', [RegistrationController::class, 'registration'])->name('registration');
Route::post('confirmation/{activity}', [RegistrationController::class, 'confirmation'])->name('confirmation');
Route::post('/cancellation/{activity}', [RegistrationController::class, 'cancellation'])->name('cancellation');
Route::post('/activities/review', [ActivityController::class, 'review'])->name('activities.review');
Route::post('/activities/{id}/approve', [ActivityController::class, 'approve'])->name('review.approve');
Route::post('/activities/{id}/delete', [ActivityController::class, 'delete'])->name('review.delete');
Route::patch('activities/{activity}', [ActivityController::class, 'update'])->name('activities.update');
Route::post('/activities/{activity}/signup', [ActivityController::class, 'processSignUp'])->name('activities.processSignup');


Route::get('signup', [SignupController::class, 'index'])->name('signup');


Route::get('/dashboard/news', function () {
    return view('dashboard.news',[ArticleController::class, 'news']);
})->name('dashboard.news');

Route::get('/dashboard/contact', function () {
    return view('dashboard.contact');
})->name('dashboard.contact');


//file upload
Route::post('/upload-file', [FileController::class, 'uploadFile'])->name('upload.file');

//share files
Route::post('/share-files', [FileController::class, 'shareFiles'])->name('share.files');


Route::get('/contact', function () {
    return view('contact');
})->name('contact');

Route::get('/test-view', [NotificationsController::class, 'index'])->name('notifications');

Route::post('/contact', [ContactformController::class, 'submit'])->name('contact.submit');
Route::get('/message/reminders', [NotificationsController::class, 'reminders'])->name('reminders');
Route::get('/notifications', [NotificationsController::class, 'index'])->name('notifications');
Route::get('/notifications/all', [NotificationsController::class, 'all'])->name('notifications.all');
Route::get('/message/{id}', [NotificationsController::class, 'view'])->name('message.view');
Route::post('/message/{id}/reply', [NotificationsController::class, 'view'])->name('message_reply');
Route::get('/message/{id}/reply', [NotificationsController::class, 'view'])->name('message_reply');
Route::delete('/message/{id}', [NotificationsController::class, 'delete'])->name('message.delete');

//notes
Route::post('/notes/save', [NoteController::class, 'save'])->name('notes.save');
Route::get('/notes/download/{id}', [NoteController::class, 'download'])->name('notes.download');
Route::get('/notes', [NoteController::class, 'index'])->name('notes.index');

//payment gateway
Route::post('/payment/process', [PaymentController::class, 'process'])->name('process');
Route::get('/payment/process', [PaymentController::class, 'process'])->name('process');
Route::post('/payment/callback', [PaymentController::class, 'callback'])->name('callback');
Route::get('/payment/success', [PaymentController::class, 'process'])->name('payment.success');
Route::get('/payment/cancel', [PaymentController::class, 'process'])->name('payment.cancel');
//calendar
Route::get('/calendar', function () {
    return view('dashboard.calendar');
});

Route::get('/dashboard/notifications', [\App\Http\Controllers\CalendarNotifications::class, 'index'])->name('dashboard.notifications');
