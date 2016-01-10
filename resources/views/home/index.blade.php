@extends('app')

@section('content')
<section class="row">
    <div class="col-lg-12">
    	<div class="panel panel-default">
    		<div class="panel-body">
            @if (!$messages->isEmpty())
                重要提示：
                <ol>
                    @foreach ($messages as $message)
                        <li>{{ $message }}</li>
                    @endforeach
                </ol>
            @endif
    		</div>
    	</div>
    </div>
</section>
@stop