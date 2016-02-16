<?php
    session_start();

    $stmt = $dbh->prepare('INSERT INTO cart (users_id, products_id) VALUES (:users_id, :products_id)');
    $result = $stmt->execute(
        array(
            /** Temporary Placeholder user */
            'users_id' => 1,
            'products_id' => $_POST['id']
        )
    );