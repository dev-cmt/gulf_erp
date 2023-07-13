<x-app-layout>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Reports Purchase Recived</h4>
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
                                @foreach ($data as $key=> $row)
                                @php
                                    $total = 0;
                                    $qty = 0;
                                    $item = 1;
                                    foreach ($row->purchaseDetails as $key => $value) {
                                        $total += $value->qty * $value->price;
                                        $qty += $value->qty;
                                        $item += $key;
                                    }
                                @endphp
                                <tr>
                                    <td>{{++$key}}</td>
                                    <td>{{$row->inv_no}}</td>
                                    <td>{{date("j F, Y", strtotime($row->inv_date))}}</td>
                                    <td>{{$row->mastSupplier->supplier_name}}</td>
                                    <td>{{$row->mastWorkStation->store_name}}</td>
                                    <td>{{$item }}</td>
                                    {{-- <td>{{$qty }}</td> --}}
                                    <td>{{$total }}</td>
                                    <td class="text-right">
                                        <a href="#" class="btn btn-sm btn-secondary p-1 px-2"><i class="fa fa-print"></i></i><span class="btn-icon-add"></span>Print</a>
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