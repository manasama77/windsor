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

            <!-- Small boxes (Stat box) -->
            <div class="row">
                <div class="col-sm-12 col-md-8">
                    <div class="card card-primary shadow-sm">
                        <div class="card-header">
                            <h3 class="card-title">Data Kelas</h3>
                        </div>
                        <div class="card-body table-responsive">
                            <table class="table table-hover datatables w-100">
                                <thead>
                                    <tr>
                                        <th style="width: 10px">#</th>
                                        <th>Nama Kelas</th>
                                        <th>Tipe Kelas</th>
                                        <th>Kejuruan</th>
                                        <th>Status</th>
                                        <th class="text-center" style="width: 40px">
                                            <i class="fas fa-cogs"></i>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="col-sm-12 col-md-4">
                    <form action="{{ route('admin.setup.kelas.store') }}" method="post">
                        @csrf
                        <div class="card card-secondary shadow-sm">
                            <div class="card-header">
                                <h3 class="card-title">Tambah Kelas</h3>
                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                        <i class="fas fa-minus"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="name">Nama Kelas</label>
                                    <input type="text" class="form-control" id="name" name="name"
                                        placeholder="Nama Kelas" value="{{ old('name') }}" required />
                                    @error('name')
                                    <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="classroom_type">Tipe Kelas</label>
                                    <select class="form-control" id="classroom_type" name="classroom_type" required>
                                        <option value="mandiri">Mandiri</option>
                                        <option value="komunitas">Komunitas</option>
                                        <option value="tutorial">Tutorial</option>
                                    </select>
                                    @error('classroom_type')
                                    <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="vocational_type">Kejuruan</label>
                                    <select class="form-control" id="vocational_type" name="vocational_type" required>
                                        <option value="ipa">IPA</option>
                                        <option value="ips">IPS</option>
                                    </select>
                                    @error('vocational_type')
                                    <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="is_active">Aktif ?</label>
                                    <select class="form-control" id="is_active" name="is_active" required>
                                        <option value="1">Aktif</option>
                                        <option value="0">Tidak Aktif</option>
                                    </select>
                                    @error('is_active')
                                    <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="card-footer">
                                <button type="submit" class="btn btn-success btn-block">
                                    Simpan
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>

<!-- Modal -->
<form id="form_edit">
    <div class="modal fade" id="modal_edit" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modal_title">Edit</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    @csrf
                    <div class="form-group">
                        <label for="name_edit">Nama Kelas</label>
                        <input type="text" class="form-control" id="name_edit" name="name" placeholder="Nama Kelas"
                            required />
                    </div>
                    <div class="form-group">
                        <label for="classroom_type_edit">Tipe Kelas</label>
                        <select class="form-control" id="classroom_type_edit" name="classroom_type" required>
                            <option value="mandiri">Mandiri</option>
                            <option value="komunitas">Komunitas</option>
                            <option value="tutorial">Tutorial</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="vocational_type_edit">Kejuruan</label>
                        <select class="form-control" id="vocational_type_edit" name="vocational_type" required>
                            <option value="ipa">IPA</option>
                            <option value="ips">IPS</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="is_active_edit">Aktif ?</label>
                        <select class="form-control" id="is_active_edit" name="is_active" required>
                            <option value="1">Aktif</option>
                            <option value="0">Tidak Aktif</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary" id="btn_edit">Simpan</button>
                </div>
            </div>
        </div>
    </div>
</form>
@endsection

@section('contents_vitamin')
@include('admin.setup.kelas.main_vitamin')
@endsection