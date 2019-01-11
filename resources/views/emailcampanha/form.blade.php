@extends('layouts.web')

@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        Campanha de E-mail
        <small>Formulário</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i>Home</a></li>
        <li><a href="#">Campanha de E-mail</a></li>
        <li class="active">Cadastro</li>
    </ol>
</section>

<!-- form start -->
<form id="form_emailcampanha" role="form" method="POST" action="{{route('emailcampanha') . (empty($emailcampanha->id) ? '' : ('/' . $emailcampanha->id)) }}">
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

                    <input name="_method" type="hidden" value="{{ empty($emailcampanha->id) ? 'POST' : 'PUT' }}">                    
                    <input type="hidden" name="id" id="id" value="{{ empty($emailcampanha->id) ? '' : $emailcampanha->id }}" />
                    <div class="box-body">

                        <div class=" col-md-6">
                            <div class="form-group">
                                <label for="name">Nome</label>
                                <input maxlength="100" required="true" type="text" id="name" name="name" value="{{ old('name', (empty($emailcampanha->name) ? '' : $emailcampanha->name)) }}" class="form-control" placeholder="Nome">
                                @if ($errors->has('name'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('name') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="status">Status</label>
                                <select required="true" id="status" name="status" class="form-control select2">
                                    <option value="A" {{ old('status', ( empty($emailcampanha->status) ? '' : $emailcampanha->status)) == 'A' ? 'selected' : '' }} >Ativo</option>
                                    <option value="I" {{ old('status', ( empty($emailcampanha->status) ? '' : $emailcampanha->status)) == 'I' ? 'selected' : '' }} >Inativo</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="id_grupo">Grupo</label>
                                <select id="id_grupo" name="id_grupo[]" class="form-control multiple select2" multiple>
                                    @foreach($grupos as $grupo)
                                    <option {{$grupo->active ? 'selected' : ''}} value="{{$grupo->id}}" >{{$grupo->name}}</option>
                                    @endforeach
                                </select>
                                @if ($errors->has('id_grupo'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('id_grupo') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>

                        <div class=" col-md-12">
                            <div class="form-group">
                                <label for="msg">Campanha</label>
                                <textarea id="msg" name="msg" class="form-control">{{ old('msg', (empty($emailcampanha->msg) ? '' : $emailcampanha->msg)) }}</textarea>
                                @if ($errors->has('msg'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('msg') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>

                    </div>
                    <!-- /.box-body -->
                    <div class="box-footer">
                        <button type="submit" class="btn btn-primary">Salvar</button>
                        <a href="{{route('emailcampanha')}}" class="btn btn-default btn-flat">Voltar
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
