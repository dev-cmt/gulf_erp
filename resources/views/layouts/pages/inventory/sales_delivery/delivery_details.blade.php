<x-app-layout>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Sales Delivery Details</h4>
                    <a href="{{ route('sales-delivery.index') }}" class="btn btn-sm btn-primary"><i class="fa fa-reply"></i><span class="btn-icon-add"></span>Back</a>
                </div>

                <div class="card-body pt-2">
                    <div class="row">
                        <div class="col-md-4 col-sm-12">
                            <div class="row">
                                <label class="col-6 col-form-label"><strong> Order No :</strong></label>
                                <label class="col-6 col-form-label">{{$sales->inv_no}}</label>
                            </div>
                        </div>
                        <div class="col-md-4 col-sm-12">
                            <div class="row">
                                <label class="col-6 col-form-label"><strong>Order Date :</strong></label>
                                <label class="col-6 col-form-label">{{date("j F, Y", strtotime($sales->inv_date))}}</label>
                            </div>
                        </div>
                        <div class="col-md-4 col-sm-12">
                            <div class="row">
                                <label class="col-6 col-form-label"><strong>Customer Name :</strong></label>
                                <label class="col-6 col-form-label">{{$sales->mastCustomer->name}}</label>
                            </div>
                        </div>
                    </div>
                    <br>
                    <div class="table-responsive">
                        <table id="example3" class="display " style="min-width: 845px">
                            <thead>
                            <tr>
                                <th>SL#</th>
                                <th>Category</th>
                                <th>Group Name</th>
                                <th>Part No.</th>
                                <th>Price</th>
                                <th>Qty</th>
                                <th>Delivery Qty</th>
                                <th>Total</th>
                                <th class="text-right">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                                @foreach ($data as $key=> $row)
                                <tr>
                                    <td>{{++$key}}</td>
                                    <td>{{$row->cat_name}}</td>
                                    <td>{{$row->part_name}}</td>
                                    <td>{{$row->part_no}}</td>
                                    <td>{{$row->price}}</td>
                                    <td>{{$row->qty}}</td>
                                    <td>{{$row->rcv_qty ?? '0' }}</td>
                                    <td>{{$row->qty * $row->price}}</td>
                                    <td class="text-right">
                                        @if ($row->qty == $row->rcv_qty)  
                                        <span class="badge light badge-success">
                                            <i class="fa fa-circle text-success mr-1"></i>Successful
                                        </span>
                                        @else
                                            <button type="button" class="btn btn-sm btn-success p-1 px-2" id="edit_data" data-detId="5" data-id="{{ $row->id }}"><i class="fa fa-plus"></i></i><span class="btn-icon-add"></span>Add</button>
                                            <button type="button" class="btn btn-sm btn-primary p-1 px-2" id="upload_excel" data-id="{{ $row->id }}"><i class="fa fa-paperclip"></i></i><span class="btn-icon-add"></span>Upload</button>
                                        @endif
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

    <!--============//Excel Upload Modal Data//================-->
    <div class="modal fade" id="exampleModalCenter">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">SL No. Upload Excel File</h5>
                    <button type="button" class="close" data-dismiss="modal"><span>&times;</span>
                    </button>
                </div>
                <div class="modal-body pt-2">
                    <label class="form-label">Please Upload CSV in Given <a href="#" class="text-danger">Format</a></label>
                    <div class="row">
                        <label class="col-md-4 col-form-label">Upload Excel File</label>
                        <div class="col-md-8">
                            <input type="file" name="sl_no" class="form-control" value="">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger light" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Save changes</button>
                </div>
            </div>
        </div>
    </div>
    <!--============//Add Sl No. Modal Data//================-->
    <div class="modal fade" id="modalGrid">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add Serial Number</h5>
                    <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
                </div>
                <form class="form-valide" data-action="{{ route('grn-purchase.store') }}" method="POST" enctype="multipart/form-data" id="add-user-form">
                    @csrf
                    <div class="modal-body py-2">
                        <div class="row" id="main-row-data">
                            <input type="hidden" name="pur_id" id="pur_id">
                            <div class="col-md-12">
                                <div class="form-group row">
                                    <label class="col-md-4 col-form-label">Invoice No.</label>
                                    <div class="col-md-8">
                                        <label class="col-md-12 col-form-label" id="inv_no"></label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group row">
                                    <label class="col-md-4 col-form-label">Invoice Date</label>
                                    <div class="col-md-8">
                                        <label class="col-md-12 col-form-label" id="inv_date"></label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group row">
                                    <label class="col-md-4 col-form-label">Invoice Type</label>
                                    <div class="col-md-8">
                                        <label class="col-md-12 col-form-label" id="inv_type"></label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group row">
                                    <label class="col-md-4 col-form-label">Customer Name</label>
                                    <div class="col-md-8">
                                        <label class="col-md-12 col-form-label" id="mast_customer_id"></label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group row">
                                    <label class="col-md-4 col-form-label">Remarks</label>
                                    <div class="col-md-8">
                                        <label class="col-md-12 col-form-label" id="remarks"></label>
                                    </div>
                                </div>
                            </div> 
                            
                            <input type="hidden" id="itemRegisterId" name="item_register_id">
                            <input type="hidden" id="getDeliQty">
                            Qty<input type="text" id="qty">
                            DeliQty<input type="text" id="deliQty" name="deli_qty">



                            <input type="hidden" id="getPartNo">
                            <input type="hidden" id="purDetailsId" name="purchase_details_id">
                            <input type="hidden" id="workStationId" name="work_station_id">
                            <input type="hidden" id="purchaseId" name="purchase_id">
                        </div>

                        <div>
                        <div class="row">
                            <div class="col-md-12">
                                <!--=====//Table//=====-->
                                <div class="table-responsive">
                                    <table id="items-table" class="table table-bordered">
                                        <thead class="thead-light">
                                            <tr>
                                                <th width="10%">SL#</th>
                                                <th width="22%">Part No.</th>
                                                <th width="45%">SL No.</th>
                                                <th width="23%" class="text-center">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody id="table-body"></tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        </div>

                    </div>
                    <div class="modal-footer" style="height:50px">
                        <button type="button" class="btn btn-sm btn-danger light" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-sm btn-primary submit_btn">Submit</button>
                    </div>
                </form>
                
            </div>
        </div>
    </div>
