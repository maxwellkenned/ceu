@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-3">
            <div class="panel panel-default table-responsive">
                <div class="panel-heading" style="padding: 5px 10px;"><a class="btn btn-primary" href="{{route('home')}}"><i class="fa fa-home fa-fw"></i>&nbsp; Início </a></div>
                    <div id="jstree"></div>
            </div>
        </div>
        <div class="col-md-7">
            @include('partials/table')
        </div>
        <div class="col-md-2">
            @include('partials/chat')
        </div>
    </div>
</div>
<aside id="chats">
    @for ($i=1;$i<=4;$i++)
        <div class="window" id="janela_x">
            <div class="header_window"><a href="#" class="close_window">X</a><span class="name">Fulano de tal</span><span id="5" class="status on"></span></div>
            <div class="body">
                <div class="mensagens">
                    <ul>
                        @for ($n=1;$n<=2;$n++)
                        <li class="eu"><p>Este é um exemplo de mensagem que aparecera na pagina</p></li>
                        <li>
                            <div class="imgSmall"><img src="/fotos/lucas.jpg" border="0" /></div>
                            <p>Este é um exemplo de mensagem que aparecera na pagina</p>
                        </li>
                        @endfor
                    </ul>
                </div>
                <div class="send_message" id="2:1">
                    <input type="text" name="mensagem" class="msg" id="2:1" />
                </div>
            </div>
        </div>
    @endfor    
</aside>
@include('partials/footer')
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
                        console.log(data.responseText);
                        $('#jstree').html('<p>Ocorreu um erro...</p>');
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