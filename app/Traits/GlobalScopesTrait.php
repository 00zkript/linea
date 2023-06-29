<?php

namespace App\Traits;

trait GlobalScopesTrait
{
    public function scopeWithSucursal($query)
    {
        $sucursalID = auth()->user()->sucursal->idsucursal;
        return $query->when($sucursalID, function($query) use($sucursalID) {
            $query->where('idsucursal', $sucursalID);
        });
    }
}
