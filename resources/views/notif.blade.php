@if (Session::has('alert-success'))
    <div class="alert alert-success alert-dismissable fade in">
      <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
      {{ Session::get('alert-success') }}
    </div>
@endif
@if (Session::has('alert-danger'))
    <div class="alert alert-danger alert-dismissable fade in">
      <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
      {{ Session::get('alert-danger') }}
    </div>
@endif
@if (Session::has('alert-warning'))
    <div class="alert alert-warning alert-dismissable fade in">
      <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
      {{ Session::get('alert-warning') }}
    </div>
@endif