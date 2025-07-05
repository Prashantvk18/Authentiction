<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['files'])) {
    $files = $_POST['files'];
    $zipName = 'download_' . time() . '.zip';
    $zipPath = sys_get_temp_dir() . DIRECTORY_SEPARATOR . $zipName;
    $zip = new ZipArchive();
    if ($zip->open($zipPath, ZipArchive::CREATE) === TRUE) {
        foreach ($files as $filePath) {
            $decoded = str_replace('|', DIRECTORY_SEPARATOR, $filePath);
            if (file_exists($decoded) && is_file($decoded)) {
                $zip->addFile($decoded, basename($decoded));
            }
        }
        $zip->close();
        header('Content-Type: application/zip');
        header("Content-Disposition: attachment; filename=\"$zipName\"");
        header('Content-Length: ' . filesize($zipPath));
        readfile($zipPath);
        unlink($zipPath);
        exit;
    } else {
        echo "Failed to create zip.";
        exit;
    }
}

if (isset($_GET['path'])) {
    $base_dir = str_replace('|', DIRECTORY_SEPARATOR, $_GET['path']);
    if (is_dir($base_dir)) {
        $items = array_diff(scandir($base_dir), ['.', '..']); // Exclude . and ..
        if (empty($items)) {
            echo "<div class='text-muted fst-italic ps-2'>No files present</div>";
            exit;
        }
        echo "<ul class='list-group list-group-flush'>";
        foreach (scandir($base_dir) as $item) {
            if ($item === '.' || $item === '..') continue;
            $full_path = $base_dir . DIRECTORY_SEPARATOR . $item;
            $encoded_path = htmlspecialchars(str_replace(DIRECTORY_SEPARATOR, '|', $full_path));

            if (is_dir($full_path)) {
                echo "<li class='list-group-item'>
                        <span class='folder text-primary fw-bold' onclick='loadFolder(\"$encoded_path\", this)'>
                            <i class='fas fa-folder me-2'></i> $item
                        </span>
                        <div class='subfolder ms-4'></div>
                      </li>";
            } else {
                echo "<li class='list-group-item d-flex align-items-center'>
                        <input type='checkbox' class='form-check-input me-2 file-checkbox' value='$encoded_path'>
                        <i class='fas fa-file me-2'></i> $item
                      </li>";
            }
        }
        echo "</ul>";
    } else {
        echo "<div class='alert alert-danger'>Not a directory.</div>";
    }
    exit;
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Dynamic File Explorer</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <style>
        .download-button {
            display: none;
        }

        .folder {
            cursor: pointer;
        }

        .subfolder {
            margin-top: 10px;
        }
    </style>
</head>

<body class="bg-light">
    <div class="container py-4">
        <h2 class="mb-4"><i class="fas fa-folder-open text-primary me-2"></i> Dynamic File Explorer</h2>

        <button type="button" id="download-btn" class="btn btn-success download-button mb-3">
            <i class="fas fa-download me-1"></i> Download Selected
        </button>

        <form id="download-form" method="post">
            <nav id="breadcrumb" class="mb-3"></nav>
            <div id="file-structure" class="bg-white p-3 rounded shadow-sm border"></div>
        </form>
    </div>
    <script>
        const selectedFiles = new Set();
        window.onload = () => {
            loadFolder("D:", document.getElementById("file-structure"));
        };
        function loadFolder(path) {
            fetch("?path=" + encodeURIComponent(path))
            .then(res => res.text())
            .then(html => {
                const container = document.getElementById("file-structure");
                container.innerHTML = html;

                updateBreadcrumb(path);

                container.querySelectorAll('input[type="checkbox"]').forEach(cb => {
                    cb.addEventListener('change', function () {
                        toggleSelection(this);
                    });
                });

                updateDownloadButton();
            });
        }
        function updateBreadcrumb(path) {
            const breadcrumb = document.getElementById("breadcrumb");
            breadcrumb.innerHTML = '';

            const parts = path.split('|');
            let currentPath = parts[0];
            const base = document.createElement('span');

            base.innerHTML = `<a href="#" onclick="loadFolder('${parts[0]}')">${parts[0]}</a>`;
            breadcrumb.appendChild(base);

            for (let i = 1; i < parts.length; i++) {
                currentPath += '|' + parts[i];
                breadcrumb.innerHTML += ' &gt; ';
                const span = document.createElement('span');
                span.innerHTML = `<a href="#" onclick="loadFolder('${currentPath}')">${parts[i]}</a>`;
                breadcrumb.appendChild(span);
            }
        }


        function toggleSelection(checkbox) {
            if (checkbox.checked) {
                selectedFiles.add(checkbox.value);
            } else {
                selectedFiles.delete(checkbox.value);
            }

            updateDownloadButton();
        }

        function updateDownloadButton() {
            const btn = document.getElementById("download-btn");
            btn.style.display = selectedFiles.size > 0 ? "inline-block" : "none";
        }

        document.getElementById("download-btn").addEventListener("click", function () {
            if (selectedFiles.size === 0) {
                alert("Please select at least one file.");
                return;
            }
            const form = document.getElementById("download-form");
            document.querySelectorAll('input[name="files[]"]').forEach(input => input.remove());
            selectedFiles.forEach(file => {
                const input = document.createElement("input");
                input.type = "hidden";
                input.name = "files[]";
                input.value = file;
                form.appendChild(input);
            });
            form.submit();
        });
    </script>
</body>

</html>
