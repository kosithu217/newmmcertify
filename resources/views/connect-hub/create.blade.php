<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add New Institute - Connect Hub</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"> 
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
</head>
<body>
    @include('nav')

    <!-- Hero Header -->
    <div class="hero-header">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-8">
                    <h2 class="text-white mb-2"><i class="fas fa-plus-circle me-2"></i>Add New Institute</h2>
                    <p class="text-white-50 mb-0">Share your institute information with the community</p>
                </div>
                <div class="col-md-4 text-md-end">
                    <a href="{{ route('connect-hub') }}" class="btn btn-light">
                        <i class="fas fa-arrow-left me-2"></i>Back to List
                    </a>
                </div>
            </div>
        </div>
    </div>

    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show shadow-sm" role="alert">
                        <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif

                @if(session('error'))
                    <div class="alert alert-danger alert-dismissible fade show shadow-sm" role="alert">
                        <i class="fas fa-exclamation-circle me-2"></i>{{ session('error') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif

                @if($errors->any())
                    <div class="alert alert-danger alert-dismissible fade show shadow-sm" role="alert">
                        <strong>Please fix the following errors:</strong>
                        <ul class="mb-0 mt-2">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif
                    
                <form action="{{ route('connect-hub.store') }}" method="POST" enctype="multipart/form-data" id="instituteForm">
                    @csrf
                    
                    <!-- Institute Information -->
                    <div class="form-card mb-4">
                        <div class="form-card-header">
                            <i class="fas fa-building me-2"></i>Institute Information
                        </div>
                        <div class="form-card-body">
                            <div class="row g-3">
                                <div class="col-md-8">
                                    <label for="institute_name" class="form-label">Institute Name <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control form-control-modern" id="institute_name" name="institute_name" placeholder="Enter institute name" value="{{ old('institute_name') }}" required>
                                </div>
                                <div class="col-md-4 d-flex align-items-end">
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" type="checkbox" id="is_verified" name="is_verified" {{ old('is_verified') ? 'checked' : '' }}>
                                        <label class="form-check-label" for="is_verified">
                                            <i class="fas fa-check-circle text-success me-1"></i>MMCertify Verified
                                        </label>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <label for="country" class="form-label">Location (State/Region) <span class="text-danger">*</span></label>
                                    <select class="form-select form-control-modern" id="country" name="country" required>
                                        <option value="">Select State/Region</option>
                                        <option value="Yangon">Yangon</option>
                                        <option value="Mandalay">Mandalay</option>
                                        <option value="Naypyidaw">Naypyidaw</option>
                                        <option value="Bago">Bago</option>
                                        <option value="Ayeyarwady">Ayeyarwady</option>
                                        <option value="Magway">Magway</option>
                                        <option value="Sagaing">Sagaing</option>
                                        <option value="Tanintharyi">Tanintharyi</option>
                                        <option value="Mon">Mon</option>
                                        <option value="Kayin">Kayin</option>
                                        <option value="Kayah">Kayah</option>
                                        <option value="Shan">Shan</option>
                                        <option value="Kachin">Kachin</option>
                                        <option value="Chin">Chin</option>
                                        <option value="Rakhine">Rakhine</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Short Overview -->
                    <div class="form-card mb-4">
                        <div class="form-card-header">
                            <i class="fas fa-align-left me-2"></i>Short Overview / Profile
                        </div>
                        <div class="form-card-body">
                            <label for="overview" class="form-label">Describe your institute <span class="text-danger">*</span></label>
                            <textarea class="form-control form-control-modern" id="overview" name="overview" rows="4" placeholder="Describe your overview, mission, and education focus" required>{{ old('overview') }}</textarea>
                            <small class="text-muted">Tell us about your institute's mission and what makes it unique</small>
                        </div>
                    </div>

                    <!-- Offered Courses -->
                    <div class="form-card mb-4">
                        <div class="form-card-header d-flex justify-content-between align-items-center">
                            <span><i class="fas fa-book me-2"></i>Offered Courses</span>
                            <button type="button" class="btn btn-sm btn-add" id="addCourse">
                                <i class="fas fa-plus me-1"></i>Add Course
                            </button>
                        </div>
                        <div class="form-card-body">
                            <div id="coursesContainer">
                                <div class="row g-3 mb-3 course-row">
                                    <div class="col-md-6">
                                        <input type="text" class="form-control form-control-modern" name="courses[0][name]" placeholder="Course Name" required>
                                    </div>
                                    <div class="col-md-5">
                                        <input type="text" class="form-control form-control-modern" name="courses[0][duration]" placeholder="Duration (e.g., 3 months)" required>
                                    </div>
                                    <div class="col-md-1 d-flex align-items-center">
                                        <button type="button" class="btn btn-sm btn-outline-danger remove-course w-100" disabled style="display: none;">
                                            <i class="fas fa-times"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Certificate Showcase -->
                    <div class="form-card mb-4">
                        <div class="form-card-header">
                            <i class="fas fa-certificate me-2"></i>Certificate Showcase
                        </div>
                        <div class="form-card-body">
                            <div class="upload-area text-center" id="certificateUploadArea">
                                <input type="file" id="certificate" name="certificate" class="d-none" accept="image/*,application/pdf">
                                <label for="certificate" class="upload-label">
                                    <i class="fas fa-cloud-upload-alt fa-3x text-primary mb-3"></i>
                                    <h6>Upload Certificate Image</h6>
                                    <p class="text-muted small mb-0">Drag & drop or click to browse</p>
                                    <p class="text-muted small">Supported: JPG, PNG, PDF (Max 2MB)</p>
                                </label>
                                <div id="certificatePreview" class="mt-3" style="display: none;">
                                    <img id="certificateImg" src="" alt="Certificate Preview" class="preview-img">
                                    <p class="text-success mt-2"><i class="fas fa-check-circle"></i> <span id="certificateName"></span></p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Job Opportunities -->
                    <div class="form-card mb-4">
                        <div class="form-card-header d-flex justify-content-between align-items-center">
                            <span><i class="fas fa-briefcase me-2"></i>Job Opportunities <small class="text-muted">(Optional)</small></span>
                            <button type="button" class="btn btn-sm btn-add" id="addJob">
                                <i class="fas fa-plus me-1"></i>Add Job
                            </button>
                        </div>
                        <div class="form-card-body">
                            <div id="jobsContainer">
                                <div class="input-group mb-2 job-row">
                                    <span class="input-group-text"><i class="fas fa-briefcase"></i></span>
                                    <input type="text" class="form-control form-control-modern" name="jobs[]" placeholder="e.g., Junior Data Analyst">
                                    <button class="btn btn-outline-danger remove-job" type="button" disabled style="display: none;">
                                        <i class="fas fa-times"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Contact Information -->
                    <div class="form-card mb-4">
                        <div class="form-card-header">
                            <i class="fas fa-address-book me-2"></i>Contact Information
                        </div>
                        <div class="form-card-body">
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <label for="website" class="form-label">Website</label>
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="fas fa-globe"></i></span>
                                        <input type="url" class="form-control form-control-modern" id="website" name="website" placeholder="https://example.com" value="{{ old('website') }}">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <label for="phone" class="form-label">Phone</label>
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="fas fa-phone"></i></span>
                                        <input type="tel" class="form-control form-control-modern" id="phone" name="phone" placeholder="+95 9 123 456 789" value="{{ old('phone') }}">
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <label for="email" class="form-label">Email</label>
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                                        <input type="email" class="form-control form-control-modern" id="email" name="email" placeholder="info@example.com" value="{{ old('email') }}">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Image Gallery -->
                    <div class="form-card mb-4">
                        <div class="form-card-header">
                            <i class="fas fa-images me-2"></i>Image Gallery
                        </div>
                        <div class="form-card-body">
                            <div class="upload-area text-center" id="galleryUploadArea">
                                <input type="file" id="gallery" name="gallery[]" class="d-none" multiple accept="image/*">
                                <label for="gallery" class="upload-label">
                                    <i class="fas fa-images fa-3x text-primary mb-3"></i>
                                    <h6>Upload Gallery Images</h6>
                                    <p class="text-muted small mb-0">Drag & drop or click to browse</p>
                                    <p class="text-muted small">Upload up to 6 images (JPG, PNG - Max 2MB each)</p>
                                </label>
                                <div id="galleryPreview" class="mt-3 row g-2" style="display: none;"></div>
                            </div>
                        </div>
                    </div>

                    <!-- Form Actions -->
                    <div class="text-center">
                        <a href="{{ route('connect-hub') }}" class="btn btn-outline-secondary btn-lg px-5 me-2">
                            <i class="fas fa-times me-2"></i>Cancel
                        </a>
                        <button type="submit" class="btn btn-primary-gradient btn-lg px-5">
                            <i class="fas fa-save me-2"></i>Save Institute
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Confirmation Modal -->
    <div class="modal fade" id="confirmModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content border-0 shadow-lg">
                <div class="modal-header bg-gradient border-0">
                    <h5 class="modal-title text-white">
                        <i class="fas fa-check-circle me-2"></i>Confirm Submission
                    </h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body p-4 text-center">
                    <i class="fas fa-question-circle text-primary mb-3" style="font-size: 4rem;"></i>
                    <h5 class="mb-3">Ready to submit?</h5>
                    <p class="text-muted">Please review all information before submitting. This will create a new institute profile.</p>
                </div>
                <div class="modal-footer border-0 justify-content-center">
                    <button type="button" class="btn btn-outline-secondary px-4" data-bs-dismiss="modal">
                        <i class="fas fa-times me-2"></i>Review Again
                    </button>
                    <button type="button" class="btn btn-primary-gradient px-4" id="confirmSubmit">
                        <i class="fas fa-check me-2"></i>Yes, Submit
                    </button>
                </div>
            </div>
        </div>
    </div>

<style>
    body {
        background: #f5f7fa;
    }

    .hero-header {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        padding: 2.5rem 0;
        margin-bottom: 2rem;
        box-shadow: 0 4px 20px rgba(0,0,0,0.1);
    }

    .form-card {
        background: white;
        border-radius: 15px;
        box-shadow: 0 2px 15px rgba(0,0,0,0.08);
        overflow: hidden;
        transition: all 0.3s ease;
    }

    .form-card:hover {
        box-shadow: 0 5px 25px rgba(0,0,0,0.12);
    }

    .form-card-header {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        padding: 1rem 1.5rem;
        font-weight: 600;
        font-size: 1.1rem;
    }

    .form-card-body {
        padding: 1.5rem;
    }

    .form-control-modern {
        border: 2px solid #e2e8f0;
        border-radius: 10px;
        padding: 0.75rem 1rem;
        transition: all 0.3s ease;
    }

    .form-control-modern:focus {
        border-color: #667eea;
        box-shadow: 0 0 0 0.2rem rgba(102, 126, 234, 0.15);
    }

    .form-select {
        border: 2px solid #e2e8f0;
        border-radius: 10px;
        padding: 0.75rem 1rem;
    }

    .upload-area {
        border: 3px dashed #cbd5e0;
        border-radius: 15px;
        padding: 2rem;
        transition: all 0.3s ease;
        background: #f8fafc;
    }

    .upload-area:hover {
        border-color: #667eea;
        background: #f0f4ff;
    }

    .upload-label {
        cursor: pointer;
        display: block;
        margin: 0;
    }

    .preview-img {
        max-height: 200px;
        border-radius: 10px;
        box-shadow: 0 4px 15px rgba(0,0,0,0.1);
    }

    .btn-add {
        background: white;
        color: #667eea;
        border: 2px solid #667eea;
        border-radius: 8px;
        font-weight: 600;
        transition: all 0.3s ease;
    }

    .btn-add:hover {
        background: #667eea;
        color: white;
    }

    .btn-primary-gradient {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        border: none;
        color: white;
        border-radius: 50px;
        font-weight: 600;
        transition: all 0.3s ease;
    }

    .btn-primary-gradient:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 25px rgba(102, 126, 234, 0.4);
    }

    .input-group-text {
        background: #f8fafc;
        border: 2px solid #e2e8f0;
        border-right: none;
        color: #667eea;
    }

    .input-group .form-control {
        border-left: none;
    }

    .bg-gradient {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    }

    .modal-content {
        border-radius: 20px;
    }

    .form-check-input:checked {
        background-color: #667eea;
        border-color: #667eea;
    }

    @media (max-width: 768px) {
        .hero-header h2 {
            font-size: 1.5rem;
        }
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Add Course
        let courseCount = 1;
        document.getElementById('addCourse').addEventListener('click', function() {
            const container = document.getElementById('coursesContainer');
            const newRow = document.createElement('div');
            newRow.className = 'row g-3 mb-3 course-row';
            newRow.innerHTML = `
                <div class="col-md-6">
                    <input type="text" class="form-control form-control-modern" name="courses[${courseCount}][name]" placeholder="Course Name" required>
                </div>
                <div class="col-md-5">
                    <input type="text" class="form-control form-control-modern" name="courses[${courseCount}][duration]" placeholder="Duration" required>
                </div>
                <div class="col-md-1 d-flex align-items-center">
                    <button type="button" class="btn btn-sm btn-outline-danger remove-course w-100">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
            `;
            container.appendChild(newRow);
            courseCount++;
            updateRemoveButtons();
        });

        // Add Job
        document.getElementById('addJob').addEventListener('click', function() {
            const container = document.getElementById('jobsContainer');
            const newJob = document.createElement('div');
            newJob.className = 'input-group mb-2 job-row';
            newJob.innerHTML = `
                <span class="input-group-text"><i class="fas fa-briefcase"></i></span>
                <input type="text" class="form-control form-control-modern" name="jobs[]" placeholder="Enter job title">
                <button class="btn btn-outline-danger remove-job" type="button">
                    <i class="fas fa-times"></i>
                </button>
            `;
            container.appendChild(newJob);
            updateRemoveButtons();
        });

        // Remove buttons functionality
        function updateRemoveButtons() {
            document.querySelectorAll('.remove-course').forEach((btn, index) => {
                btn.disabled = index === 0;
                btn.style.display = index === 0 ? 'none' : 'inline-block';
            });

            document.querySelectorAll('.remove-job').forEach((btn, index) => {
                btn.disabled = index === 0;
                btn.style.display = index === 0 ? 'none' : 'inline-block';
            });
        }

        // Event delegation for remove buttons
        document.addEventListener('click', function(e) {
            if (e.target.closest('.remove-course')) {
                const row = e.target.closest('.course-row');
                if (row && !row.querySelector('.remove-course').disabled) {
                    row.remove();
                    updateRemoveButtons();
                }
            }
            else if (e.target.closest('.remove-job')) {
                const row = e.target.closest('.job-row');
                if (row && !row.querySelector('.remove-job').disabled) {
                    row.remove();
                    updateRemoveButtons();
                }
            }
        });

        // Certificate Image Preview
        document.getElementById('certificate').addEventListener('change', function(e) {
            const file = e.target.files[0];
            if (file) {
                const preview = document.getElementById('certificatePreview');
                const img = document.getElementById('certificateImg');
                const name = document.getElementById('certificateName');
                
                if (file.type.startsWith('image/')) {
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        img.src = e.target.result;
                        name.textContent = file.name;
                        preview.style.display = 'block';
                    };
                    reader.readAsDataURL(file);
                } else {
                    img.src = 'https://via.placeholder.com/200x150?text=PDF+File';
                    name.textContent = file.name;
                    preview.style.display = 'block';
                }
            }
        });

        // Gallery Images Preview
        document.getElementById('gallery').addEventListener('change', function(e) {
            const files = e.target.files;
            const preview = document.getElementById('galleryPreview');
            preview.innerHTML = '';
            
            if (files.length > 0) {
                if (files.length > 6) {
                    alert('Maximum 6 images allowed!');
                    e.target.value = '';
                    return;
                }
                
                preview.style.display = 'flex';
                Array.from(files).forEach((file, index) => {
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        const col = document.createElement('div');
                        col.className = 'col-4 col-md-2';
                        col.innerHTML = `
                            <div class="position-relative">
                                <img src="${e.target.result}" class="img-fluid rounded shadow-sm" style="height: 100px; object-fit: cover; width: 100%;">
                                <span class="badge bg-success position-absolute top-0 end-0 m-1">${index + 1}</span>
                            </div>
                        `;
                        preview.appendChild(col);
                    };
                    reader.readAsDataURL(file);
                });
            }
        });

        // Form submission with modal confirmation
        const form = document.getElementById('instituteForm');
        const confirmModal = new bootstrap.Modal(document.getElementById('confirmModal'));
        
        form.addEventListener('submit', function(e) {
            e.preventDefault();
            confirmModal.show();
        });

        document.getElementById('confirmSubmit').addEventListener('click', function() {
            confirmModal.hide();
            form.submit();
        });

        // Initialize remove buttons state
        updateRemoveButtons();
    });
</script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
