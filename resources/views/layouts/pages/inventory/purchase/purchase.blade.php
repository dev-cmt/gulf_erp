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
                                        <button class="btn btn-sm btn-success p-1 px-2 veiw_details" data-toggle="modal" data-id="{{ $row->id }}" data-target="#purchase-details"><i class="fa fa-folder-open"></i><span class="btn-icon-add"></span>View</button>
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
                    <button type="button" class="close" data-dismiss="modal"><span>&times;</span>
                    </button>
                </div>
                <form action="{{ route('purchase.store', $type)}}" method="POST" enctype="multipart/form-data" id="form_data">
                    @csrf
                    <div class="modal-body py-2">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label class="col-md-5 col-form-label">Order No.</label>
                                    <div class="col-md-7">
                                        <input type="hidden" name="id" id="id">
                                        <label class="col-md-5 col-form-label">GULF-123545</label>
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

                    </div>
                    <div class="modal-footer" style="height:50px">
                        <button type="button" class="btn btn-sm btn-danger light" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-sm btn-primary" id="output">Submit</button>
                    </div>
                </form>
                
            </div>
        </div>
    </div>



</x-app-layout>

<script>
    //======Add Or Remove Row
    $(document).ready(function() {
        var i = 0;
        $("#items-table").on("click", ".add-row", function() {++i;
            var newRow = $('<tr>' +
                '<td>'+
                    '<select id="item_category" class="form-control dropdwon_select">' +
                    '<option selected disabled>--Select--</option>' +
                    '@foreach($item_group as $data)' +
                        '<option value="{{ $data->id}}">{{ $data->part_name}}</option>' +
                        '@endforeach' +
                    '</select>' +
                '</td>' +
                '<td><select id="partNumber" name="moreFile['+i+'][item_id]" class="form-control dropdwon_select"></select></td>' +
                '<td><input type="text" name="" readonly id="packageSize" class="form-control"></td>' +
                '<td><input type="text" name="" readonly id="unit" class="form-control"></td>' +
                '<td><input type="number" name="moreFile['+i+'][qty]" id="" class="form-control quantity" placeholder="0.00"></td>' +
                '<td><input type="number" name="moreFile['+i+'][price]" id="" class="form-control price" placeholder="0.00"></td>' +
                '<td class="subtotal">0.00</td>' +
                '<td class="text-center">' +
                    '<button type="button" title="Add New" class="btn btn-icon btn-outline-warning border-0 btn-xs add-row"><span class="fa fa-plus"></span></button>' +
                    '<button type="button" title="Remove" class="btn btn-icon btn-outline-danger btn-xs border-0 remove-row"><span class="fa fa-trash"></span></button>' +
                '</td>'+
            '</tr>');

            $('#items-table tbody').append(newRow);
            newRow.find('.dropdwon_select').select2();
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
            var subtotal = quantity * price;

            $(this).find('.subtotal').text(subtotal.toFixed(2));
            total += subtotal;
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
                currentRows.find('#quantity').focus();
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

<script>
    //get Leave Details
    $(document).ready(function() {
        $('.table-responsive').on('click','.veiw_details',function(){
            let userId = $(this).data('id');
            alert('userId');
            $.ajax({
                url:'{{ route('get_purchase_details','+userId +') }}',
                method:'GET',
                data:{userId},
                success:function(response){
                    $('#target-element').html(response);
                    // var tbody = $('.leaves-table tbody');
                    // tbody.empty();
                    // $.each(response, function(index, leave) {
                    //     var row = $('<tr></tr>');
                    //     row.append('<td>' + leave.leave_name + '</td>');
                    //     row.append('<td>' + leave.start_date + '</td>');
                    //     row.append('<td>' + leave.start_date + '</td>');
                    //     row.append('<td>' + leave.duration + '</td>');
                    //     tbody.append(row);
                    // });
                }
            });
        });
    });
</script>


<script type="text/javascript">

    $(document).ready(function(){
        $.ajaxSetup({
            headers:{
                'x-csrf-token' : $('meta[name="csrf-token"]').attr('content')
            }
        });
    });

    //----Open Modal
    $("#open_modal").on('click',function(){
        $("#form_data").trigger('reset');
        $(".modal-title").html('@if($type == 1) AC Purchase List @elseif($type == 2) AC Spare Parts Purchase List @else Car Spare Parts Purchase List @endif');
        $(".bd-example-modal-lg").modal('show');
        $("#id").val("");
    });

    //----Open Edit
    $("body").on('click','#edit_todo',function(){
        var id = $(this).data('id');
        $.get('todos/'+id+'/edit',function(res){
            $("#modal_title").html('Edit Todo');
            $("#id").val(res.id);
            $("#name_todo").val(res.name);
            $("#modal_todo").modal('show');
        });
    });

    //----Save data 
    $("form").on('submit',function(e){
        e.preventDefault();
        $.ajax({
            url:"todos/store",
            data: $("#form_todo").serialize(),
            type:'POST'
        }).done(function(res){
            
            alert("hi");

            $("#form_todo").trigger('reset');
            $("#open_modal").modal('hide');
        });
    });



</script>
