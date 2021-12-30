<div>
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Settings </h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">User Settings</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">

            <div class="row">

                <div class="col-md-6">
                    <!-- general form elements -->
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Quick Example</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form  wire:submit.prevent="updateSetting" role="form">
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="sitename">Site Name</label>
                                    <input type="text"
                                           wire:model.defer="state.site_name"
                                           class="form-control" id="siteName" placeholder="Enter Site name">
                                </div>
                                <div class="form-group">
                                    <label for="site email">Site Email</label>
                                    <input type="email"
                                           wire:model.defer="state.site_email"
                                           class="form-control" id="siteEmail" placeholder="enter Site Email">
                                </div>
                                <div class="form-group">
                                    <label for="site title">Site Title</label>
                                    <input type="text"
                                           wire:model.defer="state.site_title"
                                           class="form-control" id="siteTitle" placeholder="enter Site Title">
                                </div>

                                <div class="form-group">
                                    <label for="site footer">Site Footer</label>
                                    <input type="text"
                                           wire:model.defer="state.site_footer"
                                           class="form-control" id="siteFooter" placeholder="enter Site Footer">
                                </div>

                                <div class="form-group">

                                    <div class="form-group">
                                        <div class="custom-control custom-switch custom-switch-off-danger custom-switch-on-success">
                                            <input wire:model.defer="state.sidebar_collapse"
                                                   type="checkbox" class="custom-control-input"
                                                   id="sidebarCollapse">
                                            <label class="custom-control-label" for="sidebarCollapse">
                                                Sidebar Collapse</label>
                                        </div>
                                    </div>


{{--                                    <label for="sidebar_collapse"> sidebar Collapse</label> <br>--}}
{{--                                    <input type="checkbox"--}}
{{--                                           wire:model.defer="state.sidebar-collapse"--}}
{{--                                           class="form-control" id="sidebar_collapse">--}}
                                </div>

                            </div>
                            <!-- /.card-body -->

                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">
                                    <i class="fa fa-save"> Save changes  </i>
                                    Submit</button>
                            </div>
                        </form>
                    </div>
                    <!-- /.card -->


                </div>
            </div>



        </div>
    </section>

    @push('js')
    <script>
      $('#sidebarCollapse').on('change', function () {
         $('body').toggleClass('sidebar-collapse');
      })
     </script>

    @endpush
