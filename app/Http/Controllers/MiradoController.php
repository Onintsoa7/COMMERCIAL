<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Demande_hebdo;
use App\Models\Liste_demande;
use App\Models\demande_proformat;
use App\Models\Demande_proformat_fournisseur;
use App\Models\Departement_demande;
use App\Models\Fournisseur_categorie;
use App\Models\Fournisseur;
use Illuminate\Support\Facades\Mail;
use App\Mail\MyMail;

use Illuminate\Support\Facades\DB;
use PDF;

class MiradoController extends Controller
{
  


    public function demande_hebdo(){
        $donnee = Liste_demande::where('etat', 5)
        ->groupBy('semaine','mois','annee')
        ->get(['semaine', 'mois','annee']);
        //5 valider par chef departement
        return view('service',['demande_hebdo'=>$donnee]);
    }
    public function liste_demande($semaine, $mois, $annee){
        $donnee = Demande_hebdo::where('semaine', '=', $semaine)
        ->where('mois', '=', $mois)
        ->where('annee', '=', $annee)
        ->where('etat', '=', 5)
        ->groupBy('semaine', 'mois', 'annee', 'nom' ,'fk_categorie')
        ->selectRaw('nom, SUM(quantite) as total_quantite,fk_categorie')
        ->get();
        $frn_cat = null;
        foreach ($donnee as $d) {
            $frn_cat[] = Fournisseur_categorie::where('id_categorie',$d->fk_categorie)->get();           
        }
        $donnee2 = Demande_hebdo::where('semaine', '=', $semaine)
        ->where('mois', '=', $mois)
        ->where('annee', '=', $annee)
        ->selectRaw('id_dept_demande')
        ->get();
        $mode_payement=DB::table('mode_de_payement')->get();
        return view('service_detail', [
            'id_demande' => $donnee2,
            'liste_demande' => $donnee,
            'fournisseur' => $frn_cat,
            'mode_de_payement' => $mode_payement,
            'semaine' => $semaine,
            'mois' => $mois,
            'annee' => $annee,
        ]);

    }

    public function validate_proforma_achat($id_dept_demande){
        Departement_demande::where('id_dept_demande', $id_dept_demande)
        ->where('etat', '=', 5)
        ->update(['etat' => 10]);
        return 'Proformat Ok';
    }   
    public function transaction_demande_proforma(Request $request){
        $data = $request->all();
        //  var_dump($data);
        $demandeProforma = [
            'duree_livraison' => $data['delai'],
            'fk_payement' => $data['payement'],
            'type_livraison' => $data['livraison'],
            'semaine'=>$data['semaine'],
            'mois'=>$data['mois'],
            'annee'=>$data['annee']
        ];
        
        $insertId = demande_proformat::insertGetId($demandeProforma, 'id_proforma');
        
        $proformatFournisseurData = []; // Tableau pour stocker les données à insérer

        foreach ($data['id_fournisseur'] as $categorieKey => $categorieValue) {
            foreach ($categorieValue as $fournisseurId) {
                $proformatFournisseurData[] = [
                    'fk_proforma' => $insertId,
                    'fk_categorie' => $categorieKey,
                    'fk_fournisseur' => $fournisseurId,
                ];
            }
        }
        Demande_proformat_fournisseur::insert($proformatFournisseurData);
        $jsonString = $data['id_dept_demande'][0];

        $dataArray = json_decode($jsonString, true);

        for ($i = 0; $i < count($dataArray); $i++) {
            $concatenatedValue = $dataArray[$i]['id_dept_demande'];
            $concatenatedValues[] = $concatenatedValue;
            for ($j=0; $j < count($concatenatedValues) ; $j++) { 
                $this -> validate_proforma_achat($concatenatedValues[$j]);   
            }
        }
       
        // $pdf = PDF::loadView('model_proformat', $data);
        // return $pdf->download('document.pdf');


        $jsonString2 = $data['article'];
        $dataArray2 = json_decode($jsonString2,true);
         $donne = array();
        for ($i = 0; $i < count($dataArray2); $i++) { 
            $donne['nom'][] = $dataArray2[$i]['nom'];
            $donne['quantite'][] = $dataArray2[$i]['total_quantite'];
        } 
        $liste_fournisseur = Fournisseur::all();
        $data['view'] = "mymail"; 
        $data = [$donne];
        $data['object'] = "test";
        $data['view'] = "mymail";  
        $data['quantite'] = 5;
        $data['article'] ='Stylo';
        $data['quantite'] = 5;
        foreach ($liste_fournisseur as $fournisseur) {
            $pdf = PDF::loadView('model_proformat', ['donne' => $donne]);
            // Mail::to('mirado.fitahiana03@gmail.com')->send(new MyMail($data));
            // $this->demande_hebdo();
            return $pdf->download($fournisseur->id_fournisseur.'.pdf');
        }
        
   }

}