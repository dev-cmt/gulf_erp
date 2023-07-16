<x-app-layout>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Purchase Recived (<span class="text-success">New</span>)</h4>
                    <a href="#" class="btn btn-sm btn-secondary p-1 px-2"><i class="fa fa-print"></i></i><span class="btn-icon-add"></span>Print</a>
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
                                <th>Item Qty</th>
                                {{-- <th>Total Qty</th> --}}
                                <th>Total</th>
                                <th class="text-right">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                                @foreach ($data as $keys=> $row)
                                @php
                                    $total = 0;
                                    $qty = 0;
                                    $item = 0;
                                    foreach ($row->purchaseDetails as $key => $value) {
                                        $total += $value->qty * $value->price;
                                        $qty += $value->qty;
                                        $item += $key;
                                    }
                                @endphp
                                <tr>
                                    <td>{{++$keys}}</td>
                                    <td>{{$row->inv_no}}</td>
                                    <td>{{date("j F, Y", strtotime($row->inv_date))}}</td>
                                    <td>{{$row->mastSupplier->supplier_name}}</td>
                                    <td>{{$row->mastWorkStation->store_name}}</td>
                                    <td>{{$item != 0 ? $item : '1'}}</td>
                                    {{-- <td>{{$qty }}</td> --}}
                                    <td>{{$total }}</td>
                                    <td class="text-right">
                                        <a href="{{ route('grn-purchase-details', $row->id) }}" class="btn btn-primary p-1 px-2"><i class="fa fa-folder-open"></i></i><span class="btn-icon-add"></span>View</a>
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
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Purchase Recived (<span class="text-warning">Parsial</span>)</h4>
                    <a href="#" class="btn btn-sm btn-secondary p-1 px-2"><i class="fa fa-print"></i></i><span class="btn-icon-add"></span>Print</a>
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
                                <th>Item Qty</th>
                                {{-- <th>Total Qty</th> --}}
                                <th>Total</th>
                                <th class="text-Center">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                                @foreach ($dataParsial as $keys=> $row)
                                @php
                                    $total = 0;
                                    $qty = 0;
                                    $item = 0;
                                    foreach ($row->purchaseDetails as $key => $value) {
                                        $total += $value->qty * $value->price;
                                        $qty += $value->qty;
                                        $item += $key;
                                    }
                                @endphp
                                <tr>
                                    <td>{{++$keys}}</td>
                                    <td>{{$row->inv_no}}</td>
                                    <td>{{date("j F, Y", strtotime($row->inv_date))}}</td>
                                    <td>{{$row->mastSupplier->supplier_name}}</td>
                                    <td>{{$row->mastWorkStation->store_name}}</td>
                                    <td>{{$item != 0 ? $item : '1'}}</td>
                                    {{-- <td>{{$qty }}</td> --}}
                                    <td>{{$total }}</td>
                                    <td class="text-right">
                                        <a href="{{ route('report-purchase-receive-parsial.download', $row->id)}}" class="btn btn-sm btn-secondary p-1 px-2"><i class="fa fa-print"></i></i><span class="btn-icon-add"></span>Print</a>
                                        <a href="{{ route('purchase-details-parsial', $row->id) }}" class="btn btn-sm btn-info p-1 px-2"><i class="fa fa-info"></i></i><span class="btn-icon-add"></span>Details</a>
                                        @if ($row->status != 3)
                                        <a href="{{ route('grn-purchase-details', $row->id) }}" class="btn btn-primary p-1 px-2"><i class="fa fa-plus"></i></i><span class="btn-icon-add"></span>Add New</a>
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

</x-app-layout>

