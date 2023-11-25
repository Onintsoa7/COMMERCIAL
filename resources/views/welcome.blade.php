@include('header')
<section class="hero-section">
    <div class="container">
        <div class="row">

            <div class="col-lg-12 col-12">
                <div class="text-center mb-5 pb-2">
                    <h1 class="text-white">Gestion des ventes</h1>
                    <p class="text-white">Votre allié pour une gestion des ventes efficace et sans tracas.  </p>
                </div>
                <div class="owl-carousel owl-theme">
                @if(count($departements) > 0)
                @foreach($departements as $departement)
                <div class="owl-carousel-info-wrap item">
                    <div class="owl-carousel-info">
                        <h4 class="mb-2">{{ $departement->nom }}</h4>

                    </div>
                </div>
                @endforeach   
                @endif                  
                </div>
            </div>

        </div>
    </div>
</section>


<section class="latest-podcast-section section-padding pb-0" id="section_2">
    <div class="container">
        <div class="row justify-content-center">

            <div class="col-lg-12 col-12">
                <div class="section-title-wrap mb-5">
                    <h4 class="section-title">Services</h4>
                </div>
            </div>

            <div class="col-lg-6 col-12 mb-4 mb-lg-0">
                <div class="custom-block d-flex">
                    <div class="custom-block-info">
                        <h5 class="mb-2">
                            <a href="detail-page.html">Services Finances </a>
                        </h5>
                        <p class="mb-0">Des conseils financiers avisés pour des décisions éclairées.</p>
                    </div>
                </div>
            </div>

            <div class="col-lg-6 col-12 mb-4 mb-lg-0">
                <div class="custom-block d-flex">
                    <div class="custom-block-info">
                        <h5 class="mb-2">
                            <a href="detail-page.html">Services Achats </a>
                        </h5>

                        <div class="profile-block d-flex">
                        </div>

                        <p class="mb-0">Optimisez vos coûts, optimisez votre entreprise.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@include('footer')