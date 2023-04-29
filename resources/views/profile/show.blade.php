<x-app-layout>
    <style>
        /*__________________Image Profile______________________*/
        .avatar-upload {
            position: relative;
            max-width: 205px;
            margin: 20px auto;
            margin-top: -95px;
        }
        .avatar-upload .avatar-edit {
            position: absolute;
            right: 25px;
            z-index: 1;
            top: 10px;
        }
        .avatar-upload .avatar-edit input {
            display: none;
        }
        .avatar-upload .avatar-edit input + label {
            display: inline-block;
            width: 34px;
            height: 34px;
            margin-bottom: 0;
            border-radius: 100%;
            background: #34ad54;
            border: 1px solid transparent;
            box-shadow: 0px 2px 4px 0px rgba(0, 0, 0, 0.12);
            cursor: pointer;
            font-weight: normal;
            transition: all 0.2s ease-in-out;
        }
        .avatar-upload .avatar-edit input + label:hover {
            background: #f1f1f1;
            border-color: #d6d6d6;
        }

        .avatar-edit .profile_save_btn{
            color: #ffffff;
            position: absolute;
            top: 6px;
            left: 0;
            right: 0;
            text-align: center;
            margin: auto;
        }
        .avatar-upload .avatar-preview {
            width: 192px;
            height: 192px;
            position: relative;
            border-radius: 100%;
            border: 6px solid #34ad54;
            box-shadow: 0px 2px 4px 0px rgba(0, 0, 0, 0.1);
        }
        .avatar-upload .avatar-preview > div {
            width: 100%;
            height: 100%;
            border-radius: 100%;
            background-size: cover;
            background-repeat: no-repeat;
            background-position: center;
        }
    </style>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Profile') }}
        </h2>
    </x-slot>

    <!-- row -->
    <div class="row">
        <div class="col-lg-12">
            <div class="profile card card-body px-3 pt-3 pb-0">
                <div class="profile-head">
                    <div class="photo-content">
                        <div class="cover-photo"></div>
                    </div>
                    <div class="profile-info">
                        <div class="avatar-upload">
                            <div class="avatar-edit">
                                <input type='file' class="@error('profile_photo_path') is-invalid @enderror form-control" name="profile_photo_path" id="imageUpload" accept=".png, .jpg, .jpeg" value="{{old('profile_photo_path')}}"/>
                                <label><i class="flaticon-053-heart profile_save_btn"></i></label>
                                @error('profile_photo_path')
                                    <span class="invalid-feedback" role="alert" style="position: absolute;top: 178px;left: -160px;width: 300px;">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <label for="imageUpload" class="avatar-preview">
                                <div id="imagePreview" style="background-image: url('{{asset('public')}}/profile/{{ Auth::user()->profile_photo_path }}');"></div>
                            </label>
                        </div>
                        
                        <div class="profile-details">
                            <div class="profile-name px-3 pt-2">
                                <h4 class="text-primary mb-0">{{Auth::user()->name}}</h4>
                                <p>{{$infoOther->designation}}</p>
                            </div>
                            {{-- <div class="profile-email px-2 pt-2">
                                <h4 class="text-muted mb-0"><a href="/cdn-cgi/l/email-protection" class="__cf_email__" data-cfemail="670e09010827021f060a170b024904080a">[{{Auth::user()->email}}]</a></h4>
                                <p>Email</p>
                            </div> --}}
                            <div class="dropdown ml-auto">
                                <a href="#" class="btn btn-primary light sharp" data-toggle="dropdown" aria-expanded="true"><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="18px" height="18px" viewbox="0 0 24 24" version="1.1"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><rect x="0" y="0" width="24" height="24"></rect><circle fill="#000000" cx="5" cy="12" r="2"></circle><circle fill="#000000" cx="12" cy="12" r="2"></circle><circle fill="#000000" cx="19" cy="12" r="2"></circle></g></svg></a>
                                <ul class="dropdown-menu dropdown-menu-right">
                                    <li class="dropdown-item"><a href="{{route('information.edit')}}"><i class="fa fa-edit text-primary mr-2"></i> Edit</a></li>
                                    {{-- <li class="dropdown-item"><i class="fa fa-ban text-primary mr-2"></i> Block</li> --}}
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-xl-4">
            <div class="row">
                <div class="col-xl-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="text-center">
                                <div class="row">
                                    <div class="col">
                                        <h3 class="m-b-0">Joining Date</h3><span>{{date("j F, Y", strtotime(Auth::user()->created_at))}}</span>
                                    </div>
                                </div>
                                {{-- <div class="mt-4"> 
                                    <a href="javascript:void(0);" class="btn btn-primary mb-1" data-toggle="modal" data-target="#sendMessageModal">Send Message</a>
                                </div> --}}
                            </div>
                            <!-- Modal -->
                            <div class="modal fade" id="sendMessageModal">
                                <div class="modal-dialog modal-dialog-centered" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">Send Message</h5>
                                            <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
                                        </div>
                                        <div class="modal-body">
                                            <form class="comment-form">
                                                <div class="row"> 
                                                    <div class="col-lg-6">
                                                        <div class="form-group">
                                                            <label class="text-black font-w600">Name <span class="required">*</span></label>
                                                            <input type="text" class="form-control" value="Author" name="Author" placeholder="Author">
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6">
                                                        <div class="form-group">
                                                            <label class="text-black font-w600">Email <span class="required">*</span></label>
                                                            <input type="text" class="form-control" value="Email" placeholder="Email" name="Email">
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-12">
                                                        <div class="form-group">
                                                            <label class="text-black font-w600">Comment</label>
                                                            <textarea rows="8" class="form-control" name="comment" placeholder="Comment"></textarea>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-12">
                                                        <div class="form-group mb-0">
                                                            <input type="submit" value="Post Comment" class="submit btn btn-primary" name="submit">
                                                        </div>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-12">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="text-primary d-inline">Aboute me</h5>
                            <p> {{$infoOther->about_me ??  'Update Others Information'}} </p>
                        </div>
                    </div>
                </div>
                
                {{-- <div class="col-xl-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="profile-interest">
                                <h5 class="text-primary d-inline">Interest</h5>
                                <div class="row mt-4 sp4" id="lightgallery">
                                    <a href="{{asset('public/backend')}}/images/profile/2.jpg" data-exthumbimage="{{asset('public/backend')}}/images/profile/2.jpg" data-src="{{asset('public/backend')}}/images/profile/2.jpg" class="mb-1 col-lg-4 col-xl-4 col-sm-4 col-6">
                                        <img src="{{asset('public/backend')}}/images/profile/2.jpg" alt="" class="img-fluid">
                                    </a>
                                    <a href="{{asset('public/backend')}}/images/profile/3.jpg" data-exthumbimage="{{asset('public/backend')}}/images/profile/3.jpg" data-src="{{asset('public/backend')}}/images/profile/3.jpg" class="mb-1 col-lg-4 col-xl-4 col-sm-4 col-6">
                                        <img src="{{asset('public/backend')}}/images/profile/3.jpg" alt="" class="img-fluid">
                                    </a>
                                    <a href="{{asset('public/backend')}}/images/profile/4.jpg" data-exthumbimage="{{asset('public/backend')}}/images/profile/4.jpg" data-src="images/profile/4.jpg" class="mb-1 col-lg-4 col-xl-4 col-sm-4 col-6">
                                        <img src="{{asset('public/backend')}}/images/profile/4.jpg" alt="" class="img-fluid">
                                    </a>
                                    <a href="{{asset('public/backend')}}/images/profile/3.jpg" data-exthumbimage="{{asset('public/backend')}}/images/profile/3.jpg" data-src="{{asset('public/backend')}}/images/profile/3.jpg" class="mb-1 col-lg-4 col-xl-4 col-sm-4 col-6">
                                        <img src="{{asset('public/backend')}}/images/profile/3.jpg" alt="" class="img-fluid">
                                    </a>
                                    <a href="{{asset('public/backend')}}/images/profile/4.jpg" data-exthumbimage="{{asset('public/backend')}}/images/profile/4.jpg" data-src="{{asset('public/backend')}}/images/profile/4.jpg" class="mb-1 col-lg-4 col-xl-4 col-sm-4 col-6">
                                        <img src="{{asset('public/backend')}}/images/profile/4.jpg" alt="" class="img-fluid">
                                    </a>
                                    <a href="{{asset('public/backend')}}/images/profile/2.jpg" data-exthumbimage="{{asset('public/backend')}}/images/profile/2.jpg" data-src="{{asset('public/backend')}}/images/profile/2.jpg" class="mb-1 col-lg-4 col-xl-4 col-sm-4 col-6">
                                        <img src="{{asset('public/backend')}}/images/profile/2.jpg" alt="" class="img-fluid">
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div> --}}
            </div>
        </div>
        <div class="col-xl-8">
            <div class="card">
                <div class="card-body">
                    <div class="profile-tab">
                        <div class="custom-tab-1">
                            <ul class="nav nav-tabs">
                                <li class="nav-item"><a href="#about-me" data-toggle="tab" class="nav-link active show">Personal Information</a></li>
                                <li class="nav-item"><a href="#info-other" data-toggle="tab" class="nav-link">Other Information</a></li>
                                <li class="nav-item"><a href="#info-profile" data-toggle="tab" class="nav-link">Account Setting</a></li>
                                {{-- <li class="nav-item"><a href="#my-posts" data-toggle="tab" class="nav-link">Posts</a></li> --}}
                            </ul>
                            <div class="tab-content">
                                <div id="about-me" class="tab-pane fade active show">
                                    <div class="pt-4">
                                        <h4 class="text-primary mb-4">Personal Information</h4>
                                        @include('profile.personal_information')
                                    </div>
                                </div>
                                <div id="info-other" class="tab-pane fade">
                                    <div class="pt-3">
                                        <div class="settings-form">
                                            <h4 class="text-primary">Other Information</h4>
                                            @include('profile.info_other')
                                        </div>
                                    </div>
                                </div>
                                <div id="info-profile" class="tab-pane fade">
                                    <div class="pt-3">
                                        <div class="settings-form">
                                            <h4 class="text-primary">Account Setting</h4>
                                            @include('profile.info_profile')
                                        </div>
                                    </div>
                                </div>
                                {{-- <div id="my-posts" class="tab-pane fade">
                                    <div class="my-post-content pt-3">
                                        <div class="post-input">
                                            <textarea name="textarea" id="textarea" cols="30" rows="5" class="form-control bg-transparent" placeholder="Please type what you want...."></textarea> 
                                            <a href="javascript:void(0);" class="btn btn-primary light px-3" data-toggle="modal" data-target="#linkModal"><i class="fa fa-link m-0"></i> </a>
                                            <!-- Modal -->
                                            <div class="modal fade" id="linkModal">
                                                <div class="modal-dialog modal-dialog-centered" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title">Social Links</h5>
                                                            <button type="button" class="close" data-dismiss="modal"><span>&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <a class="btn-social facebook" href="javascript:void(0)"><i class="fa fa-facebook"></i></a>
                                                            <a class="btn-social google-plus" href="javascript:void(0)"><i class="fa fa-google-plus"></i></a>
                                                            <a class="btn-social linkedin" href="javascript:void(0)"><i class="fa fa-linkedin"></i></a>
                                                            <a class="btn-social instagram" href="javascript:void(0)"><i class="fa fa-instagram"></i></a>
                                                            <a class="btn-social twitter" href="javascript:void(0)"><i class="fa fa-twitter"></i></a>
                                                            <a class="btn-social youtube" href="javascript:void(0)"><i class="fa fa-youtube"></i></a>
                                                            <a class="btn-social whatsapp" href="javascript:void(0)"><i class="fa fa-whatsapp"></i></a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <a href="javascript:void(0);" class="btn btn-primary light mr-1 px-3" data-toggle="modal" data-target="#cameraModal"><i class="fa fa-camera m-0"></i> </a>
                                            <!-- Modal -->
                                            <div class="modal fade" id="cameraModal">
                                                <div class="modal-dialog modal-dialog-centered" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title">Upload images</h5>
                                                            <button type="button" class="close" data-dismiss="modal"><span>&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <div class="input-group mb-3">
                                                                <div class="input-group-prepend">
                                                                    <span class="input-group-text">Upload</span>
                                                                </div>
                                                                <div class="custom-file">
                                                                    <input type="file" class="custom-file-input">
                                                                    <label class="custom-file-label">Choose file</label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <a href="javascript:void(0);" class="btn btn-primary" data-toggle="modal" data-target="#postModal">Post</a>
                                            <!-- Modal -->
                                            <div class="modal fade" id="postModal">
                                                <div class="modal-dialog modal-dialog-centered" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title">Post</h5>
                                                            <button type="button" class="close" data-dismiss="modal"><span>&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                             <textarea name="textarea" id="textarea2" cols="30" rows="5" class="form-control bg-transparent" placeholder="Please type what you want...."></textarea>
                                                             <a class="btn btn-primary btn-rounded" href="javascript:void(0)">Post</a>																		 
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="profile-uoloaded-post border-bottom-1 pb-5">
                                            <img src="images/profile/8.jpg" alt="" class="img-fluid w-100">
                                            <a class="post-title" href="post-details.html"><h3 class="text-black">Collection of textile samples lay spread</h3></a>
                                            <p>A wonderful serenity has take possession of my entire soul like these sweet morning of spare which enjoy whole heart.A wonderful serenity has take possession of my entire soul like these sweet morning
                                                of spare which enjoy whole heart.</p>
                                            <button class="btn btn-primary mr-2"><span class="mr-2"><i class="fa fa-heart"></i></span>Like</button>
                                            <button class="btn btn-secondary" data-toggle="modal" data-target="#replyModal"><span class="mr-2"><i class="fa fa-reply"></i></span>Reply</button>
                                        </div>
                                    </div>
                                </div> --}}
                            </div>
                        </div>
                        <!-- Modal -->
                        {{-- <div class="modal fade" id="replyModal">
                            <div class="modal-dialog modal-dialog-centered" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Post Reply</h5>
                                        <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
                                    </div>
                                    <div class="modal-body">
                                        <form>
                                            <textarea class="form-control" rows="4">Message</textarea>
                                        </form>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-danger light" data-dismiss="modal">Close</button>
                                        <button type="button" class="btn btn-primary">Reply</button>
                                    </div>
                                </div>
                            </div>
                        </div> --}}
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--Image Profile-->
    <script>
        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $('#imagePreview').css('background-image', 'url('+e.target.result +')');
                    $('#imagePreview').hide();
                    $('#imagePreview').fadeIn(650);
                }
                reader.readAsDataURL(input.files[0]);
            }
        }
        $("#imageUpload").change(function() {
            readURL(this);
        });
    </script>
</x-app-layout>
