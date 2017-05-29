$(function(){
    var clicou = new Array();
    
    function in_array(valor, array){
        for(var i=0; i<array.length;i++){
            if(array[i] == valor){
                return true;
            }
        }
        return false;
    }
    
    function add_janela(id, nome, status){
        var janelas = Number($('#chats .window').length);
        var pixels = (270+5)*janelas;
        var style = 'float:none; position:absolute; bottom:0; left:'+ pixels+'px;';
        
        var splitDados = id.split(':');
        var id_user = Number(splitDados[1]);
        
        
        var janela = '<div class="window" id="janela_'+id_user+'" style="'+style+'">';
            janela += '<div class="header_window"><a href="" class="close_window">X</a><span class="name">'+nome+'</span><span id="'+id_user+'" class="'+status+'"></span></div>';
            janela += '<div class="body"><div class="mensagens"><ul></ul></div>';
            janela += '<div class="send_message" id="'+id+'"><input type="text" name="mensagem" class="msg" id="'+id+'" /></div></div></div>';
        if(janelas <= 3){
            $('#chats').append(janela);
        }
    }
    
    function retorna_historico(id_conversa){
        var token = $("meta[name='csrf-token'").attr('content');
            $.post('/historicomsg', { _token: token, conversacom: id_conversa, online: userOnline}, function(retorno){
                    $.each(retorno, function(i, msg){
                        if($('#janela_'+msg.janela_de).length > 0){
                            if(userOnline == msg.id_de){
                                $('#janela_'+msg.janela_de+' .mensagens ul').append('<li id="'+msg.id+'" class="eu"><p>'+msg.mensagem+'</p></li>');
                            }else{
                                $('#janela_'+msg.janela_de+' .mensagens ul').append('<li id="'+msg.id+'"><div class="imgSmall"><img src="/fotos/default.jpg" border="0" /></div><p>'+msg.mensagem+'</p></li>');
                            }
                        }
                    });
                    [].reverse.call($('#janela_'+id_conversa+' .mensagens li')).appendTo($('#janela_'+id_conversa+' .mensagens ul'));
                    
                    $('#janela_'+id_conversa+' .mensagens').animate({scrollTop: 230}, 500);

                }, 'json');
    }
    
    $('body').on('click', '#users_online a', function() {
        var id = $(this).attr('id');
        $(this).removeClass('comecar');
        
        var status = $(this).next().attr('class');
        var splitIds = id.split(':');
        var idJanela = Number(splitIds[1]);
        
      
        if($('#janela_'+idJanela).length == 0){
            var nome = $(this).text();
            add_janela(id, nome, status);
            retorna_historico(idJanela);
            $('#janela_'+idJanela+' .send_message .msg').focus();
        }else{
            $(this).removeClass('comecar');
        }
        return false;
    });
    
    $('body').on('click', '.header_window', function(){
       var next = $(this).next();
       next.toggle(100);
       return false;
    });
    
    $('body').on('click', '.close_window', function(){
        var parent = $(this).parent().parent()
        var idParent = parent.attr('id');
        var splitParent = idParent.split('_');
        var idJanelaFechada = Number(splitParent[1]);
        
        var contagem = Number($('.window').length) -1;
        var indice = Number($('.close_window').index(this));
        var restamAfrente = contagem - indice;
        
        for(var i=1; i<= restamAfrente; i++){
            $('.window:eq('+(indice+i)+')').animate({left:"-=275"}, 200);
        }
        
        parent.remove();
        $('#users_online li#'+idJanelaFechada+'a').addClass('comecar');
        return false;
    });
    
    $('body').on('keyup', '.msg', function(e) {
        if(e.which == 13){
            var msg = $(this);
            var texto = $(this).val();
            var id = $(this).attr('id');
            var split = id.split(':');
            var para = Number(split[1]);
            var de = Number(split[0]);
            var token = $("meta[name='csrf-token'").attr('content');
            $.post('/submitmsg', { _token: token, mensagem: texto, de: de, para: para}, function(retorno){
                    if(retorno == 'ok'){
                       msg.val('');
                    }else{
                        alert('Ocorreu um erro ao enviar a mensagem');
                        console.log(retorno);
                    }
                });
        }
    });
    
    verifica(0,0, userOnline);
    
    
    $('body').on('click', ' .mensagens', function() {
       var janela = $(this).parent().parent();
       var token = $("meta[name='csrf-token'").attr('content');
       var janelaId = janela.attr('id');
       var idConversa = janelaId.split('_');
        idConversa = Number(idConversa[1]);
        
        $.ajax({
           url: 'lermsg',
           type: 'post',
           data: {_token: token, ler: 'sim', online: userOnline, user: idConversa},
           success: function(retorno){
               
           }
        });
    });
    
    function verifica(timestamp, lastid, user){
        var t;
        $.ajax({
           url: '/stream',
           type: 'GET',
           data: 'timestamp='+timestamp+'&lastid='+lastid+'&user='+user,
           dataType: 'json',
           success: function(retorno){
                        clearInterval(t);
                        if(retorno.status == 'resultados' || retorno.status == 'vazio'){
                            t = setTimeout(function(){
                            verifica(retorno.timestamp, retorno.lastid, userOnline);
                        }, 1000);
                        
                        if(retorno.status == 'resultados'){
                            $.each(retorno.dados, function(i, msg){
                                if(msg.id_para == userOnline){
                                    jQuery.playSound('/sound/effect');
                                
                                if($('#janela_'+msg.janela_de).length == 0){
                                    $('#users_online #'+msg.janela_de+' .comecar').click();
                                    clicou.push(msg.janela_de);
                                }
                                    
                                }
                                if(!in_array(msg.janela_de, clicou)){
                                    if($('.mensagens ul li#'+msg.id).length == 0 && msg.janela_de > 0){
                                        if(userOnline == msg.id_de){
                                            $('#janela_'+msg.janela_de+' .mensagens ul').append('<li id="'+msg.id+'" class="eu"><p>'+msg.mensagem+'</p></li>');
                                        }else{
                                            $('#janela_'+msg.janela_de+' .mensagens ul').append('<li id="'+msg.id+'"><div class="imgSmall"><img src="/fotos/default.jpg" border="0" /></div><p>'+msg.mensagem+'</p></li>');
                                        }
                                    }
                                }
                            });
                        $('.mensagens').animate({scrollTop: 230}, 500);
                        console.log(clicou);
                        }
                        clicou = [];
                        $('#users_online ul').html('');
                        $.each(retorno.users, function(i, user) {
                            var incluir = '<li id="'+user.id+'"><div class="imgSmall"><img src="fotos/default.jpg" border="0" /></div>';
                                incluir += '<a href="" id="'+userOnline+':'+user.id+'" class="comecar">'+user.name+'</a>';
                                incluir += '<span id="'+user.id+'" class="status '+user.status+'"></span>';
                            $('span#'+user.id).attr('class', 'status '+user.status);
                            $('#users_online ul').append(incluir);
                        });
                        
                    }else if(retorno.status == 'erro'){
                        alert('Ficamos confusos, atualize a página.');
                    }
           },
           error: function(){
               clearInterval(t);
               t=setInterval(function(){
                    verifica(retorno.timestamp, retorno.lastid, userOnline);
               }, 15000);
           }
        });
    }
    
});