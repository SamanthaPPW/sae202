<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8" />
    <title>Back Office - Liste des utilisateurs</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f2f2f2;
            margin: 0;
            padding: 40px;
            color: #222;
        }

        h1 {
            text-align: center;
            font-weight: 500;
            font-size: 32px;
            margin-bottom: 30px;
        }

        a {
            display: inline-block;
            background-color: #2c2c2c;
            color: white;
            padding: 10px 18px;
            text-decoration: none;
            border-radius: 6px;
            margin-bottom: 20px;
            float: right;
            transition: background-color 0.3s ease;
        }

        a:hover {
            background-color: #111;
        }

        .table-container {
            background-color: white;
            padding: 25px;
            border-radius: 12px;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.1);
            overflow-x: auto;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            font-size: 15px;
        }

        thead {
            background-color: #333;
            color: #fff;
        }

        th, td {
            text-align: left;
            padding: 14px 16px;
            border-bottom: 1px solid #e0e0e0;
        }

        tbody tr:hover {
            background-color: #f9f9f9;
        }

        tbody tr:last-child td {
            border-bottom: none;
        }
    </style>
</head>
<body>
    <h1>Liste des utilisateurs</h1>
    <a href="index.php?action=logout">Déconnexion</a>

    <div class="table-container">
        <table>
            <thead>
                <tr>
                    <th>ID</th><th>Nom</th><th>Prénom</th><th>Email</th><th>Téléphone</th><th>Date inscription</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($users as $user): ?>
                <tr>
                    <td><?=htmlspecialchars($user['id'])?></td>
                    <td><?=htmlspecialchars($user['nom'])?></td>
                    <td><?=htmlspecialchars($user['prenom'])?></td>
                    <td><?=htmlspecialchars($user['email'])?></td>
                    <td><?=htmlspecialchars($user['telephone'])?></td>
                    <td><?=htmlspecialchars($user['date_inscription'])?></td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</body>
</html>
