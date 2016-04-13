@extends('master')
	
	<!-- Uses a transparent header that draws on top of the layout's background -->


	@section('body')
<!--

  $(document).ready(function(){
        $("#welcomeModal").modal('show');
      }); -->

					<!-- WELCOME MODAL -->
<!-- 				<div class="mods modal fade in" id="welcomeModal" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
						<div class="modal-dialog modal-lg">
							<div class="modal-content">
								<div class="modal-header">
									<button type="button" class="close" 
									   data-dismiss="modal">
										   <span aria-hidden="true">&times;</span>
										   <span class="sr-only">Close</span>
									</button>
									<h3 class="modal-title" id="welcomeModalLabel">titlemodal</h3>
								</div>
								<div class="mbody modal-body">
									sample content			 									 
								</div>
							</div>
						</div>
					</div> -->



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
		
			<!--  -->
		   <li class="mdl-menu__item"><i class="fa fa-pencil-square-o"></i><font color="black"><a data-toggle="modal" data-target="#aw" style="text-decoration:none;"><font color="black">Change Password</font></a></font></li>
		   <li class="mdl-menu__item"><i class="fa fa-sign-out"></i><a href="{{ url('/logout') }}" style="text-decoration:none;" ><font color="black">Logout</font></a></li>

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
	  <a href="#" class="mdl-navigation__link"><i class="material-icons md-dark md-36">home</i>Home</a>
	  <a href="{{ url('/history/'.Auth::user()->id) }}" class="mdl-navigation__link"><i class="material-icons md-dark md-36 ">history</i>Attendance History</a>
	  <a href="{{ url('/timeKeeping') }}" class="mdl-navigation__link"><i class="material-icons md-dark md-36 ">today</i>Timekeeping</a>
	  <a href="{{ url('/recordM') }}" class="mdl-navigation__link"><i class="material-icons md-dark md-36">folder</i>Employee Listing</a>
	  <a href="{{ url('/whosin') }}" class="mdl-navigation__link"><i class="material-icons md-dark md-36">people</i>Who's In?</a>
    </nav>
  </div>

	<!-- Event card -->
	<div class="row">
		<div class="hahacol col-lg-12">		
			<div class="center">					
				<a href="{{ url('/add-attendance') }}" class="mdl-navigation__link" data-toggle="tooltip" data-placement="bottom" title="Click to Time In"><i class="fa fa-calendar-check-o fa-4x circle-icon"></i></a>
				<!-- <a href="{{ url('/add-OB-attendance') }}" class="mdl-navigation__link" data-toggle="tooltip" data-placement="bottom" title="Out for Business Attendance"><i class="fa fa-briefcase fa-4x circle-icon"></i></a> -->
				<a href="{{ url('#') }}" class="mdl-navigation__link" data-toggle="tooltip" data-placement="bottom" title="Out for Business Attendance"><i class="fa fa-briefcase fa-4x circle-icon"></i></a>
				<a href="{{ url('/add-timeout/'.Auth::user()->id) }}" class="mdl-navigation__link" data-toggle="tooltip" data-placement="bottom" title="Click to Time Out"><i class="fa fa-calendar-times-o fa-4x circle-icon"></i></a>
		</div>
		</div>
	</div>

	@if(Session::has('flash_message_error'))
	     <div class="alert alert-info slim-panel">
	     <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
	     <p>{{ Session::get('flash_message_error') }}</p>
	    </div>
	@endif

<!-- 				id="#tryModal" data-toggle="modal" data-target="#tryModal"	
					<div class="modal fade" id="tryModal" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
						<div class="modal-dialog">
							<div class="modal-content">
								<div class="modal-header">
									<button type="button" class="close" 
									   data-dismiss="modal">
										   <span aria-hidden="true">&times;</span>
										   <span class="sr-only">Close</span>
									</button>
									<h3 class="modal-title" id="lineModalLabel">Create new</h3>
								</div>
								<div class="modal-body">						
									asdasd
							
								</div>
								<div class="modal-footer">
									aaaaaaaaaaaaaaaaaaaaaaaaaa
								</div>

							</div>
						</div>
					</div>
 -->
	<div class="con container">
		<div class="row">
				
				<div class="col-lg-12">
					 <a class="btn btn-default"href="{{ url('/generateReport') }}" id="#squarespaceModal"><i class="fa fa-calendar-o obj-color"></i> View Attendances</a>
					<table class="table table-condensed" id="example" data-height="200"  data-toggle="table" data-pagination="true">
					  <thead>
						<tr>
						  <th class="mdl-data-table__cell--non-numeric">Name</th>
						  <th class="mdl-data-table__cell--non-numeric">Date</th>
						  <th class="mdl-data-table__cell--non-numeric">Time in</th>
						  <th class="mdl-data-table__cell--non-numeric">Remarks</th>
						  <th class="mdl-data-table__cell--non-numeric">Time out</th>
						</tr>
					  </thead>
					  <tbody>

					  	@foreach($attendance as $att)
				
					  	@if(\Carbon\Carbon::today()->toDateString() == $att->date && Auth::user()->id == $att->id)
						<tr>
						  <td>{{ $att->fname.' '.$att->mname.' '.$att->sname }}</td>
						  <td>{{ \Carbon\Carbon::parse($att->date)->format('M d, Y')  }}</td>
						  <td>{{ \Carbon\Carbon::parse($att->time_in)->format('h:i:s A') }}</td>
						  <td>{{ $att->stat_name }}</td>
						@if($att->time_out == '00:00:00')
						  <td>---------------</td>
						@else
						  <td>{{ \Carbon\Carbon::parse($att->time_out)->format('h:i:s A') }}</td>
						@endif
						</tr>
						@endif
						@endforeach
					  </tbody>
					</table>
				</div>
			{{ $attendance->render() }} 
		</div>
	</div>

	
@endsection