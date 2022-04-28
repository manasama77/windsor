<div class="btn-group">
    <a href="{{ route('teacher.pertemuan.edit', $id) }}" data-toggle="tooltip" data-placement="top" title="Edit"
        class="edit btn btn-success edit">
        <i class="fas fa-pencil-alt"></i>
    </a>
    <a href="javascript:void(0)" data-id="{{ $id }}" data-title="{{ $title }}" data-toggle="tooltip"
        data-original-title="Delete" class="delete btn btn-danger">
        <i class="fas fa-trash"></i>
    </a>
</div>