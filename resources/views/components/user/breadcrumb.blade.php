<!-- Breadcrumb -->
<div class="mb-5 card">
   @if($cardHeader)
   <h5 class="card-header">{{ $title ?? 'Breadcrumbs' }}</h5>
   @endif
  <div class="card-body">
    <!-- Dynamic Breadcrumb -->
    <nav aria-label="breadcrumb">
      <ol class="breadcrumb {{ $styleClass ?? '' }} mb-0">
        @foreach($breadcrumbs as $breadcrumb)
          <li class="breadcrumb-item {{ $breadcrumb['active'] ? 'active' : '' }}">
            @if(!$breadcrumb['active'])
              <a href="{{ $breadcrumb['url'] }}">{{ $breadcrumb['label'] }}</a>
            @else
              {{ $breadcrumb['label'] }}
            @endif
          </li>
        @endforeach
      </ol>
    </nav>
  </div>
</div>
<!--/ Breadcrumb -->
