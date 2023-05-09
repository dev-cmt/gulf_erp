<x-app-layout>
    <div class="row">
        <div class="col-12">
            <div class="card">

                <!-- card header -->
                <div class="card-header">
                    <h4 class="card-title">Show Employee</h4>
                    <a href="{{ route('mast_designation.index') }}" class="btn btn-sm btn-primary"><i class="fa fa-reply"></i><span class="btn-icon-add"></span>Back</a>
                </div>

                <!-- card body -->
                <div class="card-body">
                    <div class="form-validation">

                        <!-- this is for validation checking message -->
                        @if (session()->has('success'))
                            <strong class="text-success">{{session()->get('success')}}</strong>
                        @endif

                        <!-- this is from -->
                        <form class="form-valide" action="{{route('must_employee_category.store')}}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-xl-6">

                                    <!-- this is for category name -->
                                    <div class="form-group col">
                                        <label class="row-lg col-form-label">Category Name
                                            <span class="text-danger">*</span>
                                        </label>
                                        <div class="row-lg">
                                            <input type="text" id="cat_name" class="form-control @error('cat_name') is-invalid @enderror" name="cat_name" value="{{$data->cat_name}}" disabled>  

                                            @error('cat_name')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>
                                    
                                    <!-- this is for description -->
                                    <div class="form-group col">
                                        <label class="row-lg col-form-label">Description
                                            <span class="text-danger">*</span>
                                        </label>
                                        <div class="row-lg">
                                            <input type="text" id="description" class="form-control @error('description') is-invalid @enderror" name="description" placeholder="Please Write Something..." value="{{$data->description}}">
                                            @error('description')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="col-xl-6">
                                    <!-- this is for status -->
                                    <div class="form-group col">
                                        <label class="row-lg col-form-label" for="status">Status
                                            <span class="text-danger">*</span>
                                        </label>

                                        <div class="row-lg">
                                            <input type="text" id="status" class="form-control @error('status')is-invalid @enderror" name="status" placeholder="" value="{{ $data->status == 1? 'Active' : 'Inactive' }}" disabled>

                                            @error('dept_head')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
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
</x-app-layout>