@extends('layouts.web')

@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        Usuário
        <small>Formulário</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i>Home</a></li>
        <li><a href="#">Usuário</a></li>
        <li class="active">Cadastro</li>
    </ol>
</section>

<!-- form start -->
<form id="form_user" role="form" method="POST" action="{{route('user') . (empty($user->id) ? '' : ('/' . $user->id)) }}">
    {{ csrf_field() }}
    <!-- Main content -->
    <section class="content">
        <div class="row">
            <!-- left column -->
            <div class="col-md-12">
                <!-- general form elements -->
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Dados Pessoais</h3>
                    </div>
                    <!-- /.box-header -->

                    <input name="_method" type="hidden" value="{{ empty($user->id) ? 'POST' : 'PUT' }}">                    
                    <input type="hidden" name="id" id="id" value="{{ empty($user->id) ? '' : $user->id }}" />
                    <div class="box-body">

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="profile">Perfil</label>
                                <select required="true" id="profile" name="profile" class="form-control select2">
                                    <option value="A" {{ old('profile', ( empty($user->profile) ? '' : $user->profile)) == 'A' ? 'selected' : '' }} >Administrativo</option>
                                    <option value="U" {{ old('profile', ( empty($user->profile) ? '' : $user->profile)) == 'U' ? 'selected' : '' }} >Usuário</option>
                                </select>
                            </div>
                        </div>

                        <div class=" col-md-6">
                            <div class="form-group">
                                <label for="name">Nome</label>
                                <input maxlength="100" required="true" type="text" id="name" name="name" value="{{ old('name', (empty($user->name) ? '' : $user->name)) }}" class="form-control" placeholder="Nome">
                                @if ($errors->has('name'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('name') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="cpf">CPF</label>
                                <input required="true" required="true" type="text" id="cpf" name="cpf" value="{{ old('cpf', (empty($user->cpf) ? '' : $user->cpf)) }}" class="form-control mask_cpf" placeholder="CPF">
                                @if ($errors->has('cpf'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('cpf') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="cell_phone">Telefone Celular</label>
                                <input required="true" type="cell_phone" id="cell_phone" name="cell_phone" value="{{ old('cell_phone', (empty($user->cell_phone) ? '' : $user->cell_phone)) }}" class="form-control mask_cellphone" placeholder="Celular">
                                @if ($errors->has('cell_phone'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('cell_phone') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="home_phone">Telefone Residêncial</label>
                                <input type="home_phone" id="home_phone" name="home_phone" value="{{ old('home_phone', (empty($user->home_phone) ? '' : $user->home_phone)) }}" class="form-control mask_homephone" placeholder="Residêncial">
                                @if ($errors->has('home_phone'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('home_phone') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="cep">CEP</label>
                                <input onchange="searchAddress(this.value);" required="true" type="text" id="cep" name="cep" value="{{ old('cep', (empty($user->cep) ? '' : $user->cep)) }}" class="form-control mask_cep" placeholder="CEP">
                                @if ($errors->has('cep'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('cep') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label required="true" for="address">Endereço</label>
                                <input maxlength="100" type="text" id="address" name="address" value="{{ old('address', (empty($user->address) ? '' : $user->address)) }}" class="form-control" placeholder="Endereço">
                                @if ($errors->has('address'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('address') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label required="true" for="complement">Complemento</label>
                                <input maxlength="100" type="text" id="complement" name="complement" value="{{ old('complement', (empty($user->complement) ? '' : $user->complement)) }}" class="form-control" placeholder="Complemento">
                                @if ($errors->has('complement'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('complement') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="sector">Setor</label>
                                <input maxlength="100" required="true" type="text" id="sector" name="sector" value="{{ old('sector', (empty($user->sector) ? '' : $user->sector)) }}" class="form-control" placeholder="Setor">
                                @if ($errors->has('sector'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('sector') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="city">Cidade</label>
                                <input maxlength="100" required="true" type="text" id="city" name="city" value="{{ old('city', (empty($user->city) ? '' : $user->city)) }}" class="form-control" placeholder="Cidade">
                                @if ($errors->has('city'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('city') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="state">Estado</label>
                                <input maxlength="100" required="true" type="text" id="state" name="state" value="{{ old('state', (empty($user->state) ? '' : $user->state)) }}" class="form-control" placeholder="Estado">
                                @if ($errors->has('state'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('state') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="email">E-mail</label>
                                <input maxlength="100" type="email" id="email" name="email" value="{{ old('email', (empty($user->email) ? '' : $user->email)) }}" class="form-control" placeholder="E-mail">
                                @if ($errors->has('email'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('email') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="password">Senha</label>
                                <input maxlength="100" type="password" id="password" name="password" value="" class="form-control" placeholder="Senha">
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
                                    <option value="A" {{ old('status', ( empty($user->status) ? '' : $user->status)) == 'A' ? 'selected' : '' }} >Ativo</option>
                                    <option value="I" {{ old('status', ( empty($user->status) ? '' : $user->status)) == 'I' ? 'selected' : '' }} >Inativo</option>
                                </select>
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

            <!--/.col (right) -->
        </div>
        <!-- /.row -->
    </section>

</form>

@endsection
