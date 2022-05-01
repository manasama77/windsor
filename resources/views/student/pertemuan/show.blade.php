@extends('partials.student.main')

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
                            {{ $meetings->description }}
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
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>
@endsection

@section('contents_vitamin')
@include('student.pertemuan.main_vitamin')
@endsection