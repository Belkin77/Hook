<?php

// Permettre la modification de la bulle de selection d'un pick-up

add_filter( 'cdi_filterhtml_retrait_descpickup',  'filterhtml_retrait_descpickup', 10, 2) ;
function filterhtml_retrait_descpickup ($description, $PointRetrait) {

  $returnop = '<div id="selretrait" class="cdiselretrait' . $PointRetrait->identifiant . '"" >';

  $returnop .= '<div id="selretraithidden" data-value=".$PointRetrait->identifiant."><em>'.$PointRetrait->identifiant.'</em><p style="text-align:center;"><a class="button">Point Retrait sélectionné</a></p></div>' ;

  // Affichage du nom du point de retrait
  $returnop .= '<p class="point-retrait-name">' . $PointRetrait->nom . '</p>' ;

  // Affichage de l'adresse du point de retrait
  $returnop .= '<p class="point-retrait-adresse1">' .  $PointRetrait->adresse1 . ' ' . $PointRetrait->adresse2 . '</p>' ;
  $returnop .= '<p class="point-retrait-cp">' . $PointRetrait->codePostal . ' ' . $PointRetrait->localite .  '</p>' ;

  // Affichage des horaires d'ouverture
  $returnop .= '<p class="horaire-pickup"> Lundi : ' . replace_schedule_closed_pick_up($PointRetrait->horairesOuvertureLundi) . '</p>' ;
  $returnop .= '<p class="horaire-pickup"> Mardi : ' . replace_schedule_closed_pick_up($PointRetrait->horairesOuvertureMardi) . '</p>' ;
  $returnop .= '<p class="horaire-pickup"> Mercredi : ' . replace_schedule_closed_pick_up($PointRetrait->horairesOuvertureMercredi) . '</p>' ;
  $returnop .= '<p class="horaire-pickup"> Jeudi : ' . replace_schedule_closed_pick_up($PointRetrait->horairesOuvertureJeudi) . '</p>' ;
  $returnop .= '<p class="horaire-pickup"> Vendredi : ' . replace_schedule_closed_pick_up($PointRetrait->horairesOuvertureVendredi) . '</p>' ;
  $returnop .= '<p class="horaire-pickup"> Samedi : ' . replace_schedule_closed_pick_up($PointRetrait->horairesOuvertureSamedi) . '</p>' ;
  $returnop .= '<p class="horaire-pickup"> Dimanche : ' . replace_schedule_closed_pick_up($PointRetrait->horairesOuvertureDimanche) . '</p>' ;


  // Affichage du bouton de sélection
  $returnop .= '<p style="color:red; width:100%; display:inline-block;"><a class="selretrait button" style="float: right;" id="selretraitshown" >Sélectionner</a></p>' ;

  $returnop .= '</div>' ;


  return $returnop;

}