@extends('layouts.web')

@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        Validador
        <small>Formulário</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i>Home</a></li>
        <li><a href="#">Validador</a></li>
        <li class="active">XML</li>
    </ol>
</section>

<!-- form start -->
<form enctype="multipart/form-data" id="form_validadorxml" role="form" method="POST" action="{{route('validarxml')}}">
    {{ csrf_field() }}
    <!-- Main content -->
    <section class="content">
        <div class="row">
            <!-- left column -->
            <div class="col-md-12">
                <!-- general form elements -->
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Validador</h3>
                    </div>
                    <!-- /.box-header -->

                    <input name="_method" type="hidden" value="{{ empty($user->id) ? 'POST' : 'PUT' }}">      
                    <div class="box-body">

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="versao">Versão TISS</label>
                                <select required="true" id="versao" name="versao" class="form-control select2">
                                    <option value="3_02_00" {{ old('versao', ( empty($versao) ? '' : $versao)) == '3_02_00' ? 'selected' : '' }} >3.02.00</option>
                                    <option value="3_03_01" {{ old('versao', ( empty($versao) ? '' : $versao)) == '3_03_01' ? 'selected' : '' }} >3.03.01</option>
                                    <option value="3_03_03" {{ old('versao', ( empty($versao) ? '' : $versao)) == '3_03_03' ? 'selected' : '' }} >3.03.03</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="arquivo">Arquivo</label>
                                <input id="arquivo" name="arquivo" type="file" />
                            </div>
                        </div>

                        <div class=" col-md-12">
                            <div class="form-group">
                                <label for="xml">XML</label>
                                <textarea class="lined" rows="30" style="width: 100%" type="text" id="xml" name="xml" class="form-control" >{{ old('xml', (empty($xml) ? '' : $xml)) }}</textarea>

                                @if ($errors->has('xml'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('xml') }}</strong>
                                </span>
                                @endif

                            </div>
                        </div>
                        <div class=" col-md-6">
                            <div class="form-group">
                                <label for="hash">Hash</label>
                                <input readonly="true" type="text" id="hash" name="hash" class="form-control" value="{{ old('hash', (empty($hash) ? '' : $hash)) }}"/>

                                @if ($errors->has('erros'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('erros') }}</strong>
                                </span>
                                @endif

                            </div>
                        </div>
                        <div class=" col-md-6">
                            <div class="form-group">
                                <label for="arquivo_nome">Nome do arquivo</label>
                                <input type="text" id="arquivo_nome" name="arquivo_nome" class="form-control" value="{{ old('arquivo_nome', (empty($arquivo_nome) ? '' : $arquivo_nome)) }}"/>

                                @if ($errors->has('erros'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('erros') }}</strong>
                                </span>
                                @endif

                            </div>
                        </div>

                    </div>
                    <!-- /.box-body -->
                    <div class="box-footer">
                        <button type="button" onclick="validarXml()" class="btn btn-primary">Validar</button>
                        <a href="{{route('validarxml')}}" class="btn btn-danger btn-flat">Limpar</a>                        
                        <button type="button" onclick="baixarXML()" class="btn btn-warning">Baixar XML</button>
                        <button type="button" onclick="baixarZIP()" class="btn btn-warning">Baixar ZIP</button>
                    </div>
                </div>
                <!-- /.box -->

            </div>

            <!--/.col (right) -->
        </div>
        <!-- /.row -->
        <?php $linha = array(); ?>
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">{{ count($erros) }} erros encontrados</h3>
            </div>
            @if($erros)
            <!-- /.box-header -->
            <div class="box-body no-padding">

                <table class="table table-striped">
                    <tr>

                        <th>Linha</th>
                        <th>Código</th>
                        <th>Menssagem</th>
                    </tr>

                    @foreach ($erros as $erro)
                    <?php array_push($linha, $erro['linha']); ?>
                    <tr>                        
                        <td>{{ $erro['linha'] }}</td>
                        <td>{{ $erro['tipo'] }}</td>
                        <td>{{ $erro['msg'] }}</td>
                    </tr>
                    @endforeach
                </table>

            </div>
            @endif
    </section>

</form>

<script type="text/javascript">

    var linhas = <?php echo json_encode($linha); ?>;

</script>

@endsection
