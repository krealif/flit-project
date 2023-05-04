<div
  x-data
  x-init="() => {
    let pond = FilePond.create($refs.upload, {
      name: 'upload',
      allowFileEncode: true,
      credits: false,
      maxFileSize: '10MB',
    });
    FilePond.setOptions({
      server: {
        url: '{{ config('filepond.server.url') }}',
        headers: {
          'X-CSRF-TOKEN': '{{ csrf_token() }}',
        }
      }
    })
  }"
>
  <input x-ref="upload" />
</div>
@once
@push('styles')
<link rel="stylesheet" href="/assets/css/filepond.min.css">
<script src="/assets/js/filepond.min.js"></script>
<script src="/assets/js/filepond-plugin-file-validate-size.js"></script>
<script src="https://unpkg.com/filepond-plugin-file-encode/dist/filepond-plugin-file-encode.js"></script>
<script>
  FilePond.registerPlugin(FilePondPluginFileValidateSize);
  FilePond.registerPlugin(FilePondPluginFileEncode);
</script>
@endpush
@endonce