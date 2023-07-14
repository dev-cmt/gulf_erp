<x-app-layout>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Sales Approve</h4>
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
                                    <th>Total</th>
                                    <th class="text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody id="sales_tbody">
                                @foreach ($data as $keys=> $row)
                                @php
                                    $total = 0;
                                    foreach ($row->storeTransferDetails as $key => $value) {
                                        $total += $value->qty * $value->price;
                                    }
                                @endphp
                                <tr id="row_master_table_{{ $row->id}}">
                                    <td>{{++$keys}}</td>
                                    <td>{{$row->inv_no}}</td>
                                    <td>{{$row->inv_date}}</td>
                                    <td>{{$row->mastWorkStation->store_name ?? 'NULL'}}</td>
                                    <td>{{$row->mastItemCategory->cat_name ?? 'NULL'}}</td>
                                    <td>{{$total }}</td>
                                    <td class="d-flex justify-content-end">
                                        <form action="{{route('store_transfer.approve', $row->id)}}" method="post">
                                            <button class="btn btn-sm btn-info p-1 mr-1">Approve</i></button>
                                            @csrf
                                            @method('PATCH')
                                        </form>
                                        <form action="{{route('store_transfer.canceled', $row->id)}}" method="post">
                                            <button class="btn btn-sm btn-danger p-1">Canceled</i></button>
                                            @csrf
                                            @method('PATCH')
                                        </form>
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


