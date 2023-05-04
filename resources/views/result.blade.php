@extends('layouts.base')

@section('content')
<section class="bg-white border rounded-lg">
  <div class="p-4">
    <h1 class="text-lg font-semibold text-cyan-600">Temporary File Sharing</h1>
    <p>Share your file up to 10MB for a limited time</p>
  </div>
  <hr>
  <div class="p-4">
    <div class="flex justify-center">
      {!! QrCode::size(144)->generate(url($resultSlug)) !!}
    </div>
    <span class="font-mono block w-full rounded-md p-3 mt-4 bg-gray-100">{{ url($resultSlug) }}</span>
    <div class="grid grid-cols-1 gap-2 mt-4">
      <button type="button" x-clipboard.raw="{{ url($resultSlug) }}" class="btn text-white bg-cyan-600 hover:bg-cyan-700 focus:outline-none focus:ring focus:ring-cyan-600 focus:ring-opacity-30 w-full shadow-sm">
        Copy to Clipboard</button>
      <form action="{{ route('flit.destroy',$resultSlug) }}" method="POST">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn text-cyan-600 border border-cyan-600 hover:bg-gray-100 focus:outline-none focus:ring focus:ring-cyan-600 focus:ring-opacity-30 w-full shadow-sm">
          Remove File
        </button>
      </form>
      <a href="/" class="btn text-cyan-600 border border-cyan-600 hover:bg-gray-100 focus:outline-none focus:ring focus:ring-cyan-600 focus:ring-opacity-30 w-full shadow-sm">
        Upload Another File
      </a>
    </div>
</section>
@include('partials.footer')
@endsection