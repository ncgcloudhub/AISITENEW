@extends('admin.layouts.master')
@section('title') Education Wizard Contents @endsection

@section('content')
 <style>
    body{
        background: #dde1e7;
    }

    .ccard {
        height: auto;
        width: auto;
        padding: 20px;
        background: #dde1e7;
        border-radius: 20px;
        margin: 20px;
        box-shadow: inset -5px -5px 9px rgba(255,255,255,0.45), inset 5px 5px 9px rgba(94,104,121,0.3);
    }

    .nav-tabs {
            border-bottom: none;
        }

        .nav-tabs .nav-link {
            background: #dde1e7;
            border-radius: 15px;
            margin-right: 5px;
            box-shadow: inset -3px -3px 5px rgba(255, 255, 255, 0.6),
                        inset 3px 3px 5px rgba(94, 104, 121, 0.2);
        }

        .nav-tabs .nav-link.active {
            box-shadow: -5px -5px 9px rgba(255,255,255,0.45), 5px 5px 9px rgba(94,104,121,0.3);
        }

        .tab-content {
            margin-top: 15px;
        }

        .tab-pane {
            padding: 10px;
            background-color: #dde1e7;
            border-radius: 15px;
            box-shadow: inset -5px -5px 9px rgba(255, 255, 255, 0.45), 
                        inset 5px 5px 9px rgba(94, 104, 121, 0.3);
        }

        .subject-btn {
        background: #dde1e7;
        border-radius: 15px;
        box-shadow: inset -3px -3px 5px rgba(255, 255, 255, 0.6),
                    inset 3px 3px 5px rgba(94, 104, 121, 0.2);
        padding: 10px 20px;
        font-size: 14px;
        transition: all 0.2s ease-in-out;
    }

    .subject-btn:hover {
        box-shadow: -5px -5px 10px rgba(255, 255, 255, 0.6),
                    5px 5px 10px rgba(94, 104, 121, 0.3);
    }

    .subject-btn:active {
        box-shadow: inset -5px -5px 10px rgba(255, 255, 255, 0.6),
                    inset 5px 5px 10px rgba(94, 104, 121, 0.3);
    }

    /* Dynamic Cards */
    .neomorphic-card {
        background: #dde1e7;
        border-radius: 15px;
        box-shadow: 8px 8px 15px rgba(0, 0, 0, 0.1), 
                    -8px -8px 15px rgba(255, 255, 255, 0.7);
        padding: 20px;
        margin-right: 20px;
        transition: all 0.3s ease;
    }

    .neomorphic-card:hover {
        box-shadow: 10px 10px 20px rgba(0, 0, 0, 0.15), 
                    -10px -10px 20px rgba(255, 255, 255, 0.6);
    }

    .neomorphic-card .card-body {
        text-align: center;
    }

    .neomorphic-avatar {
        background: #dde1e7;
        box-shadow: inset 5px 5px 10px rgba(0, 0, 0, 0.1), 
                    inset -5px -5px 10px rgba(255, 255, 255, 0.6);
        border-radius: 50%;
    }

    .neomorphic-avatar i {
        color: #6c757d;
    }

    .btn-neomorphic {
        background: #dde1e7;
        box-shadow: inset -5px -5px 10px rgba(255, 255, 255, 0.6),
                    inset 5px 5px 10px rgba(94, 104, 121, 0.2);
        border-radius: 25px;
        padding: 10px 20px;
        transition: box-shadow 0.2s;
    }

    .btn-neomorphic:hover {
        box-shadow: -5px -5px 10px rgba(255, 255, 255, 0.6),
                    5px 5px 10px rgba(94, 104, 121, 0.3);
    }

 </style>
  <div class="row">
    <div class="col-xxl-4">
        <div class="ccard">
            <ul class="nav nav-tabs" id="myTab" role="tablist">
                @foreach ($classes as $index => $item)
                <li class="nav-item" role="presentation">
                    <button class="nav-link {{ $loop->first ? 'active show' : '' }}" 
                            id="tab-{{ $item->id }}" 
                            data-bs-toggle="tab" 
                            data-bs-target="#tab-content-{{ $item->id }}" 
                            type="button" 
                            role="tab" 
                            aria-controls="tab-content-{{ $item->id }}" 
                            aria-selected="{{ $loop->first ? 'true' : 'false' }}">
                        {{ $item->grade }} <!-- Tab label -->
                    </button>
                </li>
            @endforeach
            </ul>
        
            <!-- Tab content -->
            <div class="tab-content" id="myTabContent">
                @foreach ($classes as $index => $item)
                <div class="tab-pane fade {{ $loop->first ? 'show active' : '' }}" 
                     id="tab-content-{{ $item->id }}" 
                     role="tabpanel" 
                     aria-labelledby="tab-{{ $item->id }}">
                 
        
                    @if ($item->subjects->isNotEmpty())
                        <div class="subject-buttons">
                            @foreach ($item->subjects as $subject)
                               
                                <button type="button" class="btn subject-btn mb-2" 
                                        data-subject-id="{{ $subject->id }}">
                                    {{ $subject->name }}
                                </button>
                            @endforeach
                        </div>
                    @else
                        <p>No subjects allocated for this class.</p>
                    @endif
                </div>
            @endforeach
            </div>
        </div>


        {{-- SEARCH --}}
        <form id="searchForm">
            <input type="text" name="search" id="searchBox" placeholder="Search..." class="form-control">
            <button type="submit" class="btn btn-primary">Search</button>
        </form>
        
        <div id="searchResults">
            <!-- Results will be shown here -->
        </div>




    </div>

    <div class="col-xxl-8 d-flex flex-wrap" id="content-display">
       
    
    </div>



