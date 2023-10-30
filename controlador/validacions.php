<?php


/**
 * Función para validar un DNI español.
 *
 * @param string $dni El DNI a validar.
 *
 * @return bool Devuelve true si el DNI es válido, false si no lo es.
 */
function validar_dni2($dni) {
    return preg_match('/^[0-9]{8}[A-Z]$/', $dni) !== 1;
}

/**
 * Función para validar una dirección de correo electrónico.
 *
 * @param string $correo La dirección de correo electrónico a validar.
 *
 * @return bool Devuelve true si la dirección de correo electrónico es válida, false si no lo es.
 */
function validar_email($correo) {
    return filter_var($correo, FILTER_VALIDATE_EMAIL) !== false;
}

/**
 * Función para validar un nombre.
 *
 * @param string $nombre El nombre a validar.
 *
 * @return bool Devuelve true si el nombre es válido, false si no lo es.
 */
function validar_nombre($nombre) {
    return preg_match('/^[a-zA-ZáéíóúÁÉÍÓÚñÑ ]+$/', $nombre) !== 1;
}

/**
 * Función para validar una contraseña.
 *
 * @param string $contraseña La contraseña a validar.
 *
 * @return bool Devuelve true si la contraseña es válida, false si no lo es.
 */
function validar_contraseña2($contraseña) {
    return preg_match_all('$\S*(?=\S{8,})(?=\S*[a-z])(?=\S*[A-Z])(?=\S*[\d])(?=\S*[\W])\S*$', $contraseña) !== 1;
}

/**
 * Función para validar que dos contraseñas coincidan.
 *
 * @param string $contraseña La primera contraseña.
 * @param string $contraseña_verificacion La segunda contraseña.
 *
 * @return bool Devuelve true si las contraseñas coinciden, false si no lo hacen.
 */
function validar_contraseña($contraseña, $contraseña_verificacion) {
    return $contraseña === $contraseña_verificacion;
}


?>