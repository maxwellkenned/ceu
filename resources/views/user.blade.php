@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-3">
            <div class="panel panel-default table-responsive">
                <div class="panel-heading" style="padding: 5px 10px;"><a class="btn btn-primary" href="{{route('home')}}"><i class="fa fa-home fa-fw"></i>&nbsp; Início </a></div>
                    <div id="jstree"></div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <spen><a href="javascript:history.back()">voltar</a></spen>
                    <span>Arquivos de {{$user->name}}</span>
                </div>
                @if($arquivos)
                <div class="table-responsive">
                   <table class="table table-striped table-condensed">
                         <tr>
                            <td>Arquivo</td>
                            <td>Pasta</td>
                            <td>Tipo</td>
                            <td>Tamanho</td>
                            <td>Data upload</td>
                            <td>Ação</td>
                        </tr>
                    @foreach($arquivos as $arq)
                       <tr>
                            @if((isset($arq["isfolder"])?$arq["isfolder"]:''))
                                
                                <td><i class='fa fa-lg {{ isset($arq["mime"])?$arq["mime"]:"" }}' ></i>&nbsp; <a href='{{ route("perfilRead", ["id" => isset($arq["idusuario"]) ? $arq["idusuario"] : "", "uri" => isset($arq["download"]) ? $arq["download"] :"" ]) }}'>{{ isset($arq["name"])? $arq["name"]:"" }}</a></td>
                                <td>{{ isset($arq["path"])?$arq["path"]:"" }}</td>
                                <td></td>
                                <td></td>
                                <td>{{ isset($arq["create"])?$arq["create"]:"" }}</td>
                                <td></td>

                            @else
                                <td><i class='fa fa-lg {{ isset($arq["mime"])?$arq["mime"]:"" }}' ></i>&nbsp; {{ isset($arq["name"])?$arq["name"]:"" }}</td>
                                <td>{{ isset($arq["path"])?$arq["path"]:"" }}</td>
                                <td>{{ isset($arq["ext"])?$arq["ext"]:"" }}</td>
                                <td>{{ isset($arq["size"])?$arq["size"]: ""}} </td>
                                <td>{{ isset($arq["create"])?$arq["create"]:"" }}</td>
                                <td class="button-group">
                                    <form id="formDownload" action="{{ route('download', ['id' => isset($arq["id"])?$arq["id"]:""]) }}" method="POST" style="float: left; width: auto;">
                                        {{ csrf_field() }}
                                        <input type="hidden" name="uri" value="{{$_SERVER['REQUEST_URI']}}">
                                        <button type="submit" class="btn btn-primary btn-sm btn-top-help" href="">
                                            <i class="fa fa-cloud-download fa-lg"></i>
                                        </button>
                                    </form>
                                </td>
                            @endif
                       </tr>
                    @endforeach
                   </table>
                </div>
                    @else
                        <div class="table-responsive">
                            <h5>Pasta Fazia</h5>
                        </div>
                    @endif
            </div>
        </div>
    </div>
</div>
<form id="downloadFile" method="POST" style="display:none;">
    {{ csrf_field() }}
    <input type="hidden" name="uri" value="{{$_SERVER['REQUEST_URI']}}">
    <button type="submit" class="btn btn-danger btn-sm btn-top-help" href="">
        <i class="fa fa-trash-o fa-lg"></i>
    </button>
</form>
@endsection
@section('script')
    <script type="text/javascript">
        function downloadSubmit(e){
            var id = e.id;
            $('#downloadFile').attr('action', "{{ route('download')}}/"+id);
            $('#downloadFile').submit();
        }
        $('#jstree').jstree({
            'core': {
                'data': {
                    'url': "{!! route('tree.data') !!}",
                    'data': function (node) {
                        return {'id': node.id};
                    },
                    'error': function (data) {
                        $('#jstree').html('<p>We had an error...</p>');
                    }
                }
            }
        }).on('changed.jstree', function (e, data) {
            
            if(data.node.a_attr.href === "#"){
                window.location.href = "{{ route('readFolder')}}/"+data.node.a_attr.id;
            }
        });
        Dropzone.options.formUpload = {
          paramName: "uploadfile", // The name that will be used to transfer the file
          maxFilesize: 10000,
          uploadMultiple: true,
          dictDefaultMessage: "Solte arquivos aqui ou clique para fazer o upload.",
          queuecomplete: function(){
            window.location.reload();
          }
        };
        
        
        function submitForm(id){
            $(id).submit();
        }
        $('#btnFormDelete').on('click', function(){
            $.confirm({
                title: 'Alerta!',
                icon: 'fa fa-exclamation-triangle fa-lg',
                type: 'red',
                closeIcon: true,
                animation: 'bottom',
                theme: 'Supervan',
                backgroundDismiss: true,
                autoClose: 'Cancelar|10000',
                columnClass: '',
                content: '<h3>Você tem certeza que deseja excluir esse arquivo?</h3>',
                buttons: {
                    Sim: {
                        btnClass: 'btn-blue',
                        action: function () {
                            submitForm('#formDelete');
                        }
                    },
                    Cancelar: {
                        function () {
                      this.close();
                    }
                }
                }
            });
        });
        $('#btnFormDeleteFolder').on('click', function(){
            $.confirm({
                title: 'Alerta!',
                icon: 'fa fa-exclamation-triangle fa-lg',
                type: 'red',
                closeIcon: true,
                animation: 'bottom',
                theme: 'Supervan',
                backgroundDismiss: true,
                autoClose: 'Cancelar|10000',
                columnClass: '',
                content: '<h4>Ao excluir essa pasta você excluirá todos os arquivos contidos nela, tem certeza?</h4>',
                buttons: {
                    Sim: {
                        btnClass: 'btn-blue',
                        action: function () {
                            submitForm('#formDeleteFolder');
                        }
                    },
                    Cancelar: {
                        function () {
                      this.close();
                    }
                }
                },
                onContentReady: function(){
                   this.setDialogCenter(); 
                }
            });
        });
    </script>
@endsection