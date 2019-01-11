<?php

namespace App;

class Robo {

    static function echoPlus($msg, $tipo = 'Sucesso') {
        switch ($tipo) {
            case 'Erro':
                echo "\033[31m [" . date('d/m/Y H:i:s') . "] " . $msg . " \033[0m" . PHP_EOL;
                break;

            case 'Alerta':
                echo "\033[34m [" . date('d/m/Y H:i:s') . "] " . $msg . " \033[0m" . PHP_EOL;
                break;

            default:
                echo "\033[32m [" . date('d/m/Y H:i:s') . "] " . $msg . " \033[0m" . PHP_EOL;
                break;
        }
    }

}
