@extends(Auth::user()->hasRole('user') ? 'admin.layouts.master' : 'admin.layouts.admin_master')

@section('title')
    Admin : Certificates Detail
@endsection

@section('content')
<style>
    .colorssss {
        width: 215px !important;
        height: 97px !important;
    }
    .ccb {
        height: 85px !important;
        width: 128px !important;
    }
</style>

<div class="container mt-4">
    <div class="row">
        <!-- Main Certificate Column -->
        <div class="col-md-8 col-12">
            <!-- Certificate Header -->
            <div class="d-flex align-items-center mb-4">
                <img src="{{ asset($certificate->logo) }}" style="height: 80px; width: auto;" alt="Organization Logo">
                <h2 class="ms-3 mb-0" style="font-weight: 600; color: #2c3e50;">{{ $certificate->name }}</h2>
            </div>
            
            <!-- Certificate Description -->
            <div class="card mb-4 p-3 shadow-sm">
                {!! $certificate->description !!}
            </div>
            
            <!-- Certificate with Drag-Drop and Crop Area -->
            <div id="certificate-area" class="position-relative text-center p-3" 
                 style="border: 2px dashed #ccc; background: #f9f9f9; border-radius: 10px; overflow: hidden;">
                
                <!-- Certificate Background -->
                <img id="certificateImage" 
                    src="{{ asset($certificate->certificate_logo ?? $certificate->certificate) }}" 
                    class="img-fluid border rounded shadow" 
                    style="max-width: 100%; pointer-events: none; user-select: none;">

                @if(!empty($certificate->image_two))
                <!-- Second Certificate Image -->
                <div class="mt-4">
                    <h6 class="text-center mb-3">Back Side of Certificate</h6>
                    <div class="border rounded p-2" style="background: #f8f9fa;">
                        <img src="{{ asset($certificate->image_two) }}" 
                             class="img-fluid w-100" 
                             alt="Back Side of Certificate"
                             style="max-height: 70vh; object-fit: contain;">
                    </div>
                </div>
                @endif

                <!-- Dropped QR -->
                <div id="qrContainer" class="position-absolute" style="display: none;">
                    <img id="qrCode" 
                         src="{{ asset($certificate->qrcode) }}" 
                         class="position-absolute" 
                         style="cursor: move;">
                    <div class="resize-handle" style="position: absolute; width: 10px; height: 10px; background: #6B3FA0; right: -5px; bottom: -5px; cursor: nwse-resize;"></div>
                    <!-- Cropping Interface (overlays QR code) -->
                    <div id="cropInterface" style="display: none; position: absolute;">
                        <div id="cropOverlay" class="colorssss" style="position: absolute; background: rgba(0, 0, 0, 0.5); left: 0px; top: 0px; clip-path: polygon(0% 0%, 0% 100%, 20px 100%, 20px 8px, 180px 8px, 180px 72px, 20px 72px, 20px 100%, 100% 100%, 100% 0%);"></div>
                        <div id="cropBox" class="ccb" style="position: absolute; border: 2px dashed white; cursor: move; background: rgba(255,255,255,0.2);">
                            <div class="crop-handle top-left" style="position: absolute; width: 10px; height: 10px; background: #fff; left: -5px; top: -5px; cursor: nwse-resize;"></div>
                            <div class="crop-handle top-right" style="position: absolute; width: 10px; height: 10px; background: #fff; right: -5px; top: -5px; cursor: nesw-resize;"></div>
                            <div class="crop-handle bottom-left" style="position: absolute; width: 10px; height: 10px; background: #fff; left: -5px; bottom: -5px; cursor: nesw-resize;"></div>
                            <div class="crop-handle bottom-right" style="position: absolute; width: 10px; height: 10px; background: #fff; right: -5px; bottom: -5px; cursor: nwse-resize;"></div>
                        </div>
                        <div class="mt-2 text-center" style="margin-top: -194px !important; margin-left: 173px !important;">
                            <button id="applyCrop" class="btn btn-sm btn-success me-2">
                                <i class="material-icons">check</i> Apply Crop
                            </button>
                            <button id="cancelCrop" class="btn btn-sm btn-danger">
                                <i class="material-icons">close</i> Cancel
                            </button>
                        </div>
                    </div>
                </div>
            </div>
          
            <!-- Action Buttons -->
            <div class="text-center mt-4">
                <button class="btn btn-success d-inline-flex align-items-center me-2" id="downloadBtn">
                    <i class="material-icons me-2">download</i> Download Certificate with QR
                </button>
                <button class="btn btn-outline-secondary" id="resetBtn">
                    <i class="material-icons me-2">refresh</i> Reset QR Position
                </button>
            </div>

            <!-- Course Outline -->
            <div class="card mb-4 p-3 shadow-sm mt-5">
                <h5 class="card-title mb-3" style="color: #6B3FA0;">Course Outline</h5>
                {!! $certificate->course_outline !!}
            </div>

            <!-- Attachments -->
            @if($certificate->attachments)
            <div class="card mb-4 p-3 shadow-sm">
                <h5 class="card-title mb-3" style="color: #6B3FA0;">Transcripts / Grade Records</h5>
                <div class="d-flex flex-wrap gap-3">
                    @foreach (unserialize($certificate->attachments) as $key => $attach)
                    <div class="d-flex align-items-center bg-light rounded-pill px-3 py-2">
                        <span class="badge bg-dark me-2">{{ $key+1 }}</span>
                        <a href="{{ asset($attach) }}" target="_blank" class="text-decoration-none">
                            <i class="material-icons text-primary me-2">visibility</i>
                            View Document
                        </a>
                    </div>
                    @endforeach
                </div>
            </div>
            @endif
        </div>

        <!-- Drag QR Side - Fixed Position -->
        <div class="col-md-4 col-12 mt-4 mt-md-0" style="position: relative;">
            <div class="card shadow-sm p-3 text-center" style="position: fixed; width: 28%; max-width: 320px; top: 20px; right: 15px; z-index: 1000; max-height: 95vh; overflow-y: auto;">
                <h5 style="color: #6B3FA0; position: sticky; top: 0; background: white; padding: 10px 0; margin: -16px -16px 16px -16px; z-index: 1001; ">QR Code Options</h5>
                
                <!-- Crop Mode Toggle -->
                <div class="d-flex align-items-center mb-3">
                    <div class="form-check form-switch me-3">
                        <input class="form-check-input" type="checkbox" id="cropToggle">
                        <label class="form-check-label" for="cropToggle">Enable Crop</label>
                    </div>
                    <button id="autoCropBtn" class="btn btn-sm btn-info"><i class="material-icons fs-6 me-1">center_focus_strong</i>Auto Crop</button>
                </div>
                
                <!-- Size Controls -->
                <div class="mt-3" id="sizeControls">
                    <div class="btn-group mb-2" role="group">
                        <button class="btn btn-primary btn-sm" id="increaseWidth">
                            <i class="material-icons">add</i> Width
                        </button>
                        <button class="btn btn-primary btn-sm" id="decreaseWidth">
                            <i class="material-icons">remove</i> Width
                        </button>
                    </div>
                    <div class="btn-group" role="group">
                        <button class="btn btn-primary btn-sm" id="increaseHeight">
                            <i class="material-icons">add</i> Height
                        </button>
                        <button class="btn btn-primary btn-sm" id="decreaseHeight">
                            <i class="material-icons">remove</i> Height
                        </button>
                    </div>
                </div>
                
                <!-- Original QR Code -->
                <img id="dragQr" 
                     src="{{ asset($certificate->qrcode) }}" 
                     draggable="true" 
                     class="img-fluid mt-3 border p-2 rounded" 
                     style="max-width: 231px; cursor: grab;">
                
                <!-- Download QR Button -->
                <div class="mt-3">
                    <button class="btn btn-outline-primary d-inline-flex align-items-center" id="downloadQrBtn">
                        <i class="material-icons me-2">download</i> Download QR Code
                    </button>
                </div>
                
                <p class="mt-3 small text-muted">
                    Drag QR onto certificate, move it, resize it, crop the QR code, and download!
                </p>

                <div class="mt-4 pt-3 border-top">
                    
                    
                    <div class="input-group input-group-dynamic mb-3">
                        <input type="text" 
                               id="certificateLink" 
                               class="form-control form-control-sm border-end-0" 
                               value="{{ url('/check-certificate/' . $certificate->uniqueId) }}" 
                               readonly
                               style="background: #f8f9fa;border-radius: 0.5rem 0 0 0.5rem !important;height: 35px;">
                        <button class="btn btn-sm btn-outline-primary d-flex align-items-center" 
                                type="button" 
                                id="copyLinkBtn"
                                style="border-radius: 0 0.5rem 0.5rem 0 !important;">
                            <i class="material-icons me-1" style="font-size: 1.1em;">content_copy</i>
                            <span>Copy</span>
                        </button>
                    </div>
                    
                    <p class="small text-muted mb-0">
                        Share this link to verify the certificate's authenticity
                    </p>
                </div>
                
                <style>
                    #copyLinkBtn {
                        transition: all 0.2s ease-in-out;
                    }
                    #copyLinkBtn.copied {
                        background-color: #4CAF50 !important;
                        color: white !important;
                        border-color: #4CAF50 !important;
                    }
                    #copyLinkBtn.copied i {
                        transform: scale(1.2);
                    }
                </style>
                
                <script>
                    document.addEventListener('DOMContentLoaded', function() {
                        const copyBtn = document.getElementById('copyLinkBtn');
                        const linkInput = document.getElementById('certificateLink');
                        
                        copyBtn.addEventListener('click', async function() {
                            try {
                                await navigator.clipboard.writeText(linkInput.value);
                                
                                // Visual feedback
                                const originalText = copyBtn.innerHTML;
                                copyBtn.innerHTML = '<i class="material-icons me-1" style="font-size: 1.1em;">check</i>Copied!';
                                copyBtn.classList.add('copied');
                                
                                // Reset button after 2 seconds
                                setTimeout(() => {
                                    copyBtn.innerHTML = originalText;
                                    copyBtn.classList.remove('copied');
                                }, 2000);
                                
                            } catch (err) {
                                // Fallback for older browsers
                                linkInput.select();
                                document.execCommand('copy');
                                
                                // Visual feedback for fallback
                                const originalText = copyBtn.innerHTML;
                                copyBtn.innerHTML = '<i class="material-icons me-1" style="font-size: 1.1em;">check</i>Copied!';
                                copyBtn.classList.add('copied');
                                
                                // Reset button after 2 seconds
                                setTimeout(() => {
                                    copyBtn.innerHTML = originalText;
                                    copyBtn.classList.remove('copied');
                                }, 2000);
                            }
                        });
                        
                        // Optional: Add hover effect
                        copyBtn.addEventListener('mouseenter', function() {
                            if (!this.classList.contains('copied')) {
                                this.style.transform = 'translateY(-1px)';
                            }
                        });
                        
                        copyBtn.addEventListener('mouseleave', function() {
                            this.style.transform = '';
                        });
                    });
                </script>
            </div>
        </div>
    </div>
