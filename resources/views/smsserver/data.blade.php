@extends('layouts.web')

@section('content')

<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        Servidor de SMS
        <small>Dados</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">Servidor de SMS</a></li>
        <li class="active">Cadastro</li>
    </ol>
</section>

<!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-xs-12">


            <div class="box">
                <div class="box-header">
                    <div class="pull-left">
                        <a href="{{route('smsserver.create')}}" class="btn btn-default btn-flat">Cadastrar novo</a>
                    </div>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <table id="datatable_default" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>Nome</th>
                                <th>Tipo</th>
                                <th>Status</th>
                                <th>Ações</th>
                            </tr>
                        </thead>
                        <tbody>

                            @foreach ($smsservers as $smsserver)

                            <tr>
                                <td>{{ $smsserver->name }}</td>
                                <td>{{ $smsserver->tipo == 'S' ? 'SMS' : 'E-MAIL'  }}</td>
                                <td>{{ $smsserver->status == 'A' ? 'Ativo' : 'Inativo'  }}</td>
                                <td>
                                    <div class="row">
                                    <!--a class="btn btn-info btn-sm" href="{{ route('smsserver.show',$smsserver->id) }}"><i class="glyphicon glyphicon-th-large"></i></a-->
                                        <a class="btn btn-primary btn-sm" href="{{ route('smsserver.edit',$smsserver->id) }}"><i class="glyphicon glyphicon-pencil"></i></a>
                                        <form id="" method="POST" action="{{route('smsserver') . ('/' . $smsserver->id) }}" style="display: inline;"> {{ csrf_field() }}
                                            {{ method_field('DELETE') }}
                                            <input name="id" type="hidden" value="{{ $smsserver->id }}">  
                                            <button type="submit" style="" class="btn btn-danger btn-sm"><i class="glyphicon glyphicon-trash"></i></button>
                                        </form>
                                    </div>
                                </td>
                            </tr>

                            @endforeach

                        </tbody>
                        <!--tfoot>
                            <tr>
                                <th>Rendering engine</th>
                                <th>Browser</th>
                                <th>Platform(s)</th>
                                <th>Engine version</th>
                                <th>CSS grade</th>
                            </tr>
                        </tfoot-->
                    </table>
                </div>
                <!-- /.box-body -->
            </div>
            <!-- /.box -->
        </div>
        <!-- /.col -->
    </div>
    <!-- /.row -->
</section>

<!-- /.content-wrapper -->

@endsection
