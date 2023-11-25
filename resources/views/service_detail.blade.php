@include('header_service')
<header class="site-header d-flex flex-column justify-content-center align-items-center">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-12 text-center">
                <h2 class="mb-0">Details des demandes </h2>
            </div>
        </div>
    </div>
</header>
<section class="latest-podcast-section section-padding pb-0" id="section_2">
    <div class="container">
        <div class="row justify-content-center">

            <div class="col-lg-12 col-12">
                <div class="section-title-wrap mb-5">
                    <h4 class="section-title">Pre envoie proforma</h4>
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
                                    <th>Article</th>
                                    <th>Quantite Total</th>
                                </tr>
                            </thead>
                            <tbody class="table-group-divider">
                                @if ($liste_demande === null)
                                <tr class="table-primary" >
                                    <td scope="row"></td>
                                </tr> 
                                @else
                                @for ($i = 0; $i < count($liste_demande); $i++)
                                <tr class="table-primary" >
                                    <td scope="row">{{$liste_demande[$i]['nom'] }}</td>                                    
                                    <td scope="row">{{$liste_demande[$i]['total_quantite']}}</td>
                                </tr>
                                @endfor
                                @endif
                            </tbody>
                    </table>
                </div>
            </div>
            <div class="col-lg-12 col-12">
                <div class="custom-block d-flex">
                    <div class="row justify-content-center">
                        <div class="col-md-4">
                            <form action="/api/demande_proforma" method="post">
                            <label for="" class="form-label">Livraison Partielle</label>
                            <input type="hidden" name="article" value="{{$liste_demande}}">
                            <input type="hidden" name="semaine" value="{{$semaine}}">
                            <input type="hidden" name="mois" value="{{$mois}}">
                            <input type="hidden" name="annee" value="{{$annee}}">
                            <input type="hidden" name="id_dept_demande[]" value="{{$id_demande}}">
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
                              <input type="number"class="form-control" name="delai" id="" aria-describedby="helpId" placeholder="jours">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <h6> </h6>
                            <div class="mb-3">
                                <label for="" class="form-label">Mode de Payment</label>
                                <select class="form-select form-select-lg" name="payement" id="">
                                    @foreach ($mode_de_payement as $paye)
                                        <option value="{{$paye->id_mode}}">{{$paye->nom_mode}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        @if ($fournisseur === null)
                            <p>Pas de fournisseur</p>
                        @else
                        @for ($i = 0; $i < count($fournisseur); $i++)
                        <div class="row">
                            @for ($j = 0; $j < count($fournisseur[$i]); $j++)
                            <div class="col-md-3">
                                <h6> {{$fournisseur[$i][$j]['nom']}}</h6>
                                <div class="list-group">
                                    <label class="list-group-item">
                                      <input class="form-check-input me-1" type="checkbox" name="id_fournisseur[{{$fournisseur[$i][$j]['id_categorie']}}][]" value="{{$fournisseur[$i][$j]['id_fournisseur']}}">
                                      {{$fournisseur[$i][$j]['nom_fournisseur']}}
                                    </label>
                                  </div>
                            </div>
                            @endfor    
                            
                            
                        </div>
                        <p></p>
                        @endfor
                        @endif
                        @if ($fournisseur === null)
                            
                        @else
                        <div class="row">
                            <div class="col-md-12">
                                <button type="submit" class="btn btn-outline-primary">Envoyer proforma</button>
                            </div>
                        </div>
                        @endif
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@include('footer')