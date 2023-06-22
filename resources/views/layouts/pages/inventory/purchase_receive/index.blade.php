<x-app-layout>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Purchase Recived</h4>
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
                                <th>Store Location</th>
                                <th class="text-right">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                                @foreach ($data as $key=> $row)
                                <tr>
                                    <td>{{++$key}}</td>
                                    <td>{{$row->inv_no}}</td>
                                    <td>{{date("j F, Y", strtotime($row->inv_date))}}</td>
                                    <td>{{$row->mastSupplier->supplier_name}}</td>
                                    <td>{{$row->mastWorkStation->store_name}}</td>
                                    <td class="text-right">
                                        <a href="{{ route('grmPurchaseDetails', $row->id) }}" class="btn btn-sm btn-info p-1 px-2"><i class="fa fa-folder-open"></i></i><span class="btn-icon-add"></span>View</a>
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

    <!--============//Edit Modal Data//================-->
    <div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Purchase Receive</h5>
                    <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
                </div>
                <form class="form-valide" data-action="{{ route('inv_purchase.store', 1) }}" method="POST" enctype="multipart/form-data" id="add-user-form">
                    @csrf
                    <div class="modal-body py-2">
                        <div class="row" id="main-row-data">
                            <input type="hidden" name="pur_id" id="pur_id">
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label class="col-md-5 col-form-label">Order No.</label>
                                    <div class="col-md-7">
                                        <label class="col-md-5 col-form-label" id="inv_no">GULF-XXXXX</label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label class="col-md-5 col-form-label">Supplier Name
                                        <span class="text-danger">*</span>
                                    </label>
                                    <div class="col-md-7">
                                        <label class="col-md-12 col-form-label" id="mast_supplier_id"></label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label class="col-md-5 col-form-label">Order Date
                                        <span class="text-danger">*</span>
                                    </label>
                                    <div class="col-md-7">
                                        <label class="col-md-5 col-form-label" id="inv_date"></label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label class="col-md-5 col-form-label">Store Name
                                        <span class="text-danger">*</span>
                                    </label>
                                    <div class="col-md-7">
                                        <label class="col-md-12 col-form-label" id="mast_work_station_id"></label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group row">
                                    <label for="" class="col-md-2">Remarks</label>
                                    <div class="col-md-10">
                                        <label class="col-md-12 col-form-label" id="remarks"></label>
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
                                                <th width="10%" class="text-center table_action">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody id="table-body">
                                            
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="float-right">
                                    <input type="hidden" id="edit_total" value="">
                                    <h6>Total <span style="border: 1px solid #2222;padding: 10px 40px;margin-left:10px" id="total">0.00</span></h6>
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
    /*=======//Show Modal//=========*/
    $(document).on('click','#open_modal',function(){
        
    });
    /*=======//GRN Purchase Edit//=========*/
    $(document).on('click','#edit_data', function(){
        var id = $(this).data('id');
        $(".bd-example-modal-lg").modal('show');
        
        $.ajax({
            url:'{{ route('grn_purchase_edit')}}',
            method:'GET',
            dataType:"JSON",
            data:{'id': id},
            success:function(response){
                $('#inv_no').html(response.inv_no);
                $("#inv_date").html(response.inv_date);
                $("#mast_supplier_id").html(response.name);
                $("#mast_work_station_id").html(response.store_name);
                $('#remarks').html(daresponseta.remarks);
            },
            error: function(response) {
                swal("Error!", "All input values are not null or empty.", "error");
            }
        });
    });
</script>



