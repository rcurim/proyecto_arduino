<!DOCTYPE HTML>
<html lang="es">

<head>
    <meta charset="UTF-8" />
    <title>Reporte</title>
    <style type="text/css">
        #cabecera{
            background:#eee;
            padding:10px;
        }
        #table_head tr th{
            padding-right: 120px;
            padding-left: 10px;
            padding-bottom: 10px;
            padding-top: 10px;
        }
        #table_body tr td{
            text-align: right;
        }
    </style>
</head>

<body>
    <div id="cabecera">
        <h2>Reporte de pH del agua</h2>
    </div>
    <table class="table" border="0.5" align="center">
        <thead id="table_head">
            <tr>
                <th>ID</th>
                <th>Valor</th>
                <th>Categoria</th>
                <th>Fecha Creacion</th>
            </tr>
        </thead>
        <tbody id="table_body">

            <?php while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) : ?>
                <?php extract($row); ?>
                <tr>
                    <td> <?= $id ?> </td>
                    <td> <?= $value ?> </td>
                    <td> <?= $category_desc ?> </td>
                    <td> <?= $creation_date ?> </td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>

</body>

</html>