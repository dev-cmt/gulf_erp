<x-app-layout>
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">JOB CARD</h4>
                </div>
                <div class="card-body">
                    <!-- Nav tabs -->
                    <div class="default-tab">
                        <ul class="nav nav-tabs" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" data-toggle="tab" href="#today"><i class="la la-home mr-2"></i> Today</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#pending"><i class="la la-clock-o mr-2"></i> Pending</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#compelete"><i class="la la-calendar-check-o mr-2"></i> Compelete</a>
                            </li>
                        </ul>
                        <div class="tab-content">
                            <div class="tab-pane fade show active" id="today" role="tabpanel">
                                <!--===============// TODAY //==================-->
                                <div class="table-responsive pt-4">
                                    <table class="table table-responsive-md">
                                        <thead>
                                            <tr>
                                                <th><strong>SL#</strong></th>
                                                <th><strong>Issue Date</strong></th>
                                                <th><strong>Customer</strong></th>
                                                <th><strong>Number</strong></th>
                                                <th><strong>Status</strong></th>
                                                <th class="text-center"><strong>Action</strong></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($data->where('date', now()->format('Y-m-d')) as $item)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{date("j F Y", strtotime($item->complaint->issue_date))}}</td>
                                                <td>{{ $item->complaint->mastCustomer->name }}</td>
                                                <td>{{ $item->complaint->mastCustomer->phone }}</td>
                                                <td><div class="d-flex align-items-center"><i class="fa fa-circle text-warning mr-1"></i> Pending</div></td>

                                                <td class="text-center">
                                                     <!-- Button Details Modal -->
                                                    <button type="button" class="btn btn-sm btn-info p-1 px-2" data-toggle="modal" data-target="#thisModal_{{ $loop->iteration }}">Details</button>
                                                    <button type="button" class="btn btn-sm btn-secondary p-1 px-2" data-toggle="modal" data-target="#payBill">Pay Bill</button>
                                                    <button type="button" class="btn btn-sm btn-primary p-1 px-2 open_reqfrom" data-id="{{$item->complaint_id}}">Apply</button>
                                                    <!-- Button Save Data modal -->
                                                    <button type="button" class="btn btn-sm btn-success p-1 px-2" data-toggle="modal" data-target="#saveModal_{{ $item->id }}">
                                                        <i class="fa fa-bookmark"></i><span class="btn-icon-add"></span>Report
                                                    </button>
                                                </td>
                                            </tr>
            
                                            <!--=========// Details Modal//===========-->
                                            <div class="modal fade" id="thisModal_{{ $loop->iteration }}">
                                                <div class="modal-dialog modal-dialog-centered" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title">Complaint Details <strong>(Visit = {{ DB::table('job_cards')->where('complaint_id', $item->complaint_id)->where('tech_id', 12)->count() }})</strong></h5>
                                                            <button type="button" class="close" data-dismiss="modal"><span>&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body py-0">
                                                            @php
                                                                try {
                                                                    $noteData = json_decode($item->complaint->note);
                                                                    if (!empty($noteData)) {
                                                                        foreach ($noteData as $noteItem) {
                                                                            echo '<ul class="my-3">';
                                                                            echo '<li><strong>Part Number:</strong> ' . $noteItem->part_no . '</li>';
                                                                            echo '<li><strong>Part Name:</strong> ' . $noteItem->part_name . '</li>';
                                                                            echo '<li><strong>Serial Number:</strong> ' . $noteItem->serial_no . '</li>';
                                                                            echo '<li><strong>Warranty Status:</strong> ' . $noteItem->warranty_status . '</li>';
                                                                            echo '</ul>';
                                                                        }
                                                                    } else {
                                                                        echo '<p>No note data available.</p>';
                                                                    }
                                                                } catch (Exception $e) {
                                                                    echo '<p>Error parsing note data: ' . $e->getMessage() . '</p>';
                                                                }
                                                                echo '<strong>Description</strong>';
                                                                echo '<textarea rows="3" class="form-control"" readonly>' . $item->complaint->remarks. '</textarea>';
                                                            @endphp
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-danger light" data-dismiss="modal">Close</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
            
                                            <!--=========// Save Data Modal//===========-->
                                            <div class="modal fade" id="saveModal_{{ $item->id }}">
                                                <div class="modal-dialog modal-lg">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title"> Technician Visit </h5>
                                                            <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
                                                        </div>
                                                        <form action="{{ route('warranty-movement.store') }}" method="POST" enctype="multipart/form-data">
                                                            @csrf
                                                            <input type="hidden" name="job_card_id" value="{{ $item->id }}">
                                                            <input type="hidden" name="complaint_id" value="{{ $item->complaint->id }}">
                                                            <div class="modal-body pt-2">
                                                                <div class="row">
                                                                    <div class="col-md-4">
                                                                        <div class="form-group row">
                                                                            <label class="col-md-5 col-form-label"><strong>Job Date</strong></label>
                                                                            <label class="col-md-7 col-form-label">{{date('Y-m-d')}}</label>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <div class="form-group row">
                                                                            <label class="col-md-5 col-form-label"><strong>Technician Name</strong></label>
                                                                            <label class="col-md-7 col-form-label">{{ $item->technician->name ?? null }}</label>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-2">
                                                                        <div class="form-group row">
                                                                            <label class="col-md-8 col-form-label"><strong>Job No</strong></label>
                                                                            <label class="col-md-4 col-form-label">{{ $loop->iteration }}</label>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <hr>
                                                                <div class="row">
                                                                    <div class="col-md-6">
                                                                        <div class="form-group row">
                                                                            <label class="col-md-5 col-form-label">In Time</label>
                                                                            <div class="col-lg-7">
                                                                                <input type="time" name="in_time" class="form-control" value="{{ $item->in_time }}"  placeholder="">
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <div class="form-group row">
                                                                            <label class="col-md-5 col-form-label">Out Time</label>
                                                                            <div class="col-lg-7">
                                                                                <input type="time" name="out_time" class="form-control" value="{{ $item->out_time }}"  placeholder="">
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <div class="form-group row">
                                                                            <label class="col-md-12 col-form-label">Description of Work</label>
                                                                            <div class="col-lg-12">
                                                                                <textarea name="note" id="" rows="3" class="form-control">{{$item->note}}</textarea>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <div class="form-group row">
                                                                            <label class="col-md-12 col-form-label">Details Deliverd Spare Parts</label>
                                                                            <div class="col-lg-12">
                                                                                <textarea name="description" id="" rows="3" class="form-control">{{$item->description}}</textarea>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-3">
                                                                        <input type="hidden" name="is_tools" value="0">
                                                                        <input type="checkbox" name="is_tools" value="1" id="check-tools" {{ $item->is_tools == 1 ? 'checked' : ''}}>
                                                                        <label class="form-check-label" for="check-tools">Need Tools?</label>
                                                                    </div>
                                                                    <div class="col-md-3">
                                                                        <input type="hidden" name="is_spare_parts" value="0">
                                                                        <input type="checkbox" name="is_spare_parts" value="1" id="check-spare-parts" {{ $item->is_spare_parts == 1 ? 'checked' : ''}}>
                                                                        <label class="form-check-label" for="check-spare-parts">Need Parts?</label>
                                                                    </div>
                                                                    <div class="col-md-3">
                                                                        <input type="hidden" name="is_next_visit" value="0">
                                                                        <input type="checkbox" name="is_next_visit" value="1" id="check-next-date" class="check-next-date" {{ $item->is_next_visit == 1 ? 'checked' : ''}}>
                                                                        <label class="form-check-label" for="check-next-date">Is Next Date?</label>
                                                                    </div>
                                                                    <div class="col-md-3">
                                                                        <input type="hidden" name="is_complete" value="0">
                                                                        <input type="checkbox" name="is_complete" value="1" id="check-complete" class="check-complete" {{ $item->is_complete == 1 ? 'checked' : ''}}>
                                                                        <label class="form-check-label" for="check-complete">Is Complete?</label>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="modal-footer" style="height:50px">
                                                                <button type="submit" class="btn btn-sm btn-primary submit_btn" {{$item->status == 1 ? 'disabled':''}} >Submit</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="pending">
                                <!--===============// PENDING//==================-->
                                <div class="table-responsive pt-4">
                                    <table class="table table-responsive-md">
                                        <thead>
                                            <tr>
                                                <th><strong>SL#</strong></th>
                                                <th><strong>Issue Date</strong></th>
                                                <th><strong>Customer</strong></th>
                                                <th><strong>Number</strong></th>
                                                <th><strong>Status</strong></th>
                                                <th class="text-center"><strong>Action</strong></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($data->where('status', 0) as $item)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{date("j F Y", strtotime($item->complaint->issue_date))}}</td>
                                                <td>{{ $item->complaint->mastCustomer->name }}</td>
                                                <td>{{ $item->complaint->mastCustomer->phone }}</td>
                                                <td><div class="d-flex align-items-center"><i class="fa fa-circle text-warning mr-1"></i> Pending</div></td>
                                                <td class="text-center">
                                                    <!-- Button Details Modal -->
                                                    <button type="button" class="btn btn-sm btn-info p-1 px-2" data-toggle="modal" data-target="#detailsModal_{{ $loop->iteration }}">Details</button>
                                                    <button type="button" class="btn btn-sm btn-secondary p-1 px-2" id="open_payBill" data-comp="{{$item->complaint_id}}" data-tech="{{$item->tech_id}}" data-cust="{{$item->complaint->mastCustomer->id}}">Pay Bill</button>
                                                    <button type="button" class="btn btn-sm btn-primary p-1 px-2 open_reqfrom" data-id="{{$item->complaint_id}}">Requsition</button>

                                                    <!-- Button Save Data modal -->
                                                    <button type="button" class="btn btn-sm btn-success p-1 px-2" data-toggle="modal" data-target="#saveModal_{{ $item->id }}">
                                                        <i class="fa fa-bookmark"></i><span class="btn-icon-add"></span>Report
                                                    </button>
                                                </td>
                                            </tr>
            
                                            <!--=========// Details Modal//===========-->
                                            <div class="modal fade" id="detailsModal_{{ $loop->iteration }}">
                                                <div class="modal-dialog modal-dialog-centered" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title">Complaint Details <strong>(Visit = {{ DB::table('job_cards')->where('complaint_id', $item->complaint_id)->where('tech_id', 12)->count() }})</strong></h5>
                                                            <button type="button" class="close" data-dismiss="modal"><span>&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body py-0">
                                                            @php
                                                                try {
                                                                    $noteData = json_decode($item->complaint->note);
                                                                    if (!empty($noteData)) {
                                                                        foreach ($noteData as $noteItem) {
                                                                            echo '<ul class="my-3">';
                                                                            echo '<li><strong>Part Number:</strong> ' . $noteItem->part_no . '</li>';
                                                                            echo '<li><strong>Part Name:</strong> ' . $noteItem->part_name . '</li>';
                                                                            echo '<li><strong>Serial Number:</strong> ' . $noteItem->serial_no . '</li>';
                                                                            echo '<li><strong>Warranty Status:</strong> ' . $noteItem->warranty_status . '</li>';
                                                                            echo '</ul>';
                                                                        }
                                                                    } else {
                                                                        echo '<p>No note data available.</p>';
                                                                    }
                                                                } catch (Exception $e) {
                                                                    echo '<p>Error parsing note data: ' . $e->getMessage() . '</p>';
                                                                }
                                                                echo '<strong>Description</strong>';
                                                                echo '<textarea rows="3" class="form-control"" readonly>' . $item->complaint->remarks. '</textarea>';
                                                            @endphp
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-danger light" data-dismiss="modal">Close</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
            
                                            <!--=========// Save Data Modal//===========-->
                                            <div class="modal fade" id="saveModal_{{ $item->id }}">
                                                <div class="modal-dialog modal-lg">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title"> Technician Visit </h5>
                                                            <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
                                                        </div>
                                                        <form action="{{ route('warranty-movement.store') }}" method="POST" enctype="multipart/form-data">
                                                            @csrf
                                                            <input type="hidden" name="job_card_id" value="{{ $item->id }}">
                                                            <input type="hidden" name="complaint_id" value="{{ $item->complaint->id }}">
                                                            <div class="modal-body pt-2">
                                                                <div class="row">
                                                                    <div class="col-md-4">
                                                                        <div class="form-group row">
                                                                            <label class="col-md-5 col-form-label"><strong>Job Date</strong></label>
                                                                            <label class="col-md-7 col-form-label">{{date('Y-m-d')}}</label>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <div class="form-group row">
                                                                            <label class="col-md-5 col-form-label"><strong>Technician Name</strong></label>
                                                                            <label class="col-md-7 col-form-label">{{ $item->technician->name ?? null }}</label>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-2">
                                                                        <div class="form-group row">
                                                                            <label class="col-md-8 col-form-label"><strong>Job No</strong></label>
                                                                            <label class="col-md-4 col-form-label">{{ $loop->iteration }}</label>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <hr>
                                                                <div class="row">
                                                                    <div class="col-md-6">
                                                                        <div class="form-group row">
                                                                            <label class="col-md-5 col-form-label">In Time</label>
                                                                            <div class="col-lg-7">
                                                                                <input type="time" name="in_time" class="form-control" value="{{ $item->in_time }}"  placeholder="">
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <div class="form-group row">
                                                                            <label class="col-md-5 col-form-label">Out Time</label>
                                                                            <div class="col-lg-7">
                                                                                <input type="time" name="out_time" class="form-control" value="{{ $item->out_time }}"  placeholder="">
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <div class="form-group row">
                                                                            <label class="col-md-12 col-form-label">Description of Work</label>
                                                                            <div class="col-lg-12">
                                                                                <textarea name="note" id="" rows="3" class="form-control">{{$item->note}}</textarea>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <div class="form-group row">
                                                                            <label class="col-md-12 col-form-label">Details Deliverd Spare Parts</label>
                                                                            <div class="col-lg-12">
                                                                                <textarea name="description" id="" rows="3" class="form-control">{{$item->description}}</textarea>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-3">
                                                                        <input type="hidden" name="is_tools" value="0">
                                                                        <input type="checkbox" name="is_tools" value="1" id="check-tools" {{ $item->is_tools == 1 ? 'checked' : ''}}>
                                                                        <label class="form-check-label" for="check-tools">Need Tools?</label>
                                                                    </div>
                                                                    <div class="col-md-3">
                                                                        <input type="hidden" name="is_spare_parts" value="0">
                                                                        <input type="checkbox" name="is_spare_parts" value="1" id="check-spare-parts" {{ $item->is_spare_parts == 1 ? 'checked' : ''}}>
                                                                        <label class="form-check-label" for="check-spare-parts">Need Parts?</label>
                                                                    </div>
                                                                    <div class="col-md-3">
                                                                        <input type="hidden" name="is_next_visit" value="0">
                                                                        <input type="checkbox" name="is_next_visit" value="1" id="check-next-date" class="check-next-date" {{ $item->is_next_visit == 1 ? 'checked' : ''}}>
                                                                        <label class="form-check-label" for="check-next-date">Is Next Date?</label>
                                                                    </div>
                                                                    <div class="col-md-3">
                                                                        <input type="hidden" name="is_complete" value="0">
                                                                        <input type="checkbox" name="is_complete" value="1" id="check-complete" class="check-complete" {{ $item->is_complete == 1 ? 'checked' : ''}}>
                                                                        <label class="form-check-label" for="check-complete">Is Complete?</label>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="modal-footer" style="height:50px">
                                                                <button type="submit" class="btn btn-sm btn-primary submit_btn" {{$item->status == 1 ? 'disabled':''}} >Submit</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>

                            </div>
                            <div class="tab-pane fade" id="compelete">
                               <!--===============// HISTORY //================-->
                                <div class="table-responsive pt-4">
                                    <table id="example3" class="display">
                                        <thead>
                                            <tr>
                                                <th>SL#</th>
                                                <th>Issue Date</th>
                                                <th>Customer</th>
                                                <th>Number</th>
                                                <th>Details</th>
                                                <th class="text-right">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($data->where('status', 1) as $item)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{date("j F Y", strtotime($item->complaint->issue_date))}}</td>
                                                <td>{{ $item->complaint->mastCustomer->name }}</td>
                                                <td>{{ $item->complaint->mastCustomer->phone }}</td>
                                                <td>{{ $item->complaint->visit }}</td>
                                                <td class="text-right">
                                                    <!-- Button Save Data modal -->
                                                    <button type="button" class="btn btn-sm btn-secondary p-1 px-2" id="show-details" data-card="{{$item->id}}" data-tech="{{$item->tech_id}}">
                                                        <i class="fa fa-bookmark"></i><span class="btn-icon-add"></span>Details
                                                    </button>
                                                </td>
                                            </tr>

                                            <!--=========// Details Modal//===========-->
                                            <div class="modal fade" id="historyDetailsModal">
                                                <div class="modal-dialog modal-lg">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title">Complaint Details</h5>
                                                            <button type="button" class="close" data-dismiss="modal"><span>&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body py-0">
                                                            <div id="historyShowData"></div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-danger light" data-dismiss="modal">Close</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            @endforeach
                                    
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


        </div>
    </div>
    
    <!--=========// Pay Bill Modal//===========-->
    <div class="modal fade" id="pay_bill_modal">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Receive Services Bill <button type="button" class="btn btn-info p-1 px-2" id="checkPreviousBill">Previous Bill</button></h5>
                    <button type="button" class="close" data-dismiss="modal"><span>&times;</span>
                    </button>
                </div>
                <form data-action="{{ route('service-bill.store') }}" method="POST" enctype="multipart/form-data" id="create-service-bill">
                    @csrf
                    <input type="hidden" name="mast_customer_id" id="billCustomerId">
                    <input type="hidden" name="complaint_id" id="billComplaintId">
                    <input type="hidden" name="tech_id" id="billTechId">
                    <div class="modal-body">
                        <div class="form-group row">
                            <label class="col-md-5 col-form-label">Bill Date</label>
                            <div class="col-lg-7">
                                <input type="date" name="bill_date" class="form-control" value="{{ date('Y-m-d') }}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-5 col-form-label">Note</label>
                            <div class="col-lg-7">
                                <textarea name="remarks" id="" class="form-control" rows="2"></textarea>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12" id="service-bill-previous" style="display: none">
                                <!--=====//Table//=====-->
                                <div class="table-responsive">
                                    <table id="service-previous" class="table table-bordered mb-0">
                                        <thead class="thead-primary">
                                            <tr>
                                                <th width="20%">Bill No</th>
                                                <th width="25%">Description</th>
                                                <th width="15%">Qty</th>
                                                <th width="20%">Price</th>
                                                <th width="20%">Total</th>
                                            </tr>
                                        </thead>
                                        <tbody></tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <!--=====//Table//=====-->
                                <div class="table-responsive">
                                    <table id="service-table" class="table table-bordered mb-0">
                                        <thead class="thead-primary">
                                            <tr>
                                                <th width="25%">Description</th>
                                                <th width="15%">Qty</th>
                                                <th width="20%">Price</th>
                                                <th width="20%">Total</th>
                                                <th width="20%" class="text-center table_action">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody></tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="col-md-12" id="btn_billAdd">
                                <div class="d-flex justify-content-end">
                                    <button type="button" class="btn btn-sm btn-success rounded-0" onClick="addRowService(0)"><span class="fa fa-plus mr-1"></span> ADD ITEM</button>
                                </div>
                            </div>
                            <div class="col-md-12 pt-4">
                                <div class="d-flex justify-content-end">
                                    <h6>Total <span style="border: 1px solid #2222;padding: 10px 40px;margin-left:10px" id="total">0.00</span></h6>
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger light" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-sm btn-primary">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!--=============REQUSITION================-->
    <div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Apply Requisition</h5>
                    <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
                </div>
                <form class="form-valide" data-action="{{ route('item-requisition.store') }}" method="POST" enctype="multipart/form-data" id="add-user-form">
                    @csrf
                    <div class="modal-body py-2 px-4">
                        <input type="hidden" name="complaint_id" id="complaintId">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label class="col-md-5 col-form-label">Date</label>
                                    <div class="col-lg-7">
                                        <input type="date" name="requ_date" class="form-control" value="{{ date('Y-m-d') }}">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label class="col-md-5 col-form-label">Technician Name</label>
                                    <label class="col-md-7 col-form-label">{{Auth::user()->name}}</label>
                                    <input type="hidden" name="tech_id" value="{{Auth::user()->id}}">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group row">
                                    <label class="col-md-2 col-form-label">Remarks</label>
                                    <div class="col-lg-10">
                                        <textarea name="remarks" rows="2" class="form-control"></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12 mt-2">
                                <h5 class="text-center">Previous Requisition</h5>
                                <!--=====//Table//=====-->
                                <div class="table-responsive">
                                    <table class="table table-bordered mb-0">
                                        <thead class="thead-light">
                                            <tr>
                                                <th>SL#</th>
                                                <th>Requisition</th>
                                                <th>Category</th>
                                                <th>Group</th>
                                                <th>Part No.</th>
                                                <th>Qty.</th>
                                                <th>Rec. Qty.</th>
                                                <th>Stock</th>
                                            </tr>
                                        </thead>
                                        <tbody id="requisition-details-body"></tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <!--=====//Table//=====-->
                                <div class="table-responsive">
                                    <table id="items-table" class="table table-bordered mb-0">
                                        <thead class="thead-primary">
                                            <tr>
                                                <th width="15%">Category</th>
                                                <th width="20%">Part Name</th>
                                                <th width="15%">Part No</th>
                                                <th width="10%">Pkg.</th>
                                                <th width="10%">Unit</th>
                                                <th width="15%">Qty</th>
                                                <th width="15%" class="text-center table_action">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody id="table-body"></tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="col-md-12" id="edit_add_show" style="display: none">
                                <div class="d-flex justify-content-end">
                                    <button type="button" class="btn btn-sm btn-success rounded-0" onClick="addRow(0)"><span class="fa fa-plus mr-1"></span> ADD ITEM</button>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="modal-footer" style="height:50px">
                        <button type="button" class="btn btn-sm btn-danger light" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-sm btn-primary">Submit</button>
                    </div>
                </form>
                
            </div>
        </div>
    </div>


    @push('script')
    <script  type="text/javascript">
        $('.check-next-date').change(function() {
            if ($(this).prop('checked')) {
                $('.check-complete').prop('checked', false);
                alert('Are you sure your work is successfully done?');
            }
        });
        $('.check-complete').change(function() {
            if ($(this).prop('checked')) {
                $('.check-next-date').prop('checked', false);
                alert('Are you sure your work will be completed the next day?');
            }
        });

        //________GET JOB CARD DETAILS
        $('#show-details').on('click', function() {
            var jobCardId = $(this).data('card');
            var techId = $(this).data('tech');

            $('#historyDetailsModal').modal('show');
            $.ajax({
                url: '{{ route('get-jobcard-details') }}',
                method: 'GET',
                dataType: 'JSON',
                data: { 'jobCardId': jobCardId, 'techId': techId },
                success: function(response) {
                    var getData = $('#historyShowData');
                    var noteData = JSON.parse(response.data[0].complaint.note);
                    
                    if (noteData.length > 0) {
                        $.each(noteData, function(index, noteItem) {
                            var noteHtml = '<div class="row">' +
                                '<ul class="py-3 col-md-6">' +
                                '<li><strong>Part Number:</strong> ' + noteItem.part_no + '</li>' +
                                '<li><strong>Part Name:</strong> ' + noteItem.part_name + '</li>' +
                                '<li><strong>Serial Number:</strong> ' + noteItem.serial_no + '</li>' +
                                '<li><strong>Warranty Status:</strong> ' + noteItem.warranty_status + '</li>' +
                                '</ul>' +
                                '</div>'; // Concatenated properly
                            getData.append(noteHtml);
                        });
                    } else {
                        getData.append('<p>No note data available.</p>');
                    }
                },


                error: function(xhr, status, error) {
                    console.log(error);
                }
            
            });
        });
        
    </script>
    
    <!--===========// REQESITION \\========-->
    <script type="text/javascript">
        //______// Show Modal => Reqesition
        $(document).on('click','.open_reqfrom',function(){
            var getComplaint = $(this).data('id');
            $('#complaintId').val(getComplaint);

            $(".bd-example-modal-lg").modal('show');
            //New Add Row
            $('#table-body').empty();
            addRow(0);
            getRequisition(getComplaint);
        });
        //__________// Save Data => Reqesition
        $(document).ready(function(){
            var form = '#add-user-form';
            $(form).on('submit', function(event){
                event.preventDefault();
                var url = $(this).attr('data-action');
                var allSubValuesNotNull = true;
                $('.val_item_category, .val_item_group, .val_part_number, .val_quantity').each(function() {
                    var value = $(this).val();
                    if (value === null || value === '') {
                        allValuesNotNull = false;
                        return false; // Exit the loop early
                    }
                });
                if (allSubValuesNotNull) {
                    $('#loading').show();
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
                            swal("Success Message Title", "Well done, you pressed a button", "success")
                            $(".bd-example-modal-lg").modal('hide');
                            $('#loading').hide();
    
                            var add_sales = response.sales;
    
                            var row = '<tr id="row_master_table_'+ add_sales.id + '" role="row" class="odd">';
                            row += '<td></td>';
                            row += '<td>' + add_sales.quot_no + '</td>';
                            row += '<td>' + add_sales.quot_date + '</td>';
                            row += '<td>' + response.mastCustomer.name + '</td>';
                            row += '<td>' + response.mastItemCategory.cat_name + '</td>';
                            row += '<td>' + response.total + '</td>';
                            row += '<td>';
                            if(add_sales.status == 0)
                                row += '<span class="badge light badge-warning"><i class="fa fa-circle text-warning mr-1"></i>Pending</span>';
                            else if(add_sales.status == 1)
                                row += '<span class="badge light badge-success"><i class="fa fa-circle text-success mr-1"></i>Successful</span>';
                            else if(add_sales.status == 2)
                                row += '<span class="badge light badge-danger"><i class="fa fa-circle text-danger mr-1"></i>Canceled</span>';
                            row += '</td>';
                            row += '<td class="text-right"><button type="button" class="btn btn-sm btn-success p-1 px-2 mr-1" id="edit_data" data-id="'+add_sales.id+'"><i class="fa fa-pencil"></i></i><span class="btn-icon-add"></span>Edit</button><button type="button" class="btn btn-sm btn-info p-1 px-2" id="view_data" data-id="'+add_sales.id+'"><i class="fa fa-folder-open"></i></i><span class="btn-icon-add"></span>View</button></td>';
    
                            if($("#sal_id").val()){
                                $("#row_master_table_" + add_sales.id).replaceWith(row);
                            }else{
                                $("#sales_tbody").prepend(row);
                            }
                        },
                        error: function (xhr) {
                            var errors = xhr.responseJSON.errors;
                            var errorHtml = '';
                            $.each(errors, function(key, value) {
                                errorHtml += '<li style="color:red">' + value + '</li>';
                            });
    
                            Swal.fire({
                                icon: 'error',
                                title: 'Error!',
                                html: '<ul>' + errorHtml + '</ul>',
                                text: 'All input values are not null or empty.',
                            });
                            $('#loading').hide();
                        }
                    });
                } else {
                    swal("Error!", "All input values are not null or empty.", "error");
                }
            });
        });
        function getRequisition(complaintId){
            $.ajax({
                url: '{{ route('get-requisition-details') }}',
                method: 'GET',
                dataType: 'json',
                data: {'complaint_id': complaintId},
                success: function(response) {
                    var rows = "";
                    $.each(response, function(index, item) {
                        rows += "<tr>";
                        rows += "<td>" + index + "</td>";
                        rows += "<td>" + item.requisition.requ_no + "</td>";
                        rows += "<td>" + item.mast_item_category.cat_name + "</td>";
                        rows += "<td>" + item.mast_item_group.part_name + "</td>";
                        rows += "<td>" + item.mast_item_register.part_no + "</td>";
                        rows += "<td>" + item.qty + "</td>";
                        rows += "<td>" + item.rcv_qty + "</td>";
                        rows += "<td>" + (item.status == 0 ? 'In' : 'Out') + "</td>";
                        rows += "</tr>";
                    });
                    $('#requisition-details-body').html(rows);
                },
                error: function(xhr, status, error) {
                    console.error(error);
                }
            });
        }
    </script>
    <script type="text/javascript">
        // Add ROW
        var count = 0;
        $("#items-table").on("click", ".add-row", function() {
            var allValuesNotNull = true;
            $('.val_item_category, .val_item_group, .val_part_number, .val_quantity').each(function() {
                var value = $(this).val();
                if (value === null || value === '') {
                    allValuesNotNull = false;
                    return false; // Exit the loop early
                }
            });
            if (allValuesNotNull) {
                ++count;
                addRow(count);
            } else {
                swal("Error!", "All input values are not null or empty.", "error");
            }
        });

        // Funtion Call
        function addRow(i) {
            // Create a new row element
            var newRow = $('<tr>' +
                '<td>' +
                '<select id="itemCategory" name="moreFile['+i+'][item_category]" class="form-control dropdwon_select val_item_category">' +
                    '<option value="" selected>Select</option>' +
                    '<option value="2">AC Parts</option>' +
                    '<option value="3">Car Parts</option>' +
                    '<option value="4">Tools</option>' +
                '</select>' +
                '</td>' +
                '<td><select id="itemGroup" name="moreFile['+i+'][item_group]" class="form-control dropdown_select val_item_group"></select></td>' +
                '<td><select id="partNumber" name="moreFile['+i+'][item_register]" class="form-control dropdown_select val_part_number"></select></td>' +
                '<td><label id="packageSize" class="packageSize"></label></td>' +
                '<td><label id="unit" class="unit"></label></td>' +
                '<td><input type="number"  name="moreFile['+i+'][qty]" class="form-control quantity" placeholder="0.00"></td>' +
                '<td class="text-center">' +
                '<button type="button" title="Add New" class="btn btn-icon btn-outline-warning border-0 btn-xs add-row"><span class="fa fa-plus"></span></button>' +
                '<button type="button" title="Remove" class="btn btn-icon btn-outline-danger btn-xs border-0 remove-row"><span class="fa fa-trash"></span></button>' +
                '</td>' +
                '</tr>');

            // Append the new row to the table body
            $('#items-table tbody').append(newRow);
            newRow.find('.dropdwon_select').each(function () {
                $(this).select2({
                    dropdownParent: $(this).parent()
                });
            });
        }


        // Remove a row
        $('#items-table').on('click', '.remove-row', function() {
            $(this).closest('tr').remove();
            var rowCount = $('#items-table tbody tr').length;
            if (rowCount === 0) {
                $('#edit_add_show').show(); // Show the edit add show element if there are no rows
            }
        });
    </script>
    
    <script type="text/javascript">
        //======Get Item Group All Data
        $(document).on("change", "#itemCategory", function() {
            var typeId = $(this).val();
            var currentRow = $(this).closest("tr");
            $.ajax({
                url: '{{ route('get-item-category') }}',
                method: 'GET',
                dataType: 'json',
                data: {'typeId': typeId},
                success: function(response) {
                    var options = '<option value="" selected>Select</option>';
                    response.forEach(function(item) {
                        options += '<option value="' + item.id + '">' + item.part_name + '</option>';
                    });

                    currentRow.find('#itemGroup').empty().append(options);
                    $('#loading').hide();

                    // Initialize select2
                    currentRow.find('#itemGroup').select2({
                        dropdownParent: currentRow.find('#itemGroup').parent() // Dropdown parent fix
                    });
                },
                error: function(xhr, status, error) {
                    console.error(error);
                }
            });
        });


        //======Get Item Group All Data
        $(document).on('change','#itemGroup',function(){
            var partId = $(this).val();
            var currentRow = $(this).closest("tr");
            $('#loading').show();
            $.ajax({
                url:'{{ route('get-part-id')}}',
                method:'GET',
                dataType:"html",
                data:{'part_id':partId},
                success:function(data){
                    console.log(data)
                    currentRow.find('#partNumber').html(data);
                    $('#loading').hide();

                    // Initialize select2
                    currentRow.find('#partNumber').select2({
                        dropdownParent: currentRow.find('#partNumber').parent() // Dropdown parent fix
                    });
                },
                error:function(){
                    $('#loading').hide();
                }
            });
        });
        //======Show Single Row Data
        $(document).on('change','#partNumber', function(){
            var partNumber_id = $(this).val();
            var currentRows = $(this).closest("tr"); 
            $('#loading').show();
            $.ajax({
                url:'{{ route('get-part-number')}}',
                method:'GET',
                dataType:"JSON",
                data:{'part_id':partNumber_id},
                success:function(data){
                    $('#loading').hide();
                    currentRows.find('#packageSize').text(data.box_qty);
                    currentRows.find('#unit').text(data.unit.unit_name);
                    currentRows.find('.quantity').focus();
                }
            });
        });
        //======Duplicates Part Number Validation
        $(document).on('change','.val_part_number', function() {
            var dropdownValues = $('.val_part_number').map(function() {
                return $(this).val();
            }).get();
    
            var hasDuplicates = new Set(dropdownValues).size !== dropdownValues.length;
            if (hasDuplicates) {
                Swal.fire({
                    icon: 'error',
                    title: 'Duplicate Values',
                    text: 'Duplicate values are not allowed in the partNumber dropdown.',
                });
                //--Reset Option  
                var $currentRow = $(this).closest('tr');
                var itemCategoryValue = $currentRow.find('.val_item_group').val();
                var currentRow = $(this).closest("tr");
                $.ajax({
                    url:'{{ route('get-part-id')}}',
                    method:'GET',
                    dataType:"html",
                    data:{'part_id':itemCategoryValue},
                    success:function(data){
                        console.log(data)
                        currentRow.find('#partNumber').html(data);
                    },
                    error:function(){
                        alert('Fail');
                    }
                });
            }
        });
    </script>
    
    <!--===========// SERVICE BILL \\========-->
    <script type="text/javascript">
        //======// Open Modal => Service Bill
        $("#open_payBill").on("click", function() {
            var complaintId = $(this).data('comp');
            var techId = $(this).data('tech');
            var mastCustomerId = $(this).data('cust');
            $('#pay_bill_modal').modal('show');
            $('#total').text("0.00");
            $("#service-table tbody").empty();
            $('#btn_billAdd').show();

            $('#billComplaintId').val(complaintId);
            $('#billTechId').val(techId);
            $('#billCustomerId').val(mastCustomerId);
        });

        //======// Add ROW => Service Bill
        var count = 0;
        $("#service-table").on("click", ".add-row", function() {
            var allSubValuesNotNull = true;
            $('.bill_description, .bill_quantity, .bill_price').each(function() {
                var value = $(this).val();
                if (value === null || value === '') {
                    allSubValuesNotNull = false;
                    return false; // Exit the loop early
                }
            });

            if (allSubValuesNotNull) {
                ++count;
                addRowService(count);
            } else {
                swal("Error!", "All input values must not be null or empty.", "error");
            }
        });
        function addRowService(i) {
            // Create a new row element
            var newRow = $('<tr>' +
                '<td><textarea name="moreFile['+i+'][description]" class="form-control bill_description" rows="1"></textarea></td>' +
                '<td><input type="number" name="moreFile['+i+'][qty]" class="form-control quantity bill_quantity" placeholder="0.00"></td>' +
                '<td><input type="number" name="moreFile['+i+'][price]" class="form-control price bill_price" placeholder="0.00"></td>' +
                '<td><label class="subtotal">00.00</label</td>' +
                '<td class="text-center">' +
                '<button type="button" title="Add New" class="btn btn-icon btn-outline-warning border-0 btn-xs add-row"><span class="fa fa-plus"></span></button>' +
                '<button type="button" title="Remove" class="btn btn-icon btn-outline-danger btn-xs border-0 remove-row"><span class="fa fa-trash"></span></button>' +
                '</td>' +
                '</tr>');

            // Append the new row to the table body
            $('#service-table tbody').append(newRow);

            var rowCount = $('#service-table tbody tr').length;
            if (rowCount >= 0) {
                $('#btn_billAdd').hide();
            }
        }


        //======// Remove a row => Service Bill
        $('#service-table').on('click', '.remove-row', function() {
            $(this).closest('tr').remove();
            var rowCount = $('#service-table tbody tr').length;
            if (rowCount === 0) {
                $('#btn_billAdd').show();
            }
        });

        //======// Total Count => Service Bill
        $('#service-table').on('input', '.quantity, .price', function() {
            updateSubtotal(0);
        });
        function updateSubtotal(update_subTotal) {
            var total = 0;
            $('#service-table tbody tr').each(function() {
                var quantity = parseFloat($(this).find('.quantity').val()) || 0;
                var price = parseFloat($(this).find('.price').val()) || 0;
                var subtotal = quantity * price;
                $(this).find('.subtotal').text(subtotal.toFixed(2));
                total += subtotal;
            });
            var update_total = total - update_subTotal;
            $('#total').text(update_total.toFixed(2));
        }

        //======// Save Data => Service Bill
        $(document).ready(function(){
            var form = '#create-service-bill';
            $(form).on('submit', function(event){
                event.preventDefault();
                var url = $(this).attr('data-action');
                var allSubValuesNotNull = true;
                $('.bill_description, .bill_quantity, .bill_price').each(function() {
                    var value = $(this).val();
                    if (value === null || value === '') {
                        allSubValuesNotNull = false;
                        return false; // Exit the loop early
                    }
                });

                if (allSubValuesNotNull) {
                    $('#loading').show();
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
                            swal("Success Message Title", "Well done, you pressed a button", "success")
                            $("#pay_bill_modal").modal('hide');
                            $('#loading').hide();
                        },
                        error: function (xhr) {
                            var errors = xhr.responseJSON.errors;
                            var errorHtml = '';
                            $.each(errors, function(key, value) {
                                errorHtml += '<li style="color:red">' + value + '</li>';
                            });
    
                            Swal.fire({
                                icon: 'error',
                                title: 'Error!',
                                html: '<ul>' + errorHtml + '</ul>',
                                text: 'All input values are not null or empty.',
                            });
                            $('#loading').hide();
                        }
                    });
                } else {
                    swal("Error!", "All input values are not null or empty.", "error");
                }
            });
        });
        
        //======//Remove a row => Service Bill
        $('#checkPreviousBill').on('click', function() {
            var customerId = $('#billCustomerId').val();
            $('#loading').show();
            $.ajax({
                url: '{{ route('get-service-bill-details') }}',
                method: 'GET',
                dataType: 'json',
                data: {'mast_customer_id': customerId},
                success: function(response) {
                    var rows = "";
                    $.each(response, function(index, item) {
                        rows += "<tr>";
                        rows += "<td>" + item.service_bill.bill_no + "</td>";
                        rows += "<td>" + item.description + "</td>";
                        rows += "<td>" + item.qty + "</td>";
                        rows += "<td>" + item.price + "</td>";
                        rows += "<td>" + item.total + "</td>";
                        rows += "</tr>";
                    });
                    $('#service-previous tbody').html(rows);
                    $('#service-bill-previous').toggle();
                    $('#loading').hide();
                },
                error: function(xhr, status, error) {
                    console.error(error);
                    $('#loading').hide();
                }
            })
        });
    </script>

    @endpush
</x-app-layout>
