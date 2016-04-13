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
		<!--CONTENT-->
				@if(Session::has('flash_message_error'))
					<div class="alert alert-info slim-panel">
						<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
						<p align="center"><b>{{ Session::get('flash_message_error') }}</b></p>
					</div>
				@endif
		<div class="fafacon container">
			<div class="row">

				<div class="col-lg-8 col-md-8 col-md-offset-1">
					<form role="form" class="form-inline">
						<div class="gii form-group">
							<a class="btn btn-default" href="#" id="#squarespaceModal" data-toggle="modal" data-target="#squarespaceModal"><i class="fa fa-user-plus"></i>Add New Employee</a>
						</div>				
					</form>	
				
				<div class="gii form-group">

					<table class="mdl-data-table mdl-js-data-table">
					  <thead> 
						<tr>
						  <th class="mdl-data-table__cell--non-numeric">Name</th>
						  <th class="mdl-data-table__cell--non-numeric">Classification</th>
						  <th class="mdl-data-table__cell--non-numeric">Department</th>
						  <!-- <th class="mdl-data-table__cell--non-numeric">Position</th> -->
						  <th class="mdl-data-table__cell--non-numeric">Start of Employment</th>  
						  <th class="mdl-data-table__cell--non-numeric">E-mail</th>
						  <th class="mdl-data-table__cell--non-numeric">&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbspAction</th>					  
						</tr>
					  </thead>
					 
				
					  <tbody>
					  	 	@foreach($users as $user)
						<tr>
						  <td class="mdl-data-table__cell--non-numeric">{{ $user->fname.' '.$user->mname.' '.$user->sname }}</td>
						  <td class="mdl-data-table__cell--non-numeric">{{ $user->class_name }}</td>
						  <td class="mdl-data-table__cell--non-numeric">{{ $user->dep_name }}</td>
					<!-- 	  <td class="mdl-data-table__cell--non-numeric">{{ $user->position_description }}asd</td> -->
						  <td class="mdl-data-table__cell--non-numeric">{{ \Carbon\Carbon::parse($user->start_of_employment)->format('M d, Y') }}</td>
						  <td class="mdl-data-table__cell--non-numeric">{{ $user->email }}</td>
						  <td class="mdl-data-table__cell--non-numeric">
						  	<!-- {{ url('/delete-employee/'.$user->id) }} -->
						  	<!-- CONFIRMATION MODAL FOR DELETE NEXT WEEK -->
						  	<a class="btn btn-default btn-sm delete" href="#" del-tag="{{ $user->id }}" data-toggle="modal" data-target="#delete" id="#delete"><i class="fa fa-trash"></i> Delete</a>						  	
						  	<a class="btn btn-default btn-sm" href="{{ url('/editEmployee/'.$user->id) }}" ><i class="fa fa-pencil-square-o"></i> Edit</a>
						  </td>
							
						</tr>
							  @endforeach
					  </tbody>			
					</table>
				</div>		
						{{ $users->render() }}

				<script>
				
				$('.delete').on('click',function(){
				
					var id = $(this).attr('del-tag');
					var url = "{{ url('/delete-employee/')}}";
					var fullPath = url +'/'+ id;
				
					var a = document.getElementById('deleteNow');
					a.href = fullPath;
				
					
				})
				</script>					<!-- Delete Modal -->
					<div class="modal fade" id="delete" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
		              <div class="modal-dialog">
		                <div class="modal-content">
		                  <div class="modal-header">
		                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span> <span class="sr-only">Close</span></button>
		                    <h4 class="modal-title" id="lineModalLabel">Delete Information</h4>
		                  </div>
		                  <div class="modal-body">
		                    <p>Do you want to delete this data?</p>
		                  </div>
		                  <div class="modal-footer">
		                    <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
		                    <a class="btn btn-danger" id = "deleteNow" href="">Delete</a>
		                  </div>
		                </div>
		             </div>
		            </div>
		           
					<!-- End of delete modal -->
				<!-- line modal -->
					<div class="modal fade" id="squarespaceModal" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
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
									{!!Form::open(['url' => '/add-employee','method' => 'POST']) !!}
										<div class="form-group">
										{!! Form::label('fname', 'First Name:') !!}
										{!! Form::text('fname', '', ['class'=>'form-control', 'placeholder'=>'First Name']) !!}
										
										</div>
										<div class="form-group">
										{!! Form::label('mname', 'Middle Name:') !!}
										{!! Form::text('mname', '', ['class'=>'form-control', 'placeholder'=>'Middle Name']) !!}
										</div>
										<div class="form-group">
										{!! Form::label('sname', 'Last Name:') !!}
										{!! Form::text('sname', '', ['class'=>'form-control', 'placeholder'=>'Last Name']) !!}
										</div>
										<div class="form-group">
										 {!! Form::label('department', 'Department:') !!}
										<select class="form-control" name="department">
											@foreach($department as $departments)
										 	<option value="{{ $departments->dep_id }}" >{{ $departments->dep_name }}</option>
										 	@endforeach
										 </select>
										</div>
										<div class="form-group">
										 {!! Form::label('classification', 'Employment Classification:') !!}

										 <select class="form-control" name="classification">
										 	@foreach($classification as $class)	
							
										 	<option value="{{$class->class_id}}">{{$class->class_name }}</option>
										 	@endforeach
										 </select>
										</div>
										<div class="form-group">
										 {!! Form::label('position', 'Position:') !!}

										 <select class="form-control" name="position">
										 	@foreach($position as $pos)	
							
										 	<option value="{{$pos->id}}">{{$pos->position_description }}</option>
										 	@endforeach
										 </select>
										</div>
										<!-- cannot retrieve option value-->
										<div class="form-group">
											{!! Form::label('start', 'Start of Employment:') !!}
											{!! Form::text('start_of_employment', date('Y-m-d'), ['class'=>'form-control', 'placeholder'=>'Start of Employment',  'id'=>'datepicker']) !!} 
										<!--<input type="text" class="form-control" id="datepicker" name="start_of_employment"> -->
										</div>

										<div class="form-group">
										{!! Form::label('email', 'E-mail:') !!}
										{!! Form::email('email', '', ['class'=>'form-control', 'placeholder'=>'E-mail']) !!}
										</div>

										<div class="form-group">
										{!! Form::label('password', 'Password:') !!}
