@props(['placeholder' => 'Select Options' , 'id' ])

@add($attributes->whereStartWith('wire:model')->first()  )

<div>
    <select wire:model="state.members"
            id="{{$id}}"
            class="select2 select2-hidden-accessible"
            multiple="" data-placeholder="Select a State"
            style="width: 100%;" data-select2-id="7" tabindex="-1" aria-hidden="true">
        {{$slot}}
    </select>
</div>

@once
@push('styles')
    <!-- Select2 -->
    <link rel="stylesheet" href="../../plugins/select2/css/select2.min.css">
    <link rel="stylesheet" href="../../plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
    <!-- Bootstrap4 Duallistbox -->
@endpush
@endonce

@once
@push(js)
<script rel="stylesheet" href="{{asset('backend/plugins/select2/js/select2.full.min.js')}}">
</script>
@endpush

@endonce




@push(js)
    <script>
        $(function () {
            $('#{{$id}}').select2({
                theme:'bootstrap4',
            })
    </script>

@endpush



