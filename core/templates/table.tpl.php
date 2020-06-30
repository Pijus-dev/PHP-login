<table <?php print form_attrs($data['attr']); ?>>
    <thead>
        <tr>
            <?php foreach ($data['headings'] as $heading) : ?>
                <th class="animate__animated animate__flipInY"><?php print $heading ?></th>
            <?php endforeach; ?>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($data['rows'] ?? [] as $row) : ?>
            <tr>
                <?php foreach ($row as $col) : ?>
                    <?php if (is_array($col)) : ?>
                        <td colspan="2">
                            <?php foreach ($col as $single_col) : ?>
                                <?php print $single_col; ?>
                            <?php endforeach; ?>
                        </td>
                    <?php else : ?>
                        <td class="animate__animated animate__flipInY"><?php print $col; ?></td>
                    <?php endif ?>
                <?php endforeach; ?>
            <tr>
            <?php endforeach; ?>
    </tbody>
</table>