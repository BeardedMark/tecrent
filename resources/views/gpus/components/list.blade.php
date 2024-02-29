@foreach ($gpus as $gpu)
    <option value="{{ $gpu->id }}">{{ $gpu->getTitle() }}
    </option>
@endforeach
