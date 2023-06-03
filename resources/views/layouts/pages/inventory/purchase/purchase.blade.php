<x-app-layout>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">
                        @if($type == 1) AC Purchase List
                        @elseif($type == 2) AC Spare Parts Purchase List
                        @else Car Spare Parts Purchase List 
                        @endif
                    </h4>
                    <button id="open_modal" class="btn btn-sm btn-primary"><i class="fa fa-plus"></i><span class="btn-icon-add"></span>Add New</button>
                </div>

                <div class="card-body">
                    <div class="table-responsive">
                        <table id="example3" class="display" style="min-width: 845px">
                            <thead>
                            <tr>
                                <th>SL NO</th>
                                <th>Order Date</th>
                                <th>Order No</th>
                                <th>Supplier Name</th>
                                <th>Store Location</th>
                                <th>Status</th>
                                <th class="text-right">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                                @foreach ($data as $key=> $row)
                                <tr>
                                    <td>{{++$key}}</td>
                                    <td>{{date("j F, Y", strtotime($row->inv_date))}}</td>
                                    <td>{{$row->inv_no}}</td>
                                    <td>{{$row->mastSupplier->supplier_name ?? 'NULL'}}</td>
                                    <td>{{$row->mastWorkStation->store_name ?? 'NULL'}}</td>
                                    <td>@if($row->status == 0)
                                        <span class="badge light badge-warning">
                                            <i class="fa fa-circle text-warning mr-1"></i>Pending
                                        </span>
                                        @elseif($row->status == 1)
                                        <span class="badge light badge-success">
                                            <i class="fa fa-circle text-success mr-1"></i>Successful
                                        </span>
                                        @elseif($row->status == 2)
                                        <span class="badge light badge-danger">
                                            <i class="fa fa-circle text-danger mr-1"></i>Canceled
                                        </span>
                                        @endif
                                    </td>
                                    <td class="text-right">
                                        <button type="button" class="btn btn-sm btn-success p-1 px-2" id="edit_data" data-id="{{ $row->id }}"><i class="fa fa-pencil"></i></i><span class="btn-icon-add"></span>Edit</button>
                                        <button class="btn btn-sm btn-info p-1 px-2 veiw_details" data-toggle="modal" data-id="{{ $row->id }}" data-target="#purchase-details"><i class="fa fa-folder-open"></i><span class="btn-icon-add"></span>View</button>
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

    <div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">
                        @if($type == 1) AC purchase
                        @elseif($type == 2) AC spare parts purchase
                        @else Car spare parts purchase
                        @endif
                    </h5>
                    <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
                </div>
                <form class="form-valide" data-action="{{ route('inv_purchase.store', $type) }}" method="POST" enctype="multipart/form-data" id="add-user-form">
                    @csrf
                    <div class="modal-body py-2">
                        <div class="row" id="main-row-data">
                            <input type="hidden" name="pur_id" id="pur_id">
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label class="col-md-5 col-form-label">Order No.</label>
                                    <div class="col-md-7">
                                        <label class="col-md-5 col-form-label" id="inv_no">GULF-123545</label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label class="col-md-5 col-form-label">Supplier Name
                                        <span class="text-danger">*</span>
                                    </label>
                                    <div class="col-md-7">
                                        <select name="mast_supplier_id" id="mast_supplier_id" class="form-control dropdwon_select" required>
                                        <option selected disabled>--Select--</option>
                                        @foreach($supplier as $row)
                                            <option value="{{ $row->id}}">{{ $row->supplier_name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label class="col-md-5 col-form-label">Order Date
                                        <span class="text-danger">*</span>
                                    </label>
                                    <div class="col-md-7">
                                        <input type="date" name="inv_date" id="inv_date" class="form-control" value="{{ old('date') ? old('date'):  date('Y-m-d') }}">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label class="col-md-5 col-form-label">Store Name
                                        <span class="text-danger">*</span>
                                    </label>
                                    <div class="col-md-7">
                                        <select name="mast_work_station_id" id="mast_work_station_id" class="form-control dropdwon_select" required>
                                            <option selected disabled>--Select--</option>
                                            @foreach ($store as $row)
                                                <option value="{{$row->id}}">{{$row->store_name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group row">
                                    <label for="" class="col-md-2">Remarks</label>
                                    <div class="col-md-10">
                                        <textarea name="remarks" id="remarks" cols="30" rows="2" class="form-control" style="width: 95%; margin-left: 45px;"></textarea>
                                    </div>
                                </div>
                            </div> 
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <!--=====//Table//=====-->
                                <div class="table-responsive">
                                    <table id="items-table" class="table table-bordered">
                                        <thead class="thead-primary">
                                            <tr>
                                                <th width="20%">Part Name</th>
                                                <th width="15%">Part No</th>
                                                <th width="10%">Pkg. Qty.</th>
                                                <th width="10%">Unit</th>
                                                <th width="10%">Qty</th>
                                                <th width="12%">Price</th>
                                                <th width="13%">Subtotal</th>
                                                <th width="10%" class="text-center">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody id="table-body">
                                            {{-- <tr>
                                                <td>
                                                    <select id="item_category" class="dropdwon_select">
                                                    <option selected disabled>--Select--</option>
                                                    @foreach($item_group as $data)
                                                        <option value="{{ $data->id}}">{{ $data->part_name}}</option>
                                                        @endforeach
                                                    </select>
                                                </td><input type="hidden" id="edit_total" value="5000" class="edit_total">
                                                <td><select id="partNumber" name="moreFile[0][item_id]" class="dropdwon_select"></select></td>
                                                <td><input type="text" name="" readonly id="packageSize" class="form-control"></td>
                                                <td><input type="text" name="" readonly id="unit" class="form-control"></td>
                                                <td><input type="number" name="moreFile[0][qty]" id="" class="form-control quantity" placeholder="0.00"></td>
                                                <td><input type="number" name="moreFile[0][price]" id="" class="form-control price" placeholder="0.00"></td>
                                                <td class="subtotal">0.00</td>
                                                <td class="text-center">
                                                    <button type="button" title="Add New" class="btn btn-icon btn-outline-warning border-0 btn-xs add-row"><span class="fa fa-plus"></span></button>
                                                    <button type="button" title="Remove" class="btn btn-icon btn-outline-danger btn-xs border-0 remove-row"><span class="fa fa-trash"></span></button>
                                                </td>
                                            </tr> --}}
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="float-right">
                                    <h6>Total <span style="border: 1px solid #2222;padding: 10px 40px;margin-left:10px" id="total">0.00</span></h6>
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


</x-app-layout>
<script>
    //----Open Modal
    $("#open_modal").on('click',function(){
        $("#main-row-data").load(" #main-row-data", function() {
            $('.dropdwon_select').select2();
        });

        $(".modal-title").html('@if($type == 1) Add AC Purchase @elseif($type == 2) Add AC Spare Parts Purchase @else Add Car Spare Parts Purchase @endif');
        $(".bd-example-modal-lg").modal('show');
        $("#id").val("");

        //----Table Add Remove
        var tableBody = $('#table-body');
        tableBody.empty();

        var newRow = $('<tr>' +
            '<td>'+
                '<select id="item_category" class="form-control dropdwon_select">' +
                '<option selected disabled>--Select--</option>' +
                '@foreach($item_group as $data)' +
                    '<option value="{{ $data->id}}">{{ $data->part_name}}</option>' +
                    '@endforeach' +
                '</select>' +
            '</td>' +
            '<td><select id="partNumber" name="moreFile['+0+'][item_id]" class="form-control dropdwon_select"></select></td>' +
            '<td><input type="text" name="" readonly id="packageSize" class="form-control"></td>' +
            '<td><input type="text" name="" readonly id="unit" class="form-control"></td>' +
            '<td><input type="number" name="moreFile['+0+'][qty]" id="" class="form-control quantity" placeholder="0.00"></td>' +
            '<td><input type="number" name="moreFile['+0+'][price]" id="" class="form-control price" placeholder="0.00"></td>' +
            '<td class="subtotal">0.00</td>' +
            '<td class="text-center">' +
                '<button type="button" title="Add New" class="btn btn-icon btn-outline-warning border-0 btn-xs add-row"><span class="fa fa-plus"></span></button>' +
                '<button type="button" title="Remove" class="btn btn-icon btn-outline-danger btn-xs border-0 remove-row"><span class="fa fa-trash"></span></button>' +
            '</td>'+
        '</tr>');

        $('#items-table tbody').append(newRow);
        newRow.find('.dropdwon_select').select2();
    });
</script>
<script>
    //======Add Or Remove Row
    $(document).ready(function() {
        var i = 0;
        $("#items-table").on("click", ".add-row", function() {++i;
            var newRow = $('<tr>' +
                '<td>'+
                    '<select id="item_category" class="form-control dropdwon_select val_item_category">' +
                    '<option selected disabled>--Select--</option>' +
                    '@foreach($item_group as $data)' +
                        '<option value="{{ $data->id}}">{{ $data->part_name}}</option>' +
                        '@endforeach' +
                    '</select>' +
                '</td>' +
                '<td><select id="partNumber" name="moreFile['+i+'][item_id]" class="form-control dropdwon_select val_part_number"></select></td>' +
                '<td><input type="text" name="" readonly id="packageSize" class="form-control"></td>' +
                '<td><input type="text" name="" readonly id="unit" class="form-control"></td>' +
                '<td><input type="number" name="moreFile['+i+'][qty]" id="" class="form-control quantity val_quantity" placeholder="0.00"></td>' +
                '<td><input type="number" name="moreFile['+i+'][price]" id="" class="form-control price val_price" placeholder="0.00"></td>' +
                '<td class="subtotal">0.00</td>' +
                '<td class="text-center">' +
                    '<button type="button" title="Add New" class="btn btn-icon btn-outline-warning border-0 btn-xs add-row"><span class="fa fa-plus"></span></button>' +
                    '<button type="button" title="Remove" class="btn btn-icon btn-outline-danger btn-xs border-0 remove-row"><span class="fa fa-trash"></span></button>' +
                '</td>'+
            '</tr>');

            document.getElementById("add_row").addEventListener("click", function() {
                var rows = document.querySelectorAll("#audit-design-matrix-table tbody tr");
                var errorMessages = [];
            });
            var count = 2;
            $("#audit-design-matrix-table").on("click", ".add_row", function() {
                var i = count;
                count++;
                var quantity = $(this).closest("tr").find("#quantity");
                var quantityValue = quantity.val();
                if (quantityValue.trim() === "") {
                        $(".submit_btn").click();
                    return;
                }
            });



            var val_item_category = $(".val_item_category").val();
            var val_part_number = $(".val_part_number").val();
            var val_quantity = $(".val_quantity").val();
            var val_price = $(".val_price").val();

            if (true) {
                if (true ) {
                    if (val_quantity === '') {
                        if (val_price === '') {
                            $('#items-table tbody').append(newRow);
                            newRow.find('.dropdwon_select').select2();
                        } else {
                            swal("Error!", "An error occurred. val_price", "error");
                        }
                    } else {
                        swal("Error!", "An error occurred. val_quantity", "error");
                    }
                } else {
                    swal("Error!", "An error occurred. val_part_number", "error");
                }
                
            } else {
                swal("Error!", "An error occurred. val_item_category", "error");
            }
            // $('#items-table tbody').append(newRow);
            // newRow.find('.dropdwon_select').select2();
            
        });
        $('#items-table').on('click', '.remove-row', function() {
            $(this).closest('tr').remove();
            updateSubtotal();
        });
        //======Total Count
        $('#items-table').on('input', '.quantity, .price', function() {
            updateSubtotal();
        });
        function updateSubtotal() {
            var total = 0;
            $('#items-table tbody tr').each(function() {
            var quantity = parseFloat($(this).find('.quantity').val()) || 0;
            var price = parseFloat($(this).find('.price').val()) || 0;
            var edit_total = parseFloat($(this).find('.edit_total').val()) || 0;
            var subtotal = quantity * price;

            $(this).find('.subtotal').text(subtotal.toFixed(2));
            // total += subtotal;
            total = edit_total + subtotal;
            });
            $('#total').text(total.toFixed(2));
        }
    });
    //======Get Item Group All Data
    $(document).on('change','#item_category',function(){
        var partId = $(this).val();
        var currentRow = $(this).closest("tr");
        $.ajax({
            url:'{{ route('get-part-id')}}',
            method:'GET',
            dataType:"html",
            data:{'part_id':partId},
            success:function(data){
                console.log(data)
                currentRow.find('#partNumber').html(data);
            },
            error:function(){
                alert('Fail');
            }
        });
    });
    //======Show Single Row Data
    $(document).on('change','#partNumber', function(){
        var partNumber_id = $(this).val();
        var currentRows = $(this).closest("tr"); 
        
        $.ajax({
            url:'{{ route('get-part-number')}}',
            method:'GET',
            dataType:"JSON",
            data:{'part_id':partNumber_id},
            success:function(data){
                console.log(data)
                currentRows.find('#packageSize').val(data.box_qty);
                currentRows.find('#unit').val(data.unit.unit_name);
                currentRows.find('.quantity').focus();
            }
        });
    });
    //======Validation
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

<script type="text/javascript">
    $(document).ready(function(){
        //---Save Data
        var form = '#add-user-form';
        $(form).on('submit', function(event){
            event.preventDefault();
            var url = $(this).attr('data-action');
            var src = $('#redirect').attr('redirect-action');
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
                    // alert(response.success);
                    swal("Success Message Title", "Well done, you pressed a button", "success")
                    // window.location.href = src;
                    $(".bd-example-modal-lg").modal('hide');
                },
                error: function (xhr) {
                    alert('fail');
                    var errors = xhr.responseJSON.errors;
                    var errorHtml = '';
                    $.each(errors, function(key, value) {
                        errorHtml += '<li style="color:red">' + value + '</li>';
                    });
                    Swal.fire({
                        icon: 'error',
                        title: 'Required data missing?',
                        html: '<ul>' + errorHtml + '</ul>',
                    });
                }
            });
        });
    });
</script>

<script>
    $(document).on('click', '#edit_data', function(){
        var id = $(this).data('id');
        $.ajax({
            url:'{{ route('inv_purchase_edit')}}',
            method:'GET',
            dataType:"JSON",
            data:{id:id},
            success:function(response){
                $(".bd-example-modal-lg").modal('show');
                $(".modal-title").html('@if($type == 1) AC Purchase Edit @elseif($type == 2) AC Spare Parts Purchase Edit @else Car Spare Parts Purchase Edit @endif');
                
                //--Get Master Data
                var data = response.data;

                $("#pur_id").val(data.id);
                $('#inv_no').html(data.inv_no);
                $("#inv_date").val(data.inv_date);
                $('#remarks').html(data.remarks);
                // $('#inv_no').html(response.inv_no);

                //--Get All Supplier Data
                var supplier = response.supplier;
                var supplier_dr = $('#mast_supplier_id');
                supplier_dr.empty();
                supplier_dr.append('<option>Select an Supplier</option>');
                $.each(supplier, function(index, option) {
                    var selected = (option.id == data.mast_supplier_id) ? 'selected' : '';
                    supplier_dr.append('<option value="' + option.id + '" ' + selected + '>' + option.supplier_name + '</option>');
                });
                //--Get All Supplier Data
                var store = response.store;
                var work_station_dr = $('#mast_work_station_id');
                work_station_dr.empty();
                work_station_dr.append('<option>Select an Work Station</option>');
                $.each(store, function(index, option) {
                    var selected = (option.id == data.mast_work_station_id) ? 'selected' : '';
                    work_station_dr.append('<option value="' + option.id + '" ' + selected + '>' + option.store_name + '</option>');
                });

                //--Show Purchase Details Data
                var purchase_det = response.purchase_details;
                var tableBody = $('#table-body');
                tableBody.empty();

                var newRow = $('<tr>' +
                    '<td>'+
                        '<select id="item_category" class="form-control dropdwon_select">' +
                        '<option selected disabled>--Select--</option>' +
                        '@foreach($item_group as $data)' +
                            '<option value="{{ $data->id}}">{{ $data->part_name}}</option>' +
                            '@endforeach' +
                        '</select>' +
                    '</td>' +
                    '<td><select id="partNumber" name="moreFile['+0+'][item_id]" class="form-control dropdwon_select"></select></td>' +
                    '<td><input type="text" name="" readonly id="packageSize" class="form-control"></td>' +
                    '<td><input type="text" name="" readonly id="unit" class="form-control"></td>' +
                    '<td><input type="number" name="moreFile['+0+'][qty]" id="" class="form-control quantity" placeholder="0.00"></td>' +
                    '<td><input type="number" name="moreFile['+0+'][price]" id="" class="form-control price" placeholder="0.00"></td>' +
                    '<td class="subtotal">0.00</td>' +
                    '<td class="text-center">' +
                        '<button type="button" title="Add New" class="btn btn-icon btn-outline-warning border-0 btn-xs add-row"><span class="fa fa-plus"></span></button>' +
                        '<button type="button" title="Remove" class="btn btn-icon btn-outline-danger btn-xs border-0 remove-row"><span class="fa fa-trash"></span></button>' +
                    '</td>'+
                '</tr>');

                $('#items-table tbody').append(newRow);
                newRow.find('.dropdwon_select').select2();

                $.each(purchase_det, function(index, item) {
                    var subtotal = item.qty * item.price;
                    var row = '<tr id="row_todo_'+ item.id + '">';
                    row += '<td>' + item.part_name + '</td>';
                    row += '<td>' + item.part_no + '</td>';
                    row += '<td>' + item.box_qty + '</td>';
                    row += '<td>' + item.unit_name + '</td>';
                    row += '<td>' + item.qty + '</td>';
                    row += '<td>' + item.price + '</td>';
                    row += '<td>'+ subtotal +'</td>';
                    row += '<td class="text-center"><button type="button" title="Add New" class="btn btn-icon btn-outline-warning border-0 btn-xs add-row"><span class="fa fa-plus"></span></button><button type="button" id="delete_todo" data-id="' + item.id +'" title="Remove" class="btn btn-icon btn-outline-danger btn-xs border-0"><span class="fa fa-trash"></span></button></td>';
                    // Add more columns as needed
                    row += '</tr>';
                    // tableBody.prepend(row);

                    if($("#id").val()){
                        $("#row_todo_" + item.id).replaceWith(row);
                    }else{
                        tableBody.prepend(row);
                    }
                    
                });
            },
            error: function(xhr, status, error) {
                console.log(error);
            }
        });
    });

    $(document).ready(function(){
        $.ajaxSetup({
            headers:{
                'x-csrf-token' : $('meta[name="csrf-token"]').attr('content')
            }
        });
    });
    $("body").on('click','#delete_todo',function(){
        var id = $(this).data('id');
        $.ajax({
            url: "{{ url('inv_purchase/destroy')}}" + '/' + id,
            method: 'DELETE',
            type: 'DELETE',
            success: function(response) {
                toastr.success("Record deleted successfully!");
                $("#row_todo_" + id).remove();
                $('#table-body').closest('tr').remove();
            },
            error: function(response) {
                Swal.fire({
                    title: 'Error!',
                    text: 'An error occurred.',
                    icon: 'error',
                    confirmButtonText: 'OK'
                });
            }
        });
    });
</script>
