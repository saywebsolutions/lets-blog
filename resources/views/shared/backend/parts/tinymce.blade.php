  <script src="/vendor/lets-blog/packages/tinymce/js/tinymce/tinymce.min.js"></script>

  <script type="text/javascript">
    tinymce.init({
      selector: '#wysiwyg',
      height: 500,
      theme: 'modern',
      plugins: [
        'advlist autolink lists link image charmap preview hr anchor pagebreak',
        'searchreplace wordcount visualblocks visualchars code fullscreen',
        'insertdatetime media nonbreaking save table contextmenu directionality',
        'template paste textcolor colorpicker textpattern imagetools codesample toc help'
      ],
      toolbar1: 'insert | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image preview media | codesample code fullscreen',
      image_advtab: true,
      templates: [
        { title: 'Shell Output', content: '<pre class="command-line  language-bash" data-user="user" data-host="server"><code></code></pre>' },
      ],
      code_dialog_height: 600,
      code_dialog_width: 1080 
    });
  </script>