</div>

<!-- Scripts for Drag, Move, Resize, Crop, and Merge -->
<script>
    const dragQr = document.getElementById('dragQr');
    const certificateArea = document.getElementById('certificate-area');
    const qrContainer = document.getElementById('qrContainer');
    const qrCode = document.getElementById('qrCode');
    const certificateImage = document.getElementById('certificateImage');
    const downloadBtn = document.getElementById('downloadBtn');
    const downloadQrBtn = document.getElementById('downloadQrBtn');
    const resetBtn = document.getElementById('resetBtn');
    const increaseWidth = document.getElementById('increaseWidth');
    const decreaseWidth = document.getElementById('decreaseWidth');
    const increaseHeight = document.getElementById('increaseHeight');
    const decreaseHeight = document.getElementById('decreaseHeight');
    const resizeHandle = document.querySelector('.resize-handle');
    const cropToggle = document.getElementById('cropToggle');
    const cropInterface = document.getElementById('cropInterface');
    const cropOverlay = document.getElementById('cropOverlay');
    const cropBox = document.getElementById('cropBox');
    const applyCrop = document.getElementById('applyCrop');
    const cancelCrop = document.getElementById('cancelCrop');
    const autoCropBtn = document.getElementById('autoCropBtn');
    const sizeControls = document.getElementById('sizeControls');

    let isDragging = false;
    let isResizing = false;
    let isMovingCropBox = false;
    let isResizingCrop = false;
    let startX, startY, startWidth, startHeight, startLeft, startTop;
    let cropStartWidth, cropStartHeight, cropStartLeft, cropStartTop;
    let currentWidth = 200; // Default QR width in pixels
    let currentHeight = 80; // Default QR height in pixels
    let croppedQR = null; // Store cropped QR code data URL
    let activeCropHandle = null;

    // Initialize QR code
    function initQrCode() {
        qrCode.style.width = currentWidth + 'px';
        qrCode.style.height = currentHeight + 'px';
        if (croppedQR) {
            qrCode.src = croppedQR;
        }
    }

    // Enable/disable crop toggle based on QR placement
    function updateCropToggleState() {
        cropToggle.disabled = qrContainer.style.display === 'none';
    }

    // Drag QR from side panel
    dragQr.addEventListener('dragstart', function(e) {
        e.dataTransfer.setData('text/plain', 'dragging');
    });

    // Drop QR onto certificate
    certificateArea.addEventListener('dragover', function(e) {
        e.preventDefault();
    });

    certificateArea.addEventListener('drop', function(e) {
        e.preventDefault();
        const rect = certificateArea.getBoundingClientRect();
        const x = e.clientX - rect.left - (currentWidth / 2);
        const y = e.clientY - rect.top - (currentHeight / 2);
        
        qrContainer.style.left = x + 'px';
        qrContainer.style.top = y + 'px';
        qrContainer.style.display = 'block';
        initQrCode();
        updateCropToggleState();
    });

    // Move QR on certificate
    qrCode.addEventListener('mousedown', function(e) {
        if (e.target === resizeHandle || cropToggle.checked) return;
        
        isDragging = true;
        const rect = qrContainer.getBoundingClientRect();
        startX = e.clientX;
        startY = e.clientY;
        startLeft = rect.left - certificateArea.getBoundingClientRect().left;
        startTop = rect.top - certificateArea.getBoundingClientRect().top;
        
        document.addEventListener('mousemove', moveQr);
        document.addEventListener('mouseup', stopMoveResize);
    });

    function moveQr(e) {
        if (!isDragging) return;
        
        const rect = certificateArea.getBoundingClientRect();
        const newLeft = startLeft + (e.clientX - startX);
        const newTop = startTop + (e.clientY - startY);
        
        const maxLeft = rect.width - qrContainer.offsetWidth;
        const maxTop = rect.height - qrContainer.offsetHeight;
        
        qrContainer.style.left = Math.min(Math.max(0, newLeft), maxLeft) + 'px';
        qrContainer.style.top = Math.min(Math.max(0, newTop), maxTop) + 'px';
    }

    // Resize QR
    resizeHandle.addEventListener('mousedown', function(e) {
        if (cropToggle.checked) return;
        isResizing = true;
        const rect = qrContainer.getBoundingClientRect();
        startX = e.clientX;
        startY = e.clientY;
        startWidth = rect.width;
        startHeight = rect.height;
        
        document.addEventListener('mousemove', resizeQr);
        document.addEventListener('mouseup', stopMoveResize);
    });

    function resizeQr(e) {
        if (!isResizing) return;
        
        const newWidth = startWidth + (e.clientX - startX);
        const newHeight = startHeight + (e.clientY - startY);
        
        currentWidth = Math.max(newWidth, 30);
        currentHeight = Math.max(newHeight, 30);
        
        qrCode.style.width = currentWidth + 'px';
        qrCode.style.height = currentHeight + 'px';
    }

    function stopMoveResize() {
        isDragging = false;
        isResizing = false;
        document.removeEventListener('mousemove', moveQr);
        document.removeEventListener('mousemove', resizeQr);
    }

    // Size controls - Width
    increaseWidth.addEventListener('click', function() {
        if (cropToggle.checked) return;
        currentWidth = Math.min(currentWidth + 10, 300);
        qrCode.style.width = currentWidth + 'px';
    });

    decreaseWidth.addEventListener('click', function() {
        if (cropToggle.checked) return;
        currentWidth = Math.max(currentWidth - 10, 30);
        qrCode.style.width = currentWidth + 'px';
    });

    // Size controls - Height
    increaseHeight.addEventListener('click', function() {
        if (cropToggle.checked) return;
        currentHeight = Math.min(currentHeight + 10, 300);
        qrCode.style.height = currentHeight + 'px';
    });

    decreaseHeight.addEventListener('click', function() {
        if (cropToggle.checked) return;
        currentHeight = Math.max(currentHeight - 10, 30);
        qrCode.style.height = currentHeight + 'px';
    });

    // Crop functionality
    cropToggle.addEventListener('change', function() {
        if (this.checked) {
            if (qrContainer.style.display === 'none') {
                this.checked = false;
                return;
            }
            cropInterface.style.display = 'block';
            sizeControls.style.display = 'none';
            initCropBox();
        } else {
            cropInterface.style.display = 'none';
            sizeControls.style.display = 'block';
        }
    });

    function initCropBox() {
        const qrDisplayWidth = qrCode.offsetWidth;
        const qrDisplayHeight = qrCode.offsetHeight;

        cropInterface.style.width = qrDisplayWidth + 'px';
        cropInterface.style.height = qrDisplayHeight + 'px';
        cropInterface.style.left = '0';
        cropInterface.style.top = '0';

        cropOverlay.style.width = qrDisplayWidth + 'px';
        cropOverlay.style.height = qrDisplayHeight + 'px';
        cropOverlay.style.left = '0px';
        cropOverlay.style.top = '0px';

        const boxWidth = 128; // Match .ccb width
        const boxHeight = 85; // Match .ccb height
        const boxLeft = (qrDisplayWidth - boxWidth) / 2;
        const boxTop = (qrDisplayHeight - boxHeight) / 2;

        cropBox.style.width = boxWidth + 'px';
        cropBox.style.height = boxHeight + 'px';
        cropBox.style.left = boxLeft + 'px';
        cropBox.style.top = boxTop + 'px';

        updateCropOverlay(boxLeft, boxTop, boxWidth, boxHeight);
    }

    function updateCropOverlay(left, top, width, height) {
        const clipPath = `polygon(
            0% 0%, 
            0% 100%, 
            ${left}px 100%, 
            ${left}px ${top}px, 
            ${left + width}px ${top}px, 
            ${left + width}px ${top + height}px, 
            ${left}px ${top + height}px, 
            ${left}px 100%, 
            100% 100%, 
            100% 0%
        )`;
        cropOverlay.style.clipPath = clipPath;
    }

    // Move crop box
    cropBox.addEventListener('mousedown', function(e) {
        if (e.target.classList.contains('crop-handle')) return;
        
        isMovingCropBox = true;
        startX = e.clientX;
        startY = e.clientY;
        startLeft = parseFloat(cropBox.style.left);
        startTop = parseFloat(cropBox.style.top);
        
        document.addEventListener('mousemove', moveCropBox);
        document.addEventListener('mouseup', stopMovingCropBox);
    });

    function moveCropBox(e) {
        if (!isMovingCropBox) return;

        const boundsWidth = cropOverlay.offsetWidth;
        const boundsHeight = cropOverlay.offsetHeight;

        let newLeft = startLeft + (e.clientX - startX);
        let newTop = startTop + (e.clientY - startY);

        const minLeft = 0;
        const maxLeft = boundsWidth - cropBox.offsetWidth;
        const minTop = 0;
        const maxTop = boundsHeight - cropBox.offsetHeight;

        newLeft = Math.min(Math.max(minLeft, newLeft), maxLeft);
        newTop = Math.min(Math.max(minTop, newTop), maxTop);

        cropBox.style.left = newLeft + 'px';
        cropBox.style.top = newTop + 'px';

        updateCropOverlay(newLeft, newTop, cropBox.offsetWidth, cropBox.offsetHeight);
    }

    function stopMovingCropBox() {
        isMovingCropBox = false;
        document.removeEventListener('mousemove', moveCropBox);
        document.removeEventListener('mouseup', stopMovingCropBox);
    }

    // Resize crop box
    document.querySelectorAll('.crop-handle').forEach(handle => {
        handle.addEventListener('mousedown', function(e) {
            e.stopPropagation();
            isResizingCrop = true;
            activeCropHandle = handle.classList;
            startX = e.clientX;
            startY = e.clientY;
            cropStartWidth = parseFloat(cropBox.style.width);
            cropStartHeight = parseFloat(cropBox.style.height);
            cropStartLeft = parseFloat(cropBox.style.left);
            cropStartTop = parseFloat(cropBox.style.top);
            
            document.addEventListener('mousemove', resizeCropBox);
            document.addEventListener('mouseup', stopResizingCropBox);
        });
    });

    function resizeCropBox(e) {
        if (!isResizingCrop) return;

        const boundsWidth = cropOverlay.offsetWidth;
        const boundsHeight = cropOverlay.offsetHeight;

        let newWidth = cropStartWidth;
        let newHeight = cropStartHeight;
        let newLeft = cropStartLeft;
        let newTop = cropStartTop;

        const deltaX = e.clientX - startX;
        const deltaY = e.clientY - startY;

        if (activeCropHandle.contains('top-left')) {
            newWidth = cropStartWidth - deltaX;
            newHeight = cropStartHeight - deltaY;
            newLeft = cropStartLeft + deltaX;
            newTop = cropStartTop + deltaY;
        } else if (activeCropHandle.contains('top-right')) {
            newWidth = cropStartWidth + deltaX;
            newHeight = cropStartHeight - deltaY;
            newTop = cropStartTop + deltaY;
        } else if (activeCropHandle.contains('bottom-left')) {
            newWidth = cropStartWidth - deltaX;
            newHeight = cropStartHeight + deltaY;
            newLeft = cropStartLeft + deltaX;
        } else if (activeCropHandle.contains('bottom-right')) {
            newWidth = cropStartWidth + deltaX;
            newHeight = cropStartHeight + deltaY;
        }

        const minCropSize = 30;

        if (newLeft < 0) {
            newWidth += newLeft;
            newLeft = 0;
        }
        if (newTop < 0) {
            newHeight += newTop;
            newTop = 0;
        }
        if (newLeft + newWidth > boundsWidth) {
            newWidth = boundsWidth - newLeft;
        }
        if (newTop + newHeight > boundsHeight) {
            newHeight = boundsHeight - newTop;
        }

        newWidth = Math.max(minCropSize, newWidth);
        newHeight = Math.max(minCropSize, newHeight);

        if (newLeft + newWidth > boundsWidth) {
            if (activeCropHandle.contains('top-left') || activeCropHandle.contains('bottom-left')) {
                newLeft = boundsWidth - newWidth;
            }
        }
        if (newTop + newHeight > boundsHeight) {
            if (activeCropHandle.contains('top-left') || activeCropHandle.contains('top-right')) {
                newTop = boundsHeight - newHeight;
            }
        }
        if (newLeft < 0) newLeft = 0;
        if (newTop < 0) newTop = 0;

        cropBox.style.width = newWidth + 'px';
        cropBox.style.height = newHeight + 'px';
        cropBox.style.left = newLeft + 'px';
        cropBox.style.top = newTop + 'px';

        updateCropOverlay(newLeft, newTop, newWidth, newHeight);
    }

    function stopResizingCropBox() {
        isResizingCrop = false;
        activeCropHandle = null;
        document.removeEventListener('mousemove', resizeCropBox);
        document.removeEventListener('mouseup', stopResizingCropBox);
    }

    // Apply crop
    applyCrop.addEventListener('click', function() {
        if (qrCode.naturalWidth === 0 || qrCode.naturalHeight === 0) {
            alert('QR code image is not loaded. Please try again.');
            return;
        }

        const canvas = document.createElement('canvas');
        const ctx = canvas.getContext('2d');

        // Get crop coordinates in display pixels
        const sourceX = parseFloat(cropBox.style.left);
        const sourceY = parseFloat(cropBox.style.top);
        const sourceWidth = parseFloat(cropBox.style.width);
        const sourceHeight = parseFloat(cropBox.style.height);

        // Scale to natural dimensions
        const qrNaturalWidth = qrCode.naturalWidth;
        const qrNaturalHeight = qrCode.naturalHeight;
        const qrDisplayWidth = qrCode.offsetWidth;
        const qrDisplayHeight = qrCode.offsetHeight;
        const scaleX = qrNaturalWidth / qrDisplayWidth;
        const scaleY = qrNaturalHeight / qrDisplayHeight;

        // Set canvas to natural size of cropped area (high resolution)
        const naturalCropWidth = sourceWidth * scaleX;
        const naturalCropHeight = sourceHeight * scaleY;

        // Ensure minimum resolution for QR code (e.g., 300px)
        const minResolution = 300;
        const scaleFactor = Math.max(1, minResolution / Math.min(naturalCropWidth, naturalCropHeight));
        canvas.width = naturalCropWidth * scaleFactor;
        canvas.height = naturalCropHeight * scaleFactor;

        ctx.drawImage(
            qrCode,
            sourceX * scaleX,
            sourceY * scaleY,
            naturalCropWidth,
            naturalCropHeight,
            0,
            0,
            canvas.width,
            canvas.height
        );

        croppedQR = canvas.toDataURL('image/png', 1.0);
        qrCode.src = croppedQR;
        dragQr.src = croppedQR;

        // Keep display size as crop box size
        currentWidth = sourceWidth;
        currentHeight = sourceHeight;
        qrCode.style.width = currentWidth + 'px';
        qrCode.style.height = currentHeight + 'px';

        cropToggle.checked = false;
        cropInterface.style.display = 'none';
        sizeControls.style.display = 'block';
    });

    // Cancel crop
    cancelCrop.addEventListener('click', function() {
        cropToggle.checked = false;
        cropInterface.style.display = 'none';
        sizeControls.style.display = 'block';
    });

    // Auto Crop
    function performAutoCrop() {
        if (qrContainer.style.display === 'none' || !qrCode.src) {
            alert("Please place the QR code on the certificate first.");
            return;
        }

        if (qrCode.naturalWidth === 0 || qrCode.naturalHeight === 0) {
            alert("QR image is not loaded. Please wait a moment and try again.");
            return;
        }

        if (!cropToggle.checked) {
            cropToggle.checked = true;
            cropToggle.dispatchEvent(new Event('change'));
        }

        setTimeout(() => {
            const qrDisplayWidth = qrCode.offsetWidth;
            const qrDisplayHeight = qrCode.offsetHeight;
            const qrNaturalWidth = qrCode.naturalWidth;
            const qrNaturalHeight = qrCode.naturalHeight;

            const detectedQrNatural = {
                x: qrNaturalWidth * 0.60,
                y: qrNaturalHeight * 0.10,
                width: qrNaturalWidth * 0.90,
                height: qrNaturalHeight * 0.90
            };

            const scaleX = qrDisplayWidth / qrNaturalWidth;
            const scaleY = qrDisplayHeight / qrNaturalHeight;

            let cropBoxX = detectedQrNatural.x * scaleX;
            let cropBoxY = detectedQrNatural.y * scaleY;
            let cropBoxWidth = detectedQrNatural.width * scaleX;
            let cropBoxHeight = detectedQrNatural.height * scaleY;

            const minCropDim = 30;

            cropBoxX = Math.max(0, cropBoxX);
            cropBoxY = Math.max(0, cropBoxY);
            cropBoxWidth = Math.max(minCropDim, cropBoxWidth);
            cropBoxHeight = Math.max(minCropDim, cropBoxHeight);

            if (cropBoxX + cropBoxWidth > qrDisplayWidth) {
                cropBoxWidth = qrDisplayWidth - cropBoxX;
            }
            if (cropBoxY + cropBoxHeight > qrDisplayHeight) {
                cropBoxHeight = qrDisplayHeight - cropBoxY;
            }

            cropBoxWidth = Math.max(minCropDim, cropBoxWidth);
            cropBoxHeight = Math.max(minCropDim, cropBoxHeight);

            if (cropBoxX + cropBoxWidth > qrDisplayWidth) {
                cropBoxX = qrDisplayWidth - cropBoxWidth;
            }
            if (cropBoxY + cropBoxHeight > qrDisplayHeight) {
                cropBoxY = qrDisplayHeight - cropBoxHeight;
            }
            if (cropBoxX < 0) cropBoxX = 0;
            if (cropBoxY < 0) cropBoxY = 0;

            cropBox.style.left = cropBoxX + 'px';
            cropBox.style.top = cropBoxY + 'px';
            cropBox.style.width = cropBoxWidth + 'px';
            cropBox.style.height = cropBoxHeight + 'px';

            updateCropOverlay(cropBoxX, cropBoxY, cropBoxWidth, cropBoxHeight);
        }, 100);
    }

    autoCropBtn.addEventListener('click', performAutoCrop);

    downloadBtn.addEventListener('click', function () {
        const canvas = document.createElement('canvas');
        const ctx = canvas.getContext('2d');

        // Set canvas size to match certificate
        canvas.width = certificateImage.naturalWidth;
        canvas.height = certificateImage.naturalHeight;

        // Draw certificate
        ctx.drawImage(certificateImage, 0, 0, canvas.width, canvas.height);

        if (qrContainer.style.display !== 'none') {
            const qrImg = new Image();
            qrImg.src = qrCode.src;
            qrImg.onload = function () {
                const scale = certificateImage.naturalWidth / certificateImage.clientWidth;
                const x = parseInt(qrContainer.style.left) * scale;
                const y = parseInt(qrContainer.style.top) * scale;
                const width = qrCode.offsetWidth * scale;
                const height = qrCode.offsetHeight * scale;

                ctx.drawImage(qrImg, x, y, width, height);

                // Convert canvas to blob and send to server
                canvas.toBlob(function (blob) {
                    const formData = new FormData();
                    formData.append('certificate_logo', blob, 'certificate_with_qr.png');
                    formData.append('certificate_id', "{{ $certificate->id }}");

                    fetch("{{ route('uploadCertificateLogo') }}", {
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        },
                        body: formData
                    })
                    .then(response => response.json())
                    .then(data => {
                        // No alert — just download
                        const link = document.createElement('a');
                        link.download = 'Certificate_with_QR.png';
                        link.href = URL.createObjectURL(blob);
                        link.click();
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        // Optional: show error notification here
                    });
                }, 'image/png');
            };
        }
    });

    downloadQrBtn.addEventListener('click', function() {
        const link = document.createElement('a');
        link.download = 'Certificate_QR.png';
        link.href = croppedQR || dragQr.src;
        link.click();
    });

    // Reset button
    resetBtn.addEventListener('click', function() {
        qrContainer.style.display = 'none';
        cropInterface.style.display = 'none';
        cropToggle.checked = false;
        sizeControls.style.display = 'block';
        currentWidth = 200;
        currentHeight = 80;
        croppedQR = null;
        qrCode.src = dragQr.src = "{{ asset($certificate->qrcode) }}";
        updateCropToggleState();
    });

    // Initialize crop toggle state
    updateCropToggleState();
