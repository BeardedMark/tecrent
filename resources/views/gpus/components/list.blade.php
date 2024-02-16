@foreach ($gpus as $gpu)
    <option value="{{ $gpu->id }}">{{ $gpu->title() }}
    </option>
@endforeach
