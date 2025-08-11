<?php
require_once 'includes/db.php';
require_once 'includes/function.php';

$message = [];
$title = '';
$type = '';
$pageNo = '';
$duration = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $type = $_POST['content_type'];
    $title = $_POST['title'];
    $pageNo = $_POST['pageNo'];
    $duration = $_POST['duration'];

    // Check for duplicate page number
    $exists = sql_arr("SELECT * FROM book_pages WHERE page_no = $pageNo");
    if ($exists) {
        $message = ["message" => "Page number $pageNo already exists. Please choose a different number.", "message_type" => "error"];
    } else{

        // UPLOAD YOUR FILE
        $uploadDir = '';
        switch ($type) {
            case 'image':
                $uploadDir = 'assets/files/images/';
                break;
            case 'video':
                $uploadDir = 'assets/files/videos/';
                break;
            case 'text':
                $uploadDir = 'assets/files/texts/';
                break;
        }

        $fileName = basename($_FILES['file']['name']);
        $targetPath = $uploadDir . $fileName;

        if (move_uploaded_file($_FILES['file']['tmp_name'], $targetPath)) {
                
            $col_arr = ['page_no', 'content_type', 'title', 'file_src', 'duration', 'active', 'created_on'];
            $val_arr = [$pageNo, $type, $title, $fileName, $duration, 1, date('Y-m-d H:i:s')];
            sql_insert("book_pages", $col_arr, $val_arr);

            // $message = "✅ Upload successful!";
            $message = ["message" => "Upload successful!", "message_type" => "success"];

            // Clear previous values
            $title = '';
            $type = '';
            $pageNo = '';
            $duration = '';
        } else {
            // $message = "Failed to upload file.";
            $message = ["message" => "Failed to upload file.", "message_type" => "error"];
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Upload Flipbook Page</title>
    <style>
        body {
            background: #f8f9fa;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            width: 100%;
            min-height: 100vh;
        }

        .container {
            background: #ffffff;
            padding: 30px 40px;
            border-radius: 12px;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
            /*max-width: 450px;*/
            width: 30%;
        }

        h2 {
            text-align: center;
            color: #343a40;
            margin-bottom: 25px;
        }

        form label {
            display: block;
            margin: 12px 0 6px;
            color: #495057;
            font-weight: 500;
        }

        form input[type="text"],
        form input[type="number"],
        form input[type="file"],
        form select {
            width: 100%;
            max-width: -webkit-fill-available;
            width: -webkit-fill-available;
            padding: 10px 12px;
            border: 1px solid #ced4da;
            border-radius: 8px;
            outline: none;
            font-size: 15px;
        }

        form button {
            width: 100%;
            margin-top: 20px;
            padding: 12px;
            background-color: #0d6efd;
            color: white;
            border: none;
            border-radius: 8px;
            font-size: 16px;
            cursor: pointer;
            transition: background 0.3s ease;
        }

        form button:hover {
            background-color: #084cdf;
        }

        .message {
            margin-top: 15px;
            text-align: center;
            font-weight: bold;
            color: #198754;
        }

        .error {
            color: #dc3545;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>📤 Upload Page Content</h2>
        <form method="post" enctype="multipart/form-data">
            <div style="width: 100%;">
                <label>Title:</label>
                <input type="text" name="title" value="<?php echo $title; ?>" required>
            </div>
            <div style="width: 100%;">
                <label>Content Type:</label>
                <select name="content_type" required>
                    <option value="">--Select Type--</option>
                    <option value="text" <?php if ($type === 'text') echo 'selected'; ?>>Text</option>
                    <option value="image" <?php if ($type === 'image') echo 'selected'; ?>>Image</option>
                    <option value="video" <?php if ($type === 'video') echo 'selected'; ?>>Video</option>
                </select>
            </div>

            <div style="width: 100%;">
                <label>File:</label>
                <input type="file" name="file" required>
            </div>
            <div style="width: 100%;">
                <label>Page No.:</label>
                <input type="number" name="pageNo" value="<?php echo $pageNo; ?>" required>
            </div>
            <div style="width: 100%;">
                <label>Estimated Duration (seconds):</label>
                <input type="number" name="duration" value="<?php echo $duration; ?>" required>
            </div>
            <div style="width: 100%;">
                    <button type="submit">📁 Upload Content</button>
            </div>
        </form>

        <?php if ($message): ?>
            <div class="message <?php echo $message['message_type'] == "error" ? 'error' : ''; ?>">
                <?php echo $message['message']; ?>
            </div>
        <?php endif; ?>
    </div>
</body>
</html>
