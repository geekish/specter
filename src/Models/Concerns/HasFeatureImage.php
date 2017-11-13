<?php

namespace Specter\Models\Concerns;

trait HasFeatureImage
{
    /**
     * Check if model has feature image
     *
     * @return bool
     */
    public function hasFeatureImage() : bool
    {
        return !empty($this->getAttribute('feature_image'));
    }
}
