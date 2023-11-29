@if(Session::has('success'))
<div class="alert alert-success alert-dismissible">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
    <i class="icon fas fa-check"></i> {!! session('success') !!}
  </div>
@endif
@if(Session::has('error'))
<div class="alert alert-danger alert-dismissible">
<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
    <i class="icon fas fa-ban"></i> {!! session('error') !!}
</div>
@endif

@if($errors->has('*'))
    @foreach ($errors->all() as $error)
    <div class="alert alert-danger alert-dismissible">
      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
          <i class="icon fas fa-ban"></i> {{ $error }}
      </div>
    @endforeach
@endif