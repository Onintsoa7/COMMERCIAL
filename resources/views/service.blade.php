    @include('header_service')
<header class="site-header d-flex flex-column justify-content-center align-items-center">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-12 text-center">
                <h2 class="mb-0">Listes des demandes </h2>
            </div>
        </div>
    </div>
</header>
<section class="latest-podcast-section section-padding pb-0" id="section_2">
    <div class="container">
        <div class="row justify-content-center">

            <div class="col-lg-12 col-12">
                <div class="section-title-wrap mb-5">
                    <h4 class="section-title">Demande Hebdomadaire</h4>
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
                                    <th>Numero Semaine</th>
                                    <th>Mois</th>
                                    <th>Annee</th>
                                    
                                </tr>
                                </thead>
                                <tbody class="table-group-divider">
                                    @for ($i = 0; $i < count($demande_hebdo); $i++)
                                    <tr class="table-primary" >
                                        <td scope="row">{{$demande_hebdo[$i]['semaine']}}</td>
                                        <td scope="row">{{$demande_hebdo[$i]['mois']}}</td>
                                        <td scope="row">{{$demande_hebdo[$i]['annee']}}</td>
                                        <td><a name="" id="" class="btn btn-outline-primary" href="{{ route('voir-detail', ['semaine' => $demande_hebdo[$i]['semaine'], 'mois' => $demande_hebdo[$i]['mois'], 'annee' => $demande_hebdo[$i]['annee']]) }}" role="button">Voir Detail</a></td>                                    </tr>
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