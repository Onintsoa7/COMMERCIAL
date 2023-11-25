<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;
use PDF;
class MaheryController extends Controller
{
    //

    public function convertirEnLettres($nombre)
{
    $unites = ['', 'Un', 'Deux', 'Trois', 'Quatre', 'Cinq', 'Six', 'Sept', 'Huit', 'Neuf'];
    $dizaines = ['', 'Dix', 'Vingt', 'Trente', 'Quarante', 'Cinquante', 'Soixante', 'Soixante', 'Quatre-Vingt', 'Quatre-Vingt'];

    $nombre = (int)$nombre;

    if ($nombre == 0) {
        return 'Zéro';
    }

    if ($nombre <= 9) {
        return $unites[$nombre];
    }

    if ($nombre <= 99) {
        $dizaine = (int)($nombre / 10);
        $reste = $nombre % 10;

        if ($dizaine == 1 && $reste == 0) {
            return 'Dix';
        } elseif ($dizaine == 1) {
            return 'Dix-' . $unites[$reste];
        } elseif ($dizaine == 7 || $dizaine == 9) {
            return $dizaines[$dizaine - 1] . '-' . ($reste + 10);
        } else {
            return $dizaines[$dizaine - 1] . '-' . $unites[$reste];
        }
    }

    if ($nombre <= 999) {
        $centaine = (int)($nombre / 100);
        $reste = $nombre % 100;

        if ($centaine == 1) {
            $prefixe = 'Cent';
        } else {
            $prefixe = $unites[$centaine] . '-Cent';
        }

        return $prefixe . ' ' . $this->convertirEnLettres($reste);
    }

    if ($nombre <= 9999) {
        $millier = (int)($nombre / 1000);
        $reste = $nombre % 1000;

        if ($millier == 1) {
            $prefixe = 'Mille';
        } else {
            $prefixe = $this->convertirEnLettres($millier) . ' Mille';
        }

        return $prefixe . ' ' . $this->convertirEnLettres($reste);
    }

    if ($nombre <= 999999) {
        $mille = (int)($nombre / 1000);
        $reste = $nombre % 1000;

        if ($mille == 1) {
            $prefixe = 'Mille';
        } else {
            $prefixe = $this->convertirEnLettres($mille) . ' Mille';
        }

        return $prefixe . ' ' . $this->convertirEnLettres($reste);
    }

    if ($nombre <= 9999999) {
        $million = (int)($nombre / 1000000);
        $reste = $nombre % 1000000;

        if ($million == 1) {
            $prefixe = 'Un Million';
        } else {
            $prefixe = $this->convertirEnLettres($million) . ' Millions';
        }

        return $prefixe . ' ' . $this->convertirEnLettres($reste);
    }

    if ($nombre <= 99999999) {
        $million = (int)($nombre / 1000000);
        $reste = $nombre % 1000000;

        if ($million == 1) {
            $prefixe = 'Un Million';
        } else {
            $prefixe = convertirEnLettres($million) . ' Millions';
        }

        return $prefixe . ' ' . $this->convertirEnLettres($reste);
    }

    // return 'Nombre trop grand';
}

    public function voir_proforma($proforma)
    {

        return view('proforma');
    }

    public function get_bdc()
    {
       return view('bdc');
    }

    public function generatePDF()
    {
        $data = [];
        $data['article'] ='Stylo';
        $data['quantite'] = 5;
        $data['montant_l'] = $this->convertirEnLettres(7360);
        $dt = [];
        $dt['data'] = $data;

        // $pdf = PDF::loadView('mymail',$dt);
        $pdf = PDF::loadView('bdc',$dt);
        return $pdf->download('test.pdf');
    }

