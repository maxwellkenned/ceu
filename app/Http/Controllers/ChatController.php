<?php

namespace ceu\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Auth;
use ceu\Http\Models\Mensagens;


class ChatController extends Controller
{
    public function submit(Request $request){
        $mensagens = new Mensagens();
        $mensagem = $request->mensagem;
        $de = $request->de;
        $para = $request->para;
        
        if($mensagem != ''){
            $mensagens->id_de = $de;
            $mensagens->id_para = $para;
            $mensagens->mensagem = $mensagem;
            $mensagens->time = time();
            $mensagens->lido = 0;
            if($mensagens->save()){
                return 'ok';
            }else{
                return 'no';
            }
        }
        
    }
    
    public function historico(Request $request){
        $id_conversa = $request->conversacom;
        $online = (int)$request->online;
        $mensagens[] = array();
        $emotions = array(':)', ':@', '8)', ':D', ':3', ':(', ';)');
        $imgs = array(
            '<img src="emotions/nice.png" width="14"/>',
            '<img src="emotions/angry.png" width="14"/>',
            '<img src="emotions/cool.png" width="14"/>',
            '<img src="emotions/happy.png" width="14"/>',
            '<img src="emotions/ooh.png" width="14"/>',
            '<img src="emotions/sad.png" width="14"/>',
            '<img src="emotions/right.png" width="14"/>'
        );
        
        $conversa = DB::table('mensagens')->where([['id_de', $online], ['id_para', $id_conversa]])->orWhere([['id_de', $id_conversa], ['id_para', $online]])->orderBy('id', 'DESC')->limit(10)->get();
        foreach($conversa as $row){
            //$fotouser = '';
            if($online == $row->id_de){
                $janela_de = $row->id_para;
            }else if($online == $row->id_para){
                $janela_de = $row->id_de;
                // $pegaFoto = BD::table('users')->select('foto')->where('id', $row->id_de)->first()->get();
                // $fotouser = $pegaFoto->foto;
            }
            
            $msg = str_replace($emotions, $imgs, $row->mensagem);
            $mensagens[] = array(
                'id' => $row->id,
                'mensagem' => $msg,
                // 'fotoUser' => $fotouser,
                'id_de' => $row->id_de,
                'id_para' => $row->id_para,
                'janela_de' => $janela_de
            );
        }
        return json_encode($mensagens);
    }
    
    public function stream(Request $request){
        $userOnline = (int)$request->user;
        $timestamp = $request->timestamp == 0 ? time() : strip_tags(trim($request->timestamp));
        $lastid = (isset($request->lastid) && !empty($request->lastid)) ? $request->lastid : 0;
        $usersOn = array();
        $agora = date('Y-m-d H:i:s');
        $expira = date('Y-m-d H:i:s', strtotime('+1 min'));
        $upOnline = DB::table('users')->where('id', $userOnline)->update(['limite' => $expira]);
        
        $pegaOnline = DB::table('users')->where('id','!=', $userOnline)->orderBy('name', 'ASC')->get();
        
        foreach ($pegaOnline as $onlines){
            if($agora >= $onlines->limite){
                $usersOn[] = array('id' => $onlines->id, 'name' => $onlines->name, 'foto' => $onlines->foto, 'status' => 'off');
            }else{
                $usersOn[] = array('id' => $onlines->id, 'name' => $onlines->name, 'foto' => $onlines->foto, 'status' => 'on');
            }
        }
        
        
        $emotions = array(':)', ':@', '8)', ':D', ':3', ':(', ';)');
        $imgs = array(
            '<img src="emotions/nice.png" width="14"/>',
            '<img src="emotions/angry.png" width="14"/>',
            '<img src="emotions/cool.png" width="14"/>',
            '<img src="emotions/happy.png" width="14"/>',
            '<img src="emotions/ooh.png" width="14"/>',
            '<img src="emotions/sad.png" width="14"/>',
            '<img src="emotions/right.png" width="14"/>'
        );
        $verifica = new Mensagens();
        if(empty($timestamp)){
            die(json_encode(array('status'=>'erro')));
        }
        
        $tempoGasto = 0;
        $lastidQuery = '';
        
        // if(!empty($lastid)){
        //     $lastidQuery = " AND 'id' > ". $lastid;
        // }
        
        if($request->timestamp == 0){
            $verifica = DB::table('mensagens')->where('lido','=' ,0)->orderBy('id', 'DESC')->get();
        }else{
            $verifica = DB::table('mensagens')->where([['time','>=', $timestamp], ['id','>', $lastid], ['lido','=',0]])->orderBy('id', 'DESC')->get();
        }
        $resultados = $verifica->count();
        if($resultados <= 0){
            while($resultados <= 0){
                if($resultados <= 0){
                    //durar 30 segundos verificando
                    if($tempoGasto >= 30){
                        die(json_encode(array('status'=>'vazio', 'lastid' => 0, 'timestamp' => time(), 'users' => $usersOn)));
                        exit;
                    }
                    
                    //descansar o script por um segundo
                    sleep(1);
                    $verifica = DB::table('mensagens')->where([['time','>=', $timestamp], ['id','>', $lastid], ['lido','=', 0]])->orderBy('id', 'DESC')->get();
                    $resultados = $verifica->count();
                    $tempoGasto += 1;
                }
            }
        }
        
        $novasMensagens = array();
        $janela_de = 0;
        if($resultados >= 1){
            foreach($verifica as $row){
                //$fotouser = '';
                if($userOnline == $row->id_de){
                    $janela_de = $row->id_para;
                }else if($userOnline == $row->id_para){
                    $janela_de = $row->id_de;
                    // $pegaFoto = BD::table('users')->select('foto')->where('id', $row->id_de)->first()->get();
                    // $fotouser = $pegaFoto->foto;
                }
                
                $msg = str_replace($emotions, $imgs, $row->mensagem);
                $novasMensagens[] = array(
                    'id' => $row->id,
                    'mensagem' => $msg,
                    // 'fotoUser' => $fotouser,
                    'id_de' => $row->id_de,
                    'id_para' => $row->id_para,
                    'janela_de' => $janela_de
                );
            }
        }
        
        $ultimaMsg = end($novasMensagens);
        $ultimoId = $ultimaMsg['id'];
        die(json_encode(array('status' => 'resultados', 'timestamp' => time(), 'lastid' => $ultimoId, 'dados' => $novasMensagens, 'users' => $usersOn)));
    }
    
    public function lermsg(Request $request){
        $online = (int)$request->online;
        $user = (int)$request->user;
        
        $upd = DB::table('mensagens')->where([['id_de', $user],['id_para', $online]])->update(['lido' => 1]);
    }
}
