<?php 
global $fvnController;

?>
<tr class="form-field form-required term-name-wrap">
    <th scope="row"><label for="name"><?= $fvnController->_data['lblPicture'] ?></label></th>
    <td><?= $fvnController->_data['inputPicture'] ?>
        <p class="description"><?= $fvnController->_data['pPicture'] ?></p>
    </td>
</tr>