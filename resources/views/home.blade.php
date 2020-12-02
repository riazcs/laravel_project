@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>
                <div class="">
              		<div class="box">
              			<div class="box-header">
              				<h3 class="box-title">All Info</h3>
              			</div>

              			<div class="box-body">
              				<table class="table table-responsive">
              					<thead>
              						<tr>
              							<th>Name</th>
              							<th>Description</th>
              							<th>Mobile No</th>
              						</tr>

              					</thead>

              					<tbody>

              						@foreach($categories as $cat)
              							<tr>
              								<td>{{$cat->name}}</td>
              								<td>{{$cat->description}}</td>
              								<td>{{$cat->mobile_no}}</td>
              							</tr>

              						@endforeach
              					</tbody>


              				</table>
              			</div>
              		</div>
              	</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
