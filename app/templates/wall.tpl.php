<div class="wall animate__animated animate__backInLeft">
    <?php foreach ($data['pixel'] as $pixel) : ?>
        <div <?php print form_attrs($data['attr']); ?> <?php print pixel_attr($pixel['x'], $pixel['y'], $pixel['color']); ?>>
        </div>
    <?php endforeach; ?>
</div>