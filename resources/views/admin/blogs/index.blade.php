@extends('layouts.admin')

@section('content')
<div class="d-flex justify-content-between mb-4">
    <h2>Blogs</h2>
    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#blogModal">Create Blog</button>
</div>

<div id="blogsTable"></div>

<!-- Blog Modal -->
<div class="modal fade" id="blogModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Blog Post</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form id="blogForm" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="blog_id" id="blog_id">
                <div class="modal-body">
                    <div class="mb-3">
                        <label>Name</label>
                        <input type="text" name="name" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label>Date</label>
                        <input type="date" name="date" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label>Author Name</label>
                        <input type="text" name="author_name" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label>Content</label>
                        <textarea name="content" id="content" class="form-control"></textarea>
                    </div>
                    <div class="mb-3">
                        <label>Image</label>
                        <input type="file" name="image" class="form-control" accept="image/*">
                        <div id="currentImage"></div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>

@push('scripts')
<script>
ClassicEditor
   .create(document.querySelector('#content'), {
       toolbar: ['heading', '|', 'bold', 'italic', 'link', 'bulletedList', 'numberedList', '|', 'undo', 'redo']
   })
   .then(editor => {
       window.editor = editor;
   });

$(document).ready(function() {
   function loadBlogs() {
       $.get('{{ route("admin.blogs.index") }}', function(response) {
           let html = `<table class="table">
               <thead>
                   <tr>
                       <th>Name</th>
                       <th>Date</th>
                       <th>Author</th>
                       <th>Actions</th>
                   </tr>
               </thead>
               <tbody>`;
           response.blogs.forEach(function(blog) {
               html += `<tr>
                   <td>${blog.name}</td>
                   <td>${blog.date}</td>
                   <td>${blog.author_name}</td>
                   <td>
                       <button class="btn btn-sm btn-info edit-blog" data-blog='${JSON.stringify(blog)}'>Edit</button>
                       <button class="btn btn-sm btn-danger delete-blog" data-id="${blog.id}">Delete</button>
                   </td>
               </tr>`;
           });
           html += '</tbody></table>';
           $('#blogsTable').html(html);
       });
   }

   $('#blogForm').submit(function(e) {
       e.preventDefault();
       let formData = new FormData(this);
       let blog_id = $('#blog_id').val();
       let url = blog_id ? `{{ url("admin/blogs") }}/${blog_id}` : '{{ route("admin.blogs.store") }}';
       let method = blog_id ? 'PUT' : 'POST';

       formData.append('content', window.editor.getData());

       $.ajax({
           url: url,
           type: method,
           data: formData,
           processData: false,
           contentType: false,
           success: function(response) {
               $('#blogModal').modal('hide');
               $('#blogForm')[0].reset();
               window.editor.setData('');
               loadBlogs();
           }
       });
   });

   $(document).on('click', '.edit-blog', function() {
       let blog = $(this).data('blog');
       $('#blog_id').val(blog.id);
       $('#blogForm [name="name"]').val(blog.name);
       $('#blogForm [name="date"]').val(blog.date);
       $('#blogForm [name="author_name"]').val(blog.author_name);
       window.editor.setData(blog.content);
       $('#currentImage').html(blog.image ? `<img src="/storage/${blog.image}" class="mt-2" style="max-height: 100px;">` : '');
       $('#blogModal').modal('show');
   });

   $(document).on('click', '.delete-blog', function() {
       if(confirm('Are you sure?')) {
           let id = $(this).data('id');
           $.ajax({
               url: `{{ url("admin/blogs") }}/${id}`,
               type: 'DELETE',
               data: {_token: '{{ csrf_token() }}'},
               success: function() {
                   loadBlogs();
               }
           });
       }
   });

   loadBlogs();
});
</script>
@endpush
@endsection