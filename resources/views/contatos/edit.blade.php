@extends('template.app')

@section('content')
	
	<div class="col-md-12">
		<h3>Editar contato</h3>

	</div>

	<div class="col-md-6 well">
		<form class="col-md-12" action="{{url('/pessoas/update')}}" method="POST">
			{{csrf_field()}}
			<input type="hidden" name="id" value="{{$pessoa->id}}">
			<div class="form-group col-md-12 {{$errors->has('nome') ? 'has->error' : ''}}">
				<label for="nome" class="control-label">Nome</label>
				<input type="text" name="nome" value="{{$pessoa->nome}}"  class="form-control" placeholder="Nome">

				@if($errors->has('nome'))
					<span class="help-block">
						{{ $errors->first('nome')}}
						
					</span>
						
				@endif

			</div>	
			<div class="col-md-12">
				
			</div>

				<button style="margin-top: 5px; float: right" class="btn btn-primary">
					Salvar
				</button>
										
		</form>

	</div>

	<div class="col-md-3">
				<div class="panel panel-info">
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