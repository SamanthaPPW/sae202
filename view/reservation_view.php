<div class="contenu">

<?php if (isset($_SESSION['message'])): ?>
    <p style="color: green"><?= $_SESSION['message'] ?></p>
    <?php unset($_SESSION['message']); ?>
<?php endif; ?>

<h1>Calendrier des créneaux</h1>

<div id='calendar'></div>

<?php
// Construire un tableau PHP pour les events
$events = [];
foreach ($creneaux as $creneau) {
    $events[] = [
        'title' => "{$creneau['nb_reservations']}/20",
        'start' => date('Y-m-d\TH:i:s', strtotime($creneau['date_creneau'])),
        'url'   => "/reservation/formulaire_achat?creneau_id={$creneau['id']}",
        'color' => $creneau['nb_reservations'] >= 20 ? '#aaa' :
                   ($creneau['nb_reservations'] < 6 ? '#ffcc00' : '#3788d8')
    ];
}
?>

<!-- FullCalendar CSS + JS -->
<link href='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.11/main.min.css' rel='stylesheet' />
<script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.11/main.min.js'></script>
<script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.11/locales/fr.js'></script>

<script>
document.addEventListener('DOMContentLoaded', function() {
    var calendarEl = document.getElementById('calendar');

    var calendar = new FullCalendar.Calendar(calendarEl, {
        initialView: 'dayGridMonth',
        locale: 'fr',
        firstDay: 1,
        headerToolbar: {
            left: 'prev,next today',
            center: 'title',
            right: 'dayGridMonth,timeGridWeek'
        },
        events: <?= json_encode($events) ?>
    });

    calendar.render();
});
</script>

</div>