</script>

<!-- CSS -->
<style>
    .card {
        border: none;
        border-radius: 10px;
    }
    .material-icons {
        vertical-align: middle;
    }
    .badge {
        font-size: 0.8rem;
    }
    #certificate-area {
        min-height: 600px;
        position: relative;
    }
    #qrContainer {
        border: 2px dashed #6B3FA0;
        border-radius: 10px;
        padding: 5px;
        background: rgba(255, 255, 255, 0.8);
    }
    #qrCode {
        width: 200px;
        height: 80px;
    }
    .resize-handle {
        width: 10px;
        height: 10px;
        background: #6B3FA0;
        position: absolute;
        right: -5px;
        bottom: -5px;
        cursor: nwse-resize;
    }
    .btn {
        transition: all 0.2s;
    }
    .btn-group {
        margin: 0 5px;
    }
    #cropBox {
        background: rgba(255, 255, 255, 0.2);
        border: 2px dashed #fff;
    }
    .crop-handle {
        width: 10px;
        height: 10px;
        background: #fff;
        border-radius: 50%;
        position: absolute;
    }
    .form-switch .form-check-input {
        width: 3em !important;
        height: 1.5em !important;
    }
    .form-switch .form-check-input:disabled {
        opacity: 0.5;
    }
</style>

@endsection