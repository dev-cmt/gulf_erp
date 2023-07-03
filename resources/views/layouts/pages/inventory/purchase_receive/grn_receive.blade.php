<x-app-layout>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Purchase Details List</h4>
                </div>

                <div class="card-body">
                    <div class="table-responsive">
                        <table id="example3" class="display " style="min-width: 845px">
                            <thead>
                            <tr>
                                <th>SL#</th>
                                <th>Order No</th>
                                <th>Order Date</th>
                                <th>Supplier Name</th>
                                <th>Price</th>
                                <th>Qty</th>
                                <th>Total</th>
                                <th class="text-right">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                                @foreach ($data as $key=> $row)
                                <tr>
                                    <td>{{++$key}}</td>
                                    <td>{{$row->inv_no}}</td>
                                    <td>{{date("j F, Y", strtotime($row->inv_date))}}</td>
                                    <td>{{$row->name}}</td>
                                    <td>{{$row->price}}</td>
                                    <td>{{$row->qty}}</td>
                                    <td>{{$row->qty * $row->price}}</td>
                                    <td class="text-right">
                                        <button type="button" class="btn btn-sm btn-success p-1 px-2" id="edit_data" data-detId="5" data-id="{{ $row->id }}"><i class="fa fa-plus"></i></i><span class="btn-icon-add"></span>Add</button>
                                        <button type="button" class="btn btn-sm btn-primary p-1 px-2" id="upload_excel" data-id="{{ $row->id }}"><i class="fa fa-paperclip"></i></i><span class="btn-icon-add"></span>Upload</button>
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
                <form class="form-valide" data-action="{{ route('grm-purchase-store') }}" method="POST" enctype="multipart/form-data" id="add-user-form">
                    @csrf
                    <div class="modal-body py-2">
                        <div class="row" id="main-row-data">
                            <input type="hidden" name="pur_id" id="pur_id">
                            <div class="col-md-12">
                                <div class="form-group row">
                                    <label class="col-md-4 col-form-label">Order No.</label>
                                    <div class="col-md-8">
                                        <label class="col-md-12 col-form-label" id="inv_no">GULF-XXXXX</label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group row">
                                    <label class="col-md-4 col-form-label">Supplier Name</label>
                                    <div class="col-md-8">
                                        <label class="col-md-12 col-form-label" id="mast_supplier_id"></label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group row">
                                    <label class="col-md-4 col-form-label">Order Date</label>
                                    <div class="col-md-8">
                                        <label class="col-md-12 col-form-label" id="inv_date"></label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group row">
                                    <label class="col-md-4 col-form-label">Store Name</label>
                                    <div class="col-md-8">
                                        <label class="col-md-12 col-form-label" id="mast_work_station_id"></label>
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
                            <input type="hidden" id="qty">
                            <input type="hidden" id="getPartNo">
                        </div>

                        <div class="row" style="height: 180px; overflow-y: auto">
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
                    <div class="modal-footer" style="height:50px">
                        <button type="button" class="btn btn-sm btn-danger light" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-sm btn-primary submit_btn">Submit</button>
                    </div>
                </form>
                
            </div>
        </div>
    </div>

</x-app-layout>

    <script>
        /*=======//GRN Purchase Add Modal//=========*/
        $(document).on('click','#edit_data', function(){
            var id = $(this).data('id');
            $.ajax({
                url:'{{ route('get_purchase_details')}}',
                method:'GET',
                dataType:"JSON",
                data:{'id': id},
                success:function(response){
                    $('#inv_no').html(response.inv_no);
                    $("#inv_date").html(response.inv_date);
                    $("#mast_supplier_id").html(response.name);
                    $("#mast_work_station_id").html(response.store_name);
                    $('#remarks').html(response.remarks);
                    $('#qty').val(response.qty);
                    $('#getPartNo').val(response.part_no);
                    $('.part_number').html(response.part_no);
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
                    swal("Success Message Title", "Well done, you pressed a button", "success")
                    $("#modalGrid").modal('hide');
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
        });
    </script>
    <input type="hidden" id="getSerialNo" value="1">
    <script>
        $(document).ready(function() {
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
                    var qtyCheck = $('#qty').val();
                    var rowCount = parseInt($('#items-table tbody tr').length) + 1;
                    if(qtyCheck >= rowCount ){
                        ++count;
                        addRow(count);
                    }else{
                        Swal.fire(
                            'Your filup data',
                            'Is something wrong with your form data?',
                            'question'
                        )
                    }
                } else {
                    swal("Error!", "All input values are not null or empty.", "error");
                }
            });
        });

        function addRow(i){
            var rowCount = parseInt($('#items-table tbody tr').length) + 1;
            var partNumber = $('#getPartNo').val();
            var newRow = $('<tr>' +
                '<td><label class="form-label">'+rowCount+'</label></td>' +
                '<td><label class="form-label part_number">'+partNumber+'</label></td>' +
                '<td><input type="text" name="moreFile['+i+'][serial_no]" id="serial_no" class="form-control val_serial_no" placeholder="XXXXXXXXXX"></td>' +
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
        });
    </script>



