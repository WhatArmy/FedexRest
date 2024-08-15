<?php

namespace FedexRest\Entity;

use FedexRest\Services\Ship\Type\PackageSpecialServiceType;

class PackageSpecialServicesRequested
{

  public array $specialServiceTypes;
  public ?DangerousGoodsDetail $dangerousGoodsDetail;
  public ?Weight $dryIceWeight;
  public ?$signatureOptionType;
  public ?PackageSpecialServiceType $dangerousGoods;

  /**
   * @param array $specialServiceTypes
   * @return $this
   */
  public function setSpecialServiceTypes(array $specialServiceTypes): PackageSpecialServicesRequested
  {
    $this->specialServiceTypes = $specialServiceTypes;
    return $this;
  }

  /**
   * @param string $specialServiceType
   * @return $this
   */
  public function addToSpecialServiceTypes(string $specialServiceType): PackageSpecialServicesRequested
  {
    $this->specialServiceTypes[] = $specialServiceType;
    return $this;
  }

  /**
   * @param ?DangerousGoodsDetail $dangerousGoodsDetail
   * @return $this
   */
  public function setDangerousGoodsDetail(?DangerousGoodsDetail $dangerousGoodsDetail): PackageSpecialServicesRequested
  {
    $this->dangerousGoodsDetail = $dangerousGoodsDetail;
    return $this;
  }
  
  /**
   * @param ?DangerousGoods $dangerousGoods
   * @return $this
   */
  public function setDangerousGoods(?PackageSpecialServiceType $dangerousGoods): PackageSpecialServicesRequested
  {
    $this->dangerousGoods = $dangerousGoods;
    return $this;
  }

  /**
   * @param ?Weight $dryIceWeight
   * @return $this
   */
  public function setDryIceWeight(?Weight $dryIceWeight): PackageSpecialServicesRequested
  {
    $this->dryIceWeight = $dryIceWeight;
    return $this;
  }
  
  /**
   * @param ?PackageSpecialServiceType $signatureOptionType
   * @return $this
   */
  public function setSignatureOptionType(?PackageSpecialServiceType $signatureOptionType): PackageSpecialServicesRequested {
    $this->signatureOptionType = $signatureOptionType;
    return $this;
  
  }
  
  public function prepare(): array {
    $data = [];

    if (!empty($this->specialServiceTypes)) {
      $data['specialServiceTypes'] = $this->specialServiceTypes;
    }
    
    if (!empty($this->dangerousGoods)) {
      $data['dangerousGoods'] = $this->dangerousGoods;
    }

    if (!empty($this->dangerousGoodsDetail)) {
      $data['dangerousGoodsDetail'] = $this->dangerousGoodsDetail->prepare();
    }

    if (!empty($this->dryIceWeight)) {
      $data['dryIceWeight'] = $this->dryIceWeight->prepare();
    }
    
    if (!empty($this->signatureOptionType)) {
      $data['signatureOptionType'] = $this->signatureOptionType;
    }
    return $data;
  }

}
