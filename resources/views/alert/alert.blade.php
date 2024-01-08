@session('success')
    <div class="alert alert-success">
        {{ session()->get('success') }}
    </div>
@endsession

@session('fail')
    <div class="alert alert-danger">
        {{ session()->get('fail') }}
    </div>
@endsession

<script>
   setTimeout(() => {
        document.querySelector('.alert').style.display = 'none'
   }, 10000);
</script>