</x-app-layout>

<script type="text/javascript">
    /*=======//GRN Purchase Add Modal//=========*/
    $(document).on('click','#edit_data', function(){
        var id = $(this).data('id');
        $.ajax({
            url:'{{ route('get_sales_details')}}',
            method:'GET',
            dataType:"JSON",
            data:{'id': id},
            success:function(response){
                $('#inv_no').html(response.inv_no);
                $("#inv_type").html(response.cat_name);
                $("#inv_date").html(response.inv_date);
                $("#mast_customer_id").html(response.name);
                $('#remarks').html(response.remarks);

                //---SetUp
                $('#itemRegisterId').val(response.item_register_id);
                $('#qty').val(response.qty);
                $('#getPartNo').val(response.part_no);
                $('.part_number').html(response.part_no);
                
                //---SetUp
                $('#purDetailsId').val(response.id);
                $('#purchaseId').val(response.purchase_id);
                $('#getDeliQty').val(response.deli_qty);
                $('#deliQty').val(response.deli_qty + 1);

                getSlNo(response.item_register_id);
            },
            error: function(response) {
                swal("Error!", "All input values are not null or empty.", "error");
            }
        });
        $("#modalGrid").modal('show');
        var tbody = $('#table-body');
        tbody.empty();
        addRow(0);
    });
    //-----Get Serial Number
    function getSlNo(item_register_id) {
        var currentRow = $('#items-table tbody').find("tr:last");
        $.ajax({
            url:'{{ route('get-serial-no')}}',
            method:'GET',
            dataType:"html",
            data:{'item_register_id':item_register_id},
            success:function(data){
                console.log(data)
                // currentRow.find('#serialNumber').html(data);
                $('#items-table tbody').find("tr:last #serialNumber").html(data);
            },
            error:function(){
                alert('Fail');
            }
        });
    }
    /*=======//GRN Purchase Upload Modal//=========*/
    $(document).on('click','#upload_excel', function(){
        var id = $(this).data('id');
        $("#exampleModalCenter").modal('show');
    });
    /*=======//GRN Purchase Save Data//=========*/
    var form = '#add-user-form';
    $(form).on('submit', function(event){
        event.preventDefault();
        var url = $(this).attr('data-action');

        //--Validation then save
        var allValuesNotNull = true;
        $('.val_serial_no').each(function() {
            var value = $(this).val();
            if (value === null || value === '') {
                allValuesNotNull = false;
                return false;
            }
        });
        if (allValuesNotNull) {
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
                    $("#modalGrid").modal('hide');
                    swal("Your data save successfully", "Well done, you pressed a button", "success")
                    .then(function() {
                        location.reload();
                    });
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
                }
            });
        } else {
            swal("Error!", "All input values are not null or empty.", "error");
        }
    });
