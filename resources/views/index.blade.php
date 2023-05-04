@extends('layouts.base')

@section('content')
<section class="bg-white border rounded-lg">
  <div class="p-4">
    <h1 class="text-lg font-semibold text-cyan-600">Temporary File Sharing</h1>
    <p>Share your file up to 10MB for a limited time</p>
  </div>
  <hr>
  <div class="p-4">
    <form action="{{ route('flit.store') }}" method="POST">
      @csrf
      @honeypot
      <div>
        <label for="upload" class="hidden">Upload</label>
        <x-filepond/>
        @error('upload')<span class="block text-red-600 text-sm -mt-3 font-medium">{{ $message }}</span>@enderror
      </div>
      <div class="mt-4">
        <label for="password" class="hidden">Password</label>
        <input type="password" name="password" id="password" placeholder="Password" class="form-input @error('password') is-invalid @enderror" aria-label="Password">
        @error('password')<span class="block text-red-600 text-sm mt-1 font-medium">{{ $message }}</span>@enderror
      </div>
      <button type="submit" class="btn text-white bg-cyan-600 hover:bg-cyan-700 focus:outline-none focus:ring focus:ring-cyan-600 focus:ring-opacity-30 w-full mt-4 shadow-sm">
        Upload
      </button>
    </form>
  </div>
</section>
@include('partials.footer')
@endsection