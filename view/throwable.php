<?php /** @var \Throwable $throwable */ ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8"/>
    <title>Debugger - Error</title>
    <style>
        :root {
            --bg-main: #181a1f;
            --bg-card: #21252b;
            --bg-trace: #282c34;
            --text-main: #abb2bf;
            --text-muted: #5c6370;
            --color-error: #e06c75;
            --color-class: #98c379;
            --color-method: #61afef;
            --color-line: #d19a66;
        }

        body {
            background-color: var(--bg-main);
            color: var(--text-main);
            font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Helvetica, Arial, sans-serif;
            line-height: 1.6;
            padding: 30px;
            margin: 0;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
        }

        .error-header {
            border-bottom: 2px solid #2d3139;
            padding-bottom: 15px;
            margin-bottom: 25px;
        }

        .error-title {
            color: var(--color-error);
            margin: 0 0 10px 0;
            font-size: 2.2rem;
        }

        .error-msg {
            font-size: 1.2rem;
            background: rgba(224, 108, 117, 0.1);
            border-left: 4px solid var(--color-error);
            padding: 15px;
            border-radius: 4px;
            color: #e5c07b;
            margin: 0;
        }

        .meta-box {
            background: var(--bg-card);
            padding: 20px;
            border-radius: 6px;
            margin-bottom: 30px;
            border: 1px solid #2d3139;
        }

        .meta-line {
            margin: 8px 0;
            font-size: 0.95rem;
        }

        .meta-line strong {
            color: #fff;
            display: inline-block;
            width: 90px;
        }

        .code-font {
            font-family: 'Fira Code', 'Cascadia Code', Consolas, Monaco, monospace;
        }

        .trace-title {
            font-size: 1.5rem;
            margin-bottom: 15px;
            color: #fff;
        }

        .trace-list {
            background: var(--bg-card);
            border-radius: 6px;
            overflow: hidden;
            border: 1px solid #2d3139;
        }

        .trace-item {
            display: flex;
            padding: 12px 20px;
            border-bottom: 1px solid #2d3139;
            font-size: 0.9rem;
        }

        .trace-item:last-child {
            border-bottom: none;
        }

        .trace-item:hover {
            background: var(--bg-trace);
        }

        .trace-index {
            color: var(--text-muted);
            width: 30px;
            flex-shrink: 0;
            font-weight: bold;
        }

        .trace-body {
            flex-grow: 1;
            overflow-x: auto;
        }

        .trace-call {
            margin-bottom: 4px;
        }

        .trace-file {
            color: var(--text-muted);
            font-size: 0.85rem;
        }

        .class-name { color: var(--color-class); }
        .method-name { color: var(--color-method); }
        .line-num { color: var(--color-line); font-weight: bold; }
    </style>
</head>
<body>

<div class="container">
    <div class="error-header">
        <h1 class="error-title">Exception Occurred</h1>
        <p class="error-msg"><?= htmlspecialchars($throwable->getMessage()); ?></p>
    </div>

    <div class="meta-box">
        <div class="meta-line"><strong>Type:</strong> <span class="code-font class-name"><?= $throwable::class; ?></span></div>
        <div class="meta-line"><strong>File:</strong> <span class="code-font"><?= htmlspecialchars($throwable->getFile()); ?></span></div>
        <div class="meta-line"><strong>Line:</strong> <span class="code-font line-num"><?= $throwable->getLine(); ?></span></div>
    </div>

    <h2 class="trace-title">Stack Trace</h2>
    <div class="trace-list code-font">
        <?php
        $trace = $throwable->getTrace();

        foreach ($trace as $index => $step):
            $call = '';
            if (isset($step['class'])) {
                $call .= '<span class="class-name">' . $step['class'] . '</span>' . $step['type'];
            }
            if (isset($step['function'])) {
                $call .= '<span class="method-name">' . $step['function'] . '</span>()';
            }

            $file = isset($step['file']) ? htmlspecialchars($step['file']) : '[internal function]';
            $line = $step['line'] ?? null;
            ?>
            <div class="trace-item">
                <div class="trace-index">#<?= $index; ?></div>
                <div class="trace-body">
                    <div class="trace-call"><?= $call; ?></div>
                    <div class="trace-file">
                        <?= $file; ?><?= $line ? " : <span class='line-num'>{$line}</span>" : ''; ?>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>

</body>
</html>
