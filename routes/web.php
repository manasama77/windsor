<?php

use App\Http\Controllers\AdminClassController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\TeacherController;
use App\Http\Controllers\AdminStudentController;
use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\AdminSetupAdminController;
use App\Http\Controllers\AdminSetupSubjectController;
use App\Http\Controllers\AdminSetupClassRoomController;
use App\Http\Controllers\AdminSetupSchoolYearController;
use App\Http\Controllers\AdminTeacherManagementController;
use App\Http\Controllers\AdminTeacherSetupTeacherController;
use App\Http\Controllers\AdminTeacherHomeroomTeacherController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\StudentDashboardController;
use App\Http\Controllers\StudentMeetingController;
use App\Http\Controllers\TeacherAttendanceController;
use App\Http\Controllers\TeacherDashboardController;
use App\Http\Controllers\TeacherMeetingController;

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

Route::get('/', [StudentController::class, 'index']);

/* ------------------------------------------------------------------------------------------------------------------------------ */
/* ----------- Start Search Route ----------- */
Route::controller(SearchController::class)->group(function () {
    Route::get('/search/student', 'autocomplete_student')->name('search.student');
});
/* ----------- End Search Route ----------- */
/* ------------------------------------------------------------------------------------------------------------------------------ */


/* ------------------------------------------------------------------------------------------------------------------------------ */

/* ----------- Start Teacher Route ----------- */

Route::prefix('teacher')->group(function () {
    Route::get('/login', [TeacherController::class, 'index'])->name('teacher.login');
    Route::post('/login/auth', [TeacherController::class, 'auth'])->name('teacher.auth');
    Route::get('/logout', [TeacherController::class, 'logout'])->name('teacher.logout');
    Route::get('/register', [TeacherController::class, 'register'])->name('teacher.register');
    Route::post('/store', [TeacherController::class, 'store'])->name('teacher.store')->middleware('teacher');
    /* ------------------------------------------------------------------------------------------------------------------------------ */


    /* ------------------------------------------------------------------------------------------------------------------------------ */
    /* ----------- Start Teacher -> Dashboard ----------- */
    Route::get('/dashboard', [TeacherDashboardController::class, 'index'])->name('teacher.dashboard')->middleware('teacher');
    /* ----------- End Teacher -> Dashboard ----------- */
    /* ------------------------------------------------------------------------------------------------------------------------------ */

    /* ------------------------------------------------------------------------------------------------------------------------------ */
    /* ----------- Start Teacher -> Pertemuan ----------- */
    Route::get('/pertemuan', [TeacherMeetingController::class, 'index'])->name('teacher.pertemuan')->middleware('teacher');
    Route::get('/pertemuan/datatables', [TeacherMeetingController::class, 'datatables'])->name('teacher.pertemuan.datatables')->middleware('teacher');
    Route::get('/pertemuan/add', [TeacherMeetingController::class, 'add'])->name('teacher.pertemuan.add')->middleware('teacher');
    Route::post('/pertemuan/store', [TeacherMeetingController::class, 'store'])->name('teacher.pertemuan.store')->middleware('teacher');
    Route::get('/pertemuan/show/subject/{teacher_id}', [TeacherMeetingController::class, 'show_subject'])->name('teacher.pertemuan.show.subject')->middleware('teacher');
    Route::get('/pertemuan/truncate', [TeacherMeetingController::class, 'truncate'])->name('teacher.pertemuan.truncate')->middleware('teacher');
    Route::get('/pertemuan/edit/{meeting_id}', [TeacherMeetingController::class, 'edit'])->name('teacher.pertemuan.edit')->middleware('teacher');
    Route::post('/pertemuan/update/{meeting_id}', [TeacherMeetingController::class, 'update'])->name('teacher.pertemuan.update')->middleware('teacher');
    Route::post('/pertemuan/destroy', [TeacherMeetingController::class, 'destroy'])->name('teacher.pertemuan.destroy');
    /* ----------- End Teacher -> Pertemuan ----------- */
    /* ------------------------------------------------------------------------------------------------------------------------------ */

    /* ------------------------------------------------------------------------------------------------------------------------------ */
    /* ----------- Start Teacher -> Presensi ----------- */
    Route::get('/presensi/{meeting_id}', [TeacherAttendanceController::class, 'index'])->name('teacher.presensi')->middleware('teacher');
    Route::get('/presensi/cek_presensi/{meeting_id}', [TeacherAttendanceController::class, 'cek_presensi'])->name('teacher.presensi.cek_presensi')->middleware('teacher');
    Route::post('/presensi/upsert', [TeacherAttendanceController::class, 'upsert'])->name('teacher.presensi.upsert')->middleware('teacher');
    /* ----------- End Teacher -> Presensi ----------- */
    /* ------------------------------------------------------------------------------------------------------------------------------ */
});
/* ----------- End Teacher Route ----------- */


