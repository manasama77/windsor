@extends('partials.teacher.main')

@section('contents')
    <style>
    </style>
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

                <div id="debug">
                </div>

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
                <form id="form">
                    @csrf
                    <div class="row">
                        <div class="col-sm-12 col-md-4 offset-md-4">
                            <div class="card card-primary shadow-sm">
                                <div class="card-header">
                                    <h3 class="card-title">Informasi Rapot</h3>
                                    <div class="card-tools">
                                        <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                            <i class="fas fa-minus"></i>
                                        </button>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="school_year_id">Tahun Ajar</label>
                                        <select class="form-control" id="school_year_id" name="school_year_id" required>
                                            <option value=""></option>
                                            @foreach ($school_years as $key)
                                                <option value="{{ $key->id }}">{{ $key->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="period">Periode</label>
                                        <div class="row">
                                            <div class="col">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="period"
                                                        id="period_ganjil" value="odd" checked>
                                                    <label class="form-check-label" for="period_ganjil">
                                                        Ganjil
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="period"
                                                        id="period_genap" value="even">
                                                    <label class="form-check-label" for="period_genap">
                                                        Genap
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="class_room_id">Kelas</label>
                                        <select class="form-control" id="class_room_id" name="class_room_id" required>
                                            <option value=""></option>
                                            @foreach ($class_rooms as $key)
                                                <option value="{{ $key->id }}">{{ $key->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <button type="button" class="btn btn-primary btn-block" id="btn_show">
                                        <i class="fas fa-search fa-fw"></i> Show
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="card card-warning shadow-sm">
                                <div class="card-header">
                                    <h3 class="card-title font-weight-bold">Data Nilai</h3>
                                    <div class="card-tools">
                                        <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                            <i class="fas fa-minus"></i>
                                        </button>
                                        <button type="button" class="btn btn-tool" data-card-widget="maximize">
                                            <i class="fas fa-expand"></i>
                                        </button>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive" id="v_data"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <button type="submit" id="simpan" class="btn btn-primary btn-block"><i
                                    class="fas fa-save"></i>
                                Simpan</button>
                            <a href="{{ route('teacher.pertemuan') }}" class="btn btn-secondary btn-block">Kembali</a>
                        </div>
                    </div>
                </form>
                <!-- /.row -->
            </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>
@endsection

@section('contents_vitamin')
    @include('teacher.rapot.form_vitamin')
@endsection
