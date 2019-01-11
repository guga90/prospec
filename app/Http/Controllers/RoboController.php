<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;
use App\Grupo;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class RoboController extends Controller {

    public function __construct() {
        
    }

    public function index() {

        die('OK!');
    }

    public function sendemail() {

        /*  $servidor = $this->getServidorEmail();

          $sale = $this->getCampanhaEmail('E');
          $sale->email_cc = $config->email_cc; */

        $mail = new PHPMailer(true); // Passing `true` enables exceptions
        try {

            // Configuração dos dados do servidor e tipo de conexão (Estes dados você obtem com seu host)
            $mail->IsSMTP(); // Define que a mensagem será SMTP
            $mail->Host = "cloud14.rgs.net.br"; // Endereço do servidor SMTP
            $mail->Port = "587"; // Porta do servidor SMTP
            $mail->SMTPAuth = true; // Autenticação (True: Se o email será autenticado ou False: se o Email não será autenticado)
            $mail->Username = 'naoresponda@gustavomendanha.com.br'; // Usuário do servidor SMTP
            $mail->Password = 'i8o9p0'; // A Senha do email indicado acima
            // Remetente (Identificação que será mostrada para quem receber o email)
            $mail->From = 'gustavomendanha90@gmail.com';
            $mail->FromName = 'Gustavo';

            // Destinatário
            $mail->AddAddress('gustavomendanha90@gmail.com', 'Nome do Destinatário');

            // Opcional (Se quiser enviar cópia do email)
            // $mail->AddCC('copia@dominio.com.br', 'Copia');
            // $mail->AddBCC('CopiaOculta@dominio.com.br', 'Copia Oculta');
            // Define tipo de Mensagem que vai ser enviado
            $mail->IsHTML(true); // Define que o e-mail será enviado como HTML
            // Assunto e Mensagem do email
            $mail->Subject = "Contato via site www.gustavomendanha.com.br";
            $mail->Body = "<strong>Nome: </strong>" . 'Gustavo' .
                    "<br><strong>E-mail: </strong>" . 'gustavomendanha90@gmail.com' .
                    "<br><strong>Mensagem: </strong>" . 'Cara!';


            $mail->send();
            echo 'Envidado com sucesso';
        } catch (Exception $e) {
            echo 'Mensagem não enviada. Mailer Error: ', $mail->ErrorInfo;
        }
    }

    public function sendsms() {

        die('sendsms!');
    }

    public function getServidorEmail() {

        $server = DB::table('email_servers')->select([
                    '*',
                ])
                ->where('email_servers.status', '=', 'A')
                ->first();

        return $server;
    }

    public function getCampanha($tipo) {

        $sale = DB::table('sales')->select([
                    'sales.id',
                    'sales.transaction',
                    'sales.amount',
                    'sales.price',
                    'sales.total',
                    'sales.iof',
                    'sales.deliver_val',
                    'sales.id_address',
                    'sales.transaction',
                    'sales.type_pgto',
                    'sales.status_pagseguro',
                    'users.email',
                    DB::raw("DATE_FORMAT(sales.date_sale, '%d/%m/%Y %H:%i') as date_sale"),
                    'users.name as name_user',
                    'types.name as name_type',
                    'coins.name as name_coin',
                    'coins.symbol',
                    'addresses.name as name_address',
                    'cep as cep_address',
                    'address as address_address',
                    'complement as complement_address',
                    'sector as sector_address',
                    'state as state_address',
                    'city as city_address',
                ])
                ->join('users', 'users.id', '=', 'sales.id_user')
                ->join('types', 'types.id', '=', 'sales.id_type')
                ->join('coins', 'coins.id', '=', 'sales.id_coin')
                ->leftJoin('addresses', 'addresses.id', '=', 'sales.id_address')
                ->where(DB::raw("MD5(sales.id)"), '=', $idSale)
                ->first();

        return $sale;
    }

}
