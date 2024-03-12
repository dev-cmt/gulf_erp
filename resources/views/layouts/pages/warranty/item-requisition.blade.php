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
                    <button type="submit" class="btn btn-sm btn-primary">Submit</button>
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
                alert('rcvQty: ' + rcvQty + ', Received Qty: ' + qty);
    
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
    
    




    <!--===========// TOOL OR PART REQESITION \\========-->
    <script type="text/javascript">
        //______// Show Modal
        $(document).on('click','.open_reqfrom',function(){
            var getComplaint = $(this).data('id');
            $('#complaintId').val(getComplaint);

            $(".bd-example-modal-lg").modal('show');
            //New Add Row
            $('#table-body').empty();
            addRow(0);
            getRequisition(getComplaint);
        });
        //__________//Save Data
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
                            //--------------------
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
                    alert('success');

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
                    alert('Fail');
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
        //======Validation Message
        @if(Session::has('messege'))
            var type="{{Session::get('alert-type','info')}}"
            switch(type){
                case 'save':
                    swal("Success Message Title", "Well done, you pressed a button", "success");
                    break;
                case 'fail':
                    swal("Error!", "{{ Session::get('messege') }}", "error");
                    $('.bd-example-modal-lg').modal('show');
                    break;
            }
        @endif
    </script>
    @endpush
</x-app-layout>
