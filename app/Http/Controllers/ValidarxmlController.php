<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;
use App\Kit;
use App\Especialidade;
use App\Procedimento;
use App\Kitmatmed;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class ValidarxmlController extends Controller {

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct() {
        // $this->middleware('auth');
    }

    public function index() {
        return view('validarxml.data', ['xml' => '', 'erros' => array()]);
    }

    public function gerarHash($dom) {

        $dom->formatOutput = FALSE;
        $xmlFormat = $dom->saveXml();

        $hash = $dom->getElementsByTagName('hash')[0]->nodeValue;
        $xmlFormatHash = preg_replace("/\<[^\>]*\>/", "", $xmlFormat); //Expresssão regular pare remover as tag's.
        $xmlFormatHash = str_replace($hash, "", $xmlFormatHash);  //Retirando os espaços vazios.(carriage return)
        $xmlFormatHash = str_replace("\r", "", $xmlFormatHash);  //Retirando os espaços vazios.(carriage return)
        $xmlFormatHash = str_replace("\n", "", $xmlFormatHash);  //Retirando os espaços vazios.(carriage return)
        $hash = (md5($xmlFormatHash));    //Criptografando os dados com codificados MD5.


        return $hash;
    }

    public function validar(Request $request) {

        $data = $request->all();

        // Enable user error handling
        libxml_use_internal_errors(true);

        $dataXml = $data['xml'];

        if (empty($dataXml) && $request->hasFile('arquivo')) {
            $image = $request->file('arquivo');
            $dataXml = file_get_contents($image->getRealPath());
        }

        $xml = new \DOMDocument();
        $xml->preserveWhiteSpace = FALSE;
        $xml->loadXML($dataXml);

        try {
            $hash = $this->gerarHash($xml);
            $xml->getElementsByTagName('hash')[0]->nodeValue = $hash;
            $xml->formatOutput = TRUE;
            $xmlFormat = $xml->saveXml();
        } catch (\Exception $e) {
            $xmlFormat = $data['xml'];
            $hash = '';
        }

        $erros = array();
        if (!$xml->schemaValidate('padraotiss_comunicacao_0' . $data['versao'] . '/tissV' . $data['versao'] . '.xsd')) {
            $erros = $this->libxml_display_errors();
        }

        $arquivoNome = $hash . '.xml';

        return view('validarxml.data', ['xml' => $xmlFormat, 'erros' => $erros, 'hash' => $hash, 'versao' => $data['versao'], 'arquivo_nome' => $arquivoNome]);
    }

    public function libxml_display_error($error) {
        $erros = array();
        switch ($error->level) {
            case LIBXML_ERR_WARNING:
                $erros['tipo'] = "Warning: $error->code";
                break;
            case LIBXML_ERR_ERROR:
                $erros['tipo'] = "Error: $error->code";
                break;
            case LIBXML_ERR_FATAL:
                $erros['tipo'] = "Fatal Error: $error->code";
                break;
        }
        $erros['msg'] = trim($error->message);
        $erros['arquivo'] = $error->file;
        $erros['linha'] = $error->line;

        return $erros;
    }

    public function libxml_display_errors() {
        $errors = libxml_get_errors();
        $erros = array();
        foreach ($errors as $error) {
            $erros[] = $this->libxml_display_error($error);
        }
        libxml_clear_errors();

        return $erros;
    }

    public function baixarxml(Request $request) {

        $data = $request->all();

        header('Content-type: text/xml');
        header('Content-Disposition: attachment; filename="' . $data['arquivo_nome'] . '"');

        echo $data['xml'];
    }

    public function baixarzip(Request $request) {

        $data = $request->all();

        $zipname = str_replace('xml', 'zip', $data['arquivo_nome']);

        $zip = new \ZipArchive;
        $zip->open($zipname, \ZipArchive::CREATE | \ZipArchive::OVERWRITE);
        $zip->addFromString($data['arquivo_nome'], $data['xml']);
        $zip->close();

        //Then download the zipped file.
        header('Content-Type: application/zip');
        header('Content-disposition: attachment; filename=' . $zipname);
        header('Content-Length: ' . filesize($zipname));
        readfile($zipname);
        unlink($zipname);
    }

}
