<?php /** @var \Throwable $throwable */ ?>

<h1>Throwable</h1>

<p>Type: <?= $throwable::class; ?></p>
<p>Message: <?= $throwable->getMessage(); ?></p>
<p>File: <?= $throwable->getFile(); ?>::<?= $throwable->getLine(); ?> line</p>

<pre style="padding:15px;background:#000;color:aquamarine;">Stack trace:
<?php var_dump(array_slice($throwable->getTrace(), 0, 3)); ?>
</pre>
