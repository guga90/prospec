@extends('layouts.web')

@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        Pesquisa
        <small>Consulta de procedimentos e matmed</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Pesquisa</li>
    </ol>
</section>

<!-- Main content -->
<section class="content">
    <!-- Small boxes (Stat box) -->
    <div class="row">
        <div class="col-md-12">
            <form class="form-horizontal" method="GET">
                <div class="form-group margin-bottom-none">
                    <div class="col-sm-9">
                        <input class="form-control input-lg" id="q" name="q" value="{{ old('q', (empty($search) ? '' : $search)) }}"
                               placeholder="Digite uma palavra chave">
                    </div>
                    <div class="col-sm-3">
                        <button type="submit" class="btn btn-danger pull-right btn-block btn-lg">Consultar</button>
                    </div>
                </div>
            </form>

        </div>
    </div>
    <!-- /.row -->
    <br>
    <!-- /.row -->

    @foreach ($kits as $kit)

    <div class="row">
        <div class="col-xs-12">
            <div class="box">

                <!-- /.box-header -->
                <div class="box-body table-responsive no-padding">
                    <div class="box-header">
                        <h3 class="box-title">Kit de Procedimento</h3>
                    </div>
                    <table class="table table-bordered">
                        <tr>
                            <th>Código</th>
                            <td>{{ $kit['procedimento']->codigo_procedimento }}</td>
                        </tr>
                        <tr>
                            <th>Descrição</th>
                            <td>{{ $kit['procedimento']->nome_procedimento }}</td>
                        </tr>
                        <tr>
                            <th>Valor</th>            
                            <td>R$ {{ number_format($kit['procedimento']->valor_procedimento,2, ',', '.') }}</td>
                        </tr>
                    </table>
                </div>
                <div class="box-header">
                    <h3 class="box-title">Matmeds</h3>
                </div>
                <table class="table table-bordered">
                    <tr>
                            <th>Código</th>
                            <th>Descrição</th>
                            <th>Qtd Kit</th>                            
                            <th>Preço</th>
                            <th>Preço Fab.</th>
                            <th>Fabricante</th>
                            <th>Código ANVISA</th>
                            <th>Genérico</th>
                    </tr>

                    @foreach ($kit['matmeds'] as $matmed)
                    <tr>
                           <td>{{ $matmed->codigo_tiss_tuss }}</td>
                            <td><a title="Bula" target="__blank" href="https://consultaremedios.com.br/{{ explode(' - ', strtolower($matmed->nome_matmed))[0] }}/bula">{{ $matmed->nome_matmed }} {{ $matmed->nome_apresentacao }}</a></td>
                            <td><span class="label label-success">{{ $matmed->quantidade_kit }}</span></td>                            
                            <td>R$ {{ number_format($matmed->preco, 2, ',', '') }}</td>
                            <td>R$ {{ number_format($matmed->preco_fabrica, 2, ',', '') }}</td>
                            <td>{{ $matmed->nome_fabricante }}</td>                            
                            <td>{{ $matmed->codigo_anvisa }}</td>                            
                            <td>{{ $matmed->generico }}</td>
                    </tr>
                    @endforeach
                </table>
            </div>
            <!-- /.box-body -->
        </div>
        <!-- /.box -->
    </div>

    @endforeach

    @if(count($matmeds) > 0)

    <div class="row">
        <div class="col-xs-12">
            <div class="box">

                <!-- /.box-header -->
                <div class="box-body table-responsive no-padding">
                    <div class="box-header">
                        <h3 class="box-title">Matmeds</h3>
                    </div>

                    <table class="table table-bordered">
                        <tr>
                            <th>Código</th>
                            <th>Descrição</th>
                            <th>Qtd.</th>                            
                            <th>Preço</th>
                            <th>Preço Fab.</th>
                            <th>Fabricante</th>
                            <th>Código ANVISA</th>
                            <th>Genérico</th>
                        </tr>

                        @foreach ($matmeds as $matmed)
                        <tr>
                            <td>{{ $matmed->codigo_tiss_tuss }}</td>
                            <td><a title="Bulário" target="__blank" href="https://consultaremedios.com.br/{{ explode(' - ', strtolower($matmed->nome_matmed))[0] }}/bula">{{ $matmed->nome_matmed }} {{ $matmed->nome_apresentacao }}</a></td>
                            <td><span class="label label-success">{{ $matmed->quantidade_matmed }}</span></td>                            
                            <td>R$ {{ number_format($matmed->preco, 2, ',', '') }}</td>
                            <td>R$ {{ number_format($matmed->preco_fabrica, 2, ',', '') }}</td>
                            <td>{{ $matmed->nome_fabricante }}</td>                            
                            <td>{{ $matmed->codigo_anvisa }}</td>                            
                            <td>{{ $matmed->generico }}</td>
                        </tr>
                        @endforeach

                    </table>
                </div>
                <!-- /.box-body -->
            </div>
            <!-- /.box -->
        </div>
    </div>

    @endif

    @if(count($procedimentos) > 0)
    <div class="row">
        <div class="col-xs-12">
            <div class="box">

                <!-- /.box-header -->
                <div class="box-body table-responsive no-padding">
                    <div class="box-header">
                        <h3 class="box-title">Procedimentos</h3>
                    </div>

                    <table class="table table-bordered">
                        <tr>
                            <th>Código</th>
                            <th>Descrição</th>
                            <th>Valor</th>
                        </tr>

                        @foreach ($procedimentos as $procedimento)
                        <tr>
                            <td>{{ $procedimento->codigo_procedimento }}</td>
                            <td>{{ $procedimento->nome_procedimento }}</td>
                            <td>R$ {{ number_format($procedimento->valor_procedimento,2, ',', '.') }}</td>
                        </tr>
                        @endforeach

                    </table>
                </div>
                <!-- /.box-body -->
            </div>
            <!-- /.box -->
        </div>
    </div>

    @endif

</section>


@endsection
