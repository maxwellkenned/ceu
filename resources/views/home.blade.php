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
        <div class="col-md-8">
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
                <div class="table-responsive">
                   <table class="table table-striped table-condensed">
                         <tr>
                            <td></td>
                            <td>Arquivo</td>
                            <td>pasta</td>
                            <td>Extenção</td>
                            <td>Tamanho</td>
                            <td>Data upload</td>
                            <td>Ação</td>
                        </tr>
                    @foreach($arquivos as $arq)
                       <tr>
                            @if((isset($arq["type"])?$arq["type"]:'')==="folder")
                                <td><i class='fa {{ isset($arq["mime"])?$arq["mime"]:"" }}' /></td>
                                <td><a href='{{ route('readFolder', ['uri' => isset($arq["read"])? $arq["read"] :""]) }}'>{{ isset($arq["name"])? $arq["name"]:"" }}</a></td>
                                <td>{{ isset($arq["path"])?$arq["path"]:"" }}</td>
                                <td></td>
                                <td></td>
                                <td>{{ isset($arq["upload"])?$arq["upload"]:"" }}</td>
                                <td></td>

                            @else
                                <td><i class='fa {{ isset($arq["mime"])?$arq["mime"]:"" }}' /></td>
                                <td>{{ isset($arq["name"])?$arq["name"]:"" }}</td>
                                <td>{{ isset($arq["path"])?$arq["path"]:"" }}</td>
                                <td>{{ isset($arq["ext"])?$arq["ext"]:"" }}</td>
                                <td>{{ isset($arq["size"])?$arq["size"]: ""}} </td>
                                <td>{{ isset($arq["upload"])?$arq["upload"]:"" }}</td>
                                <td class="button-group">
                                    <form id="formDelete{{isset($arq["id"])?$arq["id"]:""}}" action="{{ route('delete', ['id' => isset($arq["id"])?$arq["id"]:""]) }}" method="POST" style="float: left; margin: 0 2px 0 0; width: auto;">
                                        {{ csrf_field() }}
                                        <input type="hidden" name="uri" value="{{$_SERVER['REQUEST_URI']}}">
                                        <button type="submit" class="btn btn-danger btn-sm btn-top-help" href="">
                                            <i class="fa fa-trash-o fa-lg"></i>
                                        </button>
                                    </form>
                                    <form id="formDownload{{isset($arq["id"])?$arq["id"]:""}}" action="{{ route('download', ['id' => isset($arq["id"])?$arq["id"]:""]) }}" method="POST" style="float: left; width: auto;">
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
        $('#jstree').jstree({
            'core': {
                'data': {
                    'url': '{!! route('tree.data') !!}',
                    'data': function (node) {
                        return {'id': node.id};
                    },
                    'error': function (data) {
                        $('#jstree').html('<p>We had an error...</p>');
                    }
                }
            }
        }).on('activate_node.jstree', function (e, data) {
            if(data.node.a_attr.href != "#"){
                window.location.assign(data.node.a_attr.href);
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
        
        function downloadSubmit(e){
            var id = e.id;
            $('#downloadFile').attr('action', '{{ route('download')}}/'+id);
            $('#downloadFile').submit();
        }
    </script>
@endsection