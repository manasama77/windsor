@extends('partials.teacher.main')

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
                    <div class="col-sm-12 col-md-6">
                        <div class="card card-primary shadow-sm">
                            <div class="card-header">
                                <h3 class="card-title">Informasi Pertemuan</h3>
                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                        <i class="fas fa-minus"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="teacher_id">Pengajar</label>
                                    <input type="text" class="form-control" id="teacher_name" name="teacher_name"
                                        required readonly />
                                    {{-- <select class="form-control" id="teacher_id" name="teacher_id" required>
                                        <option value=""></option>
                                        @foreach ($setupTeachers as $setupTeacher)
                                        <option value="{{ $setupTeacher->teacher->id }}">{{
                                            $setupTeacher->teacher->name
                                            }}</option>
                                        @endforeach
                                    </select> --}}
                                    @error('teacher_id')
                                    <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="homeroom_teacher_id">Kelas</label>
                                    <select class="form-control" id="homeroom_teacher_id" name="homeroom_teacher_id"
                                        required>
                                        <option value=""></option>
                                        @foreach ($homeRoomTeachers as $homeRoomTeacher)
                                        <option value="{{ $homeRoomTeacher->id }}">{{ $homeRoomTeacher->classRoom->name
                                            }}</option>
                                        @endforeach
                                    </select>
                                    @error('homeroom_teacher_id')
                                    <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="subject_id">MAPEL</label>
                                    <select class="form-control" id="subject_id" name="subject_id">
                                        <option value=""></option>
                                        @foreach ($subjects as $key)
                                        <option value="{{ $key->subject_id }}">{{ $key->subject->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('subject_id')
                                    <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="active_date">Tanggal Aktif Pertemuan</label>
                                    <input type="date" class="form-control" id="active_date" name="active_date"
                                        required />
                                </div>
                                <div class="form-group">
                                    <label for="is_task">Berikan Tugas ?</label>
                                    <select class="form-control" id="is_task" name="is_task" required>
                                        <option value="0">Tidak</option>
                                        <option value="1">Ya</option>
                                    </select>
                                    @error('is_task')
                                    <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="periode_aktif">Periode Aktif Tugas</label>
                                    <input type="text" class="form-control" id="periode_aktif" name="periode_aktif"
                                        required />
                                    <input type="hidden" id="from_period" name="from_period"
                                        value="{{ $meetings->from_period }}" />
                                    <input type="hidden" id="to_period" name="to_period"
                                        value="{{ $meetings->to_period }}" />
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-6">
                        <div class="card card-info shadow-sm">
                            <div class="card-header">
                                <h3 class="card-title">Detail Pertemuan</h3>
                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                        <i class="fas fa-minus"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="title">Judul</label>
                                    <input type="text" class="form-control" id="title" name="title"
                                        value="{{ $meetings->title }}" required />
                                    @error('title')
                                    <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="description">Deskripsi</label>
                                    <textarea class="form-control" id="description" name="description"
                                        placeholder="Deskripsi" rows="11"
                                        required>{{ $meetings->description }}</textarea>
                                    @error('description')
                                    <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12 col-md-6">
                        <div class="card card-warning shadow-sm">
                            <div class="card-header">
                                <h3 class="card-title">Lampiran Pertemuan</h3>
                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                        <i class="fas fa-minus"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="arr_lampiran">File Lampiran</label>
                                    <input type="file" class="form-control" id="arr_lampiran" name="arr_lampiran"
                                        multiple />
                                    <span class="text-muted">Kamu dapat memilih lebih dari 1 file dengan menggunakan
                                        CTRL pada saat memilih file</span>
                                    @error('arr_lampiran')
                                    <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="table-responsive">
                                    <table class="table table-hover">
                                        <thead class="bg-dark">
                                            <tr>
                                                <th colspan="2" class="text-center">Lampiran Sebelumnya</th>
                                            </tr>
                                            <tr>
                                                <th>Nama</th>
                                                <th class="text-center"><i class="fas fa-cog"></i></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($meetingAttachments as $meetingAttachment)
                                            <tr id="row_{{ $meetingAttachment->id }}">
                                                <td>{{ $meetingAttachment->name }}</td>
                                                <td class="text-center">
                                                    <input type="hidden" name="old_attachment[]"
                                                        value="{{ $meetingAttachment->id }}" />
                                                    <button type="button" class="btn btn-danger btn-sm"
                                                        onclick="deleteAttachment('{{ $meetingAttachment->id }}')">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                </td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-6">
                        <div class="card card-danger shadow-sm">
                            <div class="card-header">
                                <h3 class="card-title">Link External</h3>
                                <input type="hidden" id="old_link" value="{{ $meetingLinkExternals }}" />
                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                        <i class="fas fa-minus"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="form-group">
                                    <label>Link</label>
                                    <div id="group_link"></div>
                                    <button type="button" class="btn btn-info btn-block mt-3" id="button_add_link"><i
                                            class="fas fa-plus"></i> Tambah Link</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <button type="submit" id="simpan" class="btn btn-primary btn-block"><i class="fas fa-save"></i>
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
@include('teacher.pertemuan.form_edit_vitamin')
@endsection