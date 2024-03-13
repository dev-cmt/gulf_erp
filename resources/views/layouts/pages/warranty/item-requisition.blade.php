<x-app-layout>
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Item Requisition List</h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive pt-4">
                        <table id="example3" class="display">
                            <thead>
                                <tr>
                                    <th>SL#</th>
                                    <th>Req. No.</th>
                                    <th>Req. Date</th>
                                    <th>Technician</th>
                                    <th>Problem</th>
                                    <th class="text-right">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($data as $row)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{$row->requ_no}}</td>
                                    <td>{{date("j F Y", strtotime($row->requ_date))}}</td>
                                    <td>{{ $row->technician->name }}</td>
                                    <td>{{ $row->complaint->compliantType->name }}</td>
                                    <td class="text-right">
                                        <!-- Button Save Data modal -->
                                        <button type="button" class="btn btn-sm btn-secondary p-1 px-2 show-details" data-id="{{$row->id}}">
                                            <i class="fa fa-bookmark"></i><span class="btn-icon-add"></span>Details
                                        </button>
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

    <!--=========// Details Modal//===========-->
    <div class="modal fade" id="historyDetailsModal">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Requisition Details</h5>
                    <button type="button" class="close" data-dismiss="modal"><span>&times;</span>
                    </button>
                </div>
                <div class="modal-body py-2 px-4">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="col-md-5 col-form-label">Requisition No.</label>
                                <label class="col-md-7 col-form-label" id="requNo"><strong></strong></label>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="col-md-5 col-form-label">Requisition Date</label>
                                <label class="col-md-7 col-form-label" id="requDate"><strong></strong></label>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="col-md-5 col-form-label">Complaint Name</label>
                                <label class="col-md-7 col-form-label" id="complaintId"><strong></strong></label>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="col-md-5 col-form-label">Technician Name</label>
                                <label class="col-md-7 col-form-label" id="techId"></label>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group row">
                                <label class="col-md-2 col-form-label">Remarks</label>
                                <div class="col-lg-10">
                                    <textarea name="remarks" id="remarks" rows="2" class="form-control" disabled></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <!--=====//Table//=====-->
                            <div class="table-responsive">
                                <table class="table table-bordered mb-0">
                                    <thead class="thead-light">
                                        <tr>
                                            <th>SL#</th>
                                            <th>Category</th>
                                            <th>Group</th>
                                            <th>PartNo.</th>
                                            <th>ReqQty.</th>
                                            <th>Sended</th>
                                            <th>Qty</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody id="requisition-body"></tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="modal-footer" style="height:50px">
                    <button type="button" class="btn btn-sm btn-danger light" data-dismiss="modal">Close</button>
                    {{-- <button type="submit" class="btn btn-sm btn-primary">Submit</button> --}}
                </div>
            </div>
        </div>
    </div>


    @push('script')
    <script type="text/javascript">
        $(document).ready(function() {
            // Show Modal and retrieve requisition details
            $(document).on('click', '.show-details', function() {
                var id = $(this).data('id');
                
                $('#historyDetailsModal').modal('show');
                $.ajax({
                    url: '{{ route('get-requisition') }}',
                    method: 'GET',
                    dataType: 'JSON',
                    data: { 'id': id },
                    success: function(response) {
                        $('#requNo').text(response.requ_no);
                        $('#requDate').text(response.requ_date);
                        $('#complaintId').text(response.complaint.compliant_type.name);
                        $('#techId').text(response.technician.name);
                        $('#remarks').text(response.remarks);
                        // Clear the existing table body content
                        $('#requisition-body').empty();
                        // Loop through each requisition detail and generate HTML for the table rows
                        $.each(response.requisition_details, function(index, detail) {
                            var rowHtml = `
                                <tr>
                                    <td>${index + 1}</td>
                                    <td>${detail.mast_item_category.cat_name}</td>
                                    <td>${detail.mast_item_group.part_name}</td>
                                    <td>${detail.mast_item_register.part_no}</td>
                                    <td id="qty">${detail.qty}</td>
                                    <td id="rcvQty">${detail.rcv_qty}</td>
                                    <td><input type="number" class="form-control getQty" value="" min="1"></td>
                                    <td>
                                        <div class="d-flex">
                                            <button type="button" class="btn btn-sm btn-secondary p-1 px-2 mr-1 item-move send" data-id="${detail.id}" data-cal="1" ${detail.qty == detail.rcv_qty ? 'disabled' : ''}>Send</button>
                                            <button type="button" class="btn btn-sm btn-secondary p-1 px-2 mr-1 item-move return" data-id="${detail.id}" data-cal="0" ${detail.rcv_qty == 0 ? 'disabled' : ''}>Return</button>
                                        </div>
                                    </td>
                                </tr>`;
                            $('#requisition-body').append(rowHtml);
                        });
                    },
                    error: function(xhr, status, error) {
                        console.error(error);
                    }
                });
            });
    
            $(document).on('click', '.item-move', function() {
                var id = $(this).data('id');
                var status = $(this).data('cal');
                var getQty = parseFloat($(this).closest('tr').find('.getQty').val());

                $('#loading').show();
                $.ajax({
                    url: '{{ route('item-requisition.approve') }}',
                    method: 'GET',
                    dataType: 'json',
                    data: {'id': id, 'status': status, 'rcv_qty': getQty},
                    success: function(response) {
                        swal("Success Message Title", "Well done, you pressed a button", "success")
                        $('#historyDetailsModal').modal('hide');
                        $('#loading').hide();
                        $(this).closest('tr').find('.getQty, item-move').prop('disabled', true);
                    },
                    error: function(xhr, status, error) {
                        console.error(error);
                        swal("Error!", "All input values are not null or empty.", "error");
                        $('#loading').hide();
                    }
                });
            });
    
            $(document).on('change', '.getQty', function() {
                var qty = parseFloat($(this).closest('tr').find('#qty').text());
                var rcvQty = parseFloat($(this).closest('tr').find('#rcvQty').text());
                var getQty = parseFloat($(this).closest('tr').find('.getQty').val());

                $(this).closest('tr').find('.send').prop('disabled', qty - rcvQty < getQty ? true : false);
                $(this).closest('tr').find('.return').prop('disabled', rcvQty < getQty ? true : false);
            });
        });
    </script>
    @endpush
</x-app-layout>