</div>


<div class="modal fade bs-example-modal-lg modal-dialog-scrollable" id="contentModal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="myLargeModalLabel">Content Details <span id="created" class="badge bg-primary"></span></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                </button>
            </div>
            <div>
                <img width="200px" height="200px" src="" alt="Generated Image" class="img-fluid" id="modal-image">
            </div>
            <div class="modal-body" id="modal-content-body">
             
            </div>
            <div class="modal-footer">
                  <button id="mark-complete-btn" type="button" class="btn btn-secondary incomplete" onclick="markAsComplete(contentId, this)">
                    Mark as Complete
                </button>               
                <a id="download-link" href="#">
                    <button type="button" class="btn btn-primary" data-bs-toggle="tooltip" data-bs-placement="top" title="Download">
                        <i class="ri-download-line"></i> Download
                    </button>
                </a>
                <a href="javascript:void(0);" class="btn btn-link link-success fw-medium" data-bs-dismiss="modal">
                    <i class="ri-close-line me-1 align-middle"></i> Closes
                </a>
            </div>
            
            
        </div>
    </div>
</div> 

<!-- Edit Content Modal -->
<div class="modal fade" id="editContentModal" tabindex="-1" aria-labelledby="editContentModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editContentModalLabel">Edit Content</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <textarea id="contentEditor" class="form-control" rows="20"></textarea>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" onclick="saveEditedContent()">Save Changes</button>
            </div>
        </div>
    </div>
</div>
@endsection


@section('script')

<script src="{{ URL::asset('build/js/app.js') }}"></script>

<script>

// Open the editor modal and populate it with content data
function openEditorModal(contentId) {
    // Fetch the content details for editing
    fetch(`/education/content/${contentId}`)
        .then(response => response.json())
        .then(data => {
            // Populate the text editor with the current content
            document.getElementById('contentEditor').value = data.content;
          
            document.getElementById('editContentModal').setAttribute('data-content-id', contentId);
            
            // Open the modal
            var editModal = new bootstrap.Modal(document.getElementById('editContentModal'));
            editModal.show();
        })
        .catch(error => console.error('Error:', error));
}


