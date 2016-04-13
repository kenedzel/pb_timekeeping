@extends('master')

	@section('body')
	<script type="text/javascript">
		$(document).ready(function() {
			// Initialize datepicker 
			$( ".datepicker" ).datepicker({
				changeYear: true,
				yearRange: '2010:2016',
				changeMonth: true,
				dateFormat: 'yy-mm-dd'

			});
			// Before execute request assign value
			$('#trigger-download').click(function() {
				var fromDate = $('#from-date').val();
				var toDate = $('#to-date').val();
				window.location.href = "{{ url('download') }}?from_date="+fromDate+"&to_date="+toDate;
			

			});
		});
	</script>
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
			 <font size="5px">{{ Auth::user()->fname }}</font>
			<!-- Navigation -->
			<nav class="mdl-navigation">
				<!-- Right aligned menu below button -->
				<button id="demo-menu-lower-right"
					class="mdl-button mdl-js-button mdl-button--icon">
					<i class="material-icons">more_vert</i>
				</button>

				<ul class="mdl-menu mdl-menu--bottom-right mdl-js-menu mdl-js-ripple-effect"
					for="demo-menu-lower-right">
					 <!-- <li class="mdl-menu__item"><i class="fa fa-pencil-square-o"></i><font color="black"><a data-toggle="modal" data-target="#aw" style="text-decoration:none;"><font color="black">Change Password</font></a></font></li> -->
					 <li class="mdl-menu__item"><i class="fa fa-sign-out"></i><a href="{{ url('/logout') }}" style="text-decoration:none;" ><font color="black">Logout</font></a></li>
				</ul>

			</nav>
			</div>
		</header>
				
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
					<a href="{{ url('/history'.Auth::user()->id) }}" class="mdl-navigation__link"><i class="material-icons md-dark md-36 ">history</i>History</a>
					<a href="{{ url('/whosin') }}" class="mdl-navigation__link"><i class="material-icons md-dark md-36">people</i>Who's In?</a>

				@elseif(Auth::user()->accesslvl_id == 1)
				  	 <a href="{{ url('/purpleBugTK') }}" class="mdl-navigation__link"><i class="material-icons md-dark md-36">home</i>Home</a>
	  				<a href="{{ url('/history/'.Auth::user()->id) }}" class="mdl-navigation__link"><i class="material-icons md-dark md-36 ">history</i>Attendance History</a>
	  				<a href="{{ url('/timeKeeping') }}" class="mdl-navigation__link"><i class="material-icons md-dark md-36 ">today</i>Timekeeping</a>
	  				<a href="{{ url('/recordM') }}" class="mdl-navigation__link"><i class="material-icons md-dark md-36">folder</i>Employee Listing</a>
	  				<a href="{{ url('/whosin') }}" class="mdl-navigation__link"><i class="material-icons md-dark md-36">people</i>Who's In?</a>
	  			@endif	
			</nav>
		</div>
	
		<div class="container">
			<div class="row">
				<div class="col-lg-12">					
					<h3 class="intenthead"><strong>{{ Auth::user()->fname . ' ' . Auth::user()->mname . ' ' . Auth::user()->sname }}</strong></h3>						
				</div>
			</div>
		</div>
		
		<div class="container">
			<div class="row">
				<div class="col-lg-12">
					<div class="datetime">
						<div class="bs-example">
							<div class="col-lg-16 col-offset-6 centered">   
								{!!Form::open(['url' => '/filterHistory','method' => 'POST','class'=>'form-inline','role'=>'form']) !!}
						         {!! Form::label('from', 'From:') !!}
						         {!! Form::text('from', date('Y-m-d'), ['class'=>'form-control datepicker', 'placeholder'=>'From',   'id'=>'from-date', 'value' => '']) !!} 
						      	<!-- ($old_fr ? $old_fr : date('Y-m-d'))
						      			($old_to ? $old_to : date('Y-m-d')) -->
						         {!! Form::label('to', 'To:') !!}
						         {!! Form::text('to', date('Y-m-d'), ['class'=>'form-control datepicker', 'placeholder'=>'To',  'id'=>'to-date', 'value'=>' ']) !!}

						         {!! Form::submit('Filter',  ['class'=>'btn btn-default form-control', 'placeholder'=>'Apply',  'id'=>'apply']) !!}  						         						         
								<!--  <a role="button" class="btn btn-default form-control" href="{{ url('/download') }}">haha</a> -->
						      	 {!! Form::close() !!}

							</div>
								<table class="table table-condensed" id="example" data-height="200"  data-toggle="table" data-pagination="true">
									<thead>
										<tr>
											<th>Date</th>
											<th>Time in</th>
											<th>Time out</th>
											<th>Remarks</th>
											<th>Minutes Late</th>
											<th class="centerheader">Hours Rendered</th>
											<th>Under Time</th>
										</tr>
									</thead>
									<tbody>
										@foreach($attendance as $att)
										<tr>						
											<td>{{ \Carbon\Carbon::parse($att->date)->format('M d, Y')  }}</td>
											<td>{{ \Carbon\Carbon::parse($att->time_in)->format('h:i:s A') }}</td>
										@if($att->time_out == '00:00:00')
								  			<td>---------------</td>
										@else
								  			<td>{{ \Carbon\Carbon::parse($att->time_out)->format('h:i:s A') }}</td>
										@endif
											<td>{{ $att->stat_name }}</td>
											<td>{{ $att->mins_late }} minute(s)</td>
											<td class="centerheader">{{ $att->hrs_rendered }} hour(s)</td>
											<td>{{ $att->under_time . ' hour(s)'}}</td>	
										</tr>								
										@endforeach
									</tbody>
								</table>
						</div>		
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection

