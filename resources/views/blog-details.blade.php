<!DOCTYPE html>
<html>
<head>
    <title>Blog App</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}"
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container">
            <a class="navbar-brand" href="{{ route('blogs.index') }}">Blog App</a>
        </div>
        
    </nav>
    <div class="py-4">
    <section class="blog-details-banner fade-in" id="blog-head"></section>

<main class="blog">
  <section class="blog-section fade-up cmn-spacing-top">
    <div class="container blog-container">
    <h2>{{$blog->name}}</h2>
      <img
        src="{{ asset('storage/' . $blog->image) }}"
        class="img-fluid w-100"
      />

      <div class="jet-mt-20">
        <a class="back-btn" href="{{ route('blogs.index') }}"
          ><img src="{{ asset('assets/images/svg/back-icon.svg')}}" /> Back to Main
          Page</a
        >
      </div>

      <div class="blog-details">
        <p>{!! $blog->content !!}</p>
        <h4>Published by {{$blog->author_name}}</h4>
        <h5>{{ date('F d, Y', strtotime($blog['date'])) }}</h5>
      </div>
    </div>
  </section>
    
    </div>
</body>
</html>