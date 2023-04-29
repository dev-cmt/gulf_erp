
    <div class="row mb-2">
        <div class="col-sm-4 col-5">
            <h5 class="f-w-500">Name <span class="pull-right">:</span>
            </h5>
        </div>
        <div class="col-sm-8 col-7"><span>{{$user->name}}</span>
        </div>
    </div>
    <div class="row mb-2">
        <div class="col-sm-4 col-5">
            <h5 class="f-w-500">Email <span class="pull-right">:</span>
            </h5>
        </div>
        <div class="col-sm-8 col-7"><span><a href="/cdn-cgi/l/email-protection" class="__cf_email__" data-cfemail="a9ccd1c8c4d9c5cce9ccd1c8c4d9c5ccc587cac6c4">{{$user->name}}</a></span>
        </div>
    </div>
    <div class="row mb-2">
        <div class="col-sm-4 col-5">
            <h5 class="f-w-500">Gender <span class="pull-right">:</span></h5>
        </div>
        <div class="col-sm-8 col-7"><span>{{$infoPersonal->gender == '0'? 'Male': 'Female'}}</span>
        </div>
    </div>
    <div class="row mb-2">
        <div class="col-sm-4 col-5">
            <h5 class="f-w-500">Date Of Birth <span class="pull-right">:</span>
            </h5>
        </div>
        <div class="col-sm-8 col-7"><span>{{date('d-m-Y', strtotime($infoPersonal->dob))}}</span>
        </div>
    </div>
    <div class="row mb-2">
        <div class="col-sm-4 col-5">
            <h5 class="f-w-500">Location <span class="pull-right">:</span></h5>
        </div>
        <div class="col-sm-8 col-7"><span>{{$infoPersonal->address}},
            {{$infoPersonal->city}}</span>
        </div>
    </div>
    <div class="row mb-2">
        <div class="col-sm-4 col-5">
            <h5 class="f-w-500">College Name <span class="pull-right">:</span></h5>
        </div>
        <div class="col-sm-8 col-7"><span>{{$infoAcademic->collage}}</span>
        </div>
    </div>
    <div class="row mb-2">
        <div class="col-sm-4 col-5">
            <h5 class="f-w-500">Subject <span class="pull-right">:</span></h5>
        </div>
        <div class="col-sm-8 col-7"><span>{{$infoAcademic->subject}}</span>
        </div>
    </div>
    <div class="row mb-2">
        <div class="col-sm-4 col-5">
            <h5 class="f-w-500">Degree <span class="pull-right">:</span></h5>
        </div>
        <div class="col-sm-8 col-7">
            @if ($infoAcademic->degree == '0') No Degree
            @elseif ($infoAcademic->degree == '2') Graduation
            @elseif ($infoAcademic->degree == '3') Masters
            @elseif ($infoAcademic->degree == '4') PSD
            @endif
        </div>
    </div>
    <div class="row mb-2">
        <div class="col-sm-4 col-5">
            <h5 class="f-w-500">Passing Year <span class="pull-right">:</span></h5>
        </div>
        <div class="col-sm-8 col-7"><span>{{$infoAcademic->passing_year}}</span>
        </div>
    </div>
    <div class="row mb-2">
        <div class="col-sm-4 col-5">
            <h5 class="f-w-500">Marrital Status <span class="pull-right">:</span></h5>
        </div>
        <div class="col-sm-8 col-7">
            <span>
                @if ($infoPersonal->marrital_status=='0')Unmarried
                @elseif ($infoPersonal->marrital_status=='1')Married
                @elseif ($infoPersonal->marrital_status=='2')Divorce
                @elseif ($infoPersonal->marrital_status=='3')Widowed
                @endif
            </span>
        </div>
    </div>
    @if ($infoPersonal->marrital_status != '0')
        <div class="row mb-2">
            <div class="col-sm-4 col-5">
                <h5 class="f-w-500">Number Of Child <span class="pull-right">:</span></h5>
            </div>
            <div class="col-sm-8 col-7"><span>{{$infoPersonal->number_child}} Person</span>
            </div>
        </div>
        @if (count($infoFamily))
        <div class="table-responsive mt-4">
            <table class="table header-border table-hover verticle-middle">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Child Name</th>
                        <th scope="col">Gender</th>
                        <th scope="col">Birth Day</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($infoFamily as $key=> $row)
                    <tr>
                        <th>{{++$key}}</th>
                        <td>{{$row->child_name}}</td>
                        <td>{{$row->child_gender == '0' ? 'Male' : 'Female'}}</td>
                        <td>{{date('d-m-Y', strtotime($row->child_dob))}}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        @endif
    @endif
{{-- <div class="profile-about-me pt-4">
    <div class="border-bottom-1">
        <h4 class="text-primary">About Me</h4>
        <p class="mb-2">A wonderful serenity has taken possession of my entire soul, like these sweet mornings of spring which I enjoy with my whole heart. I am alone, and feel the charm of existence was created for the bliss of souls like mine.I am so happy, my dear friend, so absorbed in the exquisite sense of mere tranquil existence, that I neglect my talents.</p>
    </div>
</div> --}}