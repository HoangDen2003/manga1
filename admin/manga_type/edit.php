<?php
include '../config/db_connection.php';

if (isset($_GET['id'])) {
    $type_id = $_GET['id'];
    $query = "SELECT * FROM manga_type WHERE type_id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param('i', $type_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $type = $result->fetch_assoc();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $type_id = $_POST['type_id'];
    $type_name = $_POST['type_name'];

    $query = "UPDATE manga_type SET type_name = ? WHERE type_id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param('si', $type_name, $type_id);
    $stmt->execute();

    header('Location: index.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Manga Type</title>
    <link rel="stylesheet" href="../../assets/css/styles.css">

    <style>
        body {
            display: flex;
            justify-content: center;
            flex-direction: column;
            align-items: center;
            height: 100vh;
            font-family: Arial, sans-serif;
            background: linear-gradient(135deg, #ffecd2, #fcb69f);
            /* padding: 20px; */
        }

        .container {
            background-color: white;
            padding: 40px;
            border-radius: 10px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
            max-width: 600px;
            width: 100%;
        }

        h1 {
            text-align: center;
            color: #333;
            font-size: 24px;
            margin-bottom: 20px;
            /* margin-top: 100px; */
        }

        form {
            display: flex;
            flex-direction: column;
            width: 100%;
        }

        label {
            font-weight: bold;
            color: #555;
            margin-top: 10px;
        }

        input[type="text"],
        textarea,
        input[type="file"] {
            padding: 10px;
            margin-top: 5px;
            border: 1px solid #ddd;
            border-radius: 5px;
            width: 100%;
            box-sizing: border-box;
            font-size: 16px;
        }

        input[type="file"] {
            padding: 5px;
        }

        input[type="submit"] {
            background-color: #4CAF50;
            color: white;
            padding: 12px;
            margin-top: 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-weight: bold;
            font-size: 16px;
            transition: background 0.3s ease;
        }

        input[type="submit"]:hover {
            background-color: #45a049;
        }

        img {
            margin-top: 10px;
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
        }

        .form-field {
            margin-bottom: 15px;
        }
    </style>
</head>

<body>

    <h1>Edit Manga Type</h1>
    <form action="" method="post">
        <input type="hidden" name="type_id" value="<?= $type['type_id'] ?>">

        <label for="type_name">Type Name:</label>
        <input type="text" id="type_name" name="type_name" value="<?= $type['type_name'] ?>" required><br><br>

        <input type="submit" value="Update">
    </form>

</body>

</html>