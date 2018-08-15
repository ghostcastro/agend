@extends('template.app')
@section('content')

	<div class="col-md-6 well">
		<div class="col-md-12">
			<h3>Deseja Excluir Esse Contato?</h3>
			<div style="float: right;">
				<a class="btn btn-default" href="{{url("pessoas")}}">
					<i class="glyphicon glyphicon-chevron-left">
						Cancelar
					</i>
				</a>

				<a class="btn btn-danger" href="{{url("pessoas/$pessoa->id/destroy")}}">
					<i class="glyphicon glyphicon-remove">
						Excluir
					</i>
				</a>
			</div>
		</div>

	</div>

	<div class="col-md-3">
				<div class="panel panel-danger">
			 		 <div class="panel-heading">
			  			{{$pessoa->nome}}
			  		
			 		 </div>
			 	 <div class="panel-body">
			    @foreach($pessoa->telefones as $telefone)
			    <p><strong>Telefone:</strong>({{$telefone->ddd }}) {{$telefone->telefone}}</p>
			    @endforeach
			</div>
		</div>
	</div>
@endsection