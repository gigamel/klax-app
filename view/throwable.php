<?php /** @var \Throwable $throwable */ ?>

<h1>Throwable</h1>

<p>Type: <?= $throwable::class; ?></p>
<p>Message: <?= $throwable->getMessage(); ?></p>
<p>File: <?= $throwable->getFile(); ?>::<?= $throwable->getLine(); ?> line</p>

<h2>Stack trace:</h2>
<pre style="padding:15px;background:#000;color:aquamarine;">
<?php var_dump(debug_backtrace(DEBUG_BACKTRACE_IGNORE_ARGS, 10)); ?>
</pre>
