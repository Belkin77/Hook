<?php

//Envoi de notification d'avertissement lorsqu'un plugin détient une licence arrivant à expiration

add_action( 'HookSendNotificationExpiringLicence', 'send_notification_expiring_licence' );
function send_notification_expiring_licence() {

  // On effectue le traitement uniquement en PROD
  $site_url = $_SERVER['HTTP_HOST'];
  if ($site_url == "xxxx.com") {

    // Pour chaque licence, insérer sa date d'expiration au format américain (Y-m-d)

    $licence = array (
      "Plugin 1" => "2020-06-16",
      "Plugin 2" => "2020-12-10",
      "Plugin 3" => "2020-03-29",
      "Plugin 4" => "2020-03-04",
      "Plugin 5" => "2021-01-10",
    );

    $now = date("Y-m-d"); // On détermine la date d'aujourd'hui
    $datetime_now = new DateTime($now);

      foreach ($licence as $nom => $date_deadline) {
        
          $datetime_deadline = new DateTime($date_deadline);

          $difference = $datetime_now->diff($datetime_deadline);

          // Au bout de 15 jours, une première notification est envoyée avertissant de l'arrivée à échéande de la licence

          if ($difference->y == 0 AND $difference->m  == 0 AND $difference->d == 15) {

            $to = "xxxx@xxxx.com, xxxx@xxxx.com";

            $headers = array('Content-Type: text/html; charset=UTF-8');

            $subject = "[Elephant] - Licence $nom arrivant à expiration";
            $message = "Bonjour,<br/><br/>";
            $message .= "Le plugin $nom arrive à expiration dans <b>15 jours.</b><br/>";
            $message .= "Merci de le renouveler en se référant au chef de projet concerné.<br/>";
			$message .= "Cordialement";

			wp_mail( $to, $subject, $message, $headers);

       }


    }

  }
  
}