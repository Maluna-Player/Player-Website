<?php

/**
 * Vérifie si tous les champs du formulaire existent et sont remplis autrement que par des espaces
 * @return true si tous les champs sont bien remplis, false sinon
 */
function checkFormFields(array $fields)
{
    foreach ($fields as $fieldName)
    {
        if (!isset($_POST[$fieldName]) || empty(trim($_POST[$fieldName])))
        {
            return false;
        }
    }

    return true;
}
