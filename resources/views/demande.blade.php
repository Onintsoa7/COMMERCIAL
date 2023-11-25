@include('header_departement')
<header class="site-header d-flex flex-column justify-content-center align-items-center">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-12 text-center">
                <h2 class="mb-0">Demande Besoins</h2>
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
                    <h5 class="card-title text-center mb-5 fw-light fs-5">Ajouter des Demandes</h5>
                    <form id="demandeForm" method="POST" action="/api/store_besoin">
                    <div class="row">
                        <div class="col-md-3">
                            <div class="mb-3">
                            <a id="plus" class="btn btn-primary" role="button">Ajouter</a>
                            </div>
                        </div>
                    </div>
                    <div id="champsSaisie">
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

// Compteur pour rendre les noms des champs uniques
function ajouterChampSaisie() {
    var newRow = document.createElement('div');
    newRow.className = "row";
    
    var mb3_1 = document.createElement('div');
    mb3_1.className = "col-md-3";

    var mb3_2 = document.createElement('div');
    mb3_2.className = "col-md-3";

    var mb3_3 = document.createElement('div');
    mb3_3.className = "col-md-3";

    var selectCategorie = document.createElement('select');
    selectCategorie.name = 'categorie[]'; // Utilisez un tableau pour stocker plusieurs valeurs
    selectCategorie.classList.add('form-select', 'form-select-lg', 'mb-3');

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
    selectArticle.classList.add('form-select', 'form-select-lg', 'mb-3');

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
inputQuantite.classList.add('form-control', 'mb-3');

mb3_3.appendChild(inputQuantite);

newRow.appendChild(mb3_1);
newRow.appendChild(mb3_2);
newRow.appendChild(mb3_3);

var champsSaisieDiv = document.getElementById('champsSaisie');
champsSaisieDiv.appendChild(newRow);

    formData.push({
        article: selectArticle.value,
        quantite: inputQuantite.value
    });
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
}
    document.getElementById('plus').addEventListener('click', function () {
        ajouterChampSaisie();
    });
</script>
@include('footer')
