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
            </div>
        </div>
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <form id="form">
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
                                                    <th class="align-top">
                                                        {{ $meetings->homeroomTeacher->schoolYear->name }}
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
                                                    <th class="align-top">{{ $meetings->homeroomTeacher->classRoom->name
                                                        }}
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
                                <h3 class="card-title">Data Penilaian</h3>
                            </div>
                            <div class="card-body table-responsive">
                                <table id="vdata" class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th style="width: 10px">#</th>
                                            <th>Siswa</th>
                                            <th style="width: 100px;">Nilai</th>
                                            <th>Tugas</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($students as $student)
                                        @if($student->student_id)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $student->student_name }}</td>
                                            <td>
                                                <input type="number" class="form-control"
                                                    name="value[{{ $loop->iteration - 1 }}]" step="1" min="0" max="100"
                                                    value="<?= ($student->value) ?? 0; ?>" required />
                                            </td>
                                            <td>
                                                @if ($student->student_work_id)
                                                <a href="{{ route('teacher.penilaian.download', $student->student_work_id) }}"
                                                    target="_blank">
                                                    @if($student->mime == "image/jpeg")
                                                    <i class="fas fa-file-image"></i>
                                                    @elseif($student->mime == "application/zip")
                                                    <i class="fas fa-file-archive"></i>
                                                    @elseif($student->mime ==
                                                    "application/vnd.openxmlformats-officedocument.wordprocessingml.document")
                                                    <i class="fas fa-file-word"></i>
                                                    @elseif($student->mime ==
                                                    "application/vnd.openxmlformats-officedocument.spreadsheetml.sheet")
                                                    <i class="fas fa-file-excel"></i>
                                                    @elseif($student->mime ==
                                                    "text/plain")
                                                    <i class="fas fa-file-alt"></i>
                                                    @elseif($student->mime ==
                                                    "application/vnd.openxmlformats-officedocument.presentationml.presentation")
                                                    <i class="fas fa-file-powerpoint"></i>
                                                    @elseif($student->mime == "application/pdf")
                                                    <i class="fas fa-file-pdf"></i>
                                                    @else
                                                    <i class="fas fa-file"></i>
                                                    @endif
                                                    {{ $student->file_name }}
                                                </a>
                                                @endif
                                            </td>
                                        </tr>
                                        @endif
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row mb-5">
                    <div class="col-12">
                        <input type="hidden" id="meeting_id" name="meeting_id" value="{{ $meeting_id }}" />
                        <button type="submit" id="btn_simpan" class="btn btn-primary btn-block"
                            onclick="simpanData()"><i class="fas fa-save"></i> Simpan</button>
                        <div id="error"></div>
                    </div>
                </div>
            </form>
        </div>
    </section>
</div>
@endsection

@section('contents_vitamin')
@include('teacher.penilaian.main_vitamin')
@endsection