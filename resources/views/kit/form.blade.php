@extends('layouts.web')

@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        Kit
        <small>Formulário</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i>Home</a></li>
        <li><a href="#">Kit</a></li>
        <li class="active">Cadastro</li>
    </ol>
</section>

<!-- form start -->
<form id="form_kit" role="form" method="POST" action="{{route('kit') . (empty($kit->id) ? '' : ('/' . $kit->id)) }}" onsubmit="return validarForm();">
    {{ csrf_field() }}
    <!-- Main content -->
    <section class="content">
        <div class="row">
            <!-- left column -->
            <div class="col-md-12">
                <!-- general form elements -->
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Geral</h3>
                    </div>
                    <!-- /.box-header -->

                    <input name="_method" type="hidden" value="{{ empty($kit->id) ? 'POST' : 'PUT' }}">                    
                    <input type="hidden" name="id" id="id" value="{{ empty($kit->id) ? '' : $kit->id }}" />
                    <div class="box-body">

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="id_especialidade">Especialidade</label>
                                <select id="id_especialidade" name="id_especialidade" class="form-control select2">
                                    <option value="" ></option>
                                    @foreach($especialidades as $especialidade)
                                    <option {{ old('id_especialidade', ( empty($kit->id_especialidade) ? '' : $kit->id_especialidade)) == $especialidade->id ? 'selected' : '' }} value="{{ $especialidade->id }}" >{{ $especialidade->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="id_procedimento">Procedimento</label>
                                <select id="id_procedimento" name="id_procedimento" class="form-control select2">

                                    <option value="" ></option>
                                    @foreach($procedimentos as $procedimento)
                                    <option {{ old('id_procedimento', ( empty($kit->id_procedimento) ? '' : $kit->id_procedimento)) == $procedimento->id ? 'selected' : '' }} value="{{ $procedimento->id }}" >{{ $procedimento->name }}</option>
                                    @endforeach

                                </select>
                            </div>
                        </div>

                        <div class=" col-md-12">
                            <div class="form-group">
                                <label for="info">Informações</label>
                                <textarea id="info" name="info" class="form-control" placeholder="Informações">{{ old('info', (empty($kit->info) ? '' : $kit->info)) }}</textarea>
                                @if ($errors->has('info'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('info') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>

                    </div>

                </div>

                <!--/.col (right) -->
            </div>
        </div>


        <div class="row">
            <!-- left column -->
            <div class="col-md-12">
                <!-- general form elements -->
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Matmed</h3>
                    </div>

                    <div class="box-body">

                        <div id="matmeds"></div>

                        <div class="col-md-12">
                            <button type="button" class="col-md-12 btn btn-success" onclick="adicionarMatmed({id_matmed: '', name_matmed: '', quantidade: ''})">Adicionar</button>
                        </div>
                    </div>

                    <!-- /.box-body -->
                    <div class="box-footer">
                        <button type="submit" class="btn btn-primary">Salvar</button>
                        <a href="{{route('kit')}}" class="btn btn-default btn-flat">Voltar
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

<script type="text/javascript">

    var kitmatmeds = <?php echo empty($kitmatmeds) ? '' : $kitmatmeds ?>;

</script>

@endsection
