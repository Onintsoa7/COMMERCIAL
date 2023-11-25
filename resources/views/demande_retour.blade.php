@include('header_departement')
<header class="site-header d-flex flex-column justify-content-center align-items-center">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-12 text-center">
                <h2 class="mb-0">Demande En Cours</h2>
            </div>
        </div>
    </div>
</header>
<section class="latest-podcast-section section-padding pb-0" id="section_2">
    <div class="container">
        <div class="row justify-content-center">

            <div class="col-lg-12 col-12">
                <div class="section-title-wrap mb-5">
                    <h4 class="section-title">Retour des demandes</h4>
                </div>
            </div>

            

            <div class="col-lg-12 col-12">
                
                    <div class="table-responsive">
                        <table class="table table-striped
                        table-hover	
                      
                        table-primary
                        align-middle">
                            <thead class="table-light">
                                
                                <tr>
                                    <th>Date Demande</th>
                                    <th>Libelle</th>
                                </tr>
                                </thead>
                                <tbody class="table-group-divider">
                                    <tr class="table-primary" >
                                        <td scope="row">2023-11-17</td>
                                        <td>Besoin</td>
                                        <td> <button type="button" class="btn btn-outline-primary">Details</button>
                                        </td>
                                    </tr>
                                    
                                </tbody>
                                <tfoot>
                                    
                                </tfoot>
                        </table>
                    </div>
                    
                    
            </div>

        </div>
    </div>
</section>

@include('footer')