<?php

namespace FedexRest\Entity;

class PackageSpecialServicesRequested
{

  public array $specialServiceTypes;
  public ?DangerousGoodsDetail $dangerousGoodsDetail;
  public ?Weight $dryIceWeight;

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
   * @param ?Weight $dryIceWeight
   * @return $this
   */
  public function setDryIceWeight(?Weight $dryIceWeight): PackageSpecialServicesRequested
  {
    $this->dryIceWeight = $dryIceWeight;
    return $this;
  }

  public function prepare(): array {
    $data = [];

    if (!empty($this->setSpecialServiceTypes)) {
      $data['specialServiceTypes'] = $this->setSpecialServiceTypes;
    }

    if (!empty($this->dangerousGoodsDetail)) {
      $data['dangerousGoodsDetail'] = $this->dangerousGoodsDetail->prepare();
    }

    if (!empty($this->dryIceWeight)) {
      $data['dryIceWeight'] = $this->dryIceWeight->prepare();
    }

    return $data;
  }

}
