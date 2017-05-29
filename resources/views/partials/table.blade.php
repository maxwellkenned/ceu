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
    </div>
    <div class="panel-body">
        @include('partials/createFolderModal')
        <div id="toolbar" class="btn-group">
            @if(isset($canback) && $canback != '/')
                <a href='{{ $canback!=''?route("readFolder", ["uri" => $canback]):route("home") }}' data-toggle="tooltip" data-placement="top" title="Voltar pasta">
                    <button type="button" class="btn btn-default" >
                        <i class="glyphicon glyphicon glyphicon-level-up"></i>
                    </button>
                </a>
            @endif
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#createFolderModal"  data-toggle="tooltip" data-placement="top" title="Criar pasta">
                <i class="fa fa-folder-o fa-fw" ></i>&nbsp; Criar Pasta
            </button>
        </div>
        
        @if($arquivos)
        <div class="table-responsive" style="margin-top:5px;">
           <table id="tableFiles" data-toggle="table" data-classes="table table-hover table-condensed" data-striped="true" data-search="true" data-query-params="queryParams"  data-page-list="[5, 10, 20, 50, 100, 200]" data-pagination="true" data-height="360" data-show-toggle="true" data-show-columns="true" data-toolbar="#toolbar">
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
                                
                                <td><i class='fa fa-lg {{ isset($arq["mime"])?$arq["mime"]:"" }}' ></i>&nbsp;<a href='{{ route("readFolder", ["uri" => isset($arq["download"])? $arq["download"] :""]) }}'>{{ isset($arq["name"])? $arq["name"]:"" }}</a></td>
                                <td>{{ isset($arq["path"])?$arq["path"]:"" }}</td>
                                <td></td>
                                <td></td>
                                <td>{{ isset($arq["create"])?$arq["create"]:"" }}</td>
                                <td>
                                    <form id="formDeleteFolder" action="{{ route('delete', ['id' => isset($arq['id'])?$arq['id']:""]) }}" method="POST" style="width: 22px; display: inherit;" data-toggle="tooltip" data-placement="right" title="Excluir pasta">
                                        {{ csrf_field() }}
                                        <input type="hidden" name="uri" value="{{$_SERVER['REQUEST_URI']}}">
                                        <button type="submit" id="btnFormDeleteFolder" class="btn btn-danger btn-sm btn-top-help" href="">
                                            <i class="fa fa-trash-o fa-lg"></i>
                                        </button>
                                    </form>
                                </td>
    
                            @else
                                <td><i class='fa fa-lg {{ isset($arq["mime"])?$arq["mime"]:"" }}' ></i>&nbsp;{{ isset($arq["name"])?$arq["name"]:"" }}</td>
                                <td>{{ isset($arq["path"])?$arq["path"]:"" }}</td>
                                <td>{{ isset($arq["ext"])?$arq["ext"]:"" }}</td>
                                <td>{{ isset($arq["size"])?$arq["size"]: ""}} </td>
                                <td>{{ isset($arq["create"])?$arq["create"]:"" }}</td>
                                <td class="button-group">
                                    <form id="formDelete" action="{{ route('delete', ['id' => isset($arq['id'])?$arq['id']:""]) }}" method="POST" style="margin: 0 2px 0 0; width: 22px; display: inherit;" data-toggle="tooltip" data-placement="top" title="Excluir arquivo">
                                        {{ csrf_field() }}
                                        <input type="hidden" name="uri" value="{{$_SERVER['REQUEST_URI']}}">
                                        <button type="submit" id="btnFormDelete" class="btn btn-danger btn-sm btn-top-help" href="">
                                            <i class="fa fa-trash-o fa-lg"></i>
                                        </button>
                                    </form>
                                    <form id="formDownload" action="{{ route('download', ['id' => isset($arq['id'])?$arq['id']:""]) }}" method="POST" style="width: 22px; display: inherit;" data-toggle="tooltip" data-placement="right" title="Baixar arquivo">
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