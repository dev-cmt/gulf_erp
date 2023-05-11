<x-app-layout>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Related Information</h4>
                    <a href="{{route('info_related.index')}}" class="btn btn-sm btn-primary"><i class="fa fa-reply"></i><span class="btn-icon-add"></span>Back</a>
                </div>

                <div class="card-body">
                    <div id="accordion-eleven" class="accordion accordion-rounded-stylish accordion-bordered">
                        
                        <div class="col-xl-6 mr-4">
                            <div class="form-group row">
                                <label class="col-lg-4 col-form-label" for="val-skill">Choose Member
                                    <span class="text-danger">*</span>
                                </label>
                                <div class="col-lg-7">
                                    <select class="dropdwon_select" name="user_id">
                                        <option selected disabled>Please select</option>
                                        <option value="1">Gulf-ERP</option>
                                        {{-- @foreach ($ecommittee as $row)
                                            <option value="{{$row->id}}">{{$row->name}}</option>
                                        @endforeach --}}
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="accordion__item">
                            <div class="accordion__header accordion__header--primary collapsed" data-toggle="collapse" data-target="#rounded-stylish_collapseOne" aria-expanded="false">
                                <span class="accordion__header--icon"></span>
                                <span class="accordion__header--text">Educational Information</span>
                                <span class="accordion__header--indicator"></span>
                            </div>
                            <div id="rounded-stylish_collapseOne" class="accordion__body collapse" data-parent="#accordion-eleven" style="">
                                @if (session()->has('success'))
                                    <strong class="text-success">{{session()->get('success')}}</strong>
                                @endif
                                <form class="form-valide" data-action="{{ route('info_related.store') }}" method="POST" enctype="multipart/form-data" id="add-user-form">
                                    @csrf
                                    <div class="row accordion__body--text">
                                        <div class="col-xl-6">
                                            <div class="form-group row">
                                                <label class="col-lg-4 col-form-label" for="qualification">Qualification
                                                    <span class="text-danger">*</span>
                                                </label>
                                                <div class="col-lg-7">
                                                    <select class="dropdwon_select" name="qualification">
                                                        <option value="0" selected>Please select</option>
                                                        <option value="1">SSC</option>
                                                        <option value="2">HSC</option>
                                                    </select>                                                    
                                                    @error('qualification')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-xl-6">
                                            <div class="form-group row">
                                                <label class="col-lg-4 col-form-label">Passing Year</label>
                                                <div class="col-lg-7">
                                                    <input type="date" class="form-control @error('passing_year') is-invalid @enderror" id="passing_year" name="passing_year" placeholder="" value="{{old('passing_year')}}"/>                         
                                                    @error('passing_year')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-xl-6">
                                            <div class="form-group row">
                                                <label class="col-lg-4 col-form-label">Institute Name
                                                    <span class="text-danger">*</span>
                                                </label>
                                                <div class="col-lg-7">
                                                    <input type="text" class="form-control @error('institute_name') is-invalid @enderror" id="institute_name" name="institute_name" placeholder="" value="{{old('institute_name')}}">                                     
                                                    @error('institute_name')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-xl-6">
                                            <div class="form-group row">
                                                <label class="col-lg-4 col-form-label">Grade</label>
                                                <div class="col-lg-7">
                                                    <input type="text" class="form-control @error('grade') is-invalid @enderror" id="grade" name="grade" placeholder="" value="{{old('grade')}}">                                     
                                                    @error('grade')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-xl-6">
                                            <div class="form-group row">
                                                <div class="col-lg-8 ml-auto">
                                                    <button type="submit" class="btn btn-sm btn-primary">Submit</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div class="accordion__item">
                            <div class="accordion__header accordion__header--info collapsed" data-toggle="collapse" data-target="#rounded-stylish_collapseTwo" aria-expanded="false">
                                <span class="accordion__header--icon"></span>
                                <span class="accordion__header--text">Work experience</span>
                                <span class="accordion__header--indicator"></span>
                            </div>
                            <div id="rounded-stylish_collapseTwo" class="accordion__body collapse" data-parent="#accordion-eleven" style="">
                                <div class="accordion__body--text">
                                    Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod.
                                </div>
                            </div>
                        </div>
                        <div class="accordion__item">
                            <div class="accordion__header accordion__header--success collapsed" data-toggle="collapse" data-target="#rounded-stylish_collapseThree" aria-expanded="false">
                                <span class="accordion__header--icon"></span>
                                <span class="accordion__header--text">Banking Information</span>
                                <span class="accordion__header--indicator"></span>
                            </div>
                            <div id="rounded-stylish_collapseThree" class="accordion__body collapse" data-parent="#accordion-eleven" style="">
                                <div class="accordion__body--text">
                                    Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod.
                                </div>
                            </div>
                        </div>


                        <div class="accordion__item">
                            <div class="accordion__header accordion__header--success collapsed" data-toggle="collapse" data-target="#rounded-stylish_collapseThree" aria-expanded="false">
                                <span class="accordion__header--icon"></span>
                                <span class="accordion__header--text">Nominee Information</span>
                                <span class="accordion__header--indicator"></span>
                            </div>
                            <div id="rounded-stylish_collapseThree" class="accordion__body collapse" data-parent="#accordion-eleven" style="">
                                <div class="accordion__body--text">
                                    Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod.
                                </div>
                            </div>
                        </div>
                        <div class="accordion__item">
                            <div class="accordion__header accordion__header--success collapsed" data-toggle="collapse" data-target="#rounded-stylish_collapseThree" aria-expanded="false">
                                <span class="accordion__header--icon"></span>
                                <span class="accordion__header--text">Documents</span>
                                <span class="accordion__header--indicator"></span>
                            </div>
                            <div id="rounded-stylish_collapseThree" class="accordion__body collapse" data-parent="#accordion-eleven" style="">
                                <div class="accordion__body--text">
                                    Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod.
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
            </div>
        </div>
    </div>

    <div redirect-action="{{ route('coming_soon') }}" id="redirect"></div>

    <script>
        $(document).ready(function(){
            var form = '#add-user-form';

            $(form).on('submit', function(event){
                event.preventDefault();

                var url = $(this).attr('data-action');
                var src = $('#redirect').attr('redirect-action');

                $.ajax({
                    url: url,
                    method: 'POST',
                    data: new FormData(this),
                    dataType: 'JSON',
                    contentType: false,
                    cache: false,
                    processData: false,
                    success:function(response)
                    {
                        $(form).trigger("reset");
                        // alert(response.success);
                        swal("Success Message Title", "Well done, you pressed a button", "success")
                        // window.location.href = src;
                    },
                    error: function(response) {
                    }
                });
            });

        });
    </script>
</x-app-layout>
    