<!DOCTYPE html>
<html>
<head>
    <title>Blog App</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}"
    <link rel="stylesheet" href="{{ asset('css/main.css') }}">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container">
            <a class="navbar-brand" href="{{ route('blogs.index') }}">Blog App</a>

            <!-- Logout Button -->
            <a href="{{ route('admin.login') }}" class="btn btn-info">Admin</a>
        </div>
    </nav>
    <div class="py-4">
    <main class="blog">
      <section class="blog-section blog-section-cmn-space fade-up">
        <div class="container">
          <div class="blog-nav-wrapper d-flex">
            <div class="blog-nav">
              <ul>
              <li>
            <a href="#" class="btn filter-btn active me-2" data-filter="all">All</a>
        </li>
        <li>
            <a href="#" class="btn filter-btn" data-filter="recent">Most Recent</a>
        </li>
              </ul>
            </div>
            <div class="blog-search">
                <div class="subscription-form jet-mt-16">
                    <input
                        type="text"
                        id="searchInput"
                        placeholder="Search here"
                        class="search-input"
                    />
                    <button type="button" id="searchButton" class="btn btn-primary btn-primary-sm font-btn-small">
                        <img src="{{ asset('assets/images/svg/search-icon.svg')}}" alt="search">
                    </button>
                </div>
            </div>
          </div>
        </div>
        <div class="container">
            <div class="blog-card-wrapper d-flex align-items-center justify-content-between">
                @forelse($blogs as $blog)
                <div
                    class="blog-card-item fade-up cursor-pointer"
                    onclick="window.location='{{ route('blog.details', $blog->id) }}';">
                    <div class="blog-card-img">
                    <img
                        src="{{ asset('storage/' . $blog->image) }}"
                        class="img-fluid d-block w-100"
                        alt="blog"/>
                    </div>
                    <div class="blog-description">
                    <h4 style= "height:50px">
                    {{ $blog['name'] }}
                    </h4>

                    <p>Published at {{ date('F d, Y', strtotime($blog['date'])) }}</p>
                    </div>
                </div>
                @empty
                    <p>No blogs available at the moment.</p>
                @endforelse
            </div>
        </div>
        <!-- Pagination -->
        <div class="d-flex justify-content-center "style = background-color:green>
            {{ $blogs->links('pagination::bootstrap-4') }}
        </div>
      </section>
      <!-- explore-section -->
    </main>
    <!-- main-content -->
    </div>
    <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
<script>
$(document).ready(function() {
    let searchTimer;
    let currentFilter = 'all';

    // Function to load blogs
    function loadBlogs(query = '') {
        $.get('{{ route("blogs.index") }}', { 
            query: query,
            sort: currentFilter === 'recent' ? 'recent' : null,
            ajax: true
        }, function(response) {
            let html = '';
            
            if(response.blogs.data.length > 0) {
                response.blogs.data.forEach(function(blog) {
                    html += `
                    <div class="blog-card-item fade-up cursor-pointer" 
                         onclick="window.location='{{ route('blog.details', ['id' => $blog->id]) }}';">
                        <div class="blog-card-img">
                            <img src="/storage/${blog.image}" 
                                 class="img-fluid d-block w-100" 
                                 alt="blog"/>
                        </div>
                        <div class="blog-description">
                            <h4 style="height:50px">${blog.name}</h4>
                            <p>Published at ${new Date(blog.date).toLocaleDateString('en-US', { 
                                month: 'long', 
                                day: 'numeric', 
                                year: 'numeric' 
                            })}</p>
                        </div>
                    </div>`;
                });
            } else {
                html = '<p>No blogs available at the moment.</p>';
            }
            
            $('.blog-card-wrapper').html(html);
        });
    }

    // Search input handler with debounce
    $('#searchInput').on('keyup', function() {
        clearTimeout(searchTimer);
        searchTimer = setTimeout(() => {
            loadBlogs($(this).val());
        }, 500);
    });

    // Filter click handler
    $('.filter-btn').click(function(e) {
        e.preventDefault();
        $('.filter-btn').removeClass('active');
        $(this).addClass('active');
        
        currentFilter = $(this).data('filter');
        loadBlogs($('#searchInput').val());
    });

    // Initial load
    loadBlogs();
});
</script>
</body>
</html>
