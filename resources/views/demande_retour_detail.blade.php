@include('header_departement')
<header class="site-header d-flex flex-column justify-content-center align-items-center">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-12 text-center">
                <h2 class="mb-0">Details</h2>
            </div>
        </div>
    </div>
</header>
<section class="latest-podcast-section section-padding pb-0" id="section_2">
    <div class="container">
        <div class="row justify-content-center">

            <div class="col-lg-12 col-12">
                <div class="section-title-wrap mb-5">
                    <h4 class="section-title">Details des retours</h4>
                </div>
            </div>

            

            <div class="col-lg-12 col-12">
                {{-- <div class="custom-block d-flex"> --}}
                    <div class="table-responsive">
                        <table class="table table-striped
                        table-hover	
                      
                        table-primary
                        align-middle">
                            <thead class="table-light">
                                
                                <tr>
                                    <th>Categorie</th>
                                    <th>Article</th>
                                    <th>Quantite</th>
                                </tr>
                                </thead>
                                <tbody class="table-group-divider">
                                    <tr class="table-primary" >
                                        <td scope="row">Bureau</td>
                                        <td>Article</td>
                                        <td>Quantite</td>
                                        <td> <button type="button" class="btn btn-outline-primary">Modifier</button>
                                        <button type="button" class="btn btn-outline-danger">Supprimer</button>

                                        </td>
                                    </tr>
                                    
                                </tbody>
                                <tfoot>
                                    
                                </tfoot>
                        </table>
                    </div>
                    
                    
                {{-- </div> --}}
            </div>
            <div class="col-lg-12 col-12">
                <a name="" id="" class="btn btn-primary" href="#" role="button">Valider</a>
                <a name="" id="" class="btn btn-primary" href="#" role="button">Decliner</a>

            </div>
        </div>
    </div>
</section>

@include('footer')