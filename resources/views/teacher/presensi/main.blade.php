@extends('partials.teacher.main')

@section('contents')
<meta name="csrf-token" content="{{ csrf_token() }}">
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-12 col-md-6">
                    <h1 class="m-0">{{ $content_title }}</h1>
                </div>
                {{-- <div class="col-sm-12 col-md-6 text-right">
                    <a href="{{ route('teacher.pertemuan') }}" class="btn btn-secondary">
                        <i class="fas fa-backward"></i> Kembali Ke Data Pertemuan
                    </a>
                </div> --}}
            </div>
        </div>
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">

            <div class="row">
                <div class="col-12">
                    <div class="card card-primary shadow-sm">
                        <div class="card-header">
                            <h3 class="card-title">Informasi Pertemuan</h3>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-sm-12 col-md-6">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th class="align-top">Tahun Ajar</th>
                                                <th class="align-top">{{ $meetings->homeroomTeacher->schoolYear->name }}
                                                </th>
                                            </tr>
                                            <tr>
                                                <th class="align-top">Semester</th>
                                                <th class="align-top">
                                                    @if($meetings->active_date >=
                                                    $meetings->homeroomTeacher->schoolYear->even_period_from &&
                                                    $meetings->active_date <= $meetings->
                                                        homeroomTeacher->schoolYear->even_period_to)
                                                        Genap
                                                        @elseif($meetings->active_date >=
                                                        $meetings->homeroomTeacher->schoolYear->odd_period_from &&
                                                        $meetings->active_date <= $meetings->
                                                            homeroomTeacher->schoolYear->odd_period_to)
                                                            Ganjil
                                                            @endif
                                                </th>
                                            </tr>
                                            <tr>
                                                <th class="align-top">Pengajar</th>
                                                <th class="align-top">{{ $meetings->teacher->name }}</th>
                                            </tr>
                                            <tr>
                                                <th class="align-top">Kelas</th>
                                                <th class="align-top">{{ $meetings->homeroomTeacher->classRoom->name }}
                                                </th>
                                            </tr>
                                        </thead>
                                    </table>
                                </div>
                                <div class="col-sm-12 col-md-6">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th class="align-top">MAPEL</th>
                                                <th class="align-top">{{ $meetings->subject->name }}</th>
                                            </tr>
                                            <tr>
                                                <th class="align-top">Judul</th>
                                                <th class="align-top">{{ $meetings->title }}</th>
                                            </tr>
                                        </thead>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="card card-primary shadow-sm">
                        <div class="card-header">
                            <h3 class="card-title">Data Presensi</h3>
                        </div>
                        <div class="card-body table-responsive">
                            <table id="vdata" class="table table-hover">
                                <thead>
                                    <tr>
                                        <th style="width: 10px">#</th>
                                        <th>Siswa</th>
                                        <th>Kehadiran</th>
                                        <th>Keterangan</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($students as $student)
                                    <tr id="student_id_{{ $student->student_id }}">
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $student->name }}</td>
                                        <td>
                                            <select class="form-control"
                                                name="status_presence[{{ $loop->iteration - 1 }}]" required>
                                                <option value=""></option>
                                                <option value="hadir">Hadir</option>
                                                <option value="sakit">Sakit</option>
                                                <option value="ijin">Ijin</option>
                                                <option value="tidak hadir">Tidak Hadir</option>
                                            </select>
                                        </td>
                                        <td>
                                            <input type="text" class="form-control"
                                                name="description[{{ $loop->iteration - 1 }}]" />
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row mb-5">
                <div class="col-12">
                    <input type="hidden" id="meeting_id" value="{{ $meeting_id }}" />
                    <input type="hidden" id="homeroom_teacher_id" value="{{ $homeroom_teacher_id }}" />
                    <button type="button" id="btn_simpan" class="btn btn-primary btn-block" onclick="simpanData()"><i
                            class="fas fa-save"></i> Simpan</button>
                    <div id="error"></div>
                </div>
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>
@endsection

@section('contents_vitamin')
@include('teacher.presensi.main_vitamin')
@endsection