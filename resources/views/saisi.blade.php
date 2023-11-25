@include('header_departement')

<style>
    .form-select,
    .form-control,
    input[type="number"] {
        width: 200px;
    }
    
</style>
<header class="site-header d-flex flex-column justify-content-center align-items-center">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-12 text-center">
                <h2 class="mb-0">Saisi proforma</h2>
            </div>
        </div>
    </div>
</header>

<div class="login">
    <div class="container">
        <div class="row">
            <div class="col-sm-9 col-md-9 col-lg-9 mx-auto">
                <div class="card border-0 shadow rounded-3 my-9">
                <div class="card-body p-4 p-sm-5">
                    <form id="demandeForm" method="POST" action="/api/store_proforma">
                    <div class="col-md-8">
                        <div class="mb-3">
                            <label for="demandeDropdown" class="form-label">Demandes avec proforma reçu (NON COMMANDé): </label>
                            <select class="form-select" id="demandeDropdown" name="semaine">
                                @for ($i = 0; $i < count($demande_hebdo); $i++)
                                    <option value=" {{ $demande_hebdo[$i]['semaine'] }}/{{ $demande_hebdo[$i]['mois'] }}/{{ $demande_hebdo[$i]['annee'] }}">
                                        Semaine: {{ $demande_hebdo[$i]['semaine'] }}/{{ $demande_hebdo[$i]['mois'] }}/{{ $demande_hebdo[$i]['annee'] }}
                                    </option>
                                @endfor
                            </select>
                        </div>
                        <div class="mb-3">
                            @if(count($fournisseur) > 0)
                            <select class="form-select form-select-lg" name="fournisseur" id="fournisseur">
                                <option>Fournisseur</option>
                                @forEach($fournisseur as $fournisseurs)
                                <option value="{{$fournisseurs->id_fournisseur}}">{{$fournisseurs->nom}}</option>
                                @endforeach
                            </select>
                            @endif
                        </div>
                    <div class="row">
                        <div class="col-md-8">
                            <div class="mb-3">
                            <a id="plus" class="btn btn-primary" role="button">Ajouter</a>
                            </div>
                        </div>
                    </div>
                    <div id="champsSaisie">
                    </div>
                    <hr>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" value="1" id="" name="livraison">
                        <label class="form-check-label" for="">Oui </label>
                      </div>
                      <div class="form-check">
                        <input class="form-check-input" type="radio" value="2" id="" name="livraison" checked>
                        <label class="form-check-label" for="">Non </label>
                      </div>
                  </div>
                  <div class="col-md-4">
                      <h6> </h6>
                      <div class="mb-3">
                        <label for="" class="form-label">Delai de Livraison</label>
                        <input type="number"class="form-control" name="delai" id="" aria-describedby="helpId" placeholder="jours" required min="0">
                      </div>
                  </div>
                  <div class="col-md-4">
                      <h6> </h6>
                      <div class="mb-3">
                          <label for="" class="form-label">Mode de Payement</label>
                          <select class="form-select form-select-lg" name="payement" id="">
                              @foreach ($mode_de_payement as $paye)
                                  <option value="{{$paye->id_mode}}">{{$paye->nom_mode}}</option>
                              @endforeach
                          </select>
                      </div>
                  </div>
                  <button id="store_besoin" type="submit" class="btn btn-primary">Enregistrer</button>
                  </form>
                </div>
            </div>
        </div>
        </div>
    </div>
</div>
<script>
// Store the values in an array
var formData = [];
var selectFournisseur = document.getElementById('fournisseur'); // Replace 'fournisseur' with the actual ID of your fournisseur select element

