<?php

declare(strict_types=1);

namespace Flexsounds\Bundle\ApiBehavior\Request;

use Flexsounds\Bundle\ApiBehavior\Domain\AbstractPageRequest;
use Symfony\Component\HttpFoundation\Request;

class PageableRequest extends AbstractPageRequest
{
    protected $defaultPageNumber = 0;
    protected $defaultPageSize = 20;

    protected $pageNumberQueryParameter = 'page';
    protected $pageSizeQueryParameter = 'size';

    /**
     * AbstractPage constructor.
     *
     * @param Request $request
     */
    public function __construct(Request $request)
    {
        $page = $request->query->getInt($this->pageNumberQueryParameter, $this->defaultPageNumber);
        $size = $request->query->getInt($this->pageSizeQueryParameter, $this->defaultPageSize);
        parent::__construct($page, $size);
    }
}
