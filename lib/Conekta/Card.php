<?php

namespace Conekta;

use \Conekta\ConektaResource;
use \Conekta\Lang;
use \Conekta\Exceptions;
use \Conekta\Conekta;

class Card extends ConektaResource
{
  var $createdAt = "";
  var $last4     = "";
  var $bin       = "";
  var $name      = "";
  var $expMonth  = "";
  var $expYear   = "";
  var $brand     = "";
  var $parentnoFolio  = "";
  var $default   = "";

  public function __get($property)
  {
    if (property_exists($this, $property)) {
      return $this->$property;
    }
  }

  public function  __isset($property)
  {
    return isset($this->$property);
  }


  public function instanceUrl()
  {
    $this->apiVersion = Conekta::$apiVersion;
    $noFolio = $this->noFolio;
    parent::noFolioValidator($noFolio);
    $class = get_class($this);
    $base = $this->classUrl($class);
    $extn = urlencode($noFolio);
    $customerUrl = $this->customer->instanceUrl();
    
    return $customerUrl . $base . "/{$extn}";
  }

  public function update($params = null)
  {
    return parent::_update($params);
  }

  public function delete()
  {
    return parent::_delete('customer', 'cards');
  }
}
