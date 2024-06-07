@props(['id' => 'wysiwyg', 'name' => 'full_story', 'placeholder' => 'Start writing your article here...'])

<div>
    <textarea id="{{ $id }}" style="min-height: 400px;" name="{{ $name }}">
        {!! $placeholder !!}
    </textarea>
</div>

<script src="https://cdn.tiny.cloud/1/{{ setting('tinymce_api_key') }}/tinymce/7/tinymce.min.js" referrerpolicy="origin"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        tinymce.init({
            selector: 'textarea#{{ $id }}',
            formats: {
                alignleft: { selector: 'img,p,h1,h2,h3,h4,h5,h6,td,th,div,ul,ol,li,table', classes: 'atom-align-left' },
                aligncenter: { selector: 'img,p,h1,h2,h3,h4,h5,h6,td,th,div,ul,ol,li,table', classes: 'atom-align-center' },
                alignright: { selector: 'img,p,h1,h2,h3,h4,h5,h6,td,th,div,ul,ol,li,table', classes: 'atom-align-right' },
            },

            plugins: 'advlist autolink lists link image charmap print preview anchor searchreplace visualblocks code fullscreen insertdatetime media table paste help wordcount lists',
            toolbar: 'undo redo | formatselect | bold italic backcolor | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | removeformat | help | checklist | code | link image media table',
            content_style: `
                body { font-family:Helvetica,Arial,sans-serif; font-size:14px }

                .atom-align-left { float: left; margin: 0 10px 10px 0; }
                .atom-align-right { float: right; margin: 0 0 10px 10px; }
                .atom-align-center { display: block; margin: 0 auto; text-align: center; }

                .atom-align-center > * { text-align: center; }
            `,
            statusbar: false,
            branding: false,
            image_advtab: true,
            link_list: [],
            powerpaste_word_import: 'clean',
            paste_as_text: true,
        });
    });
</script>