</script>
<script type="text/javascript">
    //======Add ROW
    var count = 0;
    $('#items-table').on('click', '.add-row', function() {
        var allValuesNotNull = true;
        $('.val_serial_no').each(function() {
            var value = $(this).val();
            if (value === null || value === '') {
                allValuesNotNull = false;
                return false;
            }
        });
        if (allValuesNotNull) {
            var valItemRegisterId = parseInt($('#itemRegisterId').val());
            getSlNo(valItemRegisterId);
            ++count;
            addRow(count);
            
            var qty = parseInt($('#qty').val());
            var rcvQtyCheck = parseInt($('#getRcvQty').val());
            var checkQty = qty - rcvQtyCheck;
            var rowCount = parseInt($('#items-table tbody tr').length) + 1;
            // if(checkQty >= rowCount){
            //     ++count;
            //     addRow(count);
            //     var qtyResult = rcvQty + rowCount;
            //     $('#rcvQty').val(qtyResult);
            // }else{
            //     Swal.fire(
            //         'Done',
            //         'Your already fill up all data!',
            //         'question'
            //     )
            // }
        } else {
            swal("Error!", "All input values are not null or empty.", "error");
        }
    });

    function addRow(i){
        var rowCount = parseInt($('#items-table tbody tr').length) + 1;
        var partNumber = $('#getPartNo').val();
        var newRow = $('<tr>' +
            '<td><label class="form-label">'+rowCount+'</label></td>' +
            '<td><label class="form-label part_number">'+partNumber+'</label></td>' +
            '<td><select id="serialNumber" name="moreFile['+i+'][serial_no]" class="form-control dropdwon_select val_serial_no" data-index="'+i+'"></select></td>' +
            '<td class="text-center">' +
                '<button type="button" title="Add New" class="btn btn-icon btn-outline-warning border-0 btn-xs add-row"><span class="fa fa-plus"></span></button>' +
                '<button type="button" title="Remove" class="btn btn-icon btn-outline-danger btn-xs border-0 remove-row"><span class="fa fa-trash"></span></button>' +
            '</td>'+
        '</tr>');
    
        $('#items-table tbody').append(newRow);
        //--Dropdwon Search Fix
        newRow.find('.dropdwon_select').each(function () {
            $(this).select2({
                dropdownParent: $(this).parent()
            });
        });
    }
    //======Remove ROW
    $('#items-table').on('click', '.remove-row', function() {
        $(this).closest('tr').remove();
        var deliQtyRemove= $('#deliQty').val(); 
        $('#deliQty').val(deliQtyRemove - 1);
    });
    //======Duplicates Part Number Validation
    $(document).on('change', '.val_serial_no', function() {
        var $dropdowns = $('.val_serial_no');
        var hasDuplicates = false;

        // Check for duplicates in the current changed dropdown value
        var currentIndex = $(this).data('index');
        var currentValue = $(this).val();
        $dropdowns.each(function(index) {
            if (index !== currentIndex && $(this).val() === currentValue) {
                hasDuplicates = true;
                return false; // Exit the loop early
            }
        });

        if (hasDuplicates) {
            Swal.fire({
                icon: 'error',
                title: 'Duplicate Values',
                text: 'Duplicate values are not allowed in the partNumber dropdown.',
            });
            // Reset the dropdown
            $(this).val('');

            // Fetch new data for the current row
            var valItemRegisterId = parseInt($('#itemRegisterId').val());
            var $currentRow = $(this).closest('tr');
            var $serialNumberDropdown = $currentRow.find('.dropdwon_select.val_serial_no');

            $.ajax({
                url: '{{ route('get-serial-no')}}',
                method: 'GET',
                dataType: "html",
                data: { 'item_register_id': valItemRegisterId },
                success: function(data) {
                    $serialNumberDropdown.html(data);
                },
                error: function() {
                    alert('Failed to fetch data.');
                }
            });
        }
    });

</script>



