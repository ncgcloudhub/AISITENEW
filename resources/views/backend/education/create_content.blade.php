@extends('admin.layouts.master')
@section('title') Education Wizard @endsection

@section('css')

<link rel="stylesheet" href="https://cdn.jsdelivr.net/simplemde/latest/simplemde.min.css">

@endsection
@section('content')

<div class="row">
    <div class="col-xl-12">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h4 class="card-title mb-0">Education</h4>
                <a href="{{ route('user_generated_education_content') }}" class="btn gradient-btn-12 fw-bold text-dark shadow">
                    Show Generated Contents
                </a>
            </div><!-- end card header -->
            
            <div class="card-body form-steps">
                <form class="vertical-navs-step" action="{{ route('education.content')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row gy-5">
                        <div class="col-lg-3">
                            <div class="nav flex-column custom-nav nav-pills" role="tablist"
                                aria-orientation="vertical">
                                <button class="nav-link active" id="v-pills-bill-info-tab" data-bs-toggle="pill"
                                    data-bs-target="#v-pills-bill-info" type="button" role="tab"
                                    aria-controls="v-pills-bill-info" aria-selected="true">
                                    <span class="step-title me-2">
                                        <i class="ri-pencil-fill step-icon me-2"></i> Step 1
                                    </span>
                                    Basic Info
                                </button>
                                <button class="nav-link" id="v-pills-bill-address-tab" data-bs-toggle="pill"
                                    data-bs-target="#v-pills-bill-address" type="button" role="tab"
                                    aria-controls="v-pills-bill-address" aria-selected="false">
                                    <span class="step-title me-2">
                                        <i class="ri-pencil-fill step-icon me-2"></i> Step 2
                                    </span>
                                    Class Materials Info
                                </button>
                                <button class="nav-link" id="v-pills-payment-tab" data-bs-toggle="pill"
                                    data-bs-target="#v-pills-payment" type="button" role="tab"
                                    aria-controls="v-pills-payment" aria-selected="false">
                                    <span class="step-title me-2">
                                        <i class="ri-lightbulb-fill step-icon me-2"></i> Step 3
                                    </span>
                                    Topic Reference
                                </button>
                                <button class="nav-link" id="v-pills-finish-tab" data-bs-toggle="pill"
                                    data-bs-target="#v-pills-finish" type="button" role="tab"
                                    aria-controls="v-pills-finish" aria-selected="false">
                                    <span class="step-title me-2">
                                        <i class="ri-close-circle-fill step-icon me-2"></i> Step 4
                                    </span>
                                    Finish
                                </button>

                                <div class="card mb-3 mt-3 border-color-purple">
                                    <div class="card-body">
                                        <div class="d-flex mb-3 align-items-center">
                                            <h6 class="card-title mb-0 flex-grow-1 gradient-text-1-bold">Last 5 Content</h6>
                                        </div>
                                        <ul class="list-unstyled vstack gap-3 mb-0">
                                            @foreach ($educationContents as $item)
                                                <li onclick="fetchContent({{ $item->id }})" style="cursor: pointer;">
                                                    <div class="d-flex align-items-center">
                                                        <div class="flex-shrink-0">
                                                            <img src="{{ asset('backend/giphy1.gif') }}" alt="" class="avatar-xs rounded-3">
                                                        </div>
                                                        <div class="flex-grow-1 ms-2">
                                                                <h6 class="mb-1">{{$item->gradeClass->grade}} - {{$item->subject->name}}</h6>
                                                                <p class="text-muted mb-0">{{$item->topic}}</p>
                                                            
                                                        </div>
                                                     
                                                    </div>
                                                </li>
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <!-- end nav -->
                        </div> <!-- end col-->
                        <div class="col-lg-6">
                            <div class="px-lg-4">
                                <div class="tab-content">
                                    <div class="tab-pane fade show active" id="v-pills-bill-info" role="tabpanel"
                                        aria-labelledby="v-pills-bill-info-tab">
                                        <div>
                                            <h5>Basic Info</h5>
                                            <p class="text-muted">Fill all information below</p>
                                        </div>

                                        <div>
                                            <div class="row g-3">

                                                <div class="col-sm-6">
                                                    <label class="form-label" title="Select the Grade/Class you want to Generate Content For?">Grade/Class</label>
                                                    <select id="grade_id" class="form-select" name="grade_id" data-choices aria-label="Default select grade">
                                                        <option selected="">Select Grade/Class</option>
                                                        @foreach($classes as $item)
                                                            <option value="{{ $item->id }}">{{ $item->grade }}</option>
                                                        @endforeach
                                                    </select>
                                                    <div class="invalid-feedback">Please enter a first name</div>
                                                </div>
                                                
                                                <div class="col-sm-6">
                                                    <label class="form-label" title="Select the Subject">Subject</label>
                                                    <input list="subjectOptions" id="subjectInput" class="form-select" name="subject_name" placeholder="Choose or type subject" aria-label="Default select subject">
                                                    <datalist id="subjectOptions"></datalist>
                                                    
                                                    <!-- Hidden input to store the selected subject ID -->
                                                    <input type="hidden" id="subjectId" name="subject_id">
                                                    
                                                    <div class="invalid-feedback">Please enter a subject</div>
                                                </div>
                                                
                                                <div class="col-sm-6">
                                                    <label for="age_group" class="form-label" title="Select The age of the student">Age</label>
                                                    <input class="form-select" list="ageOptions" id="age_group" name="age" placeholder="Choose or type your age" aria-label="Select or type age">
                                                        <datalist id="ageOptions">
                                                            <option value="4">
                                                            <option value="5">
                                                            <option value="6">
                                                            <option value="7">
                                                            <option value="8">
                                                            <option value="9">
                                                            <option value="10">
                                                            <option value="11">
                                                            <option value="12">
                                                            <option value="13">
                                                            <option value="14">
                                                            <option value="15">
                                                            <option value="16">
                                                            <option value="17">
                                                            <option value="18">
                                                            <option value="19">
                                                            <option value="20">
                                                                
                                                        </datalist>
                                                </div>                                               

                                                <div class="col-sm-6">
                                                    <label class="form-label" title="Difficulty level of the content">Content Difficulty Level</label>
                                                    <select class="form-select" name="difficulty_level" data-choices aria-label="Default select difficulty">
                                                        <option selected="">Select Level</option>
                                                        <option value="Easy">Easy</option>
                                                        <option value="Medium">Medium</option>
                                                        <option value="Difficult">Difficult</option>
                                                        <option value="Exceptional">Exceptional</option>
                                                       
                                                    </select>
                                                    <div class="invalid-feedback">Please enter a first name</div>
                                                </div>

                                                <div class="col-sm-6">
                                                    <label for="lastName" class="form-label" title="Tone of the Content">Tone</label>
                                                    <select class="form-select" name="tone" data-choices aria-label="Default select tone">
                                                        <option selected="">Choose Tone</option>
                                                        <option value="Kids">Kids</option>
                                                        <option value="Adult">Adult</option>                  
                                                        
                                                    </select>
                                                </div>

                                                <div class="col-sm-6">
                                                    <label for="lastName" class="form-label" title="Simplicity of the Content">Persona</label>
                                                    <select class="form-select" name="persona" data-choices aria-label="Default select persona">
                                                        <option selected="">Choose Persona</option>
                                                        <option value="Very Simple">Very Simple</option>
                                                        <option value="Step by Step guide">Step by Step guide</option>
                                                        <option value="Simple">Simple</option>
                                                        <option value="Somewhat Difficulty">Somewhat Difficulty</option>
       
                                                    </select>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="d-flex align-items-start gap-3 mt-4">
                                            <button type="button"
                                                class="btn gradient-btn-11 btn-label right ms-auto nexttab"
                                                data-nexttab="v-pills-bill-address-tab"><i
                                                    class="ri-arrow-right-line label-icon align-middle fs-16 ms-2"></i>Go
                                                to Additional Info</button>
                                        </div>

                                        <br>
                                       
                                     
                                    </div>
                                    <!-- end tab pane -->
                                    <div class="tab-pane fade" id="v-pills-bill-address" role="tabpanel"
                                        aria-labelledby="v-pills-bill-address-tab">
                                        <div>
                                            <h5>Class Materials Info</h5>
                                            <p class="text-muted">Fill all information below</p>
                                        </div>

                                        <div>
                                            <div class="row g-3">
                                                <div class="col-12">
                                                    <label for="address" class="form-label" title="What is the Topic of the Content">Topic</label>
                                                    <input type="text" class="form-control" id="topic" name="topic"
                                                        placeholder="Briefly state the main topic" required>
                                                    <div class="invalid-feedback">What is the Content Topic about?</div>
                                                </div>

                                                <div class="col-12">
                                                    <label for="additional_details" class="form-label" title="Give a little more brief about the Topic">Topic Description
                                                        <span class="text-muted">(Optional)</span>
                                                    </label>
                                                    <textarea class="form-control" id="additional_details" name="additional_details" rows="2" 
                                                              placeholder="Provide a short description or key points to cover"></textarea>
                                                </div>  

                                                <div class="col-6">
                                                    <label for="content_type" class="form-label" title="What is the tye of the Content?">Content Type</label>
                                                    <input class="form-select" list="contentOption" id="content_type" name="content_type" placeholder="Select Content Type" aria-label="Select or type Content Type">
                                                        <datalist id="contentOption">
                                                            <option value="story">
                                                            <option value="book">
                                                            <option value="passage">
                                                            <option value="poem">
                                                            <option value="worksheet">
                                                          
                                                        </datalist>
                                                </div>

                                                <div class="col-6">
                                                    <label for="language_style" class="form-label" title="What is the Language Style">Language Syle</label>
                                                    <input class="form-select" list="languageOption" id="language_style" name="language_style" placeholder="Select Language Style" aria-label="Select or type Language Style">
                                                        <datalist id="languageOption">
                                                            <option value="Simple (suitable for young readers)">
                                                            <option value="Conversational">
                                                            <option value="Formal">
                                                            <option value="Academic">                                                            
                                                        
                                                        </datalist>
                                                </div>

                                                <div class="col-12">
                                                    <label for="desired_length" class="form-label" title="What is the desired length of the Content">Dersired Length</label>
                                                    <input class="form-select" list="lengthOption" id="desired_length" name="desired_length" placeholder="Choose your desired length for the content" aria-label="Select or type your Desired Length">
                                                        <datalist id="lengthOption">
                                                            <option value="Short (1-2 pages)">
                                                            <option value="Medium (3-5 pages)">
                                                            <option value="Long (6+ pages)">
                                                         
                                                        </datalist>
                                                </div>
                                                
                                                <!-- Checkbox to toggle question generation -->
                                                <div class="form-group">
                                                    <label for="generate_questions">
                                                        <input type="checkbox" id="generate_questions" name="generate_questions" value="1" onchange="toggleQuestionFields()"> 
                                                        Generate Questions Based on Content
                                                    </label>
                                                </div>

                                                <!-- Hidden fields for question generation, shown only if checkbox is checked -->
                                                <div id="question_fields" style="display: none;">
                                                   
                                                    <div class="row g-3">
                                                         <!-- Number of Questions -->
                                                        <div class="col-4">
                                                            <label for="number_of_questions" title="How many question you want to Include">Number of Questions</label>
                                                            <input type="number" id="number_of_questions" name="number_of_questions" class="form-control">
                                                        </div>
                                                        <!-- Type of Questions Dropdown and Manual Input -->
                                                        <div class="col-4">
                                                            <label for="question_type" class="form-label" title="What should be the Question Type">Question Type</label>
                                                            <input class="form-select" list="questionTypeOption" id="question_type" name="question_type" placeholder="Choose question Type" aria-label="Choose question Type">
                                                                <datalist id="questionTypeOption">
                                                                    <option value="Multiple Choice">
                                                                    <option value="True/False">
                                                                    <option value="Short Answer">
                                                                    <option value="Matching">
                                                                    <option value="Fill-in-the-Blank">
                                                                    <option value="Essay">
                                                        
                                                                </datalist>
                                                        </div>
                                                        <!-- Difficulty Level Dropdown -->
                                                        <div class="col-4">
                                                            <label for="question_difficulty_level" title="What Should be the difficulty level of the questions">Difficulty Level</label>
                                                            <select id="question_difficulty_level" name="question_difficulty_level" class="form-control">
                                                                <option value="easy">Easy</option>
                                                                <option value="medium">Medium</option>
                                                                <option value="hard">Hard</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                {{-- Generate Question related fields End  --}}

                                                {{-- Generate Answer Checkbox --}}
                                                <div class="form-group">
                                                    <label for="generate_answer">
                                                        <input type="checkbox" id="generate_answer" name="generate_answer" value="1"> 
                                                        Generate Answer
                                                    </label>
                                                </div>
                                                 {{-- Generate Answer Checkbox Ends --}}


                                                <!-- Checkbox to toggle image generation -->
                                                <div class="form-group">
                                                    <label for="generate_images">
                                                        <input type="checkbox" id="generate_images" name="generate_images" value="1" onchange="toggleImageFields()"> 
                                                        Generate Images Based on Content
                                                    </label>
                                                </div>

                                                <!-- Hidden fields for question generation, shown only if checkbox is checked -->
                                                <div id="image_fields" style="display: none;">
                                                   
                                                    <div class="row g-3">
                                                      
                                                        <!-- Type of Image Dropdown and Manual Input -->
                                                        <div class="col-4">
                                                            <label for="image_type" class="form-label" title="What type of Image you want to Generate">Type of Image</label>
                                                            <input class="form-select" list="imageTypeOption" id="image_type" name="image_type" placeholder="Select Image Type" aria-label="Select Image Type">
                                                                <datalist id="imageTypeOption">
                                                                    <option value="Illustrations related to the story or topic">
                                                                    <option value="Diagrams or charts">
                                                                    <option value="Mathematical figures or graphs">
                                                                    <option value="Scientific illustrations">
                                                                    <option value="Customized images based on specific descriptions">
                                                        
                                                                </datalist>
                                                        </div>

                                                        {{-- Number of Image --}}
                                                        <div class="col-2">
                                                            <label for="number_of_images" title="How many Images you want to Generate">Number of Images</label>
                                                            <input type="number" id="number_of_images" name="number_of_images" class="form-control">
                                                        </div>

                                                        <!-- Image Placement -->
                                                        <div class="col-3">
                                                            <label for="image_placement" class="form-label" title="What place you want to include the Image">Placement of Image</label>
                                                            <input class="form-select" list="imagePlacementOption" id="image_placement" name="image_placement" placeholder="Select Image Placement" aria-label="Select Image Placement">
                                                                <datalist id="imagePlacementOption">
                                                                    <option value="Beginning of the content">
                                                                    <option value="Throughout the content">
                                                                    <option value="End of the content">
                                                                    <option value="Next to related text or paragraphs">
                                                                   
                                                                </datalist>
                                                        </div>

                                                         <!-- Image Style -->
                                                         <div class="col-3">
                                                            <label for="image_style" class="form-label" title="What should be the Style of the Image">Image Style</label>
                                                            <input class="form-select" list="imageStyleOption" id="image_style" name="image_style" placeholder="Select Image Style" aria-label="Select Image Style">
                                                                <datalist id="imageStyleOption">
                                                                    <option value="Cartoon / Animated">
                                                                    <option value="Realistic">
                                                                    <option value="Sketches">
                                                                    <option value="Infographics">
                                                                   
                                                                </datalist>
                                                        </div>

                                                    </div>
                                                </div>

                                                {{-- Accordation Collapse --}}
                                                <div class="accordion accordion-flush col-12 m-auto mt-2" id="accordionFlushExample">
                                                    <div class="accordion-item" id="advance-setting-tour">
                                                        <h2 class="accordion-header" id="flush-headingOne">
                                                            <button class="accordion-button collapsed bg-secondary-subtle" type="button" data-bs-toggle="collapse"
                                                                data-bs-target="#flush-collapseOne" aria-expanded="false" aria-controls="flush-collapseOne">
                                                                Additional Settings
                                                            </button>
                                                        </h2>
                                                        <div id="flush-collapseOne" class="accordion-collapse collapse" aria-labelledby="flush-headingOne"
                                                            data-bs-parent="#accordionFlushExample">
                                                            <div class="accordion-body">
        
                                                                <div class="row g-3">
                                                                    
                                                                    <div class="col-12">
                                                                        <label for="negative_word" class="form-label">Negative Word <span class="text-muted">(Optional)</span></label>
                                                                        <input type="text" class="form-control" id="negative_word" name="negative_word"
                                                                            placeholder="Negative words that you don't want to include in your content" required>
                                                                        <div class="invalid-feedback">Which words you don't want to include in your content?</div>
                                                                    </div>
                                                                    
                                                                    <div class="col-3">
                                                                        <label for="download_format">Download Format</label>
                                                                        <select name="download_format" class="form-control" id="download_format">
                                                                            <option disabled selected="">Enter Download Format</option>
                                                                            <option value="standard">PDF</option>
                                                                            <option value="hd">DOCX</option>
                                                                        </select>
                                                                    </div>                                                        
        
                                                                    <div class="col-9">
                                                                        <label for="additional_instruction" class="form-label">Additional Insruction <span class="text-muted">(Optional)</span></label>
                                                                        <input type="text" class="form-control" id="additional_instruction" name="additional_instruction"
                                                                            placeholder="Negative words that you don't want to include in your content" required>
                                                                        <div class="invalid-feedback">Which words you don't want to include in your content?</div>
                                                                    </div>
                                                                    
                                                                  
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                {{-- Accordation Collapse End --}}

                                            </div> 
                                        </div>

                                        <div class="d-flex align-items-start gap-3 mt-4">
                                            <button type="button" class="btn gradient-btn-9 btn-label previestab"
                                                data-previous="v-pills-bill-info-tab"><i
                                                    class="ri-arrow-left-line label-icon align-middle fs-16 me-2"></i>
                                                Back to Basic Info</button>
                                            <button type="button"
                                                class="btn gradient-btn-11 btn-label right ms-auto nexttab"
                                                data-nexttab="v-pills-payment-tab"><i
                                                    class="ri-arrow-right-line label-icon align-middle fs-16 ms-2"></i>Go
                                                to Reference</button>
                                        </div>
                                    </div>
                                    <!-- end tab pane -->
                                    <div class="tab-pane fade" id="v-pills-payment" role="tabpanel"
                                        aria-labelledby="v-pills-payment-tab">
                                        <div>
                                            <h5>Topic Reference</h5>
                                            <p class="text-muted">Fill all information below</p>
                                        </div>

                                        <div>
                                            <div class="row gy-3">
                                               
                                                <div class="col-12">
                                                    <label for="address2" class="form-label">Examples</label>
                                                    <input type="text" class="form-control" id="examples" name="examples"
                                                        placeholder="Examples about the Topic" />
                                                </div>
                                                <div class="col-12">
                                                    <label for="address2" class="form-label">Reference</label>
                                                    <input type="file" class="form-control" id="reference" name="reference"
                                                        placeholder="Reference" />
                                                </div>
                                            </div>
                                        </div>

                                        <div class="d-flex align-items-start gap-3 mt-4">
                                            <button type="button" class="btn gradient-btn-9 btn-label previestab"
                                                data-previous="v-pills-bill-address-tab"><i
                                                    class="ri-arrow-left-line label-icon align-middle fs-16 me-2"></i>
                                                Back to Reference</button>
                                            <button type="button"
                                                class="btn gradient-btn-11 btn-label right ms-auto nexttab generateButton"
                                                data-nexttab="v-pills-finish-tab"><i
                                                    class="ri-arrow-right-line label-icon align-middle fs-16 ms-2"></i>
                                                Generate Content</button>
                                        </div>
                                    </div>
                                    <!-- end tab pane -->
                                    <div class="tab-pane fade" id="v-pills-finish" role="tabpanel"
                                        aria-labelledby="v-pills-finish-tab">
                                        <div class="text-center pt-4 pb-2 center-content">
                                            <div class="mb-4">
                                                <lord-icon id="almost"
                                                    src="https://cdn.lordicon.com/gzdzdtov.json"
                                                    trigger="loop"
                                                    state="loop-cycle"
                                                    style="width:100px;height:100px">
                                                </lord-icon>
                                            </div>
                                            <h5 id="h55">Standby while we create the content for you!</h5>
                                            <p class="chunkss" id="chunkss"></p>
                                            <div id="download-container" class="mt-3"></div>

                                        </div>

                                    </div>
                                    <!-- end tab pane -->
                                </div>
                                <!-- end tab content -->
                            </div>
                        </div>
                        <!-- end col -->

                        <div class="col-3">
                            <img src="{{ asset('build/images/edu_info.jpg') }}" width="100%" alt="">
                        </div>

                    </div>
                    <!-- end row -->
                </form>
            </div>
        </div>
        <!-- end -->
    </div>
    <!-- end col -->
