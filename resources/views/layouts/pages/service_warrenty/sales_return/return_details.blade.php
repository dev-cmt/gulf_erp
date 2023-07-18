<x-app-layout>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Sales Delivery Details</h4>
                    <a href="{{ route('sales-return.index') }}" class="btn btn-sm btn-primary"><i class="fa fa-reply"></i><span class="btn-icon-add"></span>Back</a>
                </div>

                <div class="card-body pt-2">
                    <div class="row">
                        <div class="col-md-4 col-sm-12">
                            <div class="row">
                                <label class="col-6 col-form-label"><strong> Invoice No :</strong></label>
                                <label class="col-6 col-form-label">{{$sales->inv_no}}</label>
                            </div>
                        </div>
                        <div class="col-md-4 col-sm-12">
                            <div class="row">
                                <label class="col-6 col-form-label"><strong>Invoice Date :</strong></label>
                                <label class="col-6 col-form-label">{{date("j F, Y", strtotime($sales->inv_date))}}</label>
                            </div>
                        </div>
                        <div class="col-md-4 col-sm-12">
                            <div class="row">
                                <label class="col-6 col-form-label"><strong>Store Name :</strong></label>
                                <label class="col-6 col-form-label">{{$store->store_name}}</label>
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
                                <th>Deli. Qty</th>
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
                                    <td>{{$row->deli_qty ?? '0' }}</td>
                                    <td>{{$row->qty * $row->price}}</td>
                                    <td class="text-right">
                                        <button type="button" class="btn btn-sm btn-success p-1 px-2" id="edit_data" data-id="{{ $row->id }}"><i class="fa fa-plus"></i></i><span class="btn-icon-add"></span>Add</button>
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

    <!--============//Add Sl No. Modal Data//================-->
    <div class="modal fade" id="modalGrid">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add Sales Return </h5>
                    <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
                </div>
                <form class="form-valide" data-action="{{ route('sales-return.store') }}" method="POST" enctype="multipart/form-data" id="add-user-form">
                    @csrf
                    <div class="modal-body py-2">
                        <div class="row" id="main-row-data">
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label class="col-md-5 col-form-label px-0"><strong>Invoice No.</strong> </label>
                                    <div class="col-md-7">
                                        <label class=col-form-label id="inv_no"></label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label class="col-md-5 col-form-label px-0"><strong>Invoice Date</strong></label>
                                    <div class="col-md-7">
                                        <label class=col-form-label id="inv_date"></label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label class="col-md-5 col-form-label px-0"><strong>Customer</strong></label>
                                    <div class="col-md-7">
                                        <label class=col-form-label id="mast_customer_id"></label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label class="col-md-5 col-form-label px-0"><strong>Part No.</strong></label>
                                    <div class="col-md-7">
                                        <label class=col-form-label id="getPartNo"></label>
                                    </div>
                                </div>
                            </div>
                            {{-- <div class="col-md-12">
                                <div class="form-group row">
                                    <label class="col-md-2 col-form-label px-0"><strong>Remarks</strong></label>
                                    <div class="col-md-10">
                                        <textarea class="form-control" name="remarks" id="remarks"></textarea>
                                    </div>
                                </div>
                            </div>  --}}
                            <input type="hidden" id="workStationId" name="mast_work_station_id" value="{{ Auth::user()->mast_work_station_id }}">
                            
                            <input type="hidden" id="itemRegisterId" name="item_register_id">
                            <input type="hidden" id="getDeliQty">
                            <input type="hidden" id="qty">
                            <input type="hidden" id="deliQty" name="deli_qty">
                            <input type="hidden" id="storeTransferId" name="store_transfer_id">
                            <input type="hidden" id="storeTransferDetailsId" name="store_transfer_details_id">
                        </div>

                        <div class="row">
                            <div class="col-md-12 pl-0">
                                <!--=====//Table//=====-->
                                <div class="table-responsive">
                                    <table id="items-table" class="table table-bordered">
                                        <thead class="thead-light">
                                            <tr>
                                                <th width="5%"></th>
                                                <th width="35%">Serial No.</th>
                                                <th width="35%">Part No.</th>
                                                <th width="25%">Delivery</th>
                                            </tr>
                                        </thead>
                                        <tbody id="table-body"></tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-2 col-form-label px-0"><strong>Remarks</strong></label>
                            <div class="col-md-10">
                                <textarea class="form-control" name="remarks"></textarea>
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
                $('#getDeliQty').val(response.deli_qty);
                $('#deliQty').val(response.deli_qty + 1);
                $('#getPartNo').html(response.part_no);
                $('#storeTransferId').val(response.store_transfer_id);
                $('#storeTransferDetailsId').val(response.id);

                var storeId= $('#workStationId').val();

                getSlNo(response.item_register_id, storeId);
            },
            error: function(response) {
                swal("Error!", "All input values are not null or empty.", "error");
            }
        });
        //--Dropdwon Search Fix
        $('.dropdwon_select').each(function () {
            $(this).select2({
                dropdownParent: $(this).parent()
            });
        });
    });

    
     /*=======// UGet Serial Number //=========*/
    function getSlNo(item_register_id, storeId) {
        var currentRow = $('#items-table tbody').find("tr:last");
        $.ajax({
            url:'{{ route('get-sales-delivery-slno')}}',
            method:'GET',
            dataType:"JSON",
            // data:{'mast_item_register_id':item_register_id, 'mast_work_station_id':storeId, 'reference_type_id': [1, 3], 'status': 1},
            data:{'reference_id': 3,'mast_item_register_id': 2, 'mast_work_station_id': 1, 'reference_type_id': [2], 'status': 0},
            success:function(response){
                //--Tabel Sales Delivery
                var tableBody = $('#table-body');
                tableBody.empty();
                var data_sl = response.data;
                var i = 0;
                $.each(data_sl, function(index, item) {
                    var newRow = $('<tr>' +
                        '<input type="hidden" name="moreFile['+i+'][sl_movement_id]" class="form-control" value="' + item.id + '">' +
                        '<td><input type="checkbox" name="" value="1"></td>' +
                        '<td>' + item.serial_no + '</td>' +
                        '<td>' + item.part_no + '</td>' +
                        '<td>' + formatDate(item.created_at) + '</td>' +
                    '</tr>');

                    tableBody.append(newRow);
                    $("#modalGrid").modal('show');
                });
                function formatDate(dateString) {
                    const options = { year: "numeric", month: "long", day: "numeric" };
                    return new Date(dateString).toLocaleDateString(undefined, options);
                }
            },
            error:function(){
                alert('Fail');
            }
        });
    }
    
    /*===========// Save Data//===========*/
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
    });
</script>



