@extends('master')


@section('body')

	<div class="login container">
		<img class="logo" src="{{ asset('background.png') }}">
			<!--<div class="input-group margin-bottom-sm">
			  <span class="input-group-addon"><i class="fa fa-envelope fa-fw"></i></span>
			  <input class="form-control" type="text" placeholder="Email address" required autofocus>
			</div>
			<br>
			<div class="input-group">
			  <span class="input-group-addon"><i class="fa fa-key fa-fw"></i></span>
			  <input class="form-control" type="password" placeholder="Password" required autofocus>
			</div> -->

	{!! Form::open(['url' => '/loguserin','method' => 'POST']) !!}
			<div class="addr mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
			  {!! Form::label('email', '',['class'=>'mdl-textfield__label','for'=>'addr1' ,'placeholder'=>'']) !!}
			  {!! Form::text('email', '', ['class'=>'mdl-textfield__input','id'=>'addr1', 'placeholder'=>'']) !!}						
			</div>
			<div class="addr mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
	<!-- 		  {!! Form::label('password', '',['class'=>'mdl-textfield__label','for'=>'addr1' ,'placeholder'=>'']) !!}
			  {!! Form::password('password', '', ['class'=>'mdl-textfield__input','id'=>'addr1', 'placeholder'=>'']) !!}	 -->
			<label class="mdl-textfield__label" for="addr1" placeholder="" name="password">Password</label>
   			<input class="mdl-textfield__input" type="password" id="addr1" name="password">
			</div>
			@if(Session::has('flash_message_error'))
			     <div class="alert alert-danger slim-panel">
			     <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
			     <p>{{ Session::get('flash_message_error') }}</p>
			    </div>
			@endif
			@if($message)
			<div class="alert alert-danger slim-panel">
			<?php echo $message; ?>
			</div>
			@endif
			<!--  <a href="purpleBugTK.html" class="btn btn-info btn-block" role="button" id="punts">Log in</a> -->
			  
       <main class="android-con mdl-layout__content">
       			{!! Form::submit('submit', ['class'=>'android-con mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--colored form-control mdl-color--purple-600' ]) !!}
                <!--<a href="{{ url('/purpleBugTK') }}" class="android-con mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--colored" role="button">Submit</a>-->
        </main>



			  <!-- Colored FAB button -->
	{!! Form::close() !!}
	</div>
@endsection