/* ------------------------------------------------------------------------------------------------------------------------------ */


/* ----------- Start Student Route ----------- */
Route::prefix('student')->group(function () {
    Route::get('/login', [StudentController::class, 'index'])->name('student.login');
    Route::post('/login/auth', [StudentController::class, 'auth'])->name('student.auth');
    Route::get('/logout', [StudentController::class, 'logout'])->name('student.logout');
    Route::get('/register', [StudentController::class, 'register'])->name('student.register');
    Route::post('/store', [StudentController::class, 'store'])->name('student.store');
    /* ------------------------------------------------------------------------------------------------------------------------------ */


    /* ------------------------------------------------------------------------------------------------------------------------------ */
    /* ----------- Start Student -> Dashboard ----------- */
    Route::get('/dashboard', [StudentDashboardController::class, 'index'])->name('student.dashboard')->middleware('student');
    /* ----------- End Student -> Dashboard ----------- */
    /* ------------------------------------------------------------------------------------------------------------------------------ */

    /* ------------------------------------------------------------------------------------------------------------------------------ */
    /* ----------- Start Student -> Pertemuan ----------- */
    Route::get('/pertemuan', [StudentMeetingController::class, 'index'])->name('student.pertemuan')->middleware('student');
    Route::get('/pertemuan/datatables', [StudentMeetingController::class, 'datatables'])->name('student.pertemuan.datatables')->middleware('student');
    Route::get('/pertemuan/show/{meeting_id}', [StudentMeetingController::class, 'show'])->name('student.pertemuan.show')->middleware('student');
    Route::post('/pertemuan/upload/{meeting_id}', [StudentMeetingController::class, 'upload'])->name('student.pertemuan.upload')->middleware('student');
    Route::get('/pertemuan/download/{attachment_id}', [StudentMeetingController::class, 'download'])->name('student.pertemuan.download')->middleware('student');
    Route::get('/pertemuan/download/tugas/{id}', [StudentMeetingController::class, 'download_tugas'])->name('student.pertemuan.download.tugas')->middleware('student');
    /* ----------- End Student -> Pertemuan ----------- */
    /* ------------------------------------------------------------------------------------------------------------------------------ */
});
/* ----------- End Student Route ----------- */


/* ------------------------------------------------------------------------------------------------------------------------------ */


