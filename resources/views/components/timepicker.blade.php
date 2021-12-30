@props(['id' , 'error'])

    <input type="text"
           {{$attributes }}
           class="form-control datetimepicker-input
    @error($error) is-invalid @enderror"
           data-target="#datetimepicker5"
           id="{{$id}}"
           data-toggle="datatimepicker"
           data-target="#datetimepicker5"

           onchange="this.dispatchEvent(new InputEvent('input'))"/>


@push('js')

<script type="text/javascript">
    {{--$(function () {--}}
    {{--    $('#{{$id}}').datetimepicker({--}}
    {{--        format:'LT'--}}
    {{--    });--}}
    {{--});--}}
        $('#{{$id}}').datetimepicker({
            format:'LT'
        });
</script>
@endpush