<!-- 										{!! Form::text('password', '', ['class'=>'form-control', 'placeholder'=>'Password']) !!} -->
										<input class ="form-control" placeholder ="Password" type="password" name="password">

										</div>

										<div class="form-group">
										 {!! Form::label('accesslevel', 'Access Level:') !!}

										 <select class="form-control" name="accesslvl_id">
										 	@foreach($accesslevel as $access)	
							
										 	<option value="{{$access->acclvl_id}}">{{$access->access_name }}</option>
										 	@endforeach
										 </select>
										</div>

										<div class="form-group">
										 {!! Form::label('schedule', 'Schedule:') !!}

										 <select class="form-control" name="sched_id">
										 	@foreach($schedule as $sched)	
							
										 	<option value="{{$sched->id}}">{{ \Carbon\Carbon::parse($sched->time_in)->format('h:i:s A') . ' - ' . \Carbon\Carbon::parse($sched->time_out)->format('h:i:s A')}}</option>
										 	@endforeach
										 </select>
										</div>								
				<!-- 						<div class="form-group">
											{!! Form::label('schedule', 'PP:') !!}
											{!! Form::file('file',['class'=>'form-control']) !!}
										</div> -->
									<!-- timein input -->
								</div>
								<div class="modal-footer">
									<!--<button type="button" id="saveImage" class="btn btn-default btn-hover-green" data-action="create" role="button" type="submit">Create</button>-->
									{!! Form::submit('Create User', ['class'=>'btn btn-success btn-hover-green form-control']) !!}
								</div>
								{!! Form::close() !!}	
							</div>
						</div>
					</div>
						@if($errors->any())
    						<div class="alert alert-danger">
    							<!-- col-md-12 -->
							  <ul>
							   @foreach($errors->all() as $error)
							   <li>{{ $error }}</li>
							   @endforeach
							  </ul>
							</div>
						@endif
					<!-- end of line modal-->
					{!! Form::close() !!}
				</div>
			</div>
		</div>
	</div>
@endsection