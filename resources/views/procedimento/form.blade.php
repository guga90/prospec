@extends('layouts.web')

@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        Procedimento
        <small>Formulário</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i>Home</a></li>
        <li><a href="#">Procedimento</a></li>
        <li class="active">Cadastro</li>
    </ol>
</section>

<!-- form start -->
<form id="form_procedimento" role="form" method="POST" action="{{route('procedimento') . (empty($procedimento->id) ? '' : ('/' . $procedimento->id)) }}">
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

                    <input name="_method" type="hidden" value="{{ empty($procedimento->id) ? 'POST' : 'PUT' }}">                    
                    <input type="hidden" name="id" id="id" value="{{ empty($procedimento->id) ? '' : $procedimento->id }}" />
                    <div class="box-body">

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="id_tprocedimento">Tabela</label>
                                <select id="id_tprocedimento" name="id_tprocedimento" class="form-control select2">
                                    <option value="" ></option>
                                    @foreach($tprocedimentos as $tprocedimento)
                                    <option {{ old('id_tprocedimento', ( empty($procedimento->id_tprocedimento) ? '' : $procedimento->id_tprocedimento)) == $tprocedimento->id ? 'selected' : '' }} value="{{ $tprocedimento->id }}" >{{ $tprocedimento->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class=" col-md-6">
                            <div class="form-group">
                                <label for="codigo">Código</label>
                                <input maxlength="100" required="true" type="text" id="codigo" name="codigo" value="{{ old('codigo', (empty($procedimento->codigo) ? '' : $procedimento->codigo)) }}" class="form-control" placeholder="Código">
                                @if ($errors->has('codigo'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('codigo') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>

                        <div class=" col-md-6">
                            <div class="form-group">
                                <label for="name">Nome</label>
                                <input maxlength="100" required="true" type="text" id="name" name="name" value="{{ old('name', (empty($procedimento->name) ? '' : $procedimento->name)) }}" class="form-control" placeholder="Nome">
                                @if ($errors->has('name'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('name') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>

                        <div class=" col-md-6">
                            <div class="form-group">
                                <label for="valor">Valor</label>
                                <input maxlength="100" required="true" type="text" id="valor" name="valor" value="{{ old('valor', (empty($procedimento->valor) ? '' : $procedimento->valor)) }}" class="form-control mask_money" placeholder="Valor">
                                @if ($errors->has('valor'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('valor') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="status">Status</label>
                                <select required="true" id="status" name="status" class="form-control select2">
                                    <option value="A" {{ old('status', ( empty($procedimento->status) ? '' : $procedimento->status)) == 'A' ? 'selected' : '' }} >Ativo</option>
                                    <option value="I" {{ old('status', ( empty($procedimento->status) ? '' : $procedimento->status)) == 'I' ? 'selected' : '' }} >Inativo</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <!-- /.box-body -->
                    <div class="box-footer">
                        <button type="submit" class="btn btn-primary">Salvar</button>
                        <a href="{{route('procedimento')}}" class="btn btn-default btn-flat">Voltar
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
