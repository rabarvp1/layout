<div class="page-header page-header-light shadow">
    <div class="page-header-content">
        <div class="d-flex justify-content-between">
            <h4 class="page-title mb-0">
                {{ $attributes['name'] }}
            </h4>

            @if ($attributes['modal'])
                <a href="javascript:void(0)" class="btn btn-primary align-self-center btn-icon w-32px h-32px rounded-pill" data-bs-toggle="modal" data-bs-target="#{{ $attributes['modal'] }}">
                    <i class="ph-plus m-1"></i>
                </a>
            @endif

            @if ($attributes['url'])
                <a href="{{ $attributes['url'] }}" class="btn btn-primary align-self-center btn-icon w-32px h-32px rounded-pill">
                    <i class="ph-plus m-1"></i>
                </a>
            @endif
        </div>
    </div>
</div>
