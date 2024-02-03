@extends('welcome')
@section('content')
    <div class="p-5">
        <form action="{{ route('import') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <input type="file" name="file" accept=".csv">
            <button type="submit" class="btn btn-primary">Import CSV</button>
        </form>
    </div>
@endsection
