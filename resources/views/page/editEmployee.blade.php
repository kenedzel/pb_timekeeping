@extends('master')

	@section('body')




	<div class="demo-layout mdl-layout--fixed-header mdl-js-layout">
		<header class="mdl-layout__header">
			<div class="mdl-layout__header-row">
			  <!-- Title -->
				  <span class="mdl-layout-title">
					<span class="mdl-layout__title__haha">PurpleBug</span>
				  </span>
				  <!-- Add spacer, to align navigation to the right -->
				  <div class="mdl-layout-spacer"></div>
				  <!-- Navigation -->
				   <font size="5px">{{ Auth::user()->fname }}</font>
					 <nav class="mdl-navigation">
					 	<!-- SEARCH BAR -->
					<div class="mdl-textfield mdl-js-textfield mdl-textfield--expandable mdl-textfield--floating-label mdl-textfield--align-right">
						<label class="mdl-button mdl-js-button mdl-button--icon"
							   for="fixed-header-drawer-exp">
						  <i class="material-icons">search</i>
						</label>
						<!-- INPUT SEARCH -->
						<div class="mdl-textfield__expandable-holder">
						  <input class="mdl-textfield__input" type="text" name="sample" id="fixed-header-drawer-exp">
						</div>
						<!-- END of SEARCH BAR -->
					</div>
						<!-- Right aligned menu below button -->
						<button id="demo-menu-lower-right"
								class="mdl-button mdl-js-button mdl-button--icon">
								<i class="material-icons">more_vert</i>
						</button>

						<ul class="mdl-menu mdl-menu--bottom-right mdl-js-menu mdl-js-ripple-effect"
							for="demo-menu-lower-right">
						  <li class="mdl-menu__item"><i class="fa fa-sign-out"></i><a href="{{ url('/logout') }}" style="text-decoration:none;" ><font color="black">Logout</font></a></li>
						</ul>

					 </nav>
			</div>
		</header>
		<!-- add search button -->
		<div class="mdl-layout__drawer">
			<div class="mdl-layout__drawer-button" style="padding-top: 0px;">
  				<i class="material-icons">menu</i>
  			</div>
			<span class="mdl-layout-title">
			<i class="fa fa-user fa-5x"></i>
			</span>
			<nav class="mdl-navigation">
			  <a href="{{ url('/purpleBugTK') }}" class="mdl-navigation__link"><i class="material-icons md-dark md-36">home</i>Home</a>
			  <a href="{{ url('/history/'.Auth::user()->id) }}" class="mdl-navigation__link"><i class="material-icons md-dark md-36 ">history</i>Attendance History</a>
			  <a href="{{ url('/timeKeeping') }}" class="mdl-navigation__link"><i class="material-icons md-dark md-36 ">today</i>Timekeeping</a>
			  <a href="{{ url('/recordM') }}" class="mdl-navigation__link"><i class="material-icons md-dark md-36">folder</i>Employee Listing</a>
			  <a href="{{ url('/whosin') }}" class="mdl-navigation__link"><i class="material-icons md-dark md-36">people</i>Who's In?</a>
			</nav>
		</div>
		 <div class="col-lg-10 col-md-8 col-md-offset-1 ">
			<h1> Edit Employee </h1>	
			<br>
				
						{!!Form::open(['url' => '/modifyEmployee','method' => 'POST']) !!}
								<div class="form-group col-xs-4">
									 <input type="hidden" name="id" id="id" value="{{ $user[0]->id }}">
										{!! Form::label('fname', 'First Name:') !!}
					<!-- 					{!! Form::text('fname', '', ['class'=>'form-control', 'value'=>'wew']) !!} -->
										 <input class="form-control" type="text" value="{{ $user[0]->fname }}" id="fname" name="fname">
										</div>
										<div class="form-group col-xs-4">
										{!! Form::label('mname', 'Middle Name:') !!}
										<!-- {!! Form::text('mname', '', ['class'=>'form-control', 'placeholder'=>'Middle Name']) !!} -->
										<input class="form-control" placeholder="Middle Name" name="mname" type="text" value="{{ $user[0]->mname }}" id="mname">
										</div>
										<div class="form-group col-xs-4">
										{!! Form::label('sname', 'Last Name:') !!}
										<!-- {!! Form::text('sname', '', ['class'=>'form-control', 'placeholder'=>'Last Name']) !!} -->
										<input class="form-control" placeholder="Last Name" name="sname" type="text" value="{{ $user[0]->sname }}" id="sname">
										</div>
										<div class="form-group col-xs-4">
										 {!! Form::label('department', 'Department:') !!}
										<select class="form-control" name="department">
											@foreach($department as $departments)

										 	<option value="{{ $departments->dep_id }}" <?= $user[0]->dep_id == $departments->dep_id ? "selected" : ""; ?> >{{ $departments->dep_name }}</option>
										 	@endforeach
										 </select>
										</div>
										<div class="form-group col-xs-4">
										 {!! Form::label('classification', 'Employment Classification:') !!}

										 <select class="form-control col-xs-4" name="classification">
											@foreach($classification as $class)	
										 	<option value="{{$class->class_id}}" <?= $user[0]->class_id == $class->class_id ? "selected" : ""; ?> >{{$class->class_name }}</option>
										 	@endforeach
										 </select>
										</div>

										<div class="form-group col-xs-4">
										 {!! Form::label('position', 'Position:') !!}

										 <select class="form-control col-xs-4" name="position">
											@foreach($position as $pos)	
										 	<option value="{{$pos->id}}" <?= $user[0]->position_id == $pos->id ? "selected" : ""; ?> >{{ $pos->position_description }}</option>
										 	@endforeach
										 </select>
										</div>
										<!-- cannot retrieve option value-->
										<div class="form-group col-xs-4">
											{!! Form::label('start', 'Start of Employment:') !!}