</div>


{{-- COMMON MODAL SHOULD  --}}
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
                    <i class="ri-close-line me-1 align-middle"></i> Close
                </a>
            </div>
            
            
        </div>
    </div>
</div> 


@endsection

@section('script')

    <script src="{{ URL::asset('build/js/pages/form-wizard.init.js') }}"></script>
    <script src="{{ URL::asset('build/js/app.js') }}"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- Include marked.js -->
    <script src="https://cdn.jsdelivr.net/npm/marked/marked.min.js"></script>


    <!-- Include DOMPurify for sanitizing HTML -->
    <script src="https://cdn.jsdelivr.net/npm/dompurify@2.4.0/dist/purify.min.js"></script>

    <script>
        function toggleQuestionFields() {
            var checkbox = document.getElementById('generate_questions');
            var questionFields = document.getElementById('question_fields');
            if (checkbox.checked) {
                questionFields.style.display = 'block';
            } else {
                questionFields.style.display = 'none';
            }
        }

        function toggleImageFields() {
            var checkbox = document.getElementById('generate_images');
            var imageFields = document.getElementById('image_fields');
            if (checkbox.checked) {
                imageFields.style.display = 'block';
            } else {
                imageFields.style.display = 'none';
            }
        }
    </script>

    <script>
        $(document).ready(function() {
            // Mapping of grades to ages
            const gradeToAge = {
                1: 5,
                2: 6,
                3: 7,
                4: 8,
                5: 9,
                6: 10,
                7: 11,
                8: 12,
                9: 13,
                10: 14,
                11: 15,
                12: 16,
                
            };
    
            $('#grade_id').on('change', function() {
                var gradeId = $(this).val();

                // Update the age input based on the selected grade
                if (gradeToAge[gradeId]) {
                    $('#age_group').val(gradeToAge[gradeId]); // Set the age input value
                } else {
                    $('#age_group').val(''); // Clear the age input if grade not found
                }

               // Existing code to populate subjects
                if (gradeId) {
                    $.ajax({
                        url: '/education/get-subjects/' + gradeId,
                        type: 'GET',
                        success: function(data) {
                            $('#subjectOptions').empty(); // Clear the subjects datalist

                            // Populate subjects based on response
                            $.each(data, function(key, subject) {
                                $('#subjectOptions').append('<option data-id="' + subject.id + '" value="' + subject.name + '">');
                            });
                        }
                    });
                } else {
                    $('#subjectOptions').empty(); // Clear the subjects datalist if no grade selected
                    $('#subjectOptions').append('<option value="Select Subject">'); // Default option
                }

                // Detect when a subject is selected and update the hidden subject ID input
                $('#subjectInput').on('input', function() {
                    var inputValue = $(this).val();
                    var selectedOption = $('#subjectOptions option').filter(function() {
                        return $(this).val() === inputValue;
                    });

                    var selectedId = selectedOption.data('id'); // Get the subject ID from the selected option
                    $('#subjectId').val(selectedId); // Set the hidden input value to the subject ID
                });

            });

        });
    </script>
    
    <script>
        // Format content using marked.js and DOMPurify
        function formatContent(content) {
            // Set options for marked.js
            marked.setOptions({
                breaks: true,  // Enable line breaks
                gfm: true      // Enable GitHub Flavored Markdown
            });
    
            // Parse Markdown to HTML
            let formattedContent = marked.parse(content);
    
            // Sanitize the HTML to prevent XSS
            formattedContent = DOMPurify.sanitize(formattedContent);
    
            return formattedContent;
        }
    </script>
    
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const form = document.querySelector(".vertical-navs-step");
            const generateButton = document.querySelector(".generateButton");
            console.log("Form inside");

            generateButton.addEventListener("click", function () {
                console.log("button clicked");
                const formData = new FormData(form);
    
                // Step 1: Fetch and display content stream
                fetch(form.getAttribute("action"), {
                    method: form.getAttribute("method"),
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    },
                    body: formData
                })
                .then(response => {
                    console.log("inside response");
                    const reader = response.body.getReader();
                    const decoder = new TextDecoder();
                    let content = "";  // Variable to store the entire content
    
                    const processStream = ({ done, value }) => {
                        console.log("insde process stream");
                        if (done) {
                            // Hide loading icon once done
                            const lordIconElement = document.getElementById('almost');
                            if (lordIconElement) {
                                lordIconElement.style.display = 'none';
                            }
    
                            // Change h5 content to "Your content is ready"
                            const h5Element = document.querySelector("#h55");
                            if (h5Element) {
                                h5Element.textContent = "Your content is ready!";
                            }
    
                            // Replace the p tag content with the full formatted content
                            const pElement = document.querySelector("#chunkss");
                            if (pElement) {
                                pElement.innerHTML = content;  // Format and replace content
                            }
    
                            console.log("Stream complete");

                         // Step 2: Add download button for the streamed content
                const downloadButton = document.createElement('a');
                downloadButton.textContent = "Download Content";
                downloadButton.className = "btn gradient-btn-3 mt-3";

                // Create the dynamic download URL (similar to the modal logic)
                const contentId = response.headers.get('X-Generated-Content-ID'); // Assuming backend 
                if (contentId) {
                    const downloadUrl = `{{ url('education/content') }}/${contentId}/download`;
                    downloadButton.href = downloadUrl;
                } else {
                    console.error("Content ID not returned by the backend");
                }

                // Step 2: Add Copy Button
                const copyButton = document.createElement('button');
copyButton.textContent = "Copy Content";
copyButton.className = "btn gradient-btn-2 mt-3 ml-2 copy-toast-btn"; // Style for the button

copyButton.addEventListener("click", function () {
    // Get the content of the #chunkss element
    const pElement = document.querySelector("#chunkss");
    const contentToCopy = pElement.innerText; // Only copy the text content

    // Create a temporary textarea element
    const textArea = document.createElement('textarea');
    textArea.value = contentToCopy; // Set the text content to the textarea
    document.body.appendChild(textArea); // Append it to the DOM

    // Select the content of the textarea
    textArea.select();

    try {
        // Execute the copy command
        const successful = document.execCommand('copy');
        if (successful) {
            toastr.success('Content copied to clipboard!');
        } else {
            alert('Failed to copy content.');
        }
    } catch (err) {
        console.error('Error while copying content:', err);
    }

    // Remove the textarea from the DOM
    document.body.removeChild(textArea);
});


                const downloadContainer = document.getElementById('download-container');
                if (downloadContainer) {
                    downloadContainer.innerHTML = ""; // Clear any existing buttons
                    downloadContainer.appendChild(downloadButton); // Append the new button
                    downloadContainer.appendChild(copyButton);
                }
    
                            // Step 2: Fetch and display images after content is streamed
                            // fetchImages();
    
                            return;
                        }
    
                        const parentDiv = document.querySelector('.center-content');
                        if (parentDiv) {
                            parentDiv.classList.remove('text-center');
                            parentDiv.classList.remove('pt-4');
                        }
    
                        // Append new chunks to content
                        content += decoder.decode(value, { stream: true });
    
                        // Optionally: Show the formatted content progressively while streaming
                        document.querySelector("#chunkss").innerHTML = content;
    
                        // Continue reading more chunks
                        return reader.read().then(processStream);
                    };
    
                    return reader.read().then(processStream);
                })
                .catch(error => {
                    console.error('Error:', error);
                    const h5Element = document.querySelector("#h55");
                    h5Element.textContent = "There was an error processing your request.";
                });
            });
        });

    

// modal script
document.addEventListener('DOMContentLoaded', function () {
    const contentItems = document.querySelectorAll('.content-item');

    contentItems.forEach(item => {
        item.addEventListener('click', function () {
            const title = item.getAttribute('data-title');
            const content = item.getAttribute('data-content');

            document.getElementById('contentModalLabel').textContent = title;
            document.getElementById('modalContent').textContent = content;
        });
    });
});


// Should be Included as common script
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
    
    



    </script>


@endsection