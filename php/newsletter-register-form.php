<?

/**
 * Ajout d'un email dans la table email 
 *
 * @return boolean
 */
function ajouterEmail($email)
{
    $sPDO = SingletonPDO::getInstance();
    $oPDOStatement = $sPDO->prepare(
        'INSERT INTO email SET email=:email;'
    );

    $oPDOStatement->bindParam(':email', $email);
    $oPDOStatement->execute();
    if ($oPDOStatement->rowCount() == 0) {
        return false;
    }
    return true;
}

$email = $_POST["email"];
$to    = "sacha.pignot@gmail.com"; // ENTER YOUR EMAIL ADDRESS

if (isset($email)) :
    // Envoyer un email
    $email_subject = "Nouvelle adresse email enregistrée - $email"; // ENTER YOUR EMAIL SUBJECT
    $headers = "MIME-Version: 1.0" . "\r\n";
    $headers .= "Content-type:text/html;charset=iso-8859-1" . "\r\n";
    $headers .= "From: <" . $email . ">\r\n" . "Reply-To: " . $email . "\r\n";
    $msg     = "Email: $email";
    mail($to, $email_subject, $msg, $headers);

    // Enregistrer l'email dans la BDD
    $ajoutEmail = ajouterEmail($email);

    if ($ajoutEmail) : ?>
        <p class="succes" >Succès !</p>
    <?php else : ?>
        <p class="failed" >Oups, réessayez.</p>
<? endif;
endif;
