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
                <div class="panel-heading">Upload</div>
                    <form action="/upload" class="dropzone needsclick dz-clickable" id="formUpload">
                        {{csrf_field()}}
                        <input type="hidden" name="uriFolder" value="{{$_SERVER['REQUEST_URI']}}">
                        
                    </form>
            </div>
            <div class="panel panel-default">
                <div class="panel-heading">
                    <span>Arquivos</span>

                    <div class="pull-right">
                        <button class="btn btn-primary btn-top-help" data-toggle="modal" data-target="#createFolderModal"><i class="fa fa-folder-o fa-fw" ></i>&nbsp; Criar Pasta</button>
                        @include('partials/createFolderModal')
                    </div>
                </div>
                @if($arquivos)
                <div class="table-responsive" style="margin-top:5px;">
                   <table id="tableFiles" data-toggle="table" data-classes="table table-hover table-condensed" data-striped="true" data-search="true" data-query-params="queryParams"  data-page-list="[5, 10, 20, 50, 100, 200]" data-pagination="true" data-height="400" data-show-toggle="true" data-show-columns="true">
                       <thead>
                            <tr>
                                <th data-field="name" data-sortable="true">Arquivo</th>
                                <th data-field="pasta" data-sortable="true">Pasta</th>
                                <th data-field="tipo" data-sortable="true">Tipo</th>
                                <th data-field="tamanho" data-sortable="true">Tamanho</th>
                                <th data-field="upload" data-sortable="true">Data upload</th>
                                <th data-field="acao">Ação</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($arquivos as $arq)
                                <tr>
                                    @if((isset($arq["isfolder"])?$arq["isfolder"]:''))
                                        
                                        <td><i class='fa fa-lg {{ isset($arq["mime"])?$arq["mime"]:"" }}' ></i>&nbsp; <a href='{{ route("readFolder", ["uri" => isset($arq["download"])? $arq["download"] :""]) }}'>{{ isset($arq["name"])? $arq["name"]:"" }}</a></td>
                                        <td>{{ isset($arq["path"])?$arq["path"]:"" }}</td>
                                        <td></td>
                                        <td></td>
                                        <td>{{ isset($arq["create"])?$arq["create"]:"" }}</td>
                                        <td>
                                            <form id="formDeleteFolder" action="{{ route('delete', ['id' => isset($arq['id'])?$arq['id']:""]) }}" method="POST" style="width: 22px; display: inherit;">
                                                {{ csrf_field() }}
                                                <input type="hidden" name="uri" value="{{$_SERVER['REQUEST_URI']}}">
                                                <button type="button" id="btnFormDeleteFolder" class="btn btn-danger btn-sm btn-top-help" href="">
                                                    <i class="fa fa-trash-o fa-lg"></i>
                                                </button>
                                            </form>
                                        </td>
        
                                    @else
                                        <td><i class='fa fa-lg {{ isset($arq["mime"])?$arq["mime"]:"" }}' ></i>&nbsp; {{ isset($arq["name"])?$arq["name"]:"" }}</td>
                                        <td>{{ isset($arq["path"])?$arq["path"]:"" }}</td>
                                        <td>{{ isset($arq["ext"])?$arq["ext"]:"" }}</td>
                                        <td>{{ isset($arq["size"])?$arq["size"]: ""}} </td>
                                        <td>{{ isset($arq["create"])?$arq["create"]:"" }}</td>
                                        <td class="button-group">
                                            <form id="formDelete" action="{{ route('delete', ['id' => isset($arq["id"])?$arq["id"]:""]) }}" method="POST" style="margin: 0 2px 0 0; width: 22px; display: inherit;">
                                                {{ csrf_field() }}
                                                <input type="hidden" name="uri" value="{{$_SERVER['REQUEST_URI']}}">
                                                <button type="button" id="btnFormDelete" class="btn btn-danger btn-sm btn-top-help" href="">
                                                    <i class="fa fa-trash-o fa-lg"></i>
                                                </button>
                                            </form>
                                            <form id="formDownload" action="{{ route('download', ['id' => isset($arq["id"])?$arq["id"]:""]) }}" method="POST" style="width: 22px; display: inherit;">
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
                        </tbody>
                   </table>
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
          dictDefaultMessage: "<i class='fa fa-upload fa-2x fa-fw'></i>&nbsp; Solte arquivos aqui ou clique para fazer o upload.",
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
        /*$(document).ready( function () {
            $('#tableFiles').DataTable();
        } );*/
    </script>
@endsection