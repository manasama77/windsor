@extends('partials.student.main')

@section('contents')
<meta name="csrf-token" content="{{ csrf_token() }}">
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-12 col-md-6">
                    <h1 class="m-0">{{ $page_title }}</h1>
                </div>
            </div>
        </div>
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">

            @if (Session::has('success'))
            <div class="row">
                <div class="col-12">
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <strong>{{ Session::get('success') }}</strong>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                </div>
            </div>
            @endif

            @if (Session::has('error'))
            <div class="row">
                <div class="col-12">
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <strong>{{ Session::get('error') }}</strong>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                </div>
            </div>
            @endif

            <!-- Small boxes (Stat box) -->
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
                                                <th class="align-top">Pengajar</th>
                                                <th class="align-top">{{ $meetings->teacher->name }}</th>
                                            </tr>
                                        </thead>
                                    </table>
                                </div>
                                <div class="col-sm-12 col-md-6">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th class="align-top">Kelas</th>
                                                <th class="align-top">{{ $meetings->homeroomTeacher->classRoom->name }}
                                                </th>
                                            </tr>
                                            <tr>
                                                <th class="align-top">MAPEL</th>
                                                <th class="align-top">{{ $meetings->subject->name }}</th>
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
                    <div class="card card-info shadow-sm">
                        <div class="card-header">
                            <h3 class="card-title">{{ $meetings->title }}</h3>
                        </div>
                        <div class="card-body">
                            {!! nl2br($meetings->description) !!}
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                @if($meeting_attachments->count() > 0)
                <div class="col-sm-12 col-md-6">
                    <div class="card card-warning shadow-sm">
                        <div class="card-header">
                            <h3 class="card-title">Lampiran</h3>
                        </div>
                        <div class="card-body">
                            <ul>
                                @foreach ($meeting_attachments as $a)
                                <li>
                                    <a href="{{ route('student.pertemuan.download', $a->id) }}" target="_blank">
                                        {{ $a->name }}
                                    </a>
                                </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
                @endif

                @if ($meeting_link_externals->count() > 0)
                <div class="col-sm-12 col-md-6">
                    <div class="card card-danger shadow-sm">
                        <div class="card-header">
                            <h3 class="card-title">Link External</h3>
                        </div>
                        <div class="card-body">
                            <ul>
                                @foreach ($meeting_link_externals as $a)
                                <li>
                                    <a href="{{ $a->url }}" target="_blank">
                                        {{ $a->url }}
                                    </a>
                                </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
                @endif
            </div>
            @if($meetings->is_task)
            <div class="alert alert-danger text-center" role="alert">
                <i class="fas fa-exclamation-circle fa-fw"></i> Periode Pengumpulan tugas <b>{{
                    $from_period->isoFormat('LLLL')
                    }} s/d {{ $to_period->isoFormat('LLLL')
                    }}</b>
            </div>
            @if($can_upload)
            <div class="row">
                <div class="col-sm-12 col-md-4 offset-md-4">
                    <div class="card card-dark shadow-sm">
                        <div class="card-header">
                            <h3 class="card-title">Upload Tugas</h3>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('student.pertemuan.upload', $meetings->id) }}" method="post"
                                enctype="multipart/form-data">
                                @csrf
                                <div class="form-group">
                                    <label for="file">Upload Tugas</label>
                                    <input type="file" class="form-control" id="file" name="file" required />
                                </div>
                                <button type="submit" class="btn btn-primary btn-block"><i class="fas fa-save"></i>
                                    Simpan</button>
                            </form>
                            @if($student_works != null)
                            <hr />
                            <table class="table table-bordered">
                                <thead class="bg-dark">
                                    <tr>
                                        <th>File Tugas</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>
                                            <a href="{{ route('student.pertemuan.download.tugas', $student_works->id) }}"
                                                target="_blank">
                                                {{ $student_works->file_name }}
                                            </a>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            @endif
            @endif

            <div class="row mb-3">
                <div class="col-12">
                    <a href="{{ route('student.chat.verify', $chatToken) }}" target="_blank"
                        class="btn btn-primary btn-block">Join
                        Chat Room</a>
                </div>
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>
@endsection

@section('contents_vitamin')
@include('student.pertemuan.main_vitamin')
@endsection