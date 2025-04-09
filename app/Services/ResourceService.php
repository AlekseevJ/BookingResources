<?php 

namespace App\Services;

class ResourceService extends AbstractModelService
{
    protected static function getModelClass(): string
    {
        return \App\Models\Resource::class;
    }
}