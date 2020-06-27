<div class="col-md-12 ml-auto text-center">
    @if (count($topics) and $topics->hasMorePages())
        <button class="btn btn-info" id="load-more" data-page="{{ $topics->currentPage() }}">More <i class="material-icons">arrow_right_alt</i></button>
    @endif
</div>
