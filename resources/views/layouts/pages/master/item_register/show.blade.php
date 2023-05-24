<x-app-layout>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <!-- card header -->
                <div class="card-header">
                    <h4 class="card-title">Item Show</h4>
                    <a href="{{ route('mast_item_register.index') }}" class="btn btn-sm btn-primary"><i class="fa fa-reply"></i><span class="btn-icon-add"></span>Back</a>
                </div>
                <!-- card body -->
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <div class="row">
                                            <label for="" class="col-md-4 col-form-label">Box Code
                                                <span class="text-danger">*</span>
                                            </label>
                                            <div class="col-md-8">
                                                <input type="number" class="form-control  @error('box_code') is-invalid @enderror" name="box_code" value="{{$data->box_code}}" min="1" disabled> 
                                                @error('box_code')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="row">
                                            <label for="" class="col-md-4 col-form-label">Gulf Code
                                                <span class="text-danger">*</span>
                                            </label>
                                            <div class="col-md-8">
                                                <input type="number" class="form-control @error('gulf_code') is-invalid @enderror" name="gulf_code" value="{{$data->gulf_code}}" min="1" disabled>  
                                                @error('gulf_code')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror 
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="row">
                                            <label for="" class="col-md-4 col-form-label">Part Name
                                                <span class="text-danger">*</span>
                                            </label>
                                            <div class="col-md-8">
                                                <select class="form-control dropdwon_select" name="mast_item_group_id" disabled>
                                                    @foreach ($item_group as $row)
                                                        <option value="{{$row->id}}" {{$data->mast_item_group_id == $row->id ? 'selected' : '' }} disabled>{{ $row->part_name}}</option>
                                                        @endforeach
                                                </select>
                                            </div> 
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="row">
                                            <label for="" class="col-md-4 col-form-label">Part Number
                                                <span class="text-danger">*</span>
                                            </label>
                                            <div class="col-md-8">
                                                <input type="number" class="form-control @error('part_no') is-invalid @enderror" name="part_no" value="{{$data->part_no}}" disabled>  
                                                @error('part_no')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror 
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="row">
                                            <label for="" class="col-md-4 col-form-label">Unit Type           
                                                <span class="text-danger">*</span>
                                            </label>
                                            <div class="col-md-8">
                                                <select class="form-control dropdwon_select" name="unit_id" disabled>
                                                    @foreach ($unit as $row)
                                                        <option value="{{$row->id}}" {{ $data->unit_id == $row->id ? 'selected' : '' }} >{{ $row->unit_name}}</option>
                                                        @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="row">
                                            <label for="" class="col-md-4 col-form-label">Box Quantity
                                                <span class="text-danger">*</span>
                                            </label>
                                            <div class="col-md-8">
                                                <input type="number" class="form-control @error('box_qty') is-invalid @enderror" name="box_qty" value="{{$data->box_qty}}" disabled>
                                                @error('box_qty')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror  
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="row">
                                            <label for="" class="col-md-4 col-form-label">Price
                                                <span class="text-danger">*</span>
                                            </label>
                                            <div class="col-md-8">
                                                <input type="number" class="form-control @error('price') is-invalid @enderror" name="price" value="{{$data->price}}" disabled>
                                                @error('price')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="row">
                                            <label for="" class="col-md-4 col-form-label">Description</label>
                                            <div class="col-md-8">
                                                <textarea name="description" class="text form-control @error('description') is-invalid @enderror" rows="3" disabled>{{$data->description}}</textarea> 
                                                @error('description')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <img src="{{asset('public')}}/images/car-parts/{{ $data->image }}" style="width:100%" alt="">
                                </div>
                            </div>
                        </div>
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

