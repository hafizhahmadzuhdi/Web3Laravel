<div class="col-md-12 col-lg-4 sidebar">
	<div class="sidebar-box">
          <h3 class="text-center">Author</h3>
              <div class="bio text-center">
                @if(is_null($b->user->image))
                <img src="/images/profile.png" alt="Image Placeholder" class="img-fluid" style="border-radius: 50%; width: 100px; margin-top: 10px;">
                @else
                <img src="/images/{{ $b->user->image }}" alt="Image Placeholder" class="img-fluid" style="border-radius: 50%; width: 100px; margin-top: 10px;">
                @endif
                <div class="bio-body">
                  <h2>{{ $b->user->name }}</h2>
                  @if (is_null($b->user->bio))
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Exercitationem facilis sunt repellendus excepturi beatae porro debitis voluptate nulla quo veniam fuga sit molestias minus.</p>
                  @else
                    <p>{{ $b->user->bio }}</p>
                  @endif
                    <p><a href="#" class="btn btn-primary btn-sm">Subscribe</a></p>
                    <p class="social">
                      <a href="#" class="p-2"><span class="fa fa-facebook"></span></a>
                      <a href="#" class="p-2"><span class="fa fa-twitter"></span></a>
                      <a href="#" class="p-2"><span class="fa fa-instagram"></span></a>
                      <a href="#" class="p-2"><span class="fa fa-youtube-play"></span></a>
                  </p>
                </div>
              </div>
            </div>
        </div>