// Compteur pour rendre les noms des champs uniques
function ajouterChampSaisie() {
    var newRow = document.createElement('div');
    var p = document.createElement('p');
    newRow.className = "row";
    
    var mb3_1 = document.createElement('div');
    mb3_1.className = "col-md-8";

    var mb3_2 = document.createElement('div');
    mb3_2.className = "col-md-8";

    var mb3_3 = document.createElement('div');
    mb3_3.className = "col-md-8";

    var mb3_4 = document.createElement('div');
    mb3_3.className = "col-md-8";

    var selectCategorie = document.createElement('select');
    selectCategorie.name = 'categorie[]'; // Utilisez un tableau pour stocker plusieurs valeurs
    selectCategorie.classList.add('form-select', 'form-select-lg', 'mb-6');

    // Populate options dynamically based on PHP variable $categorie_article
        var optionCategorie = document.createElement('option');
        optionCategorie.text = 'Categorie';
        selectCategorie.add(optionCategorie);

    @foreach($categorie_article as $categorie_articles)
        var optionCategorie = document.createElement('option');
        optionCategorie.value = '{{ $categorie_articles->id_categorie }}';
        optionCategorie.text = '{{ $categorie_articles->nom_categorie }}';
        selectCategorie.add(optionCategorie);
    @endforeach

    mb3_1.appendChild(selectCategorie);

    var selectArticle = document.createElement('select');
    selectArticle.name = 'article[]'; // Utilisez un tableau pour stocker plusieurs valeurs
    selectArticle.classList.add('form-select', 'form-select-lg', 'mb-6');

    var optionArticle = document.createElement('option');
        optionArticle.text = 'Article';
        selectArticle.add(optionArticle);
    @foreach($articles as $article)
        var optionArticle = document.createElement('option');
        optionArticle.value = '{{ $article->id_article }}';
        optionArticle.text = '{{ $article->nom_article }}';
        selectArticle.add(optionArticle);
    @endforeach

    mb3_2.appendChild(selectArticle);

var inputQuantite = document.createElement('input');
inputQuantite.type = 'number';
inputQuantite.placeholder = 'quantite';
inputQuantite.name = 'quantite[]'; // Utilisez un tableau pour stocker plusieurs valeurs
inputQuantite.classList.add('form-control', 'mb-6');

mb3_3.appendChild(inputQuantite);

var inputPrixUnitaire = document.createElement('input');
inputPrixUnitaire.type = 'text';
inputPrixUnitaire.placeholder = 'PrixUnitaire';
inputPrixUnitaire.name = 'prixUnitaire[]'; // Utilisez un tableau pour stocker plusieurs valeurs
inputPrixUnitaire.classList.add('form-control', 'mb-6');

mb3_4.appendChild(inputPrixUnitaire);

newRow.appendChild(mb3_1);
newRow.appendChild(mb3_2);
newRow.appendChild(mb3_3);
newRow.appendChild(mb3_4);
newRow.appendChild(p);

var champsSaisieDiv = document.getElementById('champsSaisie');
champsSaisieDiv.appendChild(newRow);

    // Add an event 'change' to the new category dropdown
    selectCategorie.addEventListener('change', function () {
        // Get the selected category value
        var selectedCategorie = this.value;

        // Get the new article dropdown
        var newSelectArticle = selectArticle;

        // Clear all existing options in the new article dropdown
        newSelectArticle.innerHTML = '';

        // Check if a category is selected
        if (selectedCategorie) {
            // Make an AJAX request to fetch articles based on the selected category
            fetch('/article_by_categorie?categorie=' + selectedCategorie)
                .then(response => response.json())
                .then(data => {
                    // Add the fetched articles to the new article dropdown
                    data.article_by_categorie.forEach(article => {
                        var option = document.createElement('option');
                        option.value = article.id_article;
                        option.text = article.nom_article;
                        newSelectArticle.add(option);
                    });
                })
                .catch(error => console.error('Error:', error));
        }
    });


    selectFournisseur.addEventListener('change', function () {
    // Get the selected fournisseur value
    var selectedFournisseur = this.value;

    console.log('Selected Fournisseur:', selectedFournisseur);
    // Get the new Categorie dropdown
    var newSelectCategorie = selectCategorie;

    // Clear all existing options in the new Categorie dropdown
    newSelectCategorie.innerHTML = '';

    // Check if a fournisseur is selected
    if (selectedFournisseur) {
        // Make an AJAX request to fetch categories based on the selected fournisseur
        fetch('/categoriesByFournisseur?fournisseur=' + selectedFournisseur)
            .then(response => response.json())
            .then(data => {
                // Add the fetched categories to the "Categorie" dropdown
                data.categories.forEach(categorie => {
                    var option = document.createElement('option');
                    option.value = categorie.fk_categorie;
                    option.text = categorie.nom_categorie;
                    newSelectCategorie.add(option);
                });
            })
            .catch(error => console.error('Error:', error));
    }
});
formData.push({
    fournisseur: selectFournisseur.value,
    article: selectArticle.value,
    quantite: inputQuantite.value,
    prixUnitaire: inputPrixUnitaire.value
});


}
    document.getElementById('plus').addEventListener('click', function () {
    console.log('Plus button clicked!');
        ajouterChampSaisie();
    });
</script>
@include('footer')