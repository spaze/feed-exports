<?php
declare(strict_types = 1);

namespace Spaze\Exports\Atom;

use DateTimeImmutable;
use Spaze\Exports\Atom\Constructs\AtomPerson;
use Spaze\Exports\Atom\Constructs\AtomText;
use Spaze\Exports\Atom\Constructs\AtomTextType;
use Spaze\Exports\Atom\Elements\AtomEntry;
use Spaze\Exports\Atom\Elements\AtomLink;
use Spaze\Exports\Atom\Elements\AtomLinkRel;
use Tester\Assert;
use Tester\TestCase;

require __DIR__ . '/../bootstrap.php';

/** @testCase */
class AtomFeedTest extends TestCase
{

	public function testToString(): void
	{
		$now = new DateTimeImmutable('2020-10-20 10:20:20 Europe/Prague');

		$feed = new AtomFeed('https://url', 'Feed Title');
		$feed->setLinkSelf('https://url');
		$feed->setUpdated($now);
		$feed->setAuthor(new AtomPerson('foo bar', 'foo@bar.example', 'https://foo.bar.example/'));
		$feed->addLink(new AtomLink('https://feed.test/1'));
		$feed->addLink(new AtomLink('https://feed.test/2', AtomLinkRel::Alternate));
		$feed->addLink(new AtomLink('https://feed.test/3'));

		$entry = new AtomEntry(
			'https://href/1',
			new AtomText('<em>title-1</em>', AtomTextType::Html),
			new DateTimeImmutable('2019-12-20 12:20:20 Europe/Prague'),
			new DateTimeImmutable('2019-12-16 12:20:20 Europe/Prague'),
		);
		$entry->setContent(new AtomText('<strong>content-1</strong>'));
		$entry->addLink(new AtomLink('https://entry.test/1'));
		$entry->addLink(new AtomLink('https://entry.test/2', AtomLinkRel::Alternate));
		$entry->addLink(new AtomLink('https://entry.test/3'));
		$feed->addEntry($entry);

		$entry = new AtomEntry(
			'https://href/2',
			new AtomText('<em>title-2</em>', AtomTextType::Html),
			new DateTimeImmutable('2018-12-20 12:20:20 Europe/Prague'),
			new DateTimeImmutable('2018-12-16 12:20:20 Europe/Prague'),
		);
		$entry->setContent(new AtomText('<strong>content-2</strong>'));
		$feed->addEntry($entry);

		Assert::same(file_get_contents(__DIR__ . '/feed.xml'), (string)$feed);
	}


	public function testToStringEmptyFeed(): void
	{
		$feed = new AtomFeed('', '');
		Assert::same(file_get_contents(__DIR__ . '/feed-empty.xml'), (string)$feed);
	}

}

$testCase = new AtomFeedTest();
$testCase->run();