/* ----------- Start Admin Route ----------- */
Route::prefix('admin')->group(function () {
    /* ----------- Start Admin Login & Logout ----------- */
    Route::get('/login', [AdminController::class, 'index'])->name('admin.login');
    Route::post('/login/auth', [AdminController::class, 'auth'])->name('admin.auth');
    Route::get('/logout', [AdminController::class, 'logout'])->name('admin.logout');
    Route::get('/register', [AdminController::class, 'register'])->name('admin.register');
    Route::post('/store', [AdminController::class, 'store'])->name('admin.store');
    /* ----------- End Admin Login & Logout ----------- */
    /* ------------------------------------------------------------------------------------------------------------------------------ */

    /* ------------------------------------------------------------------------------------------------------------------------------ */
    /* ----------- Start Admin -> Dashboard ----------- */
    Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('admin.dashboard')->middleware('admin');
    /* ----------- End Admin -> Dashboard ----------- */
    /* ------------------------------------------------------------------------------------------------------------------------------ */


    /* ----------- Start Admin -> Management Kelas ----------- */
    Route::get('/test', [AdminClassController::class, 'test']);
    Route::get('/kelas', [AdminClassController::class, 'index'])->name('admin.kelas')->middleware('admin');
    Route::get('/kelas/show/wali_kelas', [AdminClassController::class, 'show_wali_kelas'])->name('admin.kelas.show.wali_kelas')->middleware('admin');
    Route::get('/kelas/show/{id}', [AdminClassController::class, 'show'])->name('admin.kelas.show')->middleware('admin');
    Route::get('/kelas/datatables', [AdminClassController::class, 'datatables'])->name('admin.kelas.datatables')->middleware('admin');
    Route::get('/kelas/edit/{homeroom_teacher_id}', [AdminClassController::class, 'edit'])->name('admin.kelas.edit')->middleware('admin');
    Route::post('/kelas/update/{homeroom_teacher_id}/{class_room_id}', [AdminClassController::class, 'update'])->name('admin.kelas.update')->middleware('admin');
    /* ----------- End Admin -> Management Kelas ----------- */


    /* ------------------------------------------------------------------------------------------------------------------------------ */


    /* ----------- Start Siswa -> Daftar Siswa ----------- */
    Route::get('/siswa/daftar-siswa', [AdminStudentController::class, 'index'])->name('admin.siswa.daftar')->middleware('admin');
    Route::get('/siswa/daftar-siswa/show/{id}', [AdminStudentController::class, 'show'])->name('admin.siswa.daftar.show')->middleware('admin');
    Route::get('/siswa/daftar-siswa/datatables', [AdminStudentController::class, 'datatables'])->name('admin.siswa.daftar.datatables')->middleware('admin');
    Route::post('/siswa/daftar-siswa/store', [AdminStudentController::class, 'store'])->name('admin.siswa.daftar.store')->middleware('admin');
    Route::post('/siswa/daftar-siswa/update/{id}', [AdminStudentController::class, 'update'])->name('admin.siswa.daftar.update')->middleware('admin');
    Route::post('/siswa/daftar-siswa/destroy', [AdminStudentController::class, 'destroy'])->name('admin.siswa.daftar.destroy')->middleware('admin');
    Route::post('/siswa/daftar-siswa/reset_password/{id}', [AdminStudentController::class, 'reset_password'])->name('admin.siswa.daftar.reset_password')->middleware('admin');
    /* ----------- End Siswa -> Daftar Siswa ----------- */


    /* ------------------------------------------------------------------------------------------------------------------------------ */


    /* ----------- Start Guru -> Daftar Guru ----------- */
    Route::get('/guru/daftar-guru', [AdminTeacherManagementController::class, 'index'])->name('admin.guru.daftar')->middleware('admin');
    Route::get('/guru/daftar-guru/show/{id}', [AdminTeacherManagementController::class, 'show'])->name('admin.guru.daftar.show')->middleware('admin');
    Route::get('/guru/daftar-guru/datatables', [AdminTeacherManagementController::class, 'datatables'])->name('admin.guru.daftar.datatables')->middleware('admin');
    Route::post('/guru/daftar-guru/store', [AdminTeacherManagementController::class, 'store'])->name('admin.guru.daftar.store')->middleware('admin');
    Route::post('/guru/daftar-guru/update/{id}', [AdminTeacherManagementController::class, 'update'])->name('admin.guru.daftar.update')->middleware('admin');
    Route::post('/guru/daftar-guru/destroy', [AdminTeacherManagementController::class, 'destroy'])->name('admin.guru.daftar.destroy')->middleware('admin');
    Route::post('/guru/daftar-guru/reset_password/{id}', [AdminTeacherManagementController::class, 'reset_password'])->name('admin.guru.daftar.reset_password')->middleware('admin');
    /* ----------- End Guru -> Daftar Guru ----------- */


    /* ------------------------------------------------------------------------------------------------------------------------------ */


    /* ----------- Start Guru -> Setup Pengajar ----------- */
    Route::get('/guru/pengajar', [AdminTeacherSetupTeacherController::class, 'index'])->name('admin.guru.pengajar')->middleware('admin');
    Route::get('/guru/pengajar/show/{id}', [AdminTeacherSetupTeacherController::class, 'show'])->name('admin.guru.pengajar.show')->middleware('admin');
    Route::get('/guru/pengajar/datatables', [AdminTeacherSetupTeacherController::class, 'datatables'])->name('admin.guru.pengajar.datatables')->middleware('admin');
    Route::post('/guru/pengajar/store', [AdminTeacherSetupTeacherController::class, 'store'])->name('admin.guru.pengajar.store')->middleware('admin');
    Route::post('/guru/pengajar/update/{id}', [AdminTeacherSetupTeacherController::class, 'update'])->name('admin.guru.pengajar.update')->middleware('admin');
    Route::post('/guru/pengajar/destroy', [AdminTeacherSetupTeacherController::class, 'destroy'])->name('admin.guru.pengajar.destroy')->middleware('admin');
    /* ----------- End Guru -> Setup Pengajar ----------- */


    /* ------------------------------------------------------------------------------------------------------------------------------ */


    /* ----------- Start Guru -> Setup Pengajar ----------- */
    Route::get('/guru/wali_kelas', [AdminTeacherHomeroomTeacherController::class, 'index'])->name('admin.guru.wali_kelas')->middleware('admin');
    Route::get('/guru/wali_kelas/show/{id}', [AdminTeacherHomeroomTeacherController::class, 'show'])->name('admin.guru.wali_kelas.show')->middleware('admin');
    Route::get('/guru/wali_kelas/show_available_kelas/{school_year_id}', [AdminTeacherHomeroomTeacherController::class, 'show_available_kelas'])->name('admin.guru.wali_kelas.show_available_kelas')->middleware('admin');
    Route::get('/guru/wali_kelas/datatables', [AdminTeacherHomeroomTeacherController::class, 'datatables'])->name('admin.guru.wali_kelas.datatables')->middleware('admin');
    Route::post('/guru/wali_kelas/store', [AdminTeacherHomeroomTeacherController::class, 'store'])->name('admin.guru.wali_kelas.store')->middleware('admin');
    Route::post('/guru/wali_kelas/update/{id}', [AdminTeacherHomeroomTeacherController::class, 'update'])->name('admin.guru.wali_kelas.update')->middleware('admin');
    Route::post('/guru/wali_kelas/destroy', [AdminTeacherHomeroomTeacherController::class, 'destroy'])->name('admin.guru.wali_kelas.destroy')->middleware('admin');
    /* ----------- End Guru -> Setup Pengajar ----------- */


    /* ------------------------------------------------------------------------------------------------------------------------------ */


    /* ----------- Start Admin -> Setup -> Admin ----------- */
    Route::get('/setup/admin', [AdminSetupAdminController::class, 'index'])->name('admin.setup.admin')->middleware('admin');
    Route::get('/setup/admin/show/{id}', [AdminSetupAdminController::class, 'show'])->name('admin.setup.admin.show')->middleware('admin');
    Route::get('/setup/admin/datatables', [AdminSetupAdminController::class, 'datatables'])->name('admin.setup.admin.datatables')->middleware('admin');
    Route::post('/setup/admin/store', [AdminSetupAdminController::class, 'store'])->name('admin.setup.admin.store')->middleware('admin');
    Route::post('/setup/admin/update/{id}', [AdminSetupAdminController::class, 'update'])->name('admin.setup.admin.update')->middleware('admin');
    Route::post('/setup/admin/destroy', [AdminSetupAdminController::class, 'destroy'])->name('admin.setup.admin.destroy')->middleware('admin');
    Route::post('/setup/admin/reset_password/{id}', [AdminSetupAdminController::class, 'reset_password'])->name('admin.setup.admin.reset_password')->middleware('admin');
    /* ----------- End Admin -> Setup -> Admin ----------- */


    /* ------------------------------------------------------------------------------------------------------------------------------ */


    /* ----------- Start Admin -> Setup -> Tahun Ajar ----------- */
    Route::get('/setup/tahun_ajar', [AdminSetupSchoolYearController::class, 'index'])->name('admin.setup.tahun_ajar')->middleware('admin');
    Route::get('/setup/tahun_ajar/show/{id}', [AdminSetupSchoolYearController::class, 'show'])->name('admin.setup.tahun_ajar.show')->middleware('admin');
    Route::get('/setup/tahun_ajar/datatables', [AdminSetupSchoolYearController::class, 'datatables'])->name('admin.setup.tahun_ajar.datatables')->middleware('admin');
    Route::post('/setup/tahun_ajar/store', [AdminSetupSchoolYearController::class, 'store'])->name('admin.setup.tahun_ajar.store')->middleware('admin');
    Route::post('/setup/tahun_ajar/update/{id}', [AdminSetupSchoolYearController::class, 'update'])->name('admin.setup.tahun_ajar.update')->middleware('admin');
    Route::post('/setup/tahun_ajar/destroy', [AdminSetupSchoolYearController::class, 'destroy'])->name('admin.setup.tahun_ajar.destroy')->middleware('admin');
    /* ----------- End Admin -> Setup -> Tahun Ajar ----------- */


    /* ------------------------------------------------------------------------------------------------------------------------------ */


    /* ----------- Start Admin -> Setup -> Mata Pelajaran ----------- */
    Route::get('/setup/mapel', [AdminSetupSubjectController::class, 'index'])->name('admin.setup.mapel')->middleware('admin');
    Route::get('/setup/mapel/show/{id}', [AdminSetupSubjectController::class, 'show'])->name('admin.setup.mapel.show')->middleware('admin');
    Route::get('/setup/mapel/datatables', [AdminSetupSubjectController::class, 'datatables'])->name('admin.setup.mapel.datatables')->middleware('admin');
    Route::post('/setup/mapel/store', [AdminSetupSubjectController::class, 'store'])->name('admin.setup.mapel.store')->middleware('admin');
    Route::post('/setup/mapel/update/{id}', [AdminSetupSubjectController::class, 'update'])->name('admin.setup.mapel.update')->middleware('admin');
    Route::post('/setup/mapel/destroy', [AdminSetupSubjectController::class, 'destroy'])->name('admin.setup.mapel.destroy')->middleware('admin');
    /* ----------- End Admin -> Setup -> Mata Pelajaran ----------- */


    /* ------------------------------------------------------------------------------------------------------------------------------ */


    /* ----------- Start Admin -> Setup -> Kelas ----------- */
    Route::get('/setup/kelas', [AdminSetupClassRoomController::class, 'index'])->name('admin.setup.kelas')->middleware('admin');
    Route::get('/setup/kelas/show/{id}', [AdminSetupClassRoomController::class, 'show'])->name('admin.setup.kelas.show')->middleware('admin');
    Route::get('/setup/kelas/datatables', [AdminSetupClassRoomController::class, 'datatables'])->name('admin.setup.kelas.datatables')->middleware('admin');
    Route::post('/setup/kelas/store', [AdminSetupClassRoomController::class, 'store'])->name('admin.setup.kelas.store')->middleware('admin');
    Route::post('/setup/kelas/update/{id}', [AdminSetupClassRoomController::class, 'update'])->name('admin.setup.kelas.update')->middleware('admin');
    Route::post('/setup/kelas/destroy', [AdminSetupClassRoomController::class, 'destroy'])->name('admin.setup.kelas.destroy')->middleware('admin');
    /* ----------- End Admin -> Setup -> Kelas ----------- */
});
/* ----------- End Admin Route ----------- */

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth'])->name('dashboard');

require __DIR__ . '/auth.php';
