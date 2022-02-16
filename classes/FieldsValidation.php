<?php

class FieldsValidation extends DBTableUsers {
    private $helpers;


    public function __construct() {
        $this -> helpers = new Helpers();
        $this -> dbTableUser = new DBTableUsers();
    }


    public function getValuePostMethod($fieldName) {
        return $_POST[$fieldName] ?? "";
    }


    public function verifyNewEmail($email) {
        // remove all illegal characters from an email.
        $emailPrepared = filter_var($email, FILTER_SANITIZE_EMAIL);

        // empty email
        if (empty($emailPrepared)) {
            return "Introduce tu email";
        }

        // wrong email format
        if (!filter_var($emailPrepared, FILTER_VALIDATE_EMAIL)) {
            return 'Formato del email incorrecto';
        }

        // email exists
        if ([] !== $this -> dbTableUser -> getSingleUserByEmail($emailPrepared)) {
            return 'Email ya existe';
        }

        // email is correct
        return null;
    }


    public function verifyExistingEmail($email) {
        // remove all illegal characters from an email.
        $emailPrepared = filter_var($email, FILTER_SANITIZE_EMAIL);

        // empty email
        if (empty($emailPrepared)) {
            return "Introduce tu email";
        }

        // wrong email format
        if (!filter_var($emailPrepared, FILTER_VALIDATE_EMAIL)) {
            return 'Formato del email incorrecto';
        }

        // email doesn't exists
        if ([] === $this -> dbTableUser -> getSingleUserByEmail($emailPrepared)) {
            return 'No se ha encontrado el usuario';
        }

        // email is correct
        return null;
    }


    public function verifyExistingPassword($enteredPassword, $email) {
        $userPasswordFromDB = '';

        // empty password
        if (empty($enteredPassword)) {
            return "La contraseña no puede estar vacía";
        }

        // email doesn't exists
        if ([] === $this -> dbTableUser -> getSingleUserByEmail($email)) {
            return "El usuario no existe";
        }

        // if user exists get the password
        $userPasswordFromDB = $this -> dbTableUser -> getSingleUserByEmail($email)['password'];

        // compare entered and user passwords
        if (!password_verify($enteredPassword, $userPasswordFromDB)) {
            return "Contraseña incorrecta";
        }

        // password c
        return null;
    }


    public function verifyNotEmptyField($field, $error) {
        // empty value
        if (empty($field)) {
            return $error;
        }

        // value exists
        return null;
    }


    public function verifyTextField($field, $minCharacters, $maxCharacters, $error) {
        // empty field
        if (empty(trim($field))) {
            return $error;
        }

        // wrong text length
        if (strlen($field) < $minCharacters || strlen($field) > $maxCharacters) {
            return "El valor debe estar entre los valores $minCharacters y $maxCharacters";
        }

        // text is correct
        return null;
    }


    public function verifyUploadedImage($field) {
        // empty field
        if (!isset($_FILES[$field]) || $_FILES[$field]['size'] === 0) {
            return 'El campo no puede estar vacío';
        }

        // wrong image format
        if (!in_array(mime_content_type($_FILES[$field]['tmp_name']), ['image/png', 'image/jpeg', 'image/jpg'], true)) {
            return 'Sube una imagen en formato png, jpg, jpeg';
        }

        // image is correct
        return null;
    }


    public function verifyPositiveNumber($field, $error) {
        // negative number
        if ((int)$field <= 0) {
            return $error;
        }
        // number is correct
        return null;
    }


    public function verifyIntroducedDate($field) {
        // empty date
        if (empty($field)) {
            return "Introduce la fecha de cierre de la subasta";
        }

        // date is from past (compare 2 timestamp)
        if (strtotime($field) <= strtotime(date('Y-m-d'))) {
            return "La fecha no puede ser del pasado ni de hoy";
        }

        // date is correct
        return null;
    }


    public function verifyValueForRate($field, $minRate) {

        // empty rate
        if (empty($field)) {
            return 'Introduce el valor de la puja';
        }

        // not numeric value
        if(is_numeric($field) === false) {
            return 'Únicamente se permiten valores numéricos';
        }

        // rate value is bigger than introduced value
        if ($field < $minRate) {
            return 'La puja mínima tiene que ser de ' . $this -> helpers -> formatPrice($minRate);
        }

        // rate is correct
        return null;

    }
}
