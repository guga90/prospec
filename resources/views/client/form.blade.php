@extends('layouts.web')

@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        Cliente
        <small>Formulário</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i>Home</a></li>
        <li><a href="#">Cliente</a></li>
        <li class="active">Cadastro</li>
    </ol>
</section>

<!-- form start -->
<form id="form_client" role="form" method="POST" action="{{route('client') . (empty($client->id) ? '' : ('/' . $client->id)) }}">
    {{ csrf_field() }}
    <!-- Main content -->
    <section class="content">
        <div class="row">
            <!-- left column -->
            <div class="col-md-12">
                <!-- general form elements -->
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Geral</h3>
                    </div>
                    <!-- /.box-header -->

                    <input name="_method" type="hidden" value="{{ empty($client->id) ? 'POST' : 'PUT' }}">                    
                    <input type="hidden" name="id" id="id" value="{{ empty($client->id) ? '' : $client->id }}" />
                    <div class="box-body">

                        <div class=" col-md-6">
                            <div class="form-group">
                                <label for="name">Nome</label>
                                <input maxlength="100" required="true" type="text" id="name" name="name" value="{{ old('name', (empty($client->name) ? '' : $client->name)) }}" class="form-control" placeholder="Nome">
                                @if ($errors->has('name'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('name') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>

                        <div class=" col-md-6">
                            <div class="form-group">
                                <label for="telefone">Telefone</label>
                                <input maxlength="100" required="true" type="text" id="telefone" name="telefone" value="{{ old('telefone', (empty($client->telefone) ? '' : $client->telefone)) }}" class="form-control mask_cellphone" placeholder="Telefone">
                                @if ($errors->has('telefone'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('telefone') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>

                        <div class=" col-md-6">
                            <div class="form-group">
                                <label for="email">E-mail</label>
                                <input maxlength="100" required="true" type="text" id="email" name="email" value="{{ old('email', (empty($client->email) ? '' : $client->email)) }}" class="form-control" placeholder="E-mail">
                                @if ($errors->has('email'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('email') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="status">Status</label>
                                <select required="true" id="status" name="status" class="form-control select2">
                                    <option value="A" {{ old('status', ( empty($user->status) ? '' : $user->status)) == 'A' ? 'selected' : '' }} >Ativo</option>
                                    <option value="I" {{ old('status', ( empty($user->status) ? '' : $user->status)) == 'I' ? 'selected' : '' }} >Inativo</option>
                                </select>
                                @if ($errors->has('status'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('status') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="id_grupo">Grupo</label>
                                <select id="id_grupo" name="id_grupo[]" class="form-control multiple select2" multiple>
                                    @foreach($grupos as $grupo)
                                     <option {{$grupo->active ? 'selected' : ''}} value="{{$grupo->id}}" >{{$grupo->name}}</option>
                                     @endforeach
                                </select>
                                @if ($errors->has('id_grupo'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('id_grupo') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>

                        <div class=" col-md-12">
                            <div class="form-group">
                                <label for="info">Informações</label>
                                <textarea id="info" name="info" class="form-control" placeholder="Informações">{{ old('info', (empty($client->info) ? '' : $client->info)) }}</textarea>
                                @if ($errors->has('info'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('info') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>
                    </div>
                    <!-- /.box-body -->
                    <div class="box-footer">
                        <button type="submit" class="btn btn-primary">Salvar</button>
                        <a href="{{route('user')}}" class="btn btn-default btn-flat">Voltar
                        </a>
                    </div>
                </div>
                <!-- /.box -->
            </div>

        </div>


        <!-- /.row -->
    </section>

</form>

@endsection
