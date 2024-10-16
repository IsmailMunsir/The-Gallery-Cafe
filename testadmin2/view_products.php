<?php

@include 'config.php';

$select = mysqli_query($conn, "SELECT * FROM products");

?>

<div class="product-display">
    <table class="product-display-table">
        <thead>
        <tr>
            <th>Product Image</th>
            <th>Product Name</th>
            <th>Product Price</th>
            <th>Product Category</th>
            <th>Action</th>
        </tr>
        </thead>
        <tbody>
        <?php while($row = mysqli_fetch_assoc($select)){ ?>
        <tr>
            <td><img src="uploaded_img/<?php echo $row['image']; ?>" height="100" alt=""></td>
            <td><?php echo $row['name']; ?></td>
            <td>$<?php echo $row['price']; ?>/-</td>
            <td><?php echo $row['category']; ?></td>
            <td>
                <a href="admin_update.php?edit=<?php echo $row['id']; ?>" class="btn"> <i class="fas fa-edit"></i> edit </a>
                <a href="admin_dashboard.php?delete=<?php echo $row['id']; ?>" class="btn"> <i class="fas fa-trash"></i> delete </a>
            </td>
        </tr>
        <?php } ?>
        </tbody>
    </table>
</div>