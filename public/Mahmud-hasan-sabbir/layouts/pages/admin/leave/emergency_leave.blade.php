<x-app-layout>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <!-- card header -->
                <div class="card-header">
                    <h4 class="card-title">Emergency Leave</h4>
                </div>
                <!-- card body -->
                <div class="card-body">
                    <div class="form-validation">
                        <!-- this is for validation checking message -->
                        @if (session()->has('success'))
                            <strong class="text-success">{{session()->get('success')}}</strong>
                    @endif
                    <!-- this is from -->
                        <form class="form-valide" action="#" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-xl-6">
                                    <div class="form-group row">
                                        <label class="col-lg-4 col-form-label" for="val-name">Type Employee ID
                                            <span class="text-danger">*</span>
                                        </label>
                                        <div class="col-lg-6">
                                            <input type="number" id="val-name" class="form-control @error('name') is-invalid @enderror" name="name" placeholder="Type your ID.." value="{{old('name')}}">
                                            @error('name')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-lg-4 col-form-label">Start Date
                                            <span class="text-danger">*</span>
                                        </label>
                                        <div class="col-lg-6">
                                            <input type="date" class="form-control @error('date') is-invalid @enderror" name="start_date" placeholder="Enter Date.." value="{{old('date')}}" id="inputOne">
                                            @error('date')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-lg-4 col-form-label">Leave Type
                                            <span class="text-danger">*</span>
                                        </label>
                                        <div class="col-lg-6">
                                            <select class="dropdown_select" name="user_id">
                                                <option selected disabled>Please select</option>
                                                @foreach ($ecommittee as $row)
                                                    <option value="{{$row->id}}">{{$row->leave_type}}</option>
                                                @endforeach
                                            </select>
{{--                                            <select name="leave_type" class="form-control default-select  @error('leave_type') is-invalid @enderror" style="height: 40px;">--}}
{{--                                                <option value="1">Sick Leave</option>--}}
{{--                                                <option value="2">Rest Leave</option>--}}
{{--                                                <option value="3">Festival Leave</option>--}}
{{--                                                <option value="4">Check Leave</option>--}}
{{--                                            </select>--}}
                                            @error('type_number')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-lg-4 col-form-label">Leave Location</label>
                                        <div class="col-lg-6">
                                            <input type="text" class="form-control @error('location') is-invalid @enderror" name="leave_location" placeholder="Enter location.." value="{{old('location')}}">
                                            @error('location')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>

                                </div>
                                <div class="col-xl-6">
                                    <div class="form-group row">
                                        <label class="col-lg-4 col-form-label">Name</label>
                                        <div class="col-lg-6">
{{--                                            <select name="designation" class="form-control default-select  @error('designation') is-invalid @enderror" style="height: 40px;">--}}
{{--                                                <option value="1">CEO</option>--}}
{{--                                                <option value="2">GM</option>--}}
{{--                                                <option value="3">AGM</option>--}}
{{--                                                <option value="4">HR</option>--}}
{{--                                            </select>--}}
                                            @error('designation')
                                            <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-lg-4 col-form-label">End Date
                                            <span class="text-danger">*</span>
                                        </label>
                                        <div class="col-lg-6">
                                            <input type="date" id="inputTwo" class="form-control @error('date') is-invalid @enderror" name="end_date" placeholder="Enter Date.." value="{{old('date')}}">
                                            @error('date')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-lg-4 col-form-label">Leave Contact</label>
                                        <div class="col-lg-6">
                                            <input type="text" class="form-control @error('contact') is-invalid @enderror" name="leave_contact" placeholder="Enter Contact.." value="{{old('contact')}}">
                                            @error('contact')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-lg-4 col-form-label">Purpose</label>
                                        <div class="col-lg-6">
                                            <input type="text" class="form-control @error('purpose') is-invalid @enderror" name="purpose" placeholder="Enter purpose.." value="{{old('purpose')}}">
                                            @error('purpose')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-lg-4 col-form-label"></label>
                                        <div class="col-lg-6">
                                            <input type="submit" class="btn btn-success float-right" name="submit" >
                                            @error('purpose')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>
{{--                                    <a href="" class="btn btn-success float-right">submit</a>--}}
{{--                                    <button type="submit" class="btn btn-success btn-sm  ">Submit</button>--}}
                                </div>
                                <!-- submit button -->
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>


</x-app-layout>

<script>
    $(function () {
        $(".dropdown_select").select2();
    });
</script>


