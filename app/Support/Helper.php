<?php

namespace ceu\Support;

class Helper
{

    /**
    * Retorna o tamanho de um determinado arquivo em KB, MB, GB TB, etc
    * @author Rafael Wendel Pinheiro
    * @param String $arquivo O arquivo a ser verificado
    * @return String O tamanho do arquivo (já formatado)
*/
    function tamanho_arquivo($tamanhoarquivo) {
        /* Medidas */
        $medidas = array('KB', 'MB', 'GB', 'TB');
     
        /* Se for menor que 1KB arredonda para 1KB */
        if($tamanhoarquivo < 999){
            $tamanhoarquivo = 1000;
        }
     
        for ($i = 0; $tamanhoarquivo > 999; $i++){
            $tamanhoarquivo /= 1024;
        }

        return round($tamanhoarquivo) . $medidas[$i - 1];
    }

}