<x-app-layout>
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Service Bill List</h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive pt-4">
                        <table id="example3" class="display">
                            <thead>
                                <tr>
                                    <th>SL#</th>
                                    <th>Bill No.</th>
                                    <th>Bill Date</th>
                                    <th>Comlaint No.</th>
                                    <th>Customer</th>
                                    <th>Technician</th>
                                    <th class="text-right">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($data as $row)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{$row->bill_no}}</td>
                                    <td>{{date("j F Y", strtotime($row->bill_date))}}</td>
                                    <td>{{ $row->complaint->issue_no }}</td>
                                    <td>{{ $row->mastCustomer->name }}</td>
                                    <td>{{ $row->technician->name }}</td>
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
    <div class="modal fade" id="detailsModal">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Service Bill Details</h5>
                    <button type="button" class="close" data-dismiss="modal"><span>&times;</span>
                    </button>
                </div>
                <div class="modal-body py-2 px-4">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="col-md-5 col-form-label">Bill No.</label>
                                <label class="col-md-7 col-form-label" id="billNo"><strong></strong></label>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="col-md-5 col-form-label">Bill Date</label>
                                <label class="col-md-7 col-form-label" id="billDate"><strong></strong></label>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="col-md-5 col-form-label">Customer Name</label>
                                <label class="col-md-7 col-form-label" id="customerId"><strong></strong></label>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="col-md-5 col-form-label">Technician Name</label>
                                <label class="col-md-7 col-form-label" id="techId"></label>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <!--=====//Table//=====-->
                            <div class="table-responsive">
                                <table class="table table-bordered mb-0">
                                    <thead class="thead-light">
                                        <tr>
                                            <th>SL#</th>
                                            <th>Description</th>
                                            <th>Qty</th>
                                            <th>Price</th>
                                            <th>Total</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody id="service-bill-body"></tbody>
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
        // Show Modal and retrieve
        $(document).on('click', '.show-details', function() {
            var id = $(this).data('id');
            
            $('#detailsModal').modal('show');
            $.ajax({
                url: '{{ route('get-service-bill') }}',
                method: 'GET',
                dataType: 'JSON',
                data: { 'id': id },
                success: function(response) {
                    $('#billNo').text(response.bill_no);
                    $('#billDate').text(response.bill_date);
                    $('#customerId').text(response.technician.name);
                    $('#techId').text(response.mast_customer.name);

                    // Clear the existing table body content
                    $('#service-bill-body').empty();
                    // Loop through each requisition detail and generate HTML for the table rows
                    $.each(response.service_bill_details, function(index, detail) {
                        var rowHtml = `
                            <tr>
                                <td>${index + 1}</td>
                                <td>${detail.description}</td>
                                <td>${detail.qty}</td>
                                <td>${detail.price}</td>
                                <td>${detail.total}</td>
                                <td class="text-right">
                                    <button type="button" class="btn btn-sm btn-secondary p-1 px-2 bill-receive" data-id="${detail.id}" ${detail.status == 1 ? 'disabled' : ''}>Recive</button>
                                </td>
                            </tr>`;
                        $('#service-bill-body').append(rowHtml);
                    });
                },
                error: function(xhr, status, error) {
                    console.error(error);
                }
            });
        });

        $(document).on('click', '.bill-receive', function() {
            var button = $(this);
            var id = $(this).data('id');
            $('#loading').show();
            $.ajax({
                url: '{{ route('service-bill.receive') }}',
                method: 'GET',
                dataType: 'json',
                data: {'id': id},
                success: function(response) {
                    swal("Success Message Title", "Well done, you pressed a button", "success")
                    $('#historyDetailsModal').modal('hide');
                    $('#loading').hide();
                    button.prop('disabled', true); // Disable the button
                },
                error: function(xhr, status, error) {
                    console.error(error);
                    swal("Error!", "All input values are not null or empty.", "error");
                    $('#loading').hide();
                }
            });
        });
    </script>
    
    
    @endpush
</x-app-layout>
