<div class="btn-group">
    <button type="button" data-toggle="tooltip" data-placement="top" title="Reset Password" class="edit btn btn-info"
        onclick="resetPassword({{ $id }})">
        <i class="fas fa-key"></i>
    </button>
    <button type="button" data-toggle="tooltip" data-placement="top" title="Edit" class="edit btn btn-success edit"
        onclick="editData({{ $id }})">
        <i class="fas fa-pencil-alt"></i>
    </button>
    <a href="javascript:void(0)" data-id="{{ $id }}" data-toggle="tooltip" data-original-title="Delete"
        class="delete btn btn-danger">
        <i class="fas fa-trash"></i>
    </a>
</div>