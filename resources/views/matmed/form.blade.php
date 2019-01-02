@extends('layouts.web')

@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        Matmed
        <small>Formulário</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i>Home</a></li>
        <li><a href="#">Matmed</a></li>
        <li class="active">Cadastro</li>
    </ol>
</section>

<!-- form start -->
<form id="form_matmed" role="form" method="POST" action="{{route('matmed') . (empty($matmed->id) ? '' : ('/' . $matmed->id)) }}">
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

                    <input name="_method" type="hidden" value="{{ empty($matmed->id) ? 'POST' : 'PUT' }}">                    
                    <input type="hidden" name="id" id="id" value="{{ empty($matmed->id) ? '' : $matmed->id }}" />
                    <div class="box-body">

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="id_tmatmed">Tabela</label>
                                <select id="id_tmatmed" name="id_tmatmed" class="form-control select2">
                                    <option value="" ></option>
                                    @foreach($tmatmeds as $tmatmed)
                                    <option {{ old('id_tmatmed', ( empty($matmed->id_tmatmed) ? '' : $matmed->id_tmatmed)) == $tmatmed->id ? 'selected' : '' }} value="{{ $tmatmed->id }}" >{{ $tmatmed->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="id_fabricante">Fábricante</label>
                                <select id="id_fabricante" name="id_fabricante" class="form-control select2">
                                    <option value="" ></option>
                                    @foreach($fabricantes as $fabricante)
                                    <option {{ old('id_fabricante', ( empty($matmed->id_fabricante) ? '' : $matmed->id_fabricante)) == $fabricante->id ? 'selected' : '' }} value="{{ $fabricante->id }}" >{{ $fabricante->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>


                        <div class=" col-md-6">
                            <div class="form-group">
                                <label for="codigo_fabricante"> Código Fábricante</label>
                                <input maxlength="100" required="true" type="text" id="codigo_fabricante" name="codigo_fabricante" value="{{ old('codigo_fabricante', (empty($matmed->codigo_fabricante) ?  ""   : $matmed->codigo_fabricante)) }}" class="form-control" placeholder=" Código Fábricante">
                                @if ($errors->has('codigo_fabricante'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('codigo_fabricante') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>
                        <div class=" col-md-6">
                            <div class="form-group">
                                <label for="nome_fabricante"> Nome Fábricante</label>
                                <input maxlength="100" required="true" type="text" id="nome_fabricante" name="nome_fabricante" value="{{ old('nome_fabricante', (empty($matmed->nome_fabricante) ?  ""   : $matmed->nome_fabricante)) }}" class="form-control" placeholder=" Nome Fábricante">
                                @if ($errors->has('nome_fabricante'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('nome_fabricante') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>
                        <div class=" col-md-6">
                            <div class="form-group">
                                <label for="codigo_matmed"> Código Matmed</label>
                                <input maxlength="100" required="true" type="text" id="codigo_matmed" name="codigo_matmed" value="{{ old('codigo_matmed', (empty($matmed->codigo_matmed) ?  ""   : $matmed->codigo_matmed)) }}" class="form-control" placeholder=" Código Matmed">
                                @if ($errors->has('codigo_matmed'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('codigo_matmed') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>
                        <div class=" col-md-6">
                            <div class="form-group">
                                <label for="codigo_matmed_fracionado"> Código Matmed Fracionado</label>
                                <input maxlength="100" type="text" id="codigo_matmed_fracionado" name="codigo_matmed_fracionado" value="{{ old('codigo_matmed_fracionado', (empty($matmed->codigo_matmed_fracionado) ?  ""   : $matmed->codigo_matmed_fracionado)) }}" class="form-control" placeholder=" Código Matmed Fracionado">
                                @if ($errors->has('codigo_matmed_fracionado'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('codigo_matmed_fracionado') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>
                        <div class=" col-md-6">
                            <div class="form-group">
                                <label for="nome_matmed"> Nome Matmed</label>
                                <input maxlength="100" required="true" type="text" id="nome_matmed" name="nome_matmed" value="{{ old('nome_matmed', (empty($matmed->nome_matmed) ?  ""   : $matmed->nome_matmed)) }}" class="form-control" placeholder=" Nome Matmed">
                                @if ($errors->has('nome_matmed'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('nome_matmed') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>
                        <div class=" col-md-6">
                            <div class="form-group">
                                <label for="codigo_apresentacao"> Código Apresentação</label>
                                <input maxlength="100" required="true" type="text" id="codigo_apresentacao" name="codigo_apresentacao" value="{{ old('codigo_apresentacao', (empty($matmed->codigo_apresentacao) ?  ""   : $matmed->codigo_apresentacao)) }}" class="form-control" placeholder=" Código Apresentação">
                                @if ($errors->has('codigo_apresentacao'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('codigo_apresentacao') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>
                        <div class=" col-md-6">
                            <div class="form-group">
                                <label for="nome_apresentacao"> Nome Apresentação</label>
                                <input maxlength="100" required="true" type="text" id="nome_apresentacao" name="nome_apresentacao" value="{{ old('nome_apresentacao', (empty($matmed->nome_apresentacao) ?  ""   : $matmed->nome_apresentacao)) }}" class="form-control" placeholder=" Nome Apresentação">
                                @if ($errors->has('nome_apresentacao'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('nome_apresentacao') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>
                        <div class=" col-md-6">
                            <div class="form-group">
                                <label for="preco"> Preço</label>
                                <input maxlength="100" required="true" type="text" id="preco" name="preco" value="{{ old('preco', (empty($matmed->preco) ?  ""   : $matmed->preco)) }}" class="form-control" placeholder=" Preço">
                                @if ($errors->has('preco'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('preco') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>
                        <div class=" col-md-6">
                            <div class="form-group">
                                <label for="preco_fabrica"> Preço Fábrica</label>
                                <input maxlength="100" type="text" id="preco_fabrica" name="preco_fabrica" value="{{ old('preco_fabrica', (empty($matmed->preco_fabrica) ?  ""   : $matmed->preco_fabrica)) }}" class="form-control" placeholder=" Preço Fábrica">
                                @if ($errors->has('preco_fabrica'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('preco_fabrica') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>
                        <div class=" col-md-6">
                            <div class="form-group">
                                <label for="preco_fracionado"> Preço Fracionado</label>
                                <input maxlength="100" type="text" id="preco_fracionado" name="preco_fracionado" value="{{ old('preco_fracionado', (empty($matmed->preco_fracionado) ?  ""   : $matmed->preco_fracionado)) }}" class="form-control" placeholder=" Preço Fracionado">
                                @if ($errors->has('preco_fracionado'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('preco_fracionado') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>
                        <div class=" col-md-6">
                            <div class="form-group">
                                <label for="preco_fabrica_fracionado"> Preço Fábrica Fracionado</label>
                                <input maxlength="100" type="text" id="preco_fabrica_fracionado" name="preco_fabrica_fracionado" value="{{ old('preco_fabrica_fracionado', (empty($matmed->preco_fabrica_fracionado) ?  ""   : $matmed->preco_fabrica_fracionado)) }}" class="form-control" placeholder=" Preço Fábrica Fracionado">
                                @if ($errors->has('preco_fabrica_fracionado'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('preco_fabrica_fracionado') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>
                        <div class=" col-md-6">
                            <div class="form-group">
                                <label for="quantidade"> Quantidade</label>
                                <input maxlength="100" type="text" id="quantidade" name="quantidade" value="{{ old('quantidade', (empty($matmed->quantidade) ?  ""   : $matmed->quantidade)) }}" class="form-control" placeholder=" Quantidade">
                                @if ($errors->has('quantidade'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('quantidade') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>
                        <div class=" col-md-6">
                            <div class="form-group">
                                <label for="edicao_brasindice"> Edição BRASINDICE</label>
                                <input maxlength="100" type="text" id="edicao_brasindice" name="edicao_brasindice" value="{{ old('edicao_brasindice', (empty($matmed->edicao_brasindice) ?  ""   : $matmed->edicao_brasindice)) }}" class="form-control" placeholder=" Edição BRASINDICE">
                                @if ($errors->has('edicao_brasindice'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('edicao_brasindice') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>
                        <div class=" col-md-6">
                            <div class="form-group">
                                <label for="portaria_piscofins"> Portaria PISCOFINS</label>
                                <input maxlength="100" type="text" id="portaria_piscofins" name="portaria_piscofins" value="{{ old('portaria_piscofins', (empty($matmed->portaria_piscofins) ?  ""   : $matmed->portaria_piscofins)) }}" class="form-control" placeholder=" Portaria PISCONFINS">
                                @if ($errors->has('portaria_piscofins'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('portaria_piscofins') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>
                        <div class=" col-md-6">
                            <div class="form-group">
                                <label for="codigo_tiss"> Código TISS</label>
                                <input maxlength="100" type="text" id="codigo_tiss" name="codigo_tiss" value="{{ old('codigo_tiss', (empty($matmed->codigo_tiss) ?  ""   : $matmed->codigo_tiss)) }}" class="form-control" placeholder=" Código TISS">
                                @if ($errors->has('codigo_tiss'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('codigo_tiss') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>
                        <div class=" col-md-6">
                            <div class="form-group">
                                <label for="codigo_tuss"> Código TUSS</label>
                                <input maxlength="100" type="text" id="codigo_tuss" name="codigo_tuss" value="{{ old('codigo_tuss', (empty($matmed->codigo_tuss) ?  ""   : $matmed->codigo_tuss)) }}" class="form-control" placeholder=" Código TUSS">
                                @if ($errors->has('codigo_tuss'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('codigo_tuss') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>
                        <div class=" col-md-6">
                            <div class="form-group">
                                <label for="codigo_barras"> Código Barras</label>
                                <input maxlength="100" type="text" id="codigo_barras" name="codigo_barras" value="{{ old('codigo_barras', (empty($matmed->codigo_barras) ?  ""   : $matmed->codigo_barras)) }}" class="form-control" placeholder=" Código Barras">
                                @if ($errors->has('codigo_barras'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('codigo_barras') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>
                        <div class=" col-md-6">
                            <div class="form-group">
                                <label for="codigo_reg_anvisa"> Código Reg ANVISA</label>
                                <input maxlength="100" type="text" id="codigo_reg_anvisa" name="codigo_reg_anvisa" value="{{ old('codigo_reg_anvisa', (empty($matmed->codigo_reg_anvisa) ?  ""   : $matmed->codigo_reg_anvisa)) }}" class="form-control" placeholder=" Código Reg ANVISA">
                                @if ($errors->has('codigo_reg_anvisa'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('codigo_reg_anvisa') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>
                        <div class=" col-md-6">
                            <div class="form-group">
                                <label for="data_validade_reg_anvisa"> Data Validade Reg ANVISA</label>
                                <input maxlength="100" type="text" id="data_validade_reg_anvisa" name="data_validade_reg_anvisa" value="{{ old('data_validade_reg_anvisa', (empty($matmed->data_validade_reg_anvisa) ?  ""   : $matmed->data_validade_reg_anvisa)) }}" class="form-control" placeholder=" Data Validade Reg ANVISA">
                                @if ($errors->has('data_validade_reg_anvisa'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('data_validade_reg_anvisa') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>
                        <div class=" col-md-6">
                            <div class="form-group">
                                <label for="tipo_embalagem"> Tipo Embalagem</label>
                                <input maxlength="100" type="text" id="tipo_embalagem" name="tipo_embalagem" value="{{ old('tipo_embalagem', (empty($matmed->tipo_embalagem) ?  ""   : $matmed->tipo_embalagem)) }}" class="form-control" placeholder=" Tipo Embalagem">
                                @if ($errors->has('tipo_embalagem'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('tipo_embalagem') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>
                        <div class=" col-md-6">
                            <div class="form-group">
                                <label for="uso_hospitalar"> Uso Hospitalar</label>
                                <input maxlength="100" type="text" id="uso_hospitalar" name="uso_hospitalar" value="{{ old('uso_hospitalar', (empty($matmed->uso_hospitalar) ?  ""   : $matmed->uso_hospitalar)) }}" class="form-control" placeholder=" Uso Hospitalar">
                                @if ($errors->has('uso_hospitalar'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('uso_hospitalar') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>
                        <div class=" col-md-6">
                            <div class="form-group">
                                <label for="fracionado"> Fracionado</label>
                                <input maxlength="100" type="text" id="fracionado" name="fracionado" value="{{ old('fracionado', (empty($matmed->fracionado) ?  ""   : $matmed->fracionado)) }}" class="form-control" placeholder=" Fracionado">
                                @if ($errors->has('fracionado'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('fracionado') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>
                        <div class=" col-md-6">
                            <div class="form-group">
                                <label for="diversos"> Diversos</label>
                                <input maxlength="100" type="text" id="diversos" name="diversos" value="{{ old('diversos', (empty($matmed->diversos) ?  ""   : $matmed->diversos)) }}" class="form-control" placeholder=" Diversos">
                                @if ($errors->has('diversos'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('diversos') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>
                        <div class=" col-md-6">
                            <div class="form-group">
                                <label for="generico"> Genérico</label>
                                <input maxlength="100" type="text" id="generico" name="generico" value="{{ old('generico', (empty($matmed->generico) ?  ""   : $matmed->generico)) }}" class="form-control" placeholder=" Generico">
                                @if ($errors->has('generico'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('generico') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>
                        <div class=" col-md-6">
                            <div class="form-group">
                                <label for="tipo"> Tipo</label>
                                <input maxlength="100" type="text" id="tipo" name="tipo" value="{{ old('tipo', (empty($matmed->tipo) ?  ""   : $matmed->tipo)) }}" class="form-control" placeholder=" Tipo">
                                @if ($errors->has('tipo'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('tipo') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>
                        <div class=" col-md-6">
                            <div class="form-group">
                                <label for="tabela"> Tabela</label>
                                <input maxlength="100" type="text" id="tabela" name="tabela" value="{{ old('tabela', (empty($matmed->tabela) ?  ""   : $matmed->tabela)) }}" class="form-control" placeholder=" Tabela">
                                @if ($errors->has('tabela'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('tabela') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>
           
                        <div class=" col-md-6">
                            <div class="form-group">
                                <label for="simpro_codigo_mercado"> Simpro Código Mercado</label>
                                <input maxlength="100" type="text" id="simpro_codigo_mercado" name="simpro_codigo_mercado" value="{{ old('simpro_codigo_mercado', (empty($matmed->simpro_codigo_mercado) ?  ""   : $matmed->simpro_codigo_mercado)) }}" class="form-control" placeholder=" Simpro Código Mercado">
                                @if ($errors->has('simpro_codigo_mercado'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('simpro_codigo_mercado') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>
                        <div class=" col-md-6">
                            <div class="form-group">
                                <label for="simpro_identificacao"> Simpro Identificação</label>
                                <input maxlength="100" type="text" id="simpro_identificacao" name="simpro_identificacao" value="{{ old('simpro_identificacao', (empty($matmed->simpro_identificacao) ?  ""   : $matmed->simpro_identificacao)) }}" class="form-control" placeholder=" Simpro Identificação">
                                @if ($errors->has('simpro_identificacao'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('simpro_identificacao') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>
                        <div class=" col-md-6">
                            <div class="form-group">
                                <label for="simpro_data_vigencia"> Simpro Data Vigência</label>
                                <input maxlength="100" type="text" id="simpro_data_vigencia" name="simpro_data_vigencia" value="{{ old('simpro_data_vigencia', (empty($matmed->simpro_data_vigencia) ?  ""   : $matmed->simpro_data_vigencia)) }}" class="form-control" placeholder=" Simpro Data Vigência">
                                @if ($errors->has('simpro_data_vigencia'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('simpro_data_vigencia') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>
                        <div class=" col-md-6">
                            <div class="form-group">
                                <label for="simpro_quantidade_embalagem"> Simpro Quantidade Embalagem</label>
                                <input maxlength="100" type="text" id="simpro_quantidade_embalagem" name="simpro_quantidade_embalagem" value="{{ old('simpro_quantidade_embalagem', (empty($matmed->simpro_quantidade_embalagem) ?  ""   : $matmed->simpro_quantidade_embalagem)) }}" class="form-control" placeholder=" Simpro Quantidade Embalagem">
                                @if ($errors->has('simpro_quantidade_embalagem'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('simpro_quantidade_embalagem') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>
                        <div class=" col-md-6">
                            <div class="form-group">
                                <label for="simpro_quantidade_fracao_usuario"> Simpro Quantidade Fração Usuário</label>
                                <input maxlength="100" type="text" id="simpro_quantidade_fracao_usuario" name="simpro_quantidade_fracao_usuario" value="{{ old('simpro_quantidade_fracao_usuario', (empty($matmed->simpro_quantidade_fracao_usuario) ?  ""   : $matmed->simpro_quantidade_fracao_usuario)) }}" class="form-control" placeholder=" Simpro Quantidade Fração Usuário">
                                @if ($errors->has('simpro_quantidade_fracao_usuario'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('simpro_quantidade_fracao_usuario') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>
                        <div class=" col-md-6">
                            <div class="form-group">
                                <label for="simpro_percentual_lucro_usuario"> Simpro Percentual Lucro Usuário</label>
                                <input maxlength="100" type="text" id="simpro_percentual_lucro_usuario" name="simpro_percentual_lucro_usuario" value="{{ old('simpro_percentual_lucro_usuario', (empty($matmed->simpro_percentual_lucro_usuario) ?  ""   : $matmed->simpro_percentual_lucro_usuario)) }}" class="form-control" placeholder=" Simpro Percentual Lucro Usuário">
                                @if ($errors->has('simpro_percentual_lucro_usuario'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('simpro_percentual_lucro_usuario') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>
                        <div class=" col-md-6">
                            <div class="form-group">
                                <label for="simpro_percentual_desconto"> Simpro Percentual Desconto</label>
                                <input maxlength="100" type="text" id="simpro_percentual_desconto" name="simpro_percentual_desconto" value="{{ old('simpro_percentual_desconto', (empty($matmed->simpro_percentual_desconto) ?  ""   : $matmed->simpro_percentual_desconto)) }}" class="form-control" placeholder=" Simpro Percentual Desconto">
                                @if ($errors->has('simpro_percentual_desconto'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('simpro_percentual_desconto') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>
                        <div class=" col-md-6">
                            <div class="form-group">
                                <label for="simpro_preco_fabr_embalagem"> Simpro Preço Fabr Embalagem</label>
                                <input maxlength="100" type="text" id="simpro_preco_fabr_embalagem" name="simpro_preco_fabr_embalagem" value="{{ old('simpro_preco_fabr_embalagem', (empty($matmed->simpro_preco_fabr_embalagem) ?  ""   : $matmed->simpro_preco_fabr_embalagem)) }}" class="form-control" placeholder=" Simpro Preço Fabr Embalagem">
                                @if ($errors->has('simpro_preco_fabr_embalagem'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('simpro_preco_fabr_embalagem') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>
                        <div class=" col-md-6">
                            <div class="form-group">
                                <label for="simpro_preco_vend_embalagem"> Simpro Preço Vend Embalagem</label>
                                <input maxlength="100" type="text" id="simpro_preco_vend_embalagem" name="simpro_preco_vend_embalagem" value="{{ old('simpro_preco_vend_embalagem', (empty($matmed->simpro_preco_vend_embalagem) ?  ""   : $matmed->simpro_preco_vend_embalagem)) }}" class="form-control" placeholder=" Simpro Preço Vend Embalagem">
                                @if ($errors->has('simpro_preco_vend_embalagem'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('simpro_preco_vend_embalagem') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>
                        <div class=" col-md-6">
                            <div class="form-group">
                                <label for="simpro_preco_usuario_embalagem"> Simpro Preço Usuário Embalagem</label>
                                <input maxlength="100" type="text" id="simpro_preco_usuario_embalagem" name="simpro_preco_usuario_embalagem" value="{{ old('simpro_preco_usuario_embalagem', (empty($matmed->simpro_preco_usuario_embalagem) ?  ""   : $matmed->simpro_preco_usuario_embalagem)) }}" class="form-control" placeholder=" Simpro Preço Usuário Embalagem">
                                @if ($errors->has('simpro_preco_usuario_embalagem'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('simpro_preco_usuario_embalagem') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>
                        <div class=" col-md-6">
                            <div class="form-group">
                                <label for="simpro_preco_fabr_fracao"> Simpro Preço Fabr Fração</label>
                                <input maxlength="100" type="text" id="simpro_preco_fabr_fracao" name="simpro_preco_fabr_fracao" value="{{ old('simpro_preco_fabr_fracao', (empty($matmed->simpro_preco_fabr_fracao) ?  ""   : $matmed->simpro_preco_fabr_fracao)) }}" class="form-control" placeholder=" Simpro Preço Fabr Fração">
                                @if ($errors->has('simpro_preco_fabr_fracao'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('simpro_preco_fabr_fracao') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>
                        <div class=" col-md-6">
                            <div class="form-group">
                                <label for="simpro_preco_vend_fracao"> Simpro Preço Vend Fração</label>
                                <input maxlength="100" type="text" id="simpro_preco_vend_fracao" name="simpro_preco_vend_fracao" value="{{ old('simpro_preco_vend_fracao', (empty($matmed->simpro_preco_vend_fracao) ?  ""   : $matmed->simpro_preco_vend_fracao)) }}" class="form-control" placeholder=" Simpro Preço Vend Fração">
                                @if ($errors->has('simpro_preco_vend_fracao'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('simpro_preco_vend_fracao') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>
                        <div class=" col-md-6">
                            <div class="form-group">
                                <label for="simpro_preco_usuario_fracao"> Simpro Preço Usuário Fração</label>
                                <input maxlength="100" type="text" id="simpro_preco_usuario_fracao" name="simpro_preco_usuario_fracao" value="{{ old('simpro_preco_usuario_fracao', (empty($matmed->simpro_preco_usuario_fracao) ?  ""   : $matmed->simpro_preco_usuario_fracao)) }}" class="form-control" placeholder=" Simpro Preço Usuário Fração">
                                @if ($errors->has('simpro_preco_usuario_fracao'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('simpro_preco_usuario_fracao') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>


                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="status">Status</label>
                                <select required="true" id="status" name="status" class="form-control select2">
                                    <option value="A" {{ old('status', ( empty($matmed->status) ? '' : $matmed->status)) == 'A' ? 'selected' : '' }} >Ativo</option>
                                    <option value="I" {{ old('status', ( empty($matmed->status) ? '' : $matmed->status)) == 'I' ? 'selected' : '' }} >Inativo</option>
                                </select>
                            </div>
                        </div>
                    </div>



                    <!-- /.box-body -->
                    <div class="box-footer">
                        <button type="submit" class="btn btn-primary">Salvar</button>
                        <a href="{{route('matmed')}}" class="btn btn-default btn-flat">Voltar
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
