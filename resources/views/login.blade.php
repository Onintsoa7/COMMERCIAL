
@include('header')
    <header class="site-header d-flex flex-column justify-content-center align-items-center">
        <div class="container">
            <div class="row">

                <div class="col-lg-12 col-12 text-center">

                    <h2 class="mb-0">Bienvenue</h2>
                </div>

            </div>
        </div>
    </header>
    <div class="login">
        <div class="container">
            <div class="row">
              <div class="col-sm-9 col-md-7 col-lg-5 mx-auto">
                <div class="card border-0 shadow rounded-3 my-5">
                  <div class="card-body p-4 p-sm-5">
                    <h5 class="card-title text-center mb-5 fw-light fs-5">AUTHENTIFICATION</h5>
                    <form action="/api/verification" method="post">
                      <div class="form-floating mb-3">
                        <input type="email" class="form-control" id="floatingInput" placeholder="name@example.com" name="email">
                        <label for="floatingInput">Adresse e-mail</label>
                      </div>
                      <div class="form-floating mb-3">
                        <input type="password" class="form-control" id="floatingPassword" placeholder="Password" name="password">
                        <label for="floatingPassword">Mot de passe</label>
                      </div>
                      <div class="d-grid">
                        <button class="btn btn-primary btn-login text-uppercase fw-bold" type="submit">Se Connecter</button>
                      </div>
                    @if(isset($error))
                    <br>
                      <h5 class="card-title text-center mb-5 fw-light fs-5" style="color:red">{{$error}}</h5>
                    @endif
                    </form>
                  </div>
                </div>
              </div>
            </div>
          </div>
    </div>
@include('footer')