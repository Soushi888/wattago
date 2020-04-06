<?

/**
 * Ajout d'un email dans la table email 
 *
 * @return boolean
 */
function ajouterEmail($email)
{
    if (verifieEmail($email)) {
        $sPDO = SingletonPDO::getInstance();


        $oPDOStatement = $sPDO->prepare(
            'INSERT INTO email SET email=:email;'
        );

        $oPDOStatement->bindParam(':email', $email);
        $oPDOStatement->execute();
        if ($oPDOStatement->rowCount() == 0) : ?>
            <p class="failed">Oups, une erreur est survenue.</p>
        <?php
            return false;
        endif; ?>

        <p class="succes">Succès !</p>
        <?php return true;
    }
}

/**
 * verifie si l'email donné est déjà présent dans la table email
 *
 * @return void
 */
function verifieEmail($email)
{
    $sPDO = SingletonPDO::getInstance();
    $oPDOStatement = $sPDO->prepare(
        'SELECT * FROM email;'
    );

    $oPDOStatement->execute();

    if ($oPDOStatement->rowCount() == 0) {
        return false;
    }

    $emails = $oPDOStatement->fetchAll(PDO::FETCH_ASSOC);

    foreach ($emails as $emailEnregistré) {
        if ($email == $emailEnregistré["email"]) : ?>
                <p class="succes">Adresse déjà enregistrée :)</p>
<?php            return false;
        endif;
    }

    return true;
}

$email = isset($_POST["email"]) ? $_POST["email"] : null;
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
    ajouterEmail($email);
endif;
