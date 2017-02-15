<?php

namespace App\Http\Controllers;

use Mail;
use Illuminate\Http\Request;
use App\Http\Requests;

class ContactController extends Controller
{
    public function index(Request $request){

       return view('layouts.contact', ['page' => 'contact']);
    }



    public function send(Request $request){

        $params = $request->all();

        if($params['assunto'] == 'duvida'){
            $params['assunto'] = 'Dúvida';

        }elseif($params['assunto'] == 'reclamacao'){
            $params['assunto'] = 'Reclamação';

        }elseif($params['assunto'] == 'elogio'){
            $params['assunto'] = 'Elogio';
        }


        Mail::send('faleconosco_mensagem',  ['params' => $params], function ($m) use ($params) {
            $m->from('locness.dev@gmail.com', 'Portal IBA');
            $m->to('nataliabrag@gmail.com', 'Fale Conosco')->subject('Fale Conosco IBA');
            $m->bcc('fabricio.romao@gmail.com', 'Fabrício Romão')->subject('Fale Conosco IBA');
        });

        if (Mail::failures()) {
            return view('faleconosco',[
                'pagina'                => 'faleconosco',
                'associadas'            => $this->associadas(),
                'enviado'               => '<p>Ocorreu um problema no envio de sua mensagem</p><p>Por favor, tente novamente mais tarde. Obrigado !</p>'
            ]);
        }else{
            return view('faleconosco',[
                'pagina'                => 'faleconosco',
                'associadas'            => $this->associadas(),
                'enviado'               => '<p>Sua mensagem foi enviada com sucesso.</p><p>Agradecemos pelo contato  !</p>'
            ]);
        }
    }

}
