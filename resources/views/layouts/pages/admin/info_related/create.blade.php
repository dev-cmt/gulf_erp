<x-app-layout>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">New lose member</h4>
                    <a href="{{route('info_related.index')}}" class="btn btn-sm btn-primary"><i class="fa fa-reply"></i><span class="btn-icon-add"></span>Back</a>
                </div>
                <div class="card-body">
                    <div class="form-validation">
                        @if (session()->has('success'))
                            <strong class="text-success">{{session()->get('success')}}</strong>
                        @endif
                        <form class="form-valide" data-action="{{ route('info_related.store') }}" method="POST" enctype="multipart/form-data" id="add-user-form">
                            @csrf
                            <div class="row">
                                <div class="col-xl-6">
                                    <div class="form-group row">
                                        <label class="col-lg-4 col-form-label" for="qualification">Qualification
                                            <span class="text-danger">*</span>
                                        </label>
                                        <div class="col-lg-6">
                                            <input type="text" class="form-control @error('qualification') is-invalid @enderror" id="qualification" name="qualification" placeholder="" value="{{old('qualification')}}">                                     
                                            @error('qualification')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-lg-4 col-form-label">Passing Year</label>
                                        <div class="col-lg-6">
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
                                        <div class="col-lg-6">
                                            <input type="text" class="form-control @error('institute_name') is-invalid @enderror" id="institute_name" name="institute_name" placeholder="" value="{{old('institute_name')}}">                                     
                                            @error('institute_name')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-lg-4 col-form-label">Grade</label>
                                        <div class="col-lg-6">
                                            <input type="text" class="form-control @error('grade') is-invalid @enderror" id="grade" name="grade" placeholder="" value="{{old('grade')}}">                                     
                                            @error('grade')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>
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
                        alert(response.success);
                        window.location.href = src;
                    },
                    error: function(response) {
                    }
                });
            });

        });
    </script>
</x-app-layout>
    