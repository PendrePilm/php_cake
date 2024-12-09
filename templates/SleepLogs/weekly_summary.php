<h1>Résumé Hebdomadaire</h1>
<p>Total de cycles : <?= $totalCycles ?></p>
<p>Indicateur : <?= $greenIndicator ? '🟢' : '🔴' ?></p>
<table>
    <thead>
        <tr>
            <th>Date</th>
            <th>Cycles</th>
            <th>Sport</th>
            <th>Score au réveil</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($weekLogs as $log): ?>
        <tr>
            <td><?= $log->date ?></td>
            <td><?= $log->cycles ?></td>
            <td><?= $log->sport_done ? 'Oui' : 'Non' ?></td>
            <td><?= $log->wake_score ?></td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>
