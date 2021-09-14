<?php
/**
 *
 * Valida un email usando filter_var y comprobar las DNS. 
 *  Devuelve true si es correcto o false en caso contrario
 *
 * @param    string  $str la dirección a validar
 * @return   boolean
 *
 */
function is_valid_email($str)
{
  $result = (false !== filter_var($str, FILTER_VALIDATE_EMAIL));
  
  if ($result)
  {
    list($user, $domain) = explode('@', $str);
    
    $result = checkdnsrr($domain, 'MX');
  }
  
  return $result;
}