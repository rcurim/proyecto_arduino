<table class="table">
    <thead class="thead-light">
        <tr>
            <th>ID</th>
            <th>Valor</th>
            <th>Categoria</th>
            <th>Fecha Creacion</th>
        </tr>
    </thead>
    <tbody>

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