@extends('layouts.base')

@section('content')
<section class="bg-white border rounded-lg">
  <div class="p-4">
    <h1 class="text-lg font-semibold text-cyan-600">Download Your File</h1>
    <p>File will be deleted after download</p>
  </div>
  <hr>
  <div class="p-4">
    <div class="flex justify-center">
      <svg width="96" height="96" viewBox="0 0 96 96" fill="none" xmlns="http://www.w3.org/2000/svg">
        <rect width="96" height="96" rx="48" fill="#CFFAFE"/>
        <path fill-rule="evenodd" clip-rule="evenodd" d="M30.75 30.5625C30.75 28.1814 32.6814 26.25 35.0625 26.25H44.9559C50.3382 26.25 55.5001 28.3881 59.306 32.194C63.1119 35.9999 65.25 41.1618 65.25 46.5441V65.5699C65.25 67.9509 63.3186 69.8824 60.9375 69.8824H35.0625C32.6814 69.8824 30.75 67.9509 30.75 65.5699V30.5625ZM61.1912 47.3051C61.1912 46.0268 60.6834 44.8009 59.7795 43.897C58.8756 42.9931 57.6496 42.4853 56.3713 42.4853H53.3272C52.1835 42.4853 51.0866 42.0309 50.2778 41.2222C49.4691 40.4134 49.0147 39.3165 49.0147 38.1728V35.1287C49.0147 33.8504 48.5069 32.6244 47.603 31.7205C46.6991 30.8166 45.4732 30.3088 44.1949 30.3088H35.0625C34.923 30.3088 34.8088 30.423 34.8088 30.5625V65.5699C34.8088 65.7093 34.923 65.8235 35.0625 65.8235H60.9375C61.077 65.8235 61.1912 65.7093 61.1912 65.5699V47.3051ZM52.5802 32.2104C52.9038 33.1401 53.0735 34.1256 53.0735 35.1287V38.1728C53.0735 38.2401 53.1003 38.3046 53.1478 38.3522C53.1954 38.3997 53.2599 38.4265 53.3272 38.4265H56.3713C57.3744 38.4265 58.3599 38.5962 59.2896 38.9198C58.5413 37.5129 57.5834 36.2114 56.436 35.064C55.2886 33.9166 53.9871 32.9587 52.5802 32.2104ZM48 44.5147C49.1208 44.5147 50.0294 45.4233 50.0294 46.5441V53.8212L52.6532 51.1973C53.4458 50.4048 54.7307 50.4048 55.5232 51.1973C56.3158 51.9899 56.3158 53.2748 55.5232 54.0674L49.4365 60.1542C49.4316 60.1591 49.4266 60.1639 49.4217 60.1688C49.0569 60.527 48.5573 60.7484 48.0061 60.75C48.0041 60.75 48.002 60.75 48 60.75C47.998 60.75 47.9959 60.75 47.9939 60.75C47.721 60.7492 47.4607 60.6945 47.2232 60.596C46.9893 60.4992 46.7698 60.3568 46.5783 60.1688C46.5734 60.164 46.5686 60.1592 46.5638 60.1544L40.4768 54.0674C39.6842 53.2748 39.6842 51.9899 40.4768 51.1973C41.2693 50.4048 42.5542 50.4048 43.3468 51.1973L45.9706 53.8212V46.5441C45.9706 45.4233 46.8792 44.5147 48 44.5147Z" fill="#155E75"/>
      </svg>  
    </div>
    <div class="block w-full rounded-md py-2 px-3 mt-4 bg-gray-100">
      <h2>{{ $filename }}</h2>
      <span class="block text-gray-500">{{ $filesize }}</span>
    </div>
    <div class="mt-4">
      <form action="{{ route('flit.download', $slug) }}" method="POST">
        @csrf
        @honeypot
        <label for="password" class="hidden">Password</label>
        <input type="password" name="password" id="password" placeholder="Password" class="form-input @error('password') is-invalid @enderror" aria-label="Password">
        @error('password')<span class="block text-red-600 text-sm mt-1 font-medium">{{ $message }}</span>@enderror
        <button type="submit" class="btn text-white bg-cyan-600 hover:bg-cyan-700 focus:outline-none focus:ring focus:ring-cyan-600 focus:ring-opacity-30 w-full mt-4 shadow-sm">
          Download
        </button>
      </form>
    </div>
    <span class="block text-center text-sm text-gray-500 mt-2">This file will be expire on {{ $expires }}</span>
  </div>
</section>
@endsection