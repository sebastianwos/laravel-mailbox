@extends('adminlte::layouts.app')

@section('htmlheader_title')
	{{ trans('adminlte_lang::message.home') }}
@endsection

@section('contentheader_title')
	Mailbox
@stop

@section('contentheader_description')
	13 new messages
@stop


@section('main-content')
	<div class="row">
		<div class="col-md-3">
			@include('mailclient::folders')
		</div>
		<!-- /.col -->
		<div class="col-md-9">
			@yield('mailclient::content')
		</div>
		<!-- /.col -->
	</div>
	<!-- /.row -->
	</section>
@endsection
