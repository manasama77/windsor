<div class="btn-group">
    <a href="{{ route('teacher.presensi', $id) }}" target="_blank" data-toggle="tooltip" data-placement="top"
        title="Presensi" class="btn btn-info">
        <i class="fas fa-calendar-check"></i>
    </a>
    <a href="{{ route('teacher.penilaian', $id) }}" target="_blank" data-toggle="tooltip" data-placement="top"
        title="Penilaian" class="btn btn-warning">
        <i class="fas fa-tasks"></i>
    </a>
    <a href="{{ route('teacher.pertemuan.edit', $id) }}" data-toggle="tooltip" data-placement="top" title="Edit"
        class="btn btn-success">
        <i class="fas fa-pencil-alt"></i>
    </a>
    <a href="javascript:void(0)" data-id="{{ $id }}" data-title="{{ $title }}" data-toggle="tooltip"
        data-original-title="Delete" class="delete btn btn-danger">
        <i class="fas fa-trash"></i>
    </a>
    <a href="{{ route('teacher.chat.verify', base64_encode($id . ':' . Session::get('teacher_id')) ) }}" target="_blank"
        data-toggle="tooltip" data-original-title="Join Chat" class="btn btn-primary">
        <i class="fas fa-comment"></i>
    </a>
</div>