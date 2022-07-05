<?php setlocale(LC_TIME, 'fra_fra'); ?>
<p>Bonjour {{ $name }},</p>
<p>Votre mot de passe sur le portail de l'UCP a été changé le {{ strftime('%A %d %B %Y à %H:%M') }}.</p>
<p>Merci.</p>