@if(Session::has('successMessage'))
		<div class="alert alert-info">
              <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
              <strong>{{ Session::get('successMessage') }}</strong>
        </div>
@endif
@if(Session::has('errorMessage'))
	<div class="alert alert-danger">
              <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
              <strong>{{ Session::get('errorMessage') }}</strong>
     </div>
@endif        