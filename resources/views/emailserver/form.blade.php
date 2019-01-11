@extends('layouts.web')

@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        Servidor de E-mail
        <small>Formulário</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i>Home</a></li>
        <li><a href="#">Servidor de E-mail</a></li>
        <li class="active">Cadastro</li>
    </ol>
</section>

<!-- form start -->
<form id="form_emailserver" role="form" method="POST" action="{{route('emailserver') . (empty($emailserver->id) ? '' : ('/' . $emailserver->id)) }}">
    {{ csrf_field() }}
    <!-- Main content -->
    <section class="content">
        <div class="row">
            <!-- left column -->
            <div class="col-md-12">
                <!-- general form elements -->
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Dados</h3>
                    </div>
                    <!-- /.box-header -->

                    <input name="_method" type="hidden" value="{{ empty($emailserver->id) ? 'POST' : 'PUT' }}">                    
                    <input type="hidden" name="id" id="id" value="{{ empty($emailserver->id) ? '' : $emailserver->id }}" />
                    <div class="box-body">

                        <div class=" col-md-6">
                            <div class="form-group">
                                <label for="name">Nome</label>
                                <input maxlength="100" required="true" type="text" id="name" name="name" value="{{ old('name', (empty($emailserver->name) ? '' : $emailserver->name)) }}" class="form-control" placeholder="Nome">
                                @if ($errors->has('name'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('name') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>

                        <div class=" col-md-6">
                            <div class="form-group">
                                <label for="host">Host</label>
                                <input maxlength="100" required="true" type="text" id="host" name="host" value="{{ old('host', (empty($emailserver->host) ? '' : $emailserver->host)) }}" class="form-control" placeholder="Host">
                                @if ($errors->has('host'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('host') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>

                        <div class=" col-md-6">
                            <div class="form-group">
                                <label for="porta">Porta</label>
                                <input maxlength="100" required="true" type="text" id="porta" name="porta" value="{{ old('porta', (empty($emailserver->porta) ? '' : $emailserver->porta)) }}" class="form-control" placeholder="Porta">
                                @if ($errors->has('porta'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('porta') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>

                        <div class=" col-md-6">
                            <div class="form-group">
                                <label for="user">Usuário</label>
                                <input maxlength="100" required="true" type="text" id="user" name="user" value="{{ old('user', (empty($emailserver->user) ? '' : $emailserver->user)) }}" class="form-control" placeholder="Usuário">
                                @if ($errors->has('user'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('user') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>

                        <div class=" col-md-6">
                            <div class="form-group">
                                <label for="password">Senha</label>
                                <input maxlength="100" required="true" type="text" id="password" name="password" value="{{ old('password', (empty($emailserver->password) ? '' : $emailserver->password)) }}" class="form-control" placeholder="Senha">
                                @if ($errors->has('password'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('password') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="security">Segurança</label>
                                <select required="true" id="security" name="security" class="form-control select2">
                                    <option value="SSL" {{ old('security', ( empty($emailserver->security) ? '' : $emailserver->security)) == 'SSL' ? 'selected' : '' }} >SSL</option>
                                    <option value="TLS" {{ old('security', ( empty($emailserver->security) ? '' : $emailserver->security)) == 'TLS' ? 'selected' : '' }} >TLS</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="status">Status</label>
                                <select required="true" id="status" name="status" class="form-control select2">
                                    <option value="A" {{ old('status', ( empty($emailserver->status) ? '' : $emailserver->status)) == 'A' ? 'selected' : '' }} >Ativo</option>
                                    <option value="I" {{ old('status', ( empty($emailserver->status) ? '' : $emailserver->status)) == 'I' ? 'selected' : '' }} >Inativo</option>
                                </select>
                            </div>
                        </div>

                    </div>
                    <!-- /.box-body -->
                    <div class="box-footer">
                        <button type="submit" class="btn btn-primary">Salvar</button>
                        <a href="{{route('emailserver')}}" class="btn btn-default btn-flat">Voltar
                        </a>
                    </div>
                </div>
                <!-- /.box -->

            </div>

            <!--/.col (right) -->
        </div>
        <!-- /.row -->
    </section>

</form>

@endsection
