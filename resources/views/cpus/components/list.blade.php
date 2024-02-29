@foreach ($cpus as $cpu)
    <option value="{{ $cpu->id }}">{{ $cpu->getTitle() }}
    </option>
@endforeach
