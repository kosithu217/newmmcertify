@extends('admin.layouts.master')

@section('title')
    Admin : Add Certificate
@endsection

@section('css')
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.3/dropzone.min.css" rel="stylesheet">
    <style>
        :root {
            --primary-color: #4e73df;
            --secondary-color: #f8f9fc;
            --success-color: #1cc88a;
            --border-radius: 0.35rem;
            --box-shadow: 0 0.15rem 1.75rem 0 rgba(58, 59, 69, 0.15);
        }
        
        .card {
            border: none;
            border-radius: var(--border-radius);
            box-shadow: var(--box-shadow);
            margin-bottom: 2rem;
        }
        
        .card-header {
            background: linear-gradient(45deg, var(--primary-color), #224abe);
            border-radius: var(--border-radius) var(--border-radius) 0 0 !important;
        }
        
        .form-control, .form-select {
            border-radius: var(--border-radius);
            padding: 0.75rem 1rem;
            border: 1px solid #d1d3e2;
            transition: all 0.3s;
        }
        
        .form-control:focus, .form-select:focus {
            border-color: #bac8f3;
            box-shadow: 0 0 0 0.2rem rgba(78, 115, 223, 0.25);
        }
        
        .file-upload-container {
            margin-bottom: 1.5rem;
        }
        
        .file-upload-box {
            border: 2px dashed #d1d3e2;
            border-radius: var(--border-radius);
            padding: 2rem;
            text-align: center;
            background-color: var(--secondary-color);
            transition: all 0.3s;
            cursor: pointer;
        }
        
        .file-upload-box:hover {
            border-color: var(--primary-color);
            background-color: rgba(78, 115, 223, 0.05);
        }
        
        .file-upload-box i {
            font-size: 2.5rem;
            color: var(--primary-color);
            margin-bottom: 1rem;
        }
        
        .preview-container {
            margin-top: 1.5rem;
            display: flex;
            flex-wrap: wrap;
            gap: 1rem;
        }
        
        .preview-item {
            position: relative;
            width: 150px;
            height: 150px;
            border-radius: var(--border-radius);
            overflow: hidden;
            box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075);
        }
        
        .preview-item img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }
        
        .remove-btn {
            position: absolute;
            top: 5px;
            right: 5px;
            background: rgba(255, 0, 0, 0.7);
            color: white;
            border: none;
            border-radius: 50%;
            width: 25px;
            height: 25px;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
        }
        
        .btn-submit {
            background: linear-gradient(45deg, var(--primary-color), #224abe);
            border: none;
            padding: 0.75rem 2rem;
            font-weight: 600;
            transition: all 0.3s;
        }
        
        .btn-submit:hover {
            transform: translateY(-2px);
            box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15);
        }
        
        .section-title {
            color: var(--primary-color);
            font-weight: 600;
            margin: 2rem 0 1rem;
            padding-bottom: 0.5rem;
            border-bottom: 2px solid var(--secondary-color);
        }
    </style>
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

                                <form method="POST" action="{{ url('/user/certificate/upload') }}" enctype="multipart/form-data">

                                    @csrf

                                    <div class="row g-4">
                                        <div class="col-12">
                                            <h5 class="section-title">Institution Information</h5>
                                            <div class="mb-4">
                                                <label for="title" class="form-label fw-bold">Academic or Business Institution Name</label>
                                                <input type="text" name="name" class="form-control form-control-lg" id="title"
                                                    placeholder="Provide Academic Institution Name"
                                                    value="{{ Auth::user()->name }}" required readonly>
                                                <div class="form-text">This field is auto-filled and cannot be changed.</div>
                                            </div>
                                        </div>


<!--  <div class="col-12">-->
<!--    <label for="logo" class="form-label">Logo</label>-->

    <!-- Display Existing or Default Logo -->
<!--    <img id="logoPreview" -->
<!--         src="{{ asset($certificate->logo ?? 'storage/certificates/logos/default.png') }}" -->
<!--         alt="Certificate Logo" -->
<!--         width="150" height="150" -->
<!--         style="display: block; margin-bottom: 10px;">-->

    <!-- File Input for New Logo -->
<!--    <input type="file" name="logo" id="logo" accept="image/png" style="padding: 10px;"-->
<!--           onchange="previewLogo(event)">-->
<!--</div>-->

<div class="col-12">
    <h5 class="section-title">Institution Logo</h5>
    <div class="file-upload-container">
        <div class="text-center mb-3">
            <div class="logo-preview-container mx-auto" style="width: 150px; height: 150px; border-radius: 50%; overflow: hidden; border: 3px solid #e3e6f0;">
                <img id="logoPreview" 
                     src="{{ optional($certificate)->logo ? asset($certificate->logo) : 'https://cdn-icons-png.flaticon.com/512/9299/9299585.png' }}" 
                     alt="Institution Logo" 
                     class="img-fluid h-100 w-100"
                     style="object-fit: cover;">
            </div>
        </div>
        <div class="file-upload-box" onclick="document.getElementById('logo').click()">
            <i class="fas fa-cloud-upload-alt"></i>
            <h5>Click to upload logo</h5>
            <p class="text-muted">PNG format only (Max 2MB)</p>
            <input type="file" name="logo" id="logo" class="d-none" accept="image/png" onchange="previewLogo(event)">
        </div>
    </div>