    public function generate_number_bdc()
    {

        $date = today();
        $yyyy = $date->year;
        $mm = $date->month;
        $dd = $date->day;

        $s_date = strval($yyyy).strval($mm).strval($dd);
        $res = DB::table('bon_de_commande')
        ->where('numero','like',$s_date."%")
        ->get();

        $nb = count($res)+1;
        if ($nb<10) {
            $numero = $s_date.'00'.strval($nb);
        }elseif ($nb>=10 && $nb<100) {
            $numero = $s_date.'0'.strval($nb);
        }
    
        $number = 1;
        $word = trans_choice('messages.number_to_word', $number, ['number' => $number]);

        echo $word;

        return response()->json($word, 200);
    }
    public function generate_bdc(Request $req)
    {
        
    }

    public function validate_bdc(Request $req)
    {

        $id_bdc = $req->id_bdc;

        $data = [
            'fk_bdc' =>$id_bdc,
            'date_validation'=>'now()'
        ];
        DB::table('bdc_valide')->insert($data);
    }


    


    public function get_proforma(Request $req)
    {
        $date = Carbon::parse($req->date_fin);
        $newDate = Carbon::parse($req->date_fin)->copy()->subDays(6);


        // $date->addDays(6);
        $result = DB::table('proforma_view')
        // ->where('date_proforma','>=',$newDate)
        // ->where('date_proforma','<=',$date)

        // ->where('fk_article','=',$req->id_article)
        ->select('fk_article','prix_unitaire','fk_fournisseur')
        ->groupBy('fk_article')
        ->groupBy('fk_fournisseur')
        ->groupBy('prix_unitaire')
        ->orderBy('prix_unitaire','asc')
        // ->toSql();
        ->get();
        $proformas = [];
        foreach ($result as $res => $pr) {
            // $proforma['id_proforma'] = $pr->id_proforma;
            $proforma['prix_unitaire'] = $pr->prix_unitaire; 
            // $proforma['quantite'] = $pr->quantite;
            // $proforma['duree_livraison'] = $pr->duree_livraison;
            // $proforma['date_proforma'] = $pr->date_proforma;
            $art = DB::table('article')->where('id_article','=',$pr->fk_article)->first();
            $proforma['article'] = $art;
            $fr = DB::table('fournisseur')->where('id_fournisseur','=',$pr->fk_fournisseur)->first();
            $proforma['fournisseur'] = $fr;
            // $proforma['fk_bdc'] = $pr->fk_bdc;
            $proformas[] = $proforma;
        }

        // $id = $req->id_article;
        // $d = $req->date_fin;
        // return response()->json($proformas, 200);
        return view('proforma',['proformas'=>$proformas]);
        // http://127.0.0.1:8000/proforma?id_article=article1&date_fin=2023-11-25
    }

    // public function sort_proforma(Request $req)
    // {

        
    //     $date = Carbon::parse($req->date_fin);
    //     $newDate = Carbon::parse($req->date_fin);
    //     // $date->addDays(6);
    //     $result = DB::table('proforma')
    //     ->where('fk_article','=',$req->id_article)
    //     ->where('date_proforma','<=',$date)
    //     ->where('date_proforma','>=',$newDate->subDays(6))
    //     ->orderBy('prix_unitaire','asc')
    //     ->get();
    //     $proformas = [];
    //     foreach ($result as $res => $pr) {
    //         $proforma['id_proforma'] = $pr->id_proforma;
    //         $proforma['prix_unitaire'] = $pr->prix_unitaire; 
    //         $proforma['quantite'] = $pr->quantite;
    //         $proforma['duree_livraison'] = $pr->duree_livraison;
    //         $proforma['date_proforma'] = $pr->date_proforma;
    //         $proforma['fk_article'] = $pr->fk_article;
    //         $proforma['fk_fournisseur'] = $pr->fk_fournisseur;
    //         $proforma['fk_bdc'] = $pr->fk_bdc;
    //         $proformas[] = $proforma;
    //     }

    //     $id = $req->id_article;
    //     return response()->json($proformas, 200);

    // }


}