// Save the edited content
function saveEditedContent() {
    const contentId = document.getElementById('editContentModal').getAttribute('data-content-id');
    const updatedContent = document.getElementById('contentEditor').value;

    fetch(`/education/content/${contentId}/update`, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        },
        body: JSON.stringify({ content: updatedContent })
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            alert('Content updated successfully!');
            // Optionally refresh content display or update UI here
            var editModal = bootstrap.Modal.getInstance(document.getElementById('editContentModal'));
            editModal.hide();
        } else {
            alert('Failed to update content.');
        }
    })
    .catch(error => console.error('Error:', error));
}



    document.addEventListener('DOMContentLoaded', function () {
        document.querySelectorAll('.subject-buttons button').forEach(button => {
            button.addEventListener('click', function () {
                const subjectId = this.getAttribute('data-subject-id');
    
                fetch('{{ route('education.getContentsBySubject') }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    },
                    body: JSON.stringify({ subject_id: subjectId })
                })
                .then(response => response.json())
                .then(data => {
                    const contentDisplay = document.getElementById('content-display');
                    contentDisplay.innerHTML = ''; // Clear previous content
    
                if (data.contents.length > 0) {
                data.contents.forEach(content => {
                const contentElement = document.createElement('div');
                contentElement.classList.add('col-12', 'col-md-6', 'col-lg-3');

                // Format the date using JavaScript
                const createdAt = new Date(content.created_at).toLocaleDateString('en-US', {
                    day: 'numeric', month: 'short', year: 'numeric'
                });
                const downloadUrl = '{{ url('education/content') }}/' + content.id + '/download';
                const editUrl = '{{ url('education/content') }}/' + content.id + '/edit';
                const cardClass = content.status === 'completed' ? 'ribbon-box' : '';
                const ribbonClass = content.status === 'completed' ? 'ribbon-two ribbon-two-success' : '';
                const ribbonText = content.status === 'completed' ? 'Completed' : ''; 
                
                contentElement.innerHTML = `
                                <div class="neomorphic-card ${cardClass}" data-id="${content.id}">
                                    <div class="card-body">
                                         <div class="r ${ribbonClass}"><span>${ribbonText}</span></div>
                                        <h5 class="mb-0">${content.topic}</h5>
                                        <p class="text-muted">${content.subject.name}</p>
                                       <p class="text-muted">${createdAt}</p>
                                        <div class="d-flex gap-2 justify-content-center mb-3">
                                            <a href="${downloadUrl}">
                                                <button type="button" class="btn avatar-xs p-0 neomorphic-avatar" data-bs-toggle="tooltip" data-bs-placement="top" title="Download">
                                                    <span class="avatar-title rounded-circle bg-light text-body">
                                                        <i class="ri-download-line"></i>
                                                    </span>
                                                </button>
                                            </a>

                                            <a href="${editUrl}">
                                                <button type="button" class="btn avatar-xs p-0 neomorphic-avatar" data-bs-toggle="tooltip" data-bs-placement="top" title="Edit">
                                                    <span class="avatar-title rounded-circle bg-light text-body">
                                                        <i class="ri-edit-line"></i>
                                                    </span>
                                                </button>
                                            </a>

                                            <button type="button" class="btn avatar-xs p-0 neomorphic-avatar mark-complete" onclick="markAsComplete(${content.id})" data-bs-toggle="tooltip" data-bs-placement="top" title="${content.status === 'completed' ? 'Unmark' : 'Completed'}">
                                                <span class="avatar-title rounded-circle bg-light text-body">
                                                    <i class="ri-${content.status === 'completed' ? 'close-line' : 'chat-forward-line'}"></i>
                                                </span>
                                            </button>

                                            <button type="button" class="btn avatar-xs p-0 neomorphic-avatar" data-bs-toggle="tooltip" data-bs-placement="top" title="Delete" onclick="deleteContent(${content.id}, this)">
                                                <span class="avatar-title rounded-circle bg-light text-body">
                                                    <i class="ri-delete-bin-4-line"></i>
                                                </span>
                                            </button>

                                         @if($lastPackage)
                                            <button type="button" class="btn avatar-xs p-0 neomorphic-avatar" data-bs-toggle="tooltip" data-bs-placement="top" title="${content.add_to_library ? 'Remove from Library' : 'Add to Library'}" onclick="addToLibrary(${content.id}, this)">
                                                <span class="avatar-title rounded-circle bg-light text-body">
                                                      <i class="${content.add_to_library ? 'ri-file-reduce-line' : 'ri-file-add-line'}"></i>
                                                </span>
                                            </button>
                                        @endif

                                        </div>
                                        <div>
                                            <button type="button" class="btn btn-neomorphic mb-2" onclick="fetchContent(${content.id})">
                                                <i class="ri-add-fill me-1 align-bottom"></i>View
                                            </button>

                                            <button type="button" class="btn btn-neomorphic" onclick="openEditorModal(${content.id})">
                                                <i class="ri-edit-2-fill me-1 align-bottom"></i>Edit in Editor
                                            </button>

                                        </div>
                                    </div>
                                </div>
                            `;
                contentDisplay.appendChild(contentElement);
            });
                    } else {
                        contentDisplay.innerHTML = '<p>No content available for this subject.</p>';
                    }
                })
                .catch(error => console.error('Error:', error));
            });
        });
    });

    function deleteContent(contentId, element) {
    if (confirm('Are you sure you want to delete this content?')) {
        fetch(`/education/deleteContent/${contentId}`, {
            method: 'DELETE',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                // Remove the content card from the DOM
                const contentElement = element.closest('.col-12');
                contentElement.remove();
            } else {
                console.error('Error:', data.error);
            }
        })
        .catch(error => console.error('Error:', error));
    }
    }
    
    function fetchContent(contentId) {
        fetch('{{ route('education.getContentById') }}', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            },
            body: JSON.stringify({ content_id: contentId })
        })
        .then(response => response.json())
        .then(data => {
            // Load the content into the modal
            document.getElementById('modal-content-body').innerHTML = `
                <h6 class="fs-15">${data.content.topic}</h6>
                ${data.content.generated_content}
            `;

            const createdAt = new Date(data.content.created_at).toLocaleDateString('en-US', {
            day: 'numeric', month: 'short', year: 'numeric'
            });

            document.getElementById('created').innerHTML = `
            ${createdAt}
            `;

            const modalImage = document.getElementById('modal-image');
            if (data.content.image_url) {
                modalImage.src = data.content.image_url; // Set the image URL
                modalImage.alt = data.content.topic; // Optionally set the alt text
                modalImage.classList.remove('d-none'); // Show the image
            } else {
                modalImage.classList.add('d-none'); // Hide the image if no URL is available
            }

            // Set the download link with the appropriate URL
            const downloadLink = document.getElementById('download-link');
            const downloadUrl = `{{ url('education/content') }}/${contentId}/download`; // Dynamic download URL
            downloadLink.setAttribute('href', downloadUrl);

            // Update the Mark as Complete button with the correct onclick event
            const markCompleteButton = document.getElementById('mark-complete-btn');
            markCompleteButton.setAttribute('onclick', `markAsComplete(${contentId})`);

            // Show the modal
            var contentModal = new bootstrap.Modal(document.getElementById('contentModal'));
            contentModal.show();
        })
        .catch(error => console.error('Error:', error));
    }

    function markAsComplete(contentId) {
        fetch(`/education/content/${contentId}/complete`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            },
            body: JSON.stringify({})
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                const card = document.querySelector(`.neomorphic-card[data-id="${contentId}"]`);
                let ribbon = card.querySelector('.r'); // Get the ribbon element
                const markCompleteButton = document.querySelector(`#mark-complete-btn`);

        if (card) {
            if (data.status === 'completed') {
                // Mark the content as completed
                card.classList.add('ribbon-box');
                markCompleteButton.textContent = 'Unmark as Complete';

                // Add the ribbon if it doesn't exist
                if (!ribbon) {
                    ribbon = document.createElement('div');
                    ribbon.classList.add('r', 'ribbon-two', 'ribbon-two-success');
                    ribbon.innerHTML = '<span>Completed</span>';
                    card.prepend(ribbon); // Add the ribbon to the top of the card
                } else {
                    // If ribbon exists, just update the classes
                    ribbon.classList.add('ribbon-two', 'ribbon-two-success');
                    ribbon.innerHTML = '<span>Completed</span>';
                }
                } else {
                    // Unmark the content as completed
                    card.classList.remove('bg-success', 'text-white');
                    markCompleteButton.textContent = 'Mark as Complete';

                    // Remove the ribbon
                    if (ribbon) {
                        ribbon.remove();
                    }
                }
            }

                console.log(data.message);
            } else {
                console.error('Failed to update content status');
            }
        })
        .catch(error => console.error('Error:', error));
    }


    function addToLibrary(contentId, buttonElement) {
    fetch(`/education/content/${contentId}/add-to-library`, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        },
        body: JSON.stringify({})
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            if (data.status === 'added') {
                // Update button to indicate it has been added to the library
                buttonElement.classList.add('btn-success');
                buttonElement.setAttribute('title', 'Remove from Library');
                buttonElement.querySelector('i').classList.replace('ri-file-add-line', 'ri-file-reduce-line');
            } else {
                // Update button to indicate it can be added to the library
                buttonElement.classList.remove('btn-success');
                buttonElement.setAttribute('title', 'Add to Library');
                buttonElement.querySelector('i').classList.replace('ri-file-reduce-line', 'ri-file-add-line');
            }

            console.log(data.message);
        } else {
            console.error('Failed to update library status');
        }
    })
    .catch(error => console.error('Error:', error));
}