</div>



                                        <div class="col-12">
                                            <h5 class="section-title">Certificate Images</h5>
                                            <div class="row g-4">
                                                <!-- Front Side Upload -->
                                                <div class="col-md-6">
                                                    <div class="card h-100">
                                                        <div class="card-body text-center">
                                                            <h6 class="card-title mb-3">Front Side of Certificate</h6>
                                                            
                                                            <!-- Preview Container -->
                                                            <div id="front-preview-container" class="mb-3" style="display: none;">
                                                                <div class="preview-wrapper position-relative mx-auto" style="max-width: 100%; border: 2px dashed #e3e6f0; border-radius: 0.5rem; overflow: hidden;">
                                                                    <img id="front-certificate-preview" src="#" alt="Front Side Preview" class="img-fluid d-block mx-auto" style="max-height: 300px; width: auto;">
                                                                    <button type="button" class="btn btn-sm btn-danger position-absolute top-0 end-0 m-2" onclick="removeCertificatePreview('front')">
                                                                        <i class="fas fa-times"></i>
                                                                    </button>
                                                                </div>
                                                            </div>
                                                            
                                                            <!-- Upload Box (shown when no image) -->
                                                            <div id="front-upload-box" class="file-upload-box" onclick="document.getElementById('image').click()">
                                                                <i class="fas fa-file-image fa-2x mb-2"></i>
                                                                <h6 id="image-label">Click to upload front side</h6>
                                                                <p class="text-muted small mb-0">PNG format (Max 2MB)</p>
                                                                <input type="file" name="image" id="image" class="d-none" required 
                                                                    accept="image/png" onchange="previewCertificateImage(this, 'front')">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                
                                                <!-- Back Side Upload -->
                                                <div class="col-md-6">
                                                    <div class="card h-100">
                                                        <div class="card-body text-center">
                                                            <h6 class="card-title mb-3">Back Side of Certificate</h6>
                                                            
                                                            <!-- Preview Container -->
                                                            <div id="back-preview-container" class="mb-3" style="display: none;">
                                                                <div class="preview-wrapper position-relative mx-auto" style="max-width: 100%; border: 2px dashed #e3e6f0; border-radius: 0.5rem; overflow: hidden;">
                                                                    <img id="back-certificate-preview" src="#" alt="Back Side Preview" class="img-fluid d-block mx-auto" style="max-height: 300px; width: auto;">
                                                                    <button type="button" class="btn btn-sm btn-danger position-absolute top-0 end-0 m-2" onclick="removeCertificatePreview('back')">
                                                                        <i class="fas fa-times"></i>
                                                                    </button>
                                                                </div>
                                                            </div>
                                                            
                                                            <!-- Upload Box (shown when no image) -->
                                                            <div id="back-upload-box" class="file-upload-box" onclick="document.getElementById('image_two').click()">
                                                                <i class="fas fa-file-image fa-2x mb-2"></i>
                                                                <h6 id="image_two-label">Click to upload back side</h6>
                                                                <p class="text-muted small mb-0">PNG format (Max 2MB)</p>
                                                                <input type="file" name="image_two" id="image_two" class="d-none"  
                                                                    accept="image/png" onchange="previewCertificateImage(this, 'back')">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <script>
                                            function previewCertificateImage(input, side) {
                                                const previewContainer = document.getElementById(`${side}-preview-container`);
                                                const uploadBox = document.getElementById(`${side}-upload-box`);
                                                const previewImg = document.getElementById(`${side}-certificate-preview`);
                                                const label = document.getElementById(`${side === 'front' ? 'image' : 'image_two'}-label`);
                                                
                                                if (input.files && input.files[0]) {
                                                    const file = input.files[0];
                                                    
                                                    // Check file type
                                                    if (!file.type.match('image/png')) {
                                                        alert('Please select a PNG image file');
                                                        input.value = '';
                                                        return;
                                                    }
                                                    
                                                    // Check file size (2MB max)
                                                    if (file.size > 2 * 1024 * 1024) {
                                                        alert('Image size should not exceed 2MB');
                                                        input.value = '';
                                                        return;
                                                    }
                                                    
                                                    const reader = new FileReader();
                                                    
                                                    reader.onload = function(e) {
                                                        previewImg.onload = function() {
                                                            // Once image is loaded, show the preview
                                                            previewContainer.style.display = 'block';
                                                            uploadBox.style.display = 'none';
                                                            label.textContent = file.name;
                                                        };
                                                        previewImg.src = e.target.result;
                                                    }
                                                    
                                                    reader.onerror = function() {
                                                        alert('Error reading the file');
                                                        input.value = '';
                                                    };
                                                    
                                                    reader.readAsDataURL(file);
                                                }
                                            }
                                            
                                            function removeCertificatePreview(side) {
                                                const input = document.getElementById(side === 'front' ? 'image' : 'image_two');
                                                const previewContainer = document.getElementById(`${side}-preview-container`);
                                                const uploadBox = document.getElementById(`${side}-upload-box`);
                                                const label = document.getElementById(`${side === 'front' ? 'image' : 'image_two'}-label`);
                                                
                                                if (!input || !previewContainer || !uploadBox || !label) {
                                                    console.error('Error: Could not find required elements');
                                                    return;
                                                }
                                                
                                                // Reset the file input
                                                input.value = '';
                                                
                                                // Reset the preview
                                                previewContainer.style.display = 'none';
                                                uploadBox.style.display = 'block';
                                                
                                                // Reset the label text
                                                label.textContent = `Click to upload ${side} side`;
                                                
                                                // Reset the preview image source
                                                const previewImg = document.getElementById(`${side}-certificate-preview`);
                                                if (previewImg) {
                                                    previewImg.src = '#';
                                                }
                                            }
                                            
                                            // Make functions globally available
                                            window.previewCertificateImage = previewCertificateImage;
                                            window.removeCertificatePreview = removeCertificatePreview;
                                        </script>

                                        <script>
                                            function updateFileName(input, labelId) {
                                                const label = document.getElementById(labelId);
                                                if (input.files.length > 0) {
                                                    label.textContent = input.files[0].name;
                                                    label.classList.add('has-file');
                                                } else {
                                                    label.textContent = 'Choose file';
                                                    label.classList.remove('has-file');
                                                }
                                            }
                                        </script>






                                        <div class="col-12">
                                            <h5 class="section-title">Additional Documents</h5>
                                            <div class="card">
                                                <div class="card-body">
                                                    <label for="attachments" class="form-label fw-bold">Transcript or Grade Record (if applicable)</label>
                                                    <p class="text-muted small mb-3">You can upload multiple files (PNG, JPG, JPEG)</p>
                                                    <div class="file-upload-box" onclick="document.getElementById('attachments').click()">
                                                        <i class="fas fa-file-upload"></i>
                                                        <h6 id="attachments-label">Click to upload documents</h6>
                                                        <p class="text-muted small mb-0">Drag & drop files here or click to browse</p>
                                                        <input type="file" class="d-none" id="attachments" name="attachments[]" 
                                                            multiple accept=".png, .jpg, .jpeg" 
                                                            onchange="handleMultipleFiles(this, 'attachments-preview', 'attachments-label')">
                                                    </div>
                                                    <div id="attachments-preview" class="preview-container mt-3"></div>
                                                    @error('attachments.*')
                                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-12">
                                            <h5 class="section-title">Certificate Details</h5>
                                            <div class="card mb-4">
                                                <div class="card-body">
                                                    <!-- TinyMCE -->
                                                    <script src="https://cdn.tiny.cloud/1/no-api-key/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>
                                                    
                                                    <div class="mb-4">
                                                        <label for="textdesc" class="form-label fw-bold">Certificate Description</label>
                                                        <textarea id="textdesc" required placeholder="Provide a brief description of the certificate..." 
                                                            name="description" class="form-control" rows="4">{!! $certificate ? $certificate->description : '' !!}</textarea>
                                                        <!-- <div class="form-text">Briefly describe what this certificate represents</div> -->
                                                    </div>

                                                    <div class="mb-4">
                                                        <label for="textoutline" class="form-label fw-bold">Course Outlines, Learning Outcomes, etc.</label>
                                                        <!-- <p class="text-muted small mb-2">For internship certificates, please include job roles and responsibilities</p> -->
                                                        <textarea id="textoutline" required 
                                                            placeholder="Provide detailed course outlines, learning outcomes, or job responsibilities..." 
                                                            name="course_outline" class="form-control" rows="8">{!! $certificate ? $certificate->course_outline : '' !!}</textarea>
                                                    </div>

                                                    <script>
                                                    tinymce.init({
                                                        selector: '#textdesc, #textoutline',
                                                        plugins: 'advlist autolink lists link image charmap print preview anchor',
                                                        toolbar: 'undo redo | formatselect | fontselect | fontsizeselect | bold italic backcolor | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | removeformat',
                                                        menubar: false,
                                                        height: 300,
                                                        content_style: 'body { font-family:Helvetica,Arial,sans-serif; font-size: 9px !important; }',
                                                        font_size_formats: '9px 10px 12px 14px 16px 18px 20px 24px 30px 36px 48px',
                                                        setup: function(editor) {
                                                            editor.on('init', function() {
                                                                this.getBody().style.fontSize = '9px';
                                                            });
                                                        }
                                                    });
                                                    </script>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        

                                    </div>

                                    <div class="d-grid gap-2 d-md-flex justify-content-md-end mt-4">
                                        <button type="reset" class="btn btn-outline-secondary me-md-2 px-4">
                                            <i class="fas fa-undo me-2"></i>Reset
                                        </button>
                                        <button type="submit" name="submit" class="btn btn-primary btn-submit px-4">
                                            <i class="fas fa-paper-plane me-2"></i>Submit Certificate
                                        </button>
                                    </div>
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
