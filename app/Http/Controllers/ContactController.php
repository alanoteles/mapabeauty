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

        if($params['subject'] == 'D'){
            $params['subject'] = 'Dúvida';

        }elseif($params['subject'] == 'R'){
            $params['subject'] = 'Reclamação';

        }elseif($params['subject'] == 'E'){
            $params['subject'] = 'Elogio';
        }


        Mail::send('layouts.contact_message',  ['params' => $params], function ($m) use ($params) {
            $m->from('faleconosco@mapabeauty.com.br', 'Mapa Beauty');
            $m->to('faleconosco@mapabeauty.com.br', 'Fale Conosco')->subject('Fale Conosco Mapa Beauty');
            $m->bcc('alanoteles@gmail.com', 'Alano Teles')->subject('Fale Conosco Mapa Beauty');
        });

        if (Mail::failures()) {
            return view('layouts.contact',[
                'pagina'                => 'contact',
                'enviado'               => '<p>Ocorreu um problema no envio de sua mensagem</p><p>Por favor, tente novamente mais tarde. Obrigado !</p>'
            ]);
        }else{
            return view('layouts.contact',[
                'pagina'                => 'contact',
                'enviado'               => '<p>Sua mensagem foi enviada com sucesso.</p><p>Agradecemos pelo contato  !</p>'
            ]);
        }
    }

}
