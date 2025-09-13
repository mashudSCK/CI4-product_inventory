<!DOCTYPE html>
<html>

<head>
    <title><?= $title ?></title>
    <style>
    body {
        font-family: Arial, sans-serif;
        line-height: 1.6;
        margin: 0;
        padding: 20px;
        background-color: #f4f4f4;
    }

    .container {
        max-width: 800px;
        margin: 0 auto;
        background: white;
        padding: 20px;
        border-radius: 5px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    h1 {
        color: #333;
        border-bottom: 2px solid #333;
        padding-bottom: 10px;
    }

    .step {
        background: #e7f3fe;
        border-left: 4px solid #2196F3;
        padding: 10px 15px;
        margin: 15px 0;
    }

    .code {
        background: #f1f1f1;
        padding: 10px;
        border-radius: 3px;
        font-family: monospace;
        overflow-x: auto;
    }
    </style>
</head>

<body>
    <div class="container">
        <h1><?= $heading ?></h1>
        <p><?= $message ?></p>
        <h2>Getting Started with CodeIgniter 4</h2>
        <div class="step">
            <h3>Step 1: Download CodeIgniter 4</h3>
            <p>Visit the official website and download the latest version.</p>

        </div>
        <div class="step">
            <h3>Step 2: Extract Files</h3>
            <p>Extract the downloaded ZIP file to your web server directory.</p>
            <div class="code">/htdocs/ci-4/</div>
        </div>
        <div class="step">
            <h3>Step 3: Configure Environment</h3>
            <p>Rename <code>env</code> to <code>.env</code> and set your
                baseURL:</p>
            <div class="code">app.baseURL = 'http://localhost/ci-4/'</div>
        </div>
        <div class="step">
            <h3>Step 4: Test Installation</h3>
            <p>Open your browser and navigate to your project URL.</p>
            <p>You should see the CodeIgniter welcome page.</p>
        </div>
        <h2>Next Steps</h2>
        <ul>
            <li>Learn about the MVC pattern</li>
            <li>Create your first controller</li>
            <li>Build your first view</li>
            <li>Connect to a database</li>
        </ul>
    </div>
</body>

</html>