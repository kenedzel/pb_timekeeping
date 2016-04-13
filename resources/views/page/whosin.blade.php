@extends('master')
	
	@section('body')
	<!-- Uses a transparent header that draws on top of the layout's background -->

<div class="demo-layout mdl-layout--fixed-header mdl-js-layout">
  <header class="mdl-layout__header">
    <div class="mdl-layout__header-row">
      <!-- Title -->
      <span class="mdl-layout-title">
		<!--<img class="android-logo-image" src="icon.png"> -->
		<span class="mdl-layout__title__haha">PurpleBug</span>

	  </span>
      <!-- Add spacer, to align navigation to the right -->
      <div class="mdl-layout-spacer"></div>
      <!-- Navigation -->
       <font size="5px">{{ Auth::user()->fname }}</font>
      <nav class="mdl-navigation">
		<!-- Right aligned menu below button -->
		<button id="demo-menu-lower-right"
				class="mdl-button mdl-js-button mdl-button--icon">
				<i class="material-icons">more_vert</i>
		</button>

		<ul class="mdl-menu mdl-menu--bottom-right mdl-js-menu mdl-js-ripple-effect"
			for="demo-menu-lower-right">
		    <li class="mdl-menu__item"><i class="fa fa-pencil-square-o"></i><font color="black"><a data-toggle="modal" data-target="#aw" style="text-decoration:none;"><font color="black">Change Password</font></a></font></li>
			<li class="mdl-menu__item"><i class="fa fa-sign-out"></i><a href="{{ url('/logout') }}" style="text-decoration:none;" ><font color="black">Logout</font></a></li>
		</ul>

      </nav>
    </div>
  </header>
  		<!-- changepass modal -->
		<div class="modal fade" id="aw" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
		   <div class="modal-dialog">
		     <div class="modal-content">
		       <div class="modal-header">
		         <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span> <span class="sr-only">Close</span></button>
		         <h4 class="modal-title" id="lineModalLabel">Change Password</h4>
		       </div>
		       <div class="modal-body">
						<!-- content-->	
						{!!Form::open(['url' => '/changePassword', 'role' => 'form', 'method' => 'POST']) !!}
						 <input name="id" type="hidden">
							<div class="form-group">
								{!! Form::label('newpass', 'New Password:') !!}
								<input type="password" class="form-control" id="pwd" name="pwd" placeholder="New Password">		
							</div>
							<div class="form-group">
								{!! Form::label('confirmpass', 'Confirm Password:') !!}
								<input type="password" class="form-control" id="confirmpwd" name="confirmpwd" placeholder="Confirm Password">		
							</div>
				
		       </div>
		       <div class="modal-footer">
		       	 <button class="btn btn-success">Save</button>
		         <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
		       
		       </div>
		     </div>
		  </div>
		 </div>
		<!-- END OF CHANGEPASS MODAL -->
  <div class="mdl-layout__drawer">
  	<div class="mdl-layout__drawer-button" style="padding-top: 0px;">
  		<i class="material-icons">menu</i>
  	</div>
    <span class="mdl-layout-title">
	<i class="fa fa-user fa-5x"></i>
	</span>
    <nav class="mdl-navigation">

    	@if(Auth::user()->accesslvl_id == 2)
			<a href="{{ url('/user') }}" class="mdl-navigation__link"><i class="material-icons md-dark md-36">schedule</i>Attendance</a>
			<a href="{{ url('/history/'.Auth::user()->id) }}" class="mdl-navigation__link"><i class="material-icons md-dark md-36 ">history</i>History</a>
			<a href="{{ url('/whosin') }}" class="mdl-navigation__link"><i class="material-icons md-dark md-36">people</i>Who's In?</a>

		@elseif(Auth::user()->accesslvl_id == 1)
		  	<a href="{{ url('/purpleBugTK') }}" class="mdl-navigation__link"><i class="material-icons md-dark md-36">home</i>Home</a>
	  		<a href="{{ url('/history/'.Auth::user()->id) }}" class="mdl-navigation__link"><i class="material-icons md-dark md-36 ">history</i>Attendance History</a>
	  		<a href="{{ url('/timeKeeping') }}" class="mdl-navigation__link"><i class="material-icons md-dark md-36 ">today</i>Timekeeping</a>
	  		<a href="{{ url('/recordM') }}" class="mdl-navigation__link"><i class="material-icons md-dark md-36">folder</i>Employee Listing</a>
	  		<a href="{{ url('/whosin') }}" class="mdl-navigation__link"><i class="material-icons md-dark md-36">people</i>Who's In?</a>
	  	@endif


	  	<!--   <a href="{{ url('/purpleBugTK') }}" class="mdl-navigation__link"><i class="material-icons md-dark md-36">home</i>Home</a>
		  <a href="{{ url('/history/'.Auth::user()->id) }}" class="mdl-navigation__link"><i class="material-icons md-dark md-36 ">history</i>Attendance History</a>
		  <a href="{{ url('/timeKeeping') }}" class="mdl-navigation__link"><i class="material-icons md-dark md-36 ">today</i>Timekeeping</a>
		  <a href="{{ url('/recordM') }}" class="mdl-navigation__link"><i class="material-icons md-dark md-36">folder</i>Employee Listing</a>
		  <a href="{{ url('/whosin') }}" class="mdl-navigation__link"><i class="material-icons md-dark md-36">people</i>Who's In?</a> -->
    </nav>
  </div>

 	<div class="con container">
		<div class="row">		
			<div class="col-lg-12">	
				<div class="center">
					<h2>Who's In?</h2><br><br>
					<table class="table table-condensed" id="example" data-height="200"  data-toggle="table" data-pagination="true">
					  <thead>
						<tr>
						    <th class="mdl-data-table__cell--non-numeric">Name</th>
						    <th class="mdl-data-table__cell--non-numeric">Time in</th>
						</tr>
					  </thead>
					  <tbody>
					  	@foreach($attendance as $att)
					  	<tr>
					  		<td>{{ $att->fname .' '. $att->mname .' '. $att->sname }}</td>
					  		<td>{{ \Carbon\Carbon::parse($att->time_in)->format('h:i:s A') }}</td>	
					  	</tr>
					  	@endforeach  
					  </tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
@endsection