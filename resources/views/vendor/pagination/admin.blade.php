@if ($paginator->hasPages())
  <div class="row mt-3" role="navigation" aria-label="{{ __('Pagination Navigation') }}">
    <div class="col-sm-12 col-md-5">
      <div class="dataTables_info" id="multi-filter-select_info" role="status" aria-live="polite">
        {!! __('Showing') !!}
        @if ($paginator->firstItem())
          {{ $paginator->firstItem() }}
          {!! __('to') !!}
          {{ $paginator->lastItem() }}
        @else
          {{ $paginator->count() }}
        @endif
        {!! __('of') !!}
        {{ $paginator->total() }}
        {!! __('results') !!}
      </div>
    </div>

    <div class="col-sm-12 col-md-7">
      <div class="dataTables_paginate paging_simple_numbers" id="multi-filter-select_paginate">
        <ul class="pagination">

          @if ($paginator->onFirstPage())
            <li class="paginate_button page-item previous disabled" id="multi-filter-select_previous">
              <a href="{{ $paginator->previousPageUrl() }}"
                 aria-controls="multi-filter-select" data-dt-idx="0" tabindex="0" class="page-link">
                {!! __('pagination.previous') !!}</a>
            </li>
          @else
            <li class="paginate_button page-item previous" id="multi-filter-select_previous">
              <a href="{{ $paginator->previousPageUrl() }}"
                 aria-controls="multi-filter-select" data-dt-idx="0" tabindex="0" class="page-link">
                {!! __('pagination.previous') !!}</a>
            </li>
          @endif

          {{-- Pagination Elements --}}
          @foreach ($elements as $element)
            {{-- "Three Dots" Separator --}}
            @if (is_string($element))
              <span aria-disabled="true">
                <span class="">{{ $element }}</span>
              </span>
            @endif

            {{-- Array Of Links --}}
            @if (is_array($element))
              @foreach ($element as $page => $url)
                @if ($page == $paginator->currentPage())
                  <li class="paginate_button page-item active" aria-current="page">
                    <a href="#" aria-controls="multi-filter-select" data-dt-idx="{{ $page }}"
                       tabindex="0" class="page-link">{{ $page }}</a></li>
                @else
                  <li class="paginate_button page-item ">
                    <a href="{{ $url }}" aria-controls="multi-filter-select" data-dt-idx="{{ $page }}"
                       aria-label="{{ __('Go to page :page', ['page' => $page]) }}"
                       tabindex="0" class="page-link">{{ $page }}</a></li>
                @endif
              @endforeach
            @endif
          @endforeach

          @if ($paginator->hasMorePages())
            <li class="paginate_button page-item next" id="multi-filter-select_next">
              <a href="{{ $paginator->nextPageUrl() }}" aria-controls="multi-filter-select" data-dt-idx="3" tabindex="0"
                 class="page-link">{!! __('pagination.next') !!}</a>
            </li>
          @else
            <li class="paginate_button page-item next disabled" id="multi-filter-select_next">
              <a href="{{ $paginator->nextPageUrl() }}" aria-controls="multi-filter-select" data-dt-idx="3" tabindex="0"
                 class="page-link">{!! __('pagination.next') !!}</a>
            </li>
          @endif
        </ul>
      </div>
    </div>
  </div>
@endif
