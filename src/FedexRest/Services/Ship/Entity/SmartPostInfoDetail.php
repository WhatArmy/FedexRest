<?php

namespace FedexRest\Services\Ship\Entity;

class SmartPostInfoDetail
{
    public ?string $ancillaryEndorsement;
    public ?string $hubId;
    public ?string $indicia;
    public ?string $specialServices;

    public function setAncillaryEndorsement(?string $ancillaryEndorsement): static
    {
        $this->ancillaryEndorsement = $ancillaryEndorsement;
        return $this;
    }

    public function setHubId(?string $hubId): static
    {
        $this->hubId = $hubId;
        return $this;
    }

    public function setIndicia(?string $indicia): static
    {
        $this->indicia = $indicia;
        return $this;
    }

    public function setSpecialServices(?string $specialServices): static
    {
        $this->specialServices = $specialServices;
        return $this;
    }

    public function prepare(): array
    {
        $data = [];
        if (!empty($this->ancillaryEndorsement)) {
            $data['ancillaryEndorsement'] = $this->ancillaryEndorsement;
        }
        if (!empty($this->hubId)) {
            $data['hubId'] = $this->hubId;
        }
        if (!empty($this->indicia)) {
            $data['indicia'] = $this->indicia;
        }
        if (!empty($this->specialServices)) {
            $data['specialServices'] = $this->specialServices;
        }
        return $data;
    }
}
