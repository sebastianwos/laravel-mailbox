@extends('mailclient::layouts.home')

@section('mailclient::content')
	<div class="box box-primary">
		<div class="box-header with-border">
			<h3 class="box-title">Read Mail</h3>

			<div class="box-tools pull-right">
				<a href="#" class="btn btn-box-tool" data-toggle="tooltip" title="Previous"><i class="fa fa-chevron-left"></i></a>
				<a href="#" class="btn btn-box-tool" data-toggle="tooltip" title="Next"><i class="fa fa-chevron-right"></i></a>
			</div>
		</div>
		<!-- /.box-header -->
		<div class="box-body no-padding">
			<div class="mailbox-read-info">
				<h3>{{ $message->subject }}</h3>
				<h5>From: {{ $message->from }}
					<span class="mailbox-read-time pull-right">{{ $message->date->format('Y/m/d H:i:s') }}</span></h5>
			</div>
			<!-- /.mailbox-read-info -->
			<div class="mailbox-controls with-border text-center">
				<div class="btn-group">
					<button type="button" class="btn btn-default btn-sm" data-toggle="tooltip" data-container="body" title="Delete">
						<i class="fa fa-trash-o"></i></button>
					<button type="button" class="btn btn-default btn-sm" data-toggle="tooltip" data-container="body" title="Reply">
						<i class="fa fa-reply"></i></button>
					<button type="button" class="btn btn-default btn-sm" data-toggle="tooltip" data-container="body" title="Forward">
						<i class="fa fa-share"></i></button>
				</div>
				<!-- /.btn-group -->
				<button type="button" class="btn btn-default btn-sm" data-toggle="tooltip" title="Print">
					<i class="fa fa-print"></i></button>
			</div>
			<!-- /.mailbox-controls -->
			<div class="mailbox-read-message">
				{!! $message->body_html !!}
			</div>
			<!-- /.mailbox-read-message -->
		</div>
		<!-- /.box-body -->
		<div class="box-footer">
			@if($attachmentFiles)
				<ul class="mailbox-attachments clearfix">
					@foreach($attachmentFiles as $file)
					<li>
						<span class="mailbox-attachment-icon"><i class="fa fa-file-pdf-o"></i></span>
						<div class="mailbox-attachment-info">
							<a href="#" class="mailbox-attachment-name"><i class="fa fa-paperclip"></i> {{ $file['name'] }}</a>
							<span class="mailbox-attachment-size">
							  {{ $file['size'] }} kB
							  <a href="{{ $file['url'] }}" class="btn btn-default btn-xs pull-right"><i class="fa fa-cloud-download"></i></a>
							</span>
						</div>
					</li>
					@endforeach
				</ul>
			@endif
		</div>
		<!-- /.box-footer -->
		<div class="box-footer">
			<div class="pull-right">
				<button type="button" class="btn btn-default"><i class="fa fa-reply"></i> Reply</button>
				<button type="button" class="btn btn-default"><i class="fa fa-share"></i> Forward</button>
			</div>
			<button type="button" class="btn btn-default"><i class="fa fa-trash-o"></i> Delete</button>
			<button type="button" class="btn btn-default"><i class="fa fa-print"></i> Print</button>
		</div>
		<!-- /.box-footer -->
	</div>
@endsection