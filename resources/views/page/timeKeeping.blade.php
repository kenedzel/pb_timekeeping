@extends('master')
		
	<!-- Uses a transparent header that draws on top of the layout's background -->
	@section('body')
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
				 <nav class="mdl-navigation">
					<!-- Right aligned menu below button -->

					 <font size="5px">{{ Auth::user()->fname }}</font>


					<div class="mdl-textfield mdl-js-textfield mdl-textfield--expandable mdl-textfield--floating-label mdl-textfield--align-right">
						<label class="mdl-button mdl-js-button mdl-button--icon" for="fixed-header-drawer-exp">
						  <i class="material-icons">search</i>
						</label>
						<div class="mdl-textfield__expandable-holder">
						  <input class="mdl-textfield__input" type="text" name="sample" id="fixed-header-drawer-exp">
						</div>
<!-- 						  <button class="mdl-button mdl-js-button mdl-button--icon">
						  <i class="material-icons">send</i>
						  </button> -->
					</div>
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
		  <a href="{{ url('/purpleBugTK') }}" class="mdl-navigation__link"><i class="material-icons md-dark md-36">home</i>Home</a>
		  <a href="{{ url('/history/'.Auth::user()->id) }}" class="mdl-navigation__link"><i class="material-icons md-dark md-36 ">history</i>Attendance History</a>
		  <a href="{{ url('/timeKeeping') }}" class="mdl-navigation__link"><i class="material-icons md-dark md-36 ">today</i>Timekeeping</a>
		  <a href="{{ url('/recordM') }}" class="mdl-navigation__link"><i class="material-icons md-dark md-36">folder</i>Employee Listing</a>
		  <a href="{{ url('/whosin') }}" class="mdl-navigation__link"><i class="material-icons md-dark md-36">people</i>Who's In?</a>
		</nav>
	  </div>
	<!-- Square card -->
		<div class="profile container">
			<div class="row">
			@foreach($users as $user)
				<div class="col-lg-3 col-md-6">
					<div class="timekeeping-card-square mdl-card mdl-shadow--2dp">			
						<div class="mdl-card__title mdl-card--expand">
							<h5 class="mdl-card__title-text">{{ $user->fname }}</h5>
						</div>				
						<div class="mdl-card__actions mdl-card--border">							
							<a href="{{ url('/employeeRecord/'.$user->id) }}" class="mdl-button mdl-button--colored mdl-js-button mdl-js-ripple-effect">
							<font color="#9259a1">view record</font>
							</a>
						</div>
					</div>
				</div>
			@endforeach
			{{ $users->render() }}
			</div>
		</div>
	</div>
@endsection