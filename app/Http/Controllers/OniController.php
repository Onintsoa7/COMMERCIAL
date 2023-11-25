<?php

namespace App\Http\Controllers;

use App\Models\Proforma;
use App\Models\Departement_demande;
use App\Models\Departement;
use App\Models\Departement_demande_detail;
use App\Models\Proforma_detail;
use App\Models\Liste_demande;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OniController extends Controller
{
    
    public function index(Request $request)
    {
        if(session('id_user')){
            return view('demande', ['categorie_article'=> $this->categorie_article()], ['articles'=> $this->articles()]);
        }else{
            return view('welcome', ['departements' => $this->departement()]);
        }
    }
    
    public function disconnect(Request $request){
        $request->session()->forget('id_user');
        return $this->index($request);
    }
    
    public function departement()
    {
        $departements = DB::table('departement')->get();
        return $departements->toArray();
    }
    public function fournisseur()
    {
        $fournisseurs = DB::table('fournisseur')->get();
        return $fournisseurs->toArray();
    }

    public function get_user()
    {
        $departement_user_view = DB::table('departement_user_view')
        ->where('id_user',"=" , strval(session('id_user')))
        ->first();
        return $departement_user_view;
    }
    public function get_demande_dept()
    {
        $departement = $this->get_user();
        $demande_dept_view = DB::table('departement_demande')
        ->where('fk_departement', "=" , $departement->id_departement)
        ->where('etat', "=" , 1)
        ->get();
        return $demande_dept_view;
    }
    public function get_detail_demande($id_dept_demande)
    {
        $demande_dept = DB::table('demande_detail')
        ->where('fk_dept_demande', "=" , $id_dept_demande)
        ->get();
        return $demande_dept;
    }
    public function demande_liste_detail($id_dept_demande){
    $departement_demande = $this->get_detail_demande($id_dept_demande);

    // Organiser les données par catégorie
    $dataByCategory = [];
    foreach ($departement_demande as $demande) {
        $dataByCategory[$demande->nom_categorie][] = $demande;
    }

    return view('demande_detail', ['departement_demande' => $dataByCategory], ['id_dept_demande'=> $id_dept_demande]);
    }

    public function demande_liste(){
        return view('demande_en_cours', ['departement_demande'=> $this->get_demande_dept()]);
    }

    public function verification(Request $request)
    {
        $email = $request->input('email');
        $password = $request->input('password');
    
    // Initialize the query with the Departement model
        $departement_user_view = DB::table('departement_user_view')
        ->where('email','=', $email)
        ->where('password','=', $password)
        ->first();
        if ($departement_user_view) {
            $request->session()->put('id_user', $departement_user_view->id_user);
            $request->session()->put('departement', $departement_user_view->id_departement);
            return view('demande', ['categorie_article'=> $this->categorie_article()], ['articles'=> $this->articles()]);
        }else{
            return view('login', ['error' => 'Utilisateur non trouve']);
        }
    }

    public function saisi_proforma()
    {
        $mode_de_payement =DB::table('mode_de_payement')->get();
        return view('saisi', [
            'categorie_article' => $this->categorie_article(), 
            'articles' => $this->articles(),
            'fournisseur' => $this->fournisseur(),
            'demande_hebdo' => $this->hebdo(),
            'mode_de_payement' => $mode_de_payement, // Removed the extra space at the end
        ]);
    }
    public function login(){
        return view('login');
    }

    public function categorie_article()
    {
        // Initialize the query with the Departement model
        $categorie_article_view = DB::table('categorie_article_view')
        ->select('id_categorie', 'nom_categorie')
        ->groupBy('id_categorie')
        ->groupBy('nom_categorie')
        ->get();

        return $categorie_article_view->toArray();
    }
    public function categorie_fournisseur()
    {
        // Initialize the query with the Departement model
        $categorie_article_view = DB::table('fournisseur_categorie_article')
        ->select('fk_categorie', 'nom_categorie', 'id_fournisseur')
        ->groupBy('fk_categorie')
        ->groupBy('nom_categorie')
        ->groupBy('id_fournisseur')
        ->get();

        return $categorie_article_view->toArray();
    }

    public function articles()
    {
        $articles = DB::table('categorie_article_view')
        ->select('id_article', 'nom_article', 'id_categorie')
        ->groupBy('id_article')
        ->groupBy('nom_article')
        ->groupBy('id_categorie')
        ->get();

        return $articles->toArray();
    }
    public function article_by_categorie(Request $request)
    {
        $categorie = $request->input('categorie');

        $article_by_categorie = DB::table('categorie_article_view')
        ->where('id_categorie','=', $categorie)
        ->get();

        return response()->json(['article_by_categorie' => $article_by_categorie], 200);
    }
      
    public function categoriesByFournisseur(Request $request)
    {
        $id_fournisseur = $request->input('fournisseur');
        $categories = DB::table('fournisseur_categorie_article')
        ->select('fk_categorie', 'nom_categorie')
        ->where('id_fournisseur', $id_fournisseur)
        ->groupBy('fk_categorie', 'nom_categorie')
        ->get();

    return response()->json(['categories' => $categories], 200);
    }  
    public function store_besoin(Request $request) {
        $data = $request->all();
        if(!empty($data)){
        $articles = $data['article'] ;
        $quantites = $data['quantite'];
        $totals = [];
    
        // Boucle pour agréger les quantités par article
        for ($i = 0; $i < count($articles); $i++) {
            if ($articles[$i] == "" || $quantites[$i] == 0 || $quantites[$i] == "") {
                // Ignorer les lignes vides
                continue;
            }
    
            $article = $articles[$i];
            $quantite = $quantites[$i];
    
            // Si l'article existe dans le tableau $totals, ajouter la quantité
            if (isset($totals[$article])) {
                $totals[$article] += $quantite;
            } else {
                // Sinon, créer une nouvelle entrée pour l'article
                $totals[$article] = $quantite;
            }
        }
    
        $user = $this->get_user();
    
        $dataToInsert = [
            'fk_departement' => $user->id_departement,
            'etat' => 1
        ];
    
        // Insert the data and get the last inserted ID
        $insertedId = Departement_demande::insertGetId($dataToInsert, 'id_dept_demande');
        foreach ($totals as $article => $quantite) {
            $departement_demande_detail = new Departement_demande_detail;
            $departement_demande_detail->fk_dept_demande = $insertedId;
            $departement_demande_detail->fk_article = $article;
            $departement_demande_detail->quantite = $quantite;
            $departement_demande_detail->save();
        } 
    }
        $data = null;
        return $this->index($request);
    }

    public function validate_besoin($id_dept_demande){
        $id_user = $this->get_user()->id_user;
        $etat = DB::table('departement_user_view')
        ->where('id_user', $id_user)
        ->pluck('etat')
        ->first();
        $etat = strval($etat);
        if($etat && $etat == 1){
            Departement_demande::where('id_dept_demande', $id_dept_demande)
            ->where('etat', '=', 1)
            ->update(['etat' => 5]);
            return $this->demande_liste();
        }else{
            return response()->json(['Non chef de departement'], 400);
        }
    }
    public function retour($id_dept_demande){
        $id_user = $this->get_user()->id_user;
        $etat = DB::table('departement_user_view')
        ->where('id_user', $id_user)
        ->pluck('etat')
        ->first();
        $etat = strval($etat);
        if($etat && $etat == 1){
            Departement_demande::where('id_dept_demande', $id_dept_demande)
            ->where('etat', '=', 1)
            ->update(['etat' => 5]);
            return $this->demande_liste();
        }else{
            return response()->json(['Non chef de departement'], 400);
        }
    }
    public function hebdo(){
        $semaine = Liste_demande::where('etat', 10)
        ->groupBy('semaine','mois','annee')
        ->get(['semaine', 'mois','annee']);
        
        return $semaine->toArray();
    }
    
    
public function store_proforma(Request $request){
    $data = $request->all();
    if(!empty($data)){
        $articles = $data['article'] ;
        $quantites = $data['quantite'];
        $prix_unitaires = $data['prixUnitaire'];
        $totals = [];
        $maximumId = DB::table('demande_proforma')->max('id_proforma');
        $dataToInsert = [
            'fk_proforma' => $maximumId,
            'duree_livraison' => $data['delai'],
            'fk_payement' => $data['payement'],
            'type_livraison' => $data['livraison'],
            'fk_fournisseur' => $data['fournisseur']
        ];
        $insertedId = Proforma::insertGetId($dataToInsert, 'id_proforma');

        for ($i=0; $i < count($articles); $i++) { 
            $proforma_detail = new Proforma_detail;
            $proforma_detail->fk_proforma = $insertedId;
            $proforma_detail->fk_article = $articles[$i];
            $proforma_detail->prix_unitaire = $prix_unitaires[$i];
            $proforma_detail->quantite = $quantites[$i];
            $proforma_detail->save();
        }
    }
    $data = null;
    return $this->saisi_proforma($request); 
}


public function validate_proforma($fk_fournisseur){
    DB::table('demande_proforma_fournisseur')
    ->where('fk_fournisseur',"=", $fk_fournisseur)
    ->update(['etat' => 15]);
}

    
}
