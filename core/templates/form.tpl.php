<?php if (isset($data['success_message'])) : ?>
    <div class="notification success"><?php print $data['success_message']; ?></div>
<?php elseif (isset($data['error_message'])) : ?>
    <div class="notification fail"><?php print $data['error_message']; ?></div>
    <?php endif; ?>
    <form <?php print form_attrs($data['attrs'] ?? []); ?>>
    <!--Field generation start-->
    <?php foreach ($data['fields'] ?? [] as $field_id => $field) : ?>

        <?php if (isset($field['label'])) : ?>
            <label><?php print $field['label']; ?></label>
        <?php endif; ?>

        <?php if ($field['type'] == 'select') : ?>

            <!--Select tag generation start-->
            <select <?php print select_attrs($field_id, $field); ?>>

                <!--Option tag generation -->
                <?php foreach ($field['options'] ?? [] as $option_id => $option_title) : ?>
                    <option <?php print option_attr($option_id, $field); ?>>
                        <?php print $option_title; ?>
                    </option>
                <?php endforeach; ?>
                <!--Option tag generation end-->

            </select>
            <!--Select tag generation end -->

        <?php else : ?>

            <!--Input tag generation-->
            <input <?php print input_attrs($field_id, $field) ?>>
            ​
        <?php endif; ?>

        <!-- Field error generation-->
        <?php if (isset($field['error'])) : ?>
            <div class="error"><?php print $field['error']; ?></div>
        <?php endif; ?>
        ​
    <?php endforeach; ?>
    <!--Field generation end-->

    <!--Button generation start-->
    <?php foreach ($data['buttons'] ?? [] as $button_id => $button) : ?>
        <button <?php print button_attrs($button_id, $button) ?>>
            <?php print $button['title']; ?>
        </button>
    <?php endforeach; ?>
    <!--Button generation end-->

</form>