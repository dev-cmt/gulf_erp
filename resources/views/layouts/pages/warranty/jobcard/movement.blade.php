
<x-app-layout>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Job Card </h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="example3" class="display">
                            <thead>
                                <tr>
                                    <th>SL#</th>
                                    <th>Issue Date</th>
                                    <th>Customer</th>
                                    <th>Number</th>
                                    <th>Details</th>
                                    <th>Visit</th>
                                    <th class="text-right">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($compliant as $item)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{date("j F Y", strtotime($item->issue_date))}}</td>
                                    <td>{{ $item->mastCustomer->name }}</td>
                                    <td>{{ $item->mastCustomer->phone }}</td>
                                    <td>
                                        <!-- Button trigger modal -->
                                        <button type="button" class="btn btn-sm btn-secondary p-1 px-2" data-toggle="modal" data-target="#exampleModalCenter"><i class="fa fa-folder"></i><span class="btn-icon-add"></span>View</button>
                                        <!-- Modal -->
                                        <div class="modal fade" id="exampleModalCenter">
                                            <div class="modal-dialog modal-dialog-centered" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title">Complaint Details</h5>
                                                        <button type="button" class="close" data-dismiss="modal"><span>&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body py-0">
                                                        @php
                                                            try {
                                                                $noteData = json_decode($item->note);
                                                                if (!empty($noteData)) {
                                                                    foreach ($noteData as $noteItem) {
                                                                        echo '<ul class="my-3">';
                                                                        echo '<li><strong>Part Number:</strong> ' . $noteItem->part_no . '</li>';
                                                                        echo '<li><strong>Part Name:</strong> ' . $noteItem->part_name . '</li>';
                                                                        echo '<li><strong>Serial Number:</strong> ' . $noteItem->serial_no . '</li>';
                                                                        echo '<li><strong>Warranty Status:</strong> ' . $noteItem->warranty_status . '</li>';
                                                                        echo '</ul>';
                                                                    }
                                                                } else {
                                                                    echo '<p>No note data available.</p>';
                                                                }
                                                            } catch (Exception $e) {
                                                                echo '<p>Error parsing note data: ' . $e->getMessage() . '</p>';
                                                            }
                                                            echo '<strong>Description</strong>';
                                                            echo '<textarea rows="3" class="form-control"" readonly>' . $item->remarks. '</textarea>';
                                                        @endphp
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-danger light" data-dismiss="modal">Close</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td>{{ $item->visit }}</td>
                                    <td class="text-right">
                                        <button type="button" id="show-data" data-check="0" data-id="{{ $item->id }}" class="btn btn-sm btn-success p-1 px-2">
                                            <i class="fa fa-bookmark"></i><span class="btn-icon-add"></span>Report
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

    <!-- create modal open-->
    <div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">
                       Technician visit
                    </h5>
                    <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
                </div>
                    <div class="modal-body">
                        <form class="form-valide" data-action="{{ route('store_job_visit') }}" method="POST" enctype="multipart/form-data" id="add-user-form">
                            @csrf
                            <div class="modal-body py-2 px-4">
                                <div class="row">
                                    <div class="col-md-4">
                                       <div class="row">
                                            <label for="" class="col-md-6">Tracking No : </label>
                                                <label for="" style="margin-left: -70px">9</label>
                                       </div>
                                    </div>

                                    <div class="col-md-4" style="margin-left: -80px">
                                        <div class="form-group row">
                                            <label class="col-md-3 col-form-label">Job Date
                                            </label>
                                            <div class="col-md-9">
                                              <input type="date" class="form-control" id="date" name="">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-4" style="margin-left:32px">
                                        <div class="form-group row">
                                            <label class="col-md-5 col-form-label" style="margin-left: -25px">Technician Name
                                            </label>
                                            <div class="col-md-7" style="margin-left: -19px; margin-top:5px">
                                              <input type="text" placeholder="" id="" value="" style="border: none">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                    <hr>
                                <div class="row mt-2">
                                        <div class="col-md-6">
                                           <div class="row">
                                                <label for="" class="col-md-4">Is Next Visit</label>
                                                <div class="col-md-8">
                                                    <input type="date" name="nextVisit" class="form-control">
                                                </div>
                                           </div>

                                        </div>

                                        <div class="col-md-6">
                                            <div class="row">
                                                 <label for="" class="col-md-4"> Next Date</label>
                                                 <div class="col-md-8">
                                                     <input type="date" name="nextDate" class="form-control">
                                                 </div>
                                            </div>

                                         </div>

                                </div>
                                <div class="row mt-2">
                                    <div class="col-md-6">
                                       <div class="row">
                                            <label for="" class="col-md-4">Is Complete</label>
                                            <div class="col-md-8">
                                                <input type="date" name="isComplete" class="form-control">
                                            </div>
                                       </div>

                                    </div>

                                    <div class="col-md-6">
                                        <div class="row">
                                             <label for="" class="col-md-4">Is Spare Parts</label>
                                             <div class="col-md-8">
                                                 <input type="text" name="isSpareParts" class="form-control">
                                             </div>
                                        </div>

                                     </div>
                                 </div>

                                 <div class="row mt-2">
                                    <div class="col-md-6">
                                       <div class="row">
                                            <label for="" class="col-md-4">Note</label>
                                            <div class="col-md-8">
                                                <textarea name="" id="" name="note" cols="30" rows="3" class="form-control"></textarea>
                                            </div>
                                       </div>

                                    </div>

                                    <div class="col-md-6">
                                        <div class="row">
                                            <label for="" class="col-md-4">Observe Details</label>
                                            <div class="col-md-8">
                                                <textarea name="" id="" name="observeDetails" cols="30" rows="3" class="form-control"></textarea>
                                            </div>
                                       </div>

                                     </div>
                                 </div>
                            </div>
                            <div class="modal-footer" style="height:50px">
                                <button type="submit" class="btn btn-sm btn-primary submit_btn">submit</button>
                            </div>
                        </form>
                    </div>
            </div>
        </div>
    </div>

</x-app-layout>

<script>
    $(document).on('click', '#show-data', function() {
        var id = $(this).data('id');
        $('.bd-example-modal-lg').modal('show');
    });
    $(document).ready(function(){
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
                    $('.bd-example-modal-lg').modal('hide');
                    console.log(response);
                    location.reload();
                }
            });
        });
        
    });
</script>
show-data