@foreach ($cpus as $cpu)
    <option value="{{ $cpu->id }}">{{ $cpu->title() }}
    </option>
@endforeach