</script>


<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(document).ready(function() {
    $('#searchForm').on('submit', function(e) {
        e.preventDefault();
        
        var searchTerm = $('#searchBox').val();
        
        $.ajax({
            url: '{{ route("educationContent.search") }}',
            method: 'GET',
            data: {
                search: searchTerm
            },
            success: function(response) {
    const contentDisplay = document.getElementById('content-display'); // Target your content display element
    contentDisplay.innerHTML = ''; // Clear previous content

    if (response.data.length > 0) {
        response.data.forEach(content => {
            console.log(content);

            // Extract and handle data
            const grade = content.gradeClasss ? content.gradeClasss.grade : 'N/A';
            const subject = content.subject ? content.subject.name : 'N/A';
            const author = content.user ? content.user.name : 'Unknown';

            // Format the date
            const createdAt = new Date(content.created_at).toLocaleDateString('en-US', {
                day: 'numeric', month: 'short', year: 'numeric'
            });

            // Construct URLs
            const downloadUrl = `/education/content/${content.id}/download`;
            const editUrl = `/education/content/${content.id}/edit`;
            const cardClass = content.status === 'completed' ? 'ribbon-box' : '';
            const ribbonClass = content.status === 'completed' ? 'ribbon-two ribbon-two-success' : '';
            const ribbonText = content.status === 'completed' ? 'Completed' : '';

            // Create the content element dynamically
            const contentElement = document.createElement('div');
            contentElement.classList.add('col-12', 'col-md-6', 'col-lg-3');

            contentElement.innerHTML = `
                <div class="neomorphic-card ${cardClass}" data-id="${content.id}">
                    <div class="card-body">
                        <div class="r ${ribbonClass}"><span>${ribbonText}</span></div>
                        <h5 class="mb-0">${content.topic}</h5>
                        <p class="text-muted">Grade: ${grade}</p>
                        <p class="text-muted">Subject: ${subject}</p>
                        <p class="text-muted">Author: ${author}</p>
                        <p class="text-muted">${createdAt}</p>
                        <div class="d-flex gap-2 justify-content-center mb-3">
                            <a href="${downloadUrl}">
                                <button type="button" class="btn avatar-xs p-0 neomorphic-avatar" data-bs-toggle="tooltip" data-bs-placement="top" title="Download">
                                    <span class="avatar-title rounded-circle bg-light text-body">
                                        <i class="ri-download-line"></i>
                                    </span>
                                </button>
                            </a>
                            <a href="${editUrl}">
                                <button type="button" class="btn avatar-xs p-0 neomorphic-avatar" data-bs-toggle="tooltip" data-bs-placement="top" title="Edit">
                                    <span class="avatar-title rounded-circle bg-light text-body">
                                        <i class="ri-edit-line"></i>
                                    </span>
                                </button>
                            </a>
                            <button type="button" class="btn avatar-xs p-0 neomorphic-avatar" data-bs-toggle="tooltip" data-bs-placement="top" title="${content.status === 'completed' ? 'Unmark' : 'Completed'}" onclick="markAsComplete(${content.id})">
                                <span class="avatar-title rounded-circle bg-light text-body">
                                    <i class="ri-${content.status === 'completed' ? 'close-line' : 'chat-forward-line'}"></i>
                                </span>
                            </button>
                            <button type="button" class="btn avatar-xs p-0 neomorphic-avatar" data-bs-toggle="tooltip" data-bs-placement="top" title="Delete" onclick="deleteContent(${content.id}, this)">
                                <span class="avatar-title rounded-circle bg-light text-body">
                                    <i class="ri-delete-bin-4-line"></i>
                                </span>
                            </button>
                        </div>
                        <div>
                            <button type="button" class="btn btn-neomorphic mb-2" onclick="fetchContent(${content.id})">
                                <i class="ri-add-fill me-1 align-bottom"></i>Details
                            </button>
                            <button type="button" class="btn btn-neomorphic" onclick="openEditorModal(${content.id})">
                                <i class="ri-edit-2-fill me-1 align-bottom"></i>Edit in Editor
                            </button>
                        </div>
                    </div>
                </div>
            `;

            // Append the dynamically created content element
            contentDisplay.appendChild(contentElement);
        });
    } else {
        contentDisplay.innerHTML = '<p>No content available for this subject.</p>';
    }
},
error: function() {
    const contentDisplay = document.getElementById('content-display');
    contentDisplay.innerHTML = '<p>An error occurred while loading the content.</p>';
}


        });
    });
});
</script>

@endsection

