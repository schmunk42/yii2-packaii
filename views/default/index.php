<div class="packageBrowser-default-index">
    <h1>Package Browser</h1>

    <p>
        <?php
        // this is dirty code, just for testing (!!!)
        $client = new Packagist\Api\Client();
        foreach ($client->search('yii2') as $package) {
            echo "{$package->getName()} ";
        }
        ?>
    </p>
</div>
