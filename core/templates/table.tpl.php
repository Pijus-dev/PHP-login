<table <?php print form_attrs($table['attr']); ?>>
    <thead>
        <tr>
            <?php foreach ($table['headings'] as $heading) : ?>
                <th class="animate__animated animate__flipInY"><?php print $heading ?></th>
            <?php endforeach; ?>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($table['rows'] ?? [] as $row) : ?>
            <tr>
                <?php foreach ($row as $col) : ?>
                    <td class="animate__animated animate__flipInY"><?php print $col; ?></td>
                <?php endforeach; ?>
            <tr>
            <?php endforeach; ?>
    </tbody>
</table>