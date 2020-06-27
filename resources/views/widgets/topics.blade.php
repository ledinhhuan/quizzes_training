<div class="row">
    @forelse ($topics as $key => $topic)
        <div class="col-md-4">
            <div class="card card-plain">
                <div class="card-header card-header-image">
                    <a href="#" data-toggle="modal" data-slug="{{ $topic->slug }}" data-target="#showLevel-{{ $topic->id }}">
                        <img class="rounded img-fluid" src="{{ $topic->picture }}" />
                        <div class="card-title">
                            {{ $topic->name }}
                        </div>
                    </a>
                </div>
                <div class="card-body">
                    <p class="card-description">
                        {{ $topic->excerpt }}
                    </p>
                    <p class="card-text">
                        <small class="text-muted">{{ $topic->created_at }}</small>
                    </p>
                </div>
            </div>
        </div>
        @include('commons.modal', ['id' => $topic->id, 'slug' => $topic->slug])
    @empty
        <div class="col-md-12"><h2 class="text-center">@lang('messages.no_record')</h2></div>
    @endforelse
</div>
