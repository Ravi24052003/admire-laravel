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

  <div class="sidebar-wrapper scrollbar scrollbar-inner">
      <div class="sidebar-content">
          <ul class="nav nav-secondary">
              <li class="nav-section">
                  <span class="sidebar-mini-icon">
                      <i class="fa fa-ellipsis-h"></i>
                  </span>
              </li>

              <!-- User Section (Visible only if role_id is admin) -->
              @if(auth()->user()->role == "admin")
              {{-- <li class="nav-item">
                  <a data-bs-toggle="collapse" href="#user">
                      <i class="fa fa-users"></i>
                      <p>User</p>
                      <span class="caret"></span>
                  </a>
                  <div class="collapse" id="user">
                      <ul class="nav nav-collapse">
                          <li>
                              <a href="{{ route('dashboard.add-user') }}">
                                  <span class="sub-item">Add User</span>
                              </a>
                          </li>
                          <li>
                              <a href="{{ route('dashboard.user-list') }}">
                                  <span class="sub-item">User List</span>
                              </a>
                          </li>
                      </ul>
                  </div>
              </li> --}}
              @endif

              <!-- Blog Section -->
              {{-- <li class="nav-item">
                  <a data-bs-toggle="collapse" href="#blog">
                      <i class="far fa-clone"></i>
                      <p>Blog</p>
                      <span class="caret"></span>
                  </a>
                  <div class="collapse" id="blog">
                      <ul class="nav nav-collapse">
                          <li>
                              <a href="{{ route('dashboard.add-blog') }}">
                                  <span class="sub-item">Add Blog</span>
                              </a>
                          </li>
                          <li>
                              <a href="{{ route('dashboard.blog-list') }}">
                                  <span class="sub-item">Blog List</span>
                              </a>
                          </li>
                          <li>
                              <a href="{{ route('dashboard.add-blogcategory') }}">
                                  <span class="sub-item">Add Blog Category</span>
                              </a>
                          </li>
                          <li>
                              <a href="{{ route('dashboard.blogcategory-list') }}">
                                  <span class="sub-item">Blog Category List</span>
                              </a>
                          </li>
                      </ul>
                  </div>
              </li> --}}

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
                                <span class="sub-item">Itinerary Content Images</span>
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


          </ul>
      </div>
  </div>
</div>
