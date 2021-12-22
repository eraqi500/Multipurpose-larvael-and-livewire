<div>

    <!-- Content Header (Page header) -->
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
                    <h1 class="m-0 text-dark">Users </h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                        <li class="breadcrumb-item active"> Users </li>
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
                    <div class="d-flex justify-content-end">
                        <button class="btn btn-primary mr-1" wire:click.prevent="addNew">
                            <i class="fa fa-plus-circle"></i>
                            Add New User</button>
                    </div>
                    <div class="card">
                        <div class="card-body">
                            <table class="table table-hover">
                                <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Email</th>
                                    <th scope="col">Options</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($users as $user)
                                <tr>
                                    <th scope="row">{{$loop->iteration}}</th>
                                    <td>{{$user -> name}}</td>
                                    <td>{{$user->email}}</td>
                                    <td>
                                        <a href="" class="fa fa-edit"
                                           wire:click.prevent="edit({{$user}})"></a>
                                        <a href="" wire:click.prevent="confirmUserRemoval({{$user->id}})">
                                            <i class="fa fa-trash text-danger"></i>
                                        </a>
                                    </td>
                                </tr>
                                    @endforeach

                                </tbody>
                            </table>
                        </div>
                    </div>
                    <!-- /.card -->
                </div>
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->

    <!-- modal start -->
    <div class="modal fade" id="form" tabindex="-1"
         role="dialog" aria-labelledby="exampleModalLabel">
        <div class="modal-dialog" role="document">
            <form autocomplete="off" wire:submit.prevent="
                {{ $showEditModal? 'updateUser':'createUser'}}">

            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">
                        @if($showEditModal)
                            <span>Edit User</span>
                            @else
                            <span>  Add New User </span>
                            @endif

                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                        <div class="form-group">
                            <label> name </label>
                            <input type="text"
                                   class="form-control
                                          @error('name') is-valid @enderror"
                                   id="name"
                                   wire:modal.defer="state.name"
                                   placeholder="Enter your fucking name">
                            @error('name')
                            <div class="invalid-feedback">
                                {{$message}}
                            </div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label> email Address </label>
                            <input type="email"
                                   class="form-control @error('email') is-valid @enderror"
                                   id="email"
                                   wire:modal.defer="state.email"
                                   placeholder="Enter your fucking email">
                            @error('email')
                            <div class="invalid-feedback">
                                {{$message}}
                            </div>
                            @enderror

                        </div>

                        <div class="form-group">
                            <label> password </label>
                            <input type="password"
                                   class="form-control
                                   @error('password')  is-valid  @enderror"
                                   id="password"
                                   wire:modal.defer="state.password"
                                   placeholder="Enter your fucking password">
                            @error('password')
                            <div class="invalid-feedback">
                                {{$message}}
                            </div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label> confirm_pass </label>
                            <input type="password"
                                   class="form-control"
                                   id="passwordConfirmation"
                                   wire:modal.defer="state.passwordConfirmation"
                                   placeholder="Enter your fucking password">
                            @error('passwordConfirmation')
                            <div class="invalid-feedback">
                                {{$message}}
                            </div>
                            @enderror
                        </div>


                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">
                        <i class="fa fa-times mr-1"> Cancel</i>
                    </button>
                    <button type="submit" class="btn btn-primary">
                         <i class="fa fa-save mr-1"></i>

                    @if($showEditModal)
                        <span>Update User</span>
                        @else
                        <span>Save NEw User</span>
                        @endif
                    </button>
                </div>
            </div>
            </form>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->


    <!-- modal start -->
    <div class="modal fade" id="confirmationModal" tabindex="-1"
         role="dialog" aria-labelledby="exampleModalLabel">
        <div class="modal-dialog" role="document">

            <div class="model-content">
                <div class="modal-header">
                    <h5> Delete User </h5>
                </div>

                <div class="modal-body">
                    <h4> Are you Sure want to delete this user </h4>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">
                        <i class="fa fa-times mr-1"> Cancel</i>
                    </button>
                    <button type="submit" class="btn btn-danger"
                            wire:click.prevent="deleteUser">
                        <i class="fa fa-trash mr-1"> Delete </i>
                    </button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->


</div>
