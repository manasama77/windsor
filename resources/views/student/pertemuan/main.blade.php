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
                            <h3 class="card-title">Data Pertemuan</h3>
                        </div>
                        <div class="card-body table-responsive">
                            <table class="table table-hover w-100">
                                <thead>
                                    <tr>
                                        <th style="width: 10px">#</th>
                                        <th>Tahun Ajar</th>
                                        <th>Semester</th>
                                        <th>Pengajar</th>
                                        <th>Kelas</th>
                                        <th>MAPEL</th>
                                        <th>Judul</th>
                                        <th class="text-center" style="width: 40px">
                                            <i class="fas fa-cogs"></i>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($meetings as $meeting)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $meeting->homeroomTeacher->schoolYear->name }}</td>
                                        <td>
                                            <?php
                                            $odd_from = $meeting->homeroomTeacher->schoolYear->odd_period_from;
                                            $odd_to = $meeting->homeroomTeacher->schoolYear->odd_period_to;
                                            $even_from = $meeting->homeroomTeacher->schoolYear->even_period_from;
                                            $even_to = $meeting->homeroomTeacher->schoolYear->even_period_to;

                                            $now = new DateTime('now');
                                            $oddFrom = new DateTime($odd_from);
                                            $oddTo = new DateTime($odd_to);
                                            $evenFrom = new DateTime($even_from);
                                            $evenTo = new DateTime($even_to);

                                            $semester = "-";
                                            if($now >= $oddFrom && $now <= $oddTo){ 
                                                $semester="GANJIL";
                                            }elseif($now>= $evenFrom && $now <= $evenTo){
                                                $semester="GENAP";
                                            }
                                             echo $semester;
                                             ?>
                                        </td>
                                        <td>
                                            {{ $meeting->teacher->name }}
                                        </td>
                                        <td>
                                            {{ $meeting->homeroomTeacher->classRoom->name }}
                                        </td>
                                        <td>
                                            {{ $meeting->subject->name }}
                                        </td>
                                        <td>
                                            {{ $meeting->title }}
                                        </td>
                                        <td>
                                            <a href="{{ route('student.pertemuan.show', $meeting->id) }}"
                                                class="btn btn-info" target="_blank" data-toggle="tooltip"
                                                data-placement="top" title="Detail">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                        </td>

                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
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