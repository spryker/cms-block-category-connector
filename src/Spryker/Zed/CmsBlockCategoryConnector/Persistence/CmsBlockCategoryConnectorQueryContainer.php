<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Spryker\Zed\CmsBlockCategoryConnector\Persistence;

use Propel\Runtime\ActiveQuery\Criteria;
use Spryker\Zed\Kernel\Persistence\AbstractQueryContainer;

/**
 * @method \Spryker\Zed\CmsBlockCategoryConnector\Persistence\CmsBlockCategoryConnectorPersistenceFactory getFactory()
 */
class CmsBlockCategoryConnectorQueryContainer extends AbstractQueryContainer implements CmsBlockCategoryConnectorQueryContainerInterface
{

    /**
     * @api
     *
     * @return \Orm\Zed\CmsBlockCategoryConnector\Persistence\SpyCmsBlockCategoryConnectorQuery
     */
    public function queryCmsBlockCategoryConnector()
    {
        return $this->getFactory()
            ->createCmsBlockCategoryConnectorQuery();
    }

    /**
     * @api
     *
     * @param $idCmsBlock
     *
     * @return \Orm\Zed\CmsBlockCategoryConnector\Persistence\SpyCmsBlockCategoryConnectorQuery
     */
    public function queryCmsBlockCategoryConnectorByIdCmsBlock($idCmsBlock)
    {
        return $this->queryCmsBlockCategoryConnector()
            ->filterByFkCategory(null, Criteria::NOT_EQUAL)
            ->filterByFkCmsBlock($idCmsBlock);
    }

}