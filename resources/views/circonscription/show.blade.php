@extends('layout')

@section('title')
    Circonscription
@endsection

@section('data')

    <!-- Facebook script -->
    <div id="fb-root"></div>
    <script>(function(d, s, id) {
      var js, fjs = d.getElementsByTagName(s)[0];
      if (d.getElementById(id)) return;
      js = d.createElement(s); js.id = id;
      js.src = "//connect.facebook.net/fr_FR/sdk.js#xfbml=1&version=v2.8";
      fjs.parentNode.insertBefore(js, fjs);
    }(document, 'script', 'facebook-jssdk'));</script>

    <div class="circonscription">
        <h3>Département {{$nomDep}} - {{$ordinal}} circonscription</h3>
    </div>
    <hr />
    <div class="candidats text-center container">
        <div class="candidat col-sm-6">
            <div class="nom">
                <h4>{{$circonscription->titulaire_prenom}} {{$circonscription->titulaire_nom}}</h4>
                Titulaire
            </div>
            <div class="photo">
                <img src="/departement/{{$circonscription->departement}}/circonscription/{{$circonscription->numero}}/titulaire" alt="Photo du titulaire">
            </div>
            <div class="bio">
                <p class="text-center">{{$circonscription->titulaire_bio}}</p>
            </div>
        </div>

        <div class="candidat col-sm-6">
            <div class="nom">
                <h4>{{$circonscription->suppleant_prenom}} {{$circonscription->suppleant_nom}}</h4>
                Suppléant
            </div>
            <div class="photo">
                <img src="/departement/{{$circonscription->departement}}/circonscription/{{$circonscription->numero}}/suppleant" alt="Photo du suppléant">
            </div>
            <div class="bio">
                <p class="text-center">{{$circonscription->suppleant_bio}}</p>
            </div>
        </div>
    </div>

    <hr />

    <div class="social">
        <div class="row">
            <div class="col-xs-6 text-center">
                <div class="fb-page" data-href="{{$circonscription->facebook}}" data-tabs="timeline" data-small-header="true" data-adapt-container-width="true" data-hide-cover="true" data-show-facepile="false"><blockquote cite="{{$circonscription->facebook}}" class="fb-xfbml-parse-ignore"><a href="{{$circonscription->facebook}}"></a></blockquote></div>
            </div>
            <div class="col-xs-6 text-center">
                <a class="twitter-timeline" data-lang="fr" data-width="400" data-height="550" data-dnt="true" data-link-color="#E81C4F" href="{{$circonscription->twitter}}"></a> <script async src="//platform.twitter.com/widgets.js" charset="utf-8"></script>
            </div>
        </div>
    </div>

    <div class="liens text-center">
        @if(isset($circonscription->blog))
            <div class="row">
                <div class="col-xs-6 text-center">
                    <a class="btn btn-lg" href="{{$circonscription->blog}}" target="_blank">En savoir plus</a>
                </div>
                <div class="col-xs-6 text-center">
                    <a class="btn btn-lg" href="mailto:{{$circonscription->email_campagne}}">{{$circonscription->email_campagne}}</a>
                </div>
            </div>
        @else
            <div class="row">
                <div class="col-xs-offset-3 col-xs-6 text-center">
                    <a class="btn btn-lg" href="mailto:{{$circonscription->email_campagne}}">{{$circonscription->email_campagne}}</a>
                </div>
            </div>
        @endif
    </div>

    <div class="map text-center">
      <h4>Événements et groupes d'appui dans cette circonscription</h4>
        <iframe
            style="border: none; margin: 0 0; padding: 0 0; width: 80%; height: 400px"
            src="https://jlm2017.github.io/map/?hide_address=1{{ $coords ? '&borderfit='.$coords['maxlat'].','.$coords['maxlong'].','.$coords['minlat'].','.$coords['minlong'] : ''}}">
        </iframe>

        <p>
            <a href="http://f-i.jlm2017.fr/users/event_pages/new?parent_id=103" class="btn btn-primary">Créer un événément</a>
        </p>
    </div>

    <style media="screen">
        .circonscription{
            display: block;
            text-align: center;
            margin: auto;
        }
        .candidats{
            display: block;
            margin: auto;
        }
        .candidat{
            display: inline-block;
            margin: auto;
            max-width: 600px;
        }
        .photo{
            margin: 25px;
        }
        .bio{
            text-align: left;
        }
    </style>
@endsection
