<x-app-layout>
    <div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Purchase</h5>
                    <button type="button" class="close" data-dismiss="modal"><span>&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p class="text-center text-success">{{Session::get('message')}}</p>
                    <form class="form-valide" action="{{ route('purchase.store')}}" method="post" enctype="multipart/form-data" name="form">
                        @csrf

                        <div class="row">
                            <div class="col-md-12">
                                <!--=====//Table//=====-->
                                <table id="items-table" class="table table-bordered">
                                    <thead class="thead-primary">
                                        <tr>
                                            <th width="20%">Part Name</th>
                                            <th width="18%">Part No</th>
                                            <th width="10%">Pkg. Qty.</th>
                                            <th width="10%">Unit</th>
                                            <th width="10%">Qty</th>
                                            <th width="10%">Price</th>
                                            <th width="10%">Subtotal</th>
                                            <th width="12%" class="text-center">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>
                                                <select type="text" id="item_category" class="form-control">
                                                <option selected disabled>Select a Part Name</option>
                                                @foreach($partName as $data)
                                                    <option value="{{ $data->id}}">{{ $data->part_name}}</option>
                                                    @endforeach
                                                </select>
                                            </td>
                                            <td><select id="partNumber" name="moreFile[0][item_id]" class="form-control"></select></td>
                                            <td><input type="text" name="" readonly id="packageSize" class="form-control"></td>
                                            <td><input type="text" name="" readonly id="unit" class="form-control"></td>
                                            <td><input type="number" name="moreFile[0][qty]" id="" class="form-control quantity" placeholder='0.00'></td>
                                            <td><input type="number" name="moreFile[0][price]" id="" class="form-control price" placeholder='0.00'></td>
                                            <td class="subtotal">0.00</td>
                                            <td class="text-center">
                                                <button type="button" title="Add New" class="btn btn-icon btn-outline-warning border-0 btn-xs" id="add-row"><span class="fa fa-plus"></span></button>
                                                <button type="button" title="Remove" class="btn btn-icon btn-outline-danger btn-xs border-0 remove-row"><span class="fa fa-trash"></span></button>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="col-md-12">
                                <div class="float-right">
                                    <p>Total: <span id="total">0.00</span></p>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>




    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">
                    @if($type == 1)
                            AC purchase
                            @elseif($type == 2)
                            AC spare parts purchase
                            @else
                            Car spare parts purchase
                        @endif
                    <span class="bg-blue-500 text-white rounded px-1 text-xs py-0.5"></span></h4>
                    {{-- @can('Role create') --}}
                    <a href="#" class="btn btn-sm btn-primary" data-toggle="modal" data-target=".bd-example-modal-lg"><i class="fa fa-plus"></i><span class="btn-icon-add" data-bs-toggle="modal"></span>Create</a>
                    {{-- @endcan --}}
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
                                <th>Delivery Location</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>1</td>
                                    <td>16-05-2023</td>
                                    <td>GL-5678-QN-5287</td>
                                    <td>Kuddus</td>
                                    <td>Dhaka</td>
                                    <td>Pending</td>
                                    <td>OK</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        
          
    </div>


</x-app-layout>

<script>
    $(document).ready(function() {
        
        $('#add-row').click(function() {
            var i = 0;
            ++i;
            var newRow = '<tr>' +
                '<td>' +
                    '<select type="text" id="item_category" class="form-control">' +
                        '<option selected disabled>Select a Part Name</option>'
                        '@foreach($partName as $data)' +
                        '<option value="{{ $data->id}}">{{ $data->part_name}}</option>' +
                        '@endforeach' +
                    '</select>' +
                '</td>' +
                '<td><select id="partNumber" name="moreFile['+i+'][item_id]" class="form-control"></select></td>' +
                '<td><input type="text" name="" readonly id="packageSize" class="form-control"></td>' +
                '<td><input type="text" name="" readonly id="unit" class="form-control"></td>' +
                '<td><input type="number" name="moreFile['+i+'][qty]" id="" class="form-control quantity" placeholder='0.00'></td>' +
                '<td><input type="number" name="moreFile['+i+'][price]" id="" class="form-control price" placeholder='0.00'></td>' +
                '<td class="subtotal">0.00</td>' +
                '<td class="text-center">' +
                    '<button type="button" title="Add New" class="btn btn-icon btn-outline-warning border-0 btn-xs" id="add-row"><span class="fa fa-plus"></span></button>' +
                    '<button type="button" title="Remove" class="btn btn-icon btn-outline-danger btn-xs border-0 remove-row"><span class="fa fa-trash"></span></button>' +
                '</td>' +
            '</tr>';
            $('#items-table tbody').append(newRow);
        });

        $('#items-table').on('click', '.remove-row', function() {
            $(this).closest('tr').remove();
            updateSubtotal();
        });

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

</script>



<script>
    var i = 0;
    $("#audit-design-matrix-table").on("click", ".add_row", function() {
        ++i;
        $('#audit-design-matrix-table > tbody:last').append('<tr class="audit_design_matrix_row"><td><select type="text" id="partName" name="" class="form-control expected_benefits"><option selected disabled>Select a Part Name</option> @foreach($partName as $data) <option value="{{ $data->id}}">{{ $data->part_name}}</option> @endforeach </select></td><td><select type="text" id="partNumber" name="moreFile['+i+'][item_id]" class="form-control expected_benefits"></select></td><td><input type="text" name="" readonly id="packageSize" class="form-control expected_benefits"></td><td><input type="text" name="" readonly id="unit" class="form-control expected_benefits"></td><td><input type="number" name="moreFile['+i+'][qty]" class="form-control quantity expected_benefits" placeholder="0.00"></td><td><input type="number" name="moreFile['+i+'][price]" class="form-control price expected_benefits" placeholder="0.00"></td><td><div style="display: flex"><button type="button" title="Add" onclick="" class="btn btn-icon btn-outline-warning border-0 btn-xs mr-2 add_row"><span class="fa fa-plus"></span></button><button type="button" title="Remove" data-row="row1" onclick="" class="btn btn-icon btn-outline-danger btn-xs border-0 mr-2 delete_row"><span class="fa fa-trash"></span></button></div></td></tr>');
        $("#audit-design-matrix-table").on("click", ".delete_row", function() {
            $(this).closest("tr").remove();
        });
    });
</script>

<script>
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
    //=======Total Count
    // $('#price, #quantity').keyup(function(){
    //     var price = parseFloat($('#price').val());
    //     var qty = parseFloat($('#quantity').val());
    //     $('#total').val(price * qty+'.00');
    // });

    $('.price, .quantity').keyup(function(){
        let total = 0;
        $('#audit-design-matrix-table').each(function() {
            alert('hi2')
            const quantity = parseFloat($(this).find('.quantity').val()) || 0;
            const price = parseFloat($(this).find('.price').val()) || 0;
            const lineTotal = quantity * price;

            $('#total').val(quantity * price+'.00');
        });
    });


</script>
