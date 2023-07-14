<x-app-layout>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Requstion Delivery (<span class="text-success">New</span>)</h4>
                    <a href="#" class="btn btn-sm btn-secondary p-1 px-2"><i class="fa fa-print"></i></i><span class="btn-icon-add"></span>Print</a>
                </div>

                <div class="card-body">
                    <div class="table-responsive">
                        <table id="example3" class="display " style="min-width: 845px">
                            <thead>
                                <tr>
                                    <th>SL#</th>
                                    <th>Invoice No</th>
                                    <th>Invoice Date</th>
                                    <th>Customer Name</th>
                                    <th>Invoice Type</th>
                                    <th>Item Qty</th>
                                    {{-- <th>Qty</th> --}}
                                    <th>Total</th>
                                    <th class="text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody id="sales_tbody">
                                @foreach ($data as $key=> $row)
                                @php
                                    $total = 0;
                                    $qty = 0;
                                    $item = 1;
                                    foreach ($row->storeTransferDetails as $key => $value) {
                                        $total += $value->qty * $value->price;
                                        $qty += $value->qty;
                                        $item += $key;
                                    }
                                @endphp
                                <tr id="row_sales_table_{{ $row->id}}">
                                    <td>{{++$key}}</td>
                                    <td>{{$row->inv_no}}</td>
                                    <td>{{$row->inv_date}}</td>
                                    <td>{{$row->mastWorkStation->store_name ?? 'NULL'}}</td>
                                    <td>{{$row->mastItemCategory->cat_name ?? 'NULL'}}</td>
                                    <td>{{$item }}</td>
                                    {{-- <td>{{$qty }}</td> --}}
                                    <td>{{$total }}</td>
                                    <td class="text-right">
                                        <a href="{{ route('requstion-delivery-details', $row->id) }}" class="btn btn-primary p-1 px-2"><i class="fa fa-folder-open"></i></i><span class="btn-icon-add"></span>View</a>
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
                    <h4 class="card-title">Requstion Delivery (<span class="text-warning">Parsial</span>)</h4>
                </div>

                <div class="card-body">
                    <div class="table-responsive">
                        <table id="example3" class="display " style="min-width: 845px">
                            <thead>
                                <tr>
                                    <th>SL#</th>
                                    <th>Invoice No</th>
                                    <th>Invoice Date</th>
                                    <th>Customer Name</th>
                                    <th>Invoice Type</th>
                                    <th>Item Qty</th>
                                    {{-- <th>Qty</th> --}}
                                    <th>Total</th>
                                    <th class="text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody id="sales_tbody">
                                @foreach ($dataParsial as $key=> $row)
                                @php
                                    $total = 0;
                                    $qty = 0;
                                    $item = 1;
                                    foreach ($row->storeTransferDetails as $key => $value) {
                                        $total += $value->qty * $value->price;
                                        $qty += $value->qty;
                                        $item += $key;
                                    }
                                @endphp
                                <tr id="row_sales_table_{{ $row->id}}">
                                    <td>{{++$key}}</td>
                                    <td>{{$row->inv_no}}</td>
                                    <td>{{$row->inv_date}}</td>
                                    <td>{{$row->mastWorkStation->store_name ?? 'NULL'}}</td>
                                    <td>{{$row->mastItemCategory->cat_name ?? 'NULL'}}</td>
                                    <td>{{$item }}</td>
                                    {{-- <td>{{$qty }}</td> --}}
                                    <td>{{$total }}</td>
                                    <td class="text-right">
                                        <a href="{{ route('report-requstion-delivery.download', $row->id)}}" class="btn btn-sm btn-secondary p-1 px-2"><i class="fa fa-print"></i></i><span class="btn-icon-add"></span>Print</a>
                                        <a href="{{ route('requstion-delivery-details-parsial', $row->id) }}" class="btn btn-sm btn-info p-1 px-2"><i class="fa fa-info"></i></i><span class="btn-icon-add"></span>Details</a>
                                        @if ($row->status != 3)
                                        <a href="{{ route('requstion-delivery-details', $row->id) }}" class="btn btn-primary p-1 px-2"><i class="fa fa-plus"></i></i><span class="btn-icon-add"></span>Add New</a>
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

