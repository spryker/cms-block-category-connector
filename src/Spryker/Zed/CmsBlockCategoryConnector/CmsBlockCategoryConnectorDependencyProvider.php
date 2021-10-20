<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Spryker\Zed\CmsBlockCategoryConnector;

use Spryker\Zed\CmsBlockCategoryConnector\Dependency\Facade\CmsBlockCategoryConnectorToCollectorBridge;
use Spryker\Zed\CmsBlockCategoryConnector\Dependency\Facade\CmsBlockCategoryConnectorToLocaleBridge;
use Spryker\Zed\CmsBlockCategoryConnector\Dependency\Facade\CmsBlockCategoryConnectorToTouchBridge;
use Spryker\Zed\CmsBlockCategoryConnector\Dependency\QueryContainer\CmsBlockCategoryConnectorToCategoryQueryContainerBridge;
use Spryker\Zed\CmsBlockCategoryConnector\Dependency\QueryContainer\CmsBlockCategoryConnectorToCmsBlockQueryContainerBridge;
use Spryker\Zed\Kernel\AbstractBundleDependencyProvider;
use Spryker\Zed\Kernel\Container;

/**
 * @method \Spryker\Zed\CmsBlockCategoryConnector\CmsBlockCategoryConnectorConfig getConfig()
 */
class CmsBlockCategoryConnectorDependencyProvider extends AbstractBundleDependencyProvider
{
    /**
     * @var string
     */
    public const FACADE_LOCALE = 'CMS_BLOCK_CATEGORY_CONNECTOR:FACADE_LOCALE';

    /**
     * @var string
     */
    public const FACADE_TOUCH = 'CMS_BLOCK_CATEGORY_CONNECTOR:FACADE_TOUCH';

    /**
     * @var string
     */
    public const FACADE_COLLECTOR = 'CMS_BLOCK_CATEGORY_CONNECTOR:FACADE_COLLECTOR';

    /**
     * @var string
     */
    public const QUERY_CONTAINER_CMS_BLOCK = 'CMS_BLOCK_CATEGORY_CONNECTOR:QUERY_CONTAINER_CMS_BLOCK';

    /**
     * @var string
     */
    public const QUERY_CONTAINER_CATEGORY = 'CMS_BLOCK_CATEGORY_CONNECTOR:QUERY_CONTAINER_CATEGORY';

    /**
     * @var string
     */
    public const QUERY_CONTAINER_TOUCH = 'CMS_BLOCK_CATEGORY_CONNECTOR:QUERY_CONTAINER_TOUCH';

    /**
     * @var string
     */
    public const SERVICE_DATA_READER = 'CMS_BLOCK_CATEGORY_CONNECTOR:SERVICE_DATA_READER';

    /**
     * @var string
     */
    public const SERVICE_UTIL_ENCODING = 'CMS_BLOCK_CATEGORY_CONNECTOR:SERVICE_UTIL_ENCODING';

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    public function provideCommunicationLayerDependencies(Container $container)
    {
        $container = parent::provideCommunicationLayerDependencies($container);
        $container = $this->addLocaleFacade($container);
        $container = $this->addCategoryQueryContainer($container);
        $container = $this->addCmsBlockQueryContainer($container);
        $container = $this->addEncodeService($container);

        return $container;
    }

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    public function provideBusinessLayerDependencies(Container $container)
    {
        $container = parent::provideBusinessLayerDependencies($container);
        $container = $this->addCollectorFacade($container);
        $container = $this->addDataReaderService($container);
        $container = $this->addTouchQueryContainer($container);
        $container = $this->addTouchFacade($container);
        $container = $this->addCategoryQueryContainer($container);

        return $container;
    }

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    protected function addLocaleFacade(Container $container)
    {
        $container->set(static::FACADE_LOCALE, function (Container $container) {
            return new CmsBlockCategoryConnectorToLocaleBridge($container->getLocator()->locale()->facade());
        });

        return $container;
    }

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    protected function addTouchFacade(Container $container)
    {
        $container->set(static::FACADE_TOUCH, function (Container $container) {
            return new CmsBlockCategoryConnectorToTouchBridge($container->getLocator()->touch()->facade());
        });

        return $container;
    }

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    protected function addCategoryQueryContainer(Container $container)
    {
        $container->set(static::QUERY_CONTAINER_CATEGORY, function (Container $container) {
            return new CmsBlockCategoryConnectorToCategoryQueryContainerBridge($container->getLocator()->category()->queryContainer());
        });

        return $container;
    }

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    protected function addCollectorFacade(Container $container)
    {
        $container->set(static::FACADE_COLLECTOR, function (Container $container) {
            return new CmsBlockCategoryConnectorToCollectorBridge($container->getLocator()->collector()->facade());
        });

        return $container;
    }

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    protected function addDataReaderService(Container $container)
    {
        $container->set(static::SERVICE_DATA_READER, function (Container $container) {
            return $container->getLocator()->utilDataReader()->service();
        });

        return $container;
    }

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    protected function addTouchQueryContainer(Container $container)
    {
        $container->set(static::QUERY_CONTAINER_TOUCH, function (Container $container) {
            return $container->getLocator()->touch()->queryContainer();
        });

        return $container;
    }

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    protected function addCmsBlockQueryContainer(Container $container)
    {
        $container->set(static::QUERY_CONTAINER_CMS_BLOCK, function (Container $container) {
            return new CmsBlockCategoryConnectorToCmsBlockQueryContainerBridge($container->getLocator()->cmsBlock()->queryContainer());
        });

        return $container;
    }

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    protected function addEncodeService(Container $container)
    {
        $container->set(static::SERVICE_UTIL_ENCODING, function (Container $container) {
            return $container->getLocator()->utilEncoding()->service();
        });

        return $container;
    }
}
