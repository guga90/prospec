<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;
use App\Grupo;
use App\SmsEnvios;
use App\EmailCampanha;
use App\SmsCampanha;
use App\EmailEnvios;
use App\Robo;
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

        $servidor = $this->getServidorEmail();

        if (!empty($servidor)) {

            $campanha = $this->getCampanhaEmail();

            if (!empty($campanha)) {

                if ($campanha->status_campanha == 'A') {
                    EmailCampanha::find($campanha->id_campanha)->update(array('status' => 'E'));
                    Robo::echoPlus('Inicia a execução da campanha.');
                }

                $clientsCampanhas = $this->getClientesCampanhaEmail($campanha->id_campanha);

                 if (count($clientsCampanhas) > 0) {

                    foreach ($clientsCampanhas as $clientsCampanha) {

                        try {

                            $retorno = $this->executarEmail($servidor, $campanha, $clientsCampanha);

                            EmailEnvios::create(
                                    array('id_client' => $clientsCampanha->id_client,
                                        'id_email_campanha' => $campanha->id_campanha,
                                        'log' => $retorno['msg'],
                                        'status' => $retorno['tipo'])
                            );

                            Robo::echoPlus('E-mail enviado com sucesso');
                        } catch (Exception $e) {
                            Robo::echoPlus('Erro ao salvar log.' . $e->getMessage());
                        }
                    }
                } else {
                    EmailCampanha::find($campanha->id_campanha)->update(array('status' => 'F'));
                    Robo::echoPlus('Campanha finalizada.');
                }
            } else {
                Robo::echoPlus('Nenhuma campanha encontrada.');
            }
        } else {
            Robo::echoPlus('Nenhum servidor de E-mail encontrado.');
        }
    }

    public function executarEmail($servidor, $campanha, $clientsCampanha) {

        $mail = new PHPMailer(true); // Passing `true` enables exceptions

        try {

            $mail->SMTPOptions = array(
                'ssl' => array(
                    'verify_peer' => false,
                    'verify_peer_name' => false,
                    'allow_self_signed' => true
                )
            );

// Configuração dos dados do servidor e tipo de conexão (Estes dados você obtem com seu host)
            $mail->IsSMTP(); // Define que a mensagem será SMTP   
            $mail->CharSet = 'utf-8';
            $mail->Host = $servidor->host; // Endereço do servidor SMTP
            $mail->Port = $servidor->porta; // Porta do servidor SMTP
            $mail->SMTPSecure = env('MAIL_ENCRYPTION');
            $mail->SMTPAuth = true; // Autenticação (True: Se o email será autenticado ou False: se o Email não será autenticado)
            $mail->Username = $servidor->user; // Usuário do servidor SMTP
            $mail->Password = $servidor->password; // A Senha do email indicado acima
//
            // Remetente (Identificação que será mostrada para quem receber o email)
            $mail->From = $servidor->user;
            $mail->FromName = 'Gustavo';

// Destinatário
            $mail->AddAddress($clientsCampanha->email_client, $clientsCampanha->name_client);

// Opcional (Se quiser enviar cópia do email)
// $mail->AddCC('copia@dominio.com.br', 'Copia');
// $mail->AddBCC('CopiaOculta@dominio.com.br', 'Copia Oculta');
// Define tipo de Mensagem que vai ser enviado
            $mail->IsHTML(true); // Define que o e-mail será enviado como HTML
// Assunto e Mensagem do email

            $mail->Subject = $campanha->name_campanha;
            $mail->Body = $campanha->msg_campanha;

            $mail->send();

            return array('tipo' => 'S', 'msg' => 'Mensagem enviada.');
        } catch (Exception $e) {
            return array('tipo' => 'E', 'msg' => ('Mensagem não enviada. Mailer Error: ' . $mail->ErrorInfo));
        }
    }

    public function getServidorEmail() {

        $server = DB::table('email_servers')->select([
                    '*',
                ])
                ->where('email_servers.status', '=', 'A')
                ->first();

        return $server;
    }

    public function getCampanhaEmail() {

        $campanha = DB::table('email_campanhas')->select([
                    'email_campanhas.id as id_campanha',
                    'email_campanhas.name as name_campanha',
                    'email_campanhas.msg as msg_campanha',
                    'email_campanhas.status as status_campanha',
                ])->whereIn('email_campanhas.status', ['E', 'A'])
                ->orderBy('email_campanhas.created_at', 'desc')
                ->limit(1)
                ->first();

        return $campanha;
    }

    public function getClientesCampanhaEmail($id_campanha) {

        $campanha = DB::table('clients')->select([
                            'clients.id as id_client',
                            'clients.name as name_client',
                            'clients.email as email_client',
                            'clients.telefone as telefone_client'
                        ])
                        ->join('clientsgrupos', 'clientsgrupos.id_client', '=', 'clients.id')
                        ->join('email_campanha_grupos', 'email_campanha_grupos.id_grupo', '=', 'clientsgrupos.id_grupo')
                        ->where('email_campanha_grupos.id_email_campanha', '=', $id_campanha)
                        ->whereRaw(DB::raw('NOT EXISTS (SELECT id FROM email_envios '
                                        . 'WHERE email_envios.id_client = clients.id '
                                        . 'AND email_envios.id_email_campanha = email_campanha_grupos.id_email_campanha)')
                        )->limit(1)->get();

        return $campanha;
    }

    #############SMS###############

    public function sendsms() {

        $servidor = $this->getServidorSms();

        if (!empty($servidor)) {

            $campanha = $this->getCampanhaSms();
  
            if (!empty($campanha)) {

                if ($campanha->status_campanha == 'A') {
                    SmsCampanha::find($campanha->id_campanha)->update(array('status' => 'E'));
                    Robo::echoPlus('Inicia a execução da campanha.');
                }

                $clientsCampanhas = $this->getClientesCampanhaSms($campanha->id_campanha);
                          
                if (count($clientsCampanhas) > 0) {

                    foreach ($clientsCampanhas as $clientsCampanha) {

                        try {

                            $retorno = $this->executarSms($servidor, $campanha, $clientsCampanha);

                            SmsEnvios::create(
                                    array('id_client' => $clientsCampanha->id_client,
                                        'id_sms_campanha' => $campanha->id_campanha,
                                        'log' => $retorno['msg'],
                                        'status' => $retorno['tipo'])
                            );

                            Robo::echoPlus('Sms enviado com sucesso');
                        } catch (Exception $e) {
                            Robo::echoPlus('Erro ao salvar log.' . $e->getMessage());
                        }
                    }
                } else {
                    SmsCampanha::find($campanha->id_campanha)->update(array('status' => 'F'));
                    Robo::echoPlus('Campanha finalizada.');
                }
            } else {
                Robo::echoPlus('Nenhuma campanha encontrada.');
            }
        } else {
            Robo::echoPlus('Nenhum servidor de Sms encontrado.');
        }
    }

    public function getServidorSms() {

        $server = DB::table('sms_servers')->select([
                    '*',
                ])
                ->where('sms_servers.status', '=', 'A')
                ->first();

        return $server;
    }

    public function getCampanhaSms() {

        $campanha = DB::table('sms_campanhas')->select([
                    'sms_campanhas.id as id_campanha',
                    'sms_campanhas.name as name_campanha',
                    'sms_campanhas.msg as msg_campanha',
                    'sms_campanhas.status as status_campanha',
                ])->whereIn('sms_campanhas.status', ['E', 'A'])
                ->orderBy('sms_campanhas.created_at', 'desc')
                ->limit(1)
                ->first();

        return $campanha;
    }

    public function getClientesCampanhaSms($id_campanha) {

        $campanha = DB::table('clients')->select([
                            'clients.id as id_client',
                            'clients.name as name_client',
                            'clients.email as email_client',
                            'clients.telefone as telefone_client'
                        ])
                        ->join('clientsgrupos', 'clientsgrupos.id_client', '=', 'clients.id')
                        ->join('sms_campanha_grupos', 'sms_campanha_grupos.id_grupo', '=', 'clientsgrupos.id_grupo')
                        ->where('sms_campanha_grupos.id_sms_campanha', '=', $id_campanha)
                        ->whereRaw(DB::raw('NOT EXISTS (SELECT id FROM sms_envios '
                                        . 'WHERE sms_envios.id_client = clients.id '
                                        . 'AND sms_envios.id_sms_campanha = sms_campanha_grupos.id_sms_campanha)')
                        )->limit(1)->get();

        return $campanha;
    }

    public function executarSms($servidor, $campanha, $clientsCampanha) {

        try {

            if (empty($clientsCampanha->telefone_client)) {
                throw new Exception('Sem numero de telefone.');
            }

            $remover = array("à" => "a", "á" => "a", "ã" => "a", "â" => "a", "é" => "e", "ê" => "e", "ì" => "i", "í" => "i", "ó" => "o", "õ" => "o", "ô" => "o", "ú" => "u", "ü" => "u", "ç" => "c", "À" => "A", "Á" => "A", "Ã" => "A", "Â" => "A", "É" => "E", "Ê" => "E", "Í" => "I", "Ó" => "O", "Õ" => "O", "Ô" => "O", "Ù" => "U", "Ú" => "U", "Ü" => "U", "Ç" => "C");
            $msg = strtr($campanha->msg_campanha, $remover);

            $nTelefone = str_replace(array(' ', '-', '(', ')'), '', $clientsCampanha->telefone_client);

            $url = $servidor->host;

            /* $_GET Parameters to Send */
            $params = array('account' => $servidor->user,
                'code' => $servidor->password,
                'to' => ('55' . $nTelefone),
                'dispatch' => 'send',
                'msg' => strip_tags($msg));

            /* Update URL to container Query String of Paramaters */
            $url .= '?' . http_build_query($params);

            /* cURL Resource */
            $ch = curl_init();
            /* Set URL */
            curl_setopt($ch, CURLOPT_URL, $url);
            /* Tell cURL to return the output */
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            /* Tell cURL NOT to return the headers */
            curl_setopt($ch, CURLOPT_HEADER, false);
            /* Execute cURL, Return Data */
            $retorno = curl_exec($ch);
            /* Check HTTP Code */
            $status = curl_getinfo($ch, CURLINFO_HTTP_CODE);
            /* Close cURL Resource */
            curl_close($ch);

            if ($retorno != '000 - Message sent') {
                throw new Exception('O servidor de SMS retornou: ' . $retorno);
            }

            /* 200 Response! */
            if ($status != 200) {
                throw new Exception('Não foi possivel comunicar com endereco: ' . $servidor->host);
            }

            return array('tipo' => 'S', 'msg' => 'Mensagem enviada.');
        } catch (Exception $e) {
            return array('tipo' => 'E', 'msg' => ('Mensagem não enviada. Mailer Error: ' . $e->getMessage()));
        }
    }

}
