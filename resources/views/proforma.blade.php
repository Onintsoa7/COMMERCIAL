@include('header_service')
<header class="site-header d-flex flex-column justify-content-center align-items-center">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-12 text-center">
                <h2 class="mb-0">Proforma</h2>
            </div>
        </div>
    </div>
</header>
<section class="latest-podcast-section section-padding pb-0" id="section_2">
    <div class="container">
        <div class="row justify-content-center">

            <div class="col-lg-12 col-12">
                <div class="section-title-wrap mb-5">
                    <h4 class="section-title">Proforma</h4>
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
                                    <th>Fournisseur</th>
                                    <th>Article</th>
                                    <th>Prix Unitaire HT</th>                                
                                </tr>
                                </thead>
                                <tbody class="table-group-divider">
                                    @for ($i = 0; $i < count($proformas); $i++)
                                    <tr class="table-primary" >
                                        <td scope="row">{{$proformas[$i]['fournisseur']->nom}}</td>
                                        <td scope="row">{{$proformas[$i]['article']->nom}}</td>
                                        <td scope="row">{{$proformas[$i]['prix_unitaire']}}</td>
                                    </tr>
                                        @endfor
                                    
                                </tbody>
                                <tfoot>
                                    
                                </tfoot>
                        </table>
                    </div>
                    
                    
                {{-- </div> --}}
            </div>

        </div>
    </div>
</section>

@include('footer')