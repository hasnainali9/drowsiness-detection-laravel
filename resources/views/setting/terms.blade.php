@extends('layout.app')
@section('title')
    Terms & Condition
@endsection

@section('content')
    <link rel="stylesheet" href="/assets/libs/quill/quill.snow.css">
    <!-- Start::app-content -->
    <div class="main-content app-content">
        <div class="container-fluid">

            <!-- PAGE-HEADER -->
            <div class="page-header">
                <h1 class="page-title my-auto">Terms & Condition</h1>
                <div>
                    <ol class="breadcrumb mb-0">
                        <li class="breadcrumb-item">
                            <a href="javascript:void(0)">Setting</a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">Terms & Condition</li>
                    </ol>
                </div>
            </div>
            <!-- PAGE-HEADER END -->



            <!-- Start:: row-2 -->
            <div class="row">
                <div class="col-xl-12">
                    <div class="card custom-card">
                        <div class="card-header">
                            <div class="card-title">
                                Update Terms & Condition
                            </div>
                        </div>
                        <div class="card-body">
                            <!-- Add a form with a textarea for the Quill editor content -->
                            <form action="{{ route('settings.updatePrivacyPolicy') }}" method="POST" id="identifier">
                                @csrf
                                <div class="form-group">
                                    <label for="editor">Terms & Condition Content</label>
                                    <div id="editor" name="editor">{!! optional($setting)->value ? urldecode($setting->value) : '' !!}</div>
                                </div>
                                <textarea name="value" style="display:none" id="hiddenArea">{{ optional($setting)->value ? urldecode($setting->value) : '' }}</textarea>

                                <button type="submit" class="btn btn-primary">Submit</button>
                            </form>

                        </div>
                    </div>
                </div>
            </div>
            <!-- End:: row-2 -->

        </div>
    </div>
@endsection

@push('scripts')
    <!-- Quill Editor JS -->
    <script src="/assets/libs/quill/quill.min.js"></script>

    <script>
        $(function (){
            /* quill snow editor */
            var toolbarOptions = [
                [{ 'header': [1, 2, 3, 4, 5, 6, false] }],
                [{ 'font': [] }],
                ['bold', 'italic', 'underline', 'strike'],        // toggled buttons
                ['blockquote', 'code-block'],

                [{ 'header': 1 }, { 'header': 2 }],               // custom button values
                [{ 'list': 'ordered' }, { 'list': 'bullet' }],
                [{ 'script': 'sub' }, { 'script': 'super' }],      // superscript/subscript
                [{ 'indent': '-1' }, { 'indent': '+1' }],          // outdent/indent
                [{ 'direction': 'rtl' }],                         // text direction

                [{ 'size': ['small', false, 'large', 'huge'] }],  // custom dropdown

                [{ 'color': [] }, { 'background': [] }],          // dropdown with defaults from theme
                [{ 'align': [] }],

                ['image', 'video'],
                ['clean']                                         // remove formatting button
            ];
            var quill = new Quill('#editor', {
                modules: {
                    toolbar: toolbarOptions
                },
                theme: 'snow'
            });

            $("#identifier").on("submit",function() {
                $("#hiddenArea").val($("#editor").find('.ql-editor').html());
            })
        });
    </script>
@endpush
