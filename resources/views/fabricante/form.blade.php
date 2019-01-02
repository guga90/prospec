@extends('layouts.web')

@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        Fabricante
        <small>Formulário</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i>Home</a></li>
        <li><a href="#">Fabricante</a></li>
        <li class="active">Cadastro</li>
    </ol>
</section>

<!-- form start -->
<form id="form_fabricante" role="form" method="POST" action="{{route('fabricante') . (empty($fabricante->id) ? '' : ('/' . $fabricante->id)) }}">
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

                    <input name="_method" type="hidden" value="{{ empty($fabricante->id) ? 'POST' : 'PUT' }}">                    
                    <input type="hidden" name="id" id="id" value="{{ empty($fabricante->id) ? '' : $fabricante->id }}" />
                    <div class="box-body">
                        
                        <div class=" col-md-6">
                            <div class="form-group">
                                <label for="name">Nome</label>
                                <input maxlength="100" required="true" type="text" id="name" name="name" value="{{ old('name', (empty($fabricante->name) ? '' : $fabricante->name)) }}" class="form-control" placeholder="Nome">
                                @if ($errors->has('name'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('name') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>
                        
                        <div class=" col-md-6">
                            <div class="form-group">
                                <label for="name_marca">Marca</label>
                                <input maxlength="100" required="true" type="text" id="name_marca" name="name_marca" value="{{ old('name_marca', (empty($fabricante->name_marca) ? '' : $fabricante->name_marca)) }}" class="form-control" placeholder="Marca">
                                @if ($errors->has('name_marca'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('name_marca') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>
                        
                        <div class=" col-md-6">
                            <div class="form-group">
                                <label for="cnpj">CNPJ</label>
                                <input maxlength="100" required="true" type="text" id="cnpj" name="cnpj" value="{{ old('cnpj', (empty($fabricante->cnpj) ? '' : $fabricante->cnpj)) }}" class="form-control mask_cnpj" placeholder="CNPJ">
                                @if ($errors->has('cnpj'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('cnpj') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="status">Status</label>
                                <select required="true" id="status" name="status" class="form-control select2">
                                    <option value="A" {{ old('status', ( empty($fabricante->status) ? '' : $fabricante->status)) == 'A' ? 'selected' : '' }} >Ativo</option>
                                    <option value="I" {{ old('status', ( empty($fabricante->status) ? '' : $fabricante->status)) == 'I' ? 'selected' : '' }} >Inativo</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <!-- /.box-body -->
                    <div class="box-footer">
                        <button type="submit" class="btn btn-primary">Salvar</button>
                        <a href="{{route('fabricante')}}" class="btn btn-default btn-flat">Voltar
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
