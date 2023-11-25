@include('header_departement')
<header class="site-header d-flex flex-column justify-content-center align-items-center">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-12 text-center">
                <h2 class="mb-0">Détails de la demande</h2>
            </div>
        </div>
    </div>
</header>
<section class="latest-podcast-section section-padding pb-0" id="section_2">
    <div class="container">
        <div class="row justify-content-center">

            <div class="col-lg-12 col-12">
                <div class="section-title-wrap mb-5">
                    <h4 class="section-title">Detail demande</h4>
                </div>
            </div>
            <div class="col-lg-12 col-12">
                    <div class="table-responsive">
                        <table class="table table-striped table-hover table-primary align-middle">
                            <thead class="table-light">
                                <tr>
                                    <th>Categorie</th>
                                    <th>Article</th>
                                    <th>Quantite</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody class="table-group-divider">
                                @foreach($departement_demande as $category => $categoryData)
                                    <tr>
                                        <td scope="row" rowspan="{{ count($categoryData) }}">{{ $category }}</td>
                                        @foreach($categoryData as $demande)
                                            <td>{{ $demande->nom_article }}</td>
                                            <td>{{ $demande->quantite }}</td>
                                            <td>
                                                <button type="button" class="btn btn-outline-primary">Modifier</button>
                                                <button type="button" class="btn btn-outline-danger">Supprimer</button>
                                            </td>
                                        </tr>
                                        <tr>
                                        @endforeach
                                    @endforeach
                                </tr>
                            </tbody>
                            <tfoot>
                            </tfoot>
                        </table>
                    </div>
            </div>
            <div class="col-lg-12 col-12">
                <a href="/validate_besoin/{{$id_dept_demande}}" class="btn btn-primary" role="button">Valider</a>
            </div>
        </div>
    </div>
</section>

@include('footer')