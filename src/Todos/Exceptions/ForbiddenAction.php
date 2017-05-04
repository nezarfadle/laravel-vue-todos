<?php

namespace Todos\Exceptions;

class ForbiddenAction extends \Exception
{
	 public function __construct() {
        parent::__construct( 'Forbidden action exception' );
    }
}