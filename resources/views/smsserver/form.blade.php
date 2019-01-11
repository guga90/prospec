@extends('layouts.web')

@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        Servidor de SMS
        <small>Formulário</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i>Home</a></li>
        <li><a href="#">Servidor de SMS</a></li>
        <li class="active">Cadastro</li>
    </ol>
</section>

<!-- form start -->
<form id="form_smsserver" role="form" method="POST" action="{{route('smsserver') . (empty($smsserver->id) ? '' : ('/' . $smsserver->id)) }}">
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

                    <input name="_method" type="hidden" value="{{ empty($smsserver->id) ? 'POST' : 'PUT' }}">                    
                    <input type="hidden" name="id" id="id" value="{{ empty($smsserver->id) ? '' : $smsserver->id }}" />
                    <div class="box-body">
                        
                         <div class=" col-md-6">
                            <div class="form-group">
                                <label for="name">Nome</label>
                                <input maxlength="100" required="true" type="text" id="name" name="name" value="{{ old('name', (empty($smsserver->name) ? '' : $smsserver->name)) }}" class="form-control" placeholder="Nome">
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
                                <input maxlength="100" required="true" type="text" id="host" name="host" value="{{ old('host', (empty($smsserver->host) ? '' : $smsserver->host)) }}" class="form-control" placeholder="Host">
                                @if ($errors->has('host'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('host') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>

                        <div class=" col-md-6">
                            <div class="form-group">
                                <label for="user">Usuário</label>
                                <input maxlength="100" required="true" type="text" id="user" name="user" value="{{ old('user', (empty($smsserver->user) ? '' : $smsserver->user)) }}" class="form-control" placeholder="Usuário">
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
                                <input maxlength="100" required="true" type="text" id="password" name="password" value="{{ old('password', (empty($smsserver->password) ? '' : $smsserver->password)) }}" class="form-control" placeholder="Senha">
                                @if ($errors->has('password'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('password') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="status">Status</label>
                                <select required="true" id="status" name="status" class="form-control select2">
                                    <option value="A" {{ old('status', ( empty($smsserver->status) ? '' : $smsserver->status)) == 'A' ? 'selected' : '' }} >Ativo</option>
                                    <option value="I" {{ old('status', ( empty($smsserver->status) ? '' : $smsserver->status)) == 'I' ? 'selected' : '' }} >Inativo</option>
                                </select>
                            </div>
                        </div>
                        
                    </div>
                    <!-- /.box-body -->
                    <div class="box-footer">
                        <button type="submit" class="btn btn-primary">Salvar</button>
                        <a href="{{route('smsserver')}}" class="btn btn-default btn-flat">Voltar
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
