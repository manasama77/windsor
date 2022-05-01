@extends('partials.admin.main')

@section('contents')
<meta name="csrf-token" content="{{ csrf_token() }}">
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-12">
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

            <form id="form">
                @csrf
                <div class="row">

                    <div class="col-sm-12 col-md-4 offset-md-4">
                        <div class="card card-primary shadow-sm">
                            <div class="card-header">
                                <h3 class="card-title">Informasi Kelas</h3>
                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                        <i class="fas fa-minus"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="school_year_name">Tahun Ajar</label>
                                    <input type="text" class="form-control" id="school_year_name" id="school_year_name"
                                        value="{{ $school_year_name }}" required readonly />
                                </div>
                                <div class="form-group">
                                    <label for="classroom_name">Kelas</label>
                                    <input type="text" class="form-control" id="classroom_name" id="classroom_name"
                                        value="{{ $classroom_name }}" required readonly />
                                </div>
                                <div class="form-group">
                                    <label for="homeroom_teacher_name">Wali Kelas</label>
                                    <input type="text" class="form-control" id="homeroom_teacher_name"
                                        id="homeroom_teacher_name" value="{{ $homeroom_teacher_name }}" required
                                        readonly />
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="row">

                    <div class="col-12">
                        <div class="card card-info shadow-sm">
                            <div class="card-header">
                                <h3 class="card-title">Pilih Siswa</h3>
                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                        <i class="fas fa-minus"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="student_id">Siswa</label>
                                    <select class="form-control" id="student_id" name="student_id" row="20" multiple
                                        style="height: 400px;">
                                        @foreach ($availStudent as $students)
                                        <option value="{{ $students->id }}" @if(in_array($students->id,
                                            $usedStudent))
                                            selected
                                            @endif
                                            >{{ $students->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>

                    @env('local')
                    <div class="col-12" id="error"></div>
                    @endenv

                    <div class="col-sm-12 col-md-8 offset-md-2 mb-4">
                        <button type="submit" class="btn btn-primary btn-block" id="simpan"><i
                                class="fas fa-save fa-fw"></i>
                            Simpan</button>
                        <a href="{{ route('admin.kelas') }}" class="btn btn-secondary btn-block"><i
                                class="fas fa-arrow-left fa-fw"></i>
                            Kembali</a>
                    </div>

                </div>
            </form>
        </div>
    </section>
    <!-- /.content -->
</div>
@endsection

@section('contents_vitamin')
@include('admin.kelas.form_vitamin')
@endsection