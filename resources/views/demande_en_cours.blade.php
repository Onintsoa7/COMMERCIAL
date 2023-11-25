@include('header_departement')
<header class="site-header d-flex flex-column justify-content-center align-items-center">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-12 text-center">
                <h2 class="mb-0">Liste des demandes</h2>
            </div>
        </div>
    </div>
</header>
<section class="latest-podcast-section section-padding pb-0" id="section_2">
    <div class="container">
        <div class="row justify-content-center">

            <div class="col-lg-12 col-12">
                <div class="section-title-wrap mb-5">
                    <!-- <h4 class="section-title">Liste des demandes</h4> -->
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
                                    <th>Date Demande</th>
                                    <th>Etat</th>
                                    <th>Libelle</th>
                                </tr>
                                </thead>
                                <tbody class="table-group-divider">
                                    @if(count($departement_demande) > 0)
                                    @foreach($departement_demande as $dept_demande)
                                    <tr class="table-primary" >
                                        <td>Demande du </td>
                                        <td scope="row">{{$dept_demande->date_demande}}</td>
                                        <td> <a href="/demande_liste_detail/{{$dept_demande->id_dept_demande}}" class="btn btn-outline-primary">Detail</a>
                                        </td>
                                    </tr>
                                    @endforeach   
                                    @endif    
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