<?php
declare(strict_types = 1);

namespace Spaze\Exports\Bridges\Nette\Atom;

use Nette\Application\Response as NetteResponse;
use Nette\Http\IRequest;
use Nette\Http\IResponse;
use Spaze\Exports\Atom\Feed;
use Spaze\Exports\Bridges\Nette\AtomResponseContentType;

/**
 * Atom export response.
 *
 * @author Michal Špaček
 */
class Response implements NetteResponse
{

	public function __construct(
		private Feed $feed,
	) {
	}


	public function send(IRequest $httpRequest, IResponse $httpResponse): void
	{
		$httpResponse->setContentType(AtomResponseContentType::ApplicationAtomXml->value, 'utf-8');
		$feed = (string)$this->feed;
		$httpResponse->setHeader('Content-Length', (string)strlen($feed));
		echo $feed;
	}

}
