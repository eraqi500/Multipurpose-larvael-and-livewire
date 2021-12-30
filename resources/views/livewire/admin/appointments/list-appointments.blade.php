<div>

    <!-- Content Header (Page header) -->
    <x-loading-indicator />

    <div class="content-header">
        <div class="container-fluid">

            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                <strong> </strong> You should check in on some of those fields below.
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="row mb-2">


                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Appointments </h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                        <li class="breadcrumb-item active"> Appointment </li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
        <div class="container-fluid">

        {{--            @if(session()->has('message')) --}}
        {{--            <!--alert -start -->--}}
        {{--            <div class="alert alert-success alert-dismissible fade show" role="alert">--}}
        {{--                <strong>  <i class="fa fa-check-circle mr-1"></i>--}}
        {{--                    {{session('message')}}</strong>--}}
        {{--                <button type="button" class="close" data-dismiss="alert" aria-label="Close">--}}
        {{--                    <span aria-hidden="true">&times;</span>--}}
        {{--                </button>--}}
        {{--            </div>--}}
        {{--            @endif--}}
        <!--alert -end =-->

            <div class="row">

                <div class="col-lg-12">
                    <div class="d-flex justify-content-between mb-2">

                        <div>
                            <a href="{{route('admin.appointment.create')}}">
                                <button class="btn btn-primary mr-1">
                                    <i class="fa fa-plus-circle"></i>
                                    Add New Appointment</button>
                            </a>

                           @if($selectedRows)
                            <div class="btn-group ml-2">
                                <button type="button" class="btn btn-default">Action</button>
                                <button type="button" class="btn btn-default dropdown-toggle dropdown-icon"
                                        data-toggle="dropdown" aria-expanded="false">
                                </button>
                                    <span class="sr-only">Toggle Dropdown</span>
                                    <div class="dropdown-menu" role="menu" style="">
                                        <a  wire:click.prevent="deleteSelectedRows"
                                            class="dropdown-item" href="#">Delete selected </a>
                                        <a  wire:click.prevent="markAllAsScheduled"
                                            class="dropdown-item" href="#">Mark as Scheduled </a>
                                        <a   wire:click.prevent="markAllAsClosed"
                                             class="dropdown-item" href="#">Mark as Closed</a>

                                        <a   wire:click.prevent="export"
                                             class="dropdown-item" href="#"> Export </a>
                                    </div>



                            </div>
                            <span class="ml-2"> Selected {{count($selectedRows)}}
                            {{Str::plural('appointment', count($selectedRows))}}</span>
                           @endif

                        </div>

                        <div class="btn-group">
                            <button type="button"
                                    wire:click="filterAppointmentByStatus"
                                    class="btn {{is_null($status) ? 'btn-secondary' : 'btn-default '}}}">
                                <span class="mr-1"> All </span>
                                <span class="badge badge-pill badge-info">{{$appointmentscount}}</span>
                            </button>

                            <button type="button"
                                    wire:click="filterAppointmentByStatus('scheduled')"
                                    class="btn {{($status == 'scheduled') ? 'btn-secondary' : 'btn-default '}}}">
                                <span class="mr-1"> Scheduled </span>
                                <span class="badge badge-pill badge-primary"> {{$scheduledAppointment}}</span>
                            </button>

                            <button type="button"
                                    wire:click="filterAppointmentByStatus('closed')"
                                    class="btn {{($status == 'scheduled') ? 'btn-secondary' : 'btn-default '}}}">
                                <span class="mr-1"> All </span>
                                <span class="badge badge-pill badge-success"> {{$closeAppointment}} </span>
                            </button>

                        </div>
                    </div>
                    <div class="card">
                        <div class="card-body">
                            <table class="table table-hover">
                                <thead>
                                <tr>

                                    <th>
                                        <div class="icheck-primary d-inline ml-2">
                                            <input type="checkbox" value=""
                                                   wire:model="selectPageRows"
                                                   name="todo3"
                                                   id="todoCheck3">
                                            <label for="todoCheck3"></label>
                                        </div>
                                    </th>

                                    <th scope="col">#</th>
                                    <th scope="col">Client Name</th>
                                    <th scope="col">Date </th>
                                    <th scope="col">Time </th>
                                    <th scope="col">Status </th>
                                    <th scope="col">Options</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($appointments as $app)
                                    <tr>
                                        <th style="width:10px">
                                            <div class="icheck-primary d-inline ml-2">
                                                <input type="checkbox"
                                                       wire:model="selectedRows"
                                                       value="{{$app->id}}"
                                                       name="todo3"
                                                       id="{{$app->id}}">
                                                <label for="{{$app->id}}"></label>
                                            </div>
                                        </th>
                                        <th scope="row">{{$loop->iteration}}</th>
                                        <td> {{$app->client->name}}</td>
                                        <td> {{$app->date}}</td>
                                        <td> {{$app->time}}</td>
                                        <td>
                                            <span class="badge badge-{{$app ->status_badge}}">
                                                {{$app ->status}}
                                            </span>
                                        </td>

                                        <td>
                                            <a href="{{route('admin.appointments.edit', $app)}}" class="fa fa-edit mr-2"></a>
                                            <a href="" wire:click.prevent="confirmAppointmentRemoval({{$app->id}})">
                                                <i class="fa fa-trash text-danger"></i>
                                            </a>
                                        </td>
                                    </tr>

                                    @endforeach

                                </tbody>
                            </table>
                        </div>
                        <div class="card-footer d-flex justify-content-end">

                            {!! $appointments->links() !!}

                        </div>
                    </div>
                    <!-- /.card -->
                </div>
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->

   <x-confirmation-alert />

</div>
