
<a href="compose.html" class="btn btn-primary btn-block margin-bottom">Compose</a>

<div class="box box-solid">
	<div class="box-header with-border">
		<h3 class="box-title">Folders</h3>

		<div class="box-tools">
			<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
			</button>
		</div>
	</div>
	<div class="box-body no-padding">
		<ul class="nav nav-pills nav-stacked">
			@foreach($mailboxes as $index => $mailbox)
				<li><a href="{{ route('messages', ['id' => $mailbox->id]) }}">{{ $mailbox->name }}</a></li>
			@endforeach
		</ul>
	</div>
	<!-- /.box-body -->
</div>
