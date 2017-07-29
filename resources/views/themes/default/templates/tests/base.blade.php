@extends('layouts.dialog')

@section('page_title', $page_title)

@section('content')
	@if( $flag == 'api' )
	    <div class="error-container">
	    	<div class="text-center">
	        	<i class="pe-7s-server text-success big-icon"></i>
	        	<h1>API Test</h1>

	        	<br/>
		        <form method="post" action="#" id="request_data_id">
		        	<select name="method" class="form-control" style="background-color: #D2D7D3">
		        		<option value="post">POST</option>
		        		<option value="get">GET</option>
		        		<option value="head">HEAD</option>
		        		<option value="delete">DELETE</option>
		        		<option value="options">OPTIONS</option>
		        		<option value="put">PUT</option>
		        	</select>
		        	<br/>
		        	<select name="action" class="form-control" style="background-color: #D2D7D3">
		        		<option value="action:">action:</option>
		        		@foreach($routes as $route)
		        			<option value="action:/{{ $route }}">action:/{{ $route }}</option>
		        		@endforeach
		        	</select>
		        	<br/>
		        	<textarea name="request_data" class="form-control" style="background-color: #D2D7D3" rows="12">action:</textarea>
		        	<br/>
		        	<button type="submit" class="btn btn-xs btn-success">Submit to endpoint</button>
		        </form>
	        </div>
	        <br/>
	        <pre id="time"></pre>
	        <pre id="request"></pre>
	        <pre id="response"></pre>
	    </div>
    @endif

@endsection
