
<option disabled selected>--Select--</option>
@foreach($data as $row)
    <option value="{{ $row->id}}">{{ $row->serial_no}}</option>
@endforeach