<div>

    <div class="nav-toggle d-block d-lg-none">
        <button class="btn btn-toggle toggle-sidebar">
            <i class="gg-menu-right text-black"></i>
        </button>
        <button class="btn btn-toggle sidenav-toggler">
            <i class="gg-menu-left text-black"></i>
        </button>
    </div>



<div class="sidebar" data-background-color="dark">
   
    <div class="sidebar-logo">
        <!-- Logo Header -->
        <div class="logo-header" data-background-color="dark">
            <a href="{{ route('dashboard.home') }}" class="logo">
                <img src="{{asset('static_images/admire_holidays_2.png')}}" alt="navbar brand" class="navbar-brand" height="20" />
            </a>
            <div class="nav-toggle">
                <button class="btn btn-toggle toggle-sidebar">
                    <i class="gg-menu-right"></i>
                </button>
                <button class="btn btn-toggle sidenav-toggler">
                    <i class="gg-menu-left"></i>
                </button>
            </div>
            <button class="topbar-toggler more">
                <i class="gg-more-vertical-alt"></i>
            </button>
        </div>
        <!-- End Logo Header -->

    </div>



    <div class="nav-toggle d-flex justify-content-end d-block d-lg-none">
        <button class="btn btn-toggle sidenav-toggler ms-auto pe-4 py-2 px-3">
            <i class="text-white fs-3">&times;</i>
        </button>
    </div>
    

    <div class="sidebar-wrapper scrollbar scrollbar-inner">
        <div class="sidebar-content">


            <ul class="nav nav-secondary">

                <li class="nav-section">
                    <span class="sidebar-mini-icon">
                        <i class="fa fa-ellipsis-h"></i>
                    </span>
                </li>

  
                <!-- Itinerary Section -->
                <li class="nav-item">
                    <a data-bs-toggle="collapse" href="#itinerary">
                        <i class="fas fa-calendar-alt"></i>
                        <p>Itinerary</p>
                        <span class="caret"></span>
                    </a>
                    <div class="collapse" id="itinerary">
                        <ul class="nav nav-collapse">
                            <li>
                                <a href="{{ route('itinerary.create') }}">
                                    <span class="sub-item">Add Itinerary</span>
                                </a>
                            </li>
  
  
                            <li>
                              <a href="{{ route('itinerary-location-detail-images.index') }}">
                                  <span class="sub-item">Itinerary Images</span>
                              </a>
                          </li>
  
                            <li>
                                <a href="{{ route('itinerary.index') }}">
                                    <span class="sub-item">Itinerary List</span>
                                </a>
                            </li>
  
  
                            <li>
                              <a href="{{ route('terms-and-conditions.index') }}">
                                  <span class="sub-item">Terms and Condition</span>
                              </a>
                          </li>
  
  
                          <li>
                              <a href="{{ route('special-notes.index') }}">
                                  <span class="sub-item">Special Note</span>
                              </a>
                          </li>
  
  
                          <li>
                              <a href="{{ route('cancellation-policies.index') }}">
                                  <span class="sub-item">Cancellation Policy</span>
                              </a>
                          </li>
  
                          <li>
                              <a href="{{ route('payment-modes.index') }}">
                                  <span class="sub-item">Payment Mode</span>
                              </a>
                          </li>
  
  
                          <li>
                              <a href="{{ route('itinerary-video.index') }}">
                                  <span class="sub-item">Itinerary Videos</span>
                              </a>
                          </li>
                          
                        </ul>
                    </div>
                </li>
  
  
  
  
  
  
                 <!-- Video Banner Section -->
                 <li class="nav-item">
                  <a data-bs-toggle="collapse" href="#video_banner">
                      <i class="fas fa-video"></i>
                      <p>Video Banner</p>
                      <span class="caret"></span>
                  </a>
                  <div class="collapse" id="video_banner">
                      <ul class="nav nav-collapse">
                          <li>
                              <a href="{{ route('selected-destination-video-banner.index') }}">
                                  <span class="sub-item">Destination Video Banner</span>
                              </a>
                          </li>
  
  
                          <li>
                              <a href="{{ route('hero-section-videos.index') }}">
                                  <span class="sub-item">Hero Section Videos</span>
                              </a>
                          </li>
                        
                      </ul>
                  </div>
              </li>
  
  
  
  
                <!-- Gallery Section -->
                <li class="nav-item">
                  <a data-bs-toggle="collapse" href="#gallery">
                      <i class="fas fa-image"></i>
  
                      <p>Gallery</p>
                      <span class="caret"></span>
                  </a>
                  <div class="collapse" id="gallery">
                      <ul class="nav nav-collapse">
                          <li>
                              <a href="{{ route('gallery.index') }}">
                                  <span class="sub-item">Gallery</span>
                              </a>
                          </li>
                        
                      </ul>
                  </div>
              </li>






              <li class="nav-item">
                <a data-bs-toggle="collapse" href="#destination_gallery">
                    <i class="fas fa-globe-americas"></i>

                    <p>Destination Gallery</p>
                    <span class="caret"></span>
                </a>
                <div class="collapse" id="destination_gallery">
                    <ul class="nav nav-collapse">
                        <li>
                            <a href="{{ route('destination-galleries.index') }}">
                                <span class="sub-item">Destination Gallery</span>
                            </a>
                        </li>
                      
                    </ul>
                </div>
            </li>




  
  
               <!-- Destination Images Section -->
               <li class="nav-item">
                  <a data-bs-toggle="collapse" href="#destination_images">
                      <i class="fas fa-image"></i>
  
                      <p>Destination Images</p>
                      <span class="caret"></span>
                  </a>
                  <div class="collapse" id="destination_images">
                      <ul class="nav nav-collapse">
                          <li>
                              <a href="{{ route('destination-images.index') }}">
                                  <span class="sub-item">Destination Images</span>
                              </a>
  
                              <a href="{{ route('destination-images.create') }}">
                                  <span class="sub-item">Create Destination Images</span>
                              </a>
                          </li>
                        
                      </ul>
                  </div>
              </li>
  
  
  
  
               <!-- Blog Section -->
               <li class="nav-item">
                  <a data-bs-toggle="collapse" href="#blog">
                      <i class="fas fa-image"></i>
  
                      <p>Blog</p>
                      <span class="caret"></span>
                  </a>
                  <div class="collapse" id="blog">
                      <ul class="nav nav-collapse">
                          <li>
                              <a href="{{ route('blogs.index') }}">
                                  <span class="sub-item">Blogs</span>
                              </a>
  
  
                              <a href="{{ route('blog-content-images.index') }}">
                                  <span class="sub-item">Blog Content Images</span>
                              </a>
  
                              <a href="{{ route('blog-categories.index') }}">
                                  <span class="sub-item">Blog Categories</span>
                              </a>
  
                          </li>
                        
                      </ul>
                  </div>
              </li>
  
  
  
              <li class="nav-item">
                  <a data-bs-toggle="collapse" href="#testimonials">
                      <i class="fas fa-comments"></i>
  
                      <p>Testimonials</p>
                      <span class="caret"></span>
                  </a>
                  <div class="collapse" id="testimonials">
                      <ul class="nav nav-collapse">
                          <li>
  
                              <a href="{{ route('image-and-text-testimonials.index') }}">
                                  <span class="sub-item">Image and text testimonials</span>
                              </a>
  
                              <a href="{{ route('video-testimonials.index') }}">
                                  <span class="sub-item">Video testimonials</span>
                              </a>
  
                          </li>
                        
                      </ul>
                  </div>
              </li>
  
  
  
  
  
  
              <li class="nav-item">
                  <a data-bs-toggle="collapse" href="#destinations">
                      <i class="fas fa-map-marker-alt"></i>
  
  
                      <p>Destinations</p>
                      <span class="caret"></span>
                  </a>
                  <div class="collapse" id="destinations">
                      <ul class="nav nav-collapse">
                          <li>
  
                              <a href="{{ route('destinations.index') }}">
                                  <span class="sub-item">Destinations</span>
                              </a>
  
                          </li>
                        
                      </ul>
                  </div>
              </li>










              <li class="nav-item">
                <a data-bs-toggle="collapse" href="#counter">
                    <i class="fas fa-chart-line"></i> 

                    <p>Counters</p>
                    <span class="caret"></span>
                </a>
                <div class="collapse" id="counter">
                    <ul class="nav nav-collapse">
                        <li>

                            <a href="{{ route('counters.index') }}">
                                <span class="sub-item">Counters</span>
                            </a>

                        </li>
                      
                    </ul>
                </div>
            </li>






            <li class="nav-item">
                <a data-bs-toggle="collapse" href="#resort">
                    <i class="fas fa-hotel"></i>

                    <p>Resorts</p>
                    <span class="caret"></span>
                </a>
                <div class="collapse" id="resort">
                    <ul class="nav nav-collapse">
                        <li>

                            <a href="{{ route('resorts.index') }}">
                                <span class="sub-item">Resorts</span>
                            </a>

                        </li>
                      
                    </ul>
                </div>
            </li>
            
            
            
            
            
            
            
            
            
            
            
            
                        {{-- <li class="nav-item">
                <a data-bs-toggle="collapse" href="#weekend_gateway">
                    <i class="fas fa-umbrella-beach text-primary"></i>

                    <p>Weekend Gateway</p>
                    <span class="caret"></span>
                </a>
                <div class="collapse" id="weekend_gateway">
                    <ul class="nav nav-collapse">
                        <li>

                            <a href="{{ route('destination-images.index', ['destination_type' => 'weekend_gateway']) }}">
                                <span class="sub-item">Weekend Gateway Images</span>
                            </a>                            
  
                              <a href="{{ route('destination-images.create', ['destination_type' => 'weekend_gateway']) }}">
                                  <span class="sub-item">Create Weekend Gateway Images</span>
                              </a>

                        </li>
                      
                    </ul>
                </div>
            </li> --}}





            <li class="nav-item">
                <a data-bs-toggle="collapse" href="#footer">
                    <i class="fas fa-shoe-prints"></i>

                    <p>Footer</p>
                    <span class="caret"></span>
                </a>
                <div class="collapse" id="footer">
                    <ul class="nav nav-collapse">
                        <li>

                            <a href="{{ route('footers.index') }}">
                                <span class="sub-item">Footer</span>
                            </a>

                        </li>
                      
                    </ul>
                </div>
            </li>



            

  
  
            </ul>
        </div>
    </div>
  </div>
  






</div>