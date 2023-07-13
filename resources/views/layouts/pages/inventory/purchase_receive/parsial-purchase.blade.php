<x-app-layout>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Purchase Receive (<span class="text-warning">Parsial</span>)</h4>
                    <a href="{{ route('grn-purchase.index') }}" class="btn btn-sm btn-primary"><i class="fa fa-reply"></i><span class="btn-icon-add"></span>Back</a>
                </div>

                <div class="card-body pt-2">
                    <div class="row">
                        <div class="col-md-4 col-sm-12">
                            <div class="row">
                                <label class="col-6 col-form-label"><strong> Invoice No :</strong></label>
                                <label class="col-6 col-form-label">{{$purchase->inv_no}}</label>
                            </div>
                        </div>
                        <div class="col-md-4 col-sm-12">
                            <div class="row">
                                <label class="col-6 col-form-label"><strong>Invoice Date :</strong></label>
                                <label class="col-6 col-form-label">{{date("j F, Y", strtotime($purchase->inv_date))}}</label>
                            </div>
                        </div>
                        <div class="col-md-4 col-sm-12">
                            <div class="row">
                                <label class="col-6 col-form-label"><strong>Supplier Name :</strong></label>
                                <label class="col-6 col-form-label">{{$purchase->mastSupplier->supplier_name}}</label>
                            </div>
                        </div>
                    </div>
                    <br>
                    @php
                        $latestDate = $data->groupBy('created_at')->keys()->last();
                        $latestData = $data->where('created_at', $latestDate);
                    @endphp

                    <h4>{{date("j F, Y", strtotime($latestDate))}}</h4>
                    <div class="table-responsive">
                        <table id="items-table" class="table table-bordered">
                            <thead class="thead-light">
                            <tr>
                                <th>SL#</th>
                                <th>Serial No</th>
                                <th>Category</th>
                                <th>Group Name</th>
                                <th>Part No.</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                                @foreach ($latestData as $key => $row)
                                <tr>
                                    <td>{{ ++$key }}</td>
                                    <td>{{ $row->serial_no }}</td>
                                    <td>{{ $row->cat_name }}</td>
                                    <td>{{ $row->part_name }}</td>
                                    <td>{{ $row->part_no }}</td>
                                    <td>{{ $row->created_at }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                </div>

            </div>
        </div>
    </div>
    @foreach($data->groupBy('created_at') as $date => $groupedData)
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h4>{{date("j F, Y", strtotime($date))}}</h4>
                    <a href="#" class="btn btn-sm btn-secondary p-1 px-2"><i class="fa fa-print"></i></i><span class="btn-icon-add"></span>Print</a>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="items-table" class="table table-bordered">
                            <thead class="thead-light">
                            <tr>
                                <th>SL#</th>
                                <th>Serial No</th>
                                <th>Category</th>
                                <th>Group Name</th>
                                <th>Part No.</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                                @foreach ($groupedData as $key=> $row)
                                <tr>
                                    <td>{{++$key}}</td>
                                    <td>{{$row->serial_no}}</td>
                                    <td>{{$row->cat_name}}</td>
                                    <td>{{$row->part_name}}</td>
                                    <td>{{$row->part_no}}</td>
                                    <td>{{$row->created_at}}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endforeach
</x-app-layout>