<!-- 											{!! Form::text('start_of_employment', date('Y-m-d'), ['class'=>'form-control', 'placeholder'=>'Start of Employment',  'id'=>'datepicker']) !!}  -->
										<input type="text" class="form-control " id="datepicker" name="start_of_employment" value="{{ $user[0]->start_of_employment }}" readonly> 
										</div>

										<div class="form-group col-xs-4">
										{!! Form::label('email', 'E-mail:') !!}
									<!-- 	{!! Form::email('email', '', ['class'=>'form-control', 'placeholder'=>'E-mail']) !!} -->
									<input class ="form-control" value="{{ $user[0]->email }}" type="email" name="email">
										</div>


										<div class="form-group col-xs-4">
										 {!! Form::label('accesslevel', 'Access Level:') !!}

										 <select class="form-control" name="accesslvl_id">
											@foreach($accesslevel as $acc)	
										 	<option value="{{$acc->acclvl_id}}" <?= $user[0]->accesslvl_id == $acc->acclvl_id ? "selected" : ""; ?> >{{ $acc->access_name }}</option>
										 	@endforeach
										 </select>
										</div>

										<div class="form-group col-xs-4">
										 {!! Form::label('schedule', 'Schedule:') !!}

										 <select class="form-control" name="sched_id">
									 		@foreach($schedule as $sched)	
										 	<option value="{{$sched->id}}" <?= $user[0]->sched_id == $sched->id ? "selected" : ""; ?> >{{ \Carbon\Carbon::parse($sched->time_in)->format('h:i:s A') . ' - ' . \Carbon\Carbon::parse($sched->time_out)->format('h:i:s A')}}</option>
										 	@endforeach
										 </select>
										</div>								
										<div class="form-group col-xs-4"><br><br><br><br>
											{!! Form::submit('Save', ['class'=>'btn btn-success btn-md ']) !!}
											<!-- <a href="{{ url('/modifyEmployee') }}" class="btn btn-success" role="button">Save</a> -->
										<a href="{{ url('/recordM') }}" class="btn btn-primary" role="button">Back</a>
										</div>
								</div>
								{!! Form::close() !!}	
				</div>

	@endsection