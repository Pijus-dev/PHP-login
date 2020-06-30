<?php

use App\App;

foreach ($data as $card) : ?>
    <div class="card">
        <div class="card-border">
            <p>Price: <?php print $card['price']; ?>&euro;</p>
            <div class="card-img">
                <img src="<?php print $card['photo']; ?>" alt="drink photo">
            </div>
            <div class="card-info">
                <h2><?php print $card['name']; ?></h2>
                <h2><?php print $card['percentage']; ?>%</h2>
                <h2>Size: <?php print $card['size']; ?>ml</h2>
            </div>
        </div>
        <p>Available: <?php print $card['amount']; ?></p>
        <?php if (App::$session->getUser()) : ?>
            <?php print $card['button']; ?>
        <?php endif; ?>
    </div>
<?php endforeach; ?>