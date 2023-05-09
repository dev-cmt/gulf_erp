<x-app-layout>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Employee Register (Fill Up Information)<span class="bg-blue-500 text-white rounded px-1 text-xs py-0.5"></span></h4>
                    {{-- @can('Role create') --}}
                    {{-- <a href="{{ route('lose_member.create') }}" class="btn btn-sm btn-primary"><i class="fa fa-plus"></i><span class="btn-icon-add"></span>Create</a> --}}
                    {{-- @endcan --}}
                </div>
                <div class="card-body">
                    <form class="row" action="{{ route('info_employee.store') }}" method="POST">
                        @csrf
                        <div class="col-xl-6">
                            <div class="form-group row">
                                <label class="col-lg-4 col-form-label">Employee Name
                                    <span class="text-danger">*</span>
                                </label>
                                <div class="col-lg-7">
                                    <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror" value="{{old('name')}}" placeholder="">
                                    @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-6">
                            <div class="form-group row">
                                <label class="col-lg-4 col-form-label">Email
                                    <span class="text-danger">*</span>
                                </label>
                                <div class="col-lg-7">
                                    <input type="email" name="email" id="email" class="form-control @error('email') is-invalid @enderror" value="{{old('email')}}" placeholder="">
                                    @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-6">
                            <div class="form-group row">
                                <label class="col-lg-4 col-form-label">Contact Number
                                    <span class="text-danger">*</span>
                                </label>
                                <div class="col-lg-7">
                                    <input type="number" name="contact_number" id="contact_number" class="form-control @error('contact_number') is-invalid @enderror" value="{{old('contact_number')}}" placeholder="">
                                    @error('contact_number')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-6">
                            <div class="form-group row">
                                <label class="col-lg-4 col-form-label">Password
                                    <span class="text-danger">*</span>
                                </label>
                                <div class="col-lg-7">
                                    <input type="text" name="password" id="password" class="form-control @error('password') is-invalid @enderror" value="12345678" placeholder="">
                                    @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="col-xl-12">
                            <button type="submit" class="btn btn-sm btn-primary">User Create</button>
                        </div>
                    </form>
                </div>

                <div class="card-body">
                    <div class="table-responsive">
                        <table id="example3" class="display" style="min-width: 845px">
                            <thead>
                                <tr>
                                    <th></th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Number</th>
                                    <th class="text-center">Fill Up Information</th>
                                    <th class="text-right pr-4">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($user as $row)
                                <tr>
                                    <td class="sorting_1"><img class="rounded-circle" src="{{asset('public')}}/lose_member/{{ $row->image }}" width="35" height="35" alt=""></td>
                                    <td>{{ $row->name }}</td>
                                    <td>{{ $row->email}}</td>
                                    <td>{{ $row->contact_number}}</td>
                                    <td class="text-center">
                                        <a href="{{ route('info_employee_prsonal.create', $row->id) }}" class="btn btn-success btn-xs mr-2">Personal Information</a>
                                        <a href="{{ route('info_employee_related.create', $row->id) }}" class="btn btn-success btn-xs mr-2">Related Information</a>
                                    </td>
                                    <td class="d-flex justify-content-end">
                                        @can('User delete')
                                        <form action="{{ route('info_personal.destroy', $row->id) }}" method="POST">
                                            @method('DELETE')
                                            @csrf
                                            <button class="btn btn-danger shadow btn-xs" onclick="return confirm('Are you sure?');" type="submit"><i class="fa fa-trash"></i></button>
                                        </form>
                                        @endcan
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>
