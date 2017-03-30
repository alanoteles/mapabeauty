<?php

namespace App\Http\Controllers;

use App\Product;
use Illuminate\Http\Request;
use DateTime;

use App\Http\Requests;

class PurchaseController extends Controller
{

    /**
     * Register a purchase on payer
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function registerPagseguro(Request $request)
    {

        $params = $request->all();

        $product = Product::find($params['product_id']);


        // $data['token'] 			= '08D2C436C35A4A458199F8A353CE4425' ; //-- Production
        $data['token'] 				= 'EF6B91D4F15140D99FD4E32DB4D1C82A' ; //-- Sandbox
        $data['email'] 				= 'maysafranca13@gmail.com';
        $data['currency'] 			= 'BRL';
        $data['itemId1'] 			= (string)$params['product_id'];
        $data['itemQuantity1'] 		= '1';
        $data['itemDescription1'] 	= 'Mapabeauty - ' . (string)$product->description;
        $data['itemAmount1'] 		= (string)number_format($product->value,2,'.','');


        // $url = 'https://ws.pagseguro.uol.com.br/v2/checkout';
        $url = 'https://ws.sandbox.pagseguro.uol.com.br/v2/checkout';

        $data = http_build_query($data);

        $curl = curl_init($url);

        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);

        $xml = curl_exec($curl);

        curl_close($curl);

        $xml = simplexml_load_string($xml);
        echo $xml -> code;//die;
    }



    public function returnedPagseguro($tc)
    {

        //$params = $request->all();
        
//        echo '<pre>';
//        print_r($tc);die;

        $transactionCode = $tc;

        if(empty($transactionCode)){
            return redirect('home');
        }


        // $token 	= '08D2C436C35A4A458199F8A353CE4425' ; //-- Production
        $token 		= 'EF6B91D4F15140D99FD4E32DB4D1C82A' ; //-- Sandbox
        $email      = 'maysafranca13@gmail.com';

        //$transactionCode = 'CE0A0E03E79F462DB78D52013645331F';
        // $url = 'https://ws.pagseguro.uol.com.br/v2/transactions/' . $transactionCode . '?email=' . $email . '&token=' . $token;
        $url = 'https://ws.sandbox.pagseguro.uol.com.br/v2/transactions/' . $transactionCode . '?email=' . $email . '&token=' . $token;

        $curl = curl_init($url);

        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);

        $xml = curl_exec($curl);

        curl_close($curl);


        $xml = simplexml_load_string($xml);
//echo '<pre>';print_r($xml);die;
        //-- Se ocorrer algum erro na transação, redireciona para a home passando o codigo e msg de erro.
        if(!empty($xml -> error -> code)){
            $codigo_erro 	= $xml -> error -> code ;
            $msg_erro		= $xml -> error -> message ;

            $message = ['msg' => $msg_erro, 'type' => 'error'];
            return redirect('profile')->with($message);

        }else{

            //-- Recupera os dados da transação que serão utilizados no email, na página e na gravação da compra.
            $item_id 			= (string)$xml -> items -> item -> id;
            $item_description 	= (string)$xml -> items -> item -> description;
            $valor				= (string)$xml -> grossAmount ;
            $email 				= (string)$xml -> sender -> email;
            $nome				= (string)$xml -> sender -> name;
            $data_transacao		= (string)$xml -> date ;
            $status				= (string)$xml -> status ;

            $time_other_format = $data_transacao;
            $dt = new DateTime($time_other_format);
            //echo $dt->format('d/m/Y H:i:s');die;

            $msg = 'Prezado ' . $nome ;
            switch ($status) {
                case '1':
                    $msg .= ', sua compra foi registrada com sucesso e estamos aguardando o processamento.';
                    break;

                case '3':
                    $msg .= ', seu pagamento foi registrada com sucesso. Bem vindo ao nosso catálogo de profissionais !';
                    break;

                case '6':
                    $status_descricao = 'Devolvida';
                    break;
                case '7':
                    $status_descricao = 'Cancelada';
                    break;
                default:
                    $status_descricao = 'Indefinido';
                    break;
            }

            $message = ['msg' => $msg, 'type' => 'success'];
            return redirect('profile/1')->with($message);
        }



    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        echo 'teste';die;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
