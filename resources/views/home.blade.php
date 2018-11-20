@extends('template.index')
@section('content')

@if(count($blogs))

<section class="site-section py-sm">
      <div class="container">
        <div class="row">
          <div class="col-md-6">
            <h2 class="mb-4"><br>Blogs</h2>
          </div>
        </div>
        <div class="row blog-entries">
          <div class="col-md-12 col-lg-8 main-content">
            <div class="row">

        @foreach($blogs as $b)
        
              <div class="col-md-6">
                <a href="blog-single.html" class="blog-entry element-animate" data-animate-effect="fadeIn">
                  <img src="images/img_5.jpg" alt="Image placeholder">
                  <div class="blog-content-body">
                    <div class="post-meta">
                      <span class="category">{{$b->countries}}</span>
                      <span class="mr-2">{{$b->created_at}}</span> &bullet;
                      <span class="ml-2"><span class="fa fa-comments"></span> 3</span>
                    </div>
                    <h2>{{$b->title}}</h2>
                    <p>{{$b->content}}</p>
                  </div>
                </a>
              </div>

        @endforeach

           </div>
</div>
</div>
</div>
</section>

        @else
        <p>There is no post</p>

 
@endif    

@stop