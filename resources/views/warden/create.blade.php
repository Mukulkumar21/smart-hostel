<!DOCTYPE html>
Smart Hostel Management System
</p>


{{-- Success message --}}
@if(session('success'))
<div class="alert alert-success">
{{ session('success') }}
</div>
@endif


{{-- Error messages --}}
@if($errors->any())
<div class="alert alert-danger">
@foreach($errors->all() as $error)
<div>{{ $error }}</div>
@endforeach
</div>
@endif


<form method="POST" action="{{ route('warden.store') }}">
@csrf


<div class="mb-3">
<label class="form-label">Name</label>
<input type="text" name="name"
class="form-control"
placeholder="Enter warden name"
required>
</div>


<div class="mb-3">
<label class="form-label">Email address</label>
<input type="email" name="email"
class="form-control"
placeholder="warden@gmail.com"
required>
</div>


<div class="mb-3">
<label class="form-label">Password</label>
<input type="password" name="password"
class="form-control"
placeholder="Minimum 6 characters"
required>
</div>


<button class="btn btn-primary w-100">
Create Warden
</button>
</form>


<hr>


<div class="text-center">
<a href="{{ route('warden.login') }}" class="text-decoration-none">
← Back to Login
</a>
</div>


</div>
</div>
</div>


</body>
</html>