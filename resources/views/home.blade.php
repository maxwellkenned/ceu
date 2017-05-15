@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-3">
            <div class="panel panel-default">
                <div class="panel-heading">Pastas</div>
                <table class="table table-responsive">
                    <div id="jstree"></div>
                </table>
            </div>
        </div>
        <div class="col-md-8">
            <div class="panel panel-default">
                <div class="panel-heading">Upload</div>
                    <form action="/upload" class="dropzone needsclick dz-clickable" id="formUpload">
                        {{csrf_field()}}
                    </form>
            </div>
            <div class="panel panel-default">
                <div class="panel-heading">Arquivos</div>
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
                            <td><i class="fa {{$arq["mime"]}}" /></td>
                            <td>{{$arq["name"] }}</td>
                            <td>{{$arq["path"]}}</td>
                            <td>{{$arq["ext"]}}</td>
                            <td>{{number_format($arq["size"]/1024, 3)}} MB</td>
                            <td>{{$arq["upload"]}}</td>
                            <td><a href="d/{{$arq["download"]}}">Download</a></td>
                       </tr>
                    @endforeach
                   </table>
                </div>
                   @endif
            </div>
        </div>
    </div>
</div>
@endsection
@section('script')
    <!-- jQuery (necessary for JsTree) -->
        <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script> -->
        <!-- JsTree 3.3.1 -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jstree/3.2.1/jstree.min.js"></script>

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
                window.open(data.node.a_attr.href);
            }
        });
        Dropzone.options.formUpload = {
          paramName: "uploadfile", // The name that will be used to transfer the file
          uploadMultiple: true,
          dictDefaultMessage: "Solte arquivos aqui ou clique para fazer o upload.",
          queuecomplete: function(){
            window.location.href ="{{url('/')}}";
          }
        };
    </script>
@endsection