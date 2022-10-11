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
                                <h3 class="card-title">Data Pengajar</h3>
                            </div>
                            <div class="card-body table-responsive">
                                <table class="table table-hover datatables w-100">
                                    <thead>
                                        <tr>
                                            <th style="width: 10px">#</th>
                                            <th>Tahun Ajar</th>
                                            <th>Kelas</th>
                                            <th>Guru</th>
                                            <th>Mapel</th>
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
                        <form action="{{ route('admin.guru.pengajar.store') }}" method="post">
                            @csrf
                            <div class="card card-secondary shadow-sm">
                                <div class="card-header">
                                    <h3 class="card-title">Tambah Pengajar</h3>
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
                                            @foreach ($schoolYears as $schoolYear)
                                                <option value="{{ $schoolYear->id }}">{{ $schoolYear->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="class_room_id">Kelas</label>
                                        <select class="form-control" id="class_room_id" name="class_room_id" required>
                                            <option value=""></option>
                                            @foreach ($classRooms as $classRoom)
                                                <option value="{{ $classRoom->id }}">{{ $classRoom->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="teacher_id">Guru</label>
                                        <select class="form-control" id="teacher_id" name="teacher_id" required>
                                            <option value=""></option>
                                            @foreach ($teachers as $teacher)
                                                <option value="{{ $teacher->id }}">{{ $teacher->name }}</option>
                                            @endforeach
                                        </select>
                                        @error('teacher_id')
                                            <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="subject_id">Mata Pelajaran</label>
                                        <select class="form-control" id="subject_id" name="subject_id" required>
                                            <option value=""></option>
                                            @foreach ($subjects as $subject)
                                                <option value="{{ $subject->id }}">{{ $subject->name }}</option>
                                            @endforeach
                                        </select>
                                        @error('subject_id')
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
                            <label for="school_year_id_edit">Tahun Ajar</label>
                            <select class="form-control" id="school_year_id_edit" name="school_year_id" required>
                                <option value=""></option>
                                @foreach ($schoolYears as $schoolYear)
                                    <option value="{{ $schoolYear->id }}">{{ $schoolYear->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="class_room_id_edit">Kelas</label>
                            <select class="form-control" id="class_room_id_edit" name="class_room_id" required>
                                <option value=""></option>
                                @foreach ($classRooms as $classRoom)
                                    <option value="{{ $classRoom->id }}">{{ $classRoom->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="teacher_id_edit">Guru</label>
                            <select class="form-control" id="teacher_id_edit" name="teacher_id" required>
                                <option value=""></option>
                                @foreach ($teachers as $teacher)
                                    <option value="{{ $teacher->id }}">{{ $teacher->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="subject_id_edit">Mata Pelajaran</label>
                            <select class="form-control" id="subject_id_edit" name="subject_id" required>
                                <option value=""></option>
                                @foreach ($subjects as $subject)
                                    <option value="{{ $subject->id }}">{{ $subject->name }}</option>
                                @endforeach
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
    @include('admin.guru.pengajar.main_vitamin')
@endsection
