<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CandidatController extends Controller
{
    /**
     * Show the current data for the given candidate.
     *
     * @param  int  $id
     * @return Response
     */
    public function update($id, Request $request)
    {
        list($departement, $numero, $titulaire) = explode('-', decrypt($id));
        $place = $titulaire === 't' ? 'titulaire' : 'suppleant';

        $circonscription = \App\Circonscription
            ::where('numero', $numero)
            ->where('departement', $departement)
            ->first();

        $candidat = \App\Candidat
            ::where('circonscription', $numero)
            ->where('departement', $departement)
            ->where('titulaire', ($titulaire === 't'))
            ->first();

        if (!$candidat) {
            $candidat = new \App\Candidat();
            $candidat->departement = $departement;
            $candidat->circonscription = $numero;
            $candidat->titulaire = $titulaire === 't';
            if ($circonscription) {
                $candidat->nom = $circonscription->{$place.'_nom'};
                $candidat->prenom = $circonscription->{$place.'_prenom'};
            }
        }

        if (!$candidat->photo) {
            $photo = 'photos/new/'.$departement.'/';
            $photo .= join('_', [$departement, $numero, $place]).'.jpg';
            $candidat->photo = Storage::disk('public')->exists($photo) ? '/storage/'.$photo : false;
        }

        return view('candidat.update')->with(['candidat' => $candidat, 'id' => $id]);
    }

    public function store($id, Request $request)
    {
        list($departement, $numero, $titulaire) = explode('-', decrypt($id));

        $circonscription = \App\Circonscription
            ::where('numero', $numero)
            ->where('departement', $departement)
            ->first();

        $place = $titulaire === 't' ? 'titulaire' : 'suppleant';

        $candidat = \App\Candidat
            ::where('circonscription', $numero)
            ->where('departement', $departement)
            ->where('titulaire', ($titulaire === 't'))
            ->first();

        if (!$candidat) {
            $candidat = new \App\Candidat();
            $candidat->departement = $departement;
            $candidat->circonscription = $numero;
            $candidat->titulaire = $titulaire === 't';
        }

        if (!$candidat->photo) {
            $photo = 'photos/new/'.$departement.'/';
            $photo .= join('_', [$departement, $numero, $place]).'.jpg';
            $candidat->photo = Storage::disk('public')->exists($photo) ? '/storage/'.$photo : false;
        }

        $this->validate($request, [
            'erreur_materiel' => 'nullable|boolean',
            'nom' => 'required|max:255',
            'prenom' => 'required|max:255',
            'nom_usage' => 'max:255',
            'prenom_usage' => 'max:255',
            'sexe' => 'required|in:M,F',
            'photo_file' => 'nullable|image',
            'charte' => 'boolean',
            'date_naissance' => 'required|date_format:d/m/Y',
            'activite' => 'required|max:255',
            'email' => 'required|email',
            'telephone' => 'required|max:255',
            'bio' => 'required',
            'email_campagne' => 'nullable|email',
            'twitter' => 'nullable|url',
            'facebook' => 'nullable|url',
            'mandataire_nom' => 'max:255',
            'mandataire_prenom' => 'max:255',
            'mandataire_adresse' => 'max:255',
            'mandataire_mail' => 'max:255',
            'mandataire_telephone' => 'max:255',
            'colistier_nom' => 'max:255',
            'colistier_prenom' => 'max:255',
            'colistier_adresse_ligne1' => 'max:255',
            'colistier_adresse_ligne2' => 'max:255',
            'colistier_adresse_zipcode' => 'max:255',
            'colistier_adresse_ville' => 'max:255',
            'colistier_mail' => 'nullable|email|max:255',
            'colistier_telephone' => 'max:255'
        ]);

        $candidat->fill($request->all());

        if ($request->hasFile('photo_file')) {
            $photo = '/photos/new/'.$departement;
            $photo .= '/'.implode('_', [$departement, $numero, $place]);
            $photoPath = $request->file('photo_file')->store($photo, 'public');
            $candidat->photo = '/storage/'.$photoPath;
        }

        $candidat->save();

        return redirect('https://lafranceinsoumise.fr/campagnes/campagne-legislatives-2017/merci/');
    }
}
