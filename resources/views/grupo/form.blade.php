@extends('layouts.web')

@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        Grupo
        <small>Formulário</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i>Home</a></li>
        <li><a href="#">Grupo</a></li>
        <li class="active">Cadastro</li>
    </ol>
</section>

<!-- form start -->
<form id="form_grupo" role="form" method="POST" action="{{route('grupo') . (empty($grupo->id) ? '' : ('/' . $grupo->id)) }}">
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

                    <input name="_method" type="hidden" value="{{ empty($grupo->id) ? 'POST' : 'PUT' }}">                    
                    <input type="hidden" name="id" id="id" value="{{ empty($grupo->id) ? '' : $grupo->id }}" />
                    <div class="box-body">
                        
                        <div class=" col-md-6">
                            <div class="form-group">
                                <label for="name">Nome</label>
                                <input maxlength="100" required="true" type="text" id="name" name="name" value="{{ old('name', (empty($grupo->name) ? '' : $grupo->name)) }}" class="form-control" placeholder="Nome">
                                @if ($errors->has('name'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('name') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="tipo">Tipo</label>
                                <select required="true" id="tipo" name="tipo" class="form-control select2">
                                    <option value="S" {{ old('tipo', ( empty($grupo->tipo) ? '' : $grupo->tipo)) == 'S' ? 'selected' : '' }} >SMS</option>
                                    <option value="E" {{ old('tipo', ( empty($grupo->tipo) ? '' : $grupo->tipo)) == 'E' ? 'selected' : '' }} >E-MAIL</option>
                                </select>
                            </div>
                        </div>
                        
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="status">Status</label>
                                <select required="true" id="status" name="status" class="form-control select2">
                                    <option value="A" {{ old('status', ( empty($grupo->status) ? '' : $grupo->status)) == 'A' ? 'selected' : '' }} >Ativo</option>
                                    <option value="I" {{ old('status', ( empty($grupo->status) ? '' : $grupo->status)) == 'I' ? 'selected' : '' }} >Inativo</option>
                                </select>
                            </div>
                        </div>
                        
                    </div>
                    <!-- /.box-body -->
                    <div class="box-footer">
                        <button type="submit" class="btn btn-primary">Salvar</button>
                        <a href="{{route('grupo')}}" class="btn btn-default btn-flat">Voltar
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
