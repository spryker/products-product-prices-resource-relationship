<?php
/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Spryker\Glue\ProductsProductPricesResourceRelationship\Processor\Mapper;

use Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface;
use Spryker\Glue\ProductsProductPricesResourceRelationship\Dependency\RestResource\ProductsProductPricesResourceRelationToProductPricesRestApiInterface;

class ConcreteProductsProductPricesResourceRelationshipMapper implements ConcreteProductsProductPricesResourceRelationshipMapperInterface
{
    /**
     * @var \Spryker\Glue\ProductsProductPricesResourceRelationship\Dependency\RestResource\ProductsProductPricesResourceRelationToProductPricesRestApiInterface
     */
    protected $productPricesResource;

    /**
     * @param \Spryker\Glue\ProductsProductPricesResourceRelationship\Dependency\RestResource\ProductsProductPricesResourceRelationToProductPricesRestApiInterface $productPricesResource
     */
    public function __construct(ProductsProductPricesResourceRelationToProductPricesRestApiInterface $productPricesResource)
    {
        $this->productPricesResource = $productPricesResource;
    }

    /**
     * @param \Spryker\Glue\GlueApplication\Rest\JsonApi\RestResourceInterface[] $resources
     * @param \Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface $restRequest
     *
     * @return void
     */
    public function mapResourceRelationships(array $resources, RestRequestInterface $restRequest): void
    {
        foreach ($resources as $resource) {
            $abstractProductPricesResource = $this->productPricesResource
                ->findConcreteProductPricesByConcreteProductSku($resource->getId(), $restRequest);
            if ($abstractProductPricesResource !== null) {
                $resource->addRelationship($abstractProductPricesResource);
            }
        }
    }
}
