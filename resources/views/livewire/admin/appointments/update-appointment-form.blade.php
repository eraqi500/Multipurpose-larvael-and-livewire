<div>

</div>
<div>
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <!-- <h1 class="m-0 text-dark">Appointments</h1> -->
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                        <li class="breadcrumb-item active"><a href="">Appointments</a></li>
                        <li class="breadcrumb-item active">Create</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <form wire:submit.prevent="updateAppointment" autocomplete="off">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Add New Appointment</h3>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="client">Client:</label>
                                            <select class="form-control
                                                @error('client_id') is-invalid@enderror "
                                                    wire:model.defer="state.client_id">
                                                <option value="">Select Client</option>
                                                @foreach($clients as $client)
                                                    <option value="{{$client->id}}"> {{$client->name}}</option>
                                                @endforeach
                                            </select>
                                            @error('client_id')
                                            <div class="invalid-feedback">
                                                {{$message}}
                                            </div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group" wire:ignore>
                                            <label>Selecting  Team members </label>
                                            <select
                                                wire:model="state.members"
                                                class="select2 select2-hidden-accessible" multiple=""
                                                data-placeholder="Select a State"
                                                style="width: 100%;" data-select2-id="7"
                                                tabindex="-1" aria-hidden="true">

                                                <option data-select2-id="40">Alabama</option>
                                                <option data-select2-id="41">Alaska</option>
                                                <option data-select2-id="42">California</option>
                                                <option data-select2-id="43">Delaware</option>
                                                <option data-select2-id="44">Tennessee</option>
                                                <option data-select2-id="45">Texas</option>
                                                <option data-select2-id="46">Washington</option>
                                            </select>
                                        </div>

                                    </div>

                                </div>


                                <div class="col-md-6">
                                    <div class="form-group" wire:ignore>
                                        <label>Selecting  Team members </label>
                                        <select wire:model="state.members"  class="select2 select2-hidden-accessible" multiple="" data-placeholder="Select a State" style="width: 100%;" data-select2-id="7" tabindex="-1" aria-hidden="true">
                                            <option data-select2-id="40">Alabama</option>
                                            <option data-select2-id="41">Alaska</option>
                                            <option data-select2-id="42">California</option>
                                            <option data-select2-id="43">Delaware</option>
                                            <option data-select2-id="44">Tennessee</option>
                                            <option data-select2-id="45">Texas</option>
                                            <option data-select2-id="46">Washington</option>
                                        </select>
                                    </div>

                                </div>




                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="appointmentStartTime"> Apppointment Start time </label>
                                            <div class="input-group mb-3">
                                                <div class="input-group-prepend">
                                        <span class="input-group-text">
                                            <i class="fas fa-clock"></i>
                                        </span>
                                                </div>
                                                <x-timepicker
                                                    wire:model.defer="state.appointment_start_time"
                                                    id="appointmentStartTime"/>
                                            </div>

                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="appointmentEndTime"> Apppointment End time </label>
                                            <div class="input-group mb-3">
                                                <div class="input-group-prepend">
                                        <span class="input-group-text">
                                            <i class="fas fa-clock"></i>
                                        </span>
                                                </div>
                                                <x-datepicker
                                                    wire:model.defer="state.appointment_end_time"
                                                    id="appointmentEndTime"/>
                                            </div>

                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="appointmentDate"> Apppointment Date </label>
                                            <div class="input-group mb-3">
                                                <div class="input-group-prepend">
                                        <span class="input-group-text">
                                            <i class="fas fa-clock"></i>
                                        </span>
                                                </div>
                                                <x-datepicker
                                                    wire:model.defer="state.date"
                                                    id="appointmentDate"
                                                    :error="'date'" />

                                                @error('date')
                                                <div class="invalid-feedback">
                                                    {{$message}}
                                                </div>
                                                @enderror
                                            </div>

                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="appointmentTime"> Apppointment Time </label>
                                            <div class="input-group mb-3">
                                                <div class="input-group-prepend">
                                        <span class="input-group-text">
                                            <i class="fas fa-clock"></i>
                                        </span>
                                                </div>
                                                <x-datepicker
                                                    wire:model.defer="state.time"
                                                    id="appointmentTime"
                                                    :error="'time'" />

                                                @error('time')
                                                <div class="invalid-feedback">
                                                    {{$message}}
                                                </div>
                                                @enderror
                                            </div>

                                        </div>
                                    </div>
                                </div>


                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group" wire:ignore>
                                            <label for="note">Note:</label>

                                            <textarea id="note"
                                                      data-note="@this"
                                                      wire:model.defer="state.note"
                                                      class="form-control">
                                                {!! $state['note'] !!}
                                            </textarea>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="client">Status :</label>
                                        <select class="form-control
                                        @error('status') is-invalid @enderror"
                                                wire:model.defer="state.status">
                                            <option value="">Select Status</option>
                                            <option value="SCHEDULED">SCHEDULED</option>
                                            <option value="CLOSED">SCHEDULED</option>

                                        </select>
                                        @error('status')
                                        <div class="invalid-feedback">
                                            {{$message}}
                                        </div>
                                        @enderror
                                    </div>
                                </div>

                            </div>
                            <div class="card-footer">
                                <button type="button" class="btn btn-secondary"><i class="fa fa-times mr-1"></i> Cancel</button>
                                <button id="submit" type="submit" class="btn btn-primary">
                                    <i class="fa fa-save mr-1"></i> Save Changes</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    @push('js')

        <script src="https://cdn.ckeditor.com/ckeditor5/31.1.0/classic/ckeditor.js"></script>
        <script>

            $(function () {
                $('.select2').select2({
                    theme:'bootstrap4',
                }).on('change' , function () {
                @this.set('state.members', $(this).val());
                });
            })


            ClassicEditor
                .create( document.querySelector( '#note' ) )
                .then( editor => {
                    // editor.model.document.on('change:data' , () => {
                    //     let note = $('#note').data('note');
                    //     eval(note).set('state.note' , editor.getData());
                    // });
                    document.querySelector('#submit').addEventListener('click' , () => {
                        let note = $('#note').data('note');
                        eval(note).set('state.note' , editor.getData());
                    })
                } )
                .catch( error => {
                    console.error( error );
                } );
        </script>

    @endpush

</div>
