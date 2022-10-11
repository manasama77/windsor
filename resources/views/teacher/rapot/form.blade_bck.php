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
                                    <h3 class="card-title">Data Nilai</h3>
                                    <div class="card-tools">
                                        <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                            <i class="fas fa-minus"></i>
                                        </button>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive" id="v_data">
                                        <table class="table table-bordered table-sm" style="width: 100%;">
                                            <thead>
                                                <tr>
                                                    <td rowspan="4" class="align-bottom bg-info"
                                                        style="position: sticky; left: 0px; min-width: 200px;">Nama
                                                        Murid</td>
                                                    <td colspan="20" class="text-center bg-info">Nilai</td>
                                                </tr>

                                                <tr>
                                                    {{-- loop mapel name --}}
                                                    <td colspan="5" class="text-center bg-info">Mapel 1</td>
                                                    <td colspan="5" class="text-center bg-info">Mapel 2</td>
                                                    <td colspan="5" class="text-center bg-info">Mapel 3</td>
                                                    <td colspan="5" class="text-center bg-info">Mapel 4</td>
                                                </tr>
                                                <tr>
                                                    {{-- loop mapel --}}
                                                    <td rowspan="2" class="align-bottom bg-primary text-center"
                                                        style="min-width: 70px;">KKM</td>
                                                    <td colspan="2" class="align-bottom bg-info text-center">
                                                        Pengetahuan</td>
                                                    <td colspan="2" class="align-bottom bg-info text-center">
                                                        Keterampilan</td>

                                                    <td rowspan="2" class="align-bottom bg-primary text-center"
                                                        style="min-width: 70px;">KKM
                                                    </td>
                                                    <td colspan="2" class="align-bottom bg-info text-center">
                                                        Pengetahuan</td>
                                                    <td colspan="2" class="align-bottom bg-info text-center">
                                                        Keterampilan</td>

                                                    <td rowspan="2" class="align-bottom bg-primary text-center"
                                                        style="min-width: 70px;">KKM
                                                    </td>
                                                    <td colspan="2" class="align-bottom bg-info text-center">
                                                        Pengetahuan</td>
                                                    <td colspan="2" class="align-bottom bg-info text-center">
                                                        Keterampilan</td>

                                                    <td rowspan="2" class="align-bottom bg-primary text-center"
                                                        style="min-width: 70px;">KKM
                                                    </td>
                                                    <td colspan="2" class="align-bottom bg-info text-center">
                                                        Pengetahuan</td>
                                                    <td colspan="2" class="align-bottom bg-info text-center">
                                                        Keterampilan</td>
                                                </tr>
                                                <tr>
                                                    {{-- loop mapel --}}
                                                    <td class="text-center bg-primary" style="min-width: 70px;">Nilai</td>
                                                    <td class="text-center bg-primary" style="min-width: 70px;">Predikat
                                                    </td>
                                                    <td class="text-center bg-primary" style="min-width: 70px;">Nilai</td>
                                                    <td class="text-center bg-primary" style="min-width: 70px;">Predikat
                                                    </td>

                                                    <td class="text-center bg-primary" style="min-width: 70px;">Nilai</td>
                                                    <td class="text-center bg-primary" style="min-width: 70px;">Predikat
                                                    </td>
                                                    <td class="text-center bg-primary" style="min-width: 70px;">Nilai</td>
                                                    <td class="text-center bg-primary" style="min-width: 70px;">Predikat
                                                    </td>

                                                    <td class="text-center bg-primary" style="min-width: 70px;">Nilai</td>
                                                    <td class="text-center bg-primary" style="min-width: 70px;">Predikat
                                                    </td>
                                                    <td class="text-center bg-primary" style="min-width: 70px;">Nilai</td>
                                                    <td class="text-center bg-primary" style="min-width: 70px;">Predikat
                                                    </td>

                                                    <td class="text-center bg-primary" style="min-width: 70px;">Nilai</td>
                                                    <td class="text-center bg-primary" style="min-width: 70px;">Predikat
                                                    </td>
                                                    <td class="text-center bg-primary" style="min-width: 70px;">Nilai</td>
                                                    <td class="text-center bg-primary" style="min-width: 70px;">Predikat
                                                    </td>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td style="position: sticky; left: 0px;" class="bg-white">Murid
                                                        1</td>

                                                    <td class="text-center">
                                                        <input type="text" class="form-control form-control-sm"
                                                            min="0" max="100" />
                                                    </td>
                                                    <td class="text-center">
                                                        <input type="text" class="form-control form-control-sm"
                                                            min="0" max="100" />
                                                    </td>
                                                    <td class="text-center">
                                                        <select class="form-control"
                                                            style="height: 2rem; padding: .275rem .75rem;">
                                                            <option value="a">A</option>
                                                            <option value="b">B</option>
                                                            <option value="c">C</option>
                                                            <option value="d">D</option>
                                                            <option value="e">E</option>
                                                        </select>
                                                    </td>
                                                    <td class="text-center">
                                                        <input type="text" class="form-control form-control-sm"
                                                            min="0" max="100" />
                                                    </td>
                                                    <td class="text-center">
                                                        <select class="form-control"
                                                            style="height: 2rem; padding: .275rem .75rem;">
                                                            <option value="a">A</option>
                                                            <option value="b">B</option>
                                                            <option value="c">C</option>
                                                            <option value="d">D</option>
                                                            <option value="e">E</option>
                                                        </select>
                                                    </td>

                                                    <td class="text-center">
                                                        <input type="text" class="form-control form-control-sm"
                                                            min="0" max="100" />
                                                    </td>
                                                    <td class="text-center">
                                                        <input type="text" class="form-control form-control-sm"
                                                            min="0" max="100" />
                                                    </td>
                                                    <td class="text-center">
                                                        <select class="form-control"
                                                            style="height: 2rem; padding: .275rem .75rem;">
                                                            <option value="a">A</option>
                                                            <option value="b">B</option>
                                                            <option value="c">C</option>
                                                            <option value="d">D</option>
                                                            <option value="e">E</option>
                                                        </select>
                                                    </td>
                                                    <td class="text-center">
                                                        <input type="text" class="form-control form-control-sm"
                                                            min="0" max="100" />
                                                    </td>
                                                    <td class="text-center">
                                                        <select class="form-control"
                                                            style="height: 2rem; padding: .275rem .75rem;">
                                                            <option value="a">A</option>
                                                            <option value="b">B</option>
                                                            <option value="c">C</option>
                                                            <option value="d">D</option>
                                                            <option value="e">E</option>
                                                        </select>
                                                    </td>

                                                    <td class="text-center">
                                                        <input type="text" class="form-control form-control-sm"
                                                            min="0" max="100" />
                                                    </td>
                                                    <td class="text-center">
                                                        <input type="text" class="form-control form-control-sm"
                                                            min="0" max="100" />
                                                    </td>
                                                    <td class="text-center">
                                                        <select class="form-control"
                                                            style="height: 2rem; padding: .275rem .75rem;">
                                                            <option value="a">A</option>
                                                            <option value="b">B</option>
                                                            <option value="c">C</option>
                                                            <option value="d">D</option>
                                                            <option value="e">E</option>
                                                        </select>
                                                    </td>
                                                    <td class="text-center">
                                                        <input type="text" class="form-control form-control-sm"
                                                            min="0" max="100" />
                                                    </td>
                                                    <td class="text-center">
                                                        <select class="form-control"
                                                            style="height: 2rem; padding: .275rem .75rem;">
                                                            <option value="a">A</option>
                                                            <option value="b">B</option>
                                                            <option value="c">C</option>
                                                            <option value="d">D</option>
                                                            <option value="e">E</option>
                                                        </select>
                                                    </td>

                                                    <td class="text-center">
                                                        <input type="text" class="form-control form-control-sm"
                                                            min="0" max="100" />
                                                    </td>
                                                    <td class="text-center">
                                                        <input type="text" class="form-control form-control-sm"
                                                            min="0" max="100" />
                                                    </td>
                                                    <td class="text-center">
                                                        <select class="form-control"
                                                            style="height: 2rem; padding: .275rem .75rem;">
                                                            <option value="a">A</option>
                                                            <option value="b">B</option>
                                                            <option value="c">C</option>
                                                            <option value="d">D</option>
                                                            <option value="e">E</option>
                                                        </select>
                                                    </td>
                                                    <td class="text-center">
                                                        <input type="text" class="form-control form-control-sm"
                                                            min="0" max="100" />
                                                    </td>
                                                    <td class="text-center">
                                                        <select class="form-control"
                                                            style="height: 2rem; padding: .275rem .75rem;">
                                                            <option value="a">A</option>
                                                            <option value="b">B</option>
                                                            <option value="c">C</option>
                                                            <option value="d">D</option>
                                                            <option value="e">E</option>
                                                        </select>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
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
