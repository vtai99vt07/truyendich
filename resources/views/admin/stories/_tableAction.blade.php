<div class="list-icons">
    @can('stories.delete')
        <a href="javascript:void(0)" data-url="{{ route('admin.stories.destroy', $id) }}"
           class="item-action js-delete btn-danger" title="{{ __('Xóa') }}"><i class="fal fa-trash-alt"></i></a>
    @endcan
</div>
