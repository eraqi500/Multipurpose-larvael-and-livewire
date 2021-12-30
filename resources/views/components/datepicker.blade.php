@props(['id' , 'error'])

<input type="text"
       {{$attributes }}
       class="form-control datetimepicker-input
        @error($error) is-invalid @enderror"
       data-target="#{{$id}}"
       id="{{$id}}"
       data-toggle="datatimepicker"

       onchange="this.dispatchEvent(new InputEvent('input'))"/>


@push('js')

    <script type="text/javascript">
        {{--$(function () {--}}
        {{--    $('#{{$id}}').datetimepicker({--}}
        {{--        format:'L'--}}
        {{--    });--}}
        {{--});--}}
        $('#{{$id}}').datetimepicker({
            format:'L'
        });
    </script>
@endpush
