{{-- 인클루드 시킨 곳에 ckeditor 포함되어야 함 --}}
{{-- editor_name="string", comment=true or false --}}

@php
$image = $image ?? false;
@endphp

<style>
    .ck-editor__editable {
        min-height: {{ $height ?? "200" }}px;
    }

    .ck-editor__editable_inline {
        min-height: {{ $height ?? "200" }}px;
        height: {{ $height ?? "200" }}px;
    }

    textarea#{{$editor_name ?? "ckeditor"}} {
        width: 100%;
        min-height: {{ $height ?? "200" }}px;
    }

    p.help {
        font-size: 14px;
        color: #b71c1c;
    }

</style>
{{--@if (Browser::isIE())--}}
{{--    <p class="help">* 익스플로러를 이용하는 경우 에디터 기능을 사용할 수 없습니다. 크롬, 엣지, 웨일 등 모던 브라우저를 사용해주시기 바랍니다.</p>--}}
{{--@endif--}}

<textarea name="{{ $editor_name ?? "text" }}" id="{{ $editor_name ?? "ckeditor" }}" cols="30" rows="10" style="height:1000px"></textarea>
<input type="hidden" name="editor_path" id="__storage" value="{{ $path ?? "default" }}">

@if ($image)
    <input type="hidden" name="{{ $input_image_name ?? "editor_image" }}" id="{{ $input_image_name ?? "editor_image" }}">
@endif

<script>

    var textEditor, CommentEditor;

    var items = [
        'heading',
        'fontFamily',
        'fontSize',
        '|',
        'bold',
        'italic',
        'link',
        'bulletedList',
        'numberedList',
        '|',
        'indent',
        'outdent',
        '|',
        'blockQuote',
        'insertTable',
        'undo',
        'redo'
    ];

    @if ($image) //

        items = [
            'heading',
            '|',
            'fontFamily',
            'fontSize',
            'bold',
            'italic',
            'link',
            'imageUpload',
            'bulletedList',
            'numberedList',
            '|',
            'indent',
            'outdent',
            '|',
            'blockQuote',
            'insertTable',
            // 'mediaEmbed',
            'undo',
            'redo',
            'fontBackgroundColor',
            'fontColor',
        ];

    @endif




    ClassicEditor
        .create( document.querySelector( '#{{ $editor_name ?? "ckeditor" }}' ), {
            @if ($image)
                extraPlugins: [ MyCustomUploadAdapterPlugin ],
            @endif
            toolbar: {
                items: items
            },
            language: 'ko',
            image: {
                toolbar: [
                    'imageTextAlternative',
                    'imageStyle:full',
                    'imageStyle:side'
                ]
            },
            table: {
                contentToolbar: [
                    'tableColumn',
                    'tableRow',
                    'mergeTableCells'
                ]
            },
            licenseKey: '',

        } )
        .then( editor => {
            window.editor = editor;
            @if ($comment)
                CommentEditor = editor;
            @else
                textEditor = editor;
            @endif


            @if (isset($contents))
                textEditor.data.set('{!! $contents !!}');
            @endif

        } )
        .catch( error => {
            console.error( 'Oops, something went wrong!' );
            console.error( 'Please, report the following error on https://github.com/ckeditor/ckeditor5/issues with the build id and the error stack trace:' );
            console.warn( 'Build id: ntkcrseek39t-36qf72rjtp4e' );
            console.error( error );
        } );
</script>

