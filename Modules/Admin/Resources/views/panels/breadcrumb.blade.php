<div class="content-header row mt-1">

  <div class="content-header-left col-md-8 col-12 mb-2">
    <div class="row breadcrumbs-top">
      <div class="col-12">

        <h2 class="content-header-title float-left mb-0 {{ isset($breadcrumbs) ? '' : 'border-0' }}">
          @yield('title')
        </h2>

        <div class="breadcrumb-wrapper">
          @if(@isset($breadcrumbs))
          <ol class="breadcrumb">

            {{-- this will load breadcrumbs dynamically from controller --}}
            @foreach ($breadcrumbs as $breadcrumb)
            <li class="breadcrumb-item">

              @if(isset($breadcrumb['link']))
              <a href="{{ url($breadcrumb['link']) }}">{{$breadcrumb['name']}}</a>
              @else
              {{$breadcrumb['name']}}
              @endif

            </li>
            @endforeach

          </ol>
          @endisset
        </div>

      </div>
    </div>
  </div>

  @yield('actions')
</div>