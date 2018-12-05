@extends('template.index')
@section('content')

@if(count($blogs) > 0)

<section class="site-section py-sm">
      <div class="container">
        <div class="row">
          <div class="col-md-6">
            @if (isset($title))
                <h2 class="mb-4"><br>{{$title}}</h2>
            @else
                <h2 class="mb-4"><br>Blogs</h2>
            @endif
          </div>
        </div>
        <div class="row blog-entries">
          <div class="col-md-12 col-lg-12 main-content">
            <div class="row">

        @foreach($blogs as $b)
            @component('components.blog-card')
                @slot('blog', $b);
                @slot('includeControls', false):
            @endcomponent
        @endforeach

           </div>
</div>
</div>
</div>
</section>
{{--
        {{ $blogs->render()}}

 --}}


        @else
        <p>There is no post</p>


@endif

@stop
