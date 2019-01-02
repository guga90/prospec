@extends('layouts.web')

@section('content')

<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        Matmed
        <small>Dados</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">Matmed</a></li>
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
                        <a href="{{route('matmed.create')}}" class="btn btn-default btn-flat">Cadastrar novo</a>
                    </div>
                </div>

                <form id="form_listar_matmed" role="form" method="POST" action="{{route('matmed')}}">
                    {{ csrf_field() }}
                </form>

                <!-- /.box-header -->
                <div class="box-body">
                    <table id="datatable_matmeds" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>Código</th>
                                <th>Nome</th>
                                <th>Status</th>
                                <th>Ações</th>
                            </tr>
                        </thead>
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
