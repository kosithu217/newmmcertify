@extends('admin.layouts.master')

@section('title')
    Admin : Edit Certificate
@endsection

@section('css')
    <!--<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">-->
@endsection

@section('content')
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                
                @session('error')
                    <p class="text-center text-white bg-danger py-3 mb-5">{{ session('error') }}</p>
                @endsession

                <div class="card my-4">
                    <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                        <div class="bg-gradient-info shadow-primary border-radius-lg pt-4 pb-3">
                            <h6 class="text-white text-capitalize ps-3">
                                Add Certificate ( {{ count(Auth::user()->certificates) }} / {{ Auth::user()->cert_limit }} )
                                <a href="{{ url('/user/certificates') }}" class="btn btn-warning float-end me-4">Back</a>
                            </h6>
                        </div>
                    </div>
                    <div class="card-body px-3 pb-2">

                        <div class="row">


                            <div class="col-12">

                                <form method="POST" action="{{ url('/user/certificate/update') }}" enctype="multipart/form-data">

                                    @csrf
                                    
                                    <input name="id" type="hidden" value="{{ $certificate->id }}" />
                                    
                                    <div class="row g-3">
                                        <div class="col-12">
                                            <label for="title" class="form-label">Academic or Business Institution Name</label>
                                            <input type="text" name="name" class="form-control" id="title"
                                                placeholder="Provide Academic Institution Name" value="{{ $certificate->name }}" required
                                                style="padding: 10px;background: #4c3838; color: #fff;" readonly>
                                        </div>

                                        <div class="col-12">
                                            <span class="text-warning">* Leave if not change</span><br>
                                            <label for="image" class="form-label">Logo ( PNG format only )</label>
                                            <input type="file" name="logo" class="" id="logo"
                                                value="" style="padding: 10px;" accept="image/png">
                                        </div>

                                        <div class="col-12">
                                            <span class="text-warning">* Leave if not change</span><br>
                                            <label for="image" class="form-label">Certificate Image ( PNG format only )</label>
                                            <input type="file" name="image" class="" id="image"
                                                value="" style="padding: 10px;" accept="image/png">
                                            <br><span class="text-success" style="font-size: 0.8em; font-weight: bolder;">PNG file with a maximum size of 2 MB.</span>
                                        </div>

                                        <div class="col-12">
                                            <span class="text-warning">* Leave if not change</span><br>
                                            <label for="attachments" class="form-label">Transcript (or) Grade record ( if applicable )</label>
                                            <input type="file" class="" id="attachments" name="attachments[]" multiple accept=".png, .jpg, .jpeg">
                                            @error('attachments.*')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="col-12">
                                            <label for="title" class="form-label">Certificate Description</label>

                                            <textarea id="textdesc" required placeholder="Enter Certificate Description" name="description" class="form-control"
                                                style="padding: 10px;background: #4c3838;color: #fff;" rows="3">{{ $certificate->description }}</textarea>
                                        </div>

                                        
                                        <div class="col-12">
                                            <label for="" class="form-label">Provide the course outlines, learning outcomes and your academic or business brief description. For the internship certificate, please provide job roles and responsibilities.</label>
                                            <textarea id="textoutline" required placeholder="Provide The Course Outline" name="course_outline" rows="10">{{ $certificate->course_outline }}</textarea>
                                        </div>
                                        

                                    </div>

                                    <br><br>
                                    <input class="w-100 btn btn-info btn-lg" name="submit" type="submit"
                                        value="Update" />
                                </form>
                            </div>

                        </div>

                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection

@section('js')
    <script src="https://cdn.tiny.cloud/1/jm3py9bawzkdoqpdsoj9mllph18h64y9b2wknn7mrj7bdk04/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>
    <script>
        tinymce.init({
            selector: '#textdesc',
            plugins: 'advlist autolink lists link image charmap preview anchor searchreplace visualblocks code fullscreen insertdatetime media table paste code help wordcount',
            // plugins: [
            //   'advlist', 'autolink', 'link', 'image', 'lists', 'charmap', 'preview', 'anchor', 'pagebreak',
            //   'searchreplace', 'wordcount', 'visualblocks', 'visualchars', 'code', 'fullscreen', 'insertdatetime',
            //   'media', 'table', 'emoticons', 'help'
            // ],
            // toolbar: 'undo redo | formatselect | bold italic forecolor | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | removeformat | help',
            toolbar: 'undo redo | styles | bold italic forecolor | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent',
            menubar: false, // Hide the menu bar
            // content_css: 'dark', // Dark mode for the editor
            content_css: 'css/content.css',
            height: 300, // Set height of the editor
            formats: {
                // Custom heading tags formatting
                h1: { block: 'h1', attributes: {}, styles: {} },
                h2: { block: 'h2', attributes: {}, styles: {} },
                h3: { block: 'h3', attributes: {}, styles: {} }
            },
            style_formats: [
                { title: 'Bold text', inline: 'b' },
                { title: 'Italic text', inline: 'i' },
                { title: 'Underline text', inline: 'u' },
                { title: 'Heading 1', block: 'h1' },
                { title: 'Heading 2', block: 'h2' },
                { title: 'Heading 3', block: 'h3' },
                { title: 'Paragraph', block: 'p' },
            ],
            setup: function (editor) {
                
                editor.on('change', function () {
                    editor.save(); // Synchronizes content with the textarea
                });
            }
        });
        
        tinymce.init({
            selector: '#textoutline',
            plugins: 'advlist autolink lists link image charmap preview anchor searchreplace visualblocks code fullscreen insertdatetime media table paste code help wordcount',
            // plugins: [
            //   'advlist', 'autolink', 'link', 'image', 'lists', 'charmap', 'preview', 'anchor', 'pagebreak',
            //   'searchreplace', 'wordcount', 'visualblocks', 'visualchars', 'code', 'fullscreen', 'insertdatetime',
            //   'media', 'table', 'emoticons', 'help'
            // ],
            // toolbar: 'undo redo | formatselect | bold italic forecolor | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | removeformat | help',
            toolbar: 'undo redo | styles | bold italic forecolor | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent',
            menubar: false, // Hide the menu bar
            // content_css: 'dark', // Dark mode for the editor
            content_css: 'css/content.css',
            height: 300, // Set height of the editor
            formats: {
                // Custom heading tags formatting
                h1: { block: 'h1', attributes: {}, styles: {} },
                h2: { block: 'h2', attributes: {}, styles: {} },
                h3: { block: 'h3', attributes: {}, styles: {} }
            },
            style_formats: [
                { title: 'Bold text', inline: 'b' },
                { title: 'Italic text', inline: 'i' },
                { title: 'Underline text', inline: 'u' },
                { title: 'Heading 1', block: 'h1' },
                { title: 'Heading 2', block: 'h2' },
                { title: 'Heading 3', block: 'h3' },
                { title: 'Paragraph', block: 'p' },
            ],
            setup: function (editor) {
                
                editor.on('change', function () {
                    editor.save(); // Synchronizes content with the textarea
                });
            }
        });
    </script>
@endsection
