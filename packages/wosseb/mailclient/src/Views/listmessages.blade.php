@extends('mailclient::layouts.home')


@section('mailclient::content')

	<div class="box box-primary">
		<div class="box-header with-border">
			<h3 class="box-title">Inbox</h3>

			<div class="box-tools pull-right">
				<div class="has-feedback">
					<input type="text" class="form-control input-sm" placeholder="Search Mail">
					<span class="glyphicon glyphicon-search form-control-feedback"></span>
				</div>
			</div>
			<!-- /.box-tools -->
		</div>
		<!-- /.box-header -->
		<div class="box-body no-padding">
			<div class="mailbox-controls">
				<!-- Check all button -->
				<button type="button" class="btn btn-default btn-sm checkbox-toggle"><i class="fa fa-square-o"></i>
				</button>
				<div class="btn-group">
					<button type="button" class="btn btn-default btn-sm"><i class="fa fa-trash-o"></i></button>
					<button type="button" class="btn btn-default btn-sm"><i class="fa fa-reply"></i></button>
					<button type="button" class="btn btn-default btn-sm"><i class="fa fa-share"></i></button>
				</div>
				<!-- /.btn-group -->
				<button type="button" class="btn btn-default btn-sm"><i class="fa fa-refresh"></i></button>
				<div class="pull-right">
					{{ $messages->firstItem() }}-{{ $messages->lastItem() }}/{{ $messages->total() }}
					<div class="btn-group">
						<a href="{{ $messages->previousPageUrl() }}" class="btn btn-default btn-sm"><i class="fa fa-chevron-left"></i></a>
						<a href="{{ $messages->nextPageUrl() }}" class="btn btn-default btn-sm"><i class="fa fa-chevron-right"></i></a>
					</div>
					<!-- /.btn-group -->
				</div>
				<!-- /.pull-right -->
			</div>
			<div class="table-responsive mailbox-messages">
				<table class="table table-hover table-striped">
					<tbody>
						@foreach($messages as $message)
							<tr>
								<td><input type="checkbox"></td>
								<td class="mailbox-star"><a href="#"><i class="fa fa-star text-yellow"></i></a></td>
								<td class="mailbox-name"><a href="{{ route('message', ['mailbox_id' => $message->mailbox_id, 'message_id' => $message->message_number ]) }}">{{ $message->from }}</a></td>
								<td class="mailbox-subject">{{ $message->subject }}</td>
								<td class="mailbox-attachment"></td>
								<td class="mailbox-date">{{ $message->date->diffForHumans() }}</td>
							</tr>
						@endforeach
					</tbody>
				</table>
				<!-- /.table -->
			</div>
			<!-- /.mail-box-messages -->
		</div>
		<!-- /.box-body -->
		<div class="box-footer no-padding">
			<div class="mailbox-controls">
				<!-- Check all button -->
				<button type="button" class="btn btn-default btn-sm checkbox-toggle"><i class="fa fa-square-o"></i>
				</button>
				<div class="btn-group">
					<button type="button" class="btn btn-default btn-sm"><i class="fa fa-trash-o"></i></button>
					<button type="button" class="btn btn-default btn-sm"><i class="fa fa-reply"></i></button>
					<button type="button" class="btn btn-default btn-sm"><i class="fa fa-share"></i></button>
				</div>
				<!-- /.btn-group -->
				<button type="button" class="btn btn-default btn-sm"><i class="fa fa-refresh"></i></button>
				<div class="pull-right">
					{{ $messages->firstItem() }}-{{ $messages->lastItem() }}/{{ $messages->total() }}
					<div class="btn-group">
						<a href="{{ $messages->previousPageUrl() }}" class="btn btn-default btn-sm"><i class="fa fa-chevron-left"></i></a>
						<a href="{{ $messages->nextPageUrl() }}" class="btn btn-default btn-sm"><i class="fa fa-chevron-right"></i></a>
					</div>
					<!-- /.btn-group -->
				</div>
				<!-- /.pull-right -->
			</div>
		</div>
	</div>

@endsection
